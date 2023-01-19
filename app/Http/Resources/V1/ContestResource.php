<?php

namespace App\Http\Resources\V1;

use App\Models\Participant;
use Illuminate\Http\Resources\Json\JsonResource;

class ContestResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'prize' => $this->prize,
            'description' => $this->description,
            'duration' => $this->duration,
            'is_finished' => $this->is_finished,
            'participants' => ParticipantResource::collection($this->whenLoaded('participants'))
        ];
    }
}
