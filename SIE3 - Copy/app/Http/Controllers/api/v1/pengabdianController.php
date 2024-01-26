<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Kinerja_pengabdian;
use DB;
use Illuminate\Support\Facades\Validator;

class pengabdianController extends Controller

{
    public function index()
    {
        $pengabdian = Kinerja_pengabdian::first()
        ->join('kinerja_pengabdian', 'kinerja_pengabdian.id_pengabdian', '=', 'kinerja_pengabdian_author.id')
        ->join('remun_point_terindex', 'kinerja_pengabdian.id_terindek', '=', 'remun_point_terindex.id_terindek' ) 
        ->join('dosen', 'dosen.nidn', '=', 'kinerja_pengabdian_author.nidn')
        ->join('REF_UNIT_FAKULTAS', 'dosen.id_unit', '=', 'REF_UNIT_FAKULTAS.ID_FAKULTAS')
        ->join('REF_UNIT', 'dosen.id_sub_unit', '=', 'REF_UNIT.ID')
        ->select('kinerja_pengabdian.id_pengabdian', 'dosen.nip_dosen', 'dosen.nama', 
        'REF_UNIT_FAKULTAS.FAKULTAS','REF_UNIT.NAMA', 'kinerja_pengabdian.nama_pengabdian',
        'kinerja_pengabdian.tahun',  'kinerja_pengabdian.status_pengabdian',)
        ->get();
        return response([
            'success' => true,
            'message' => 'Data pengabdian',
            'data' => $pengabdian
        ], 200);
    }

    public function show($fakultas)
    {
        $post = kinerja_pengabdian::wherefakultas($fakultas)
        ->join('kinerja_pengabdian', 'kinerja_pengabdian.id_pengabdian', '=', 'kinerja_pengabdian_author.id')
        ->join('remun_point_terindex', 'kinerja_pengabdian.id_terindek', '=', 'remun_point_terindex.id_terindek' ) 
        ->join('dosen', 'dosen.nidn', '=', 'kinerja_pengabdian_author.nidn')
        ->join('REF_UNIT_FAKULTAS', 'dosen.id_unit', '=', 'REF_UNIT_FAKULTAS.ID_FAKULTAS')
        ->join('REF_UNIT', 'dosen.id_sub_unit', '=', 'REF_UNIT.ID')
        ->select('kinerja_pengabdian.id_pengabdian', 'dosen.nip_dosen', 'dosen.nama', 
        'REF_UNIT_FAKULTAS.FAKULTAS','REF_UNIT.NAMA', 'kinerja_pengabdian.nama_pengabdian',
        'kinerja_pengabdian.tahun',  'kinerja_pengabdian.status_pengabdian',)
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
        $post = DB::table('kinerja_pengabdian_author')
        ->join('kinerja_pengabdian', 'kinerja_pengabdian.id_pengabdian', '=', 'kinerja_pengabdian_author.id')
        ->join('remun_point_terindex', 'kinerja_pengabdian.id_terindek', '=', 'remun_point_terindex.id_terindek' ) 
        ->join('dosen', 'dosen.nidn', '=', 'kinerja_pengabdian_author.nidn')
        ->join('REF_UNIT_FAKULTAS', 'dosen.id_unit', '=', 'REF_UNIT_FAKULTAS.ID_FAKULTAS')
        ->join('REF_UNIT', 'dosen.id_sub_unit', '=', 'REF_UNIT.ID')
        ->where('REF_UNIT_FAKULTAS.FAKULTAS',$fakultas)
        ->where('REF_UNIT.NAMA',$NAMA)
        ->select('kinerja_pengabdian.id_pengabdian', 'dosen.nip_dosen', 'dosen.nama', 
        'REF_UNIT_FAKULTAS.FAKULTAS','REF_UNIT.NAMA', 'kinerja_pengabdian.nama_pengabdian',
        'kinerja_pengabdian.tahun',  'kinerja_pengabdian.status_pengabdian',)
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
