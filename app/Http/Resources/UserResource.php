<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request)
    {
        $data =  [
            "name" => $this->name,
            "fisrtName" => $this->fisrtName,
            "birthDay" => $this->birthDate,
            "recruitmentDate" => $this->recruitmentDate,
            "matricule" => $this->registrationNumber,
            "password" => $this->password,
            "marialStatus" => $this->marialStatus,
            "sex" => $this->sex,
            "qualification" => $this->qualification->name,
            "userRole" => $this->role->roleName,
            "nationality" => $this->nationality->nationalite,
            "poste" =>  UserWorkplaceResource::collection($this->workplaces),
            "created_at" => $this->created_at
        ];

        return response()->json($data)->getOriginalContent();
    }
    
}
