<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
}
