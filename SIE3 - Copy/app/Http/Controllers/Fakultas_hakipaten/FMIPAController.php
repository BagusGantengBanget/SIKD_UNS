<?php

namespace App\Http\Controllers\Fakultas_hakipaten;

use Illuminate\Database\Query\Builder;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Kinerja_hakipaten;
use DB;
use App\Exports\hakipatenExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;
use Illuminate\Pagination\Paginator;
/* use Illuminate\Support\Collection; */
use Illuminate\Pagination\LengthAwarePaginator;

class FMIPAController extends Controller
{

    public function index(Request $request)
    {
        $pagination = 20;
        $keyword = $request->keyword;
        $data = DB::table('kinerja_hakipaten_author')
        ->join('kinerja_hakipaten', 'kinerja_hakipaten.id_hakipaten', '=', 'kinerja_hakipaten_author.id')
        ->join('dosen', 'dosen.nidn', '=', 'kinerja_hakipaten_author.nidn')
        ->join('remun_point_terindex', 'kinerja_hakipaten.id_terindek', '=', 'remun_point_terindex.id_terindek' ) 
        ->join('REF_UNIT', 'dosen.id_sub_unit', '=', 'REF_UNIT.ID' ) 
        ->join('REF_UNIT_FAKULTAS', 'dosen.id_unit', '=', 'REF_UNIT_FAKULTAS.ID_FAKULTAS')
        ->where('REF_UNIT_FAKULTAS.FAKULTAS', '=', 'FMIPA')
        ->where('kinerja_hakipaten.tahun','like','%'.$keyword.'%')
        ->orWhere('remun_point_terindex.nama_tmp','like','%'.$keyword.'%')
        ->get();
        /* ->orderBy('tahun','desc') */
        /* $data->appends($request->all()); */
       
        $tahun = DB::table('trx_penelitian')
        ->join('penelitian', 'trx_penelitian.id_penelitian', '=', 'penelitian.id_penelitian')
        ->where('penelitian.tahun','like','%'.$keyword.'%')
        ->groupBy('penelitian.tahun',)
        ->select('penelitian.tahun')
        ->get();
        foreach($tahun as $dt){
            $tahunpen = $dt->tahun;
        }
        //==========================================================Kategori Prodi============================================================//

        //Grafik Tervalidasi Fakultas
        $validasifak = DB::table('kinerja_hakipaten_author')
        ->join('kinerja_hakipaten', 'kinerja_hakipaten.id_hakipaten', '=', 'kinerja_hakipaten_author.id')
        ->join('dosen', 'dosen.nidn', '=', 'kinerja_hakipaten_author.nidn')
        ->join('REF_UNIT_FAKULTAS', 'dosen.id_unit', '=', 'REF_UNIT_FAKULTAS.ID_FAKULTAS')
        ->join('REF_UNIT', 'dosen.id_sub_unit', '=', 'REF_UNIT.ID' ) 
        ->join('remun_point_terindex', 'kinerja_hakipaten.id_terindek', '=', 'remun_point_terindex.id_terindek' ) 
        ->where('kinerja_hakipaten.status_hakipaten', '=', 'Tervalidasi')
        ->where('REF_UNIT_FAKULTAS.FAKULTAS', '=', 'FMIPA')
        ->Where('kinerja_hakipaten.tahun','like','%'.$keyword.'%')
        ->groupBy('REF_UNIT.NAMA',)
        ->select('REF_UNIT.NAMA',  \DB::raw('count(*) as totalval'))
        ->get();
        
        $categoriesval = [];
        $dataval=[];
        foreach($validasifak as $dt){
            $categoriesval[] = $dt->NAMA;
            $dataval[] = $dt->totalval;
            /* $data2[] = strval($dt->total)->wherePivot('ID_FAKULTAS', strval($dt->ID_FAKULTAS))->first()->pivot->total; */
        }
        
        //Grafik Kategori
        $cathakipaten = DB::table('kinerja_hakipaten_author')
        ->join('kinerja_hakipaten', 'kinerja_hakipaten.id_hakipaten', '=', 'kinerja_hakipaten_author.id')
        ->join('dosen', 'dosen.nidn', '=', 'kinerja_hakipaten_author.nidn')
        ->join('REF_UNIT_FAKULTAS', 'dosen.id_unit', '=', 'REF_UNIT_FAKULTAS.ID_FAKULTAS')
        ->join('REF_UNIT', 'dosen.id_sub_unit', '=', 'REF_UNIT.ID' ) 
        ->join('remun_point_terindex', 'kinerja_hakipaten.id_terindek', '=', 'remun_point_terindex.id_terindek' ) 
        ->where('REF_UNIT_FAKULTAS.FAKULTAS', '=', 'FMIPA')
        ->Where('kinerja_hakipaten.tahun','like','%'.$keyword.'%')
        ->groupBy('remun_point_terindex.nama_tmp',)
        ->select('remun_point_terindex.nama_tmp',  \DB::raw('count(*) as totalcat'))
        ->get();

        $categoriescat = [];
        $datacat=[];
        foreach($cathakipaten as $dt){
            $categoriescat[] = $dt->nama_tmp;
            $datacat[] = $dt->totalcat;
        }

        $slide1 = DB::table('kinerja_hakipaten_author')
        ->join('kinerja_hakipaten', 'kinerja_hakipaten.id_hakipaten', '=', 'kinerja_hakipaten_author.id')
        ->join('dosen', 'dosen.nidn', '=', 'kinerja_hakipaten_author.nidn')
        ->join('REF_UNIT_FAKULTAS', 'dosen.id_unit', '=', 'REF_UNIT_FAKULTAS.ID_FAKULTAS')
        ->join('remun_point_terindex', 'kinerja_hakipaten.id_terindek', '=', 'remun_point_terindex.id_terindek' ) 
       ->join('REF_UNIT', 'dosen.id_sub_unit', '=', 'REF_UNIT.ID' ) 
        ->where('REF_UNIT_FAKULTAS.FAKULTAS', '=', 'FMIPA')
        ->where('kinerja_hakipaten.id_terindek', '=', 10)
        ->Where('kinerja_hakipaten.tahun','like','%'.$keyword.'%')
        ->groupBy('REF_UNIT.NAMA')
        ->select('REF_UNIT.NAMA',  \DB::raw('count(*) as totalslide1'))
        ->get();

        $categoriesslide1 = [];
        $dataslide1=[];
        foreach($slide1 as $dt){
            $categoriesslide1[] = $dt->NAMA;
            $dataslide1[] = $dt->totalslide1;
        }

        $slide2 = DB::table('kinerja_hakipaten_author')
        ->join('kinerja_hakipaten', 'kinerja_hakipaten.id_hakipaten', '=', 'kinerja_hakipaten_author.id')
        ->join('dosen', 'dosen.nidn', '=', 'kinerja_hakipaten_author.nidn')
        ->join('REF_UNIT_FAKULTAS', 'dosen.id_unit', '=', 'REF_UNIT_FAKULTAS.ID_FAKULTAS')
        ->join('remun_point_terindex', 'kinerja_hakipaten.id_terindek', '=', 'remun_point_terindex.id_terindek' ) 
       ->join('REF_UNIT', 'dosen.id_sub_unit', '=', 'REF_UNIT.ID' ) 
        ->where('REF_UNIT_FAKULTAS.FAKULTAS', '=', 'FMIPA')
        ->where('kinerja_hakipaten.id_terindek', '=', 11)
        ->Where('kinerja_hakipaten.tahun','like','%'.$keyword.'%')
        ->groupBy('REF_UNIT.NAMA')
        ->select('REF_UNIT.NAMA',  \DB::raw('count(*) as totalslide2'))
        ->get();

        $categoriesslide2 = [];
        $dataslide2=[];
        foreach($slide2 as $dt){
            $categoriesslide2[] = $dt->NAMA;
            $dataslide2[] = $dt->totalslide2;
        }

        $slide3 = DB::table('kinerja_hakipaten_author')
        ->join('kinerja_hakipaten', 'kinerja_hakipaten.id_hakipaten', '=', 'kinerja_hakipaten_author.id')
        ->join('dosen', 'dosen.nidn', '=', 'kinerja_hakipaten_author.nidn')
        ->join('REF_UNIT_FAKULTAS', 'dosen.id_unit', '=', 'REF_UNIT_FAKULTAS.ID_FAKULTAS')
        ->join('remun_point_terindex', 'kinerja_hakipaten.id_terindek', '=', 'remun_point_terindex.id_terindek' ) 
       ->join('REF_UNIT', 'dosen.id_sub_unit', '=', 'REF_UNIT.ID' ) 
        ->where('REF_UNIT_FAKULTAS.FAKULTAS', '=', 'FMIPA')
        ->where('kinerja_hakipaten.id_terindek', '=', 12)
        ->Where('kinerja_hakipaten.tahun','like','%'.$keyword.'%')
        ->groupBy('REF_UNIT.NAMA')
        ->select('REF_UNIT.NAMA',  \DB::raw('count(*) as totalslide3'))
        ->get();

        $categoriesslide3 = [];
        $dataslide3=[];
        foreach($slide3 as $dt){
            $categoriesslide3[] = $dt->NAMA;
            $dataslide3[] = $dt->totalslide3;
        }
       
        $slide4 = DB::table('kinerja_hakipaten_author')
        ->join('kinerja_hakipaten', 'kinerja_hakipaten.id_hakipaten', '=', 'kinerja_hakipaten_author.id')
        ->join('dosen', 'dosen.nidn', '=', 'kinerja_hakipaten_author.nidn')
        ->join('REF_UNIT_FAKULTAS', 'dosen.id_unit', '=', 'REF_UNIT_FAKULTAS.ID_FAKULTAS')
        ->join('remun_point_terindex', 'kinerja_hakipaten.id_terindek', '=', 'remun_point_terindex.id_terindek' ) 
       ->join('REF_UNIT', 'dosen.id_sub_unit', '=', 'REF_UNIT.ID' ) 
        ->where('REF_UNIT_FAKULTAS.FAKULTAS', '=', 'FMIPA')
        ->where('kinerja_hakipaten.id_terindek', '=', 13)
        ->Where('kinerja_hakipaten.tahun','like','%'.$keyword.'%')
        ->groupBy('REF_UNIT.NAMA')
        ->select('REF_UNIT.NAMA',  \DB::raw('count(*) as totalslide4'))
        ->get();

        $categoriesslide4 = [];
        $dataslide4=[];
        foreach($slide4 as $dt){
            $categoriesslide4[] = $dt->NAMA;
            $dataslide4[] = $dt->totalslide4;
        }
        
       //2017
       $ditolak17 = DB::table('kinerja_hakipaten_author')
       ->join('kinerja_hakipaten', 'kinerja_hakipaten.id_hakipaten', '=', 'kinerja_hakipaten_author.id')
       ->join('dosen', 'dosen.nidn', '=', 'kinerja_hakipaten_author.nidn')
        ->join('remun_point_terindex', 'kinerja_hakipaten.id_terindek', '=', 'remun_point_terindex.id_terindek' ) 
       ->join('REF_UNIT', 'dosen.id_sub_unit', '=', 'REF_UNIT.ID' ) 
       ->join('REF_UNIT_FAKULTAS', 'dosen.id_unit', '=', 'REF_UNIT_FAKULTAS.ID_FAKULTAS')
        ->where('REF_UNIT_FAKULTAS.FAKULTAS', '=', 'FMIPA')
       ->where('status_hakipaten', '=', 'Ditolak')
       ->where('tahun', '=', 2017)
       ->get()->count();
       $menunggu17 = DB::table('kinerja_hakipaten_author')
       ->join('kinerja_hakipaten', 'kinerja_hakipaten.id_hakipaten', '=', 'kinerja_hakipaten_author.id')
       ->join('dosen', 'dosen.nidn', '=', 'kinerja_hakipaten_author.nidn')
        ->join('remun_point_terindex', 'kinerja_hakipaten.id_terindek', '=', 'remun_point_terindex.id_terindek' ) 
       ->join('REF_UNIT', 'dosen.id_sub_unit', '=', 'REF_UNIT.ID' ) 
       ->join('REF_UNIT_FAKULTAS', 'dosen.id_unit', '=', 'REF_UNIT_FAKULTAS.ID_FAKULTAS')
        ->where('REF_UNIT_FAKULTAS.FAKULTAS', '=', 'FMIPA')
       ->where('status_hakipaten', '=', 'Menunggu')
       ->where('tahun', '=', 2017)
       ->get()->count();
       $tervalidasi17 = DB::table('kinerja_hakipaten_author')
       ->join('kinerja_hakipaten', 'kinerja_hakipaten.id_hakipaten', '=', 'kinerja_hakipaten_author.id')
       ->join('dosen', 'dosen.nidn', '=', 'kinerja_hakipaten_author.nidn')
        ->join('remun_point_terindex', 'kinerja_hakipaten.id_terindek', '=', 'remun_point_terindex.id_terindek' ) 
       ->join('REF_UNIT', 'dosen.id_sub_unit', '=', 'REF_UNIT.ID' ) 
       ->join('REF_UNIT_FAKULTAS', 'dosen.id_unit', '=', 'REF_UNIT_FAKULTAS.ID_FAKULTAS')
        ->where('REF_UNIT_FAKULTAS.FAKULTAS', '=', 'FMIPA')
       ->where('status_hakipaten', '=', 'Tervalidasi')
       ->where('tahun', '=', 2017)
       ->get()->count();
       $perbaiki17 = DB::table('kinerja_hakipaten_author')
       ->join('kinerja_hakipaten', 'kinerja_hakipaten.id_hakipaten', '=', 'kinerja_hakipaten_author.id')
       ->join('dosen', 'dosen.nidn', '=', 'kinerja_hakipaten_author.nidn')
        ->join('remun_point_terindex', 'kinerja_hakipaten.id_terindek', '=', 'remun_point_terindex.id_terindek' ) 
       ->join('REF_UNIT', 'dosen.id_sub_unit', '=', 'REF_UNIT.ID' ) 
       ->join('REF_UNIT_FAKULTAS', 'dosen.id_unit', '=', 'REF_UNIT_FAKULTAS.ID_FAKULTAS')
        ->where('REF_UNIT_FAKULTAS.FAKULTAS', '=', 'FMIPA')
       ->where('status_hakipaten', '=', 'Perbaiki')
       ->where('tahun', '=', 2017)
       ->get()->count();
       $terverifikasi17 = DB::table('kinerja_hakipaten_author')
       ->join('kinerja_hakipaten', 'kinerja_hakipaten.id_hakipaten', '=', 'kinerja_hakipaten_author.id')
       ->join('dosen', 'dosen.nidn', '=', 'kinerja_hakipaten_author.nidn')
        ->join('remun_point_terindex', 'kinerja_hakipaten.id_terindek', '=', 'remun_point_terindex.id_terindek' ) 
       ->join('REF_UNIT', 'dosen.id_sub_unit', '=', 'REF_UNIT.ID' ) 
       ->join('REF_UNIT_FAKULTAS', 'dosen.id_unit', '=', 'REF_UNIT_FAKULTAS.ID_FAKULTAS')
        ->where('REF_UNIT_FAKULTAS.FAKULTAS', '=', 'FMIPA')
       ->where('status_hakipaten', '=', 'Terverifikasi')
       ->where('tahun', '=', 2017)
       ->get()->count();

       //2018
       $ditolak18 = DB::table('kinerja_hakipaten_author')
       ->join('kinerja_hakipaten', 'kinerja_hakipaten.id_hakipaten', '=', 'kinerja_hakipaten_author.id')
       ->join('dosen', 'dosen.nidn', '=', 'kinerja_hakipaten_author.nidn')
        ->join('remun_point_terindex', 'kinerja_hakipaten.id_terindek', '=', 'remun_point_terindex.id_terindek' ) 
       ->join('REF_UNIT', 'dosen.id_sub_unit', '=', 'REF_UNIT.ID' ) 
       ->join('REF_UNIT_FAKULTAS', 'dosen.id_unit', '=', 'REF_UNIT_FAKULTAS.ID_FAKULTAS')
        ->where('REF_UNIT_FAKULTAS.FAKULTAS', '=', 'FMIPA')
       ->where('status_hakipaten', '=', 'Ditolak')
       ->where('tahun', '=', 2018)
       ->get()->count();
       $menunggu18 = DB::table('kinerja_hakipaten_author')
       ->join('kinerja_hakipaten', 'kinerja_hakipaten.id_hakipaten', '=', 'kinerja_hakipaten_author.id')
       ->join('dosen', 'dosen.nidn', '=', 'kinerja_hakipaten_author.nidn')
        ->join('remun_point_terindex', 'kinerja_hakipaten.id_terindek', '=', 'remun_point_terindex.id_terindek' ) 
       ->join('REF_UNIT', 'dosen.id_sub_unit', '=', 'REF_UNIT.ID' ) 
       ->join('REF_UNIT_FAKULTAS', 'dosen.id_unit', '=', 'REF_UNIT_FAKULTAS.ID_FAKULTAS')
        ->where('REF_UNIT_FAKULTAS.FAKULTAS', '=', 'FMIPA')
       ->where('status_hakipaten', '=', 'Menunggu')
       ->where('tahun', '=', 2018)
       ->get()->count();
       $tervalidasi18 = DB::table('kinerja_hakipaten_author')
       ->join('kinerja_hakipaten', 'kinerja_hakipaten.id_hakipaten', '=', 'kinerja_hakipaten_author.id')
       ->join('dosen', 'dosen.nidn', '=', 'kinerja_hakipaten_author.nidn')
        ->join('remun_point_terindex', 'kinerja_hakipaten.id_terindek', '=', 'remun_point_terindex.id_terindek' ) 
       ->join('REF_UNIT', 'dosen.id_sub_unit', '=', 'REF_UNIT.ID' ) 
       ->join('REF_UNIT_FAKULTAS', 'dosen.id_unit', '=', 'REF_UNIT_FAKULTAS.ID_FAKULTAS')
        ->where('REF_UNIT_FAKULTAS.FAKULTAS', '=', 'FMIPA')
       ->where('status_hakipaten', '=', 'Tervalidasi')
       ->where('tahun', '=', 2018)
       ->get()->count();
       $perbaiki18 = DB::table('kinerja_hakipaten_author')
       ->join('kinerja_hakipaten', 'kinerja_hakipaten.id_hakipaten', '=', 'kinerja_hakipaten_author.id')
       ->join('dosen', 'dosen.nidn', '=', 'kinerja_hakipaten_author.nidn')
        ->join('remun_point_terindex', 'kinerja_hakipaten.id_terindek', '=', 'remun_point_terindex.id_terindek' ) 
       ->join('REF_UNIT', 'dosen.id_sub_unit', '=', 'REF_UNIT.ID' ) 
       ->join('REF_UNIT_FAKULTAS', 'dosen.id_unit', '=', 'REF_UNIT_FAKULTAS.ID_FAKULTAS')
        ->where('REF_UNIT_FAKULTAS.FAKULTAS', '=', 'FMIPA')
       ->where('status_hakipaten', '=', 'Perbaiki')
       ->where('tahun', '=', 2018)
       ->get()->count();
       $terverifikasi18 = DB::table('kinerja_hakipaten_author')
       ->join('kinerja_hakipaten', 'kinerja_hakipaten.id_hakipaten', '=', 'kinerja_hakipaten_author.id')
       ->join('dosen', 'dosen.nidn', '=', 'kinerja_hakipaten_author.nidn')
        ->join('remun_point_terindex', 'kinerja_hakipaten.id_terindek', '=', 'remun_point_terindex.id_terindek' ) 
       ->join('REF_UNIT', 'dosen.id_sub_unit', '=', 'REF_UNIT.ID' ) 
       ->join('REF_UNIT_FAKULTAS', 'dosen.id_unit', '=', 'REF_UNIT_FAKULTAS.ID_FAKULTAS')
        ->where('REF_UNIT_FAKULTAS.FAKULTAS', '=', 'FMIPA')
       ->where('status_hakipaten', '=', 'Terverifikasi')
       ->where('tahun', '=', 2018)
       ->get()->count();

       //2019
       $ditolak19 = DB::table('kinerja_hakipaten_author')
       ->join('kinerja_hakipaten', 'kinerja_hakipaten.id_hakipaten', '=', 'kinerja_hakipaten_author.id')
       ->join('dosen', 'dosen.nidn', '=', 'kinerja_hakipaten_author.nidn')
        ->join('remun_point_terindex', 'kinerja_hakipaten.id_terindek', '=', 'remun_point_terindex.id_terindek' ) 
       ->join('REF_UNIT', 'dosen.id_sub_unit', '=', 'REF_UNIT.ID' ) 
       ->join('REF_UNIT_FAKULTAS', 'dosen.id_unit', '=', 'REF_UNIT_FAKULTAS.ID_FAKULTAS')
        ->where('REF_UNIT_FAKULTAS.FAKULTAS', '=', 'FMIPA')
       ->where('status_hakipaten', '=', 'Ditolak')
       ->where('tahun', '=', 2019)
       ->get()->count();
       $menunggu19 = DB::table('kinerja_hakipaten_author')
       ->join('kinerja_hakipaten', 'kinerja_hakipaten.id_hakipaten', '=', 'kinerja_hakipaten_author.id')
       ->join('dosen', 'dosen.nidn', '=', 'kinerja_hakipaten_author.nidn')
        ->join('remun_point_terindex', 'kinerja_hakipaten.id_terindek', '=', 'remun_point_terindex.id_terindek' ) 
       ->join('REF_UNIT', 'dosen.id_sub_unit', '=', 'REF_UNIT.ID' ) 
       ->join('REF_UNIT_FAKULTAS', 'dosen.id_unit', '=', 'REF_UNIT_FAKULTAS.ID_FAKULTAS')
        ->where('REF_UNIT_FAKULTAS.FAKULTAS', '=', 'FMIPA')
       ->where('status_hakipaten', '=', 'Menunggu')
       ->where('tahun', '=', 2019)
       ->get()->count();
       $tervalidasi19 = DB::table('kinerja_hakipaten_author')
       ->join('kinerja_hakipaten', 'kinerja_hakipaten.id_hakipaten', '=', 'kinerja_hakipaten_author.id')
       ->join('dosen', 'dosen.nidn', '=', 'kinerja_hakipaten_author.nidn')
        ->join('remun_point_terindex', 'kinerja_hakipaten.id_terindek', '=', 'remun_point_terindex.id_terindek' ) 
       ->join('REF_UNIT', 'dosen.id_sub_unit', '=', 'REF_UNIT.ID' ) 
       ->join('REF_UNIT_FAKULTAS', 'dosen.id_unit', '=', 'REF_UNIT_FAKULTAS.ID_FAKULTAS')
        ->where('REF_UNIT_FAKULTAS.FAKULTAS', '=', 'FMIPA')
       ->where('status_hakipaten', '=', 'Tervalidasi')
       ->where('tahun', '=', 2019)
       ->get()->count();
       $perbaiki19 = DB::table('kinerja_hakipaten_author')
       ->join('kinerja_hakipaten', 'kinerja_hakipaten.id_hakipaten', '=', 'kinerja_hakipaten_author.id')
       ->join('dosen', 'dosen.nidn', '=', 'kinerja_hakipaten_author.nidn')
        ->join('remun_point_terindex', 'kinerja_hakipaten.id_terindek', '=', 'remun_point_terindex.id_terindek' ) 
       ->join('REF_UNIT', 'dosen.id_sub_unit', '=', 'REF_UNIT.ID' ) 
       ->join('REF_UNIT_FAKULTAS', 'dosen.id_unit', '=', 'REF_UNIT_FAKULTAS.ID_FAKULTAS')
        ->where('REF_UNIT_FAKULTAS.FAKULTAS', '=', 'FMIPA')
       ->where('status_hakipaten', '=', 'Perbaiki')
       ->where('tahun', '=', 2019)
       ->get()->count();
       $terverifikasi19 = DB::table('kinerja_hakipaten_author')
       ->join('kinerja_hakipaten', 'kinerja_hakipaten.id_hakipaten', '=', 'kinerja_hakipaten_author.id')
       ->join('dosen', 'dosen.nidn', '=', 'kinerja_hakipaten_author.nidn')
        ->join('remun_point_terindex', 'kinerja_hakipaten.id_terindek', '=', 'remun_point_terindex.id_terindek' ) 
       ->join('REF_UNIT', 'dosen.id_sub_unit', '=', 'REF_UNIT.ID' ) 
       ->join('REF_UNIT_FAKULTAS', 'dosen.id_unit', '=', 'REF_UNIT_FAKULTAS.ID_FAKULTAS')
        ->where('REF_UNIT_FAKULTAS.FAKULTAS', '=', 'FMIPA')
       ->where('status_hakipaten', '=', 'Terverifikasi')
       ->where('tahun', '=', 2019)
       ->get()->count();

       //2020
       $ditolak20 = DB::table('kinerja_hakipaten_author')
       ->join('kinerja_hakipaten', 'kinerja_hakipaten.id_hakipaten', '=', 'kinerja_hakipaten_author.id')
       ->join('dosen', 'dosen.nidn', '=', 'kinerja_hakipaten_author.nidn')
        ->join('remun_point_terindex', 'kinerja_hakipaten.id_terindek', '=', 'remun_point_terindex.id_terindek' ) 
       ->join('REF_UNIT', 'dosen.id_sub_unit', '=', 'REF_UNIT.ID' ) 
       ->join('REF_UNIT_FAKULTAS', 'dosen.id_unit', '=', 'REF_UNIT_FAKULTAS.ID_FAKULTAS')
        ->where('REF_UNIT_FAKULTAS.FAKULTAS', '=', 'FMIPA')
       ->where('status_hakipaten', '=', 'Ditolak')
       ->where('tahun', '=', 2020)
       ->get()->count();
       $menunggu20 = DB::table('kinerja_hakipaten_author')
       ->join('kinerja_hakipaten', 'kinerja_hakipaten.id_hakipaten', '=', 'kinerja_hakipaten_author.id')
       ->join('dosen', 'dosen.nidn', '=', 'kinerja_hakipaten_author.nidn')
        ->join('remun_point_terindex', 'kinerja_hakipaten.id_terindek', '=', 'remun_point_terindex.id_terindek' ) 
       ->join('REF_UNIT', 'dosen.id_sub_unit', '=', 'REF_UNIT.ID' ) 
       ->join('REF_UNIT_FAKULTAS', 'dosen.id_unit', '=', 'REF_UNIT_FAKULTAS.ID_FAKULTAS')
        ->where('REF_UNIT_FAKULTAS.FAKULTAS', '=', 'FMIPA')
       ->where('status_hakipaten', '=', 'Menunggu')
       ->where('tahun', '=', 2020)
       ->get()->count();
       $tervalidasi20 = DB::table('kinerja_hakipaten_author')
       ->join('kinerja_hakipaten', 'kinerja_hakipaten.id_hakipaten', '=', 'kinerja_hakipaten_author.id')
       ->join('dosen', 'dosen.nidn', '=', 'kinerja_hakipaten_author.nidn')
        ->join('remun_point_terindex', 'kinerja_hakipaten.id_terindek', '=', 'remun_point_terindex.id_terindek' ) 
       ->join('REF_UNIT', 'dosen.id_sub_unit', '=', 'REF_UNIT.ID' ) 
       ->join('REF_UNIT_FAKULTAS', 'dosen.id_unit', '=', 'REF_UNIT_FAKULTAS.ID_FAKULTAS')
        ->where('REF_UNIT_FAKULTAS.FAKULTAS', '=', 'FMIPA')
       ->where('status_hakipaten', '=', 'Tervalidasi')
       ->where('tahun', '=', 2020)
       ->get()->count();
       $perbaiki20 = DB::table('kinerja_hakipaten_author')
       ->join('kinerja_hakipaten', 'kinerja_hakipaten.id_hakipaten', '=', 'kinerja_hakipaten_author.id')
       ->join('dosen', 'dosen.nidn', '=', 'kinerja_hakipaten_author.nidn')
        ->join('remun_point_terindex', 'kinerja_hakipaten.id_terindek', '=', 'remun_point_terindex.id_terindek' ) 
       ->join('REF_UNIT', 'dosen.id_sub_unit', '=', 'REF_UNIT.ID' ) 
       ->join('REF_UNIT_FAKULTAS', 'dosen.id_unit', '=', 'REF_UNIT_FAKULTAS.ID_FAKULTAS')
        ->where('REF_UNIT_FAKULTAS.FAKULTAS', '=', 'FMIPA')
       ->where('status_hakipaten', '=', 'Perbaiki')
       ->where('tahun', '=', 2020)
       ->get()->count();
       $terverifikasi20 = DB::table('kinerja_hakipaten_author')
       ->join('kinerja_hakipaten', 'kinerja_hakipaten.id_hakipaten', '=', 'kinerja_hakipaten_author.id')
       ->join('dosen', 'dosen.nidn', '=', 'kinerja_hakipaten_author.nidn')
        ->join('remun_point_terindex', 'kinerja_hakipaten.id_terindek', '=', 'remun_point_terindex.id_terindek' ) 
       ->join('REF_UNIT', 'dosen.id_sub_unit', '=', 'REF_UNIT.ID' ) 
       ->join('REF_UNIT_FAKULTAS', 'dosen.id_unit', '=', 'REF_UNIT_FAKULTAS.ID_FAKULTAS')
        ->where('REF_UNIT_FAKULTAS.FAKULTAS', '=', 'FMIPA')
       ->where('status_hakipaten', '=', 'Terverifikasi')
       ->where('tahun', '=', 2020)
       ->get()->count();

       //2021
       $ditolak21 = DB::table('kinerja_hakipaten_author')
       ->join('kinerja_hakipaten', 'kinerja_hakipaten.id_hakipaten', '=', 'kinerja_hakipaten_author.id')
       ->join('dosen', 'dosen.nidn', '=', 'kinerja_hakipaten_author.nidn')
        ->join('remun_point_terindex', 'kinerja_hakipaten.id_terindek', '=', 'remun_point_terindex.id_terindek' ) 
       ->join('REF_UNIT', 'dosen.id_sub_unit', '=', 'REF_UNIT.ID' ) 
       ->join('REF_UNIT_FAKULTAS', 'dosen.id_unit', '=', 'REF_UNIT_FAKULTAS.ID_FAKULTAS')
        ->where('REF_UNIT_FAKULTAS.FAKULTAS', '=', 'FMIPA')
       ->where('status_hakipaten', '=', 'Ditolak')
       ->where('tahun', '=', 2021)
       ->get()->count();
       $menunggu21 = DB::table('kinerja_hakipaten_author')
       ->join('kinerja_hakipaten', 'kinerja_hakipaten.id_hakipaten', '=', 'kinerja_hakipaten_author.id')
       ->join('dosen', 'dosen.nidn', '=', 'kinerja_hakipaten_author.nidn')
        ->join('remun_point_terindex', 'kinerja_hakipaten.id_terindek', '=', 'remun_point_terindex.id_terindek' ) 
       ->join('REF_UNIT', 'dosen.id_sub_unit', '=', 'REF_UNIT.ID' ) 
       ->join('REF_UNIT_FAKULTAS', 'dosen.id_unit', '=', 'REF_UNIT_FAKULTAS.ID_FAKULTAS')
        ->where('REF_UNIT_FAKULTAS.FAKULTAS', '=', 'FMIPA')
       ->where('status_hakipaten', '=', 'Menunggu')
       ->where('tahun', '=', 2021)
       ->get()->count();
       $tervalidasi21 = DB::table('kinerja_hakipaten_author')
       ->join('kinerja_hakipaten', 'kinerja_hakipaten.id_hakipaten', '=', 'kinerja_hakipaten_author.id')
       ->join('dosen', 'dosen.nidn', '=', 'kinerja_hakipaten_author.nidn')
        ->join('remun_point_terindex', 'kinerja_hakipaten.id_terindek', '=', 'remun_point_terindex.id_terindek' ) 
       ->join('REF_UNIT', 'dosen.id_sub_unit', '=', 'REF_UNIT.ID' ) 
       ->join('REF_UNIT_FAKULTAS', 'dosen.id_unit', '=', 'REF_UNIT_FAKULTAS.ID_FAKULTAS')
        ->where('REF_UNIT_FAKULTAS.FAKULTAS', '=', 'FMIPA')
       ->where('status_hakipaten', '=', 'Tervalidasi')
       ->where('tahun', '=', 2021)
       ->get()->count();
       $perbaiki21 = DB::table('kinerja_hakipaten_author')
       ->join('kinerja_hakipaten', 'kinerja_hakipaten.id_hakipaten', '=', 'kinerja_hakipaten_author.id')
       ->join('dosen', 'dosen.nidn', '=', 'kinerja_hakipaten_author.nidn')
        ->join('remun_point_terindex', 'kinerja_hakipaten.id_terindek', '=', 'remun_point_terindex.id_terindek' ) 
       ->join('REF_UNIT', 'dosen.id_sub_unit', '=', 'REF_UNIT.ID' ) 
       ->join('REF_UNIT_FAKULTAS', 'dosen.id_unit', '=', 'REF_UNIT_FAKULTAS.ID_FAKULTAS')
        ->where('REF_UNIT_FAKULTAS.FAKULTAS', '=', 'FMIPA')
       ->where('status_hakipaten', '=', 'Perbaiki')
       ->where('tahun', '=', 2021)
       ->get()->count();
       $terverifikasi21 = DB::table('kinerja_hakipaten_author')
       ->join('kinerja_hakipaten', 'kinerja_hakipaten.id_hakipaten', '=', 'kinerja_hakipaten_author.id')
       ->join('dosen', 'dosen.nidn', '=', 'kinerja_hakipaten_author.nidn')
        ->join('remun_point_terindex', 'kinerja_hakipaten.id_terindek', '=', 'remun_point_terindex.id_terindek' ) 
       ->join('REF_UNIT', 'dosen.id_sub_unit', '=', 'REF_UNIT.ID' ) 
       ->join('REF_UNIT_FAKULTAS', 'dosen.id_unit', '=', 'REF_UNIT_FAKULTAS.ID_FAKULTAS')
        ->where('REF_UNIT_FAKULTAS.FAKULTAS', '=', 'FMIPA')
       ->where('status_hakipaten', '=', 'Terverifikasi')
       ->where('tahun', '=', 2021)
       ->get()->count();

        return view('fakultas_hakipaten_FMIPA.index'  ,compact( ['data'], 'keyword','categoriesval', 'dataval', 'categoriescat', 'datacat', 'tahunpen',
        'ditolak17', 'menunggu17', 'tervalidasi17', 'perbaiki17', 'terverifikasi17',
        'ditolak18', 'menunggu18', 'tervalidasi18', 'perbaiki18', 'terverifikasi18',
        'ditolak19', 'menunggu19', 'tervalidasi19', 'perbaiki19', 'terverifikasi19',
        'ditolak20', 'menunggu20', 'tervalidasi20', 'perbaiki20', 'terverifikasi20',
        'ditolak21', 'menunggu21', 'tervalidasi21', 'perbaiki21', 'terverifikasi21',
        'categoriesslide1', 'dataslide1','categoriesslide2', 'dataslide2','categoriesslide3', 'dataslide3','categoriesslide4', 'dataslide4',
       ))->with('i', ($request->input('page', 1) - 1) * $pagination);
       
    }
    
