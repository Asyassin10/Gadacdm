<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JoinProfRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'state_requests',
        'cv',
        'job_title',
        "address",
        "city",
        'country',
        'phone',
        "image",
        "age",
    ];
}
