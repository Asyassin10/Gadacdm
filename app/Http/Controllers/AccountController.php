<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterProfRequest;
use App\Http\Requests\RegisterStudentRequest;
use App\Models\JoinProfRequest;
use App\Models\Role;
use App\Models\User;
use App\Services\AuthenticationServices;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AccountController extends Controller
{
    //Login
    public function Login(Request $request){

        $validated = $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $user = User::where('email',$request->email)->first();
        if(!$user){
            return response()->json(["message"=>"cet email n'existe pas ou n'est pas correct"]);
        }else if($user){
            if(!Hash::check($request->password,$user->password)){
                return response()->json(["message"=>"password n'est pas correct"]);
            }else{
                $token = $user->createToken('myapp')->plainTextToken;
                $response = [
                    'user' =>$user,
                    'token'=>$token,
                    "role"=>$user->role->role_name
                ];
                return response($response);
            }
        }
    }

    // create student
    public function RegisterStudent(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required' ,
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required',
        ]);
        $date =Carbon::now();
        $date->toDateTimeString();
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => 1,
            'language_id' => 1,
            'is_online' => 1,
            'duration_connection_minutes' => 1,
            'time_LogOut' => $date,
        ]);

        $user->save();
        $token = $user->createToken('auth_token')->plainTextToken;
        $user_x = User::where('email', $request->email)->first();
        $role=$user_x->role->role_name;

        $response = [
            'user' => $user_x,
            'token' => $token,
            'role' => $role,
        ];

        return response($response, 201);
    }

    //create Prof
    public function RegisterProf(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required' ,
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required',
        ]);
        $date =Carbon::now();
        $date->toDateTimeString();
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => 2,
            'language_id' => 1,
            'is_online' => 1,
            'duration_connection_minutes' => 1,
            'time_LogOut' => $date,
        ]);

        $user->save();
        $token = $user->createToken('auth_token')->plainTextToken;
        $user_x = User::where('email', $request->email)->first();
        $role=$user_x->role->role_name;

        $response = [
            'user' => $user_x,
            'token' => $token,
            'role' => $role,
        ];

        return response($response, 201);
    }

    //Logout
    public function LogOut(Request $request)
    {

        $request->validate([
            "id_user"=>"required|numeric"
        ]);
        $user = User::where('id',$request->id_user);
        $date =Carbon::now();
        $date->toDateTimeString();
        $date_duration_minute = $date->diffInMinutes($user->time_Login);
        $user->is_online = 0;
        $user->time_LogOut = $date;
        $user->duration_connection_minutes = $date_duration_minute;
        $user->save();
        $request->user()->currentAccessToken()->delete();
        return ['msg' => 'Successfully logged out'];
    }

  
}
