<?php

namespace App\Http\Controllers\Fakultas_penelitian;

use Illuminate\Database\Query\Builder;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Kinerja_penelitian;
use DB;
use App\Exports\penelitianExport;
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
        $data = DB::table('trx_penelitian')
        ->join('penelitian', 'trx_penelitian.id_penelitian', '=', 'penelitian.id_penelitian')
        ->join('dosen', 'trx_penelitian.nidn', '=', 'dosen.nidn') //status pegawai
        ->join('REF_UNIT_FAKULTAS', 'dosen.id_unit', '=', 'REF_UNIT_FAKULTAS.ID_FAKULTAS') //fakultas
        ->join('REF_UNIT', 'dosen.id_sub_unit', '=', 'REF_UNIT.ID' ) //jurusan
        ->join('status_usulan', 'trx_penelitian.status', '=', 'status_usulan.status' ) //jurusan
        ->join('bidang_ilmu', 'trx_penelitian.id_bidangilmu', '=', 'bidang_ilmu.id_bidangilmu' ) //jurusan
        ->join('bidang_kajian', 'trx_penelitian.id_kajian', '=', 'bidang_kajian.id_kajian' ) //jurusan
        ->join('anggota_penelitian', 'trx_penelitian.id_transaksi', '=', 'anggota_penelitian.id_transaksi' )
        ->where('REF_UNIT_FAKULTAS.FAKULTAS', '=', 'FMIPA')
        ->where('penelitian.tahun','like','%'.$keyword.'%')
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
        $statuspen = DB::table('trx_penelitian')
        ->join('penelitian', 'trx_penelitian.id_penelitian', '=', 'penelitian.id_penelitian')
        ->join('dosen', 'trx_penelitian.nidn', '=', 'dosen.nidn') //status pegawai
        ->join('REF_UNIT_FAKULTAS', 'dosen.id_unit', '=', 'REF_UNIT_FAKULTAS.ID_FAKULTAS')
        ->join('status_usulan', 'trx_penelitian.status', '=', 'status_usulan.status' )
        ->join('anggota_penelitian', 'trx_penelitian.id_transaksi', '=', 'anggota_penelitian.id_transaksi' )
        ->where('REF_UNIT_FAKULTAS.FAKULTAS', '=', 'FMIPA')
        ->where('penelitian.tahun','like','%'.$keyword.'%')
        ->groupBy('status_usulan.nama_status',)
        ->select('status_usulan.nama_status',  \DB::raw('count(*) as totalstts'))
        ->get();

        $categoriesval = [];
        $dataval=[];
        foreach($statuspen as $dt){
            $categoriesval[] = $dt->nama_status;
            $dataval[] = $dt->totalstts;
        }

        $fakpen = DB::table('trx_penelitian')
        ->join('penelitian', 'trx_penelitian.id_penelitian', '=', 'penelitian.id_penelitian')
        ->join('dosen', 'dosen.nidn', '=', 'trx_penelitian.nidn')
        ->join('REF_UNIT_FAKULTAS', 'dosen.id_unit', '=', 'REF_UNIT_FAKULTAS.ID_FAKULTAS')
        ->join('REF_UNIT', 'dosen.id_sub_unit', '=', 'REF_UNIT.ID' ) 
        ->join('anggota_penelitian', 'trx_penelitian.id_transaksi', '=', 'anggota_penelitian.id_transaksi' )
        ->where('REF_UNIT_FAKULTAS.FAKULTAS', '=', 'FMIPA')
        ->where('penelitian.tahun','like','%'.$keyword.'%')
        ->groupBy('REF_UNIT.NAMA')
        ->select('REF_UNIT.NAMA',  \DB::raw('count(*) as totalfak'))
        ->get();

        $categoriesfak = [];
        $datafak=[];
        foreach($fakpen as $dt){
            $categoriesfak[] = $dt->NAMA;
            $datafak[] = $dt->totalfak;
        }

        $bidangilmu = DB::table('trx_penelitian')
        ->join('penelitian', 'trx_penelitian.id_penelitian', '=', 'penelitian.id_penelitian')
        ->join('dosen', 'trx_penelitian.nidn', '=', 'dosen.nidn') //status pegawai
        ->join('REF_UNIT_FAKULTAS', 'dosen.id_unit', '=', 'REF_UNIT_FAKULTAS.ID_FAKULTAS')
        ->join('bidang_ilmu', 'trx_penelitian.id_bidangilmu', '=', 'bidang_ilmu.id_bidangilmu')
        ->join('anggota_penelitian', 'trx_penelitian.id_transaksi', '=', 'anggota_penelitian.id_transaksi' )
        ->where('REF_UNIT_FAKULTAS.FAKULTAS', '=', 'FMIPA')
        ->where('penelitian.tahun','like','%'.$keyword.'%')
        ->groupBy('bidang_ilmu.nama_bidangilmu')
        ->select('bidang_ilmu.nama_bidangilmu',  \DB::raw('count(*) as totalilmu'))
        ->get();

        $categoriesilmu = [];
        $datailmu=[];
        foreach($bidangilmu as $dt){
            $categoriesilmu[] = $dt->nama_bidangilmu;
            $datailmu[] = $dt->totalilmu;
        }

        $bidangkajian = DB::table('trx_penelitian')
        ->join('penelitian', 'trx_penelitian.id_penelitian', '=', 'penelitian.id_penelitian')
        ->join('dosen', 'trx_penelitian.nidn', '=', 'dosen.nidn') //status pegawai
        ->join('REF_UNIT_FAKULTAS', 'dosen.id_unit', '=', 'REF_UNIT_FAKULTAS.ID_FAKULTAS')
        ->join('bidang_kajian', 'trx_penelitian.id_kajian', '=', 'bidang_kajian.id_kajian')
        ->join('anggota_penelitian', 'trx_penelitian.id_transaksi', '=', 'anggota_penelitian.id_transaksi' )
        ->where('REF_UNIT_FAKULTAS.FAKULTAS', '=', 'FMIPA')
        ->where('penelitian.tahun','like','%'.$keyword.'%')
        ->groupBy('bidang_kajian.nama_kajian')
        ->select('bidang_kajian.nama_kajian',  \DB::raw('count(*) as totalkajian'))
        ->get();

        $categorieskajian = [];
        $datakajian=[];
        foreach($bidangkajian as $dt){
            $categorieskajian[] = $dt->nama_kajian;
            $datakajian[] = $dt->totalkajian;
        }

        return view('fakultas_penelitian_FMIPA.index'  ,compact( 'data', 'keyword','categoriesval', 'dataval', 'categoriesfak', 'datafak','tahunpen',
        'categoriesilmu', 'datailmu','categorieskajian', 'datakajian',))->with('i', ($request->input('page', 1) - 1) * $pagination);
       
    }
    
    /* public function penelitian_ex()
	{
		return Excel::download(new penelitianExport, 'Kinerja_penelitian.xlsx');
	} */

}
