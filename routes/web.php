<?php

use App\Http\Controllers\backend\homeController;
use App\Http\Controllers\backend\pListController;
use App\Http\Controllers\backend\pNumberController;
use App\Http\Controllers\backend\senderVerificationController;
use App\Http\Controllers\backend\smtpController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

//Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
//    return view('dashboard');
//})->name('dashboard');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', [homeController::class , 'dashboard'])->name('dashboard');
Route::get('/dashboard/sender-verification/get-all-single-send',[senderVerificationController::class , 'getAllSingleSend'])->name('getAllSingleSend')->middleware('auth');


