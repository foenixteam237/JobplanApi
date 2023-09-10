<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PlanningResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $userResource = new UserResource($this->users);
        $monthResource = $this->months->desc;
        $programResources = ProgramResource::collection($this->programs);

        return [
            "createdBy" => $userResource->name,
            "year" => $this->year,
            "month" => $monthResource,
            "week" => $this->week,
            "status" => $this->status,
            "programs" =>  $programResources,
            "createat" => $this->created_at
        ];
    }
}
