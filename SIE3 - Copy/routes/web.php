<?php

/* Route::get('/', function (){
\App\Kinerja_jurnal::chunk(10000, function($kinerja_jurnals){

    });
    return view('welcome');
}); */

/* use Spatie\QueryBuilder\QueryBuilder; */

Auth::routes();
Route::get('google', 'GoogleController@redirect');
Route::get('google/callback', 'GoogleController@callback');
Route::get('/', 'HomeController@index');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/home/index', 'HomeController@index');
Route::get('/logout', 'HomeController@logout');

//Menu_Data
Route::resource('data_dosen', 'Data_DosenController');

Route::resource('data_kunjungan', 'Data_KunjunganController');

//Data Penelitian
Route::resource('data_penelitian', 'Data_PenelitianController');
/* Route::resource('kinerja_penelitian', 'Kinerja_penelitianController'); */
Route::resource('fakultas_penelitian_FIB', 'Fakultas_penelitian\FIBController');
Route::resource('fakultas_penelitian_FKIP', 'Fakultas_penelitian\FKIPController');
Route::resource('fakultas_penelitian_FH', 'Fakultas_penelitian\FHController');
Route::resource('fakultas_penelitian_FEB', 'Fakultas_penelitian\FEBController');
Route::resource('fakultas_penelitian_FISIP', 'Fakultas_penelitian\FISIPController');
Route::resource('fakultas_penelitian_FP', 'Fakultas_penelitian\FPController');
Route::resource('fakultas_penelitian_FK', 'Fakultas_penelitian\FKController');
Route::resource('fakultas_penelitian_FT', 'Fakultas_penelitian\FTController');
Route::resource('fakultas_penelitian_FMIPA', 'Fakultas_penelitian\FMIPAController');
Route::resource('fakultas_penelitian_FSRD', 'Fakultas_penelitian\FSRDController');
Route::resource('fakultas_penelitian_FKOR', 'Fakultas_penelitian\FKORController');
Route::resource('fakultas_penelitian_SV', 'Fakultas_penelitian\SVController');

//kinerja_buku
Route::resource('kinerja_buku', 'Kinerja_bukuController');
Route::resource('fakultas_buku_FIB', 'Fakultas_Buku\FIBController');
Route::resource('fakultas_buku_FKIP', 'Fakultas_Buku\FKIPController');
Route::resource('fakultas_buku_FH', 'Fakultas_Buku\FHController');
Route::resource('fakultas_buku_FEB', 'Fakultas_Buku\FEBController');
Route::resource('fakultas_buku_FISIP', 'Fakultas_Buku\FISIPController');
Route::resource('fakultas_buku_FP', 'Fakultas_Buku\FPController');
Route::resource('fakultas_buku_FK', 'Fakultas_Buku\FKController');
Route::resource('fakultas_buku_FT', 'Fakultas_Buku\FTController');
Route::resource('fakultas_buku_FMIPA', 'Fakultas_Buku\FMIPAController');
Route::resource('fakultas_buku_FSRD', 'Fakultas_Buku\FSRDController');
Route::resource('fakultas_buku_FKOR', 'Fakultas_Buku\FKORController');
Route::resource('fakultas_buku_SV', 'Fakultas_Buku\SVController');

//kinerja_hakipaten
Route::resource('kinerja_hakipaten', 'Kinerja_hakipatenController');
Route::resource('fakultas_hakipaten_FIB', 'Fakultas_hakipaten\FIBController');
Route::resource('fakultas_hakipaten_FKIP', 'Fakultas_hakipaten\FKIPController');
Route::resource('fakultas_hakipaten_FH', 'Fakultas_hakipaten\FHController');
Route::resource('fakultas_hakipaten_FEB', 'Fakultas_hakipaten\FEBController');
Route::resource('fakultas_hakipaten_FISIP', 'Fakultas_hakipaten\FISIPController');
Route::resource('fakultas_hakipaten_FP', 'Fakultas_hakipaten\FPController');
Route::resource('fakultas_hakipaten_FK', 'Fakultas_hakipaten\FKController');
Route::resource('fakultas_hakipaten_FT', 'Fakultas_hakipaten\FTController');
Route::resource('fakultas_hakipaten_FMIPA', 'Fakultas_hakipaten\FMIPAController');
Route::resource('fakultas_hakipaten_FSRD', 'Fakultas_hakipaten\FSRDController');
Route::resource('fakultas_hakipaten_FKOR', 'Fakultas_hakipaten\FKORController');
Route::resource('fakultas_hakipaten_SV', 'Fakultas_hakipaten\SVController');

