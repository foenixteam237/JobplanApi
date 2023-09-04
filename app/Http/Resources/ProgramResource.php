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
            'name' => new UserResource($this->user),
            'day' => new DayResource($this->days),
            'hours' => new HourResource($this->hours)
        ];
        /*return [
                'name' => new UserResource($this->whenLoaded('user')),
                'day' => new DayResource($this->whenLoaded('days')),
                'hours' => new HourResource($this->whenLoaded('hours'))
        ];*/
    }
}
