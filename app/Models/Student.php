<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    protected $primaryKey ="student_id";
    public function user(){
        return $this->belongsTo(User::class,"user_id");
    }
    public function courses(){
        return $this->belongsToMany(Course::class,"student_courses","course_id","student_id");
    }
}
