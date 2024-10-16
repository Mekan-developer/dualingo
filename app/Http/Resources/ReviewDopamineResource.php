<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ReviewDopamineResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id"=> $this->id,
            "dopamine1" => $this->getImage1(),
            "dopamine2" => $this->getImage2(),
            "dopamine3" => $this->getImage3(),
            "audio" => $this->getAudio(),
        ];
    }
}
