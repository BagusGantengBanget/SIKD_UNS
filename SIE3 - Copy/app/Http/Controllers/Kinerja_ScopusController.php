<?php

namespace App\Http\Controllers;
use Illuminate\Database\Query\Builder;

use Illuminate\Http\Request;
use App\kinerja_scopus;
use DB;
use App\Exports\ScopusExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class Kinerja_ScopusController extends Controller
{
    public function index(Request $request)
    {

        $keyword = $request->keyword;
        $pagination = 20;
        $data = DB::table('kinerja_scopus_author')
        ->join('kinerja_scopus', 'kinerja_scopus.id_pub_scopus', '=', 'kinerja_scopus_author.id_pub_scopus')
        ->join('dosen', 'dosen.nidn', '=', 'kinerja_scopus_author.nidn')
        ->join('REF_UNIT_FAKULTAS', 'dosen.id_unit', '=', 'REF_UNIT_FAKULTAS.ID_FAKULTAS')
        ->join('remun_point_terindex', 'kinerja_scopus.id_terindex', '=', 'remun_point_terindex.id_terindek' ) 
        ->join('REF_UNIT', 'dosen.id_sub_unit', '=', 'REF_UNIT.ID' ) 
        ->where('kinerja_scopus.tahun','like','%'.$keyword.'%')
        ->orWhere('remun_point_terindex.nama_tmp','like','%'.$keyword.'%')
        ->get();
        $tahun = DB::table('trx_penelitian')
        ->join('penelitian', 'trx_penelitian.id_penelitian', '=', 'penelitian.id_penelitian')
        ->where('penelitian.tahun','like','%'.$keyword.'%')
        ->groupBy('penelitian.tahun',)
        ->select('penelitian.tahun')
        ->get();
        foreach($tahun as $dt){
            $tahunpen = $dt->tahun;
        }
       //Grafik Tervalidasi Fakultas
       $validasifak = DB::table('kinerja_scopus_author')
       ->join('kinerja_scopus', 'kinerja_scopus.id_pub_scopus', '=', 'kinerja_scopus_author.id_pub_scopus')
       ->join('dosen', 'dosen.nidn', '=', 'kinerja_scopus_author.nidn')
       ->join('REF_UNIT_FAKULTAS', 'dosen.id_unit', '=', 'REF_UNIT_FAKULTAS.ID_FAKULTAS')
       ->join('REF_UNIT', 'dosen.id_sub_unit', '=', 'REF_UNIT.ID' ) 
       ->join('remun_point_terindex', 'kinerja_scopus.id_terindex', '=', 'remun_point_terindex.id_terindek' ) 
       ->where('kinerja_scopus.status_scopus', '=', 'Tervalidasi')
       ->Where('kinerja_scopus.tahun','like','%'.$keyword.'%')
       ->groupBy('REF_UNIT_FAKULTAS.FAKULTAS',)
       ->select('REF_UNIT_FAKULTAS.FAKULTAS',  \DB::raw('count(*) as totalval'))
       ->get();
       
       $categoriesval = [];
       $dataval=[];
       foreach($validasifak as $dt){
           $categoriesval[] = $dt->FAKULTAS;
           $dataval[] = $dt->totalval;
           /* $data2[] = strval($dt->total)->wherePivot('ID_FAKULTAS', strval($dt->ID_FAKULTAS))->first()->pivot->total; */
       }
       
       //Grafik Kategori
       $catscopus = DB::table('kinerja_scopus_author')
       ->join('kinerja_scopus', 'kinerja_scopus.id_pub_scopus', '=', 'kinerja_scopus_author.id_pub_scopus')
       ->join('dosen', 'dosen.nidn', '=', 'kinerja_scopus_author.nidn')
       ->join('REF_UNIT_FAKULTAS', 'dosen.id_unit', '=', 'REF_UNIT_FAKULTAS.ID_FAKULTAS')
       ->join('REF_UNIT', 'dosen.id_sub_unit', '=', 'REF_UNIT.ID' ) 
       ->join('remun_point_terindex', 'kinerja_scopus.id_terindex', '=', 'remun_point_terindex.id_terindek' ) 
       ->Where('kinerja_scopus.tahun','like','%'.$keyword.'%')
       ->groupBy('remun_point_terindex.nama_tmp',)
       ->select('remun_point_terindex.nama_tmp',  \DB::raw('count(*) as totalcat'))
       ->get();

       $categoriescat = [];
       $datacat=[];
       foreach($catscopus as $dt){
           $categoriescat[] = $dt->nama_tmp;
           $datacat[] = $dt->totalcat;
       }

       $slide1 = DB::table('kinerja_scopus_author')
       ->join('kinerja_scopus', 'kinerja_scopus.id_pub_scopus', '=', 'kinerja_scopus_author.id_pub_scopus')
       ->join('dosen', 'dosen.nidn', '=', 'kinerja_scopus_author.nidn')
       ->join('REF_UNIT_FAKULTAS', 'dosen.id_unit', '=', 'REF_UNIT_FAKULTAS.ID_FAKULTAS')
       ->join('remun_point_terindex', 'kinerja_scopus.id_terindex', '=', 'remun_point_terindex.id_terindek' ) 
       ->where('kinerja_scopus.id_terindex', '=', 48)
       ->Where('kinerja_scopus.tahun','like','%'.$keyword.'%')
       ->groupBy('REF_UNIT_FAKULTAS.FAKULTAS')
       ->select('REF_UNIT_FAKULTAS.FAKULTAS',  \DB::raw('count(*) as totalslide1'))
       ->get();

       $categoriesslide1 = [];
       $dataslide1=[];
       foreach($slide1 as $dt){
           $categoriesslide1[] = $dt->FAKULTAS;
           $dataslide1[] = $dt->totalslide1;
       }

       $slide2 = DB::table('kinerja_scopus_author')
       ->join('kinerja_scopus', 'kinerja_scopus.id_pub_scopus', '=', 'kinerja_scopus_author.id_pub_scopus')
       ->join('dosen', 'dosen.nidn', '=', 'kinerja_scopus_author.nidn')
       ->join('REF_UNIT_FAKULTAS', 'dosen.id_unit', '=', 'REF_UNIT_FAKULTAS.ID_FAKULTAS')
       ->join('remun_point_terindex', 'kinerja_scopus.id_terindex', '=', 'remun_point_terindex.id_terindek' ) 
       ->where('kinerja_scopus.id_terindex', '=', 64)
       ->Where('kinerja_scopus.tahun','like','%'.$keyword.'%')
       ->groupBy('REF_UNIT_FAKULTAS.FAKULTAS')
       ->select('REF_UNIT_FAKULTAS.FAKULTAS',  \DB::raw('count(*) as totalslide2'))
       ->get();

       $categoriesslide2 = [];
       $dataslide2=[];
       foreach($slide2 as $dt){
           $categoriesslide2[] = $dt->FAKULTAS;
           $dataslide2[] = $dt->totalslide2;
       }

       $slide3 = DB::table('kinerja_scopus_author')
       ->join('kinerja_scopus', 'kinerja_scopus.id_pub_scopus', '=', 'kinerja_scopus_author.id_pub_scopus')
       ->join('dosen', 'dosen.nidn', '=', 'kinerja_scopus_author.nidn')
       ->join('REF_UNIT_FAKULTAS', 'dosen.id_unit', '=', 'REF_UNIT_FAKULTAS.ID_FAKULTAS')
       ->join('remun_point_terindex', 'kinerja_scopus.id_terindex', '=', 'remun_point_terindex.id_terindek' ) 
       ->where('kinerja_scopus.id_terindex', '=', 65)
       ->Where('kinerja_scopus.tahun','like','%'.$keyword.'%')
       ->groupBy('REF_UNIT_FAKULTAS.FAKULTAS')
       ->select('REF_UNIT_FAKULTAS.FAKULTAS',  \DB::raw('count(*) as totalslide3'))
       ->get();

       $categoriesslide3 = [];
       $dataslide3=[];
       foreach($slide3 as $dt){
           $categoriesslide3[] = $dt->FAKULTAS;
           $dataslide3[] = $dt->totalslide3;
       }
      
       $slide4 = DB::table('kinerja_scopus_author')
       ->join('kinerja_scopus', 'kinerja_scopus.id_pub_scopus', '=', 'kinerja_scopus_author.id_pub_scopus')
       ->join('dosen', 'dosen.nidn', '=', 'kinerja_scopus_author.nidn')
       ->join('REF_UNIT_FAKULTAS', 'dosen.id_unit', '=', 'REF_UNIT_FAKULTAS.ID_FAKULTAS')
       ->join('remun_point_terindex', 'kinerja_scopus.id_terindex', '=', 'remun_point_terindex.id_terindek' ) 
       ->where('kinerja_scopus.id_terindex', '=', 66)
       ->Where('kinerja_scopus.tahun','like','%'.$keyword.'%')
       ->groupBy('REF_UNIT_FAKULTAS.FAKULTAS')
       ->select('REF_UNIT_FAKULTAS.FAKULTAS',  \DB::raw('count(*) as totalslide4'))
       ->get();

       $categoriesslide4 = [];
       $dataslide4=[];
       foreach($slide4 as $dt){
           $categoriesslide4[] = $dt->FAKULTAS;
           $dataslide4[] = $dt->totalslide4;
       }
       
       $slide5 = DB::table('kinerja_scopus_author')
        ->join('kinerja_scopus', 'kinerja_scopus.id_pub_scopus', '=', 'kinerja_scopus_author.id_pub_scopus')
        ->join('dosen', 'dosen.nidn', '=', 'kinerja_scopus_author.nidn')
        ->join('REF_UNIT_FAKULTAS', 'dosen.id_unit', '=', 'REF_UNIT_FAKULTAS.ID_FAKULTAS')
        ->join('remun_point_terindex', 'kinerja_scopus.id_terindex', '=', 'remun_point_terindex.id_terindek' ) 
        ->where('kinerja_scopus.id_terindex', '=', 67)
        ->Where('kinerja_scopus.tahun','like','%'.$keyword.'%')
        ->groupBy('REF_UNIT_FAKULTAS.FAKULTAS')
        ->select('REF_UNIT_FAKULTAS.FAKULTAS',  \DB::raw('count(*) as totalslide5'))
        ->get();

        $categoriesslide5 = [];
        $dataslide5=[];
        foreach($slide5 as $dt){
            $categoriesslide5[] = $dt->FAKULTAS;
            $dataslide5[] = $dt->totalslide5;
        }

        $slide6 = DB::table('kinerja_scopus_author')
        ->join('kinerja_scopus', 'kinerja_scopus.id_pub_scopus', '=', 'kinerja_scopus_author.id_pub_scopus')
        ->join('dosen', 'dosen.nidn', '=', 'kinerja_scopus_author.nidn')
        ->join('REF_UNIT_FAKULTAS', 'dosen.id_unit', '=', 'REF_UNIT_FAKULTAS.ID_FAKULTAS')
        ->join('remun_point_terindex', 'kinerja_scopus.id_terindex', '=', 'remun_point_terindex.id_terindek' ) 
        ->where('kinerja_scopus.id_terindex', '=', 68)
        ->Where('kinerja_scopus.tahun','like','%'.$keyword.'%')
        ->groupBy('REF_UNIT_FAKULTAS.FAKULTAS')
        ->select('REF_UNIT_FAKULTAS.FAKULTAS',  \DB::raw('count(*) as totalslide6'))
        ->get();

        $categoriesslide6 = [];
        $dataslide6=[];
        foreach($slide6 as $dt){
            $categoriesslide6[] = $dt->FAKULTAS;
            $dataslide6[] = $dt->totalslide6;
        }

        $slide7 = DB::table('kinerja_scopus_author')
        ->join('kinerja_scopus', 'kinerja_scopus.id_pub_scopus', '=', 'kinerja_scopus_author.id_pub_scopus')
        ->join('dosen', 'dosen.nidn', '=', 'kinerja_scopus_author.nidn')
        ->join('REF_UNIT_FAKULTAS', 'dosen.id_unit', '=', 'REF_UNIT_FAKULTAS.ID_FAKULTAS')
        ->join('remun_point_terindex', 'kinerja_scopus.id_terindex', '=', 'remun_point_terindex.id_terindek' ) 
        ->where('kinerja_scopus.id_terindex', '=', 69)
        ->Where('kinerja_scopus.tahun','like','%'.$keyword.'%')
        ->groupBy('REF_UNIT_FAKULTAS.FAKULTAS')
        ->select('REF_UNIT_FAKULTAS.FAKULTAS',  \DB::raw('count(*) as totalslide7'))
        ->get();

        $categoriesslide7 = [];
        $dataslide7=[];
        foreach($slide7 as $dt){
            $categoriesslide7[] = $dt->FAKULTAS;
            $dataslide7[] = $dt->totalslide7;
        }

        $slide8 = DB::table('kinerja_scopus_author')
        ->join('kinerja_scopus', 'kinerja_scopus.id_pub_scopus', '=', 'kinerja_scopus_author.id_pub_scopus')
        ->join('dosen', 'dosen.nidn', '=', 'kinerja_scopus_author.nidn')
        ->join('REF_UNIT_FAKULTAS', 'dosen.id_unit', '=', 'REF_UNIT_FAKULTAS.ID_FAKULTAS')
        ->join('remun_point_terindex', 'kinerja_scopus.id_terindex', '=', 'remun_point_terindex.id_terindek' ) 
        ->where('kinerja_scopus.id_terindex', '=', 82)
        ->Where('kinerja_scopus.tahun','like','%'.$keyword.'%')
        ->groupBy('REF_UNIT_FAKULTAS.FAKULTAS')
        ->select('REF_UNIT_FAKULTAS.FAKULTAS',  \DB::raw('count(*) as totalslide8'))
        ->get();

        $categoriesslide8 = [];
        $dataslide8=[];
        foreach($slide8 as $dt){
            $categoriesslide8[] = $dt->FAKULTAS;
            $dataslide8[] = $dt->totalslide8;
        }

        $slide9 = DB::table('kinerja_scopus_author')
        ->join('kinerja_scopus', 'kinerja_scopus.id_pub_scopus', '=', 'kinerja_scopus_author.id_pub_scopus')
        ->join('dosen', 'dosen.nidn', '=', 'kinerja_scopus_author.nidn')
        ->join('REF_UNIT_FAKULTAS', 'dosen.id_unit', '=', 'REF_UNIT_FAKULTAS.ID_FAKULTAS')
        ->join('remun_point_terindex', 'kinerja_scopus.id_terindex', '=', 'remun_point_terindex.id_terindek' ) 
        ->where('kinerja_scopus.id_terindex', '=', 83)
        ->Where('kinerja_scopus.tahun','like','%'.$keyword.'%')
        ->groupBy('REF_UNIT_FAKULTAS.FAKULTAS')
        ->select('REF_UNIT_FAKULTAS.FAKULTAS',  \DB::raw('count(*) as totalslide9'))
        ->get();

        $categoriesslide9 = [];
        $dataslide9=[];
        foreach($slide9 as $dt){
            $categoriesslide9[] = $dt->FAKULTAS;
            $dataslide9[] = $dt->totalslide9;
        }

        
        //=======================================================grafik 9==================================================//
        
        //2017
        $ditolak17 = DB::table('kinerja_scopus_author')
        ->join('kinerja_scopus', 'kinerja_scopus.id_pub_scopus', '=', 'kinerja_scopus_author.id_pub_scopus')
        ->join('dosen', 'dosen.nidn', '=', 'kinerja_scopus_author.nidn')
        ->join('REF_UNIT', 'dosen.id_sub_unit', '=', 'REF_UNIT.ID' ) 
        ->join('remun_point_terindex', 'kinerja_scopus.id_terindex', '=', 'remun_point_terindex.id_terindek' ) 
        ->join('REF_UNIT_FAKULTAS', 'dosen.id_unit', '=', 'REF_UNIT_FAKULTAS.ID_FAKULTAS')
        ->where('status_scopus', '=', 'Ditolak')
        ->where('tahun', '=', 2017)
        ->count();
        $menunggu17 = DB::table('kinerja_scopus_author')
        ->join('kinerja_scopus', 'kinerja_scopus.id_pub_scopus', '=', 'kinerja_scopus_author.id_pub_scopus')
        ->join('dosen', 'dosen.nidn', '=', 'kinerja_scopus_author.nidn')
        ->join('REF_UNIT', 'dosen.id_sub_unit', '=', 'REF_UNIT.ID' ) 
        ->join('remun_point_terindex', 'kinerja_scopus.id_terindex', '=', 'remun_point_terindex.id_terindek' ) 
        ->join('REF_UNIT_FAKULTAS', 'dosen.id_unit', '=', 'REF_UNIT_FAKULTAS.ID_FAKULTAS')
        ->where('status_scopus', '=', 'Menunggu')
        ->where('tahun', '=', 2017)
        ->count();
        $tervalidasi17 = DB::table('kinerja_scopus_author')
        ->join('kinerja_scopus', 'kinerja_scopus.id_pub_scopus', '=', 'kinerja_scopus_author.id_pub_scopus')
        ->join('dosen', 'dosen.nidn', '=', 'kinerja_scopus_author.nidn')
        ->join('REF_UNIT', 'dosen.id_sub_unit', '=', 'REF_UNIT.ID' ) 
        ->join('remun_point_terindex', 'kinerja_scopus.id_terindex', '=', 'remun_point_terindex.id_terindek' ) 
        ->join('REF_UNIT_FAKULTAS', 'dosen.id_unit', '=', 'REF_UNIT_FAKULTAS.ID_FAKULTAS')
        ->where('status_scopus', '=', 'Tervalidasi')
        ->where('tahun', '=', 2017)
        ->count();
        $perbaiki17 = DB::table('kinerja_scopus_author')
        ->join('kinerja_scopus', 'kinerja_scopus.id_pub_scopus', '=', 'kinerja_scopus_author.id_pub_scopus')
        ->join('dosen', 'dosen.nidn', '=', 'kinerja_scopus_author.nidn')
        ->join('REF_UNIT', 'dosen.id_sub_unit', '=', 'REF_UNIT.ID' ) 
        ->join('remun_point_terindex', 'kinerja_scopus.id_terindex', '=', 'remun_point_terindex.id_terindek' ) 
        ->join('REF_UNIT_FAKULTAS', 'dosen.id_unit', '=', 'REF_UNIT_FAKULTAS.ID_FAKULTAS')
        ->where('status_scopus', '=', 'Perbaiki')
        ->where('tahun', '=', 2017)
        ->count();
        $terverifikasi17 = DB::table('kinerja_scopus_author')
        ->join('kinerja_scopus', 'kinerja_scopus.id_pub_scopus', '=', 'kinerja_scopus_author.id_pub_scopus')
        ->join('dosen', 'dosen.nidn', '=', 'kinerja_scopus_author.nidn')
        ->join('REF_UNIT', 'dosen.id_sub_unit', '=', 'REF_UNIT.ID' ) 
        ->join('remun_point_terindex', 'kinerja_scopus.id_terindex', '=', 'remun_point_terindex.id_terindek' ) 
        ->join('REF_UNIT_FAKULTAS', 'dosen.id_unit', '=', 'REF_UNIT_FAKULTAS.ID_FAKULTAS')
        ->where('status_scopus', '=', 'Terverifikasi')
        ->where('tahun', '=', 2017)
        ->count();

        //2018
        $ditolak18 = DB::table('kinerja_scopus_author')
        ->join('kinerja_scopus', 'kinerja_scopus.id_pub_scopus', '=', 'kinerja_scopus_author.id_pub_scopus')
        ->join('dosen', 'dosen.nidn', '=', 'kinerja_scopus_author.nidn')
        ->join('remun_point_terindex', 'kinerja_scopus.id_terindex', '=', 'remun_point_terindex.id_terindek' ) 
        ->join('REF_UNIT', 'dosen.id_sub_unit', '=', 'REF_UNIT.ID' ) 
        ->join('REF_UNIT_FAKULTAS', 'dosen.id_unit', '=', 'REF_UNIT_FAKULTAS.ID_FAKULTAS')
        ->where('status_scopus', '=', 'Ditolak')
        ->where('tahun', '=', 2018)
        ->count();
        $menunggu18 = DB::table('kinerja_scopus_author')
        ->join('kinerja_scopus', 'kinerja_scopus.id_pub_scopus', '=', 'kinerja_scopus_author.id_pub_scopus')
        ->join('dosen', 'dosen.nidn', '=', 'kinerja_scopus_author.nidn')
        ->join('remun_point_terindex', 'kinerja_scopus.id_terindex', '=', 'remun_point_terindex.id_terindek' ) 
        ->join('REF_UNIT', 'dosen.id_sub_unit', '=', 'REF_UNIT.ID' ) 
        ->join('REF_UNIT_FAKULTAS', 'dosen.id_unit', '=', 'REF_UNIT_FAKULTAS.ID_FAKULTAS')
        ->where('status_scopus', '=', 'Menunggu')
        ->where('tahun', '=', 2018)
        ->count();
        $tervalidasi18 = DB::table('kinerja_scopus_author')
        ->join('kinerja_scopus', 'kinerja_scopus.id_pub_scopus', '=', 'kinerja_scopus_author.id_pub_scopus')
        ->join('dosen', 'dosen.nidn', '=', 'kinerja_scopus_author.nidn')
        ->join('remun_point_terindex', 'kinerja_scopus.id_terindex', '=', 'remun_point_terindex.id_terindek' ) 
        ->join('REF_UNIT', 'dosen.id_sub_unit', '=', 'REF_UNIT.ID' ) 
        ->join('REF_UNIT_FAKULTAS', 'dosen.id_unit', '=', 'REF_UNIT_FAKULTAS.ID_FAKULTAS')
        ->where('status_scopus', '=', 'Tervalidasi')
        ->where('tahun', '=', 2018)
        ->count();
        $perbaiki18 = DB::table('kinerja_scopus_author')
        ->join('kinerja_scopus', 'kinerja_scopus.id_pub_scopus', '=', 'kinerja_scopus_author.id_pub_scopus')
        ->join('dosen', 'dosen.nidn', '=', 'kinerja_scopus_author.nidn')
        ->join('remun_point_terindex', 'kinerja_scopus.id_terindex', '=', 'remun_point_terindex.id_terindek' ) 
        ->join('REF_UNIT', 'dosen.id_sub_unit', '=', 'REF_UNIT.ID' ) 
        ->join('REF_UNIT_FAKULTAS', 'dosen.id_unit', '=', 'REF_UNIT_FAKULTAS.ID_FAKULTAS')
        ->where('status_scopus', '=', 'Perbaiki')
        ->where('tahun', '=', 2018)
        ->count();
        $terverifikasi18 = DB::table('kinerja_scopus_author')
        ->join('kinerja_scopus', 'kinerja_scopus.id_pub_scopus', '=', 'kinerja_scopus_author.id_pub_scopus')
        ->join('dosen', 'dosen.nidn', '=', 'kinerja_scopus_author.nidn')
        ->join('remun_point_terindex', 'kinerja_scopus.id_terindex', '=', 'remun_point_terindex.id_terindek' ) 
        ->join('REF_UNIT', 'dosen.id_sub_unit', '=', 'REF_UNIT.ID' ) 
        ->join('REF_UNIT_FAKULTAS', 'dosen.id_unit', '=', 'REF_UNIT_FAKULTAS.ID_FAKULTAS')
        ->where('status_scopus', '=', 'Terverifikasi')
        ->where('tahun', '=', 2018)
        ->count();

        //2019
        $ditolak19 = DB::table('kinerja_scopus_author')
        ->join('kinerja_scopus', 'kinerja_scopus.id_pub_scopus', '=', 'kinerja_scopus_author.id_pub_scopus')
        ->join('dosen', 'dosen.nidn', '=', 'kinerja_scopus_author.nidn')
        ->join('REF_UNIT', 'dosen.id_sub_unit', '=', 'REF_UNIT.ID' ) 
        ->join('remun_point_terindex', 'kinerja_scopus.id_terindex', '=', 'remun_point_terindex.id_terindek' ) 
        ->join('REF_UNIT_FAKULTAS', 'dosen.id_unit', '=', 'REF_UNIT_FAKULTAS.ID_FAKULTAS')
        ->where('status_scopus', '=', 'Ditolak')
        ->where('tahun', '=', 2019)
        ->count();
        $menunggu19 = DB::table('kinerja_scopus_author')
        ->join('kinerja_scopus', 'kinerja_scopus.id_pub_scopus', '=', 'kinerja_scopus_author.id_pub_scopus')
        ->join('dosen', 'dosen.nidn', '=', 'kinerja_scopus_author.nidn')
        ->join('REF_UNIT', 'dosen.id_sub_unit', '=', 'REF_UNIT.ID' ) 
        ->join('remun_point_terindex', 'kinerja_scopus.id_terindex', '=', 'remun_point_terindex.id_terindek' ) 
        ->join('REF_UNIT_FAKULTAS', 'dosen.id_unit', '=', 'REF_UNIT_FAKULTAS.ID_FAKULTAS')
        ->where('status_scopus', '=', 'Menunggu')
        ->where('tahun', '=', 2019)
        ->count();
        $tervalidasi19 = DB::table('kinerja_scopus_author')
        ->join('kinerja_scopus', 'kinerja_scopus.id_pub_scopus', '=', 'kinerja_scopus_author.id_pub_scopus')
        ->join('dosen', 'dosen.nidn', '=', 'kinerja_scopus_author.nidn')
        ->join('REF_UNIT', 'dosen.id_sub_unit', '=', 'REF_UNIT.ID' ) 
        ->join('remun_point_terindex', 'kinerja_scopus.id_terindex', '=', 'remun_point_terindex.id_terindek' ) 
        ->join('REF_UNIT_FAKULTAS', 'dosen.id_unit', '=', 'REF_UNIT_FAKULTAS.ID_FAKULTAS')
        ->where('status_scopus', '=', 'Tervalidasi')
        ->where('tahun', '=', 2019)
        ->count();
        $perbaiki19 = DB::table('kinerja_scopus_author')
        ->join('kinerja_scopus', 'kinerja_scopus.id_pub_scopus', '=', 'kinerja_scopus_author.id_pub_scopus')
        ->join('dosen', 'dosen.nidn', '=', 'kinerja_scopus_author.nidn')
        ->join('REF_UNIT', 'dosen.id_sub_unit', '=', 'REF_UNIT.ID' ) 
        ->join('remun_point_terindex', 'kinerja_scopus.id_terindex', '=', 'remun_point_terindex.id_terindek' ) 
        ->join('REF_UNIT_FAKULTAS', 'dosen.id_unit', '=', 'REF_UNIT_FAKULTAS.ID_FAKULTAS')
        ->where('status_scopus', '=', 'Perbaiki')
        ->where('tahun', '=', 2019)
        ->count();
        $terverifikasi19 = DB::table('kinerja_scopus_author')
        ->join('kinerja_scopus', 'kinerja_scopus.id_pub_scopus', '=', 'kinerja_scopus_author.id_pub_scopus')
        ->join('dosen', 'dosen.nidn', '=', 'kinerja_scopus_author.nidn')
        ->join('REF_UNIT', 'dosen.id_sub_unit', '=', 'REF_UNIT.ID' ) 
        ->join('remun_point_terindex', 'kinerja_scopus.id_terindex', '=', 'remun_point_terindex.id_terindek' ) 
        ->join('REF_UNIT_FAKULTAS', 'dosen.id_unit', '=', 'REF_UNIT_FAKULTAS.ID_FAKULTAS')
        ->where('status_scopus', '=', 'Terverifikasi')
        ->where('tahun', '=', 2019)
        ->count();

        //2020
        $ditolak20 = DB::table('kinerja_scopus_author')
        ->join('kinerja_scopus', 'kinerja_scopus.id_pub_scopus', '=', 'kinerja_scopus_author.id_pub_scopus')
        ->join('dosen', 'dosen.nidn', '=', 'kinerja_scopus_author.nidn')
        ->join('REF_UNIT', 'dosen.id_sub_unit', '=', 'REF_UNIT.ID' ) 
        ->join('remun_point_terindex', 'kinerja_scopus.id_terindex', '=', 'remun_point_terindex.id_terindek' ) 
        ->join('REF_UNIT_FAKULTAS', 'dosen.id_unit', '=', 'REF_UNIT_FAKULTAS.ID_FAKULTAS')
        ->where('status_scopus', '=', 'Ditolak')
        ->where('tahun', '=', 2020)
        ->count();
        $menunggu20 = DB::table('kinerja_scopus_author')
        ->join('kinerja_scopus', 'kinerja_scopus.id_pub_scopus', '=', 'kinerja_scopus_author.id_pub_scopus')
        ->join('dosen', 'dosen.nidn', '=', 'kinerja_scopus_author.nidn')
        ->join('REF_UNIT', 'dosen.id_sub_unit', '=', 'REF_UNIT.ID' ) 
        ->join('remun_point_terindex', 'kinerja_scopus.id_terindex', '=', 'remun_point_terindex.id_terindek' ) 
        ->join('REF_UNIT_FAKULTAS', 'dosen.id_unit', '=', 'REF_UNIT_FAKULTAS.ID_FAKULTAS')
        ->where('status_scopus', '=', 'Menunggu')
        ->where('tahun', '=', 2020)
        ->count();
        $tervalidasi20 = DB::table('kinerja_scopus_author')
        ->join('kinerja_scopus', 'kinerja_scopus.id_pub_scopus', '=', 'kinerja_scopus_author.id_pub_scopus')
        ->join('dosen', 'dosen.nidn', '=', 'kinerja_scopus_author.nidn')
        ->join('REF_UNIT', 'dosen.id_sub_unit', '=', 'REF_UNIT.ID' ) 
        ->join('remun_point_terindex', 'kinerja_scopus.id_terindex', '=', 'remun_point_terindex.id_terindek' ) 
        ->join('REF_UNIT_FAKULTAS', 'dosen.id_unit', '=', 'REF_UNIT_FAKULTAS.ID_FAKULTAS')
        ->where('status_scopus', '=', 'Tervalidasi')
        ->where('tahun', '=', 2020)
        ->count();
        $perbaiki20 = DB::table('kinerja_scopus_author')
        ->join('kinerja_scopus', 'kinerja_scopus.id_pub_scopus', '=', 'kinerja_scopus_author.id_pub_scopus')
        ->join('dosen', 'dosen.nidn', '=', 'kinerja_scopus_author.nidn')
        ->join('REF_UNIT', 'dosen.id_sub_unit', '=', 'REF_UNIT.ID' ) 
        ->join('remun_point_terindex', 'kinerja_scopus.id_terindex', '=', 'remun_point_terindex.id_terindek' ) 
        ->join('REF_UNIT_FAKULTAS', 'dosen.id_unit', '=', 'REF_UNIT_FAKULTAS.ID_FAKULTAS')
        ->where('status_scopus', '=', 'Perbaiki')
        ->where('tahun', '=', 2020)
        ->count();
        $terverifikasi20 = DB::table('kinerja_scopus_author')
        ->join('kinerja_scopus', 'kinerja_scopus.id_pub_scopus', '=', 'kinerja_scopus_author.id_pub_scopus')
        ->join('dosen', 'dosen.nidn', '=', 'kinerja_scopus_author.nidn')
        ->join('REF_UNIT', 'dosen.id_sub_unit', '=', 'REF_UNIT.ID' ) 
        ->join('remun_point_terindex', 'kinerja_scopus.id_terindex', '=', 'remun_point_terindex.id_terindek' ) 
        ->join('REF_UNIT_FAKULTAS', 'dosen.id_unit', '=', 'REF_UNIT_FAKULTAS.ID_FAKULTAS')
        ->where('status_scopus', '=', 'Terverifikasi')
        ->where('tahun', '=', 2020)
        ->count();

        //2021
        $ditolak21 = DB::table('kinerja_scopus_author')
        ->join('kinerja_scopus', 'kinerja_scopus.id_pub_scopus', '=', 'kinerja_scopus_author.id_pub_scopus')
        ->join('dosen', 'dosen.nidn', '=', 'kinerja_scopus_author.nidn')
        ->join('REF_UNIT', 'dosen.id_sub_unit', '=', 'REF_UNIT.ID' ) 
        ->join('remun_point_terindex', 'kinerja_scopus.id_terindex', '=', 'remun_point_terindex.id_terindek' ) 
        ->join('REF_UNIT_FAKULTAS', 'dosen.id_unit', '=', 'REF_UNIT_FAKULTAS.ID_FAKULTAS')
        ->where('status_scopus', '=', 'Ditolak')
        ->where('tahun', '=', 2021)
        ->count();
        $menunggu21 = DB::table('kinerja_scopus_author')
        ->join('kinerja_scopus', 'kinerja_scopus.id_pub_scopus', '=', 'kinerja_scopus_author.id_pub_scopus')
        ->join('dosen', 'dosen.nidn', '=', 'kinerja_scopus_author.nidn')
        ->join('REF_UNIT', 'dosen.id_sub_unit', '=', 'REF_UNIT.ID' ) 
        ->join('remun_point_terindex', 'kinerja_scopus.id_terindex', '=', 'remun_point_terindex.id_terindek' ) 
        ->join('REF_UNIT_FAKULTAS', 'dosen.id_unit', '=', 'REF_UNIT_FAKULTAS.ID_FAKULTAS')
        ->where('status_scopus', '=', 'Menunggu')
        ->where('tahun', '=', 2021)
        ->count();
        $tervalidasi21 = DB::table('kinerja_scopus_author')
        ->join('kinerja_scopus', 'kinerja_scopus.id_pub_scopus', '=', 'kinerja_scopus_author.id_pub_scopus')
        ->join('dosen', 'dosen.nidn', '=', 'kinerja_scopus_author.nidn')
        ->join('REF_UNIT', 'dosen.id_sub_unit', '=', 'REF_UNIT.ID' ) 
        ->join('remun_point_terindex', 'kinerja_scopus.id_terindex', '=', 'remun_point_terindex.id_terindek' ) 
        ->join('REF_UNIT_FAKULTAS', 'dosen.id_unit', '=', 'REF_UNIT_FAKULTAS.ID_FAKULTAS')
        ->where('status_scopus', '=', 'Tervalidasi')
        ->where('tahun', '=', 2021)
        ->count();
        $perbaiki21 = DB::table('kinerja_scopus_author')
        ->join('kinerja_scopus', 'kinerja_scopus.id_pub_scopus', '=', 'kinerja_scopus_author.id_pub_scopus')
        ->join('dosen', 'dosen.nidn', '=', 'kinerja_scopus_author.nidn')
        ->join('REF_UNIT', 'dosen.id_sub_unit', '=', 'REF_UNIT.ID' ) 
        ->join('remun_point_terindex', 'kinerja_scopus.id_terindex', '=', 'remun_point_terindex.id_terindek' ) 
        ->join('REF_UNIT_FAKULTAS', 'dosen.id_unit', '=', 'REF_UNIT_FAKULTAS.ID_FAKULTAS')
        ->where('status_scopus', '=', 'Perbaiki')
        ->where('tahun', '=', 2021)
        ->count();
        $terverifikasi21 = DB::table('kinerja_scopus_author')
        ->join('kinerja_scopus', 'kinerja_scopus.id_pub_scopus', '=', 'kinerja_scopus_author.id_pub_scopus')
        ->join('dosen', 'dosen.nidn', '=', 'kinerja_scopus_author.nidn')
        ->join('REF_UNIT', 'dosen.id_sub_unit', '=', 'REF_UNIT.ID' ) 
        ->join('remun_point_terindex', 'kinerja_scopus.id_terindex', '=', 'remun_point_terindex.id_terindek' ) 
        ->join('REF_UNIT_FAKULTAS', 'dosen.id_unit', '=', 'REF_UNIT_FAKULTAS.ID_FAKULTAS')
        ->where('status_scopus', '=', 'Terverifikasi')
        ->where('tahun', '=', 2021)
        ->count();

        
            
        return view('kinerja_scopus.index', compact( 'data', 'keyword', 'categoriesval', 'dataval', 'categoriescat', 'datacat', 'tahunpen',
        'ditolak17', 'menunggu17', 'tervalidasi17', 'perbaiki17', 'terverifikasi17',
        'ditolak18', 'menunggu18', 'tervalidasi18', 'perbaiki18', 'terverifikasi18',
        'ditolak19', 'menunggu19', 'tervalidasi19', 'perbaiki19', 'terverifikasi19',
        'ditolak20', 'menunggu20', 'tervalidasi20', 'perbaiki20', 'terverifikasi20',
        'ditolak21', 'menunggu21', 'tervalidasi21', 'perbaiki21', 'terverifikasi21',
        'categoriesslide1', 'dataslide1','categoriesslide2', 'dataslide2','categoriesslide3', 'dataslide3','categoriesslide4', 'dataslide4',
        'categoriesslide5', 'dataslide5','categoriesslide6', 'dataslide6','categoriesslide7', 'dataslide7', 'categoriesslide8', 'dataslide8',
        'categoriesslide9', 'dataslide9',
       ))->with('i', ($request->input('page', 1) - 1) * $pagination);
    }
    public function scopus_ex()
	{
		return Excel::download(new ScopusExport, 'Kinerja_Scopus.xlsx');
	}
}
