<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReplyReply extends Model
{
    use HasFactory;
     protected $guarded=[];

    public function replyReplyUser(){
        return $this->belongsTo(User::class,'user_id');
    }
    public function reply(){
        return $this->belongsTo(Reply::class,'reply_id');
    }
}