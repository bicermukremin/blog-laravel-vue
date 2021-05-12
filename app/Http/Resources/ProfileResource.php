<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProfileResource extends JsonResource
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
            'avatar'=>$this->avatar,
            'about'=>$this->about,
            'facebook'=>$this->facebook,
            'twitter'=>$this->twitter,
            'instagram'=>$this->instagram,
            'linkedIn'=>$this->linkedIn,
            'youtube'=>$this->youtube,
            'user'=>new UserResource($this->user),
            
        ];
      
    }
}