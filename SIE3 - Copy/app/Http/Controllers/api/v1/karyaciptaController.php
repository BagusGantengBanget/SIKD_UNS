<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Kinerja_karyacipta;
use DB;
use Illuminate\Support\Facades\Validator;

class karyaciptaController extends Controller

{
    public function index()
    {
        $karyacipta = Kinerja_karyacipta::first()
        ->join('kinerja_karyacipta', 'kinerja_karyacipta.id_karyacipta', '=', 'kinerja_karyacipta_author.id')
        ->join('remun_point_terindex', 'kinerja_karyacipta.id_terindek', '=', 'remun_point_terindex.id_terindek' ) 
        ->join('dosen', 'dosen.nidn', '=', 'kinerja_karyacipta_author.nidn')
        ->join('REF_UNIT_FAKULTAS', 'dosen.id_unit', '=', 'REF_UNIT_FAKULTAS.ID_FAKULTAS')
        ->join('REF_UNIT', 'dosen.id_sub_unit', '=', 'REF_UNIT.ID')
        ->select('kinerja_karyacipta.id_karyacipta', 'dosen.nip_dosen', 'dosen.nama', 
        'REF_UNIT_FAKULTAS.FAKULTAS','REF_UNIT.NAMA', 'kinerja_karyacipta.nama_karyacipta','kinerja_karyacipta.ket_karyacipta', 'kinerja_karyacipta.tahun',  'kinerja_karyacipta.status_program',)
        ->get();
        return response([
            'success' => true,
            'message' => 'Data karyacipta',
            'data' => $karyacipta
        ], 200);
    }

    public function show($fakultas)
    {
        $post = kinerja_karyacipta::wherefakultas($fakultas)
        ->join('kinerja_karyacipta', 'kinerja_karyacipta.id_karyacipta', '=', 'kinerja_karyacipta_author.id')
        ->join('remun_point_terindex', 'kinerja_karyacipta.id_terindek', '=', 'remun_point_terindex.id_terindek' ) 
        ->join('dosen', 'dosen.nidn', '=', 'kinerja_karyacipta_author.nidn')
        ->join('REF_UNIT_FAKULTAS', 'dosen.id_unit', '=', 'REF_UNIT_FAKULTAS.ID_FAKULTAS')
        ->join('REF_UNIT', 'dosen.id_sub_unit', '=', 'REF_UNIT.ID')
        ->select('kinerja_karyacipta.id_karyacipta', 'dosen.nip_dosen', 'dosen.nama', 
        'REF_UNIT_FAKULTAS.FAKULTAS','REF_UNIT.NAMA', 'kinerja_karyacipta.nama_karyacipta','kinerja_karyacipta.ket_karyacipta', 'kinerja_karyacipta.tahun',  'kinerja_karyacipta.status_program',)
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
        $post = DB::table('kinerja_karyacipta_author')
        ->join('kinerja_karyacipta', 'kinerja_karyacipta.id_karyacipta', '=', 'kinerja_karyacipta_author.id')
        ->join('remun_point_terindex', 'kinerja_karyacipta.id_terindek', '=', 'remun_point_terindex.id_terindek' ) 
        ->join('dosen', 'dosen.nidn', '=', 'kinerja_karyacipta_author.nidn')
        ->join('REF_UNIT_FAKULTAS', 'dosen.id_unit', '=', 'REF_UNIT_FAKULTAS.ID_FAKULTAS')
        ->join('REF_UNIT', 'dosen.id_sub_unit', '=', 'REF_UNIT.ID')
        ->where('REF_UNIT_FAKULTAS.FAKULTAS',$fakultas)
        ->where('REF_UNIT.NAMA',$NAMA)
        ->select('kinerja_karyacipta.id_karyacipta', 'dosen.nip_dosen', 'dosen.nama', 
        'REF_UNIT_FAKULTAS.FAKULTAS','REF_UNIT.NAMA', 'kinerja_karyacipta.nama_karyacipta','kinerja_karyacipta.ket_karyacipta', 'kinerja_karyacipta.tahun',  'kinerja_karyacipta.status_program',)
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
