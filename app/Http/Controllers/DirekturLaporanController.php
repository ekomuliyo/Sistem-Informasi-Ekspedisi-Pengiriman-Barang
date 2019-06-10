<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\StatusPengiriman;

class DirekturLaporanController extends Controller
{
    public function __contruct()
    {
        return $this->middleware('auth');
    }

    public function statistikPengiriman()
    {
        return view('direktur.laporan.statistik_pengiriman');
    }

    public function statistikPenerimaan()
    {
        return view('direktur.laporan.statistik_penerimaan');
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
