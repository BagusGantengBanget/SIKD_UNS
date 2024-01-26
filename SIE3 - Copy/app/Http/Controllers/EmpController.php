<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use DataTables;

class EmpController extends Controller
{
    public function ss_processing (Request $request)
    {
        
        $query = DB::table('kinerja_buku');

        return DataTables::queryBuilder($query)->toJson();
    }

}
