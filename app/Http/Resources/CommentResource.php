<?php

namespace App\Http\Resources;

use Jenssegers\Date\Date;
use Illuminate\Http\Resources\Json\JsonResource;

class CommentResource extends JsonResource
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
            'like'=>$this->like,
            'dislike'=>$this->dislike,
            'description'=>$this->description,
            'created_at'=>$this->created_at,
            'user'=>new UserResource($this->user),
            /* 'blog'=>new BlogResource($this->blog), */
            'replies'=>ReplyResource::collection($this->replies)
        ];
    }
}