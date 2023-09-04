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
    public function toArray(Request $request): array
    {
        return [
            "name" => $this->name,
            "fisrtName" => $this->fisrtName,
            "birthDay" => $this->birthDate,
            "recruitmentDate" => $this->recruitmentDate,
            "matricule" => $this->registrationNumber,
            "password" => $this->password,
            "marialStatus" => $this->marialStatus,
            "sex" => $this->sex,
            "userRole" => new RoleResource($this->role),
            "nationality" => new NationalityResource($this->nationality),
            "created_at" => $this->created_at
        ];
    }
}