//kinerja_jurnal
Route::resource('kinerja_jurnal', 'Kinerja_jurnalController');
Route::resource('fakultas_jurnal_FIB', 'Fakultas_jurnal\FIBController');
Route::resource('fakultas_jurnal_FKIP', 'Fakultas_jurnal\FKIPController');
Route::resource('fakultas_jurnal_FH', 'Fakultas_jurnal\FHController');
Route::resource('fakultas_jurnal_FEB', 'Fakultas_jurnal\FEBController');
Route::resource('fakultas_jurnal_FISIP', 'Fakultas_jurnal\FISIPController');
Route::resource('fakultas_jurnal_FP', 'Fakultas_jurnal\FPController');
Route::resource('fakultas_jurnal_FK', 'Fakultas_jurnal\FKController');
Route::resource('fakultas_jurnal_FT', 'Fakultas_jurnal\FTController');
Route::resource('fakultas_jurnal_FMIPA', 'Fakultas_jurnal\FMIPAController');
Route::resource('fakultas_jurnal_FSRD', 'Fakultas_jurnal\FSRDController');
Route::resource('fakultas_jurnal_FKOR', 'Fakultas_jurnal\FKORController');
Route::resource('fakultas_jurnal_SV', 'Fakultas_jurnal\SVController');

//kinerja_karyacipta
Route::resource('kinerja_karyacipta', 'Kinerja_karyaciptaController');
Route::resource('fakultas_karyacipta_FIB', 'Fakultas_karyacipta\FIBController');
Route::resource('fakultas_karyacipta_FKIP', 'Fakultas_karyacipta\FKIPController');
Route::resource('fakultas_karyacipta_FH', 'Fakultas_karyacipta\FHController');
Route::resource('fakultas_karyacipta_FEB', 'Fakultas_karyacipta\FEBController');
Route::resource('fakultas_karyacipta_FISIP', 'Fakultas_karyacipta\FISIPController');
Route::resource('fakultas_karyacipta_FP', 'Fakultas_karyacipta\FPController');
Route::resource('fakultas_karyacipta_FK', 'Fakultas_karyacipta\FKController');
Route::resource('fakultas_karyacipta_FT', 'Fakultas_karyacipta\FTController');
Route::resource('fakultas_karyacipta_FMIPA', 'Fakultas_karyacipta\FMIPAController');
Route::resource('fakultas_karyacipta_FSRD', 'Fakultas_karyacipta\FSRDController');
Route::resource('fakultas_karyacipta_FKOR', 'Fakultas_karyacipta\FKORController');
Route::resource('fakultas_karyacipta_SV', 'Fakultas_karyacipta\SVController');

//kinerja_karyaseni
Route::resource('kinerja_karyaseni', 'Kinerja_karyaseniController');
Route::resource('fakultas_karyaseni_FIB', 'Fakultas_karyaseni\FIBController');
Route::resource('fakultas_karyaseni_FKIP', 'Fakultas_karyaseni\FKIPController');
Route::resource('fakultas_karyaseni_FH', 'Fakultas_karyaseni\FHController');
Route::resource('fakultas_karyaseni_FEB', 'Fakultas_karyaseni\FEBController');
Route::resource('fakultas_karyaseni_FISIP', 'Fakultas_karyaseni\FISIPController');
Route::resource('fakultas_karyaseni_FP', 'Fakultas_karyaseni\FPController');
Route::resource('fakultas_karyaseni_FK', 'Fakultas_karyaseni\FKController');
Route::resource('fakultas_karyaseni_FT', 'Fakultas_karyaseni\FTController');
Route::resource('fakultas_karyaseni_FMIPA', 'Fakultas_karyaseni\FMIPAController');
Route::resource('fakultas_karyaseni_FSRD', 'Fakultas_karyaseni\FSRDController');
Route::resource('fakultas_karyaseni_FKOR', 'Fakultas_karyaseni\FKORController');
Route::resource('fakultas_karyaseni_SV', 'Fakultas_karyaseni\SVController');

//kinerja_koran
Route::resource('kinerja_koran', 'Kinerja_koranController');
Route::resource('fakultas_koran_FIB', 'Fakultas_koran\FIBController');
Route::resource('fakultas_koran_FKIP', 'Fakultas_koran\FKIPController');
Route::resource('fakultas_koran_FH', 'Fakultas_koran\FHController');
Route::resource('fakultas_koran_FEB', 'Fakultas_koran\FEBController');
Route::resource('fakultas_koran_FISIP', 'Fakultas_koran\FISIPController');
Route::resource('fakultas_koran_FP', 'Fakultas_koran\FPController');
Route::resource('fakultas_koran_FK', 'Fakultas_koran\FKController');
Route::resource('fakultas_koran_FT', 'Fakultas_koran\FTController');
Route::resource('fakultas_koran_FMIPA', 'Fakultas_koran\FMIPAController');
Route::resource('fakultas_koran_FSRD', 'Fakultas_koran\FSRDController');
Route::resource('fakultas_koran_FKOR', 'Fakultas_koran\FKORController');
Route::resource('fakultas_koran_SV', 'Fakultas_koran\SVController');

