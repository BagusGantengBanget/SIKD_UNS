<?php

namespace App\Http\Controllers;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\Request;
use App\kinerja_jurnal;
use DB;
use App\Exports\JurnalExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class Kinerja_JurnalController extends Controller
{
    public function index(Request $request)
    {

        
        $pagination = 20;
        $keyword = $request->keyword;
        $data = DB::table('kinerja_jurnal_author')
        ->join('kinerja_jurnal', 'kinerja_jurnal.id_jurnal', '=', 'kinerja_jurnal_author.id')
        ->join('dosen', 'dosen.nidn', '=', 'kinerja_jurnal_author.nidn')
        ->join('REF_UNIT_FAKULTAS', 'dosen.id_unit', '=', 'REF_UNIT_FAKULTAS.ID_FAKULTAS')
        ->join('remun_point_terindex', 'kinerja_jurnal.id_terindek', '=', 'remun_point_terindex.id_terindek' ) 
        ->join('REF_UNIT', 'dosen.id_sub_unit', '=', 'REF_UNIT.ID' ) 
        ->where('kinerja_jurnal.tahun','like','%'.$keyword.'%')
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
       $validasifak = DB::table('kinerja_jurnal_author')
       ->join('kinerja_jurnal', 'kinerja_jurnal.id_jurnal', '=', 'kinerja_jurnal_author.id')
       ->join('dosen', 'dosen.nidn', '=', 'kinerja_jurnal_author.nidn')
       ->join('REF_UNIT_FAKULTAS', 'dosen.id_unit', '=', 'REF_UNIT_FAKULTAS.ID_FAKULTAS')
       ->join('REF_UNIT', 'dosen.id_sub_unit', '=', 'REF_UNIT.ID' ) 
       ->join('remun_point_terindex', 'kinerja_jurnal.id_terindek', '=', 'remun_point_terindex.id_terindek' ) 
       ->where('kinerja_jurnal.status_jurnal', '=', 'Tervalidasi')
       ->Where('kinerja_jurnal.tahun','like','%'.$keyword.'%')
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
       $catjurnal = DB::table('kinerja_jurnal_author')
       ->join('kinerja_jurnal', 'kinerja_jurnal.id_jurnal', '=', 'kinerja_jurnal_author.id')
       ->join('dosen', 'dosen.nidn', '=', 'kinerja_jurnal_author.nidn')
       ->join('REF_UNIT_FAKULTAS', 'dosen.id_unit', '=', 'REF_UNIT_FAKULTAS.ID_FAKULTAS')
       ->join('REF_UNIT', 'dosen.id_sub_unit', '=', 'REF_UNIT.ID' ) 
       ->join('remun_point_terindex', 'kinerja_jurnal.id_terindek', '=', 'remun_point_terindex.id_terindek' ) 
       ->Where('kinerja_jurnal.tahun','like','%'.$keyword.'%')
       ->groupBy('remun_point_terindex.nama_tmp',)
       ->select('remun_point_terindex.nama_tmp',  \DB::raw('count(*) as totalcat'))
       ->get();

       $categoriescat = [];
       $datacat=[];
       foreach($catjurnal as $dt){
           $categoriescat[] = $dt->nama_tmp;
           $datacat[] = $dt->totalcat;
       }

       $slide1 = DB::table('kinerja_jurnal_author')
       ->join('kinerja_jurnal', 'kinerja_jurnal.id_jurnal', '=', 'kinerja_jurnal_author.id')
       ->join('dosen', 'dosen.nidn', '=', 'kinerja_jurnal_author.nidn')
       ->join('REF_UNIT_FAKULTAS', 'dosen.id_unit', '=', 'REF_UNIT_FAKULTAS.ID_FAKULTAS')
       ->join('remun_point_terindex', 'kinerja_jurnal.id_terindek', '=', 'remun_point_terindex.id_terindek' ) 
       ->where('kinerja_jurnal.id_terindek', '=', 1)
       ->Where('kinerja_jurnal.tahun','like','%'.$keyword.'%')
       ->groupBy('REF_UNIT_FAKULTAS.FAKULTAS')
       ->select('REF_UNIT_FAKULTAS.FAKULTAS',  \DB::raw('count(*) as totalslide1'))
       ->get();

       $categoriesslide1 = [];
       $dataslide1=[];
       foreach($slide1 as $dt){
           $categoriesslide1[] = $dt->FAKULTAS;
           $dataslide1[] = $dt->totalslide1;
       }

       $slide2 = DB::table('kinerja_jurnal_author')
       ->join('kinerja_jurnal', 'kinerja_jurnal.id_jurnal', '=', 'kinerja_jurnal_author.id')
       ->join('dosen', 'dosen.nidn', '=', 'kinerja_jurnal_author.nidn')
       ->join('REF_UNIT_FAKULTAS', 'dosen.id_unit', '=', 'REF_UNIT_FAKULTAS.ID_FAKULTAS')
       ->join('remun_point_terindex', 'kinerja_jurnal.id_terindek', '=', 'remun_point_terindex.id_terindek' ) 
       ->where('kinerja_jurnal.id_terindek', '=', 2)
       ->Where('kinerja_jurnal.tahun','like','%'.$keyword.'%')
       ->groupBy('REF_UNIT_FAKULTAS.FAKULTAS')
       ->select('REF_UNIT_FAKULTAS.FAKULTAS',  \DB::raw('count(*) as totalslide2'))
       ->get();

       $categoriesslide2 = [];
       $dataslide2=[];
       foreach($slide2 as $dt){
           $categoriesslide2[] = $dt->FAKULTAS;
           $dataslide2[] = $dt->totalslide2;
       }

       $slide3 = DB::table('kinerja_jurnal_author')
       ->join('kinerja_jurnal', 'kinerja_jurnal.id_jurnal', '=', 'kinerja_jurnal_author.id')
       ->join('dosen', 'dosen.nidn', '=', 'kinerja_jurnal_author.nidn')
       ->join('REF_UNIT_FAKULTAS', 'dosen.id_unit', '=', 'REF_UNIT_FAKULTAS.ID_FAKULTAS')
       ->join('remun_point_terindex', 'kinerja_jurnal.id_terindek', '=', 'remun_point_terindex.id_terindek' ) 
       ->where('kinerja_jurnal.id_terindek', '=', 3)
       ->Where('kinerja_jurnal.tahun','like','%'.$keyword.'%')
       ->groupBy('REF_UNIT_FAKULTAS.FAKULTAS')
       ->select('REF_UNIT_FAKULTAS.FAKULTAS',  \DB::raw('count(*) as totalslide3'))
       ->get();

       $categoriesslide3 = [];
       $dataslide3=[];
       foreach($slide3 as $dt){
           $categoriesslide3[] = $dt->FAKULTAS;
           $dataslide3[] = $dt->totalslide3;
       }
      
       $slide4 = DB::table('kinerja_jurnal_author')
       ->join('kinerja_jurnal', 'kinerja_jurnal.id_jurnal', '=', 'kinerja_jurnal_author.id')
       ->join('dosen', 'dosen.nidn', '=', 'kinerja_jurnal_author.nidn')
       ->join('REF_UNIT_FAKULTAS', 'dosen.id_unit', '=', 'REF_UNIT_FAKULTAS.ID_FAKULTAS')
       ->join('remun_point_terindex', 'kinerja_jurnal.id_terindek', '=', 'remun_point_terindex.id_terindek' ) 
       ->where('kinerja_jurnal.id_terindek', '=', 4)
       ->Where('kinerja_jurnal.tahun','like','%'.$keyword.'%')
       ->groupBy('REF_UNIT_FAKULTAS.FAKULTAS')
       ->select('REF_UNIT_FAKULTAS.FAKULTAS',  \DB::raw('count(*) as totalslide4'))
       ->get();

       $categoriesslide4 = [];
       $dataslide4=[];
       foreach($slide4 as $dt){
           $categoriesslide4[] = $dt->FAKULTAS;
           $dataslide4[] = $dt->totalslide4;
       }
       
       $slide5 = DB::table('kinerja_jurnal_author')
        ->join('kinerja_jurnal', 'kinerja_jurnal.id_jurnal', '=', 'kinerja_jurnal_author.id')
        ->join('dosen', 'dosen.nidn', '=', 'kinerja_jurnal_author.nidn')
        ->join('REF_UNIT_FAKULTAS', 'dosen.id_unit', '=', 'REF_UNIT_FAKULTAS.ID_FAKULTAS')
        ->join('remun_point_terindex', 'kinerja_jurnal.id_terindek', '=', 'remun_point_terindex.id_terindek' ) 
        ->where('kinerja_jurnal.id_terindek', '=', 5)
        ->Where('kinerja_jurnal.tahun','like','%'.$keyword.'%')
        ->groupBy('REF_UNIT_FAKULTAS.FAKULTAS')
        ->select('REF_UNIT_FAKULTAS.FAKULTAS',  \DB::raw('count(*) as totalslide5'))
        ->get();

        $categoriesslide5 = [];
        $dataslide5=[];
        foreach($slide5 as $dt){
            $categoriesslide5[] = $dt->FAKULTAS;
            $dataslide5[] = $dt->totalslide5;
        }

        $slide6 = DB::table('kinerja_jurnal_author')
        ->join('kinerja_jurnal', 'kinerja_jurnal.id_jurnal', '=', 'kinerja_jurnal_author.id')
        ->join('dosen', 'dosen.nidn', '=', 'kinerja_jurnal_author.nidn')
        ->join('REF_UNIT_FAKULTAS', 'dosen.id_unit', '=', 'REF_UNIT_FAKULTAS.ID_FAKULTAS')
        ->join('remun_point_terindex', 'kinerja_jurnal.id_terindek', '=', 'remun_point_terindex.id_terindek' ) 
        ->where('kinerja_jurnal.id_terindek', '=', 6)
        ->Where('kinerja_jurnal.tahun','like','%'.$keyword.'%')
        ->groupBy('REF_UNIT_FAKULTAS.FAKULTAS')
        ->select('REF_UNIT_FAKULTAS.FAKULTAS',  \DB::raw('count(*) as totalslide6'))
        ->get();

        $categoriesslide6 = [];
        $dataslide6=[];
        foreach($slide6 as $dt){
            $categoriesslide6[] = $dt->FAKULTAS;
            $dataslide6[] = $dt->totalslide6;
        }

        $slide7 = DB::table('kinerja_jurnal_author')
        ->join('kinerja_jurnal', 'kinerja_jurnal.id_jurnal', '=', 'kinerja_jurnal_author.id')
        ->join('dosen', 'dosen.nidn', '=', 'kinerja_jurnal_author.nidn')
        ->join('REF_UNIT_FAKULTAS', 'dosen.id_unit', '=', 'REF_UNIT_FAKULTAS.ID_FAKULTAS')
        ->join('remun_point_terindex', 'kinerja_jurnal.id_terindek', '=', 'remun_point_terindex.id_terindek' ) 
        ->where('kinerja_jurnal.id_terindek', '=', 51)
        ->Where('kinerja_jurnal.tahun','like','%'.$keyword.'%')
        ->groupBy('REF_UNIT_FAKULTAS.FAKULTAS')
        ->select('REF_UNIT_FAKULTAS.FAKULTAS',  \DB::raw('count(*) as totalslide7'))
        ->get();

        $categoriesslide7 = [];
        $dataslide7=[];
        foreach($slide7 as $dt){
            $categoriesslide7[] = $dt->FAKULTAS;
            $dataslide7[] = $dt->totalslide7;
        }

        $slide8 = DB::table('kinerja_jurnal_author')
        ->join('kinerja_jurnal', 'kinerja_jurnal.id_jurnal', '=', 'kinerja_jurnal_author.id')
        ->join('dosen', 'dosen.nidn', '=', 'kinerja_jurnal_author.nidn')
        ->join('REF_UNIT_FAKULTAS', 'dosen.id_unit', '=', 'REF_UNIT_FAKULTAS.ID_FAKULTAS')
        ->join('remun_point_terindex', 'kinerja_jurnal.id_terindek', '=', 'remun_point_terindex.id_terindek' ) 
        ->where('kinerja_jurnal.id_terindek', '=', 69)
        ->Where('kinerja_jurnal.tahun','like','%'.$keyword.'%')
        ->groupBy('REF_UNIT_FAKULTAS.FAKULTAS')
        ->select('REF_UNIT_FAKULTAS.FAKULTAS',  \DB::raw('count(*) as totalslide8'))
        ->get();

        $categoriesslide8 = [];
        $dataslide8=[];
        foreach($slide8 as $dt){
            $categoriesslide8[] = $dt->FAKULTAS;
            $dataslide8[] = $dt->totalslide8;
        }

        $slide9 = DB::table('kinerja_jurnal_author')
        ->join('kinerja_jurnal', 'kinerja_jurnal.id_jurnal', '=', 'kinerja_jurnal_author.id')
        ->join('dosen', 'dosen.nidn', '=', 'kinerja_jurnal_author.nidn')
        ->join('REF_UNIT_FAKULTAS', 'dosen.id_unit', '=', 'REF_UNIT_FAKULTAS.ID_FAKULTAS')
        ->join('remun_point_terindex', 'kinerja_jurnal.id_terindek', '=', 'remun_point_terindex.id_terindek' ) 
        ->where('kinerja_jurnal.id_terindek', '=', 71)
        ->Where('kinerja_jurnal.tahun','like','%'.$keyword.'%')
        ->groupBy('REF_UNIT_FAKULTAS.FAKULTAS')
        ->select('REF_UNIT_FAKULTAS.FAKULTAS',  \DB::raw('count(*) as totalslide9'))
        ->get();

        $categoriesslide9 = [];
        $dataslide9=[];
        foreach($slide9 as $dt){
            $categoriesslide9[] = $dt->FAKULTAS;
            $dataslide9[] = $dt->totalslide9;
        }

        $slide10 = DB::table('kinerja_jurnal_author')
        ->join('kinerja_jurnal', 'kinerja_jurnal.id_jurnal', '=', 'kinerja_jurnal_author.id')
        ->join('dosen', 'dosen.nidn', '=', 'kinerja_jurnal_author.nidn')
        ->join('REF_UNIT_FAKULTAS', 'dosen.id_unit', '=', 'REF_UNIT_FAKULTAS.ID_FAKULTAS')
        ->join('remun_point_terindex', 'kinerja_jurnal.id_terindek', '=', 'remun_point_terindex.id_terindek' ) 
        ->where('kinerja_jurnal.id_terindek', '=', 72)
        ->Where('kinerja_jurnal.tahun','like','%'.$keyword.'%')
        ->groupBy('REF_UNIT_FAKULTAS.FAKULTAS')
        ->select('REF_UNIT_FAKULTAS.FAKULTAS',  \DB::raw('count(*) as totalslide10'))
        ->get();

        $categoriesslide10 = [];
        $dataslide10=[];
        foreach($slide10 as $dt){
            $categoriesslide10[] = $dt->FAKULTAS;
            $dataslide10[] = $dt->totalslide10;
        }

        $slide11 = DB::table('kinerja_jurnal_author')
        ->join('kinerja_jurnal', 'kinerja_jurnal.id_jurnal', '=', 'kinerja_jurnal_author.id')
        ->join('dosen', 'dosen.nidn', '=', 'kinerja_jurnal_author.nidn')
        ->join('REF_UNIT_FAKULTAS', 'dosen.id_unit', '=', 'REF_UNIT_FAKULTAS.ID_FAKULTAS')
        ->join('remun_point_terindex', 'kinerja_jurnal.id_terindek', '=', 'remun_point_terindex.id_terindek' ) 
        ->where('kinerja_jurnal.id_terindek', '=', 73)
        ->Where('kinerja_jurnal.tahun','like','%'.$keyword.'%')
        ->groupBy('REF_UNIT_FAKULTAS.FAKULTAS')
        ->select('REF_UNIT_FAKULTAS.FAKULTAS',  \DB::raw('count(*) as totalslide11'))
        ->get();

        $categoriesslide11 = [];
        $dataslide11=[];
        foreach($slide11 as $dt){
            $categoriesslide11[] = $dt->FAKULTAS;
            $dataslide11[] = $dt->totalslide11;
        }

        $slide12 = DB::table('kinerja_jurnal_author')
        ->join('kinerja_jurnal', 'kinerja_jurnal.id_jurnal', '=', 'kinerja_jurnal_author.id')
        ->join('dosen', 'dosen.nidn', '=', 'kinerja_jurnal_author.nidn')
        ->join('REF_UNIT_FAKULTAS', 'dosen.id_unit', '=', 'REF_UNIT_FAKULTAS.ID_FAKULTAS')
        ->join('remun_point_terindex', 'kinerja_jurnal.id_terindek', '=', 'remun_point_terindex.id_terindek' ) 
        ->where('kinerja_jurnal.id_terindek', '=', 74)
        ->Where('kinerja_jurnal.tahun','like','%'.$keyword.'%')
        ->groupBy('REF_UNIT_FAKULTAS.FAKULTAS')
        ->select('REF_UNIT_FAKULTAS.FAKULTAS',  \DB::raw('count(*) as totalslide12'))
        ->get();

        $categoriesslide12 = [];
        $dataslide12=[];
        foreach($slide12 as $dt){
            $categoriesslide12[] = $dt->FAKULTAS;
            $dataslide12[] = $dt->totalslide12;
        }

        $slide13 = DB::table('kinerja_jurnal_author')
        ->join('kinerja_jurnal', 'kinerja_jurnal.id_jurnal', '=', 'kinerja_jurnal_author.id')
        ->join('dosen', 'dosen.nidn', '=', 'kinerja_jurnal_author.nidn')
        ->join('REF_UNIT_FAKULTAS', 'dosen.id_unit', '=', 'REF_UNIT_FAKULTAS.ID_FAKULTAS')
        ->join('remun_point_terindex', 'kinerja_jurnal.id_terindek', '=', 'remun_point_terindex.id_terindek' ) 
        ->where('kinerja_jurnal.id_terindek', '=', 75)
        ->Where('kinerja_jurnal.tahun','like','%'.$keyword.'%')
        ->groupBy('REF_UNIT_FAKULTAS.FAKULTAS')
        ->select('REF_UNIT_FAKULTAS.FAKULTAS',  \DB::raw('count(*) as totalslide13'))
        ->get();

        $categoriesslide13 = [];
        $dataslide13=[];
        foreach($slide13 as $dt){
            $categoriesslide13[] = $dt->FAKULTAS;
            $dataslide13[] = $dt->totalslide13;
        }

        $slide14 = DB::table('kinerja_jurnal_author')
        ->join('kinerja_jurnal', 'kinerja_jurnal.id_jurnal', '=', 'kinerja_jurnal_author.id')
        ->join('dosen', 'dosen.nidn', '=', 'kinerja_jurnal_author.nidn')
        ->join('REF_UNIT_FAKULTAS', 'dosen.id_unit', '=', 'REF_UNIT_FAKULTAS.ID_FAKULTAS')
        ->join('remun_point_terindex', 'kinerja_jurnal.id_terindek', '=', 'remun_point_terindex.id_terindek' ) 
        ->where('kinerja_jurnal.id_terindek', '=', 76)
        ->Where('kinerja_jurnal.tahun','like','%'.$keyword.'%')
        ->groupBy('REF_UNIT_FAKULTAS.FAKULTAS')
        ->select('REF_UNIT_FAKULTAS.FAKULTAS',  \DB::raw('count(*) as totalslide14'))
        ->get();

        $categoriesslide14 = [];
        $dataslide14=[];
        foreach($slide14 as $dt){
            $categoriesslide14[] = $dt->FAKULTAS;
            $dataslide14[] = $dt->totalslide14;
        }

        $slide15 = DB::table('kinerja_jurnal_author')
        ->join('kinerja_jurnal', 'kinerja_jurnal.id_jurnal', '=', 'kinerja_jurnal_author.id')
        ->join('dosen', 'dosen.nidn', '=', 'kinerja_jurnal_author.nidn')
        ->join('REF_UNIT_FAKULTAS', 'dosen.id_unit', '=', 'REF_UNIT_FAKULTAS.ID_FAKULTAS')
        ->join('remun_point_terindex', 'kinerja_jurnal.id_terindek', '=', 'remun_point_terindex.id_terindek' ) 
        ->where('kinerja_jurnal.id_terindek', '=', 77)
        ->Where('kinerja_jurnal.tahun','like','%'.$keyword.'%')
        ->groupBy('REF_UNIT_FAKULTAS.FAKULTAS')
        ->select('REF_UNIT_FAKULTAS.FAKULTAS',  \DB::raw('count(*) as totalslide15'))
        ->get();

        $categoriesslide15 = [];
        $dataslide15=[];
        foreach($slide15 as $dt){
            $categoriesslide15[] = $dt->FAKULTAS;
            $dataslide15[] = $dt->totalslide15;
        }

        $slide16 = DB::table('kinerja_jurnal_author')
        ->join('kinerja_jurnal', 'kinerja_jurnal.id_jurnal', '=', 'kinerja_jurnal_author.id')
        ->join('dosen', 'dosen.nidn', '=', 'kinerja_jurnal_author.nidn')
        ->join('REF_UNIT_FAKULTAS', 'dosen.id_unit', '=', 'REF_UNIT_FAKULTAS.ID_FAKULTAS')
        ->join('remun_point_terindex', 'kinerja_jurnal.id_terindek', '=', 'remun_point_terindex.id_terindek' ) 
        ->where('kinerja_jurnal.id_terindek', '=', 78)
        ->Where('kinerja_jurnal.tahun','like','%'.$keyword.'%')
        ->groupBy('REF_UNIT_FAKULTAS.FAKULTAS')
        ->select('REF_UNIT_FAKULTAS.FAKULTAS',  \DB::raw('count(*) as totalslide16'))
        ->get();

        $categoriesslide16 = [];
        $dataslide16=[];
        foreach($slide16 as $dt){
            $categoriesslide16[] = $dt->FAKULTAS;
            $dataslide16[] = $dt->totalslide16;
        }

        $slide17 = DB::table('kinerja_jurnal_author')
        ->join('kinerja_jurnal', 'kinerja_jurnal.id_jurnal', '=', 'kinerja_jurnal_author.id')
        ->join('dosen', 'dosen.nidn', '=', 'kinerja_jurnal_author.nidn')
        ->join('REF_UNIT_FAKULTAS', 'dosen.id_unit', '=', 'REF_UNIT_FAKULTAS.ID_FAKULTAS')
        ->join('remun_point_terindex', 'kinerja_jurnal.id_terindek', '=', 'remun_point_terindex.id_terindek' ) 
        ->where('kinerja_jurnal.id_terindek', '=', 79)
        ->Where('kinerja_jurnal.tahun','like','%'.$keyword.'%')
        ->groupBy('REF_UNIT_FAKULTAS.FAKULTAS')
        ->select('REF_UNIT_FAKULTAS.FAKULTAS',  \DB::raw('count(*) as totalslide17'))
        ->get();

        $categoriesslide17 = [];
        $dataslide17=[];
        foreach($slide17 as $dt){
            $categoriesslide17[] = $dt->FAKULTAS;
            $dataslide17[] = $dt->totalslide17;
        }


        //=============================================================================================================================//
        

       //2017
       $ditolak17 = DB::table('kinerja_jurnal_author')
       ->join('kinerja_jurnal', 'kinerja_jurnal.id_jurnal', '=', 'kinerja_jurnal_author.id')
       ->join('dosen', 'dosen.nidn', '=', 'kinerja_jurnal_author.nidn')
        ->join('remun_point_terindex', 'kinerja_jurnal.id_terindek', '=', 'remun_point_terindex.id_terindek' ) 
       ->join('REF_UNIT', 'dosen.id_sub_unit', '=', 'REF_UNIT.ID' ) 
       ->join('REF_UNIT_FAKULTAS', 'dosen.id_unit', '=', 'REF_UNIT_FAKULTAS.ID_FAKULTAS')
       ->where('status_jurnal', '=', 'Ditolak')
       ->where('tahun', '=', 2017)
       ->get()->count();
       $menunggu17 = DB::table('kinerja_jurnal_author')
       ->join('kinerja_jurnal', 'kinerja_jurnal.id_jurnal', '=', 'kinerja_jurnal_author.id')
       ->join('dosen', 'dosen.nidn', '=', 'kinerja_jurnal_author.nidn')
        ->join('remun_point_terindex', 'kinerja_jurnal.id_terindek', '=', 'remun_point_terindex.id_terindek' ) 
       ->join('REF_UNIT', 'dosen.id_sub_unit', '=', 'REF_UNIT.ID' ) 
       ->join('REF_UNIT_FAKULTAS', 'dosen.id_unit', '=', 'REF_UNIT_FAKULTAS.ID_FAKULTAS')
       ->where('status_jurnal', '=', 'Menunggu')
       ->where('tahun', '=', 2017)
       ->get()->count();
       $tervalidasi17 = DB::table('kinerja_jurnal_author')
       ->join('kinerja_jurnal', 'kinerja_jurnal.id_jurnal', '=', 'kinerja_jurnal_author.id')
       ->join('dosen', 'dosen.nidn', '=', 'kinerja_jurnal_author.nidn')
        ->join('remun_point_terindex', 'kinerja_jurnal.id_terindek', '=', 'remun_point_terindex.id_terindek' ) 
       ->join('REF_UNIT', 'dosen.id_sub_unit', '=', 'REF_UNIT.ID' ) 
       ->join('REF_UNIT_FAKULTAS', 'dosen.id_unit', '=', 'REF_UNIT_FAKULTAS.ID_FAKULTAS')
       ->where('status_jurnal', '=', 'Tervalidasi')
       ->where('tahun', '=', 2017)
       ->get()->count();
       $perbaiki17 = DB::table('kinerja_jurnal_author')
       ->join('kinerja_jurnal', 'kinerja_jurnal.id_jurnal', '=', 'kinerja_jurnal_author.id')
       ->join('dosen', 'dosen.nidn', '=', 'kinerja_jurnal_author.nidn')
        ->join('remun_point_terindex', 'kinerja_jurnal.id_terindek', '=', 'remun_point_terindex.id_terindek' ) 
       ->join('REF_UNIT', 'dosen.id_sub_unit', '=', 'REF_UNIT.ID' ) 
       ->join('REF_UNIT_FAKULTAS', 'dosen.id_unit', '=', 'REF_UNIT_FAKULTAS.ID_FAKULTAS')
       ->where('status_jurnal', '=', 'Perbaiki')
       ->where('tahun', '=', 2017)
       ->get()->count();
       $terverifikasi17 = DB::table('kinerja_jurnal_author')
       ->join('kinerja_jurnal', 'kinerja_jurnal.id_jurnal', '=', 'kinerja_jurnal_author.id')
       ->join('dosen', 'dosen.nidn', '=', 'kinerja_jurnal_author.nidn')
        ->join('remun_point_terindex', 'kinerja_jurnal.id_terindek', '=', 'remun_point_terindex.id_terindek' ) 
       ->join('REF_UNIT', 'dosen.id_sub_unit', '=', 'REF_UNIT.ID' ) 
       ->join('REF_UNIT_FAKULTAS', 'dosen.id_unit', '=', 'REF_UNIT_FAKULTAS.ID_FAKULTAS')
       ->where('status_jurnal', '=', 'Terverifikasi')
       ->where('tahun', '=', 2017)
       ->get()->count();

       //2018
       $ditolak18 = DB::table('kinerja_jurnal_author')
       ->join('kinerja_jurnal', 'kinerja_jurnal.id_jurnal', '=', 'kinerja_jurnal_author.id')
       ->join('dosen', 'dosen.nidn', '=', 'kinerja_jurnal_author.nidn')
        ->join('remun_point_terindex', 'kinerja_jurnal.id_terindek', '=', 'remun_point_terindex.id_terindek' ) 
       ->join('REF_UNIT', 'dosen.id_sub_unit', '=', 'REF_UNIT.ID' ) 
       ->join('REF_UNIT_FAKULTAS', 'dosen.id_unit', '=', 'REF_UNIT_FAKULTAS.ID_FAKULTAS')
       ->where('status_jurnal', '=', 'Ditolak')
       ->where('tahun', '=', 2018)
       ->get()->count();
       $menunggu18 = DB::table('kinerja_jurnal_author')
       ->join('kinerja_jurnal', 'kinerja_jurnal.id_jurnal', '=', 'kinerja_jurnal_author.id')
       ->join('dosen', 'dosen.nidn', '=', 'kinerja_jurnal_author.nidn')
        ->join('remun_point_terindex', 'kinerja_jurnal.id_terindek', '=', 'remun_point_terindex.id_terindek' ) 
       ->join('REF_UNIT', 'dosen.id_sub_unit', '=', 'REF_UNIT.ID' ) 
       ->join('REF_UNIT_FAKULTAS', 'dosen.id_unit', '=', 'REF_UNIT_FAKULTAS.ID_FAKULTAS')
       ->where('status_jurnal', '=', 'Menunggu')
       ->where('tahun', '=', 2018)
       ->get()->count();
       $tervalidasi18 = DB::table('kinerja_jurnal_author')
       ->join('kinerja_jurnal', 'kinerja_jurnal.id_jurnal', '=', 'kinerja_jurnal_author.id')
       ->join('dosen', 'dosen.nidn', '=', 'kinerja_jurnal_author.nidn')
        ->join('remun_point_terindex', 'kinerja_jurnal.id_terindek', '=', 'remun_point_terindex.id_terindek' ) 
       ->join('REF_UNIT', 'dosen.id_sub_unit', '=', 'REF_UNIT.ID' ) 
       ->join('REF_UNIT_FAKULTAS', 'dosen.id_unit', '=', 'REF_UNIT_FAKULTAS.ID_FAKULTAS')
       ->where('status_jurnal', '=', 'Tervalidasi')
       ->where('tahun', '=', 2018)
       ->get()->count();
       $perbaiki18 = DB::table('kinerja_jurnal_author')
       ->join('kinerja_jurnal', 'kinerja_jurnal.id_jurnal', '=', 'kinerja_jurnal_author.id')
       ->join('dosen', 'dosen.nidn', '=', 'kinerja_jurnal_author.nidn')
        ->join('remun_point_terindex', 'kinerja_jurnal.id_terindek', '=', 'remun_point_terindex.id_terindek' ) 
       ->join('REF_UNIT', 'dosen.id_sub_unit', '=', 'REF_UNIT.ID' ) 
       ->join('REF_UNIT_FAKULTAS', 'dosen.id_unit', '=', 'REF_UNIT_FAKULTAS.ID_FAKULTAS')
       ->where('status_jurnal', '=', 'Perbaiki')
       ->where('tahun', '=', 2018)
       ->get()->count();
       $terverifikasi18 = DB::table('kinerja_jurnal_author')
       ->join('kinerja_jurnal', 'kinerja_jurnal.id_jurnal', '=', 'kinerja_jurnal_author.id')
       ->join('dosen', 'dosen.nidn', '=', 'kinerja_jurnal_author.nidn')
        ->join('remun_point_terindex', 'kinerja_jurnal.id_terindek', '=', 'remun_point_terindex.id_terindek' ) 
       ->join('REF_UNIT', 'dosen.id_sub_unit', '=', 'REF_UNIT.ID' ) 
       ->join('REF_UNIT_FAKULTAS', 'dosen.id_unit', '=', 'REF_UNIT_FAKULTAS.ID_FAKULTAS')
       ->where('status_jurnal', '=', 'Terverifikasi')
       ->where('tahun', '=', 2018)
       ->get()->count();

       //2019
       $ditolak19 = DB::table('kinerja_jurnal_author')
       ->join('kinerja_jurnal', 'kinerja_jurnal.id_jurnal', '=', 'kinerja_jurnal_author.id')
       ->join('dosen', 'dosen.nidn', '=', 'kinerja_jurnal_author.nidn')
        ->join('remun_point_terindex', 'kinerja_jurnal.id_terindek', '=', 'remun_point_terindex.id_terindek' ) 
       ->join('REF_UNIT', 'dosen.id_sub_unit', '=', 'REF_UNIT.ID' ) 
       ->join('REF_UNIT_FAKULTAS', 'dosen.id_unit', '=', 'REF_UNIT_FAKULTAS.ID_FAKULTAS')
       ->where('status_jurnal', '=', 'Ditolak')
       ->where('tahun', '=', 2019)
       ->get()->count();
       $menunggu19 = DB::table('kinerja_jurnal_author')
       ->join('kinerja_jurnal', 'kinerja_jurnal.id_jurnal', '=', 'kinerja_jurnal_author.id')
       ->join('dosen', 'dosen.nidn', '=', 'kinerja_jurnal_author.nidn')
        ->join('remun_point_terindex', 'kinerja_jurnal.id_terindek', '=', 'remun_point_terindex.id_terindek' ) 
       ->join('REF_UNIT', 'dosen.id_sub_unit', '=', 'REF_UNIT.ID' ) 
       ->join('REF_UNIT_FAKULTAS', 'dosen.id_unit', '=', 'REF_UNIT_FAKULTAS.ID_FAKULTAS')
       ->where('status_jurnal', '=', 'Menunggu')
       ->where('tahun', '=', 2019)
       ->get()->count();
       $tervalidasi19 = DB::table('kinerja_jurnal_author')
       ->join('kinerja_jurnal', 'kinerja_jurnal.id_jurnal', '=', 'kinerja_jurnal_author.id')
       ->join('dosen', 'dosen.nidn', '=', 'kinerja_jurnal_author.nidn')
        ->join('remun_point_terindex', 'kinerja_jurnal.id_terindek', '=', 'remun_point_terindex.id_terindek' ) 
       ->join('REF_UNIT', 'dosen.id_sub_unit', '=', 'REF_UNIT.ID' ) 
       ->join('REF_UNIT_FAKULTAS', 'dosen.id_unit', '=', 'REF_UNIT_FAKULTAS.ID_FAKULTAS')
       ->where('status_jurnal', '=', 'Tervalidasi')
       ->where('tahun', '=', 2019)
       ->get()->count();
       $perbaiki19 = DB::table('kinerja_jurnal_author')
       ->join('kinerja_jurnal', 'kinerja_jurnal.id_jurnal', '=', 'kinerja_jurnal_author.id')
       ->join('dosen', 'dosen.nidn', '=', 'kinerja_jurnal_author.nidn')
        ->join('remun_point_terindex', 'kinerja_jurnal.id_terindek', '=', 'remun_point_terindex.id_terindek' ) 
       ->join('REF_UNIT', 'dosen.id_sub_unit', '=', 'REF_UNIT.ID' ) 
       ->join('REF_UNIT_FAKULTAS', 'dosen.id_unit', '=', 'REF_UNIT_FAKULTAS.ID_FAKULTAS')
       ->where('status_jurnal', '=', 'Perbaiki')
       ->where('tahun', '=', 2019)
       ->get()->count();
       $terverifikasi19 = DB::table('kinerja_jurnal_author')
       ->join('kinerja_jurnal', 'kinerja_jurnal.id_jurnal', '=', 'kinerja_jurnal_author.id')
       ->join('dosen', 'dosen.nidn', '=', 'kinerja_jurnal_author.nidn')
        ->join('remun_point_terindex', 'kinerja_jurnal.id_terindek', '=', 'remun_point_terindex.id_terindek' ) 
       ->join('REF_UNIT', 'dosen.id_sub_unit', '=', 'REF_UNIT.ID' ) 
       ->join('REF_UNIT_FAKULTAS', 'dosen.id_unit', '=', 'REF_UNIT_FAKULTAS.ID_FAKULTAS')
       ->where('status_jurnal', '=', 'Terverifikasi')
       ->where('tahun', '=', 2019)
       ->get()->count();

       //2020
       $ditolak20 = DB::table('kinerja_jurnal_author')
       ->join('kinerja_jurnal', 'kinerja_jurnal.id_jurnal', '=', 'kinerja_jurnal_author.id')
       ->join('dosen', 'dosen.nidn', '=', 'kinerja_jurnal_author.nidn')
        ->join('remun_point_terindex', 'kinerja_jurnal.id_terindek', '=', 'remun_point_terindex.id_terindek' ) 
       ->join('REF_UNIT', 'dosen.id_sub_unit', '=', 'REF_UNIT.ID' ) 
       ->join('REF_UNIT_FAKULTAS', 'dosen.id_unit', '=', 'REF_UNIT_FAKULTAS.ID_FAKULTAS')
       ->where('status_jurnal', '=', 'Ditolak')
       ->where('tahun', '=', 2020)
       ->get()->count();
       $menunggu20 = DB::table('kinerja_jurnal_author')
       ->join('kinerja_jurnal', 'kinerja_jurnal.id_jurnal', '=', 'kinerja_jurnal_author.id')
       ->join('dosen', 'dosen.nidn', '=', 'kinerja_jurnal_author.nidn')
        ->join('remun_point_terindex', 'kinerja_jurnal.id_terindek', '=', 'remun_point_terindex.id_terindek' ) 
       ->join('REF_UNIT', 'dosen.id_sub_unit', '=', 'REF_UNIT.ID' ) 
       ->join('REF_UNIT_FAKULTAS', 'dosen.id_unit', '=', 'REF_UNIT_FAKULTAS.ID_FAKULTAS')
       ->where('status_jurnal', '=', 'Menunggu')
       ->where('tahun', '=', 2020)
       ->get()->count();
       $tervalidasi20 = DB::table('kinerja_jurnal_author')
       ->join('kinerja_jurnal', 'kinerja_jurnal.id_jurnal', '=', 'kinerja_jurnal_author.id')
       ->join('dosen', 'dosen.nidn', '=', 'kinerja_jurnal_author.nidn')
        ->join('remun_point_terindex', 'kinerja_jurnal.id_terindek', '=', 'remun_point_terindex.id_terindek' ) 
       ->join('REF_UNIT', 'dosen.id_sub_unit', '=', 'REF_UNIT.ID' ) 
       ->join('REF_UNIT_FAKULTAS', 'dosen.id_unit', '=', 'REF_UNIT_FAKULTAS.ID_FAKULTAS')
       ->where('status_jurnal', '=', 'Tervalidasi')
       ->where('tahun', '=', 2020)
       ->get()->count();
       $perbaiki20 = DB::table('kinerja_jurnal_author')
       ->join('kinerja_jurnal', 'kinerja_jurnal.id_jurnal', '=', 'kinerja_jurnal_author.id')
       ->join('dosen', 'dosen.nidn', '=', 'kinerja_jurnal_author.nidn')
        ->join('remun_point_terindex', 'kinerja_jurnal.id_terindek', '=', 'remun_point_terindex.id_terindek' ) 
       ->join('REF_UNIT', 'dosen.id_sub_unit', '=', 'REF_UNIT.ID' ) 
       ->join('REF_UNIT_FAKULTAS', 'dosen.id_unit', '=', 'REF_UNIT_FAKULTAS.ID_FAKULTAS')
       ->where('status_jurnal', '=', 'Perbaiki')
       ->where('tahun', '=', 2020)
       ->get()->count();
       $terverifikasi20 = DB::table('kinerja_jurnal_author')
       ->join('kinerja_jurnal', 'kinerja_jurnal.id_jurnal', '=', 'kinerja_jurnal_author.id')
       ->join('dosen', 'dosen.nidn', '=', 'kinerja_jurnal_author.nidn')
        ->join('remun_point_terindex', 'kinerja_jurnal.id_terindek', '=', 'remun_point_terindex.id_terindek' ) 
       ->join('REF_UNIT', 'dosen.id_sub_unit', '=', 'REF_UNIT.ID' ) 
       ->join('REF_UNIT_FAKULTAS', 'dosen.id_unit', '=', 'REF_UNIT_FAKULTAS.ID_FAKULTAS')
       ->where('status_jurnal', '=', 'Terverifikasi')
       ->where('tahun', '=', 2020)
       ->get()->count();

       //2021
       $ditolak21 = DB::table('kinerja_jurnal_author')
       ->join('kinerja_jurnal', 'kinerja_jurnal.id_jurnal', '=', 'kinerja_jurnal_author.id')
       ->join('dosen', 'dosen.nidn', '=', 'kinerja_jurnal_author.nidn')
        ->join('remun_point_terindex', 'kinerja_jurnal.id_terindek', '=', 'remun_point_terindex.id_terindek' ) 
       ->join('REF_UNIT', 'dosen.id_sub_unit', '=', 'REF_UNIT.ID' ) 
       ->join('REF_UNIT_FAKULTAS', 'dosen.id_unit', '=', 'REF_UNIT_FAKULTAS.ID_FAKULTAS')
       ->where('status_jurnal', '=', 'Ditolak')
       ->where('tahun', '=', 2021)
       ->get()->count();
       $menunggu21 = DB::table('kinerja_jurnal_author')
       ->join('kinerja_jurnal', 'kinerja_jurnal.id_jurnal', '=', 'kinerja_jurnal_author.id')
       ->join('dosen', 'dosen.nidn', '=', 'kinerja_jurnal_author.nidn')
        ->join('remun_point_terindex', 'kinerja_jurnal.id_terindek', '=', 'remun_point_terindex.id_terindek' ) 
       ->join('REF_UNIT', 'dosen.id_sub_unit', '=', 'REF_UNIT.ID' ) 
       ->join('REF_UNIT_FAKULTAS', 'dosen.id_unit', '=', 'REF_UNIT_FAKULTAS.ID_FAKULTAS')
       ->where('status_jurnal', '=', 'Menunggu')
       ->where('tahun', '=', 2021)
       ->get()->count();
       $tervalidasi21 = DB::table('kinerja_jurnal_author')
       ->join('kinerja_jurnal', 'kinerja_jurnal.id_jurnal', '=', 'kinerja_jurnal_author.id')
       ->join('dosen', 'dosen.nidn', '=', 'kinerja_jurnal_author.nidn')
        ->join('remun_point_terindex', 'kinerja_jurnal.id_terindek', '=', 'remun_point_terindex.id_terindek' ) 
       ->join('REF_UNIT', 'dosen.id_sub_unit', '=', 'REF_UNIT.ID' ) 
       ->join('REF_UNIT_FAKULTAS', 'dosen.id_unit', '=', 'REF_UNIT_FAKULTAS.ID_FAKULTAS')
       ->where('status_jurnal', '=', 'Tervalidasi')
       ->where('tahun', '=', 2021)
       ->get()->count();
       $perbaiki21 = DB::table('kinerja_jurnal_author')
       ->join('kinerja_jurnal', 'kinerja_jurnal.id_jurnal', '=', 'kinerja_jurnal_author.id')
       ->join('dosen', 'dosen.nidn', '=', 'kinerja_jurnal_author.nidn')
        ->join('remun_point_terindex', 'kinerja_jurnal.id_terindek', '=', 'remun_point_terindex.id_terindek' ) 
       ->join('REF_UNIT', 'dosen.id_sub_unit', '=', 'REF_UNIT.ID' ) 
       ->join('REF_UNIT_FAKULTAS', 'dosen.id_unit', '=', 'REF_UNIT_FAKULTAS.ID_FAKULTAS')
       ->where('status_jurnal', '=', 'Perbaiki')
       ->where('tahun', '=', 2021)
       ->get()->count();
       $terverifikasi21 = DB::table('kinerja_jurnal_author')
       ->join('kinerja_jurnal', 'kinerja_jurnal.id_jurnal', '=', 'kinerja_jurnal_author.id')
       ->join('dosen', 'dosen.nidn', '=', 'kinerja_jurnal_author.nidn')
        ->join('remun_point_terindex', 'kinerja_jurnal.id_terindek', '=', 'remun_point_terindex.id_terindek' ) 
       ->join('REF_UNIT', 'dosen.id_sub_unit', '=', 'REF_UNIT.ID' ) 
       ->join('REF_UNIT_FAKULTAS', 'dosen.id_unit', '=', 'REF_UNIT_FAKULTAS.ID_FAKULTAS')
       ->where('status_jurnal', '=', 'Terverifikasi')
       ->where('tahun', '=', 2021)
       ->get()->count();
        
        
        return view('kinerja_jurnal.index', compact( 'data', 'keyword','categoriesval', 'dataval', 'categoriescat', 'datacat', 'tahunpen',
        'categoriesslide1', 'dataslide1','categoriesslide2', 'dataslide2','categoriesslide3', 'dataslide3','categoriesslide4', 'dataslide4',
        'ditolak17', 'menunggu17', 'tervalidasi17', 'perbaiki17', 'terverifikasi17',
        'ditolak18', 'menunggu18', 'tervalidasi18', 'perbaiki18', 'terverifikasi18',
        'ditolak19', 'menunggu19', 'tervalidasi19', 'perbaiki19', 'terverifikasi19',
        'ditolak20', 'menunggu20', 'tervalidasi20', 'perbaiki20', 'terverifikasi20',
        'ditolak21', 'menunggu21', 'tervalidasi21', 'perbaiki21', 'terverifikasi21',
        'categoriesslide5', 'dataslide5','categoriesslide6', 'dataslide6','categoriesslide7', 'dataslide7', 'categoriesslide8', 'dataslide8',
        'categoriesslide9', 'dataslide9','categoriesslide10', 'dataslide10','categoriesslide11', 'dataslide11', 'categoriesslide12', 'dataslide12',
        'categoriesslide13', 'dataslide13','categoriesslide14', 'dataslide14','categoriesslide15', 'dataslide15', 'categoriesslide16', 'dataslide16',
        'categoriesslide17', 'dataslide17',
        
       ))->with('i', ($request->input('page', 1) - 1) * $pagination);

    }
    public function jurnal_ex()
 {
     return Excel::download(new JurnalExport, 'Kinerja_Jurnal.xlsx');
 }

}
