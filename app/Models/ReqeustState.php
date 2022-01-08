<?php

namespace App\Models;

use App\Models\JoinProfRequest;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ReqeustState extends Model
{
    use HasFactory;
    protected $primaryKey="reqeust_states_id";
    public function join_prof_requests(){
        return $this->hasMany(JoinProfRequest::class);
    }
}
