<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;
    protected $fillable=['title','image','description','slug','author_description'];


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