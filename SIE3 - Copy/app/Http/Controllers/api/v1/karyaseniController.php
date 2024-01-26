<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Kinerja_karyaseni;
use DB;
use Illuminate\Support\Facades\Validator;

class karyaseniController extends Controller

{
    public function index()
    {
        $karyaseni = Kinerja_karyaseni::first()
        ->join('kinerja_karyaseni', 'kinerja_karyaseni.id_karyaseni', '=', 'kinerja_karyaseni_author.id')
        ->join('remun_point_terindex', 'kinerja_karyaseni.id_terindek', '=', 'remun_point_terindex.id_terindek' ) 
        ->join('dosen', 'dosen.nidn', '=', 'kinerja_karyaseni_author.nidn')
        ->join('REF_UNIT_FAKULTAS', 'dosen.id_unit', '=', 'REF_UNIT_FAKULTAS.ID_FAKULTAS')
        ->join('REF_UNIT', 'dosen.id_sub_unit', '=', 'REF_UNIT.ID')
        ->select('kinerja_karyaseni.id_karyaseni', 'dosen.nip_dosen', 'dosen.nama', 
        'REF_UNIT_FAKULTAS.FAKULTAS','REF_UNIT.NAMA', 'kinerja_karyaseni.nama_karyaseni','kinerja_karyaseni.ket_karyaseni', 'kinerja_karyaseni.tag',
        'kinerja_karyaseni.tahun',  'kinerja_karyaseni.status_karyaseni',)
        ->get();
        return response([
            'success' => true,
            'message' => 'Data karyaseni',
            'data' => $karyaseni
        ], 200);
    }

    public function show($fakultas)
    {
        $post = kinerja_karyaseni::wherefakultas($fakultas)
        ->join('kinerja_karyaseni', 'kinerja_karyaseni.id_karyaseni', '=', 'kinerja_karyaseni_author.id')
        ->join('remun_point_terindex', 'kinerja_karyaseni.id_terindek', '=', 'remun_point_terindex.id_terindek' ) 
        ->join('dosen', 'dosen.nidn', '=', 'kinerja_karyaseni_author.nidn')
        ->join('REF_UNIT_FAKULTAS', 'dosen.id_unit', '=', 'REF_UNIT_FAKULTAS.ID_FAKULTAS')
        ->join('REF_UNIT', 'dosen.id_sub_unit', '=', 'REF_UNIT.ID')
        ->select('kinerja_karyaseni.id_karyaseni', 'dosen.nip_dosen', 'dosen.nama', 
        'REF_UNIT_FAKULTAS.FAKULTAS','REF_UNIT.NAMA', 'kinerja_karyaseni.nama_karyaseni','kinerja_karyaseni.ket_karyaseni', 'kinerja_karyaseni.tag',
        'kinerja_karyaseni.tahun',  'kinerja_karyaseni.status_karyaseni',)
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
        $post = DB::table('kinerja_karyaseni_author')
        ->join('kinerja_karyaseni', 'kinerja_karyaseni.id_karyaseni', '=', 'kinerja_karyaseni_author.id')
        ->join('remun_point_terindex', 'kinerja_karyaseni.id_terindek', '=', 'remun_point_terindex.id_terindek' ) 
        ->join('dosen', 'dosen.nidn', '=', 'kinerja_karyaseni_author.nidn')
        ->join('REF_UNIT_FAKULTAS', 'dosen.id_unit', '=', 'REF_UNIT_FAKULTAS.ID_FAKULTAS')
        ->join('REF_UNIT', 'dosen.id_sub_unit', '=', 'REF_UNIT.ID')
        ->where('REF_UNIT_FAKULTAS.FAKULTAS',$fakultas)
        ->where('REF_UNIT.NAMA',$NAMA)
        ->select('kinerja_karyaseni.id_karyaseni', 'dosen.nip_dosen', 'dosen.nama', 
        'REF_UNIT_FAKULTAS.FAKULTAS','REF_UNIT.NAMA', 'kinerja_karyaseni.nama_karyaseni','kinerja_karyaseni.ket_karyaseni', 'kinerja_karyaseni.tag',
        'kinerja_karyaseni.tahun',  'kinerja_karyaseni.status_karyaseni',)
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
