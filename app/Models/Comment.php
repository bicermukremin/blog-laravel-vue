<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Comment extends Model
{
    use HasFactory, Notifiable;
    protected $guarded=[];

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
    public function blog(){
        return $this->belongsTo(Blog::class,'blog_id');
    }
    public function replies(){
        return $this->hasMany(Reply::class,'comment_id')->orderByDesc('created_at');
    }
}