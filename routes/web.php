<?php

use App\Http\Controllers\backend\bounceController;
use App\Http\Controllers\backend\senderVerificationController;
use App\Http\Controllers\backend\smtpController;
use App\Http\Controllers\backend\unsubscribeGroupsController;
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

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');


Route::get('/smtp',[smtpController::class, 'index']);
Route::get('/aaaaaaaaaaa',[smtpController::class, 'aaaaaa'])->name('get');




Route::get('/dashboard/sender-verification/get-all-single-send',[senderVerificationController::class , 'getAllSingleSend'])->name('getAllSingleSend')->middleware('auth');

