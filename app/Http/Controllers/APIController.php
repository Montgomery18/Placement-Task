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
        if (!session()->has("AppData") || $request->newData == "true"){
            session()->forget("AppData");
            session()->forget("AppDataDisplay");
            session()->forget("appName");
            $response = Http::get('https://engineering-task.elancoapps.com/api/applications/' . $request->ApplicationSelect);
            $data = json_decode($response);
            session(["AppData" => $data, "AppDataDisplay" => 0, "appName" => $request->ApplicationSelect]);
            return view('data_page'); // ["appData" => $data, "appName" => $request->ApplicationSelect]);
        }
        else if (isset($request->Nextwhere)){
            $dataNumber = session()->get("AppDataDisplay");
            if ($request->Nextwhere == "forward"){
                if ($dataNumber + $request->NextFive <= count(session()->get("AppData"))){
                    session()->forget("AppDataDisplay");
                    session(["AppDataDisplay" => ($dataNumber + $request->NextFive)]);
                    return view('data_page');
                }
                else{
                    return view('data_page');
                }
            }
            else if ($request->Nextwhere == "backward"){
                if ($dataNumber - $request->NextFive >= 0){
                    session()->forget("AppDataDisplay");
                    session(["AppDataDisplay" => ($dataNumber - $request->NextFive)]);
                    return view('data_page');
                }
                else{
                    return view('data_page');
                }
            }

        }
        else{
            return view('data_page');
        }
    }
}