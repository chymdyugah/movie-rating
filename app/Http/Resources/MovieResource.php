<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MovieResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $count = $this->votes()->count() * 5;
        if ($count == 0){
            $count = 1;
        }
        $rating = $this->votes()->sum('rating')/$count;
        return [
            'id' => $this->id,
            'name' => $this->name,
            'acts' => $this->acts()->get(),
            'rating' => round($rating, 3),
        ];
    }
}
