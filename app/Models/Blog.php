<?php

namespace App\Models;

use Illuminate\Database\Query\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Blog extends Model
{
    use HasFactory;
    protected $fillable=['title','image','description','slug','author_description','author_id'];

    public function blogRelatedTables(Builder $query){
        return $query->with('comments.user.profile')->with('comments.replies.replyUser.profile')->with('comments.replies.replyReplies.replyReplyUser.profile')->with('categories')->with('author.profile');
    }

     public function author(){
        return $this->belongsTo(User::class,'author_id');
    }
     public function categories(){
        return $this->belongsToMany(Category::class);
    }
     public function comments(){
        return $this->hasMany(Comment::class,'blog_id')->orderByDesc('created_at');
    }

    public function getRouteKeyName()
{
    return 'slug';
}
}