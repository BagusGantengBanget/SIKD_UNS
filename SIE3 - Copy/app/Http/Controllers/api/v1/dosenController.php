<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\data_dosen;
use DB;
use Illuminate\Support\Facades\Validator;

class dosenController extends Controller

{
    public function index()
    {
        $dosen = data_dosen::first()
        ->join('REF_JABATAN_FUNGSIONAL', 'dosen.id_jabatan_fungsional', '=', 'REF_JABATAN_FUNGSIONAL.ID_JABATAN_FUNGSIONAL') //jabatan_fungsional
        ->join('REF_STATUS_PEGAWAI', 'dosen.id_status_pegawai', '=', 'REF_STATUS_PEGAWAI.ID_STATUS_PEGAWAI') //status pegawai
        ->join('REF_UNIT_FAKULTAS', 'dosen.id_unit', '=', 'REF_UNIT_FAKULTAS.ID_FAKULTAS') //FAKULTAS
        ->join('REF_UNIT', 'dosen.id_sub_unit', '=', 'REF_UNIT.ID' ) //jurusan
        ->where('dosen.id_status_henti', '=', 1)
        ->where('dosen.id_jenis_staf', '=', 1)
        ->orderBy('dosen.nama',)
        ->select( 'dosen.id_dosen', 'dosen.nip_dosen', 'dosen.nidn', 'dosen.nama', 'dosen.tempat_lahir', 'dosen.tanggal_lahir', 
        'REF_UNIT_FAKULTAS.FAKULTAS','REF_UNIT.NAMA', 'dosen.telp', 'dosen.email', )
        ->get();
        return response([
            'success' => true,
            'message' => 'Data Dosen UNS',
            'data' => $dosen
        ], 200);
    }

    public function show($FAKULTAS)
    {
        $post = data_dosen::whereFakultas($FAKULTAS)
        ->join('REF_JABATAN_FUNGSIONAL', 'dosen.id_jabatan_fungsional', '=', 'REF_JABATAN_FUNGSIONAL.ID_JABATAN_FUNGSIONAL') //jabatan_fungsional
        ->join('REF_STATUS_PEGAWAI', 'dosen.id_status_pegawai', '=', 'REF_STATUS_PEGAWAI.ID_STATUS_PEGAWAI') //status pegawai
        ->join('REF_UNIT_FAKULTAS', 'dosen.id_unit', '=', 'REF_UNIT_FAKULTAS.ID_FAKULTAS') //FAKULTAS
        ->join('REF_UNIT', 'dosen.id_sub_unit', '=', 'REF_UNIT.ID' ) //jurusan
        ->where('dosen.id_status_henti', '=', 1)
        ->where('dosen.id_jenis_staf', '=', 1)
        ->orderBy('dosen.nama',)
        ->select( 'dosen.id_dosen', 'dosen.nip_dosen', 'dosen.nidn', 'dosen.nama', 'dosen.tempat_lahir', 'dosen.tanggal_lahir', 
        'REF_UNIT_FAKULTAS.FAKULTAS','REF_UNIT.NAMA', 'dosen.telp', 'dosen.email', )
        ->get();


        if ($post) {
            return response()->json([
                'success' => true,
                'FAKULTAS' => $FAKULTAS,
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
    public function showprodi($FAKULTAS, $NAMA)
    {
        $post = DB::table('dosen')
        ->join('REF_JABATAN_FUNGSIONAL', 'dosen.id_jabatan_fungsional', '=', 'REF_JABATAN_FUNGSIONAL.ID_JABATAN_FUNGSIONAL') //jabatan_fungsional
        ->join('REF_STATUS_PEGAWAI', 'dosen.id_status_pegawai', '=', 'REF_STATUS_PEGAWAI.ID_STATUS_PEGAWAI') //status pegawai
        ->join('REF_UNIT_FAKULTAS', 'dosen.id_unit', '=', 'REF_UNIT_FAKULTAS.ID_FAKULTAS') //FAKULTAS
        ->join('REF_UNIT', 'dosen.id_sub_unit', '=', 'REF_UNIT.ID' ) //jurusan
        ->where('dosen.id_status_henti', '=', 1)
        ->where('dosen.id_jenis_staf', '=', 1)
        ->where('REF_UNIT_FAKULTAS.FAKULTAS',$FAKULTAS)
        ->where('REF_UNIT.nama',$NAMA)
        ->orderBy('dosen.nama',)
        ->select( 'dosen.id_dosen', 'dosen.nip_dosen', 'dosen.nidn', 'dosen.nama', 'dosen.tempat_lahir', 'dosen.tanggal_lahir', 
        'REF_UNIT_FAKULTAS.FAKULTAS','REF_UNIT.NAMA', 'dosen.telp', 'dosen.email', )
        ->get();

        if ($post) {
            return response()->json([
                'success' => true,
                'FAKULTAS' => $FAKULTAS, 
                'Program Studi'=> $NAMA,
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
