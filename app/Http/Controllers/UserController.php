<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// Includes the pkgs
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Validator;  // use Validator;

class UserController extends Controller
{
    //
    public function registration(Request $req){

        $validation = Validator::make($req->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if($validation->fails()){
            return response()->json($validation->errors(),202);
        }

        $data = $req->all();
        $data['password'] = bcrypt($data['password']);

        $user = User::create($data);

        $result = [];
        $result['token'] = $user->createToken('api-application')->accessToken;
        $result['name'] = $user->name;

        return response()->json($result,200);
    }

    public function login(Request $req){

        if(Auth::attempt([
            'email' => $req->email,
            'password' => $req->password]
            )){
                /** @var \App\Models\User $user **/
                $user = Auth::user();
                $result = [];
                $result['token'] = $user->createToken('api-application')->accessToken;
                $result['name'] = $user->name;

                return response()->json($result,200);
            } else{
                return response()->json(['error' => 'You are stranger'],203);
            }

    }

    public function restapis(){

        return response()->json(['hi' => 'julfikar-islam-khan'],200);

    }
}
