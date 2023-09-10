<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProgramResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        
        return[
            'id'=> $this->id,
            'name' => $this->user->name,
            'day' => $this->days->desc,
            'hours' => $this->hours->code
        ];
    }
}
