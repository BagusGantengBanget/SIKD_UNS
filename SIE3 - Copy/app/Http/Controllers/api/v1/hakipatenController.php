<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\kinerja_hakipaten;
use DB;
use Illuminate\Support\Facades\Validator;

class hakipatenController extends Controller

{
    public function index()
    {
        $hakipaten = Kinerja_hakipaten::first()
        ->join('kinerja_hakipaten', 'kinerja_hakipaten.id_hakipaten', '=', 'kinerja_hakipaten_author.id')
        ->join('remun_point_terindex', 'kinerja_hakipaten.id_terindek', '=', 'remun_point_terindex.id_terindek' ) 
        ->join('dosen', 'dosen.nidn', '=', 'kinerja_hakipaten_author.nidn')
        ->join('REF_UNIT_FAKULTAS', 'dosen.id_unit', '=', 'REF_UNIT_FAKULTAS.ID_FAKULTAS')
        ->join('REF_UNIT', 'dosen.id_sub_unit', '=', 'REF_UNIT.ID')
        ->select('kinerja_hakipaten.id_hakipaten', 'dosen.nip_dosen', 'dosen.nama', 
        'REF_UNIT_FAKULTAS.FAKULTAS','REF_UNIT.NAMA','kinerja_hakipaten.nama_hakipaten','kinerja_hakipaten.tahun', 'kinerja_hakipaten.status_hakipaten',)
        ->get();
        return response([
            'success' => true,
            'message' => 'Data Hakipaten',
            'data' => $hakipaten
        ], 200);
    }

    public function show($fakultas)
    {
        $post = kinerja_hakipaten::wherefakultas($fakultas)
        ->join('kinerja_hakipaten', 'kinerja_hakipaten.id_hakipaten', '=', 'kinerja_hakipaten_author.id')
        ->join('remun_point_terindex', 'kinerja_hakipaten.id_terindek', '=', 'remun_point_terindex.id_terindek' ) 
        ->join('dosen', 'dosen.nidn', '=', 'kinerja_hakipaten_author.nidn')
        ->join('REF_UNIT_FAKULTAS', 'dosen.id_unit', '=', 'REF_UNIT_FAKULTAS.ID_FAKULTAS')
        ->join('REF_UNIT', 'dosen.id_sub_unit', '=', 'REF_UNIT.ID')
        ->select('kinerja_hakipaten.id_hakipaten', 'dosen.nip_dosen', 'dosen.nama', 
        'REF_UNIT_FAKULTAS.FAKULTAS','REF_UNIT.NAMA','kinerja_hakipaten.nama_hakipaten','kinerja_hakipaten.tahun', 'kinerja_hakipaten.status_hakipaten',)
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
        $post = DB::table('kinerja_hakipaten_author')
        ->join('kinerja_hakipaten', 'kinerja_hakipaten.id_hakipaten', '=', 'kinerja_hakipaten_author.id')
        ->join('remun_point_terindex', 'kinerja_hakipaten.id_terindek', '=', 'remun_point_terindex.id_terindek' ) 
        ->join('dosen', 'dosen.nidn', '=', 'kinerja_hakipaten_author.nidn')
        ->join('REF_UNIT_FAKULTAS', 'dosen.id_unit', '=', 'REF_UNIT_FAKULTAS.ID_FAKULTAS')
        ->join('REF_UNIT', 'dosen.id_sub_unit', '=', 'REF_UNIT.ID')
        ->where('REF_UNIT_FAKULTAS.FAKULTAS',$fakultas)
        ->where('REF_UNIT.NAMA',$NAMA)
        ->select('kinerja_hakipaten.id_hakipaten', 'dosen.nip_dosen', 'dosen.nama', 
        'REF_UNIT_FAKULTAS.FAKULTAS','REF_UNIT.NAMA','kinerja_hakipaten.nama_hakipaten','kinerja_hakipaten.tahun', 'kinerja_hakipaten.status_hakipaten',)
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
