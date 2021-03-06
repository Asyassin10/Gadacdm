<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'language_id',
        'is_online',
        'duration_connection_minutes',
        "time_LogOut",
        "role_id",
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function role(){
        return $this->belongsTo(Role::class,"role_id");
    }
    public function blogComments(){
        return $this->hasMany(BlogComment::class,"user_id");
    }
    public function blogLiked(){
        return $this->hasMany(BlogLiked::class,"user_id");
    }
    public function language(){
        return $this->belongsTo(Language::class,"language_id");
    }
    public function student(){
        return $this->hasOne(Student::class,"user_id");
    }
    public function videoComments(){
        return $this->hasMany(VideoComment::class,"user_id");
    }
    public function videoLiked(){
        return $this->hasMany(VideoLiked::class,"user_id");
    }
}
