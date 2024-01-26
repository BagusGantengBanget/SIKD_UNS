<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\data_penelitian;
use DB;
use Illuminate\Support\Facades\Validator;

class penelitianController extends Controller

{
    public function index()
    {
        $seminar = data_penelitian::first()
        ->join('penelitian', 'trx_penelitian.id_penelitian', '=', 'penelitian.id_penelitian')
        ->join('dosen', 'trx_penelitian.nidn', '=', 'dosen.nidn') //status pegawai
        ->join('REF_UNIT_FAKULTAS', 'dosen.id_unit', '=', 'REF_UNIT_FAKULTAS.ID_FAKULTAS') //fakultas
        ->join('REF_UNIT', 'dosen.id_sub_unit', '=', 'REF_UNIT.ID' ) //jurusan
        ->join('status_usulan', 'trx_penelitian.status', '=', 'status_usulan.status' ) //jurusan
        ->join('bidang_ilmu', 'trx_penelitian.id_bidangilmu', '=', 'bidang_ilmu.id_bidangilmu' ) //jurusan
        ->join('bidang_kajian', 'trx_penelitian.id_kajian', '=', 'bidang_kajian.id_kajian' ) //jurusan
        ->join('anggota_penelitian', 'trx_penelitian.id_transaksi', '=', 'anggota_penelitian.id_transaksi' )
        ->select('penelitian.id_penelitian', 'trx_penelitian.id_transaksi', 'dosen.nama', 
        'REF_UNIT_FAKULTAS.FAKULTAS','REF_UNIT.NAMA', 'trx_penelitian.judul_penelitian','penelitian.nama_penelitian', 'penelitian.jenis', 'trx_penelitian.tahun_penelitian',   
        'trx_penelitian.biaya_setuju',   'bidang_ilmu.nama_bidangilmu', 'bidang_kajian.nama_kajian')
        ->get();
        return response([
            'success' => true,
            'message' => 'Data Penelitian',
            'data' => $seminar
        ], 200);
    }
    

    public function show($fakultas)
    {
        $post = data_penelitian::wherefakultas($fakultas)
        ->join('penelitian', 'trx_penelitian.id_penelitian', '=', 'penelitian.id_penelitian')
        ->join('dosen', 'trx_penelitian.nidn', '=', 'dosen.nidn') //status pegawai
        ->join('REF_UNIT_FAKULTAS', 'dosen.id_unit', '=', 'REF_UNIT_FAKULTAS.ID_FAKULTAS') //fakultas
        ->join('REF_UNIT', 'dosen.id_sub_unit', '=', 'REF_UNIT.ID' ) //jurusan
        ->join('status_usulan', 'trx_penelitian.status', '=', 'status_usulan.status' ) //jurusan
        ->join('bidang_ilmu', 'trx_penelitian.id_bidangilmu', '=', 'bidang_ilmu.id_bidangilmu' ) //jurusan
        ->join('bidang_kajian', 'trx_penelitian.id_kajian', '=', 'bidang_kajian.id_kajian' ) //jurusan
        ->join('anggota_penelitian', 'trx_penelitian.id_transaksi', '=', 'anggota_penelitian.id_transaksi' )
        ->select('penelitian.id_penelitian', 'trx_penelitian.id_transaksi', 'dosen.nama', 
        'REF_UNIT_FAKULTAS.FAKULTAS','REF_UNIT.NAMA', 'trx_penelitian.judul_penelitian','penelitian.nama_penelitian', 'penelitian.jenis', 'trx_penelitian.tahun_penelitian',   
        'trx_penelitian.biaya_setuju',   'bidang_ilmu.nama_bidangilmu', 'bidang_kajian.nama_kajian')
        ->get();


        if ($post) {
            return response()->json([
                'success' => true,
                'fakultas' => $fakultas,
                'data'    => $post
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Post Tidak Ditemukan!',
                'data'    => ''
            ], 401);
        }
    }
    public function showprodi($fakultas, $NAMA)
    {
        $post = DB::table('trx_penelitian')
        ->join('penelitian', 'trx_penelitian.id_penelitian', '=', 'penelitian.id_penelitian')
        ->join('dosen', 'trx_penelitian.nidn', '=', 'dosen.nidn') //status pegawai
        ->join('REF_UNIT_FAKULTAS', 'dosen.id_unit', '=', 'REF_UNIT_FAKULTAS.ID_FAKULTAS') //fakultas
        ->join('REF_UNIT', 'dosen.id_sub_unit', '=', 'REF_UNIT.ID' ) //jurusan
        ->join('status_usulan', 'trx_penelitian.status', '=', 'status_usulan.status' ) //jurusan
        ->join('bidang_ilmu', 'trx_penelitian.id_bidangilmu', '=', 'bidang_ilmu.id_bidangilmu' ) //jurusan
        ->join('bidang_kajian', 'trx_penelitian.id_kajian', '=', 'bidang_kajian.id_kajian' ) //jurusan
        ->join('anggota_penelitian', 'trx_penelitian.id_transaksi', '=', 'anggota_penelitian.id_transaksi' )
        ->where('REF_UNIT_FAKULTAS.FAKULTAS',$fakultas)
        ->where('REF_UNIT.NAMA',$NAMA)
        ->select('penelitian.id_penelitian', 'trx_penelitian.id_transaksi', 'dosen.nama', 
        'REF_UNIT_FAKULTAS.FAKULTAS','REF_UNIT.NAMA', 'trx_penelitian.judul_penelitian','penelitian.nama_penelitian', 'penelitian.jenis', 'trx_penelitian.tahun_penelitian',   
        'trx_penelitian.biaya_setuju',   'bidang_ilmu.nama_bidangilmu', 'bidang_kajian.nama_kajian')
        ->get();
        
       

        if ($post) {
            return response()->json([
                'success' => true,
                'Fakultas' => $fakultas, 
                'seminar Studi'=> $NAMA,
                'data'    => $post
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Post Tidak Ditemukan!',
                'data'    => ''
            ], 401);
        }
    }

}
