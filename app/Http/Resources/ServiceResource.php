<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ServiceResource extends JsonResource
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
            'id'=>$this->id,
            'title'=>$this->title,
            'items'=>json_decode($this->items),
            'images'=>json_decode($this->images),
            'content'=>$this->content,
            'slug'=>$this->slug,
            'projects'=>ProjectResource::collection($this->whenLoaded('projects')),
        ];
    }
}