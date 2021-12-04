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

// CLINIC
Route::group(['prefix' => 'company'], function (){
    Route::get          ('/',                            'CompanyController@index'                          )->name('client');
    Route::post         ('/save',                        'CompanyController@store'                          )->name('client_store');
    Route::get          ('/edit/{id}',                   'CompanyController@edit'                           )->name('client_edit');
    Route::post         ('/update/{id}',                 'CompanyController@update'                         )->name('client_update');
    Route::get          ('/destroy/{id}',                'CompanyController@destroy'                        )->name('client_destroy');
    Route::get          ('/status/{id}',                 'CompanyController@status'                         )->name('client_destroy');
});

// TYPE OF ASTHMA
Route::group(['prefix' => 'asthma'], function (){
    Route::get          ('/',                            'AsthmaController@index'                          )->name('client');
    Route::post         ('/save',                        'AsthmaController@save'                           )->name('client_store');
    Route::get          ('/edit/{id}',                   'AsthmaController@edit'                           )->name('client_edit');
    Route::post         ('/update/{id}',                 'AsthmaController@update'                         )->name('client_update');
    Route::get          ('/destroy/{id}',                'AsthmaController@destroy'                        )->name('client_destroy');
});

// APPOINTMENT
Route::group(['prefix' => 'appointment'], function (){
    Route::get          ('/',                            'AppointmentController@index'                          )->name('client');
    Route::post         ('/save',                        'AppointmentController@save'                           )->name('client_store');
    Route::get          ('/fullcalendar',                'AppointmentController@fullcalendar'                           )->name('client_store');
    Route::get          ('/edit/{id}',                   'AppointmentController@edit'                           )->name('client_edit');
    Route::post         ('/update/{id}',                 'AppointmentController@update'                         )->name('client_update');
    Route::get          ('/destroy/{id}',                'AppointmentController@destroy'                        )->name('client_destroy');
});

// TYPE OF ASTHMA
Route::group(['prefix' => 'mobile'], function (){
    Route::post         ('/register',                    'MobileAppController@register'                    )->name('mobile_app_registration');
    Route::post         ('/login',                       'MobileAppController@login'                       )->name('mobile_app_login');
    Route::post         ('/get-doctor',                  'MobileAppController@getDoctor'                   )->name('mobile_app_doctor');
    Route::post         ('/get-company',                 'MobileAppController@getCompany'                  )->name('mobile_app_company');
    Route::post         ('/get-existing-appointment',    'MobileAppController@getExistingAppointment'      )->name('mobile_app_exiting_appointment');
    Route::post         ('/get-asthma',                  'MobileAppController@getAsthma'                   )->name('mobile_app_asthma');
    Route::post         ('/get-appointment',             'MobileAppController@getAppointment'              )->name('mobile_app_appointment');
    Route::post         ('/get-incoming-patient',        'MobileAppController@getIncomingPatient'          )->name('mobile_app_appointment');
    Route::post         ('/get-incoming-appointment',    'MobileAppController@getIncomingAppointment'      )->name('mobile_app_appointment');
    Route::post         ('/get-history',                 'MobileAppController@getPatientHistory'           )->name('mobile_app_history');
    Route::post         ('/get-monitoring',              'MobileAppController@getPatientList'              )->name('mobile_app_patient');
    Route::post         ('/set-appointment',             'MobileAppController@setAppointment'              )->name('mobile_app_appointment');
    Route::post         ('/set-action-plan',             'MobileAppController@setActionPlan'               )->name('mobile_app_set_action_plan');
    Route::post         ('/get-action-plan',             'MobileAppController@getActionPlan'               )->name('mobile_app_get_action_plan');
    Route::post         ('/update-status',               'MobileAppController@updateStatus'                )->name('mobile_app_get_update_status');
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
    Route::get         ('/',                             'UserController@index'                           )->name('user');
    Route::get         ('/admin',                        'UserController@admin'                           )->name('user');
    Route::post        ('/save',                         'UserController@save'                            )->name('user_save');
    Route::get         ('/edit/{id}',                    'UserController@edit'                            )->name('user_edit');
    Route::post        ('/update/{id}',                  'UserController@update'                          )->name('user_update');
    Route::get         ('/destroy/{id}',                 'UserController@destroy'                         )->name('user_destroy');
});

// DOCTOR
Route::group(['prefix' => 'doctors'], function (){
    Route::get         ('/',                             'DoctorController@index'                         )->name('doctor');
    Route::post        ('/save',                         'DoctorController@save'                          )->name('doctor_save');
    Route::get         ('/edit/{id}',                    'DoctorController@edit'                          )->name('doctor_edit');
    Route::post        ('/update/{id}',                  'DoctorController@update'                        )->name('doctor_update');
    Route::get         ('/destroy/{id}',                 'DoctorController@destroy'                       )->name('doctor_destroy');
});

// DOCTOR
Route::group(['prefix' => 'types-of-asthma'], function (){
    Route::get         ('/',                             'TypesOfAsthmaController@index'                         )->name('doctor');
    Route::post        ('/save',                         'TypesOfAsthmaController@save'                          )->name('doctor_save');
    Route::get         ('/edit/{id}',                    'TypesOfAsthmaController@edit'                          )->name('doctor_edit');
    Route::post        ('/update/{id}',                  'TypesOfAsthmaController@update'                        )->name('doctor_update');
    Route::get         ('/destroy/{id}',                 'TypesOfAsthmaController@destroy'                       )->name('doctor_destroy');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
