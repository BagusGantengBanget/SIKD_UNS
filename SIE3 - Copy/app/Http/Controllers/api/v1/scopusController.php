<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Kinerja_scopus;
use DB;
use Illuminate\Support\Facades\Validator;

class scopusController extends Controller

{
    public function index()
    {
        $scopus = Kinerja_scopus::first()
        ->join('kinerja_scopus', 'kinerja_scopus.id_pub_scopus', '=', 'kinerja_scopus_author.id_pub_scopus')
        ->join('remun_point_terindex', 'kinerja_scopus.id_terindex', '=', 'remun_point_terindex.id_terindek' ) 
        ->join('dosen', 'dosen.nidn', '=', 'kinerja_scopus_author.nidn')
        ->join('REF_UNIT_FAKULTAS', 'dosen.id_unit', '=', 'REF_UNIT_FAKULTAS.ID_FAKULTAS')
        ->join('REF_UNIT', 'dosen.id_sub_unit', '=', 'REF_UNIT.ID')
        ->select('kinerja_scopus.id_pub_scopus', 'dosen.nip_dosen', 'dosen.nama', 
        'REF_UNIT_FAKULTAS.FAKULTAS','REF_UNIT.NAMA', 'kinerja_scopus.judul','kinerja_scopus.volume', 'kinerja_scopus.nama_jurnal',  'kinerja_scopus.judul_sumber',
        'kinerja_scopus.tahun','kinerja_scopus.doi', 'kinerja_scopus.status_scopus',)
        ->get();
        return response([
            'success' => true,
            'message' => 'Data scopus',
            'data' => $scopus
        ], 200);
    }

    public function show($fakultas)
    {
        $post = kinerja_scopus::wherefakultas($fakultas)
        ->join('kinerja_scopus', 'kinerja_scopus.id_pub_scopus', '=', 'kinerja_scopus_author.id_pub_scopus')
        ->join('remun_point_terindex', 'kinerja_scopus.id_terindex', '=', 'remun_point_terindex.id_terindek' ) 
        ->join('dosen', 'dosen.nidn', '=', 'kinerja_scopus_author.nidn')
        ->join('REF_UNIT_FAKULTAS', 'dosen.id_unit', '=', 'REF_UNIT_FAKULTAS.ID_FAKULTAS')
        ->join('REF_UNIT', 'dosen.id_sub_unit', '=', 'REF_UNIT.ID')
        ->select('kinerja_scopus.id_pub_scopus', 'dosen.nip_dosen', 'dosen.nama', 
        'REF_UNIT_FAKULTAS.FAKULTAS','REF_UNIT.NAMA', 'kinerja_scopus.judul','kinerja_scopus.volume', 'kinerja_scopus.nama_jurnal',  'kinerja_scopus.judul_sumber',
        'kinerja_scopus.tahun','kinerja_scopus.doi', 'kinerja_scopus.status_scopus',)
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
        $post = DB::table('kinerja_scopus_author')
        ->join('kinerja_scopus', 'kinerja_scopus.id_pub_scopus', '=', 'kinerja_scopus_author.id_pub_scopus')
        ->join('remun_point_terindex', 'kinerja_scopus.id_terindex', '=', 'remun_point_terindex.id_terindek' ) 
        ->join('dosen', 'dosen.nidn', '=', 'kinerja_scopus_author.nidn')
        ->join('REF_UNIT_FAKULTAS', 'dosen.id_unit', '=', 'REF_UNIT_FAKULTAS.ID_FAKULTAS')
        ->join('REF_UNIT', 'dosen.id_sub_unit', '=', 'REF_UNIT.ID')
        ->where('REF_UNIT_FAKULTAS.FAKULTAS',$fakultas)
        ->where('REF_UNIT.NAMA',$NAMA)
        ->select('kinerja_scopus.id_pub_scopus', 'dosen.nip_dosen', 'dosen.nama', 
        'REF_UNIT_FAKULTAS.FAKULTAS','REF_UNIT.NAMA', 'kinerja_scopus.judul','kinerja_scopus.volume', 'kinerja_scopus.nama_jurnal',  'kinerja_scopus.judul_sumber',
        'kinerja_scopus.tahun','kinerja_scopus.doi', 'kinerja_scopus.status_scopus',)
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
