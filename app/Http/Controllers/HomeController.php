<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use DB;

class HomeController extends Controller
{

    public function __construct()
    {
      

        if( !Session::has('user_name'))
        {
            return redirect()->route('login');
        }
    }
    //
    public function index()
    {
        $uploaded_returns_count = DB::table('tb_bog_uploaded_returns')->orderByDesc('id')->count();

        return view('home', ['uploaded_returns_count' => $uploaded_returns_count]);
    }
}
