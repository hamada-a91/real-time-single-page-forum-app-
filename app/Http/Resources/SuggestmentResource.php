<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SuggestmentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'time' => $this->time,
            'date' => $this->date,
            'id' => $this->id,
            'user' => $this->user->name,
            'created_at' => $this->created_at->diffForHumans(),
            'user_id' => $this->user_id,
            'question_slug' => $this->question->slug,
            'agrees' => AgreeResource::collection($this->agrees)->sortBy('id'),
            'disagrees' => DisAgreeResource::collection($this->disagrees)->sortBy('id'),



        ];
    }
}
