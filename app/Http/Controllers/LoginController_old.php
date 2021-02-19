<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Validator;
use DB;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{

    use AuthenticatesUsers;

    public function index()
    {

        return view('login.login');
    }


    public function post_login(Request $request)
    {

        $validator = Validator::make($request->all(), [

            'username' =>  'required',
            'password' =>  'required',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        // return $request;
        $username = $request->username;
        $password = $request->password;

        $user = User::where(['email' => $username, 'password' => $password])->first();

        return json_encode($user);

        if ($user != null) {
            // return $user->name;
            // Auth::login($user);

            Session::put([
                'email' => $user->api_username,
                'password' => $user->api_password
            ]);

            // session([
            //     'email' => $user->email,
            //     'password' => $user->password
            // ]);

            // return session('email');
            // return Auth::user()->email;
            return redirect()->route('home');
        } else {
            return back()->with('error', 'incorrect credentials');
        }
    }


    public function logout()
    {

        Session::flush();

        Auth::logout();

        // session()->forget('user');

        // if (!(session()->has('user'))) {
        //     return redirect()->route('login');
        // }

        return redirect()->route('login');
    }
}