//kinerja_pembicara
Route::resource('kinerja_pembicara', 'Kinerja_pembicaraController');
Route::resource('fakultas_pembicara_FIB', 'Fakultas_pembicara\FIBController');
Route::resource('fakultas_pembicara_FKIP', 'Fakultas_pembicara\FKIPController');
Route::resource('fakultas_pembicara_FH', 'Fakultas_pembicara\FHController');
Route::resource('fakultas_pembicara_FEB', 'Fakultas_pembicara\FEBController');
Route::resource('fakultas_pembicara_FISIP', 'Fakultas_pembicara\FISIPController');
Route::resource('fakultas_pembicara_FP', 'Fakultas_pembicara\FPController');
Route::resource('fakultas_pembicara_FK', 'Fakultas_pembicara\FKController');
Route::resource('fakultas_pembicara_FT', 'Fakultas_pembicara\FTController');
Route::resource('fakultas_pembicara_FMIPA', 'Fakultas_pembicara\FMIPAController');
Route::resource('fakultas_pembicara_FSRD', 'Fakultas_pembicara\FSRDController');
Route::resource('fakultas_pembicara_FKOR', 'Fakultas_pembicara\FKORController');
Route::resource('fakultas_pembicara_SV', 'Fakultas_pembicara\SVController');

//kinerja_pengabdian
Route::resource('kinerja_pengabdian', 'Kinerja_pengabdianController');
Route::resource('fakultas_pengabdian_FIB', 'Fakultas_pengabdian\FIBController');
Route::resource('fakultas_pengabdian_FKIP', 'Fakultas_pengabdian\FKIPController');
Route::resource('fakultas_pengabdian_FH', 'Fakultas_pengabdian\FHController');
Route::resource('fakultas_pengabdian_FEB', 'Fakultas_pengabdian\FEBController');
Route::resource('fakultas_pengabdian_FISIP', 'Fakultas_pengabdian\FISIPController');
Route::resource('fakultas_pengabdian_FP', 'Fakultas_pengabdian\FPController');
Route::resource('fakultas_pengabdian_FK', 'Fakultas_pengabdian\FKController');
Route::resource('fakultas_pengabdian_FT', 'Fakultas_pengabdian\FTController');
Route::resource('fakultas_pengabdian_FMIPA', 'Fakultas_pengabdian\FMIPAController');
Route::resource('fakultas_pengabdian_FSRD', 'Fakultas_pengabdian\FSRDController');
Route::resource('fakultas_pengabdian_FKOR', 'Fakultas_pengabdian\FKORController');
Route::resource('fakultas_pengabdian_SV', 'Fakultas_pengabdian\SVController');

//kinerja_program
Route::resource('kinerja_program', 'Kinerja_programController');
Route::resource('fakultas_program_FIB', 'Fakultas_program\FIBController');
Route::resource('fakultas_program_FKIP', 'Fakultas_program\FKIPController');
Route::resource('fakultas_program_FH', 'Fakultas_program\FHController');
Route::resource('fakultas_program_FEB', 'Fakultas_program\FEBController');
Route::resource('fakultas_program_FISIP', 'Fakultas_program\FISIPController');
Route::resource('fakultas_program_FP', 'Fakultas_program\FPController');
Route::resource('fakultas_program_FK', 'Fakultas_program\FKController');
Route::resource('fakultas_program_FT', 'Fakultas_program\FTController');
Route::resource('fakultas_program_FMIPA', 'Fakultas_program\FMIPAController');
Route::resource('fakultas_program_FSRD', 'Fakultas_program\FSRDController');
Route::resource('fakultas_program_FKOR', 'Fakultas_program\FKORController');
Route::resource('fakultas_program_SV', 'Fakultas_program\SVController');

