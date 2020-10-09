<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ReplyResource extends JsonResource
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
            'reply' => $this->body,
            'id' => $this->id,
            'user' => $this->user->name,
            'created_at' => $this->created_at->diffForHumans(),
            'user_id' => $this->user_id,
            'question_slug' => $this->question->slug,
            'like_count' => $this->like->count(),
            'liked' => $this->like->where('user_id', auth()->id())->count(),



        ];
    }
}
