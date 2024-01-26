<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Kinerja_buku;
use DB;
use Illuminate\Support\Facades\Validator;

class bukuController extends Controller

{
    public function index()
    {
        $buku = Kinerja_buku::first()
        ->join('kinerja_buku', 'kinerja_buku.id_buku', '=', 'kinerja_buku_author.id')
        ->join('remun_point_terindex', 'kinerja_buku.id_terindek', '=', 'remun_point_terindex.id_terindek' ) 
        ->join('dosen', 'dosen.nidn', '=', 'kinerja_buku_author.nidn')
        ->join('REF_UNIT_FAKULTAS', 'dosen.id_unit', '=', 'REF_UNIT_FAKULTAS.ID_FAKULTAS')
        ->join('REF_UNIT', 'dosen.id_sub_unit', '=', 'REF_UNIT.ID')
        ->select('kinerja_buku.id_buku', 'dosen.nip_dosen', 'dosen.nama', 
        'REF_UNIT_FAKULTAS.FAKULTAS','REF_UNIT.NAMA', 'kinerja_buku.judul_buku','kinerja_buku.penerbit', 'kinerja_buku.halaman', 'kinerja_buku.tahun', 'kinerja_buku.status_buku',)
        ->get();
        return response([
            'success' => true,
            'message' => 'Data Buku',
            'data' => $buku
        ], 200);
    }

    public function show($fakultas)
    {
        $post = kinerja_buku::wherefakultas($fakultas)
        ->join('kinerja_buku', 'kinerja_buku.id_buku', '=', 'kinerja_buku_author.id')
        ->join('remun_point_terindex', 'kinerja_buku.id_terindek', '=', 'remun_point_terindex.id_terindek' ) 
        ->join('dosen', 'dosen.nidn', '=', 'kinerja_buku_author.nidn')
        ->join('REF_UNIT_FAKULTAS', 'dosen.id_unit', '=', 'REF_UNIT_FAKULTAS.ID_FAKULTAS')
        ->join('REF_UNIT', 'dosen.id_sub_unit', '=', 'REF_UNIT.ID')
        ->select('kinerja_buku.id_buku', 'dosen.nip_dosen', 'dosen.nama', 
        'REF_UNIT_FAKULTAS.FAKULTAS','REF_UNIT.NAMA', 'kinerja_buku.judul_buku','kinerja_buku.penerbit', 'kinerja_buku.halaman', 'kinerja_buku.tahun', 'kinerja_buku.status_buku',)
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
        $post = DB::table('kinerja_buku_author')
        ->join('kinerja_buku', 'kinerja_buku.id_buku', '=', 'kinerja_buku_author.id')
        ->join('remun_point_terindex', 'kinerja_buku.id_terindek', '=', 'remun_point_terindex.id_terindek' ) 
        ->join('dosen', 'dosen.nidn', '=', 'kinerja_buku_author.nidn')
        ->join('REF_UNIT_FAKULTAS', 'dosen.id_unit', '=', 'REF_UNIT_FAKULTAS.ID_FAKULTAS')
        ->join('REF_UNIT', 'dosen.id_sub_unit', '=', 'REF_UNIT.ID')
        ->where('REF_UNIT_FAKULTAS.FAKULTAS',$fakultas)
        ->where('REF_UNIT.NAMA',$NAMA)
        ->select('kinerja_buku.id_buku', 'dosen.nip_dosen', 'dosen.nama', 
        'REF_UNIT_FAKULTAS.FAKULTAS','REF_UNIT.NAMA', 'kinerja_buku.judul_buku','kinerja_buku.penerbit', 'kinerja_buku.halaman', 'kinerja_buku.tahun', 'kinerja_buku.status_buku',)
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
