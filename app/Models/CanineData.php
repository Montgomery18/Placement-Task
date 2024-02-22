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

    // THIS INSERTS THE CSV INTO THE DB
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
    // THIS INSERTS THE CSV INTO THE DB

    // THIS GETS DATA FOR CHARTS
    public function RetrieveDataTrends($DogID, $displayAll, $startDateHour, $endDateHour){
        if ($startDateHour != null && $displayAll == "false"){
            $thisModel = new CanineData();
            $canineData = DB::table('Canine_Data')->where('DogID','=', $DogID)->whereBetween('Date', [$startDateHour, $endDateHour])->get();
            $canineDataAveraged = $thisModel->ChartAverageData($canineData, $displayAll);
            return $canineDataAveraged;
        }
        else if ($startDateHour != null && $displayAll == "true"){
            $thisModel = new CanineData();
            $canineData = DB::table('Canine_Data')->whereBetween('Date', [$startDateHour, $endDateHour])->get();
            $canineDataAveraged = $thisModel->ChartAverageData($canineData, $displayAll);
            return $canineDataAveraged;
        }
    }

    public function RetrieveDataDateFilteredTrends($canineDogDataName, $displayAll, $dateMin, $dateMax){
        if ($dateMax == null && $displayAll == "false"){
            $canineData = DB::table('Canine_Data')->where('DogID','=', $canineDogDataName)->whereBetween("Date", [$dateMin, $dateMin])->get();
            return $canineData;
        }
        else if ($dateMax != null && $displayAll == "false"){
            $thisModel = new CanineData();
            $canineData = DB::table('Canine_Data')->where('DogID','=', $canineDogDataName)->whereBetween("Date", [$dateMin, $dateMax])->get();
            $canineDataAveraged = $thisModel->ChartAverageData($canineData, $displayAll);
            return $canineDataAveraged;
        }
        else if ($dateMax != null && $displayAll == "true"){
            $thisModel = new CanineData();
            $canineData = DB::table('Canine_Data')->whereBetween("Date", [$dateMin, $dateMax])->get();
            $canineDataAveraged = $thisModel->ChartAverageData($canineData, $displayAll);
            return $canineDataAveraged;
        }
    }

    public function ChartAverageData($dataToAverage, $displayAll){
        $array = [];
        $DogName = "";
        $Date = "";
        $UsedDates = "";
        for($i = 0; $i < count($dataToAverage); $i++){
            $object = new \stdClass();
            if ($displayAll == "false"){
                if ($Date != $dataToAverage[$i]->Date || $DogName == "" || $Date == ""){
                    $DogName = $dataToAverage[$i]->DogID;
                    $Date = $dataToAverage[$i]->Date;
                    $object->DogName = $DogName;
                    $object->Date = $Date;
                    $array[] = $object;
                }
            }
            else{
                if ($Date != $dataToAverage[$i]->Date && $UsedDates != $dataToAverage[$i]->Date || $Date == ""){
                    $UsedDates = $Date;
                    $Date = $dataToAverage[$i]->Date;
                    $object->Date = $Date;
                    $array[] = $object;
                }
            }
        }

        $averageDataArray = [];
        for($i = 0; $i < count($array); $i++){
            $averagedDataObject = new \stdClass();
            $tempArray = [0,0,0,0,0,0,0,0];
            for ($a = 0; $a < count($dataToAverage); $a++){
                if ($displayAll == "false"){
                    if ($dataToAverage[$a]->DogID == $array[$i]->DogName && $dataToAverage[$a]->Date == $array[$i]->Date){
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
                else{
                    if ($dataToAverage[$a]->Date == $array[$i]->Date){
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
            if ($displayAll == "false"){
                //$averagedDataObject->CanineID = 
                //$averagedDataObject->OwnerID = 
                $averagedDataObject->DogID = $array[$i]->DogName;
                $averagedDataObject->Date = $array[$i]->Date;
                $averagedDataObject->Weight = $tempArray[0] / 24;
                $averagedDataObject->Activity_Level = $tempArray[1] / 24;
                $averagedDataObject->Heart_Rate = $tempArray[2] / 24;
                $averagedDataObject->Calorie_Burn = $tempArray[3] / 24;
                $averagedDataObject->Temperature = $tempArray[4] / 24;
                $averagedDataObject->Food_Intake = $tempArray[5] / 24;
                $averagedDataObject->Water_Intake = $tempArray[6] / 24;
                $averagedDataObject->Breathing_Rate = $tempArray[7] / 24;
                $averageDataArray[] = $averagedDataObject;
            }
            else{
                //$averagedDataObject->CanineID =
                //$averagedDataObject->OwnerID =
                $averagedDataObject->Date = $array[$i]->Date;
                $averagedDataObject->Weight = $tempArray[0] / 72;
                $averagedDataObject->Activity_Level = $tempArray[1] / 72;
                $averagedDataObject->Heart_Rate = $tempArray[2] / 72;
                $averagedDataObject->Calorie_Burn = $tempArray[3] / 72;
                $averagedDataObject->Temperature = $tempArray[4] / 72;
                $averagedDataObject->Food_Intake = $tempArray[5] / 72;
                $averagedDataObject->Water_Intake = $tempArray[6] / 72;
                $averagedDataObject->Breathing_Rate = $tempArray[7] / 72;
                $averageDataArray[] = $averagedDataObject;
            }
        }
        return($averageDataArray);
        
        /*
        $averageDataArray = [];
        $DogName = "";
        $Date = "";
        $count = -1;
        for($i = 0; $i < count($dataToAverage); $i){
            if ($displayAll == true){
                if ($DogName != $dataToAverage[$i]->DogID && $DogName != ""){
                    $count++;
                }
                else if ($Date == $dataToAverage[$i]->Date && $Date != ""){
                    $count--;
                }
                $DogName = $dataToAverage[$i]->DogID;
                $Date = $dataToAverage[$i]->Date;
            }
            $averagedDataObject = new \stdClass();
            $tempArray = [0,0,0,0,0,0,0,0];
            for ($a = $dataToAverage[$i]->CanineID; $a < $dataToAverage[24]->CanineID * 2; $a++){ // goes over this one to many times
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
                dd($tempArray);
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
            }
            else if ($displayAll == true){
                if ($count >= 0){
                    if ($i > 24 * 2){
                        dd($averageDataArray);
                    }
                    $averageDataArray[$count]->Weight += $tempArray[0];
                    $averageDataArray[$count]->Activity_Level += $tempArray[1];
                    $averageDataArray[$count]->Heart_Rate += $tempArray[2];
                    $averageDataArray[$count]->Calorie_Burn += $tempArray[3];
                    $averageDataArray[$count]->Temperature += $tempArray[4];
                    $averageDataArray[$count]->Food_Intake += $tempArray[5];
                    $averageDataArray[$count]->Water_Intake += $tempArray[6];
                    $averageDataArray[$count]->Breathing_Rate += $tempArray[7];
                    if ($i > 24 * 3){
                        dd($averageDataArray);
                    }
                }
                else{
                    $averagedDataObject->CanineID = $dataToAverage[$i]->CanineID;
                    $averagedDataObject->OwnerID = $dataToAverage[$i]->OwnerID;
                    $averagedDataObject->DogID = $dataToAverage[$i]->DogID;
                    $averagedDataObject->Date = $dataToAverage[$i]->Date;
                    $averagedDataObject->Weight = $tempArray[0];
                    $averagedDataObject->Activity_Level = $tempArray[1];
                    $averagedDataObject->Heart_Rate = $tempArray[2];
                    $averagedDataObject->Calorie_Burn = $tempArray[3];
                    $averagedDataObject->Temperature = $tempArray[4];
                    $averagedDataObject->Food_Intake = $tempArray[5];
                    $averagedDataObject->Water_Intake = $tempArray[6];
                    $averagedDataObject->Breathing_Rate = $tempArray[7];
                    $averageDataArray[] = $averagedDataObject;
                }
            }
            $i += 24;
        }
        return dd($averageDataArray);
        */
    }
    // THIS GETS DATA FOR CHARTS
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

    public function RetrieveProfileAverageData($canineDogDataName){
        $canineData = DB::table('Canine_Data')->select("Activity_Level", "Heart_Rate", "Temperature")->where('DogID','=', $canineDogDataName)->get();
        $averageCanineData = [0,0,0];
        foreach ($canineData as $data){
            $averageCanineData[0] += $data->Activity_Level;
            $averageCanineData[1] += $data->Temperature;
            $averageCanineData[2] += $data->Heart_Rate;
        }
        $averageCanineData[0] = $averageCanineData[0] / Count($canineData);
        $averageCanineData[1] = $averageCanineData[1] / Count($canineData);
        $averageCanineData[2] = $averageCanineData[2] / Count($canineData);
        return $averageCanineData;
    }
}
