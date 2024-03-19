<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\AnimalDataController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function(){
    return view('index');
});

Route::get('/Placeholder', function(){
    return view('Placeholder');
});

Route::get('/Login', function(){
    return view('Login');
});

Route::get('/Register', function(){
    return view('Register');
});

Route::post('/views/add', [AccountController::class, 'add'])->name('views.add');

Route::post('/views/delete', [AccountController::class, 'delete'])->name('views.delete');

Route::post('/login', [AccountController::class, 'loginPost'])->name('login1');

Route::get('/ResetPassRequest', function(){
    return view('ResetPassRequest');
});

Route::get('/Profile', function(){
    $animalCont = new AnimalDataController();
    if (session()->get("AccountID") !== null){
        $usersDog = $animalCont->GetUsersDogs(session()->get("AccountID"));
        if (session()->get("SelectedDog") !== null){
            $profileData = $animalCont->profileAverage(session()->get("SelectedDog"));
            $behavAndBark = $animalCont->GetBehaviourAndBark(session()->get("SelectedDog"));
            return view('Profile', ["DogID" => $usersDog, "Data" => $profileData, "BehavAndBarkList" => $behavAndBark]);
        }
        else{
            if ($usersDog != null){
                $profileData = $animalCont->profileAverage($usersDog[0]->DogID);
                $behavAndBark = $animalCont->GetBehaviourAndBark($usersDog[0]->DogID);
            }
            else{
                $profileData = null;
            }
            return view('Profile', ["DogID" => $usersDog, "Data" => $profileData, "BehavAndBarkList" => $behavAndBark]);
        }
    }
    else{
        return view('/index');
    }
});

Route::post('/Profile', [AnimalDataController::class, 'ProfilePageManage'])->name('profileData');

Route::get('/Trends', function(){
    if (session()->get("AccountID") !== null){
        $animalCont = new AnimalDataController();
        $startDate = "2021-01-01";
        $endDate = "2021-01-30";
        if (session()->get("SelectedDog") !== null){
            $returnedData = $animalCont->DisplayData(session()->get("SelectedDog"), "false", $startDate, $endDate);
            return view('Trends', ["data" => $returnedData[0], "SummedData" => $returnedData[1], "startDate" => $startDate, "endDate" => $endDate]);
        }
        else{
            $usersDog = $animalCont->GetUsersDogs(session()->get("AccountID"));
            $returnedData = $animalCont->DisplayData($usersDog[0]->DogID, "false", $startDate, $endDate);
            return view('Trends', ["data" => $returnedData[0], "SummedData" => $returnedData[1], "DogID" => $usersDog[0]->DogID, "startDate" => $startDate, "endDate" => $endDate]);
        }
    }
    else{
        return view('/index');
    }
});

Route::post('/Trends', [AnimalDataController::class, 'DisplayDataRangeFiltered'])->name('graphfilter');

Route::get('/Admin', function(){
    return view('Admin');
});

Route::post('/Admin', [AnimalDataController::class, 'RegenerateDataFromCSV'])->name('RegenData');

Route::get('/ContactUs', function(){
    return view('ContactUs');
});

Route::get('/AdminPassReset', function(){
    return view('AdminPassReset');
});

Route::get('/AdminDeleteUser', function(){
    return view('AdminDeleteUser');
});

Route::get('/test', [AccountController::class, 'Test']);

Route::get('/WriteFileDB', [AnimalDataController::class, 'FileDBWrite']);

Route::get('/dumpdata', function(){
    return view('dumpdata');
});

Route::post('/dumpdata', [AnimalDataController::class, 'DisplayDataRangeFiltered'])->name('test');

Route::get('/Prediction', function(){
    return view('Prediction');
});

Route::post('/', [AnimalDataController::class, 'showForm']);
Route::post('/Prediction', [AnimalDataController::class, 'predict'])->name('predict');


//Route::get('/', function () {
//    return view('welcome');
//});
