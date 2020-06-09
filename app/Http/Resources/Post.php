<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Post extends JsonResource
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
            'data' => [
                'post_id' => $this->id,
                'title' => $this->title,
                'caption' => $this->caption,
                'image' => $this->image,
                'last_updated' => $this->updated_at->diffForHumans(),
            ],
            'links' => [
                'self' => $this->path()
            ]
        ];
    }
}
