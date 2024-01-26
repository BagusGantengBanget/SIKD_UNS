<?php
namespace App\Http\Controllers;

use Illuminate\Database\Query\Builder;
use Illuminate\Http\Request;
use App\Http\Requests;
use DB;
use App\Data_Kunjungan;
/* use App\Exports\BukuExport; */
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;
use Illuminate\Pagination\Paginator;
/* use Illuminate\Support\Collection; */
use Illuminate\Pagination\LengthAwarePaginator;

class Data_KunjunganController extends Controller
{

    public function index(Request $request)
    {
       
        $books= Data_Kunjungan::all();
        $data = DB::table('kunjungan')->get();
        $pagination = 20;
        /* 
        $keyword = $request->keyword; */
        /* ->join('penelitian', 'trx_penelitian.id_penelitian', '=', 'penelitian.id_penelitian')
        ->join('dosen', 'trx_penelitian.nidn', '=', 'dosen.nidn') //status pegawai
        ->join('REF_UNIT_FAKULTAS', 'dosen.id_unit', '=', 'REF_UNIT_FAKULTAS.ID_FAKULTAS') //fakultas
        ->join('REF_UNIT', 'dosen.id_sub_unit', '=', 'REF_UNIT.ID' ) //jurusan
        ->join('bidang_ilmu', 'trx_penelitian.id_bidangilmu', '=', 'bidang_ilmu.id_bidangilmu' ) //jurusan
        ->join('bidang_kajian', 'trx_penelitian.id_bidangilmu', '=', 'bidang_kajian.id_kajian' ) //jurusan
        ->paginate(1000);
        $data->appends($request->all());
        ->join('anggota_penelitian', 'trx_penelitian.id_transaksi', '=', 'anggota_penelitian.id_transaksi' ) */

        

        return view('data_kunjungan.index'  ,compact('books' , 'data', /* 'keyword' , */
        ))->with('i', ($request->input('page', 1) - 1) * $pagination);
    }

    

}
    

