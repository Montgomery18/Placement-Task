<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class APIController extends Controller
{
    public function GetApplicationName(){
        if (!session()->has("ApplicationNames")){
            $response = Http::get('https://engineering-task.elancoapps.com/api/applications');
            $applicationNameArray = json_decode($response);
            session(["ApplicationNames" => $applicationNameArray]);
        }
        return view('data_Page');
    }

    public function RetrieveData(Request $request){
       $response = Http::get('https://engineering-task.elancoapps.com/api/applications/' . $request->ApplicationSelect);
       $data = json_decode($response);
       return view('data_page', ["appData" => $data, "appName" => $request->ApplicationSelect]);
    }
}
