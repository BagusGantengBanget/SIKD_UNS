<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Kinerja_reviewer;
use DB;
use Illuminate\Support\Facades\Validator;

class reviewerController extends Controller

{
    public function index()
    {
        $reviewer = Kinerja_reviewer::first()
        ->join('kinerja_reviewer', 'kinerja_reviewer.id_reviewer', '=', 'kinerja_reviewer_author.id')
        ->join('remun_point_terindex', 'kinerja_reviewer.id_terindek', '=', 'remun_point_terindex.id_terindek' ) 
        ->join('dosen', 'dosen.nidn', '=', 'kinerja_reviewer_author.nidn')
        ->join('REF_UNIT_FAKULTAS', 'dosen.id_unit', '=', 'REF_UNIT_FAKULTAS.ID_FAKULTAS')
        ->join('REF_UNIT', 'dosen.id_sub_unit', '=', 'REF_UNIT.ID')
        ->select('kinerja_reviewer.id_reviewer', 'dosen.nip_dosen', 'dosen.nama', 
        'REF_UNIT_FAKULTAS.FAKULTAS','REF_UNIT.NAMA', 'kinerja_reviewer.jurnal','kinerja_reviewer.paper', 'kinerja_reviewer.tahun', 'kinerja_reviewer.penerbit',   'kinerja_reviewer.status_reviewer',)
        ->get();
        return response([
            'success' => true,
            'message' => 'Data reviewer',
            'data' => $reviewer
        ], 200);
    }

    public function show($fakultas)
    {
        $post = kinerja_reviewer::wherefakultas($fakultas)
        ->join('kinerja_reviewer', 'kinerja_reviewer.id_reviewer', '=', 'kinerja_reviewer_author.id')
        ->join('remun_point_terindex', 'kinerja_reviewer.id_terindek', '=', 'remun_point_terindex.id_terindek' ) 
        ->join('dosen', 'dosen.nidn', '=', 'kinerja_reviewer_author.nidn')
        ->join('REF_UNIT_FAKULTAS', 'dosen.id_unit', '=', 'REF_UNIT_FAKULTAS.ID_FAKULTAS')
        ->join('REF_UNIT', 'dosen.id_sub_unit', '=', 'REF_UNIT.ID')
        ->select('kinerja_reviewer.id_reviewer', 'dosen.nip_dosen', 'dosen.nama', 
        'REF_UNIT_FAKULTAS.FAKULTAS','REF_UNIT.NAMA', 'kinerja_reviewer.jurnal','kinerja_reviewer.paper', 'kinerja_reviewer.tahun', 'kinerja_reviewer.penerbit',   'kinerja_reviewer.status_reviewer',)
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
        $post = DB::table('kinerja_reviewer_author')
        ->join('kinerja_reviewer', 'kinerja_reviewer.id_reviewer', '=', 'kinerja_reviewer_author.id')
        ->join('remun_point_terindex', 'kinerja_reviewer.id_terindek', '=', 'remun_point_terindex.id_terindek' ) 
        ->join('dosen', 'dosen.nidn', '=', 'kinerja_reviewer_author.nidn')
        ->join('REF_UNIT_FAKULTAS', 'dosen.id_unit', '=', 'REF_UNIT_FAKULTAS.ID_FAKULTAS')
        ->join('REF_UNIT', 'dosen.id_sub_unit', '=', 'REF_UNIT.ID')
        ->where('REF_UNIT_FAKULTAS.FAKULTAS',$fakultas)
        ->where('REF_UNIT.NAMA',$NAMA)
        ->select('kinerja_reviewer.id_reviewer', 'dosen.nip_dosen', 'dosen.nama', 
        'REF_UNIT_FAKULTAS.FAKULTAS','REF_UNIT.NAMA', 'kinerja_reviewer.jurnal','kinerja_reviewer.paper', 'kinerja_reviewer.tahun', 'kinerja_reviewer.penerbit',   'kinerja_reviewer.status_reviewer',)
        ->get();

        if ($post) {
            return response()->json([
                'success' => true,
                'Fakultas' => $fakultas, 
                'reviewer Studi'=> $NAMA,
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
