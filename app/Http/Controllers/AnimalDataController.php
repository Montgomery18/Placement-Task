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
                    $indivData[$i] = 0;
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
                "Barking_Frequency" => str_replace("\r", "", $indivData[12]) // gets rid of the /r on the end of this piece of data
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

    public function GetUsersDogs($ownerID){
        $canineData = new canineData;
        $dogs = $canineData->GetDogs($ownerID);
        return $dogs;
    }

    public function ProfilePageManage(Request $form){
        if ($form->input('FormType') == "SelectDog"){
            if (session()->get("SelectedDog") !== null){
                session(["SelectedDog" => $form->input('Select')]);
            }
            else{
                session()->forget("SelectedDog");
                session(["SelectedDog" => $form->input('Select')]);
            }
            $thisController = new AnimalDataController();
            $canineData = new CanineData();
            $usersDog = $thisController->GetUsersDogs(session()->get("AccountID"));
            $behavAndBark = $thisController->GetBehaviourAndBark($form->input('Select'));
            $profileData = $canineData->RetrieveProfileAverageData(session()->get("SelectedDog"), "All", "All");
            return view("/Profile", ["DogID" => $usersDog, "Data" => $profileData, "BehavAndBarkList" => $behavAndBark]);
        }
        else if ($form->input('FormType') == "Averages"){
            $thisController = new AnimalDataController();
            $canineData = new CanineData();
            $usersDog = $thisController->GetUsersDogs(session()->get("AccountID"));
            $behavAndBark = $thisController->GetBehaviourAndBark($form->input("DogID"));
            $average = $canineData->RetrieveProfileAverageData($form->input("DogID"), $form->input("Behaviour"), $form->input("BarkingFrequency"));
            return view("/Profile", ["DogID" => $usersDog, "Data" => $average, "Behaviour" => $form->input("Behaviour"), "BarkingFrequency" => $form->input("BarkingFrequency"), "BehavAndBarkList" => $behavAndBark]);
        }
    }
    
    public function DisplayData($DogID, $displayAll, $startDate, $endDate){
        // Don't believe this requires SQLinjection, its the intial display of data
        $canineData = new canineData();
        $canineDataRetrieved = $canineData->RetrieveDataTrends($DogID, $displayAll, $startDate, $endDate);
        return $canineDataRetrieved;
    }

    public function DisplayDataRangeFiltered(Request $request){
        // write SQLinjection protection here - Might not need due to preselected options on trends
        $canineData = new canineData();
        if ($request->input('DateMax') != null){
            $canineDataRetrieved = $canineData->RetrieveDataDateFilteredTrends($request->input('DogID'), $request->input('DisplayAll'), $request->input('DateMin'), $request->input('DateMax'));
        }
        else{
            $canineDataRetrieved = $canineData->RetrieveDataDateFilteredTrends($request->input('DogID'), $request->input('DisplayAll'), $request->input('DateMin'), null);
        }
        return view($request->input('page'), ["data" => $canineDataRetrieved[0], "SummedData" => $canineDataRetrieved[1], "DogID" => $request->input("DogID")]);
    }

    public function profileAverage($dogID){
        $canineData = new canineData();
        return $canineData->RetrieveProfileAverageData($dogID, "All", "All");
    }

    public function GetBehaviourAndBark($dogID){
        $canineData = new canineData();
        return $canineData->BehavioursAndBarkFreq($dogID);
    }
}
