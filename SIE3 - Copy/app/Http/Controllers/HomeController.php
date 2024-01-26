<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Data_penelitian;
use Illuminate\Database\Query\Builder;
use App\Http\Requests;
use DB;
use App\Kinerja_buku;
use App\Http\Controllers\Controller;
use Illuminate\Pagination\Paginator;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $pagination = 20;
        $keyword = $request->keyword;
        $data = DB::table('kinerja_seminar_author')
        ->join('kinerja_seminar', 'kinerja_seminar.id_seminar', '=', 'kinerja_seminar_author.id')
        ->join('dosen', 'dosen.nidn', '=', 'kinerja_seminar_author.nidn')
        ->join('REF_UNIT_FAKULTAS', 'dosen.id_unit', '=', 'REF_UNIT_FAKULTAS.ID_FAKULTAS')
        ->join('REF_UNIT', 'dosen.id_sub_unit', '=', 'REF_UNIT.ID' ) 
        ->join('remun_point_terindex', 'kinerja_seminar.id_terindek', '=', 'remun_point_terindex.id_terindek' ) 
        ->groupBy('dosen.nama','REF_UNIT_FAKULTAS.FAKULTAS')
        ->select('dosen.nama','REF_UNIT_FAKULTAS.FAKULTAS', \DB::raw('count(*) as total'))
        ->get();

        $dosenbuku1 = DB::table('kinerja_buku_author')
        ->join('kinerja_buku', 'kinerja_buku.id_buku', '=', 'kinerja_buku_author.id')
        ->join('dosen', 'dosen.nidn', '=', 'kinerja_buku_author.nidn')
        ->join('REF_UNIT_FAKULTAS', 'dosen.id_unit', '=', 'REF_UNIT_FAKULTAS.ID_FAKULTAS')
        ->join('REF_UNIT', 'dosen.id_sub_unit', '=', 'REF_UNIT.ID' ) 
        ->join('remun_point_terindex', 'kinerja_buku.id_terindek', '=', 'remun_point_terindex.id_terindek' ) 
        ->where('dosen.nama','=','Agung Nugroho Catur Saputro')
        ->orwhere('dosen.nama','=','Bara Yudhistira')
        ->orwhere('dosen.nama','=','Sunny Ummul Firdaus')
        ->orwhere('dosen.nama','=','Djoko Sulaksono')
        ->orwhere('dosen.nama','=','Muthmainah')
        ->groupBy('dosen.nama','REF_UNIT_FAKULTAS.FAKULTAS')
        ->select('dosen.nama','REF_UNIT_FAKULTAS.FAKULTAS', \DB::raw('count(*) as total'))
        ->orderby('total','desc')
        ->get();

        $dosenhakipaten1 = DB::table('kinerja_hakipaten_author')
        ->join('kinerja_hakipaten', 'kinerja_hakipaten.id_hakipaten', '=', 'kinerja_hakipaten_author.id')
        ->join('dosen', 'dosen.nidn', '=', 'kinerja_hakipaten_author.nidn')
        ->join('REF_UNIT_FAKULTAS', 'dosen.id_unit', '=', 'REF_UNIT_FAKULTAS.ID_FAKULTAS')
        ->join('REF_UNIT', 'dosen.id_sub_unit', '=', 'REF_UNIT.ID' ) 
        ->join('remun_point_terindex', 'kinerja_hakipaten.id_terindek', '=', 'remun_point_terindex.id_terindek' ) 
        ->where('dosen.nama','=','Agus Purwanto')
        ->orwhere('dosen.nama','=','Fitria Rahmawati')
        ->orwhere('dosen.nama','=','Desi Suci Handayani')
        ->orwhere('dosen.nama','=','Hendri Widiyandari')
        ->orwhere('dosen.nama','=','Arif Jumari')
        ->groupBy('dosen.nama','REF_UNIT_FAKULTAS.FAKULTAS')
        ->select('dosen.nama','REF_UNIT_FAKULTAS.FAKULTAS', \DB::raw('count(*) as total'))
        ->orderby('total','desc')
        ->get();

        $dosenjurnal1 = DB::table('kinerja_jurnal_author')
        ->join('kinerja_jurnal', 'kinerja_jurnal.id_jurnal', '=', 'kinerja_jurnal_author.id')
        ->join('dosen', 'dosen.nidn', '=', 'kinerja_jurnal_author.nidn')
        ->join('REF_UNIT_FAKULTAS', 'dosen.id_unit', '=', 'REF_UNIT_FAKULTAS.ID_FAKULTAS')
        ->join('REF_UNIT', 'dosen.id_sub_unit', '=', 'REF_UNIT.ID' ) 
        ->join('remun_point_terindex', 'kinerja_jurnal.id_terindek', '=', 'remun_point_terindex.id_terindek' ) 
        ->where('dosen.nama','=','Bhisma Murti')
        ->orwhere('dosen.nama','=','Eti Poncorini Pamungkasari')
        ->orwhere('dosen.nama','=','Setyo Sri Rahardjo')
        ->orwhere('dosen.nama','=','Sumarlam')
        ->orwhere('dosen.nama','=','Djatmika')
        ->groupBy('dosen.nama','REF_UNIT_FAKULTAS.FAKULTAS')
        ->select('dosen.nama','REF_UNIT_FAKULTAS.FAKULTAS', \DB::raw('count(*) as total'))
        ->orderby('total','desc')
        ->get();
    
        $dosenkaryacipta1 = DB::table('kinerja_karyacipta_author')
        ->join('kinerja_karyacipta', 'kinerja_karyacipta.id_karyacipta', '=', 'kinerja_karyacipta_author.id')
        ->join('dosen', 'dosen.nidn', '=', 'kinerja_karyacipta_author.nidn')
        ->join('REF_UNIT_FAKULTAS', 'dosen.id_unit', '=', 'REF_UNIT_FAKULTAS.ID_FAKULTAS')
        ->join('REF_UNIT', 'dosen.id_sub_unit', '=', 'REF_UNIT.ID' ) 
        ->join('remun_point_terindex', 'kinerja_karyacipta.id_terindek', '=', 'remun_point_terindex.id_terindek' ) 
        ->where('dosen.nama','=','Kuncoro Diharjo')
        ->orwhere('dosen.nama','=','Anung Bambang Studyanto')
        ->orwhere('dosen.nama','=','Sukmaji Indro Cahyono')
        ->orwhere('dosen.nama','=','Miftahul Anwar')
        ->orwhere('dosen.nama','=','Setyo Budi')
        ->groupBy('dosen.nama','REF_UNIT_FAKULTAS.FAKULTAS')
        ->select('dosen.nama','REF_UNIT_FAKULTAS.FAKULTAS', \DB::raw('count(*) as total'))
        ->orderby('total','desc')
        ->get();

        $dosenkaryaseni1 = DB::table('kinerja_karyaseni_author')
        ->join('kinerja_karyaseni', 'kinerja_karyaseni.id_karyaseni', '=', 'kinerja_karyaseni_author.id')
        ->join('dosen', 'dosen.nidn', '=', 'kinerja_karyaseni_author.nidn')
        ->join('REF_UNIT_FAKULTAS', 'dosen.id_unit', '=', 'REF_UNIT_FAKULTAS.ID_FAKULTAS')
        ->join('REF_UNIT', 'dosen.id_sub_unit', '=', 'REF_UNIT.ID' ) 
        ->join('remun_point_terindex', 'kinerja_karyaseni.id_terindek', '=', 'remun_point_terindex.id_terindek' ) 
        ->where('dosen.nama','=','Adam Wahida')
        ->orwhere('dosen.nama','=','Setyo Budi')
        ->orwhere('dosen.nama','=','Sigit Purnomo Adi')
        ->orwhere('dosen.nama','=','Deny Tri Ardianto')
        ->orwhere('dosen.nama','=','Desy Nurcahyanti')
        ->groupBy('dosen.nama','REF_UNIT_FAKULTAS.FAKULTAS')
        ->select('dosen.nama','REF_UNIT_FAKULTAS.FAKULTAS', \DB::raw('count(*) as total'))
        ->orderby('total','desc')
        ->get();

        $dosenkoran1 = DB::table('kinerja_koran_author')
        ->join('kinerja_koran', 'kinerja_koran.id_koran', '=', 'kinerja_koran_author.id')
        ->join('dosen', 'dosen.nidn', '=', 'kinerja_koran_author.nidn')
        ->join('REF_UNIT_FAKULTAS', 'dosen.id_unit', '=', 'REF_UNIT_FAKULTAS.ID_FAKULTAS')
        ->join('REF_UNIT', 'dosen.id_sub_unit', '=', 'REF_UNIT.ID' ) 
        ->join('remun_point_terindex', 'kinerja_koran.id_terindek', '=', 'remun_point_terindex.id_terindek' ) 
        ->where('dosen.nama','=','Agus Riwanto')
        ->orwhere('dosen.nama','=','Agus Kristiyanto')
        ->orwhere('dosen.nama','=','Riwi Sumantyo')
        ->orwhere('dosen.nama','=','Bara Yudhistira')
        ->orwhere('dosen.nama','=','Tiyas Nur Haryani')
        ->groupBy('dosen.nama','REF_UNIT_FAKULTAS.FAKULTAS')
        ->select('dosen.nama','REF_UNIT_FAKULTAS.FAKULTAS', \DB::raw('count(*) as total'))
        ->orderby('total','desc')
        ->get();

        $dosenpembicara1 = DB::table('kinerja_pembicara')
        ->join('dosen', 'dosen.nidn', '=', 'kinerja_pembicara.nidn')
        ->join('REF_UNIT_FAKULTAS', 'dosen.id_unit', '=', 'REF_UNIT_FAKULTAS.ID_FAKULTAS')
        ->join('REF_UNIT', 'dosen.id_sub_unit', '=', 'REF_UNIT.ID' ) 
        ->join('remun_point_terindex', 'kinerja_pembicara.id_terindek', '=', 'remun_point_terindex.id_terindek' ) 
        ->where('dosen.nama','=','Sunny Ummul Firdaus')
        ->orwhere('dosen.nama','=','Ismi Dwi Astuti Nurhaeni')
        ->orwhere('dosen.nama','=','Agus Kristiyanto')
        ->orwhere('dosen.nama','=','Wahyudi Sutopo')
        ->orwhere('dosen.nama','=','Winarno')
        ->groupBy('dosen.nama','REF_UNIT_FAKULTAS.FAKULTAS')
        ->select('dosen.nama','REF_UNIT_FAKULTAS.FAKULTAS', \DB::raw('count(*) as total'))
        ->orderby('total','desc')
        ->get();

        $dosenpengabdian1 = DB::table('kinerja_pengabdian_author')
        ->join('kinerja_pengabdian', 'kinerja_pengabdian.id_pengabdian', '=', 'kinerja_pengabdian_author.id')
        ->join('dosen', 'dosen.nidn', '=', 'kinerja_pengabdian_author.nidn')
        ->join('REF_UNIT_FAKULTAS', 'dosen.id_unit', '=', 'REF_UNIT_FAKULTAS.ID_FAKULTAS')
        ->join('REF_UNIT', 'dosen.id_sub_unit', '=', 'REF_UNIT.ID' ) 
        ->join('remun_point_terindex', 'kinerja_pengabdian.id_terindek', '=', 'remun_point_terindex.id_terindek' ) 
        ->where('dosen.nama','=','Supriyono')
        ->orwhere('dosen.nama','=','Samanhudi')
        ->orwhere('dosen.nama','=','Sigit Purnomo Adi')
        ->orwhere('dosen.nama','=','Endang Yuniastuti')
        ->orwhere('dosen.nama','=','Bambang Pujiasmanto')
        ->groupBy('dosen.nama','REF_UNIT_FAKULTAS.FAKULTAS')
        ->select('dosen.nama','REF_UNIT_FAKULTAS.FAKULTAS', \DB::raw('count(*) as total'))
        ->orderby('total','desc')
        ->get();

        $dosenprogram1 = DB::table('kinerja_program_author')
        ->join('kinerja_program', 'kinerja_program.id_program', '=', 'kinerja_program_author.id')
        ->join('dosen', 'dosen.nidn', '=', 'kinerja_program_author.nidn')
        ->join('REF_UNIT_FAKULTAS', 'dosen.id_unit', '=', 'REF_UNIT_FAKULTAS.ID_FAKULTAS')
        ->join('REF_UNIT', 'dosen.id_sub_unit', '=', 'REF_UNIT.ID' ) 
        ->join('remun_point_terindex', 'kinerja_program.id_terindek', '=', 'remun_point_terindex.id_terindek' ) 
        ->where('dosen.nama','=','Yudho Yudhanto')
        ->orwhere('dosen.nama','=','Mohtar Yunianto')
        ->orwhere('dosen.nama','=','Hartatik')
        ->orwhere('dosen.nama','=','Rudi Hartono')
        ->orwhere('dosen.nama','=','AGUS PURNOMO')
        ->groupBy('dosen.nama','REF_UNIT_FAKULTAS.FAKULTAS')
        ->select('dosen.nama','REF_UNIT_FAKULTAS.FAKULTAS', \DB::raw('count(*) as total'))
        ->orderby('total','desc')
        ->get();
        
        $dosenreviewer1 = DB::table('kinerja_reviewer_author')
        ->join('kinerja_reviewer', 'kinerja_reviewer.id_reviewer', '=', 'kinerja_reviewer_author.id')
        ->join('dosen', 'dosen.nidn', '=', 'kinerja_reviewer_author.nidn')
        ->join('REF_UNIT_FAKULTAS', 'dosen.id_unit', '=', 'REF_UNIT_FAKULTAS.ID_FAKULTAS')
        ->join('REF_UNIT', 'dosen.id_sub_unit', '=', 'REF_UNIT.ID' ) 
        ->join('remun_point_terindex', 'kinerja_reviewer.id_terindek', '=', 'remun_point_terindex.id_terindek' ) 
        ->where('dosen.nama','=','Agung Tri Wijayanta')
        ->orwhere('dosen.nama','=','Eddy Heraldy')
        ->orwhere('dosen.nama','=','Heri Prasetyo')
        ->orwhere('dosen.nama','=','Tastaftiyan Risfandy')
        ->orwhere('dosen.nama','=','Ari Natalia Probandari')
        ->groupBy('dosen.nama','REF_UNIT_FAKULTAS.FAKULTAS')
        ->select('dosen.nama','REF_UNIT_FAKULTAS.FAKULTAS', \DB::raw('count(*) as total'))
        ->orderby('total','desc')
        ->get();

        $dosenscopus1 = DB::table('kinerja_scopus_author')
        ->join('kinerja_scopus', 'kinerja_scopus.id_pub_scopus', '=', 'kinerja_scopus_author.id_pub_scopus')
        ->join('dosen', 'dosen.nidn', '=', 'kinerja_scopus_author.nidn')
        ->join('REF_UNIT_FAKULTAS', 'dosen.id_unit', '=', 'REF_UNIT_FAKULTAS.ID_FAKULTAS')
        ->join('REF_UNIT', 'dosen.id_sub_unit', '=', 'REF_UNIT.ID' ) 
        ->join('remun_point_terindex', 'kinerja_scopus.id_terindex', '=', 'remun_point_terindex.id_terindek' ) 
        ->where('dosen.nama','=','Wahyudi Sutopo')
        ->orwhere('dosen.nama','=','Soeparmi')
        ->orwhere('dosen.nama','=','Cari')
        ->orwhere('dosen.nama','=','Dewi Retno Sari S')
        ->orwhere('dosen.nama','=','Ubaidillah')
        ->groupBy('dosen.nama','REF_UNIT_FAKULTAS.FAKULTAS')
        ->select('dosen.nama','REF_UNIT_FAKULTAS.FAKULTAS', \DB::raw('count(*) as total'))
        ->orderby('total','desc')
        ->get();

        $dosenseminar1 = DB::table('kinerja_seminar_author')
        ->join('kinerja_seminar', 'kinerja_seminar.id_seminar', '=', 'kinerja_seminar_author.id')
        ->join('dosen', 'dosen.nidn', '=', 'kinerja_seminar_author.nidn')
        ->join('REF_UNIT_FAKULTAS', 'dosen.id_unit', '=', 'REF_UNIT_FAKULTAS.ID_FAKULTAS')
        ->join('REF_UNIT', 'dosen.id_sub_unit', '=', 'REF_UNIT.ID' ) 
        ->join('remun_point_terindex', 'kinerja_seminar.id_terindek', '=', 'remun_point_terindex.id_terindek' ) 
        ->where('dosen.nama','=','Sumarlam')
        ->orwhere('dosen.nama','=','Kundharu Saddhono')
        ->orwhere('dosen.nama','=','Bani Sudardi')
        ->orwhere('dosen.nama','=','Djatmika')
        ->orwhere('dosen.nama','=','Agus Kristiyanto')
        ->groupBy('dosen.nama','REF_UNIT_FAKULTAS.FAKULTAS')
        ->select('dosen.nama','REF_UNIT_FAKULTAS.FAKULTAS', \DB::raw('count(*) as total'))
        ->orderby('total','desc')
        ->get();

        return view('home',compact( ['data'], 'keyword', 'dosenbuku1','dosenhakipaten1','dosenjurnal1','dosenkaryacipta1', 
        'dosenkaryaseni1', 'dosenkoran1', 'dosenpembicara1','dosenpengabdian1', 'dosenprogram1', 'dosenreviewer1', 
        'dosenscopus1','dosenseminar1',
        ))/* ->with('i', ($request->input('page', 1) - 1) * $pagination); */;
    }
    public function logout(){
        auth()->logout();
        // redirect to homepage
        return redirect('/login');
    }
}
