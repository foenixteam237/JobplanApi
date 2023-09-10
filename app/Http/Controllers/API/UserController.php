<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;



class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $user = User::with([
            'role' => function ($query) {
                $query->select('id', 'roleName');
            },
            'nationality' => function($query){
                $query->select('id','nationalite');
            },
            'qualification' => function($query){
                $query->select('id', 'name');
            },
            'workplaces'=> function($query){
                $query->select('idUnit','name');
            }
        ])->get();


        //return UserResource::collection($user);
        return response()->json($user);
    }

    public function login(Request $request)
    {

        if (!UserValidator::loginValidate($request->all())) {
            return response()->json([
                'status' => false,
                'message' => "Données invalides",
                // 'required' => $request
            ], 400);
        }

        $user = User::where('registrationNumber', $request->registrationNumber)->first();

        if (!$user || !password_verify($request->password, $user->password)) return response()->json(['message' => 'Authentification a échouée'], 404);

        $token = $user->createToken('jobplan-auth-token')->plainTextToken;
        $userWithRole = $user->load('role:roleName');
        $response = [
            'token' => $token,
            'user' => $user->load(['role','qualification'])->only(['id', 'name', 'fisrtName', 'role', 'qualification']),
            'status' => 201
        ];
        return response()->json($response);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        if (!UserValidator::validate($request->all())) {
            return response()->json([
                'status' => false,
                'message' => "Données invalides",
            ], 400);
        }

        $user = User::create(
            [
                "name" => $request->name,
                "fisrtName" => $request->firstName,
                "birthDate" =>  new DateTime($request->birthDate),
                "birthPlace" => $request->birthPlace,
                "registrationNumber" => $request->registrationNumber,
                "password" => $request->password,
                "recruitmentDate" => $request->recruitmentDate,
                "sex" => $request->sex,
                "idRole" => $request->role,
                "idNationality" => $request->nationality,
                "idQualification" => $request->qualification
            ]
        );

        return response()->json([
            'status' => true,
            'message' => "Crée",
            'users' => $user
        ], 201);
    }


    public function show($id)
    {
        //

        $user = User::find($id);

        if (!$user) return response()->json([
            'status' => false,
            'message' => 'L\'utilisateur ' . strval($id) . ' n\'existe pas'
        ], 404);

        return  new UserResource($user);
    }



    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}


class UserValidator
{
    public static function validate(array $data)
    {
        $rules = [
            "name" => 'required|max:100',
            "birthDate" => 'required|date',
            "registrationNumber" => 'required|unique:users',
            "password" => 'required|min:8',
            "recruitmentDate" => 'required|date',
            "birthPlace" => 'required',
            "sex" => 'required|in:M,F',
            "role" => 'required',
            "nationality" => 'required',
            'qualification' => 'required'
        ];
        $validator = Validator::make($data, $rules);
        return $validator->passes();
    }

    public static function loginValidate(array $data)
    {
        $rules = [
            "registrationNumber" => 'required',
            "password" => 'required|min:8',
        ];
        $validator = Validator::make($data, $rules);
        return $validator->passes();
    }
}
