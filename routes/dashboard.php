<?php

use App\Http\Controllers\backend\bounceController;
use App\Http\Controllers\backend\emailController;
use App\Http\Controllers\backend\emailListController;
use App\Http\Controllers\backend\globalStatisticsController;
use App\Http\Controllers\backend\senderVerificationController;
use App\Http\Controllers\backend\SingleSendController;
use App\Http\Controllers\backend\spamController;
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
Route::view('/multiselect','layouts.multiselect');

Route::resource('/email',emailController::class);
Route::resource('/email_list',emailListController::class);
Route::post('/get_sendgrid_id/{id}',[emailController::class, 'getSendgridId'])->name('email.getSendgridId');
Route::resource('/single-sends',SingleSendController::class);
Route::get('single-sends/view/mail/{mailId}',[SingleSendController::class , 'viewMail'])->name('viewMail');
Route::post('/single-sends/update/single-send/Schedule/set',[SingleSendController::class, 'updateSchedule'])->name('single-sends.updateSchedule');
Route::post('/single-sends/update/single-send/Schedule/cancel',[SingleSendController::class, 'cancelSchedule'])->name('single-sends.cancelSchedule');
Route::resource('/suppression-group/bounce',bounceController::class);
Route::get('/suppression-group/bounce/list/update', [bounceController::class, 'updateList'])->name('updateList');
Route::resource('/unsubscribe-group',unsubscribeGroupsController::class);
Route::post('/suppression-group/update-group/{groupId}', [unsubscribeGroupsController::class, 'updateGroup'])->name('updateGroup');
Route::get('/suppression-group/addEmailToSuppression', [unsubscribeGroupsController::class, 'addEmailToSuppression'])->name('addEmailToSuppression');
Route::delete('/unsubscribe-group/destroy/{emailInfo}/{group_id}', [unsubscribeGroupsController::class, 'deleteEmailFromUnsubscribeGroup'])->name('deleteEmailFromUnsubscribeGroup');
Route::resource('/sender-verification',senderVerificationController::class);
Route::resource('/spam', spamController::class);
Route::get('/spam/list/update',[spamController::class, 'updateSpamList'])->name('spam.updatelist');
Route::resource('/stats',globalStatisticsController::class);
///Route::get('/sender-verification/get-all-single-send',[senderVerificationController::class , 'getAllSingleSend'])->name('getAllSingleSend');
