<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VideoComment extends Model
{
    use HasFactory;
    protected $primaryKey="video_comment_id";
    public function video(){
        return $this->belongsTo(Video::class,"video_id");
    }
    public function user(){
        return $this->belongsTo(User::class,"user_id");
    }
}