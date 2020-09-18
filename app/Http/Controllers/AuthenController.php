<?php

namespace App\Http\Controllers;


use Auth;
use Cookie;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthenController extends Controller
{
    public function store(Request $request){

        $reg = new User;
        $reg->name = $request->name; //left from vue ,right from db
        $reg->email = $request->email;
        $reg->password = Hash::make($request->password);
        $reg->save();
        return response()->json($reg);

    }
    public function login(Request $request){


        $request->validate([
            'email'=> 'required',
            'password'=>'required'
        ]);

        // $login = request(['email','password']);


        $user = User::where('email',  '=' , $request->email)->first(); //first email is from user table . 2nd one is given by user
        if($user){
            if(Hash::check($request->password, $user->password )){
                $token = $user->createToken('authToken')->accessToken;
                $cookie = $this->getCookieDetails($token);
                return response()
                    ->json([
                        'logged_in_user' => $user,
                        'token' => $token,
                    ], 200)
                    ->cookie($cookie['name'], $cookie['value'], $cookie['minutes'], $cookie['path'], $cookie['domain'], $cookie['secure'], $cookie['httponly'], $cookie['samesite']);

                // return response(['user'=> $user,'authToken'=>$accessToken]);
            }
            else {
                return response ('Password did not match');
            }
        }
        else {
            return response ('User not found');
        };
    }
    private function getCookieDetails($token)
    {
        return [
            'name' => '_token',
            'value' => $token,
            'minutes' => 1440,
            'path' => null,
            'domain' => null,
            // 'secure' => true, // for production
            'secure' => null, // for localhost
            'httponly' => true,
            'samesite' => true,
        ];
    }
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    public function logout(Request $request)
    {
        $request->user()->token()->revoke();
        $cookie = Cookie::forget('_token');
        return /*response()->json([
            'message' => 'successful-logout'
        ])->*/ redirect('/')->withCookie($cookie);
    }
}
