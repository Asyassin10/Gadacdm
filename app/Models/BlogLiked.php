<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogLiked extends Model
{
    use HasFactory;
    protected $primaryKey="blog_liked_id";
    public function blog(){
        return $this->belongsTo(Blog::class,"blog_id");
    }
    public function user(){
        return $this->belongsTo(user::class);
    }
}
