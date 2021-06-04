<?php

namespace App\Http\Controllers;

use App\Classes\AccessTokenGeneration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;

class UploadController extends Controller
{



    function index(Request $request)
    {

        // return  Auth::user();


        // return $request;
        $revisionId = $request->query('revisionId');
        $returnTypeId = $request->query('returnTypeId');
        $return_id = $request->query('return_id');
        $return_name = $request->query('return_name');
        $return_reference = $request->query('return_reference');
        $return_endDate = $request->query('return_endDate');
        $return_status = $request->query('return_status');

        // return $return_id;

        return view('returns.upload', [
            'revisionId' => $revisionId,
            'returnTypeId' => $returnTypeId,
            'return_id' => $return_id,
            'return_name' => $return_name,
            'return_reference' => $return_reference,
            'return_endDate' => $return_endDate,
            'return_status' => $return_status,
        ]);
    }

    function uploaded_returns()
    {


        $uploaded_returns = DB::table('tb_bog_uploaded_returns')->orderByDesc('id')->get();

        // return $uploaded_returns;

        return view('returns.uploaded_returns', ['uploaded_returns' => $uploaded_returns]);
    }

    function download_return($filename)
    {

        $filename = $filename;

        return response()->download(public_path('uploads/returns/' . $filename));
    }





    function post_upload(Request $request)
    {
        // return Session::get('email') ;

        if (!Session::has('email') || !Session::has('password')) {
            return redirect()->route('login')->with('error', 'Session timeout');
        }

        // return $request;

        $validator = Validator::make($request->all(), [

            'clearData' =>  'required',
            'returnTypeId' =>  'required',
            'revisionId' =>  'required',
            'return_id' =>  'required',
            'return_name' =>  'required',
            'return_reference' =>  'required',
            'return_endDate' =>  'required',
            'return_status' =>  'required',
            'file' =>  'required | file | mimes:xlsx',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }


        $revisionId = $request->revisionId;
        $returnTypeId = $request->returnTypeId;
        $clearData = $request->clearData;
        $return_id = $request->return_id;
        $return_name = $request->return_name;
        $return_reference = $request->return_reference;
        $return_endDate = $request->return_endDate;
        $return_status = $request->return_status;

        $file = $request->file('file');

        // return $file;


        // GET FILE NAME AND EXTENTION
        $extension = $request->file->getClientOriginalExtension();
        // return $extension;
        $filename = 'upload-' . time() . "." . $extension;
        // return $filename;


        // $request->file->storeAs('public/returns', $filename);
        $request->file->move(public_path('uploads/returns'), $filename);


        $file = "http://localhost/seedbog/public" . '/uploads/returns/' . $filename;
        // return $file;


        // $insert_query = DB::table('tb_bog_upload_returns')
        //     ->insert([
        //         'revision_id' => $revisionId,
        //         'return_type_id' => $returnTypeId,
        //         'clear_data' => $clearData,
        //         'filename' => $filename
        //     ]);

        // return 'true';

        $tokenization = new AccessTokenGeneration();


        $access_token = $tokenization->generationToken();
        // return $access_token;

        $file = fopen($file, 'r');

        try {
            $response = Http::attach(
                'file',
                $file,
                $filename
            )->withToken($access_token)
                ->post("https://orassvas.bog.gov.gh:7002/v1/retur/$revisionId/submit/$returnTypeId/upload/$clearData");


            if ($response->ok()) {


                $insert_query = DB::table('tb_bog_uploaded_returns')
                    ->insert([
                        'revision_id' => $revisionId,
                        'return_type_id' => $returnTypeId,
                        'clear_data' => $clearData,
                        'return_id' => $return_id,
                        'return_name' => $return_name,
                        'return_reference' => $return_reference,
                        'return_endDate' => $return_endDate,
                        'return_status' => $return_status
                    ]);


                // $res = json_decode($response->body());
                // $returns = json_decode($response->body());
                // return $returns;

                return redirect()->route('uploaded-returns');
            } else {
                return view('error', ['message' => 'API SERVER CONNECTION ERROR']);
                // return "Error";
            }
        } catch (\Exception $th) {
            return view('error', ['message' => 'API SERVER CONNECTION ERROR']);
        }
    }
}