//kinerja_reviewer
Route::resource('kinerja_reviewer', 'Kinerja_reviewerController');
Route::resource('fakultas_reviewer_FIB', 'Fakultas_reviewer\FIBController');
Route::resource('fakultas_reviewer_FKIP', 'Fakultas_reviewer\FKIPController');
Route::resource('fakultas_reviewer_FH', 'Fakultas_reviewer\FHController');
Route::resource('fakultas_reviewer_FEB', 'Fakultas_reviewer\FEBController');
Route::resource('fakultas_reviewer_FISIP', 'Fakultas_reviewer\FISIPController');
Route::resource('fakultas_reviewer_FP', 'Fakultas_reviewer\FPController');
Route::resource('fakultas_reviewer_FK', 'Fakultas_reviewer\FKController');
Route::resource('fakultas_reviewer_FT', 'Fakultas_reviewer\FTController');
Route::resource('fakultas_reviewer_FMIPA', 'Fakultas_reviewer\FMIPAController');
Route::resource('fakultas_reviewer_FSRD', 'Fakultas_reviewer\FSRDController');
Route::resource('fakultas_reviewer_FKOR', 'Fakultas_reviewer\FKORController');
Route::resource('fakultas_reviewer_SV', 'Fakultas_reviewer\SVController');

//kinerja_scopus
Route::resource('kinerja_scopus', 'Kinerja_scopusController');
Route::resource('fakultas_scopus_FIB', 'Fakultas_scopus\FIBController');
Route::resource('fakultas_scopus_FKIP', 'Fakultas_scopus\FKIPController');
Route::resource('fakultas_scopus_FH', 'Fakultas_scopus\FHController');
Route::resource('fakultas_scopus_FEB', 'Fakultas_scopus\FEBController');
Route::resource('fakultas_scopus_FISIP', 'Fakultas_scopus\FISIPController');
Route::resource('fakultas_scopus_FP', 'Fakultas_scopus\FPController');
Route::resource('fakultas_scopus_FK', 'Fakultas_scopus\FKController');
Route::resource('fakultas_scopus_FT', 'Fakultas_scopus\FTController');
Route::resource('fakultas_scopus_FMIPA', 'Fakultas_scopus\FMIPAController');
Route::resource('fakultas_scopus_FSRD', 'Fakultas_scopus\FSRDController');
Route::resource('fakultas_scopus_FKOR', 'Fakultas_scopus\FKORController');
Route::resource('fakultas_scopus_SV', 'Fakultas_scopus\SVController');

//kinerja_seminar
Route::resource('kinerja_seminar', 'Kinerja_seminarController');
Route::resource('fakultas_seminar_FIB', 'Fakultas_seminar\FIBController');
Route::resource('fakultas_seminar_FKIP', 'Fakultas_seminar\FKIPController');
Route::resource('fakultas_seminar_FH', 'Fakultas_seminar\FHController');
Route::resource('fakultas_seminar_FEB', 'Fakultas_seminar\FEBController');
Route::resource('fakultas_seminar_FISIP', 'Fakultas_seminar\FISIPController');
Route::resource('fakultas_seminar_FP', 'Fakultas_seminar\FPController');
Route::resource('fakultas_seminar_FK', 'Fakultas_seminar\FKController');
Route::resource('fakultas_seminar_FT', 'Fakultas_seminar\FTController');
Route::resource('fakultas_seminar_FMIPA', 'Fakultas_seminar\FMIPAController');
Route::resource('fakultas_seminar_FSRD', 'Fakultas_seminar\FSRDController');
Route::resource('fakultas_seminar_FKOR', 'Fakultas_seminar\FKORController');
Route::resource('fakultas_seminar_SV', 'Fakultas_seminar\SVController');

//Eksport_Excel
Route::get('/buku_ex', 'Kinerja_bukuController@buku_ex');
Route::get('/hakipaten_ex', 'Kinerja_hakipatenController@hakipaten_ex');
Route::get('/jurnal_ex', 'Kinerja_jurnalController@jurnal_ex');
Route::get('/karyacipta_ex', 'Kinerja_karyaciptaController@karyacipta_ex');
Route::get('/karyaseni_ex', 'Kinerja_karyaseniController@karyaseni_ex');
Route::get('/koran_ex', 'Kinerja_koranController@koran_ex');
Route::get('/pembicara_ex', 'Kinerja_pembicaraController@pembicara_ex');
Route::get('/pengabdian_ex', 'Kinerja_pengabdianController@pengabdian_ex');
Route::get('/program_ex', 'Kinerja_programController@program_ex');
Route::get('/reviewer_ex', 'Kinerja_reviewerController@reviewer_ex');
Route::get('/scopus_ex', 'Kinerja_scopusController@scopus_ex');
Route::get('/seminar_ex', 'Kinerja_seminarController@seminar_ex');


/* Route::get('/search', 'Kinerja_bukuController@search'); */
/* Route::get('/caribuku', function(){
    $result = QueryBuilder::for(Kinerja_buku::class)
    ->allowedFilters(['tahun'])
    ->get();
    return $result;
    return view('kinerja_buku.index');
}); */

/* Route::get('/emp.list', 'EmpController@ss_processing'); */