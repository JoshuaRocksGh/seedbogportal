<?php

namespace App\Http\Controllers;

use App\Classes\AccessTokenGeneration;
use App\Classes\ReturnsData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Throwable;
use Illuminate\Support\Facades\Session;

class ReturnsController extends Controller
{

    //
    public function search_by_revision_id(Request $request)
    {


        if (!$request->exists('revision_id')) {

            return back();
        }

        $revision_id = $request->query('revision_id');
        $url = "https://orassvas.bog.gov.gh:7002/v1/returns/$revision_id";


        $tokenization = new AccessTokenGeneration();
        $access_token = $tokenization->generationToken();

        try {
            // Validate the value...

            $response = Http::withToken($access_token)->get($url);


            if ($response->ok()) {
                // return $response;
                // $res = json_decode($response->body());
                $returns = $response->json();
                // return $returns['data'];

                return view('returns.search_return', [
                    'return' => $returns['data'],
                    'revision_id' => $revision_id,
                    'total' => '19020',
                ]);
            } else {
                return view('error', ['message' => 'API SERVER CONNECTION ERROR']);
            }
        } catch (Throwable $e) {
            // report($e);

            return view('error', ['message' => 'API SERVER CONNECTION ERROR']);
        }
    }



    public function index(Request $request)
    {
        $page = $request->query('page');

        // return Auth::user();


        // $data = new ReturnsData();
        // $returns = $data->returns();
        // // return $returns;
        // return view('returns.index', [
        //     'john' => $returns,
        //     'total' => '19020',
        // ]);

        $tokenization = new AccessTokenGeneration();
        $access_token = $tokenization->generationToken();

        try {
            // Validate the value...

            $response = Http::withToken($access_token)->get("https://orassvas.bog.gov.gh:7002/v1/returns?page=$page");


            if ($response->ok()) {
                // return $response;
                // $res = json_decode($response->body());
                $returns = json_decode($response->body());
                // return $returns;


                $all_return_count = count($returns->data);

                Session::put([
                    'all_return_count' => $all_return_count
                ]);

                return view('returns.index', [
                    'john' => $response,
                    'total' => '19020',
                ]);
            } else {
                return view('error', ['message' => 'API SERVER CONNECTION ERROR']);
            }
        } catch (\Exception $e) {
            // report($e);

            return view('error', ['message' => 'API SERVER CONNECTION ERROR']);
        }
    }
}
