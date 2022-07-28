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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('dashboard', function () {
   return view('layouts.master');
});



Route::group(['middleware' => 'auth'], function () {

    Route::resource('pics','PicController');
    Route::get('/apiPics','PicController@apiPics')->name('api.pics');
    
    Route::resource('departemens','DepartemenController');
    Route::get('/apiDepartemens','DepartemenController@apiDepartemens')->name('api.departemens');

    Route::resource('makers','MakerController');
    Route::get('/apiMakers','MakerController@apiMakers')->name('api.makers');
    
    Route::resource('alatukurs','AlatukurController');
    Route::get('/apiAlatukurs','AlatukurController@apiAlatukurs')->name('api.alatukurs');

    Route::get('alatukursr','AlatukurController@rusak')->name('alatukurrusak');

    Route::resource('pinjams','PinjamController');
    Route::get('/apiPinjams','PinjamController@apiPinjams')->name('api.pinjams');
    Route::get('/exportPinjamsAll','PinjamController@exportPinjamsAll')->name('exportPDF.pinjamsAll');
    Route::get('/exportPinjamsAllExcel','PinjamController@exportExcel')->name('exportExcel.pinjamsAll');

    Route::resource('tempat_kalibrasis','TempatKalibrasiController');
    Route::get('/apiTempatKalibrasis','TempatKalibrasiController@apiTempatKalibrasis')->name('api.tempat_kalibrasis');

    Route::resource('lokasi_alatukurs','LokasiAlatukurController');
    Route::get('/apiLokasiAlatukurs','LokasiAlatukurController@apiLokasiAlatukurs')->name('api.lokasi_alatukurs');

    Route::resource('kalibrasis','KalibrasiController');
    Route::get('/apiKalibrasis','KalibrasiController@apiKalibrasis')->name('api.kalibrasis');

});

