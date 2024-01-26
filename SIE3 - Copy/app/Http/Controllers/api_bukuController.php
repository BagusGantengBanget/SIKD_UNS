<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Kinerja_buku;
use App\Http\Resources\data_dosen as data_dosenResource;

class api_bukuController extends Controller
{
    // Mengambil Semua Artikel
    public function index()
    {
        $data_bukus = Kinerja_buku::orderBy('nama', 'asc')->get();
        return data_dosenResource::collection($data_dosens);
    }
    
    // Mengambil Satu Artikel
    public function show($id)
    {
        $data_dosen = data_dosen::findOrFail($id);
        return new data_dosenResource($data_dosen);
    }
    

}