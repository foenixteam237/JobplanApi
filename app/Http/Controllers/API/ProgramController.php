<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProgramResource;
use App\Models\Program;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProgramController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $program = Program::with([
            'user'=>function($query){
                $query->select('id','name','fisrtName');
            },
            'days',
            'hours'])->get();

        /*return response()->json([
            'users' => $program->desc
        ]);*/
        return ProgramResource::collection($program);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        if (!ProgramValidator::validate($request->all())) {
            return response()->json([
                'status' => false,
                'message' => "Données invalides",
            ], 400);
        }

        $program =Program::create([
            'user_id' => $request->user_id,
            'idPlanning' => $request->idPlanning,
            'idDay' => $request->idDay,
            'idHour' => $request->idHour
        ]); 

        return response()->json([
            'status' => 'Programme créé avec succès',
            'validé' => $program
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Program $program)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Program $program)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Program $program)
    {
        //
    }
}


class ProgramValidator
{
    public static function validate(array $data)
    {
        $rules = [
            'user_id' => 'required|int',
            'idPlanning' => 'required|int',
            'idDay' => 'required|int',
            'idHour' => 'required|int'
        ];
        $validator = Validator::make($data, $rules);
        return $validator->passes();
    }
}