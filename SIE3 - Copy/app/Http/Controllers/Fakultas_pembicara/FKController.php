<?php

namespace App\Http\Controllers\Fakultas_pembicara;

use Illuminate\Database\Query\Builder;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Kinerja_pembicara;
use DB;
use App\Exports\pembicaraExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;
use Illuminate\Pagination\Paginator;
/* use Illuminate\Support\Collection; */
use Illuminate\Pagination\LengthAwarePaginator;

class FKController extends Controller
{

    public function index(Request $request)
    {
        $pagination = 20;
        $keyword = $request->keyword;
        $data = DB::table('kinerja_pembicara')
        ->join('dosen', 'dosen.nidn', '=', 'kinerja_pembicara.nidn')
        ->join('remun_point_terindex', 'kinerja_pembicara.id_terindek', '=', 'remun_point_terindex.id_terindek' ) 
        ->join('REF_UNIT', 'dosen.id_sub_unit', '=', 'REF_UNIT.ID' ) 
        ->join('REF_UNIT_FAKULTAS', 'dosen.id_unit', '=', 'REF_UNIT_FAKULTAS.ID_FAKULTAS')
        ->where('REF_UNIT_FAKULTAS.FAKULTAS', '=', 'FK')
        ->where('kinerja_pembicara.tahun','like','%'.$keyword.'%')
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

        $validasifak = DB::table('kinerja_pembicara')
       ->join('dosen', 'dosen.nidn', '=', 'kinerja_pembicara.nidn')
       ->join('REF_UNIT_FAKULTAS', 'dosen.id_unit', '=', 'REF_UNIT_FAKULTAS.ID_FAKULTAS')
       ->join('REF_UNIT', 'dosen.id_sub_unit', '=', 'REF_UNIT.ID' ) 
       ->join('remun_point_terindex', 'kinerja_pembicara.id_terindek', '=', 'remun_point_terindex.id_terindek' ) 
        ->where('REF_UNIT_FAKULTAS.FAKULTAS', '=', 'FK')
       ->where('kinerja_pembicara.status_pembicara', '=', 'Tervalidasi')
       ->Where('kinerja_pembicara.tahun','like','%'.$keyword.'%')
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
       $catpembicara = DB::table('kinerja_pembicara')
       ->join('dosen', 'dosen.nidn', '=', 'kinerja_pembicara.nidn')
       ->join('REF_UNIT_FAKULTAS', 'dosen.id_unit', '=', 'REF_UNIT_FAKULTAS.ID_FAKULTAS')
       ->join('REF_UNIT', 'dosen.id_sub_unit', '=', 'REF_UNIT.ID' ) 
       ->join('remun_point_terindex', 'kinerja_pembicara.id_terindek', '=', 'remun_point_terindex.id_terindek' ) 
        ->where('REF_UNIT_FAKULTAS.FAKULTAS', '=', 'FK')
       ->Where('kinerja_pembicara.tahun','like','%'.$keyword.'%')
       ->groupBy('remun_point_terindex.nama_tmp',)
       ->select('remun_point_terindex.nama_tmp',  \DB::raw('count(*) as totalcat'))
       ->get();

       $categoriescat = [];
       $datacat=[];
       foreach($catpembicara as $dt){
           $categoriescat[] = $dt->nama_tmp;
           $datacat[] = $dt->totalcat;
       }

       $slide1 = DB::table('kinerja_pembicara')
       ->join('dosen', 'dosen.nidn', '=', 'kinerja_pembicara.nidn')
       ->join('REF_UNIT_FAKULTAS', 'dosen.id_unit', '=', 'REF_UNIT_FAKULTAS.ID_FAKULTAS')
       ->join('REF_UNIT', 'dosen.id_sub_unit', '=', 'REF_UNIT.ID' ) 
       ->join('remun_point_terindex', 'kinerja_pembicara.id_terindek', '=', 'remun_point_terindex.id_terindek' ) 
        ->where('REF_UNIT_FAKULTAS.FAKULTAS', '=', 'FK')
       ->where('kinerja_pembicara.id_terindek', '=', 34)
       ->Where('kinerja_pembicara.tahun','like','%'.$keyword.'%')
       ->groupBy('REF_UNIT.NAMA')
       ->select('REF_UNIT.NAMA',  \DB::raw('count(*) as totalslide1'))
       ->get();

       $categoriesslide1 = [];
       $dataslide1=[];
       foreach($slide1 as $dt){
           $categoriesslide1[] = $dt->NAMA;
           $dataslide1[] = $dt->totalslide1;
       }

       $slide2 = DB::table('kinerja_pembicara')
       ->join('dosen', 'dosen.nidn', '=', 'kinerja_pembicara.nidn')
       ->join('REF_UNIT_FAKULTAS', 'dosen.id_unit', '=', 'REF_UNIT_FAKULTAS.ID_FAKULTAS')
       ->join('REF_UNIT', 'dosen.id_sub_unit', '=', 'REF_UNIT.ID' ) 
       ->join('remun_point_terindex', 'kinerja_pembicara.id_terindek', '=', 'remun_point_terindex.id_terindek' ) 
        ->where('REF_UNIT_FAKULTAS.FAKULTAS', '=', 'FK')
       ->where('kinerja_pembicara.id_terindek', '=', 35)
       ->Where('kinerja_pembicara.tahun','like','%'.$keyword.'%')
       ->groupBy('REF_UNIT.NAMA')
       ->select('REF_UNIT.NAMA',  \DB::raw('count(*) as totalslide2'))
       ->get();

       $categoriesslide2 = [];
       $dataslide2=[];
       foreach($slide2 as $dt){
           $categoriesslide2[] = $dt->NAMA;
           $dataslide2[] = $dt->totalslide2;
       }

       $slide3 = DB::table('kinerja_pembicara')
       ->join('dosen', 'dosen.nidn', '=', 'kinerja_pembicara.nidn')
       ->join('REF_UNIT_FAKULTAS', 'dosen.id_unit', '=', 'REF_UNIT_FAKULTAS.ID_FAKULTAS')
       ->join('REF_UNIT', 'dosen.id_sub_unit', '=', 'REF_UNIT.ID' ) 
       ->join('remun_point_terindex', 'kinerja_pembicara.id_terindek', '=', 'remun_point_terindex.id_terindek' ) 
        ->where('REF_UNIT_FAKULTAS.FAKULTAS', '=', 'FK')
       ->where('kinerja_pembicara.id_terindek', '=', 36)
       ->Where('kinerja_pembicara.tahun','like','%'.$keyword.'%')
       ->groupBy('REF_UNIT.NAMA')
       ->select('REF_UNIT.NAMA',  \DB::raw('count(*) as totalslide3'))
       ->get();

       $categoriesslide3 = [];
       $dataslide3=[];
       foreach($slide3 as $dt){
           $categoriesslide3[] = $dt->NAMA;
           $dataslide3[] = $dt->totalslide3;
       }
      
       $slide4 = DB::table('kinerja_pembicara')
       ->join('dosen', 'dosen.nidn', '=', 'kinerja_pembicara.nidn')
       ->join('REF_UNIT_FAKULTAS', 'dosen.id_unit', '=', 'REF_UNIT_FAKULTAS.ID_FAKULTAS')
       ->join('REF_UNIT', 'dosen.id_sub_unit', '=', 'REF_UNIT.ID' ) 
       ->join('remun_point_terindex', 'kinerja_pembicara.id_terindek', '=', 'remun_point_terindex.id_terindek' ) 
        ->where('REF_UNIT_FAKULTAS.FAKULTAS', '=', 'FK')
       ->where('kinerja_pembicara.id_terindek', '=', 37)
       ->Where('kinerja_pembicara.tahun','like','%'.$keyword.'%')
       ->groupBy('REF_UNIT.NAMA')
       ->select('REF_UNIT.NAMA',  \DB::raw('count(*) as totalslide4'))
       ->get();

       $categoriesslide4 = [];
       $dataslide4=[];
       foreach($slide4 as $dt){
           $categoriesslide4[] = $dt->NAMA;
           $dataslide4[] = $dt->totalslide4;
       }
       
       $slide5 = DB::table('kinerja_pembicara')
        ->join('dosen', 'dosen.nidn', '=', 'kinerja_pembicara.nidn')
        ->join('REF_UNIT_FAKULTAS', 'dosen.id_unit', '=', 'REF_UNIT_FAKULTAS.ID_FAKULTAS')
       ->join('REF_UNIT', 'dosen.id_sub_unit', '=', 'REF_UNIT.ID' ) 
        ->join('remun_point_terindex', 'kinerja_pembicara.id_terindek', '=', 'remun_point_terindex.id_terindek' ) 
        ->where('REF_UNIT_FAKULTAS.FAKULTAS', '=', 'FK')
        ->where('kinerja_pembicara.id_terindek', '=', 38)
        ->Where('kinerja_pembicara.tahun','like','%'.$keyword.'%')
        ->groupBy('REF_UNIT.NAMA')
        ->select('REF_UNIT.NAMA',  \DB::raw('count(*) as totalslide5'))
        ->get();

        $categoriesslide5 = [];
        $dataslide5=[];
        foreach($slide5 as $dt){
            $categoriesslide5[] = $dt->NAMA;
            $dataslide5[] = $dt->totalslide5;
        }

        $slide6 = DB::table('kinerja_pembicara')
        ->join('dosen', 'dosen.nidn', '=', 'kinerja_pembicara.nidn')
        ->join('REF_UNIT_FAKULTAS', 'dosen.id_unit', '=', 'REF_UNIT_FAKULTAS.ID_FAKULTAS')
       ->join('REF_UNIT', 'dosen.id_sub_unit', '=', 'REF_UNIT.ID' ) 
        ->join('remun_point_terindex', 'kinerja_pembicara.id_terindek', '=', 'remun_point_terindex.id_terindek' ) 
        ->where('REF_UNIT_FAKULTAS.FAKULTAS', '=', 'FK')
        ->where('kinerja_pembicara.id_terindek', '=', 39)
        ->Where('kinerja_pembicara.tahun','like','%'.$keyword.'%')
        ->groupBy('REF_UNIT.NAMA')
        ->select('REF_UNIT.NAMA',  \DB::raw('count(*) as totalslide6'))
        ->get();

        $categoriesslide6 = [];
        $dataslide6=[];
        foreach($slide6 as $dt){
            $categoriesslide6[] = $dt->NAMA;
            $dataslide6[] = $dt->totalslide6;
        }

        $slide7 = DB::table('kinerja_pembicara')
        ->join('dosen', 'dosen.nidn', '=', 'kinerja_pembicara.nidn')
        ->join('REF_UNIT_FAKULTAS', 'dosen.id_unit', '=', 'REF_UNIT_FAKULTAS.ID_FAKULTAS')
       ->join('REF_UNIT', 'dosen.id_sub_unit', '=', 'REF_UNIT.ID' ) 
        ->join('remun_point_terindex', 'kinerja_pembicara.id_terindek', '=', 'remun_point_terindex.id_terindek' ) 
        ->where('REF_UNIT_FAKULTAS.FAKULTAS', '=', 'FK')
        ->where('kinerja_pembicara.id_terindek', '=', 40)
        ->Where('kinerja_pembicara.tahun','like','%'.$keyword.'%')
        ->groupBy('REF_UNIT.NAMA')
        ->select('REF_UNIT.NAMA',  \DB::raw('count(*) as totalslide7'))
        ->get();

        $categoriesslide7 = [];
        $dataslide7=[];
        foreach($slide7 as $dt){
            $categoriesslide7[] = $dt->NAMA;
            $dataslide7[] = $dt->totalslide7;
        }

        $slide8 = DB::table('kinerja_pembicara')
        ->join('dosen', 'dosen.nidn', '=', 'kinerja_pembicara.nidn')
        ->join('REF_UNIT_FAKULTAS', 'dosen.id_unit', '=', 'REF_UNIT_FAKULTAS.ID_FAKULTAS')
       ->join('REF_UNIT', 'dosen.id_sub_unit', '=', 'REF_UNIT.ID' ) 
        ->join('remun_point_terindex', 'kinerja_pembicara.id_terindek', '=', 'remun_point_terindex.id_terindek' ) 
        ->where('REF_UNIT_FAKULTAS.FAKULTAS', '=', 'FK')
        ->where('kinerja_pembicara.id_terindek', '=', 41)
        ->Where('kinerja_pembicara.tahun','like','%'.$keyword.'%')
        ->groupBy('REF_UNIT.NAMA')
        ->select('REF_UNIT.NAMA',  \DB::raw('count(*) as totalslide8'))
        ->get();

        $categoriesslide8 = [];
        $dataslide8=[];
        foreach($slide8 as $dt){
            $categoriesslide8[] = $dt->NAMA;
            $dataslide8[] = $dt->totalslide8;
        }
        
//===================================
        
       //2017
       $ditolak17 = DB::table('kinerja_pembicara')
       ->join('dosen', 'dosen.nidn', '=', 'kinerja_pembicara.nidn')
        ->join('remun_point_terindex', 'kinerja_pembicara.id_terindek', '=', 'remun_point_terindex.id_terindek' ) 
       ->join('REF_UNIT', 'dosen.id_sub_unit', '=', 'REF_UNIT.ID' ) 
       ->join('REF_UNIT_FAKULTAS', 'dosen.id_unit', '=', 'REF_UNIT_FAKULTAS.ID_FAKULTAS')
        ->where('REF_UNIT_FAKULTAS.FAKULTAS', '=', 'FK')
       ->where('status_pembicara', '=', 'Ditolak')
       ->where('tahun', '=', 2017)
       ->get()->count();
       $menunggu17 = DB::table('kinerja_pembicara')
       ->join('dosen', 'dosen.nidn', '=', 'kinerja_pembicara.nidn')
        ->join('remun_point_terindex', 'kinerja_pembicara.id_terindek', '=', 'remun_point_terindex.id_terindek' ) 
       ->join('REF_UNIT', 'dosen.id_sub_unit', '=', 'REF_UNIT.ID' ) 
       ->join('REF_UNIT_FAKULTAS', 'dosen.id_unit', '=', 'REF_UNIT_FAKULTAS.ID_FAKULTAS')
        ->where('REF_UNIT_FAKULTAS.FAKULTAS', '=', 'FK')
       ->where('status_pembicara', '=', 'Menunggu')
       ->where('tahun', '=', 2017)
       ->get()->count();
       $tervalidasi17 = DB::table('kinerja_pembicara')
       ->join('dosen', 'dosen.nidn', '=', 'kinerja_pembicara.nidn')
        ->join('remun_point_terindex', 'kinerja_pembicara.id_terindek', '=', 'remun_point_terindex.id_terindek' ) 
       ->join('REF_UNIT', 'dosen.id_sub_unit', '=', 'REF_UNIT.ID' ) 
       ->join('REF_UNIT_FAKULTAS', 'dosen.id_unit', '=', 'REF_UNIT_FAKULTAS.ID_FAKULTAS')
        ->where('REF_UNIT_FAKULTAS.FAKULTAS', '=', 'FK')
       ->where('status_pembicara', '=', 'Tervalidasi')
       ->where('tahun', '=', 2017)
       ->get()->count();
       $perbaiki17 = DB::table('kinerja_pembicara')
       ->join('dosen', 'dosen.nidn', '=', 'kinerja_pembicara.nidn')
        ->join('remun_point_terindex', 'kinerja_pembicara.id_terindek', '=', 'remun_point_terindex.id_terindek' ) 
       ->join('REF_UNIT', 'dosen.id_sub_unit', '=', 'REF_UNIT.ID' ) 
       ->join('REF_UNIT_FAKULTAS', 'dosen.id_unit', '=', 'REF_UNIT_FAKULTAS.ID_FAKULTAS')
        ->where('REF_UNIT_FAKULTAS.FAKULTAS', '=', 'FK')
       ->where('status_pembicara', '=', 'Perbaiki')
       ->where('tahun', '=', 2017)
       ->get()->count();
       $terverifikasi17 = DB::table('kinerja_pembicara')
       ->join('dosen', 'dosen.nidn', '=', 'kinerja_pembicara.nidn')
        ->join('remun_point_terindex', 'kinerja_pembicara.id_terindek', '=', 'remun_point_terindex.id_terindek' ) 
       ->join('REF_UNIT', 'dosen.id_sub_unit', '=', 'REF_UNIT.ID' ) 
       ->join('REF_UNIT_FAKULTAS', 'dosen.id_unit', '=', 'REF_UNIT_FAKULTAS.ID_FAKULTAS')
        ->where('REF_UNIT_FAKULTAS.FAKULTAS', '=', 'FK')
       ->where('status_pembicara', '=', 'Terverifikasi')
       ->where('tahun', '=', 2017)
       ->get()->count();

       //2018
       $ditolak18 = DB::table('kinerja_pembicara')
       ->join('dosen', 'dosen.nidn', '=', 'kinerja_pembicara.nidn')
        ->join('remun_point_terindex', 'kinerja_pembicara.id_terindek', '=', 'remun_point_terindex.id_terindek' ) 
       ->join('REF_UNIT', 'dosen.id_sub_unit', '=', 'REF_UNIT.ID' ) 
       ->join('REF_UNIT_FAKULTAS', 'dosen.id_unit', '=', 'REF_UNIT_FAKULTAS.ID_FAKULTAS')
        ->where('REF_UNIT_FAKULTAS.FAKULTAS', '=', 'FK')
       ->where('status_pembicara', '=', 'Ditolak')
       ->where('tahun', '=', 2018)
       ->get()->count();
       $menunggu18 = DB::table('kinerja_pembicara')
       ->join('dosen', 'dosen.nidn', '=', 'kinerja_pembicara.nidn')
        ->join('remun_point_terindex', 'kinerja_pembicara.id_terindek', '=', 'remun_point_terindex.id_terindek' ) 
       ->join('REF_UNIT', 'dosen.id_sub_unit', '=', 'REF_UNIT.ID' ) 
       ->join('REF_UNIT_FAKULTAS', 'dosen.id_unit', '=', 'REF_UNIT_FAKULTAS.ID_FAKULTAS')
        ->where('REF_UNIT_FAKULTAS.FAKULTAS', '=', 'FK')
       ->where('status_pembicara', '=', 'Menunggu')
       ->where('tahun', '=', 2018)
       ->get()->count();
       $tervalidasi18 = DB::table('kinerja_pembicara')
       ->join('dosen', 'dosen.nidn', '=', 'kinerja_pembicara.nidn')
        ->join('remun_point_terindex', 'kinerja_pembicara.id_terindek', '=', 'remun_point_terindex.id_terindek' ) 
       ->join('REF_UNIT', 'dosen.id_sub_unit', '=', 'REF_UNIT.ID' ) 
       ->join('REF_UNIT_FAKULTAS', 'dosen.id_unit', '=', 'REF_UNIT_FAKULTAS.ID_FAKULTAS')
        ->where('REF_UNIT_FAKULTAS.FAKULTAS', '=', 'FK')
       ->where('status_pembicara', '=', 'Tervalidasi')
       ->where('tahun', '=', 2018)
       ->get()->count();
       $perbaiki18 = DB::table('kinerja_pembicara')
       ->join('dosen', 'dosen.nidn', '=', 'kinerja_pembicara.nidn')
        ->join('remun_point_terindex', 'kinerja_pembicara.id_terindek', '=', 'remun_point_terindex.id_terindek' ) 
       ->join('REF_UNIT', 'dosen.id_sub_unit', '=', 'REF_UNIT.ID' ) 
       ->join('REF_UNIT_FAKULTAS', 'dosen.id_unit', '=', 'REF_UNIT_FAKULTAS.ID_FAKULTAS')
        ->where('REF_UNIT_FAKULTAS.FAKULTAS', '=', 'FK')
       ->where('status_pembicara', '=', 'Perbaiki')
       ->where('tahun', '=', 2018)
       ->get()->count();
       $terverifikasi18 = DB::table('kinerja_pembicara')
       ->join('dosen', 'dosen.nidn', '=', 'kinerja_pembicara.nidn')
        ->join('remun_point_terindex', 'kinerja_pembicara.id_terindek', '=', 'remun_point_terindex.id_terindek' ) 
       ->join('REF_UNIT', 'dosen.id_sub_unit', '=', 'REF_UNIT.ID' ) 
       ->join('REF_UNIT_FAKULTAS', 'dosen.id_unit', '=', 'REF_UNIT_FAKULTAS.ID_FAKULTAS')
        ->where('REF_UNIT_FAKULTAS.FAKULTAS', '=', 'FK')
       ->where('status_pembicara', '=', 'Terverifikasi')
       ->where('tahun', '=', 2018)
       ->get()->count();

       //2019
       $ditolak19 = DB::table('kinerja_pembicara')
       ->join('dosen', 'dosen.nidn', '=', 'kinerja_pembicara.nidn')
        ->join('remun_point_terindex', 'kinerja_pembicara.id_terindek', '=', 'remun_point_terindex.id_terindek' ) 
       ->join('REF_UNIT', 'dosen.id_sub_unit', '=', 'REF_UNIT.ID' ) 
       ->join('REF_UNIT_FAKULTAS', 'dosen.id_unit', '=', 'REF_UNIT_FAKULTAS.ID_FAKULTAS')
        ->where('REF_UNIT_FAKULTAS.FAKULTAS', '=', 'FK')
       ->where('status_pembicara', '=', 'Ditolak')
       ->where('tahun', '=', 2019)
       ->get()->count();
       $menunggu19 = DB::table('kinerja_pembicara')
       ->join('dosen', 'dosen.nidn', '=', 'kinerja_pembicara.nidn')
        ->join('remun_point_terindex', 'kinerja_pembicara.id_terindek', '=', 'remun_point_terindex.id_terindek' ) 
       ->join('REF_UNIT', 'dosen.id_sub_unit', '=', 'REF_UNIT.ID' ) 
       ->join('REF_UNIT_FAKULTAS', 'dosen.id_unit', '=', 'REF_UNIT_FAKULTAS.ID_FAKULTAS')
        ->where('REF_UNIT_FAKULTAS.FAKULTAS', '=', 'FK')
       ->where('status_pembicara', '=', 'Menunggu')
       ->where('tahun', '=', 2019)
       ->get()->count();
       $tervalidasi19 = DB::table('kinerja_pembicara')
       ->join('dosen', 'dosen.nidn', '=', 'kinerja_pembicara.nidn')
        ->join('remun_point_terindex', 'kinerja_pembicara.id_terindek', '=', 'remun_point_terindex.id_terindek' ) 
       ->join('REF_UNIT', 'dosen.id_sub_unit', '=', 'REF_UNIT.ID' ) 
       ->join('REF_UNIT_FAKULTAS', 'dosen.id_unit', '=', 'REF_UNIT_FAKULTAS.ID_FAKULTAS')
        ->where('REF_UNIT_FAKULTAS.FAKULTAS', '=', 'FK')
       ->where('status_pembicara', '=', 'Tervalidasi')
       ->where('tahun', '=', 2019)
       ->get()->count();
       $perbaiki19 = DB::table('kinerja_pembicara')
       ->join('dosen', 'dosen.nidn', '=', 'kinerja_pembicara.nidn')
        ->join('remun_point_terindex', 'kinerja_pembicara.id_terindek', '=', 'remun_point_terindex.id_terindek' ) 
       ->join('REF_UNIT', 'dosen.id_sub_unit', '=', 'REF_UNIT.ID' ) 
       ->join('REF_UNIT_FAKULTAS', 'dosen.id_unit', '=', 'REF_UNIT_FAKULTAS.ID_FAKULTAS')
        ->where('REF_UNIT_FAKULTAS.FAKULTAS', '=', 'FK')
       ->where('status_pembicara', '=', 'Perbaiki')
       ->where('tahun', '=', 2019)
       ->get()->count();
       $terverifikasi19 = DB::table('kinerja_pembicara')
       ->join('dosen', 'dosen.nidn', '=', 'kinerja_pembicara.nidn')
        ->join('remun_point_terindex', 'kinerja_pembicara.id_terindek', '=', 'remun_point_terindex.id_terindek' ) 
       ->join('REF_UNIT', 'dosen.id_sub_unit', '=', 'REF_UNIT.ID' ) 
       ->join('REF_UNIT_FAKULTAS', 'dosen.id_unit', '=', 'REF_UNIT_FAKULTAS.ID_FAKULTAS')
        ->where('REF_UNIT_FAKULTAS.FAKULTAS', '=', 'FK')
       ->where('status_pembicara', '=', 'Terverifikasi')
       ->where('tahun', '=', 2019)
       ->get()->count();

       //2020
       $ditolak20 = DB::table('kinerja_pembicara')
       ->join('dosen', 'dosen.nidn', '=', 'kinerja_pembicara.nidn')
        ->join('remun_point_terindex', 'kinerja_pembicara.id_terindek', '=', 'remun_point_terindex.id_terindek' ) 
       ->join('REF_UNIT', 'dosen.id_sub_unit', '=', 'REF_UNIT.ID' ) 
       ->join('REF_UNIT_FAKULTAS', 'dosen.id_unit', '=', 'REF_UNIT_FAKULTAS.ID_FAKULTAS')
        ->where('REF_UNIT_FAKULTAS.FAKULTAS', '=', 'FK')
       ->where('status_pembicara', '=', 'Ditolak')
       ->where('tahun', '=', 2020)
       ->get()->count();
       $menunggu20 = DB::table('kinerja_pembicara')
       ->join('dosen', 'dosen.nidn', '=', 'kinerja_pembicara.nidn')
        ->join('remun_point_terindex', 'kinerja_pembicara.id_terindek', '=', 'remun_point_terindex.id_terindek' ) 
       ->join('REF_UNIT', 'dosen.id_sub_unit', '=', 'REF_UNIT.ID' ) 
       ->join('REF_UNIT_FAKULTAS', 'dosen.id_unit', '=', 'REF_UNIT_FAKULTAS.ID_FAKULTAS')
        ->where('REF_UNIT_FAKULTAS.FAKULTAS', '=', 'FK')
       ->where('status_pembicara', '=', 'Menunggu')
       ->where('tahun', '=', 2020)
       ->get()->count();
       $tervalidasi20 = DB::table('kinerja_pembicara')
       ->join('dosen', 'dosen.nidn', '=', 'kinerja_pembicara.nidn')
        ->join('remun_point_terindex', 'kinerja_pembicara.id_terindek', '=', 'remun_point_terindex.id_terindek' ) 
       ->join('REF_UNIT', 'dosen.id_sub_unit', '=', 'REF_UNIT.ID' ) 
       ->join('REF_UNIT_FAKULTAS', 'dosen.id_unit', '=', 'REF_UNIT_FAKULTAS.ID_FAKULTAS')
        ->where('REF_UNIT_FAKULTAS.FAKULTAS', '=', 'FK')
       ->where('status_pembicara', '=', 'Tervalidasi')
       ->where('tahun', '=', 2020)
       ->get()->count();
       $perbaiki20 = DB::table('kinerja_pembicara')
       ->join('dosen', 'dosen.nidn', '=', 'kinerja_pembicara.nidn')
        ->join('remun_point_terindex', 'kinerja_pembicara.id_terindek', '=', 'remun_point_terindex.id_terindek' ) 
       ->join('REF_UNIT', 'dosen.id_sub_unit', '=', 'REF_UNIT.ID' ) 
       ->join('REF_UNIT_FAKULTAS', 'dosen.id_unit', '=', 'REF_UNIT_FAKULTAS.ID_FAKULTAS')
        ->where('REF_UNIT_FAKULTAS.FAKULTAS', '=', 'FK')
       ->where('status_pembicara', '=', 'Perbaiki')
       ->where('tahun', '=', 2020)
       ->get()->count();
       $terverifikasi20 = DB::table('kinerja_pembicara')
       ->join('dosen', 'dosen.nidn', '=', 'kinerja_pembicara.nidn')
        ->join('remun_point_terindex', 'kinerja_pembicara.id_terindek', '=', 'remun_point_terindex.id_terindek' ) 
       ->join('REF_UNIT', 'dosen.id_sub_unit', '=', 'REF_UNIT.ID' ) 
       ->join('REF_UNIT_FAKULTAS', 'dosen.id_unit', '=', 'REF_UNIT_FAKULTAS.ID_FAKULTAS')
        ->where('REF_UNIT_FAKULTAS.FAKULTAS', '=', 'FK')
       ->where('status_pembicara', '=', 'Terverifikasi')
       ->where('tahun', '=', 2020)
       ->get()->count();

       //2021
       $ditolak21 = DB::table('kinerja_pembicara')
       ->join('dosen', 'dosen.nidn', '=', 'kinerja_pembicara.nidn')
        ->join('remun_point_terindex', 'kinerja_pembicara.id_terindek', '=', 'remun_point_terindex.id_terindek' ) 
       ->join('REF_UNIT', 'dosen.id_sub_unit', '=', 'REF_UNIT.ID' ) 
       ->join('REF_UNIT_FAKULTAS', 'dosen.id_unit', '=', 'REF_UNIT_FAKULTAS.ID_FAKULTAS')
        ->where('REF_UNIT_FAKULTAS.FAKULTAS', '=', 'FK')
       ->where('status_pembicara', '=', 'Ditolak')
       ->where('tahun', '=', 2021)
       ->get()->count();
       $menunggu21 = DB::table('kinerja_pembicara')
       ->join('dosen', 'dosen.nidn', '=', 'kinerja_pembicara.nidn')
        ->join('remun_point_terindex', 'kinerja_pembicara.id_terindek', '=', 'remun_point_terindex.id_terindek' ) 
       ->join('REF_UNIT', 'dosen.id_sub_unit', '=', 'REF_UNIT.ID' ) 
       ->join('REF_UNIT_FAKULTAS', 'dosen.id_unit', '=', 'REF_UNIT_FAKULTAS.ID_FAKULTAS')
        ->where('REF_UNIT_FAKULTAS.FAKULTAS', '=', 'FK')
       ->where('status_pembicara', '=', 'Menunggu')
       ->where('tahun', '=', 2021)
       ->get()->count();
       $tervalidasi21 = DB::table('kinerja_pembicara')
       ->join('dosen', 'dosen.nidn', '=', 'kinerja_pembicara.nidn')
        ->join('remun_point_terindex', 'kinerja_pembicara.id_terindek', '=', 'remun_point_terindex.id_terindek' ) 
       ->join('REF_UNIT', 'dosen.id_sub_unit', '=', 'REF_UNIT.ID' ) 
       ->join('REF_UNIT_FAKULTAS', 'dosen.id_unit', '=', 'REF_UNIT_FAKULTAS.ID_FAKULTAS')
        ->where('REF_UNIT_FAKULTAS.FAKULTAS', '=', 'FK')
       ->where('status_pembicara', '=', 'Tervalidasi')
       ->where('tahun', '=', 2021)
       ->get()->count();
       $perbaiki21 = DB::table('kinerja_pembicara')
       ->join('dosen', 'dosen.nidn', '=', 'kinerja_pembicara.nidn')
        ->join('remun_point_terindex', 'kinerja_pembicara.id_terindek', '=', 'remun_point_terindex.id_terindek' ) 
       ->join('REF_UNIT', 'dosen.id_sub_unit', '=', 'REF_UNIT.ID' ) 
       ->join('REF_UNIT_FAKULTAS', 'dosen.id_unit', '=', 'REF_UNIT_FAKULTAS.ID_FAKULTAS')
        ->where('REF_UNIT_FAKULTAS.FAKULTAS', '=', 'FK')
       ->where('status_pembicara', '=', 'Perbaiki')
       ->where('tahun', '=', 2021)
       ->get()->count();
       $terverifikasi21 = DB::table('kinerja_pembicara')
       ->join('dosen', 'dosen.nidn', '=', 'kinerja_pembicara.nidn')
        ->join('remun_point_terindex', 'kinerja_pembicara.id_terindek', '=', 'remun_point_terindex.id_terindek' ) 
       ->join('REF_UNIT', 'dosen.id_sub_unit', '=', 'REF_UNIT.ID' ) 
       ->join('REF_UNIT_FAKULTAS', 'dosen.id_unit', '=', 'REF_UNIT_FAKULTAS.ID_FAKULTAS')
        ->where('REF_UNIT_FAKULTAS.FAKULTAS', '=', 'FK')
       ->where('status_pembicara', '=', 'Terverifikasi')
       ->where('tahun', '=', 2021)
       ->get()->count();

        return view('fakultas_pembicara_FK.index'  ,compact( ['data'], 'keyword','categoriesval', 'dataval', 'categoriescat', 'datacat', 'tahunpen',
        'ditolak17', 'menunggu17', 'tervalidasi17', 'perbaiki17', 'terverifikasi17',
        'ditolak18', 'menunggu18', 'tervalidasi18', 'perbaiki18', 'terverifikasi18',
        'ditolak19', 'menunggu19', 'tervalidasi19', 'perbaiki19', 'terverifikasi19',
        'ditolak20', 'menunggu20', 'tervalidasi20', 'perbaiki20', 'terverifikasi20',
        'ditolak21', 'menunggu21', 'tervalidasi21', 'perbaiki21', 'terverifikasi21',
        'categoriesslide1', 'dataslide1','categoriesslide2', 'dataslide2','categoriesslide3', 'dataslide3','categoriesslide4', 'dataslide4',
        'categoriesslide5', 'dataslide5','categoriesslide6', 'dataslide6','categoriesslide7', 'dataslide7', 'categoriesslide8', 'dataslide8',
       ))->with('i', ($request->input('page', 1) - 1) * $pagination);
       
    }
    
