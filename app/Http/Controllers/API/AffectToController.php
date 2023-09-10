<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\AffectTo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AffectToController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $affect = AffectTo::with('users')->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (!AffectToValidation::validate($request->all())) {
            return response()->json([
                'status' => false,
                'message' => "Données invalides",
            ], 400);
        }

        $affect = AffectTo::create($request->all());

        return response()->json(
            [
                'status' => 'True',
                'Creation' => $affect
            ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

class AffectToValidation {
    public static function validate(array $data) {
        $rules = [
            "idWorkplace" => 'required|int',
            "idUser" => 'required|int',
        ];
        $validator = Validator::make($data, $rules);
        return $validator->passes();
    }

}