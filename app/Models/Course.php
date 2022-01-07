<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;
    protected $primaryKey="course_id";
    public function category(){
        return $this->belongsTo(CategoryCourse::class,"course_category_id");
    }
    public function feedBacks(){
        return $this->hasMany(CourseFeedback::class,"course_id");
    }
    public function students(){
        return $this->belongsToMany(Student::class,"student_courses","student_id","course_id");
    }
    public function videos(){
        return $this->hasMany(Video::class,"course_id");
    }

}
