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
            return view('Profile', ["DogID" => $usersDog, "Data" => $profileData]);
        }
        else{
            if ($usersDog != null){
                $profileData = $animalCont->profileAverage($usersDog[0]->DogID);
            }
            else{
                $profileData = null;
            }
            return view('Profile', ["DogID" => $usersDog, "Data" => $profileData]);
        }
    }
    else{
        return view('/index');
    }
    
    //$profileData = $animalCont->profileAverage("CANINE001");
    //return view('Profile', ["data" => $profileData]);
});

Route::post('/Profile', [AnimalDataController::class, 'SetUserDesiredDog'])->name('SelectDog');

Route::get('/Trends', function(){
    if (session()->get("AccountID") !== null){
        $animalCont = new AnimalDataController();
        $startDate = "2021-01-01";
        $endDate = "2021-01-30";
        if (session()->get("SelectedDog") !== null){
            $graphData = $animalCont->DisplayData(session()->get("SelectedDog"), "false", $startDate, $endDate);
            return view('Trends', ["data" => $graphData, "startDate" => $startDate, "endDate" => $endDate]);
        }
        else{
            $usersDog = $animalCont->GetUsersDogs(session()->get("AccountID"));
            $graphData = $animalCont->DisplayData($usersDog[0]->DogID, "false", $startDate, $endDate);
            return view('Trends', ["data" => $graphData, "DogID" => $usersDog[0]->DogID, "startDate" => $startDate, "endDate" => $endDate]);
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

//Route::get('/', function () {
//    return view('welcome');
//});
