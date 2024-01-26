<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Kinerja_seminar;
use DB;
use Illuminate\Support\Facades\Validator;

class seminarController extends Controller

{
    public function index()
    {
        $seminar = Kinerja_seminar::first()
        ->join('kinerja_seminar', 'kinerja_seminar.id_seminar', '=', 'kinerja_seminar_author.id')
        ->join('remun_point_terindex', 'kinerja_seminar.id_terindek', '=', 'remun_point_terindex.id_terindek' ) 
        ->join('dosen', 'dosen.nidn', '=', 'kinerja_seminar_author.nidn')
        ->join('REF_UNIT_FAKULTAS', 'dosen.id_unit', '=', 'REF_UNIT_FAKULTAS.ID_FAKULTAS')
        ->join('REF_UNIT', 'dosen.id_sub_unit', '=', 'REF_UNIT.ID')
        ->select('kinerja_seminar.id_seminar', 'dosen.nip_dosen', 'dosen.nama', 
        'REF_UNIT_FAKULTAS.FAKULTAS','REF_UNIT.NAMA', 'kinerja_seminar.nama_seminar','kinerja_seminar.penyelenggara', 'kinerja_seminar.kota', 'kinerja_seminar.tanggal',   'kinerja_seminar.tahun',   'kinerja_seminar.status_seminar',)
        ->get();
        return response([
            'success' => true,
            'message' => 'Data seminar',
            'data' => $seminar
        ], 200);
    }

    public function show($fakultas)
    {
        $post = kinerja_seminar::wherefakultas($fakultas)
        ->join('kinerja_seminar', 'kinerja_seminar.id_seminar', '=', 'kinerja_seminar_author.id')
        ->join('remun_point_terindex', 'kinerja_seminar.id_terindek', '=', 'remun_point_terindex.id_terindek' ) 
        ->join('dosen', 'dosen.nidn', '=', 'kinerja_seminar_author.nidn')
        ->join('REF_UNIT_FAKULTAS', 'dosen.id_unit', '=', 'REF_UNIT_FAKULTAS.ID_FAKULTAS')
        ->join('REF_UNIT', 'dosen.id_sub_unit', '=', 'REF_UNIT.ID')
        ->select('kinerja_seminar.id_seminar', 'dosen.nip_dosen', 'dosen.nama', 
        'REF_UNIT_FAKULTAS.FAKULTAS','REF_UNIT.NAMA', 'kinerja_seminar.nama_seminar','kinerja_seminar.penyelenggara', 'kinerja_seminar.kota', 'kinerja_seminar.tanggal',   'kinerja_seminar.tahun',   'kinerja_seminar.status_seminar',)
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
        $post = DB::table('kinerja_seminar_author')
        ->join('kinerja_seminar', 'kinerja_seminar.id_seminar', '=', 'kinerja_seminar_author.id')
        ->join('remun_point_terindex', 'kinerja_seminar.id_terindek', '=', 'remun_point_terindex.id_terindek' ) 
        ->join('dosen', 'dosen.nidn', '=', 'kinerja_seminar_author.nidn')
        ->join('REF_UNIT_FAKULTAS', 'dosen.id_unit', '=', 'REF_UNIT_FAKULTAS.ID_FAKULTAS')
        ->join('REF_UNIT', 'dosen.id_sub_unit', '=', 'REF_UNIT.ID')
        ->where('REF_UNIT_FAKULTAS.FAKULTAS',$fakultas)
        ->where('REF_UNIT.NAMA',$NAMA)
        ->select('kinerja_seminar.id_seminar', 'dosen.nip_dosen', 'dosen.nama', 
        'REF_UNIT_FAKULTAS.FAKULTAS','REF_UNIT.NAMA', 'kinerja_seminar.nama_seminar','kinerja_seminar.penyelenggara', 'kinerja_seminar.kota', 'kinerja_seminar.tanggal',   'kinerja_seminar.tahun',   'kinerja_seminar.status_seminar',)
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
