<?php

namespace App\Http\Resources;

use Jenssegers\Date\Date;
use Illuminate\Http\Resources\Json\JsonResource;

class ReplyReplyResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
         Date::setLocale('tr');
       
        $date=$this->created_at;
         return [
            'id'=>$this->id,
            'like'=>$this->like,
            'dislike'=>$this->dislike,
            'description'=>$this->description,
            'fromNow'=>$date->diffForHumans(),
            'createdAt'=>$date->isoFormat('DD MMMM YYYY'),
            'user'=>new UserResource($this->replyReplyUser),
            /* 'comment'=>new CommentResource($this->comment) */
        ];
    }
}