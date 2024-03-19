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

    // THIS GETS THE DOGS A OWNER HAS
    public function GetDogs($ownerID){
        $canineData = DB::table('Canine_Data')->select('DogID')->distinct()->where('OwnerID',"=", $ownerID)->Get();
        return $canineData;
    }
    // THIS GETS THE DOGS A OWNER HAS

    // THIS GETS DATA FOR CHARTS
    public function RetrieveDataTrends($DogID, $displayAll, $startDateHour, $endDateHour){
        if ($startDateHour != null && $displayAll == "false"){
            $thisModel = new CanineData();
            $canineData = DB::table('Canine_Data')->where('DogID','=', $DogID)->whereBetween('Date', [$startDateHour, $endDateHour])->get();
            $canineDataAveragedAndSum = $thisModel->SumAndAverageData($canineData, $displayAll);
            return $canineDataAveragedAndSum;
        }
        else if ($startDateHour != null && $displayAll == "true"){
            $thisModel = new CanineData();
            $canineData = DB::table('Canine_Data')->whereBetween('Date', [$startDateHour, $endDateHour])->get();
            $canineDataAveragedAndSum = $thisModel->SumAndAverageData($canineData, $displayAll);
            return $canineDataAveragedAndSum;
        }
    }

    public function RetrieveDataDateFilteredTrends($canineDogDataName, $displayAll, $dateMin, $dateMax){
        if ($dateMax == null && $displayAll == "false"){
            $canineData = DB::table('Canine_Data')->where('DogID','=', $canineDogDataName)->whereBetween("Date", [$dateMin, $dateMin])->get();
            $summedData = [0,0,0,0];
            foreach ($canineData as $data){
                $summedData[0] += $data->Activity_Level;
                $summedData[1] += $data->Calorie_Burn;
                $summedData[2] += $data->Food_Intake;
                $summedData[3] += $data->Water_Intake;
            }
            $returnArray[] = $canineData;
            $returnArray[] = $summedData;
            return $returnArray;
        }
        else if ($dateMax != null && $displayAll == "false"){
            $thisModel = new CanineData();
            $canineData = DB::table('Canine_Data')->where('DogID','=', $canineDogDataName)->whereBetween("Date", [$dateMin, $dateMax])->get();
            $canineDataAveragedAndSum = $thisModel->SumAndAverageData($canineData, $displayAll);
            return $canineDataAveragedAndSum;
        }
        else if ($dateMax != null && $displayAll == "true"){
            $thisModel = new CanineData();
            $canineData = DB::table('Canine_Data')->whereBetween("Date", [$dateMin, $dateMax])->get();
            $canineDataAveragedAndSum = $thisModel->SumAndAverageData($canineData, $displayAll);
            return $canineDataAveragedAndSum;
        }
    }

    public function SumAndAverageData($dataToAverage, $displayAll){ // returns average for a day and also sum for the entire timeframe
        $arrayDistinctName = [];
        $arraySumOfDays = [0,0,0,0];
        $array = [];
        $DogName = "";
        $Date = "";
        $UsedDates = [];
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
                if ($Date != $dataToAverage[$i]->Date && !in_array($dataToAverage[$i]->Date, $UsedDates) || $Date == ""){
                    if ($DogName != $dataToAverage[$i]->DogID || $DogName == ""){
                        $DogName = $dataToAverage[$i]->DogID;
                        $arrayDistinctName[] = $DogName;
                    }
                    $UsedDates[] = $Date;
                    $Date = $dataToAverage[$i]->Date;
                    $object->Date = $Date;
                    $array[] = $object;
                }
            }
        }

        $distinctNameCount = Count($arrayDistinctName);
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
            $arraySumOfDays[0] += $tempArray[1];
            $arraySumOfDays[1] += $tempArray[3];
            $arraySumOfDays[2] += $tempArray[5];
            $arraySumOfDays[3] += $tempArray[6];
            if ($displayAll == "false"){
                //$averagedDataObject->CanineID = 
                //$averagedDataObject->OwnerID = 
                $averagedDataObject->DogID = $array[$i]->DogName;
                $averagedDataObject->Date = $array[$i]->Date;
                $averagedDataObject->Weight = round($tempArray[0] / 24, 1);
                $averagedDataObject->Activity_Level = round($tempArray[1] / 24, 1);
                $averagedDataObject->Heart_Rate = round($tempArray[2] / 24, 1);
                $averagedDataObject->Calorie_Burn = round($tempArray[3] / 24, 1);
                $averagedDataObject->Temperature = round($tempArray[4] / 24, 1);
                $averagedDataObject->Food_Intake = round($tempArray[5] / 24, 1);
                $averagedDataObject->Water_Intake = round($tempArray[6] / 24, 1);
                $averagedDataObject->Breathing_Rate = round($tempArray[7] / 24, 1);
                $averageDataArray[] = $averagedDataObject;
            }
            else{
                //$averagedDataObject->CanineID =
                //$averagedDataObject->OwnerID =
                $averagedDataObject->Date = $array[$i]->Date;
                $averagedDataObject->Weight = round($tempArray[0] / (24 * $distinctNameCount), 1);
                $averagedDataObject->Activity_Level = round($tempArray[1] / (24 * $distinctNameCount), 1);
                $averagedDataObject->Heart_Rate = round($tempArray[2] / (24 * $distinctNameCount), 1);
                $averagedDataObject->Calorie_Burn = round($tempArray[3] / (24 * $distinctNameCount), 1);
                $averagedDataObject->Temperature = round($tempArray[4] / (24 * $distinctNameCount), 1);
                $averagedDataObject->Food_Intake = round($tempArray[5] / (24 * $distinctNameCount), 1);
                $averagedDataObject->Water_Intake = round($tempArray[6] / (24 * $distinctNameCount), 1);
                $averagedDataObject->Breathing_Rate = round($tempArray[7] / (24 * $distinctNameCount), 1);
                $averageDataArray[] = $averagedDataObject;
            }
        }
        $returnArray[] = $averageDataArray;
        $returnArray[] = $arraySumOfDays;
        return($returnArray);
    }

    public function RetrieveProfileAverageData($canineDogDataName, $behaviour, $barkFreq){
        $canineData;
        if ($behaviour == "All" && $barkFreq == "All"){ // this data will produces per hour average for entire time frame
            $canineData = DB::table('Canine_Data')->select("Activity_Level", "Heart_Rate", "Temperature")->where('DogID','=', $canineDogDataName)->get();
        }
        else if ($behaviour != "All" && $barkFreq == "All"){ // this data will produces per hour average for entire time frame for a specific behaviour
            $canineData = DB::table('Canine_Data')->select("Activity_Level", "Heart_Rate", "Temperature")->where('DogID','=', $canineDogDataName)->where('Behaviour','=', $behaviour)->get();
        }
        else if ($behaviour == "All" && $barkFreq != "All"){ // This data will Produces per hour average for entire time frame for a specific barking frequency
            $canineData = DB::table('Canine_Data')->select("Activity_Level", "Heart_Rate", "Temperature")->where('DogID','=', $canineDogDataName)->where('Barking_Frequency','=', $barkFreq)->get();
        }
        else if ($behaviour != "All" && $barkFreq != "All"){ // This data will produces per hour average for entire time frame for a specific behaviour and barking frequency
            $canineData = DB::table('Canine_Data')->select("Activity_Level", "Heart_Rate", "Temperature")->where('DogID','=', $canineDogDataName)->where('Behaviour','=', $behaviour)->where('Barking_Frequency',"=", $barkFreq)->get();
        }
        $averageCanineData = [0,0,0];
        $i = 0; // broke
        foreach ($canineData as $data){
            $averageCanineData[0] += $data->Activity_Level;
            if ($data->Temperature == null){
                dd($i);
            }
            $averageCanineData[1] += $data->Temperature;
            $averageCanineData[2] += $data->Heart_Rate;
            $i++;
        }
        $averageCanineData[0] = round($averageCanineData[0] / Count($canineData), 1);
        $averageCanineData[1] = round($averageCanineData[1] / Count($canineData), 1);
        $averageCanineData[2] = round($averageCanineData[2] / Count($canineData), 1);
        return $averageCanineData;
    }
}
