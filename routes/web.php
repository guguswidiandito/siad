<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Auth::routes();

Route::get('/', 'HomeController@index');
Route::get('/home', 'HomeController@index');

Route::group(['prefix'=>'admin','middleware'=>['auth']], function() {
    Route::resource('kelas', 'KelasController');
    Route::resource('siswa', 'SiswaController');
    Route::resource('jenis', 'JenisController');
    Route::resource('pembayaran', 'PembayaranController');
    Route::resource('registrasi', 'RegistrasiController');
    Route::resource('anggota', 'AnggotaController');
});
Route::group(['middleware'=>['auth']], function() {
    Route::get('export/siswa', [
	'as' => 'export.siswa',
	'uses' => 'SiswaController@export'
	]);
	Route::post('export/siswa', [
	'as' => 'export.siswa.post',
	'uses' => 'SiswaController@exportPost'
	]);
	Route::get('export/registrasi', [
	'as' => 'export.registrasi',
	'uses' => 'RegistrasiController@export'
	]);
	Route::post('export/registrasi', [
	'as' => 'export.registrasi.post',
	'uses' => 'RegistrasiController@exportPost'
	]);
	Route::get('export/pembayaran', [
	'as' => 'export.pembayaran',
	'uses' => 'PembayaranController@export'
	]);
	Route::post('export/pembayaran', [
	'as' => 'export.pembayaran.post',
	'uses' => 'PembayaranController@exportPost'
	]);
	Route::get('siswa/pembayaran', [
		'as' => 'siswa.pembayaran',
		'uses' => 'PembayaranController@pembayaran'
		]);
	Route::get('siswa/registrasi', [
		'as' => 'siswa.registrasi',
		'uses' => 'RegistrasiController@registrasi'
		]);
	Route::get('siswa/identitas', [
		'as' => 'siswa.identitas',
		'uses' => 'SiswaController@identitas'
		]);
	Route::get('setelan/password', 'PasswordController@editPassword');
	Route::post('setelan/password', 'PasswordController@updatePassword');
});