    /* public function pembicara_ex()
	{
		return Excel::download(new pembicaraExport, 'Kinerja_pembicara.xlsx');
	} */

}
/* $query = DB::select('SELECT `dosen`.`id_dosen` AS `ID_DOSEN`, 
                            `dosen`.`nidn_simpeg` AS `NIDN`, 
                            `dosen`.`nip_dosen` AS `NIK`, 
                            `dosen`.`gelar_depan` AS `GELAR_DEPAN`, 
                            `dosen`.`nama` AS `NAMA`, 
                            `dosen`.`gelar_belakang` AS `GELAR_BELAKANG`,
                            `kinerja_pembicara`.`judul_pembicara` AS `JUDUL`, 
                            `kinerja_pembicara`.`penerbit` AS `PUBLISER`, 
                            `kinerja_pembicara`.`tahun` AS `TAHUN`, 
                            `kinerja_pembicara`.`isbn` AS `ISBN_ISSN`, 
                            `bidang_kajian`.`nama_kajian` AS `BIDANG_KAJIAN`, 
                            `bidang_ilmu`.`nama_bidangilmu` AS `BIDANG_ILMU`,  
                            `kinerja_pembicara`.`status_pembicara` AS `STATUS`, 
                            `REF_UNIT`.`ID` AS `ID_UNIT`, 
                            `REF_UNIT`.`NAMA` AS `JURUSAN`,
                            `REF_UNIT_FAKULTAS`.`FAKULTAS` AS `FAKULTAS` 
                            FROM
                            (((((((( `kinerja_pembicara` JOIN `kinerja_pembicara` ON (( `kinerja_pembicara`.`id_pembicara` = `kinerja_pembicara`.`id`))) 
                            JOIN `dosen` `dosen` ON ( ( `kinerja_pembicara`.`nidn` = `dosen`.`nidn` )))
                            LEFT JOIN `REF_GOLONGAN_RUANG` `g` 
                            ON ( ( `dosen`.`id_gol_ruang` = `g`.`ID_GOL_RUANG` ))) 
                            JOIN `REF_STATUS_HENTI` `s` ON ( ( `dosen`.`id_status_henti` = `s`.`ID_STATUS_HENTI` ))) 
                            JOIN `REF_UNIT` ON ( ( `dosen`.`id_sub_unit` = `REF_UNIT`.`ID` ))) 
                            JOIN `REF_UNIT_FAKULTAS` ON ( ( `dosen`.`id_unit` = `REF_UNIT_FAKULTAS`.`ID_FAKULTAS` ))) 
                            LEFT JOIN `bidang_kajian` ON ( ( `kinerja_pembicara`.`id_kajian` = `bidang_kajian`.`id_kajian` ))) 
                            LEFT JOIN `bidang_ilmu` ON ( ( `kinerja_pembicara`.`id_bidangilmu` = `bidang_ilmu`.`id_bidangilmu` ))) ');
    
        $query2 = json_decode(json_encode($query), true); */