    /* public function hakipaten_ex()
	{
		return Excel::download(new hakipatenExport, 'Kinerja_hakipaten.xlsx');
	} */

}
/* $query = DB::select('SELECT `dosen`.`id_dosen` AS `ID_DOSEN`, 
                            `dosen`.`nidn_simpeg` AS `NIDN`, 
                            `dosen`.`nip_dosen` AS `NIK`, 
                            `dosen`.`gelar_depan` AS `GELAR_DEPAN`, 
                            `dosen`.`nama` AS `NAMA`, 
                            `dosen`.`gelar_belakang` AS `GELAR_BELAKANG`,
                            `kinerja_hakipaten`.`judul_hakipaten` AS `JUDUL`, 
                            `kinerja_hakipaten`.`penerbit` AS `PUBLISER`, 
                            `kinerja_hakipaten`.`tahun` AS `TAHUN`, 
                            `kinerja_hakipaten`.`isbn` AS `ISBN_ISSN`, 
                            `bidang_kajian`.`nama_kajian` AS `BIDANG_KAJIAN`, 
                            `bidang_ilmu`.`nama_bidangilmu` AS `BIDANG_ILMU`,  
                            `kinerja_hakipaten`.`status_hakipaten` AS `STATUS`, 
                            `REF_UNIT`.`ID` AS `ID_UNIT`, 
                            `REF_UNIT`.`NAMA` AS `JURUSAN`,
                            `REF_UNIT_FAKULTAS`.`FAKULTAS` AS `FAKULTAS` 
                            FROM
                            (((((((( `kinerja_hakipaten_author` JOIN `kinerja_hakipaten` ON (( `kinerja_hakipaten`.`id_hakipaten` = `kinerja_hakipaten_author`.`id`))) 
                            JOIN `dosen` `dosen` ON ( ( `kinerja_hakipaten_author`.`nidn` = `dosen`.`nidn` )))
                            LEFT JOIN `REF_GOLONGAN_RUANG` `g` 
                            ON ( ( `dosen`.`id_gol_ruang` = `g`.`ID_GOL_RUANG` ))) 
                            JOIN `REF_STATUS_HENTI` `s` ON ( ( `dosen`.`id_status_henti` = `s`.`ID_STATUS_HENTI` ))) 
                            JOIN `REF_UNIT` ON ( ( `dosen`.`id_sub_unit` = `REF_UNIT`.`ID` ))) 
                            JOIN `REF_UNIT_FAKULTAS` ON ( ( `dosen`.`id_unit` = `REF_UNIT_FAKULTAS`.`ID_FAKULTAS` ))) 
                            LEFT JOIN `bidang_kajian` ON ( ( `kinerja_hakipaten`.`id_kajian` = `bidang_kajian`.`id_kajian` ))) 
                            LEFT JOIN `bidang_ilmu` ON ( ( `kinerja_hakipaten`.`id_bidangilmu` = `bidang_ilmu`.`id_bidangilmu` ))) ');
    
        $query2 = json_decode(json_encode($query), true); */