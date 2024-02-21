<?php

namespace App\Http\Controllers;

use App\Models\CanineData;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class AnimalDataController extends Controller
{
    public function FileDBWrite(){
        $fileData = Storage::get('activityData.csv');
        $fileDataArray = explode("\n", $fileData);
        array_splice($fileDataArray, 0, 1);
        $canineData = new CanineData;
        $arrayInsert = [];
        $count = 0;
        foreach($fileDataArray as $indivData){
            if($count > 500){
                $canineData->InsertDataDB($arrayInsert);
                $arrayInsert = array();
                $count = 0;
            }
            $indivData = explode(",", $indivData);
            $dateArray = explode("-", $indivData[2]);
            $date = ($dateArray[2] . "-" . $dateArray[1] . "-" . $dateArray[0]);
            $i = 0;
            foreach($indivData as $attribute){
                if ($attribute == null){
                    $indivData[$i];
                }
                $i++;
            }
            $arrayInsertSub = [
                "DogID" => $indivData[0],
                "Weight" => $indivData[1],
                "Date" => $date,
                "Hour" => $indivData[3],
                "Behaviour" => $indivData[4],
                "Activity_Level" => $indivData[5],
                "Heart_Rate" => $indivData[6],
                "Calorie_Burn" => $indivData[7],
                "Temperature" => $indivData[8],
                "Food_Intake" => $indivData[9],
                "Water_Intake" => $indivData[10],
                "Breathing_Rate" => $indivData[11],
                "Barking_Frequency" => $indivData[12]
            ];
            $arrayInsert[] = $arrayInsertSub;
            $count = $count + 1;
        }

        /* - Eloquent method - to slow
        foreach($fileDataArray as $indivData){
            $canineData = new CanineData;
            $indivData = explode(",", $indivData);
            $canineData->DogID = $indivData[0];
            $canineData->Weight = $indivData[1];
            $canineData->Date = $indivData[2];
            $canineData->Hour = $indivData[3];
            $canineData->Behaviour = $indivData[4];
            $canineData->Activity_Level = $indivData[5];
            $canineData->Heart_Rate = $indivData[6];
            $canineData->Calorie_Burn = $indivData[7];
            $canineData->Temperature = $indivData[8];
            $canineData->Food_Intake = $indivData[9];
            $canineData->Water_Intake = $indivData[10];
            $canineData->Breathing_Rate = $indivData[11];
            $canineData->Barking_Frequency = $indivData[12];
            $canineData->save();
        }
        */
    }
    public function DisplayData($DogID, $displayAll ,$HourMode, $DayMode){
        // Don't believe this requires SQLinjection, its the intial display of data
        $canineData = new canineData;
        $canineDataRetrieved = $canineData->RetrieveData($DogID, $displayAll, $HourMode, $DayMode);
        return $canineDataRetrieved;
    }

    public function DisplayDataRangeFiltered(Request $request){
        // write SQLinjection protection here - Might not need due to preselected options on trends
        $canineData = new canineData;
        if ($request->input('DateMax') != null){
            $canineDataRetrieved = $canineData->RetrieveDataDateFiltered($request->input('DogID'), $request->input('DisplayAll'), $request->input('DateMin'), $request->input('DateMax'));
        }
        else{
            $canineDataRetrieved = $canineData->RetrieveDataDateFiltered($request->input('DogID'), $request->input('DisplayAll'), $request->input('DateMin'), null);
        }
        return view($request->input('page'), ["data" => $canineDataRetrieved]);
    }
}
