<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\kinerja_pengabdian;
use DB;
use App\Exports\PengabdianExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class Kinerja_PengabdianController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->keyword;
        $data = DB::table('kinerja_pengabdian_author')
        ->join('kinerja_pengabdian', 'kinerja_pengabdian.id_pengabdian', '=', 'kinerja_pengabdian_author.id')
        ->join('dosen', 'dosen.nidn', '=', 'kinerja_pengabdian_author.nidn')
        ->join('remun_point_terindex', 'kinerja_pengabdian.id_terindek', '=', 'remun_point_terindex.id_terindek' ) 
        ->join('REF_UNIT_FAKULTAS', 'dosen.id_unit', '=', 'REF_UNIT_FAKULTAS.ID_FAKULTAS')
        ->join('REF_UNIT', 'dosen.id_sub_unit', '=', 'REF_UNIT.ID' ) 
        ->where('kinerja_pengabdian.tahun','like','%'.$keyword.'%')
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
        $validasifak = DB::table('kinerja_pengabdian_author')
        ->join('kinerja_pengabdian', 'kinerja_pengabdian.id_pengabdian', '=', 'kinerja_pengabdian_author.id')
        ->join('dosen', 'dosen.nidn', '=', 'kinerja_pengabdian_author.nidn')
        ->join('REF_UNIT_FAKULTAS', 'dosen.id_unit', '=', 'REF_UNIT_FAKULTAS.ID_FAKULTAS')
        ->join('REF_UNIT', 'dosen.id_sub_unit', '=', 'REF_UNIT.ID' ) 
        ->join('remun_point_terindex', 'kinerja_pengabdian.id_terindek', '=', 'remun_point_terindex.id_terindek' ) 
        ->where('kinerja_pengabdian.status_pengabdian', '=', 'Tervalidasi')
        ->Where('kinerja_pengabdian.tahun','like','%'.$keyword.'%')
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
        $catpengabdian = DB::table('kinerja_pengabdian_author')
        ->join('kinerja_pengabdian', 'kinerja_pengabdian.id_pengabdian', '=', 'kinerja_pengabdian_author.id')
        ->join('dosen', 'dosen.nidn', '=', 'kinerja_pengabdian_author.nidn')
        ->join('REF_UNIT_FAKULTAS', 'dosen.id_unit', '=', 'REF_UNIT_FAKULTAS.ID_FAKULTAS')
        ->join('REF_UNIT', 'dosen.id_sub_unit', '=', 'REF_UNIT.ID' ) 
        ->join('remun_point_terindex', 'kinerja_pengabdian.id_terindek', '=', 'remun_point_terindex.id_terindek' ) 
        ->Where('kinerja_pengabdian.tahun','like','%'.$keyword.'%')
        ->groupBy('remun_point_terindex.nama_tmp',)
        ->select('remun_point_terindex.nama_tmp',  \DB::raw('count(*) as totalcat'))
        ->get();

        $categoriescat = [];
        $datacat=[];
        foreach($catpengabdian as $dt){
            $categoriescat[] = $dt->nama_tmp;
            $datacat[] = $dt->totalcat;
        }
        
        $slide1 = DB::table('kinerja_pengabdian_author')
        ->join('kinerja_pengabdian', 'kinerja_pengabdian.id_pengabdian', '=', 'kinerja_pengabdian_author.id')
        ->join('dosen', 'dosen.nidn', '=', 'kinerja_pengabdian_author.nidn')
        ->join('REF_UNIT_FAKULTAS', 'dosen.id_unit', '=', 'REF_UNIT_FAKULTAS.ID_FAKULTAS')
        ->join('remun_point_terindex', 'kinerja_pengabdian.id_terindek', '=', 'remun_point_terindex.id_terindek' ) 
        ->where('kinerja_pengabdian.id_terindek', '=', 27)
        ->Where('kinerja_pengabdian.tahun','like','%'.$keyword.'%')
        ->groupBy('REF_UNIT_FAKULTAS.FAKULTAS')
        ->select('REF_UNIT_FAKULTAS.FAKULTAS',  \DB::raw('count(*) as totalslide1'))
        ->get();

        $categoriesslide1 = [];
        $dataslide1=[];
        foreach($slide1 as $dt){
            $categoriesslide1[] = $dt->FAKULTAS;
            $dataslide1[] = $dt->totalslide1;
        }

        $slide2 = DB::table('kinerja_pengabdian_author')
        ->join('kinerja_pengabdian', 'kinerja_pengabdian.id_pengabdian', '=', 'kinerja_pengabdian_author.id')
        ->join('dosen', 'dosen.nidn', '=', 'kinerja_pengabdian_author.nidn')
        ->join('REF_UNIT_FAKULTAS', 'dosen.id_unit', '=', 'REF_UNIT_FAKULTAS.ID_FAKULTAS')
        ->join('remun_point_terindex', 'kinerja_pengabdian.id_terindek', '=', 'remun_point_terindex.id_terindek' ) 
        ->where('kinerja_pengabdian.id_terindek', '=', 28)
        ->Where('kinerja_pengabdian.tahun','like','%'.$keyword.'%')
        ->groupBy('REF_UNIT_FAKULTAS.FAKULTAS')
        ->select('REF_UNIT_FAKULTAS.FAKULTAS',  \DB::raw('count(*) as totalslide2'))
        ->get();

        $categoriesslide2 = [];
        $dataslide2=[];
        foreach($slide2 as $dt){
            $categoriesslide2[] = $dt->FAKULTAS;
            $dataslide2[] = $dt->totalslide2;
        }

        $slide3 = DB::table('kinerja_pengabdian_author')
        ->join('kinerja_pengabdian', 'kinerja_pengabdian.id_pengabdian', '=', 'kinerja_pengabdian_author.id')
        ->join('dosen', 'dosen.nidn', '=', 'kinerja_pengabdian_author.nidn')
        ->join('REF_UNIT_FAKULTAS', 'dosen.id_unit', '=', 'REF_UNIT_FAKULTAS.ID_FAKULTAS')
        ->join('remun_point_terindex', 'kinerja_pengabdian.id_terindek', '=', 'remun_point_terindex.id_terindek' ) 
        ->where('kinerja_pengabdian.id_terindek', '=', 29)
        ->Where('kinerja_pengabdian.tahun','like','%'.$keyword.'%')
        ->groupBy('REF_UNIT_FAKULTAS.FAKULTAS')
        ->select('REF_UNIT_FAKULTAS.FAKULTAS',  \DB::raw('count(*) as totalslide3'))
        ->get();

        $categoriesslide3 = [];
        $dataslide3=[];
        foreach($slide3 as $dt){
            $categoriesslide3[] = $dt->FAKULTAS;
            $dataslide3[] = $dt->totalslide3;
        }

        //===============================================================================================================================//

        //2017
        $ditolak17 = DB::table('kinerja_pengabdian_author')
        ->join('kinerja_pengabdian', 'kinerja_pengabdian.id_pengabdian', '=', 'kinerja_pengabdian_author.id')
        ->join('dosen', 'dosen.nidn', '=', 'kinerja_pengabdian_author.nidn')
        ->join('REF_UNIT', 'dosen.id_sub_unit', '=', 'REF_UNIT.ID' ) 
        ->join('remun_point_terindex', 'kinerja_pengabdian.id_terindek', '=', 'remun_point_terindex.id_terindek' )
        ->join('REF_UNIT_FAKULTAS', 'dosen.id_unit', '=', 'REF_UNIT_FAKULTAS.ID_FAKULTAS')
        ->where('status_pengabdian', '=', 'Ditolak')
        ->where('tahun', '=', 2017)
        ->get()->count();
        $menunggu17 = DB::table('kinerja_pengabdian_author')
        ->join('kinerja_pengabdian', 'kinerja_pengabdian.id_pengabdian', '=', 'kinerja_pengabdian_author.id')
        ->join('dosen', 'dosen.nidn', '=', 'kinerja_pengabdian_author.nidn')
        ->join('REF_UNIT', 'dosen.id_sub_unit', '=', 'REF_UNIT.ID' ) 
        ->join('remun_point_terindex', 'kinerja_pengabdian.id_terindek', '=', 'remun_point_terindex.id_terindek' )
        ->join('REF_UNIT_FAKULTAS', 'dosen.id_unit', '=', 'REF_UNIT_FAKULTAS.ID_FAKULTAS')
        ->where('status_pengabdian', '=', 'Menunggu')
        ->where('tahun', '=', 2017)
        ->get()->count();
        $tervalidasi17 = DB::table('kinerja_pengabdian_author')
        ->join('kinerja_pengabdian', 'kinerja_pengabdian.id_pengabdian', '=', 'kinerja_pengabdian_author.id')
        ->join('dosen', 'dosen.nidn', '=', 'kinerja_pengabdian_author.nidn')
        ->join('REF_UNIT', 'dosen.id_sub_unit', '=', 'REF_UNIT.ID' ) 
        ->join('remun_point_terindex', 'kinerja_pengabdian.id_terindek', '=', 'remun_point_terindex.id_terindek' )
        ->join('REF_UNIT_FAKULTAS', 'dosen.id_unit', '=', 'REF_UNIT_FAKULTAS.ID_FAKULTAS')
        ->where('status_pengabdian', '=', 'Tervalidasi')
        ->where('tahun', '=', 2017)
        ->get()->count();
        $perbaiki17 = DB::table('kinerja_pengabdian_author')
        ->join('kinerja_pengabdian', 'kinerja_pengabdian.id_pengabdian', '=', 'kinerja_pengabdian_author.id')
        ->join('dosen', 'dosen.nidn', '=', 'kinerja_pengabdian_author.nidn')
        ->join('REF_UNIT', 'dosen.id_sub_unit', '=', 'REF_UNIT.ID' ) 
        ->join('remun_point_terindex', 'kinerja_pengabdian.id_terindek', '=', 'remun_point_terindex.id_terindek' )
        ->join('REF_UNIT_FAKULTAS', 'dosen.id_unit', '=', 'REF_UNIT_FAKULTAS.ID_FAKULTAS')
        ->where('status_pengabdian', '=', 'Perbaiki')
        ->where('tahun', '=', 2017)
        ->get()->count();
        $terverifikasi17 = DB::table('kinerja_pengabdian_author')
        ->join('kinerja_pengabdian', 'kinerja_pengabdian.id_pengabdian', '=', 'kinerja_pengabdian_author.id')
        ->join('dosen', 'dosen.nidn', '=', 'kinerja_pengabdian_author.nidn')
        ->join('REF_UNIT', 'dosen.id_sub_unit', '=', 'REF_UNIT.ID' ) 
        ->join('remun_point_terindex', 'kinerja_pengabdian.id_terindek', '=', 'remun_point_terindex.id_terindek' )
        ->join('REF_UNIT_FAKULTAS', 'dosen.id_unit', '=', 'REF_UNIT_FAKULTAS.ID_FAKULTAS')
        ->where('status_pengabdian', '=', 'Terverifikasi')
        ->where('tahun', '=', 2017)
        ->get()->count();

        //2018
        $ditolak18 = DB::table('kinerja_pengabdian_author')
        ->join('kinerja_pengabdian', 'kinerja_pengabdian.id_pengabdian', '=', 'kinerja_pengabdian_author.id')
        ->join('dosen', 'dosen.nidn', '=', 'kinerja_pengabdian_author.nidn')
        ->join('remun_point_terindex', 'kinerja_pengabdian.id_terindek', '=', 'remun_point_terindex.id_terindek' )
        ->join('REF_UNIT', 'dosen.id_sub_unit', '=', 'REF_UNIT.ID' ) 
        ->join('REF_UNIT_FAKULTAS', 'dosen.id_unit', '=', 'REF_UNIT_FAKULTAS.ID_FAKULTAS')
        ->where('status_pengabdian', '=', 'Ditolak')
        ->where('tahun', '=', 2018)
        ->get()->count();
        $menunggu18 = DB::table('kinerja_pengabdian_author')
        ->join('kinerja_pengabdian', 'kinerja_pengabdian.id_pengabdian', '=', 'kinerja_pengabdian_author.id')
        ->join('dosen', 'dosen.nidn', '=', 'kinerja_pengabdian_author.nidn')
        ->join('remun_point_terindex', 'kinerja_pengabdian.id_terindek', '=', 'remun_point_terindex.id_terindek' )
        ->join('REF_UNIT', 'dosen.id_sub_unit', '=', 'REF_UNIT.ID' ) 
        ->join('REF_UNIT_FAKULTAS', 'dosen.id_unit', '=', 'REF_UNIT_FAKULTAS.ID_FAKULTAS')
        ->where('status_pengabdian', '=', 'Menunggu')
        ->where('tahun', '=', 2018)
        ->get()->count();
        $tervalidasi18 = DB::table('kinerja_pengabdian_author')
        ->join('kinerja_pengabdian', 'kinerja_pengabdian.id_pengabdian', '=', 'kinerja_pengabdian_author.id')
        ->join('dosen', 'dosen.nidn', '=', 'kinerja_pengabdian_author.nidn')
        ->join('remun_point_terindex', 'kinerja_pengabdian.id_terindek', '=', 'remun_point_terindex.id_terindek' )
        ->join('REF_UNIT', 'dosen.id_sub_unit', '=', 'REF_UNIT.ID' ) 
        ->join('REF_UNIT_FAKULTAS', 'dosen.id_unit', '=', 'REF_UNIT_FAKULTAS.ID_FAKULTAS')
        ->where('status_pengabdian', '=', 'Tervalidasi')
        ->where('tahun', '=', 2018)
        ->get()->count();
        $perbaiki18 = DB::table('kinerja_pengabdian_author')
        ->join('kinerja_pengabdian', 'kinerja_pengabdian.id_pengabdian', '=', 'kinerja_pengabdian_author.id')
        ->join('dosen', 'dosen.nidn', '=', 'kinerja_pengabdian_author.nidn')
        ->join('remun_point_terindex', 'kinerja_pengabdian.id_terindek', '=', 'remun_point_terindex.id_terindek' )
        ->join('REF_UNIT', 'dosen.id_sub_unit', '=', 'REF_UNIT.ID' ) 
        ->join('REF_UNIT_FAKULTAS', 'dosen.id_unit', '=', 'REF_UNIT_FAKULTAS.ID_FAKULTAS')
        ->where('status_pengabdian', '=', 'Perbaiki')
        ->where('tahun', '=', 2018)
        ->get()->count();
        $terverifikasi18 = DB::table('kinerja_pengabdian_author')
        ->join('kinerja_pengabdian', 'kinerja_pengabdian.id_pengabdian', '=', 'kinerja_pengabdian_author.id')
        ->join('dosen', 'dosen.nidn', '=', 'kinerja_pengabdian_author.nidn')
        ->join('remun_point_terindex', 'kinerja_pengabdian.id_terindek', '=', 'remun_point_terindex.id_terindek' )
        ->join('REF_UNIT', 'dosen.id_sub_unit', '=', 'REF_UNIT.ID' ) 
        ->join('REF_UNIT_FAKULTAS', 'dosen.id_unit', '=', 'REF_UNIT_FAKULTAS.ID_FAKULTAS')
        ->where('status_pengabdian', '=', 'Terverifikasi')
        ->where('tahun', '=', 2018)
        ->get()->count();

        //2019
        $ditolak19 = DB::table('kinerja_pengabdian_author')
        ->join('kinerja_pengabdian', 'kinerja_pengabdian.id_pengabdian', '=', 'kinerja_pengabdian_author.id')
        ->join('dosen', 'dosen.nidn', '=', 'kinerja_pengabdian_author.nidn')
        ->join('remun_point_terindex', 'kinerja_pengabdian.id_terindek', '=', 'remun_point_terindex.id_terindek' )
        ->join('REF_UNIT', 'dosen.id_sub_unit', '=', 'REF_UNIT.ID' ) 
        ->join('REF_UNIT_FAKULTAS', 'dosen.id_unit', '=', 'REF_UNIT_FAKULTAS.ID_FAKULTAS')
        ->where('status_pengabdian', '=', 'Ditolak')
        ->where('tahun', '=', 2019)
        ->get()->count();
        $menunggu19 = DB::table('kinerja_pengabdian_author')
        ->join('kinerja_pengabdian', 'kinerja_pengabdian.id_pengabdian', '=', 'kinerja_pengabdian_author.id')
        ->join('dosen', 'dosen.nidn', '=', 'kinerja_pengabdian_author.nidn')
        ->join('remun_point_terindex', 'kinerja_pengabdian.id_terindek', '=', 'remun_point_terindex.id_terindek' )
        ->join('REF_UNIT', 'dosen.id_sub_unit', '=', 'REF_UNIT.ID' ) 
        ->join('REF_UNIT_FAKULTAS', 'dosen.id_unit', '=', 'REF_UNIT_FAKULTAS.ID_FAKULTAS')
        ->where('status_pengabdian', '=', 'Menunggu')
        ->where('tahun', '=', 2019)
        ->get()->count();
        $tervalidasi19 = DB::table('kinerja_pengabdian_author')
        ->join('kinerja_pengabdian', 'kinerja_pengabdian.id_pengabdian', '=', 'kinerja_pengabdian_author.id')
        ->join('dosen', 'dosen.nidn', '=', 'kinerja_pengabdian_author.nidn')
        ->join('remun_point_terindex', 'kinerja_pengabdian.id_terindek', '=', 'remun_point_terindex.id_terindek' )
        ->join('REF_UNIT', 'dosen.id_sub_unit', '=', 'REF_UNIT.ID' ) 
        ->join('REF_UNIT_FAKULTAS', 'dosen.id_unit', '=', 'REF_UNIT_FAKULTAS.ID_FAKULTAS')
        ->where('status_pengabdian', '=', 'Tervalidasi')
        ->where('tahun', '=', 2019)
        ->get()->count();
        $perbaiki19 = DB::table('kinerja_pengabdian_author')
        ->join('kinerja_pengabdian', 'kinerja_pengabdian.id_pengabdian', '=', 'kinerja_pengabdian_author.id')
        ->join('dosen', 'dosen.nidn', '=', 'kinerja_pengabdian_author.nidn')
        ->join('remun_point_terindex', 'kinerja_pengabdian.id_terindek', '=', 'remun_point_terindex.id_terindek' )
        ->join('REF_UNIT', 'dosen.id_sub_unit', '=', 'REF_UNIT.ID' ) 
        ->join('REF_UNIT_FAKULTAS', 'dosen.id_unit', '=', 'REF_UNIT_FAKULTAS.ID_FAKULTAS')
        ->where('status_pengabdian', '=', 'Perbaiki')
        ->where('tahun', '=', 2019)
        ->get()->count();
        $terverifikasi19 = DB::table('kinerja_pengabdian_author')
        ->join('kinerja_pengabdian', 'kinerja_pengabdian.id_pengabdian', '=', 'kinerja_pengabdian_author.id')
        ->join('dosen', 'dosen.nidn', '=', 'kinerja_pengabdian_author.nidn')
        ->join('remun_point_terindex', 'kinerja_pengabdian.id_terindek', '=', 'remun_point_terindex.id_terindek' )
        ->join('REF_UNIT', 'dosen.id_sub_unit', '=', 'REF_UNIT.ID' ) 
        ->join('REF_UNIT_FAKULTAS', 'dosen.id_unit', '=', 'REF_UNIT_FAKULTAS.ID_FAKULTAS')
        ->where('status_pengabdian', '=', 'Terverifikasi')
        ->where('tahun', '=', 2019)
        ->get()->count();

        //2020
        $ditolak20 = DB::table('kinerja_pengabdian_author')
        ->join('kinerja_pengabdian', 'kinerja_pengabdian.id_pengabdian', '=', 'kinerja_pengabdian_author.id')
        ->join('dosen', 'dosen.nidn', '=', 'kinerja_pengabdian_author.nidn')
        ->join('REF_UNIT', 'dosen.id_sub_unit', '=', 'REF_UNIT.ID' ) 
        ->join('remun_point_terindex', 'kinerja_pengabdian.id_terindek', '=', 'remun_point_terindex.id_terindek' )
        ->join('REF_UNIT_FAKULTAS', 'dosen.id_unit', '=', 'REF_UNIT_FAKULTAS.ID_FAKULTAS')
        ->where('status_pengabdian', '=', 'Ditolak')
        ->where('tahun', '=', 2020)
        ->get()->count();
        $menunggu20 = DB::table('kinerja_pengabdian_author')
        ->join('kinerja_pengabdian', 'kinerja_pengabdian.id_pengabdian', '=', 'kinerja_pengabdian_author.id')
        ->join('dosen', 'dosen.nidn', '=', 'kinerja_pengabdian_author.nidn')
        ->join('REF_UNIT', 'dosen.id_sub_unit', '=', 'REF_UNIT.ID' ) 
        ->join('remun_point_terindex', 'kinerja_pengabdian.id_terindek', '=', 'remun_point_terindex.id_terindek' )
        ->join('REF_UNIT_FAKULTAS', 'dosen.id_unit', '=', 'REF_UNIT_FAKULTAS.ID_FAKULTAS')
        ->where('status_pengabdian', '=', 'Menunggu')
        ->where('tahun', '=', 2020)
        ->get()->count();
        $tervalidasi20 = DB::table('kinerja_pengabdian_author')
        ->join('kinerja_pengabdian', 'kinerja_pengabdian.id_pengabdian', '=', 'kinerja_pengabdian_author.id')
        ->join('dosen', 'dosen.nidn', '=', 'kinerja_pengabdian_author.nidn')
        ->join('REF_UNIT', 'dosen.id_sub_unit', '=', 'REF_UNIT.ID' ) 
        ->join('remun_point_terindex', 'kinerja_pengabdian.id_terindek', '=', 'remun_point_terindex.id_terindek' )
        ->join('REF_UNIT_FAKULTAS', 'dosen.id_unit', '=', 'REF_UNIT_FAKULTAS.ID_FAKULTAS')
        ->where('status_pengabdian', '=', 'Tervalidasi')
        ->where('tahun', '=', 2020)
        ->get()->count();
        $perbaiki20 = DB::table('kinerja_pengabdian_author')
        ->join('kinerja_pengabdian', 'kinerja_pengabdian.id_pengabdian', '=', 'kinerja_pengabdian_author.id')
        ->join('dosen', 'dosen.nidn', '=', 'kinerja_pengabdian_author.nidn')
        ->join('REF_UNIT', 'dosen.id_sub_unit', '=', 'REF_UNIT.ID' ) 
        ->join('remun_point_terindex', 'kinerja_pengabdian.id_terindek', '=', 'remun_point_terindex.id_terindek' )
        ->join('REF_UNIT_FAKULTAS', 'dosen.id_unit', '=', 'REF_UNIT_FAKULTAS.ID_FAKULTAS')
        ->where('status_pengabdian', '=', 'Perbaiki')
        ->where('tahun', '=', 2020)
        ->get()->count();
        $terverifikasi20 = DB::table('kinerja_pengabdian_author')
        ->join('kinerja_pengabdian', 'kinerja_pengabdian.id_pengabdian', '=', 'kinerja_pengabdian_author.id')
        ->join('dosen', 'dosen.nidn', '=', 'kinerja_pengabdian_author.nidn')
        ->join('REF_UNIT', 'dosen.id_sub_unit', '=', 'REF_UNIT.ID' ) 
        ->join('remun_point_terindex', 'kinerja_pengabdian.id_terindek', '=', 'remun_point_terindex.id_terindek' )
        ->join('REF_UNIT_FAKULTAS', 'dosen.id_unit', '=', 'REF_UNIT_FAKULTAS.ID_FAKULTAS')
        ->where('status_pengabdian', '=', 'Terverifikasi')
        ->where('tahun', '=', 2020)
        ->get()->count();

        //2021
        $ditolak21 = DB::table('kinerja_pengabdian_author')
        ->join('kinerja_pengabdian', 'kinerja_pengabdian.id_pengabdian', '=', 'kinerja_pengabdian_author.id')
        ->join('dosen', 'dosen.nidn', '=', 'kinerja_pengabdian_author.nidn')
        ->join('remun_point_terindex', 'kinerja_pengabdian.id_terindek', '=', 'remun_point_terindex.id_terindek' )
        ->join('REF_UNIT', 'dosen.id_sub_unit', '=', 'REF_UNIT.ID' ) 
        ->join('REF_UNIT_FAKULTAS', 'dosen.id_unit', '=', 'REF_UNIT_FAKULTAS.ID_FAKULTAS')
        ->where('status_pengabdian', '=', 'Ditolak')
        ->where('tahun', '=', 2021)
        ->get()->count();
        $menunggu21 = DB::table('kinerja_pengabdian_author')
        ->join('kinerja_pengabdian', 'kinerja_pengabdian.id_pengabdian', '=', 'kinerja_pengabdian_author.id')
        ->join('dosen', 'dosen.nidn', '=', 'kinerja_pengabdian_author.nidn')
        ->join('remun_point_terindex', 'kinerja_pengabdian.id_terindek', '=', 'remun_point_terindex.id_terindek' )
        ->join('REF_UNIT', 'dosen.id_sub_unit', '=', 'REF_UNIT.ID' ) 
        ->join('REF_UNIT_FAKULTAS', 'dosen.id_unit', '=', 'REF_UNIT_FAKULTAS.ID_FAKULTAS')
        ->where('status_pengabdian', '=', 'Menunggu')
        ->where('tahun', '=', 2021)
        ->get()->count();
        $tervalidasi21 = DB::table('kinerja_pengabdian_author')
        ->join('kinerja_pengabdian', 'kinerja_pengabdian.id_pengabdian', '=', 'kinerja_pengabdian_author.id')
        ->join('dosen', 'dosen.nidn', '=', 'kinerja_pengabdian_author.nidn')
        ->join('remun_point_terindex', 'kinerja_pengabdian.id_terindek', '=', 'remun_point_terindex.id_terindek' )
        ->join('REF_UNIT', 'dosen.id_sub_unit', '=', 'REF_UNIT.ID' ) 
        ->join('REF_UNIT_FAKULTAS', 'dosen.id_unit', '=', 'REF_UNIT_FAKULTAS.ID_FAKULTAS')
        ->where('status_pengabdian', '=', 'Tervalidasi')
        ->where('tahun', '=', 2021)
        ->get()->count();
        $perbaiki21 = DB::table('kinerja_pengabdian_author')
        ->join('kinerja_pengabdian', 'kinerja_pengabdian.id_pengabdian', '=', 'kinerja_pengabdian_author.id')
        ->join('dosen', 'dosen.nidn', '=', 'kinerja_pengabdian_author.nidn')
        ->join('remun_point_terindex', 'kinerja_pengabdian.id_terindek', '=', 'remun_point_terindex.id_terindek' )
        ->join('REF_UNIT', 'dosen.id_sub_unit', '=', 'REF_UNIT.ID' ) 
        ->join('REF_UNIT_FAKULTAS', 'dosen.id_unit', '=', 'REF_UNIT_FAKULTAS.ID_FAKULTAS')
        ->where('status_pengabdian', '=', 'Perbaiki')
        ->where('tahun', '=', 2021)
        ->get()->count();
        $terverifikasi21 = DB::table('kinerja_pengabdian_author')
        ->join('kinerja_pengabdian', 'kinerja_pengabdian.id_pengabdian', '=', 'kinerja_pengabdian_author.id')
        ->join('dosen', 'dosen.nidn', '=', 'kinerja_pengabdian_author.nidn')
        ->join('remun_point_terindex', 'kinerja_pengabdian.id_terindek', '=', 'remun_point_terindex.id_terindek' )
        ->join('REF_UNIT', 'dosen.id_sub_unit', '=', 'REF_UNIT.ID' ) 
        ->join('REF_UNIT_FAKULTAS', 'dosen.id_unit', '=', 'REF_UNIT_FAKULTAS.ID_FAKULTAS')
        ->where('status_pengabdian', '=', 'Terverifikasi')
        ->where('tahun', '=', 2021)
        ->get()->count();       
        
        return view('kinerja_pengabdian.index', compact( 'data', 'keyword','categoriesval', 'dataval', 'categoriescat', 'datacat', 'tahunpen',
        'ditolak17', 'menunggu17', 'tervalidasi17', 'perbaiki17', 'terverifikasi17',
        'ditolak18', 'menunggu18', 'tervalidasi18', 'perbaiki18', 'terverifikasi18',
        'ditolak19', 'menunggu19', 'tervalidasi19', 'perbaiki19', 'terverifikasi19',
        'ditolak20', 'menunggu20', 'tervalidasi20', 'perbaiki20', 'terverifikasi20',
        'ditolak21', 'menunggu21', 'tervalidasi21', 'perbaiki21', 'terverifikasi21',
        'categoriesslide1', 'dataslide1','categoriesslide2', 'dataslide2','categoriesslide3', 'dataslide3',
       ))->with('i', ($request->input('page', 1) - 1) * 20);
    }
    public function pengabdian_ex()
	{
		return Excel::download(new PengabdianExport, 'Kinerja_Pengabdian.xlsx');
	}
}
