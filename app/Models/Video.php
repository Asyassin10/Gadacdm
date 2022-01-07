<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use HasFactory;
    protected $primaryKey="video_id";
    public function course(){
        return $this->belongsTo(Course::class,"course_id");
    }
    public function videoComments(){
        return $this->hasMany(VideoComment::class,"video_id");
    }
}
