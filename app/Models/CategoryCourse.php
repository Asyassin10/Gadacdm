<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryCourse extends Model
{
    use HasFactory;
    protected $primaryKey="category_course_id";
    public function courses(){
        return $this->hasMany(Course::class,"course_category_id");
    }
}
