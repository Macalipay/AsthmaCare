<?php

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
    return view('auth.login');
});

// PATIENT
Route::group(['prefix' => 'patient'], function (){
    Route::get          ('/',                            'PatientController@index'                          )->name('client');
    Route::post         ('/save',                        'PatientController@store'                          )->name('client_store');
    Route::get          ('/edit/{id}',                   'PatientController@edit'                           )->name('client_edit');
    Route::post         ('/update/{id}',                 'PatientController@update'                         )->name('client_update');
    Route::get          ('/destroy/{id}',                'PatientController@destroy'                        )->name('client_destroy');
});

// TYPE OF ASTHMA
Route::group(['prefix' => 'asthma'], function (){
    Route::get          ('/',                            'AsthmaController@index'                          )->name('client');
    Route::post         ('/save',                        'AsthmaController@store'                          )->name('client_store');
    Route::get          ('/edit/{id}',                   'AsthmaController@edit'                           )->name('client_edit');
    Route::post         ('/update/{id}',                 'AsthmaController@update'                         )->name('client_update');
    Route::get          ('/destroy/{id}',                'AsthmaController@destroy'                        )->name('client_destroy');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
