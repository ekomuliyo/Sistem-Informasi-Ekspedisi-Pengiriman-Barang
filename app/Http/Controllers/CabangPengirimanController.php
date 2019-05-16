<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Surat;
use App\Pelanggan;
use App\Pengiriman;
use App\Koli;
use App\StatusPengiriman;
use Auth;

class CabangPengirimanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('cabang.pengiriman.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $surat = Surat::all();
        $pelanggan = Pelanggan::all();
        return view('cabang.pengiriman.create', compact('surat', 'pelanggan'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $pengiriman = new Pengiriman();
        
        // input ke tabel pengiriman
        $pengiriman->id_surat = $request->input('id_surat');
        $pengiriman->id_pengirim = $request->input('id_pengirim');
        $pengiriman->id_penerima = $request->input('id_penerima');
        $pengiriman->metode_pembayaran = $request->input('metode_pembayaran');
        $pengiriman->berat = $request->input('berat');
        $pengiriman->jumlah_biaya = $request->input('jumlah_biaya');
        $pengiriman->status = true;
        $pengiriman->save();

        $id_pengiriman = $pengiriman->id; // mengambil id pengiriman setelah di input
        
        // input ke tabel koli sesuai dengan jumlah koli
        $arrayKoli = $request->input('koli');
        for ($i=0; $i < count($arrayKoli); $i++) { 
            $koli = new Koli();
            $koli->id_pengiriman = $id_pengiriman;
            $koli->deskripsi = $arrayKoli[$i];
            $koli->save();
        }

        // input ke tabel status_pengiriman
        $keterangan = "Paket kargo dalam proses packing di jakarta";
        $status_pengiriman = new StatusPengiriman(); 
        $status_pengiriman->id_pengiriman = $id_pengiriman;
        $status_pengiriman->keterangan = $keterangan;
        $status_pengiriman->id_user = Auth::user()->id;
        $status_pengiriman->save();

        return redirect()->route('cabang.pengiriman.index')->with('alert', 'Data berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function dataTable()
    {

        $pengiriman = Pengiriman::with('pelangganPengirim.user', 'pelangganPenerima.user')->select('pengiriman.*');

        return datatables()->of($pengiriman)
        ->addColumn('action', function ($pengiriman){
            return view('layouts.cabang.partials._action', [
                'model' => $pengiriman,
                'show_url' => route('cabang.pengiriman.show', $pengiriman->id),
                'edit_url' => route('cabang.pengiriman.edit', $pengiriman->id),
                'delete_url' => route('cabang.pengiriman.destroy', $pengiriman->id)
            ]);
        })
        ->rawColumns(['action'])
        ->make(true);
    }
}
