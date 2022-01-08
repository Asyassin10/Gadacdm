<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JoinProfRequest;

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


}
