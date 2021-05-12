<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MailResource extends JsonResource
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
            'email'=>$this->email,
            'from'=>$this->from,
            'content'=>$this->content,
            'konu'=>$this->konu,
            'ad_soyad'=>$this->ad_soyad,
            'type'=>$this->type,
        ];
    }
}