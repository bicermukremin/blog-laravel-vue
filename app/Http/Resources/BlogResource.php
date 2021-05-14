<?php

namespace App\Http\Resources;

use DateTimeZone;
use Carbon\Carbon;
use Jenssegers\Date\Date;
use Illuminate\Http\Resources\Json\JsonResource;

class BlogResource extends JsonResource
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
            'title'=>$this->title,
            'image'=>$this->image,
            'slug'=>$this->slug,
            'description'=>$this->description,
            'author_description'=>$this->author_description,
            'fromNow'=>$date->diffForHumans(),
            'createdAt'=>$date->isoFormat('DD MMMM YYYY'),
            'author'=>new UserResource($this->author),
            'comments'=>CommentResource::collection($this->comments),
            'categories'=>CategoryResource::collection($this->categories),
            
            
        ];
    }
}