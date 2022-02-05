<?php

use App\Http\Controllers\backend\emailController;
use App\Http\Controllers\backend\emailListController;
use App\Http\Controllers\backend\senderVerificationController;
use App\Http\Controllers\backend\SingleSendController;
use App\Http\Controllers\backend\suppressionGroupController;
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
Route::resource('/email',emailController::class);
Route::resource('/email_list',emailListController::class);
Route::post('/get_sendgrid_id/{id}',[emailController::class, 'getSendgridId'])->name('email.getSendgridId');
Route::resource('/single-sends',SingleSendController::class);
Route::post('/single-sends/update/single-send',[SingleSendController::class, 'updateSchedule'])->name('single-sends.updateSchedule');
Route::resource('/suppression-group',suppressionGroupController::class);
Route::resource('/sender-verification',senderVerificationController::class);
