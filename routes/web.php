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

Route::get('/Login', function(){
    return view('Login');
});

Route::get('/Register', function(){
    return view('Register');
});

Route::get('/ResetPassRequest', function(){
    return view('ResetPassRequest');
});

Route::get('/Profile', function(){
    return view('Profile');
});

Route::get('/Trends', function(){
    return view('Trends');
});

Route::get('/Admin', function(){
    return view('Admin');
});

Route::get('/ContactUs', function(){
    return view('ContactUs');
});

Route::get('/test', [AccountController::class, 'Test']);

Route::get('/WriteFileDB', [AnimalDataController::class, 'FileDBWrite']);

Route::get('/dumpdata', function(){
    return view('dumpdata');
});

Route::post('/dumpdata', [AnimalDataController::class, 'DisplayDataRangeFiltered'])->name('login');

//Route::get('/', function () {
//    return view('welcome');
//});
