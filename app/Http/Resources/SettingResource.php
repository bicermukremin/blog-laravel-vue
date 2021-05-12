<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SettingResource extends JsonResource
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
            'map'=>$this->map,
            'facebook'=>$this->facebook,
            'twitter'=>$this->twitter,
            'instagram'=>$this->instagram,
            'linkedIn'=>$this->linkedIn,
            'github'=>$this->github,
            'tel'=>$this->tel,
            'email'=>$this->email,
            'adres'=>$this->adres,
            'logo1'=>$this->logo1,
            'logo2'=>$this->logo2,
            
        ];
    }
}