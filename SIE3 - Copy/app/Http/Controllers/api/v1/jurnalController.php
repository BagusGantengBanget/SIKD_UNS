<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Kinerja_jurnal;
use DB;
use Illuminate\Support\Facades\Validator;

class jurnalController extends Controller

{
    public function index()
    {
        $jurnal = Kinerja_jurnal::first()
        ->join('kinerja_jurnal', 'kinerja_jurnal.id_jurnal', '=', 'kinerja_jurnal_author.id')
        ->join('remun_point_terindex', 'kinerja_jurnal.id_terindek', '=', 'remun_point_terindex.id_terindek' ) 
        ->join('dosen', 'dosen.nidn', '=', 'kinerja_jurnal_author.nidn')
        ->join('REF_UNIT_FAKULTAS', 'dosen.id_unit', '=', 'REF_UNIT_FAKULTAS.ID_FAKULTAS')
        ->join('REF_UNIT', 'dosen.id_sub_unit', '=', 'REF_UNIT.ID')
        ->select('kinerja_jurnal.id_jurnal', 'dosen.nip_dosen', 'dosen.nama', 
        'REF_UNIT_FAKULTAS.FAKULTAS','REF_UNIT.NAMA', 'kinerja_jurnal.judulp','kinerja_jurnal.nama_jurnal', 'kinerja_jurnal.tahun', 'kinerja_jurnal.volume','kinerja_jurnal.status_jurnal',)
        ->get();
        return response([
            'success' => true,
            'message' => 'Data jurnal',
            'data' => $jurnal
        ], 200);
    }

    public function show($fakultas)
    {
        $post = kinerja_jurnal::wherefakultas($fakultas)
        ->join('kinerja_jurnal', 'kinerja_jurnal.id_jurnal', '=', 'kinerja_jurnal_author.id')
        ->join('remun_point_terindex', 'kinerja_jurnal.id_terindek', '=', 'remun_point_terindex.id_terindek' ) 
        ->join('dosen', 'dosen.nidn', '=', 'kinerja_jurnal_author.nidn')
        ->join('REF_UNIT_FAKULTAS', 'dosen.id_unit', '=', 'REF_UNIT_FAKULTAS.ID_FAKULTAS')
        ->join('REF_UNIT', 'dosen.id_sub_unit', '=', 'REF_UNIT.ID')
        ->select('kinerja_jurnal.id_jurnal', 'dosen.nip_dosen', 'dosen.nama', 
        'REF_UNIT_FAKULTAS.FAKULTAS','REF_UNIT.NAMA', 'kinerja_jurnal.judulp','kinerja_jurnal.nama_jurnal', 'kinerja_jurnal.tahun', 'kinerja_jurnal.volume','kinerja_jurnal.status_jurnal',)
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
        $post = DB::table('kinerja_jurnal_author')
        ->join('kinerja_jurnal', 'kinerja_jurnal.id_jurnal', '=', 'kinerja_jurnal_author.id')
        ->join('remun_point_terindex', 'kinerja_jurnal.id_terindek', '=', 'remun_point_terindex.id_terindek' ) 
        ->join('dosen', 'dosen.nidn', '=', 'kinerja_jurnal_author.nidn')
        ->join('REF_UNIT_FAKULTAS', 'dosen.id_unit', '=', 'REF_UNIT_FAKULTAS.ID_FAKULTAS')
        ->join('REF_UNIT', 'dosen.id_sub_unit', '=', 'REF_UNIT.ID')
        ->where('REF_UNIT_FAKULTAS.FAKULTAS',$fakultas)
        ->where('REF_UNIT.NAMA',$NAMA)
        ->select('kinerja_jurnal.id_jurnal', 'dosen.nip_dosen', 'dosen.nama', 
        'REF_UNIT_FAKULTAS.FAKULTAS','REF_UNIT.NAMA', 'kinerja_jurnal.judulp','kinerja_jurnal.nama_jurnal', 'kinerja_jurnal.tahun', 'kinerja_jurnal.volume','kinerja_jurnal.status_jurnal',)
        ->get();

        if ($post) {
            return response()->json([
                'success' => true,
                'Fakultas' => $fakultas, 
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
