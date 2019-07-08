<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\StatusPengiriman;
use DB;

class DirekturLaporanController extends Controller
{
    public function __contruct()
    {
        return $this->middleware('auth');
    }

    public function statistikPengiriman()
    {
        $bulan_januari = DB::table('pengiriman')->where('created_at', 'like', date("Y").'-01%')->get();
        $bulan_februari = DB::table('pengiriman')->where('created_at', 'like', date("Y").'-02%')->get();
        $bulan_maret = DB::table('pengiriman')->where('created_at', 'like', date("Y").'-03%')->get();
        $bulan_april = DB::table('pengiriman')->where('created_at', 'like', date("Y").'-04%')->get();
        $bulan_mei = DB::table('pengiriman')->where('created_at', 'like', date("Y").'-05%')->get();
        $bulan_juni = DB::table('pengiriman')->where('created_at', 'like', date("Y").'-06%')->get();
        $bulan_juli = DB::table('pengiriman')->where('created_at', 'like', date("Y").'-07%')->get();
        $bulan_agustus = DB::table('pengiriman')->where('created_at', 'like', date("Y").'-08%')->get();
        $bulan_september = DB::table('pengiriman')->where('created_at', 'like', date("Y").'-09%')->get();
        $bulan_oktober = DB::table('pengiriman')->where('created_at', 'like', date("Y").'-10%')->get();
        $bulan_november = DB::table('pengiriman')->where('created_at', 'like', date("Y").'-11%')->get();
        $bulan_desember = DB::table('pengiriman')->where('created_at', 'like', date("Y").'-12%')->get();

        return view('direktur.laporan.statistik_pengiriman', compact(
            'bulan_januari',
            'bulan_februari',
            'bulan_maret',
            'bulan_april',
            'bulan_mei',
            'bulan_juni',
            'bulan_juli',
            'bulan_agustus',
            'bulan_september',
            'bulan_oktober',
            'bulan_november',
            'bulan_desember'
            ));
    }

    public function statistikPenerimaan()
    {
        $bulan_januari = DB::table('status_pengiriman')->where('status', 1)->where('updated_at', 'like', date("Y").'-01%')->get();
        $bulan_februari = DB::table('status_pengiriman')->where('status', 1)->where('updated_at', 'like', date("Y").'-02%')->get();
        $bulan_maret = DB::table('status_pengiriman')->where('status', 1)->where('updated_at', 'like', date("Y").'-03%')->get();
        $bulan_april = DB::table('status_pengiriman')->where('status', 1)->where('updated_at', 'like', date("Y").'-04%')->get();
        $bulan_mei = DB::table('status_pengiriman')->where('status', 1)->where('updated_at', 'like', date("Y").'-05%')->get();
        $bulan_juni = DB::table('status_pengiriman')->where('status', 1)->where('updated_at', 'like', date("Y").'-06%')->get();
        $bulan_juli = DB::table('status_pengiriman')->where('status', 1)->where('updated_at', 'like', date("Y").'-07%')->get();
        $bulan_agustus = DB::table('status_pengiriman')->where('status', 1)->where('updated_at', 'like', date("Y").'-08%')->get();
        $bulan_september = DB::table('status_pengiriman')->where('status', 1)->where('updated_at', 'like', date("Y").'-09%')->get();
        $bulan_oktober = DB::table('status_pengiriman')->where('status', 1)->where('updated_at', 'like', date("Y").'-10%')->get();
        $bulan_november = DB::table('status_pengiriman')->where('status', 1)->where('updated_at', 'like', date("Y").'-11%')->get();
        $bulan_desember = DB::table('status_pengiriman')->where('status', 1)->where('updated_at', 'like', date("Y").'-12%')->get();

        return view('direktur.laporan.statistik_penerimaan', compact(
            'bulan_januari',
            'bulan_februari',
            'bulan_maret',
            'bulan_april',
            'bulan_mei',
            'bulan_juni',
            'bulan_juli',
            'bulan_agustus',
            'bulan_september',
            'bulan_oktober',
            'bulan_november',
            'bulan_desember'
            ));
    }

    public function laporanAkhir()
    {
        return view('direktur.laporan.laporan_akhir');
    }

    public function createLaporanAkhir(Request $request)
    {
        $awal = $request->input('date_awal');
        $akhir = $request->input('date_akhir');
        $status_pengiriman = StatusPengiriman::where('status', 1)
            ->whereBetween('created_at', [$awal.'%', $akhir.'%'])->get();
        // dd($pengiriman);
        
        return view('direktur.laporan.cetak', compact('status_pengiriman', 'awal', 'akhir'));
    }

}
