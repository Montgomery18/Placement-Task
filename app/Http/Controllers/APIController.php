<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class APIController extends Controller
{
    public function GetApplicationName(){
        if (!session()->has("ApplicationNames")){ // intially gets the application names for the drop down selection box
            $response = Http::get('https://engineering-task.elancoapps.com/api/applications');
            $applicationNameArray = json_decode($response);
            session(["ApplicationNames" => $applicationNameArray]);
            return view('data_page');
        }
        return view('data_Page');
    }

    public function RetrieveManipulateData(Request $request){
        if (!session()->has("AppData") || $request->newData == "true"){ // gets the data for the specific application
            session()->forget("AppData");
            session()->forget("AppDataDisplay");
            session()->forget("appName");
            $response = Http::get('https://engineering-task.elancoapps.com/api/applications/' . $request->ApplicationSelect);
            $data = json_decode($response);
            session(["AppData" => $data, "AppDataDisplay" => 0, "appName" => $request->ApplicationSelect]);
            return view('data_page');
        }
        else if (isset($request->Nextwhere) && session()->has("AppData") ){ // this is for shifting what data is displayed (a max of 5 pieces of data is shown at a time to the user)
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
        else if (isset($request->ToolSelect) && session()->has("AppData")){ // this is for selecting what tools
            $data = session()->get("AppData");
            if ($request->ToolSelect == "HighestValue"){
                $valarray = [];
                foreach ($data as $value){
                    $valarray[] = $value->Cost;
                }
                return view('data_page', ["toolUsed" => "true", "highVal" => max($valarray)]);
            }
            else if ($request->ToolSelect == "LowestValue"){
                $valarray = [];
                foreach ($data as $value){
                    $valarray[] = $value->Cost;
                }
                return view('data_page', ["toolUsed" => "true", "lowVal" => min($valarray)]);
            }
            else if ($request->ToolSelect == "Average"){
                $average = 0;
                foreach ($data as $value){
                    $average += $value->Cost;
                }
                return view('data_page', ["toolUsed" => "true", "aveVal" => round(($average / count($data)), 4)]);
            }
            else if ($request->ToolSelect == "Range"){
                $valarray = [];
                foreach ($data as $value){
                    $valarray[] = $value->Cost;
                }
                return view('data_page', ["toolUsed" => "true", "range" => round((max($valarray) - min($valarray)), 4)]);
            }
            else{
                return view('data_page');
            }
        }
        else if (isset($request->specific) && session()->has("AppData")){
            $data = session()->get("AppData");
            if (isset($data[$request->specific])){
                return view('data_page', ["specificData" => $data[$request->specific]]);
            }
            else{
                return view('data_page');
            }
        }
        else{
            return view('data_page');
        }
    }
}