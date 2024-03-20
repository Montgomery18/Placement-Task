<?php

namespace App\Http\Controllers;

use App\Models\CanineData;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Rubix\ML\Datasets\Labeled;
use Rubix\ML\Datasets\Unlabeled;
use Rubix\ML\Persisters\Filesystem;
use Rubix\ML\Persisters\Serializers\Json;
use Rubix\ML\Extractors\CSV;
use Rubix\ML\Classifiers\KNearestNeighbors;
use Rubix\ML\Transformers\NumericStringConverter;
use Rubix\ML\AnomalyDetectors\GaussianMLE;
use Rubix\ML\CrossValidation\HoldOut;
use Rubix\ML\CrossValidation\Metrics\Accuracy;
use Rubix\ML\Transformers\KNNImputer;
use Rubix\ML\Graph\Trees\BallTree;
use Rubix\ML\Kernels\Distance\SafeEuclidean;
use Rubix\ML\Kernels\Distance\Minkowski;
use Rubix\ML\Classifiers\ClassificationTree;
use Rubix\ML\PersistentModel;
use Rubix\ML\Clusterers\KMeans;


class AnimalDataController extends Controller
{
    public function FileDBWrite(Request $request){
        $fileData = Storage::get('activityData.csv');
        $fileDataArray = explode("\n", $fileData);
        if ($request->input('type') == "different" && $request->input('HasColumns') == "true"){
            array_splice($fileDataArray, $request->input('ColumnStart'), $request->input('ColumnEnd'));
        }
        else{
            array_splice($fileDataArray, 0, 1);
        }
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
            if ($count == 2){
                dd($indivData);
            }
            if ($request->input('type') == "different"){
                $dateArray = explode("-", $indivData[$request->input('Date')]);
                $date = ($dateArray[2] . "-" . $dateArray[1] . "-" . $dateArray[0]); // error caused here
            }
            else{
                $dateArray = explode("-", $indivData[2]);
                $date = ($dateArray[2] . "-" . $dateArray[1] . "-" . $dateArray[0]);
            }
            $i = 0;
            foreach($indivData as $attribute){
                if ($attribute == null){
                    $indivData[$i] = 0;
                }
                $i++;
            }

            if ($request->input('type') == "different"){
                $arrayInsertSub = [ // try fix the NormL issue if possible
                    "DogID" => $indivData[$request->input('DogID')],
                    "Weight" => $indivData[$request->input('Weight')],
                    "Date" => $date,
                    "Hour" => $indivData[$request->input('Hour')],
                    "Behaviour" => ucfirst($indivData[$request->input('Behaviour')]),
                    "Activity_Level" => $indivData[$request->input('ActivityLevel')],
                    "Heart_Rate" => $indivData[$request->input('HeartRate')],
                    "Calorie_Burn" => $indivData[$request->input('CalorieBurn')],
                    "Temperature" => $indivData[$request->input('Temperature')],
                    "Food_Intake" => $indivData[$request->input('FoodIntake')],
                    "Water_Intake" => $indivData[$request->input('WaterIntake')],
                    "Breathing_Rate" => $indivData[$request->input('BreathingRate')],
                    "Barking_Frequency" => ucfirst(str_replace("\r", "", $indivData[$request->input('BarkingFrequency')])) // gets rid of the /r on the end of this piece of data
                ];
                $arrayInsert[] = $arrayInsertSub;
                $count = $count + 1;
            }
            else{
                $arrayInsertSub = [ 
                    "DogID" => $indivData[0],
                    "Weight" => $indivData[1],
                    "Date" => $date,
                    "Hour" => $indivData[3],
                    "Behaviour" => ucfirst($indivData[4]),
                    "Activity_Level" => $indivData[5],
                    "Heart_Rate" => $indivData[6],
                    "Calorie_Burn" => $indivData[7],
                    "Temperature" => $indivData[8],
                    "Food_Intake" => $indivData[9],
                    "Water_Intake" => $indivData[10],
                    "Breathing_Rate" => $indivData[11],
                    "Barking_Frequency" => ucfirst(str_replace("\r", "", $indivData[12]))
                ];
                $arrayInsert[] = $arrayInsertSub;
                $count = $count + 1;
            }
        }
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

    public function AdminHandler(Request $request){
        $thisController = new AnimalDataController();
        if ($request->input('type') == "regular"){
            $thisController->RegenerateDataFromCSV($request);
        }
        else if ($request->input('type') == "different"){
            $thisController->RegenerateDataFromIrregularCSV($request);
        }
        return view("/admin");
    }


    public function RegenerateDataFromCSV(Request $request){
        $thisController = new AnimalDataController();
        $canineData = new CanineData();
        $canineData->DeleteDataDB();
        $thisController->FileDBWrite($request);
        return view('/Admin');
    }

    public function RegenerateDataFromIrregularCSV(Request $request){
        $thisController = new AnimalDataController();
        $canineData = new CanineData();
        $canineData->DeleteDataDB();
        $thisController->FileDBWrite($request);
        return view('/Admin');
    }

    public function showForm()
    {
        return view('prediction_form');
    }

    public function predict(Request $request)
    {
        // Validate the form data
        $validatedData = $request->validate([
            'weight' => 'required|numeric',
            'activityLevel' => 'required|string',
            'heartRate' => 'required|numeric',
            'calorieBurn' => 'required|numeric',
            'temperature' => 'required|numeric',
            'foodIntake' => 'required|numeric',
            'waterIntake' => 'required|numeric',
            'breathingRate' => 'required|numeric',
            'barkingFrequency' => 'required|string',
        ]);

       
       $path = Storage::disk('local')->path('activityData2.csv');
       $dataset = Labeled::fromIterator(new CSV($path, true))
        ->apply(new NumericStringConverter());

       $estimator = new ClassificationTree(10, 5, 0.001, null, null);
       
       $estimator->train($dataset);

        $samples=[
            ['weight', 'activityLevel', 'heartRate', 'calorieBurn', 'temperature', 'foodIntake', 'waterIntake', 'breathingRate', 'barkingFrequency'],
        ];

        $PredictionSet= new Unlabeled($samples);
        $Predictions= $estimator -> predict($PredictionSet);
        return view ("/Prediction", ["Predictions" => $Predictions]);
    }

}
