<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AboutResource extends JsonResource
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
            'images'=>$this->images,
            'description'=>$this->description,
            'mission'=>$this->mission,
            'vision'=>$this->vision,
            'history_content'=>$this->history_content,
            'history_items'=>$this->history_items,
            'active'=>$this->active,
        ];
    }
}