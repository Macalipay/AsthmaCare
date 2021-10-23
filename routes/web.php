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

// DASHBOARD
Route::group(['prefix' => 'dashboard'], function (){
    Route::get          ('/',                            'DashboardController@index'                          )->name('client');
    Route::post         ('/save',                        'DashboardController@store'                          )->name('client_store');
    Route::get          ('/edit/{id}',                   'DashboardController@edit'                           )->name('client_edit');
    Route::post         ('/update/{id}',                 'DashboardController@update'                         )->name('client_update');
    Route::get          ('/destroy/{id}',                'DashboardController@destroy'                        )->name('client_destroy');
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

// TYPE OF ASTHMA
Route::group(['prefix' => 'mobile'], function (){
    Route::post         ('/register',                    'MobileAppController@register'                    )->name('mobile_app_registration');
    Route::post         ('/login',                       'MobileAppController@login'                       )->name('mobile_app_login');
});

// SYMPTOMS
Route::group(['prefix' => 'symptoms'], function (){
    Route::get         ('/',                             'SymptomsController@index'                       )->name('symptoms');
    Route::post        ('/save',                         'SymptomsController@save'                        )->name('symptoms_save');
    Route::get         ('/edit/{id}',                    'SymptomsController@edit'                        )->name('symptoms_edit');
    Route::post        ('/update/{id}',                  'SymptomsController@update'                      )->name('symptoms_update');
    Route::get         ('/destroy/{id}',                 'SymptomsController@destroy'                     )->name('symptoms_destroy');
});

// SYMPTOMS
Route::group(['prefix' => 'users'], function (){
    Route::get         ('/',                             'UserController@index'                       )->name('user');
    Route::post        ('/save',                         'UserController@save'                        )->name('user_save');
    Route::get         ('/edit/{id}',                    'UserController@edit'                        )->name('user_edit');
    Route::post        ('/update/{id}',                  'UserController@update'                      )->name('user_update');
    Route::get         ('/destroy/{id}',                 'UserController@destroy'                     )->name('user_destroy');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
