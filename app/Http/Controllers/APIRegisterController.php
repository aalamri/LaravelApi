<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use JWTFactory;
use JWTAuth;
use Validator;
use Response;

class APIRegisterController extends Controller
{
    public function register(Request $request) {
        $validator = Validator::make($request -> all(),[
            'email'=> 'required|string|email|max:255|unique:user',
            'name'=>'required',
            'password'=>'required'
        ]);

        if($validator -> fails()){
            return response()->json($validator->errors());
        }
        User::create([
            'email'=> $request->get('email'),
            'name'=>$required->get('name'),
            'password'=>bcryt($required->get('password'))
        
        ]);
        $user = User::first();
        $token = JWTAuth::fromUser($user);

        return Response::json(compact('token'));

        }
}
