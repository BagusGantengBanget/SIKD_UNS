<?php

use Illuminate\Http\Request;


Route::prefix('v1')->group(function(){
    Route::post('register','Api\V1\AuthController@register');
    Route::post('login','Api\V1\AuthController@login');
    Route::group(['middleware' => 'auth:api'], function(){
    //Data Dosen
    Route::get('/dosen', 'api\v1\dosenController@index');
    Route::get('/dosen/{fakultas?}', 'api\v1\dosenController@show');
    Route::get('/dosen/{fakultas?}/{NAMA?}', 'api\v1\dosenController@showprodi');
    //Kinerja_Buku
    Route::get('/buku', 'api\v1\bukuController@index');
    Route::get('/buku/{fakultas?}', 'api\v1\bukuController@show');
    Route::get('/buku/{fakultas?}/{NAMA?}', 'api\v1\bukuController@showprodi');
    //Kinerja_hakipaten
    Route::get('/hakipaten', 'api\v1\hakipatenController@index');
    Route::get('/hakipaten/{fakultas?}', 'api\v1\hakipatenController@show');
    Route::get('/hakipaten/{fakultas?}/{NAMA?}', 'api\v1\hakipatenController@showprodi');
    //Kinerja_jurnal
    Route::get('/jurnal', 'api\v1\jurnalController@index');
    Route::get('/jurnal/{fakultas?}', 'api\v1\jurnalController@show');
    Route::get('/jurnal/{fakultas?}/{NAMA?}', 'api\v1\jurnalController@showprodi');
    //Kinerja_karyacipta
    Route::get('/karyacipta', 'api\v1\karyaciptaController@index');
    Route::get('/karyacipta/{fakultas?}', 'api\v1\karyaciptaController@show');
    Route::get('/karyacipta/{fakultas?}/{NAMA?}', 'api\v1\karyaciptaController@showprodi');
    //Kinerja_karyaseni
    Route::get('/karyaseni', 'api\v1\karyaseniController@index');
    Route::get('/karyaseni/{fakultas?}', 'api\v1\karyaseniController@show');
    Route::get('/karyaseni/{fakultas?}/{NAMA?}', 'api\v1\karyaseniController@showprodi');
    //Kinerja_koran
    Route::get('/koran', 'api\v1\koranController@index');
    Route::get('/koran/{fakultas?}', 'api\v1\koranController@show');
    Route::get('/koran/{fakultas?}/{NAMA?}', 'api\v1\koranController@showprodi');
    //Kinerja_pembicara
    Route::get('/pembicara', 'api\v1\pembicaraController@index');
    Route::get('/pembicara/{fakultas?}', 'api\v1\pembicaraController@show');
    Route::get('/pembicara/{fakultas?}/{NAMA?}', 'api\v1\pembicaraController@showprodi');
    //Kinerja_pengabdian
    Route::get('/pengabdian', 'api\v1\pengabdianController@index');
    Route::get('/pengabdian/{fakultas?}', 'api\v1\pengabdianController@show');
    Route::get('/pengabdian/{fakultas?}/{NAMA?}', 'api\v1\pengabdianController@showprodi');
    //Kinerja_program
    Route::get('/program', 'api\v1\programController@index');
    Route::get('/program/{fakultas?}', 'api\v1\programController@show');
    Route::get('/program/{fakultas?}/{NAMA?}', 'api\v1\programController@showprodi');
    //Kinerja_reviewer
    Route::get('/reviewer', 'api\v1\reviewerController@index');
    Route::get('/reviewer/{fakultas?}', 'api\v1\reviewerController@show');
    Route::get('/reviewer/{fakultas?}/{NAMA?}', 'api\v1\reviewerController@showprodi');
    //Kinerja_scopus
    Route::get('/scopus', 'api\v1\scopusController@index');
    Route::get('/scopus/{fakultas?}', 'api\v1\scopusController@show');
    Route::get('/scopus/{fakultas?}/{NAMA?}', 'api\v1\scopusController@showprodi');
    //Kinerja_seminar
    Route::get('/seminar', 'api\v1\seminarController@index');
    Route::get('/seminar/{fakultas?}', 'api\v1\seminarController@show');
    Route::get('/seminar/{fakultas?}/{NAMA?}', 'api\v1\seminarController@showprodi');
    //Penelitian
    Route::get('/penelitian', 'api\v1\penelitianController@index');
    Route::get('/penelitian/{fakultas?}', 'api\v1\penelitianController@show');
    Route::get('/penelitian/{fakultas?}/{NAMA?}', 'api\v1\penelitianController@showprodi');

Route::get('logout','Api\V1\AuthController@logout');
});
});

/* Route::get('/data_dosen', 'api\v1\data_dosenController@index');
Route::get('/data_dosen/{id?}', 'api\v1\data_dosenController@show2'); */

/* Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('/login', 'UserController@login');
Route::post('login', 'api\AuthController@login'); */