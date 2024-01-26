<?php

namespace App\Http\Controllers;

use Illuminate\Database\Query\Builder;
use Illuminate\Http\Request;
use App\Http\Requests;
use DB;
use App\data_dosen;
/* use App\Exports\BukuExport; */
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;
use Illuminate\Pagination\Paginator;
/* use Illuminate\Support\Collection; */
use Illuminate\Pagination\LengthAwarePaginator;

class Data_DosenController extends Controller
{

    public function index(Request $request)
    {
       
        $pagination = 20;
        $keyword = $request->keyword;
        $data = DB::table('dosen')
        ->join('REF_JABATAN_FUNGSIONAL', 'dosen.id_jabatan_fungsional', '=', 'REF_JABATAN_FUNGSIONAL.ID_JABATAN_FUNGSIONAL') //jabatan_fungsional
        ->join('REF_STATUS_PEGAWAI', 'dosen.id_status_pegawai', '=', 'REF_STATUS_PEGAWAI.ID_STATUS_PEGAWAI') //status pegawai
        ->join('REF_UNIT_FAKULTAS', 'dosen.id_unit', '=', 'REF_UNIT_FAKULTAS.ID_FAKULTAS') //fakultas
        ->join('REF_UNIT', 'dosen.id_sub_unit', '=', 'REF_UNIT.ID' ) //jurusan
        ->where('dosen.id_status_henti', '=', 1)
        ->where('dosen.id_jenis_staf', '=', 1)
        ->where('dosen.nama', 'like', '%'.$keyword.'%')
        ->orderBy('dosen.nama',)
        ->get();
        

        $dosenfak = DB::table('dosen')
        ->join('REF_UNIT_FAKULTAS', 'dosen.id_unit', '=', 'REF_UNIT_FAKULTAS.ID_FAKULTAS') //fakultas
        ->join('REF_UNIT', 'dosen.id_sub_unit', '=', 'REF_UNIT.ID' ) //jurusan
        ->where('dosen.id_status_henti', '=', 1)
        ->where('dosen.id_jenis_staf', '=', 1)
        ->groupBy('REF_UNIT_FAKULTAS.FAKULTAS',)
        ->select('REF_UNIT_FAKULTAS.FAKULTAS',  \DB::raw('count(*) as totalfak'))
        ->get();

        $categoriesfak = [];
        $datafak=[];
        foreach($dosenfak as $dt){
            $categoriesfak[] = $dt->FAKULTAS;
            $datafak[] = $dt->totalfak;
        }

        $dosenpend = DB::table('dosen')
        ->join('REF_UNIT_FAKULTAS', 'dosen.id_unit', '=', 'REF_UNIT_FAKULTAS.ID_FAKULTAS') //fakultas
        ->where('dosen.id_pendidikan_tertinggi', '=', 1)
        ->groupBy('REF_UNIT_FAKULTAS.FAKULTAS',)
        ->select('REF_UNIT_FAKULTAS.FAKULTAS',  \DB::raw('count(*) as totalpend'))
        ->get();

        $categoriespend = [];
        $datapend=[];
        foreach($dosenpend as $dt){
            $categoriespend[] = $dt->FAKULTAS;
            $datapend[] = $dt->totalpend;
        }

        $dosenpend2 = DB::table('dosen')
        ->join('REF_UNIT_FAKULTAS', 'dosen.id_unit', '=', 'REF_UNIT_FAKULTAS.ID_FAKULTAS') //fakultas
        ->where('dosen.id_pendidikan_tertinggi', '=', 2)
        ->groupBy('REF_UNIT_FAKULTAS.FAKULTAS',)
        ->select('REF_UNIT_FAKULTAS.FAKULTAS',  \DB::raw('count(*) as totalpend2'))
        ->get();

        $categoriespend2 = [];
        $datapend2=[];
        foreach($dosenpend2 as $dt){
            $categoriespend2[] = $dt->FAKULTAS;
            $datapend2[] = $dt->totalpend2;
        }
        /* dd($datapend); */
        
        return view('data_dosen.index'  ,compact( 'data', 'keyword' , 'categoriesfak','datafak', 
        'categoriespend','datapend', 'categoriespend2','datapend2',
        ))->with('i', ($request->input('page', 1) - 1) * $pagination);
       
    }
    
    /* public function create()
    {
        return view('data_dosen.create');
    }

    public function show(data_dosen $data_dosen)
    {
        return view('data_dosen.show',compact('data_dosen'));
    }

    public function delete($id)
	{
		$data_dosen = data_dosen::find($id);
        $data_dosen->delete();
        return "Data berhasil Dihapus";
	}

    public function edit(data_dosen $data_dosen)
    {
        $edit_dosen = DB::table('dosen')
        ->where('id', $id)
        ->first();
        
        return view('data_dosen.edit',compact('edit_dosen'));
    }

    public function update(Request $request, data_dosen $data_dosen)
    {
        $request->validate([
            'nama' => 'required',
            
        ]);
        $data_dosen->update($request->all());
        return redirect()->route('data_dosen.index')->with('success','biodata berhasil di update');
    }

    public function destroy(data_dosen $data_dosen)
    {
        $data_dosen->delete();
        return redirect()->route('data_dosen.index')->with('success','Biodata berhasil dihapus');
    } */

}
    

