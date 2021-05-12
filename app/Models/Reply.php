<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Reply extends Model
{
    use HasFactory, Notifiable;
     protected $guarded=[];

    public function replyUser(){
        return $this->belongsTo(User::class,'user_id');
    }
    public function comment(){
        return $this->belongsTo(Comment::class,'comment_id');
    }

     public function replyReplies(){
        return $this->hasMany(ReplyReply::class,'reply_id')->orderByDesc('created_at');
    }
}