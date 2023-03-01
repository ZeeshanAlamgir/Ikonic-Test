<?php

use App\Http\Controllers\Web\ConnectionController\ConnectionController;
use App\Http\Controllers\Web\RequestController\RequestController;
use App\Http\Controllers\Web\SuggestionController\SuggestionController;
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

Route::controller(SuggestionController::class)->group(function(){

    Route::get('suggestions','index')->name('suggestions.index');
    Route::get('send-request/{senderId}/{receiverId}','store')->name('suggestions.send-req');
});

Route::controller(RequestController::class)->group(function(){

    Route::get('get-send-reqs','show')->name('suggestions.get-send-reqs');
    Route::get('delete-request/{userId}/{requestId}','delete')->name('suggestions.get-send-reqs');
    Route::get('accept-request/{senderId}/{requestId}','store')->name('suggestions.accept-req');

});

Route::controller(ConnectionController::class)->group(function(){

    Route::get('connections','index')->name('connections');
    Route::get('remove-connection/{userId}/{connectionId}','delete')->name('connection.remove');

});
