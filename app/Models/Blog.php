<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;
    protected $primaryKey="blog_id";
    public function blogComments(){
        return $this->hasMany(BlogComment::class,"blog_id");
    }
    public function blogLiked(){
        return $this->hasMany(BlogLiked::class,"blog_id");
    }
}
