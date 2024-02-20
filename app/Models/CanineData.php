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

    public function RetrieveData($DogID, $perHour, $perDay){
        if ($perHour == "true"){
            $canineData = DB::table('Canine_Data')->where('DogID','=', $canineDogDataName)->get();
            $lastID = $canineData->last();
            return $canineData;
        }
        else if ($perDay == "true"){
            $thisModel = new CanineData();
            $canineData = DB::table('Canine_Data')->where('DogID','=', $canineDogDataName)->get();
            $canineDataAveraged = $thisModel->AverageData($canineData);
            return $canineDataAveraged;
        }
    }

    public function RetrieveDataDateFiltered($canineDogDataName, $DateMin, $DateMax, $DateAll, $perHour, $perDay){
        if ($perHour == "true"){
            $canineData = DB::table('Canine_Data')->where('DogID','=', $canineDogDataName)->whereBetween("Date", [$DateMin, $DateMax])->get();
            $lastID = $canineData->last();
            return $canineData;
        }
        else if ($perDay == "true"){
            $thisModel = new CanineData();
            $canineData = DB::table('Canine_Data')->where('DogID','=', $canineDogDataName)->whereBetween("Date", [$DateMin, $DateMax])->get();
            $canineDataAveraged = $thisModel->AverageData($canineData);
            return $canineDataAveraged;
        }
    }

    public function AverageData($dataToAverage){
        $averageDataArray = [];
        for($i = 0; $i < count($dataToAverage); $i){
            $averagedDataObject = new \stdClass();
            $tempArray = [0,0,0,0,0,0,0,0];
            if ($i == 0){
                for ($a = 0; $a < 24; $a++){
                    if (isset($dataToAverage[$a])){
                        $tempArray[0] += $dataToAverage[$a]->Weight;
                        $tempArray[1] += $dataToAverage[$a]->Activity_Level;
                        $tempArray[2] += $dataToAverage[$a]->Heart_Rate;
                        $tempArray[3] += $dataToAverage[$a]->Calorie_Burn;
                        $tempArray[4] += $dataToAverage[$a]->Temperature;
                        $tempArray[5] += $dataToAverage[$a]->Food_Intake;
                        $tempArray[6] += $dataToAverage[$a]->Water_Intake;
                        $tempArray[7] += $dataToAverage[$a]->Breathing_Rate;
                    }
                }
            }
            else{
                for ($a = 0; $a < $i + 24; $a++){
                    if (isset($dataToAverage[$a])){
                        $tempArray[0] = $tempArray[0] + $dataToAverage[$a]->Weight;
                        $tempArray[1] += $dataToAverage[$a]->Activity_Level;
                        $tempArray[2] += $dataToAverage[$a]->Heart_Rate;
                        $tempArray[3] += $dataToAverage[$a]->Calorie_Burn;
                        $tempArray[4] += $dataToAverage[$a]->Temperature;
                        $tempArray[5] += $dataToAverage[$a]->Food_Intake;
                        $tempArray[6] += $dataToAverage[$a]->Water_Intake;
                        $tempArray[7] += $dataToAverage[$a]->Breathing_Rate;
                    }
                }
            }
            $averagedDataObject->CanineID = $dataToAverage[$i]->CanineID; // first time around $IDStartNext is zero
            $averagedDataObject->OwnerID = $dataToAverage[$i]->OwnerID;
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
