<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    // sing in funtion
    public function postSignIn (Request $request)
    {
        $this->validate($request, [
            'email' => 'required',
            'password' => 'required',
        ]);
        if(Auth::attempt(['email' => $request['email'], 'password' => $request['password']])) {
            return redirect()->route('dashboard');
        }else{
            return redirect()->back();
        }
    }

    // sing up funtion
    public function postSignUp(Request $request)
    {
        $this->validate($request, [
            'email' => 'email|required|unique:users',
            'firstname' => 'required|max:200',
            'password' => 'required|min:4',
        ]);

        $first_name = $request['firstname'];
        $email      = $request['email'];
        $password   = bcrypt($request['password']);

        $user       = new User();

        $user->email = $email;
        $user->firstname = $first_name;
        $user->password = $password;

        $user->save();

        // login user
        Auth::login($user);

        return redirect()->route('dashboard');

    }

    public  function getLogout ()
    {
        Auth::logout();
        return redirect()->route('home');
    }
}
