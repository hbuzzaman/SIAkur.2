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

use \App\Http\Controllers\UserController;
use \App\Http\Controllers\AlatukurController;

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('dashboard', function () {
   return view('layouts.master');
});

    Route::resource('pics','PicController')->middleware('auth');
    Route::get('/apiPics','PicController@apiPics')->name('api.pics');
    
    Route::resource('departemens','DepartemenController')->middleware('auth');
    Route::get('/apiDepartemens','DepartemenController@apiDepartemens')->name('api.departemens');

    Route::resource('makers','MakerController')->middleware('auth');
    Route::get('/apiMakers','MakerController@apiMakers')->name('api.makers');
    
    Route::resource('alatukurs','AlatukurController')->middleware('auth');
    Route::get('/apiAlatukurs','AlatukurController@apiAlatukurs')->name('api.alatukurs');

    Route::get('alatukursr','AlatukurController@rusak')->name('alatukurrusak')->middleware('auth');

    Route::get('masterjadwal','MasterJadwalController@masterjadwal')->name('masterjadwalz');

    Route::resource('pinjams','PinjamController')->middleware('auth');
    Route::get('/apiPinjams','PinjamController@apiPinjams')->name('api.pinjams');
    Route::get('/exportPinjamsAll','PinjamController@exportPinjamsAll')->name('exportPDF.pinjamsAll');
    Route::get('/exportPinjamsAllExcel','PinjamController@exportExcel')->name('exportExcel.pinjamsAll');

    Route::resource('tempat_kalibrasis','TempatKalibrasiController')->middleware('auth');
    Route::get('/apiTempatKalibrasis','TempatKalibrasiController@apiTempatKalibrasis')->name('api.tempat_kalibrasis');

    Route::resource('lokasi_alatukurs','LokasiAlatukurController')->middleware('auth');
    Route::get('/apiLokasiAlatukurs','LokasiAlatukurController@apiLokasiAlatukurs')->name('api.lokasi_alatukurs');
    
    Route::resource('cek_fisiks','CekFisikController')->middleware('auth');
    Route::get('/apiCekFisiks','CekFisikController@apiCekFisiks')->name('api.cek_fisiks');

    Route::resource('master_jadwals','MasterJadwalController')->middleware('auth');
    Route::get('/apiMasterJadwals','MasterJadwalController@apiMasterJadwals')->name('api.master_jadwals');
    
    Route::resource('kalibrasis','KalibrasiController')->middleware('auth');
    Route::get('/apiKalibrasis','KalibrasiController@apiKalibrasis')->name('api.kalibrasis');

    Route::resource('user', 'UserController')->middleware('auth');
    Route::get('/apiUsers', 'UserController@apiUsers')->name('api.users');

    Route::get('alatukur/{alatukurs:status}', [AlatukurController::class, 'status']);