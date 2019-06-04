<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Pengiriman;
use App\StatusPengiriman;
use Auth;
use DB;

class KurirStatusPengirimanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('kurir.status_pengiriman.index');
    }

    
    public function createStatusBarang()
    {
        $id_pengiriman = Input::get('id_pengiriman');
        $pengiriman = Pengiriman::with('pelanggan_pengirim.user', 'pelanggan_penerima.user')->where('id', $id_pengiriman)->first();
        return response()->json($pengiriman);
    }
    
    public function store(Request $request)
    {
        $nama_penerima = $request->input('nama_penerima');
        $id_pengiriman = $request->input('id_pengiriman');

        $status_pengiriman = new StatusPengiriman();
        $status_pengiriman->id_pengiriman = $id_pengiriman;
        $status_pengiriman->keterangan = "Barang diterima oleh pelanggan" . ", " . $nama_penerima . " [" . Auth::user()->nama . "]";
        $status_pengiriman->status = true;
        $status_pengiriman->id_user = Auth::user()->id;

        $status_pengiriman->save();

        return redirect()->back()->with('alert', 'Data berhasil diterima!');
    }

    public function dataTable()
    {
        $pengiriman = Pengiriman::with('surat', 'pelanggan_pengirim.user', 'pelanggan_penerima.user', 'status_pengiriman')->select('pengiriman.*');
        return datatables()->eloquent($pengiriman)->make(true);
    }

}
