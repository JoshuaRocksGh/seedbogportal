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
        $username = strtoupper($request->username);
        $password = $request->password;

        $result = DB::selectOne("select my_encrypt('$password','$username') as value from dual");
        $password = $result->value;
       
        $user = User::where(['user_name' => $username, 'passwd' => $password])->first();
        // return $user;
        // return json_encode($user);

        $last_login_date = NOW();

        if ($user != null) {
            User::where(['user_name' => $username, 'passwd' => $password])->update([
                'last_activity_date' => $last_login_date
            ]);
            $api_keys_query = DB::table('tb_bog_orass_api_user')->select('api_username', 'api_password')->first();
            // return $api_keys_query;

            // return $user->name;
            // Auth::login($user);

            Session::put([
                'user_name' => $username,
                'last_login_date' => $last_login_date,
                'email' => $api_keys_query->api_username, 
                'password' => $api_keys_query->api_password
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
