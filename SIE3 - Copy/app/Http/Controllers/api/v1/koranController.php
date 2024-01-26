<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Kinerja_koran;
use DB;
use Illuminate\Support\Facades\Validator;

class koranController extends Controller

{
    public function index()
    {
        $koran = Kinerja_koran::first()
        ->join('kinerja_koran', 'kinerja_koran.id_koran', '=', 'kinerja_koran_author.id')
        ->join('remun_point_terindex', 'kinerja_koran.id_terindek', '=', 'remun_point_terindex.id_terindek' ) 
        ->join('dosen', 'dosen.nidn', '=', 'kinerja_koran_author.nidn')
        ->join('REF_UNIT_FAKULTAS', 'dosen.id_unit', '=', 'REF_UNIT_FAKULTAS.ID_FAKULTAS')
        ->join('REF_UNIT', 'dosen.id_sub_unit', '=', 'REF_UNIT.ID')
        ->select('kinerja_koran.id_koran', 'dosen.nip_dosen', 'dosen.nama', 
        'REF_UNIT_FAKULTAS.FAKULTAS','REF_UNIT.NAMA', 'kinerja_koran.nama_koran','kinerja_koran.dimuat', 'kinerja_koran.tanggal_muat', 'kinerja_koran.tahun', 'kinerja_koran.status_koran',)
        ->get();
        return response([
            'success' => true,
            'message' => 'Data koran',
            'data' => $koran
        ], 200);
    }

    public function show($fakultas)
    {
        $post = kinerja_koran::wherefakultas($fakultas)
        ->join('kinerja_koran', 'kinerja_koran.id_koran', '=', 'kinerja_koran_author.id')
        ->join('remun_point_terindex', 'kinerja_koran.id_terindek', '=', 'remun_point_terindex.id_terindek' ) 
        ->join('dosen', 'dosen.nidn', '=', 'kinerja_koran_author.nidn')
        ->join('REF_UNIT_FAKULTAS', 'dosen.id_unit', '=', 'REF_UNIT_FAKULTAS.ID_FAKULTAS')
        ->join('REF_UNIT', 'dosen.id_sub_unit', '=', 'REF_UNIT.ID')
        ->select('kinerja_koran.id_koran', 'dosen.nip_dosen', 'dosen.nama', 
        'REF_UNIT_FAKULTAS.FAKULTAS','REF_UNIT.NAMA', 'kinerja_koran.nama_koran','kinerja_koran.dimuat', 'kinerja_koran.tanggal_muat', 'kinerja_koran.tahun', 'kinerja_koran.status_koran',)
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
        $post = DB::table('kinerja_koran_author')
        ->join('kinerja_koran', 'kinerja_koran.id_koran', '=', 'kinerja_koran_author.id')
        ->join('remun_point_terindex', 'kinerja_koran.id_terindek', '=', 'remun_point_terindex.id_terindek' ) 
        ->join('dosen', 'dosen.nidn', '=', 'kinerja_koran_author.nidn')
        ->join('REF_UNIT_FAKULTAS', 'dosen.id_unit', '=', 'REF_UNIT_FAKULTAS.ID_FAKULTAS')
        ->join('REF_UNIT', 'dosen.id_sub_unit', '=', 'REF_UNIT.ID')
        ->where('REF_UNIT_FAKULTAS.FAKULTAS',$fakultas)
        ->where('REF_UNIT.NAMA',$NAMA)
        ->select('kinerja_koran.id_koran', 'dosen.nip_dosen', 'dosen.nama', 
        'REF_UNIT_FAKULTAS.FAKULTAS','REF_UNIT.NAMA', 'kinerja_koran.nama_koran','kinerja_koran.dimuat', 'kinerja_koran.tanggal_muat', 'kinerja_koran.tahun', 'kinerja_koran.status_koran',)
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
