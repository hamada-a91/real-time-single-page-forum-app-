<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AgreeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        //  dd($this);
        return [
            'id' => $this->id,
            'user' => $this->user->name,
            'user_id' => auth()->id()


        ];
    }
}
