<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\ReferencesController;
use \App\Http\Controllers\ActivityController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('reference')
    ->as('reference.')
    ->controller(ReferencesController::class)->group(function (){
        Route::get('expertises','getExpertises')->name('getExpertises');
        Route::get('expertises/{id}','getExpertiseByid')->name('getExpertise');
        Route::get('cultural','getCulturalRights')->name('getCulturalRights');
        Route::get('cultural/{id}','getCulturalRightByid')->name('getCulturalRight');
        Route::get('nacs','getNacs')->name('getNacs');
        Route::get('nacs/{id}','getNacByid')->name('getNac');
    });

Route::prefix('activity')
    ->as('activity.')
    ->controller(ActivityController::class)->group(function (){
        Route::post('/','save')->name('saveActivity');
        Route::put('/{id}','update')->name('updateActivity');
        Route::get('/{id}','getById')->name('getByIdActivity');
        Route::delete('/{id}','delete')->name('deleteActivity');
        Route::put('/{id}/restore','restore')->name('restoreActivity');
        Route::get('/','index')->name('indexActivity');

    });

