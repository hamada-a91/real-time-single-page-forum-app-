<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class QuestionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request) // ich will die bestimmte Resourse zeigen
    {
        return [
            'title' => $this->title,
            'path' => $this->path,
            'body' => $this->body,
            'created_at' => $this->created_at->diffForHumans(),
            'replies' => ReplyResource::collection($this->replies),
            'suggestments' => SuggestmentResource::collection($this->suggestments),
            'reply_count' => $this->replies->count(),
            'user' => $this->user->name,
            'id' => $this->id,
            'user_id' => $this->user_id,
            'slug' => $this->slug,
            'askdate' => $this->askdate,
            'asktime' => $this->asktime,






        ];
    }
}
