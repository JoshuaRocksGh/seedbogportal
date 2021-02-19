<?php

namespace App\Classes;

use Illuminate\Support\Facades\Http;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AccessTokenGeneration
{
    public function generationToken()
    {


        // GET the AUTH
        // $username =  Auth::user()->email;
        // $password =  Auth::user()->password; // wnt to get the password like so Ab123456. and not the hash

        // GET the AUTH

        if(!Session::has('email') || !Session::has('password')){
            return redirect()->route('login')->with('error', 'Session timeout');
        }

        $username =  Session::get('email');
        $password =  Session::get('password'); // wnt to get the password like so Ab123456. and not the hash

try {

    $response = Http::asForm()->post('https://orassvas.bog.gov.gh:7002/oauth2/token', [
        'grant_type' => 'password',
        'username' =>  $username,
        'password' => $password
        // 'username' => 'bestpoint_api@bestpointgh.com',
        // 'password' => 'Ab123456.'
    ]);

    if ($response->ok()) {
        // return $response->body();
        $res = json_decode($response->body());

        // Decomposing into various variables
        $access_token =  $res->access_token;
        $token_type =  $res->token_type;

        return $access_token;
    }else{
        return view('error', ['message' => 'API SERVER CONNECTION ERROR']);
    }
} catch (\Exception $e) {
    return view('error', ['message' => 'API SERVER CONNECTION ERROR']);
}

    }
}
