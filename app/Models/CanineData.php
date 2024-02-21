<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CanineData extends Model
{
    use HasFactory;
    protected $table = 'Canine_Data'; // for eloquent querying
    public $timestamps = false; // for eloquent querying

    public function InsertDataDB($DataToInsert){
        DB::table("Canine_Data")->insert($DataToInsert);
        /*
        foreach($fileDataArray as $indivData){
            $indivData = explode(",", $indivData);
            //The below code is old, I read the wrong documentation, do not use, it is SLOW
            DB::insert("insert into Canine_Data (DogID, Weight, Date, Hour, Behaviour, Activity_Level, Heart_Rate, Calorie_Burn, Temperature, Food_Intake, Water_Intake, Breathing_Rate, Barking_Frequency) values('". $indivData[0] . "'," . $indivData[1] . "," . $indivData[2] . "," . $indivData[3] . ",'" . $indivData[4] . "'," . $indivData[5] . "," . $indivData[6] . "," . $indivData[7] . "," . $indivData[8] . "," . $indivData[9] . "," . $indivData[10] . "," . $indivData[11] . ",'" . $indivData[12] ."')");
        }
        */
    }

    public function RetrieveData($DogID, $displayAll, $perHour, $perDay){
        if ($perHour == "true" && $displayAll == "false"){
            $canineData = DB::table('Canine_Data')->where('DogID','=', $canineDogDataName)->get();
            $lastID = $canineData->last();
            return $canineData;
        }
        else if ($perDay == "true" && $displayAll == "false"){
            $thisModel = new CanineData();
            $canineData = DB::table('Canine_Data')->where('DogID','=', $canineDogDataName)->get();
            $canineDataAveraged = $thisModel->AverageData($canineData);
            return $canineDataAveraged;
        }
        else if ($perHour == "true" && $displayAll == "true"){
            $canineData = DB::table('Canine_Data')->get();
            return $canineData;
        }
        else if ($perDay == "true" && $displayAll == "true"){
            $thisModel = new CanineData();
            $canineData = DB::table('Canine_Data')->get();
            $canineDataAveraged = $thisModel->AverageData($canineData);
            return $canineDataAveraged;
        }
    }

    public function RetrieveDataDateFiltered($canineDogDataName, $displayAll, $DateMin, $DateMax, $perHour, $perDay){
        if ($perHour == "true" && $displayAll == "false"){
            $canineData = DB::table('Canine_Data')->where('DogID','=', $canineDogDataName)->whereBetween("Date", [$DateMin, $DateMax])->get();
            return $canineData;
        }
        else if ($perDay == "true" && $displayAll == "false"){
            $thisModel = new CanineData();
            $canineData = DB::table('Canine_Data')->where('DogID','=', $canineDogDataName)->whereBetween("Date", [$DateMin, $DateMax])->get();
            $canineDataAveraged = $thisModel->AverageData($canineData);
            return $canineDataAveraged;
        }
        else if ($perHour == "true" && $displayAll == "true"){
            $canineData = DB::table('Canine_Data')->whereBetween("Date", [$DateMin, $DateMax])->get();
            return $canineData;
        }
        else if ($perDay == "true" && $displayAll == "true"){
            $thisModel = new CanineData();
            $canineData = DB::table('Canine_Data')->whereBetween("Date", [$DateMin, $DateMax])->get();
            $DogsPresent = DB::table('Canine_Data')->select("DogID")->distinct()->get();
            $canineDataAveraged = $thisModel->AverageData($canineData, $displayAll);
            return dd($canineDataAveraged);
        }
    }

    public function AverageData($dataToAverage, $displayAll){
        $averageDataArray = [];
        $tempArray = [0,0,0,0,0,0,0,0];
        $DogName = "";
        $Date = "";
        $count = -1;
        for($i = 0; $i < count($dataToAverage); $i){
            if ($DogName != $dataToAverage[$i]->DogID && $Date != $dataToAverage[$i]->Date && $DogName != "" && $Date != ""){
                $count++;
            }
            $DogName = $dataToAverage[$i]->DogID;
            $Date = $dataToAverage[$i]->Date;
            $averagedDataObject = new \stdClass();
            for ($a = $i; $a < $i + 24; $a++){
                if (isset($dataToAverage[$a])){
                    $tempArray[0] += $dataToAverage[$a]->Weight;
                    $tempArray[1] += $dataToAverage[$a]->Activity_Level;
                    $tempArray[2] += $dataToAverage[$a]->Heart_Rate;
                    $tempArray[3] += $dataToAverage[$a]->Calorie_Burn;
                    try{
                        $tempArray[4] += $dataToAverage[$a]->Temperature;
                    }
                    catch(\Error $e){
                        return dd($dataToAverage[$a]);
                    }
                    $tempArray[5] += $dataToAverage[$a]->Food_Intake;
                    $tempArray[6] += $dataToAverage[$a]->Water_Intake;
                    $tempArray[7] += $dataToAverage[$a]->Breathing_Rate;
                }
            }
            if ($displayAll == false){
                $averagedDataObject->CanineID = $dataToAverage[$i]->CanineID;
                $averagedDataObject->OwnerID = $dataToAverage[$i]->OwnerID;
                $averagedDataObject->DogID = $dataToAverage[$i]->DogID;
                $averagedDataObject->Date = $dataToAverage[$i]->Date;
                $averagedDataObject->Weight = $tempArray[0] / 24;
                $averagedDataObject->Activity_Level = $tempArray[1] / 24;
                $averagedDataObject->Heart_Rate = $tempArray[2] / 24;
                $averagedDataObject->Calorie_Burn = $tempArray[3] / 24;
                $averagedDataObject->Temperature = $tempArray[4] / 24;
                $averagedDataObject->Food_Intake = $tempArray[5] / 24;
                $averagedDataObject->Water_Intake = $tempArray[6] / 24;
                $averagedDataObject->Breathing_Rate = $tempArray[7] / 24;
                $averageDataArray[] = $averagedDataObject;
                $tempArray = [0,0,0,0,0,0,0,0];
            }
            else if ($count == 1){
                $averageDataArray[$count]->Weight += $tempArray[0] / 24;
                $averageDataArray[$count]->Activity_Level += $tempArray[1] / 24;
                $averageDataArray[$count]->Heart_Rate += $tempArray[2] / 24;
                $averageDataArray[$count]->Calorie_Burn += $tempArray[3] / 24;
                $averageDataArray[$count]->Temperature += $tempArray[4] / 24;
                $averageDataArray[$count]->Food_Intake += $tempArray[5] / 24;
                $averageDataArray[$count]->Water_Intake += $tempArray[6] / 24;
                $averageDataArray[$count]->Breathing_Rate += $tempArray[7] / 24;
            }
            $i += 24;
        }
        return $averageDataArray;
    }
    //CANINE001 - don't need to average this
    //7.2
    //01-01-2021 - date don't average this
    //0 - hour - don't average
    //Normal
    //427 
    //122 
    //14.3 
    //28.5 
    //0.0
    //2.0
    //29
    //High
}
