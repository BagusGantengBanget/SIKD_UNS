<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Kinerja_pembicara;
use DB;
use Illuminate\Support\Facades\Validator;

class pembicaraController extends Controller

{
    public function index()
    {
        $pembicara = Kinerja_pembicara::first()
        ->join('remun_point_terindex', 'kinerja_pembicara.id_terindek', '=', 'remun_point_terindex.id_terindek' ) 
        ->join('dosen', 'dosen.nidn', '=', 'kinerja_pembicara.nidn')
        ->join('REF_UNIT_FAKULTAS', 'dosen.id_unit', '=', 'REF_UNIT_FAKULTAS.ID_FAKULTAS')
        ->join('REF_UNIT', 'dosen.id_sub_unit', '=', 'REF_UNIT.ID')
        ->select('kinerja_pembicara.id_pembicara', 'dosen.nip_dosen', 'dosen.nama', 
        'REF_UNIT_FAKULTAS.FAKULTAS','REF_UNIT.NAMA', 'kinerja_pembicara.judul_materi','kinerja_pembicara.nama_penyelenggara', 
        'kinerja_pembicara.nama_kegiatan',  'kinerja_pembicara.tahun',  'kinerja_pembicara.status_pembicara',)
        ->get();
        return response([
            'success' => true,
            'message' => 'Data pembicara',
            'data' => $pembicara
        ], 200);
    }

    public function show($fakultas)
    {
        $post = kinerja_pembicara::wherefakultas($fakultas)
        ->join('remun_point_terindex', 'kinerja_pembicara.id_terindek', '=', 'remun_point_terindex.id_terindek' ) 
        ->join('dosen', 'dosen.nidn', '=', 'kinerja_pembicara.nidn')
        ->join('REF_UNIT_FAKULTAS', 'dosen.id_unit', '=', 'REF_UNIT_FAKULTAS.ID_FAKULTAS')
        ->join('REF_UNIT', 'dosen.id_sub_unit', '=', 'REF_UNIT.ID')
        ->select('kinerja_pembicara.id_pembicara', 'dosen.nip_dosen', 'dosen.nama', 
        'REF_UNIT_FAKULTAS.FAKULTAS','REF_UNIT.NAMA', 'kinerja_pembicara.judul_materi','kinerja_pembicara.nama_penyelenggara', 
        'kinerja_pembicara.nama_kegiatan',  'kinerja_pembicara.tahun',  'kinerja_pembicara.status_pembicara',)
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
        $post = DB::table('kinerja_pembicara')
        ->join('remun_point_terindex', 'kinerja_pembicara.id_terindek', '=', 'remun_point_terindex.id_terindek' ) 
        ->join('dosen', 'dosen.nidn', '=', 'kinerja_pembicara.nidn')
        ->join('REF_UNIT_FAKULTAS', 'dosen.id_unit', '=', 'REF_UNIT_FAKULTAS.ID_FAKULTAS')
        ->join('REF_UNIT', 'dosen.id_sub_unit', '=', 'REF_UNIT.ID')
        ->where('REF_UNIT_FAKULTAS.FAKULTAS',$fakultas)
        ->where('REF_UNIT.NAMA',$NAMA)
        ->select('kinerja_pembicara.id_pembicara', 'dosen.nip_dosen', 'dosen.nama', 
        'REF_UNIT_FAKULTAS.FAKULTAS','REF_UNIT.NAMA', 'kinerja_pembicara.judul_materi','kinerja_pembicara.nama_penyelenggara', 
        'kinerja_pembicara.nama_kegiatan',  'kinerja_pembicara.tahun',  'kinerja_pembicara.status_pembicara',)
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
