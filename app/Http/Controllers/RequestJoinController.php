<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\JoinProfRequest;
use App\Models\ReqeustState;
use Illuminate\Support\Facades\Hash;
use App\Models\Role;

class RequestJoinController extends Controller
{
    public function join_us(Request $request){
        $validated = $request->validate([
            'first_name'=>'required',
            'last_name'=>'required',
            'email'=>'required|email|max:255|unique:join_prof_requests',
            'cv' => 'required|mimes:docx,pdf|max:10000',
            'job_title'=>'required',
            "address"=>'required',
            "city"=>'required',
            'country'=>'required',
            'phone'=>'required',
            "image"=>'required|mimes:jpg,png,jpeg',
            "age"=>'required',
        ]);
        $join_us= new JoinProfRequest();

        //upload image
        if($request->hasFile('image'))
        {
            $image = $request->file('image');
            $name = 'image_'.uniqid().'.'. $image->getClientOriginalExtension();
            $destinationPath = public_path('/storage/Prof Profile picture');
            $image->move($destinationPath, $name);
            $join_us->image = $name;
        }

        //upload cv
        if($request->hasFile('cv'))
        {
            $cv = $request->file('cv');
            $name = 'cv_'.uniqid().'.'. $cv->getClientOriginalExtension();
            $destinationPath = public_path('/storage/Prof Cv');
            $cv->move($destinationPath, $name);
            $join_us->cv = $name;
        }

        $join_us->first_name = $request->first_name;
        $join_us->last_name = $request->last_name;
        $join_us->email = $request->email;
        $join_us->job_title = $request->job_title;
        $join_us->address = $request->address;
        $join_us->city= $request->city;
        $join_us->country = $request->country;
        $join_us->phone = $request->phone;
        $join_us->age = $request->age;
        $join_us->save();

        $response = [
            'JoinProfRequest' => $join_us,
        ];
        return response($response, 201);
    }

    public function AcceptProf(Request $request){

            $validated = $request->validate([
                'join_prof_requests_id'=>'required',
            ]);
            $date =Carbon::now();
            $date->toDateTimeString();

            $join_prof_requests = JoinProfRequest::where('join_prof_requests_id',$request->join_prof_requests_id)->first();
            $join_prof_requests->reqeust_states_id = 2;
            $join_prof_requests->save();
            $join_prof_requests_x = JoinProfRequest::where('join_prof_requests_id',$request->join_prof_requests_id)->first();
            $reqeust_states = $join_prof_requests_x->reqeust_states->name;
            // create prof
            $user = new User();
            $user->name = $join_prof_requests->first_name.' '.$join_prof_requests->last_name;
            $user->email = $join_prof_requests->email;
            $user->password = Hash::make('password');
            $user->role_id = 2;
            $user->language_id =2;
            $user->is_online =1;
            $user->duration_connection_minutes =1;
            $user->time_LogOut = $date;
            $user->save();
            $token = $user->createToken('auth_token')->plainTextToken;
            $user_x = User::where('email', $join_prof_requests->email)->first();
            $role = $user_x->role->role_name;
            $response = [
                'join_prof_requests_x'=>$join_prof_requests,
                'reqeust_states'=>$reqeust_states,
                'user' => $user_x,
                'token' => $token,
                'role' => $role,
            ];
            return response($response, 201);

    }

    public function rejected(Request $request){

        $validated = $request->validate([
            'join_prof_requests_id'=>'required',
        ]);
        $date =Carbon::now();
        $date->toDateTimeString();

        $join_prof_requests = JoinProfRequest::where('join_prof_requests_id',$request->join_prof_requests_id)->first();
        $join_prof_requests->reqeust_states_id = 3;
        $join_prof_requests->save();
        $join_prof_requests_x = JoinProfRequest::where('join_prof_requests_id',$request->join_prof_requests_id)->first();
        $reqeust_states = $join_prof_requests_x->reqeust_states->name;

        $response = [
            'join_prof_requests_x'=>$join_prof_requests,
            'reqeust_states'=>$reqeust_states,
        ];

        return response($response, 201);
    }

}



