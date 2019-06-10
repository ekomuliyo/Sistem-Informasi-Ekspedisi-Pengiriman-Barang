<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Kecamatan;
use App\Pengiriman;
use App\Koli;
use Auth;

class PelangganPengirimanController extends Controller
{
    public function __construct()
    {
        return $this->middleware('auth');
    }

    public function index()
    {
        return view('pelanggan.pengiriman.index');
    }

    public function create()
    {
        return view('pelanggan.pengiriman.create');
    }

    public function store(Request $request)
    {
        
        // handel berat berdasarkan kg / volume
        if ($request->input('berat_kg') == null && $request->input('jumlah_biaya_kg') == null) {
            $berat = $request->input('berat_volume');
            $jumlah_biaya = $request->input('jumlah_biaya_volume');
        }else{
            $berat = $request->input('berat_kg');
            $jumlah_biaya = $request->input('jumlah_biaya_kg');
        }

         // mengambil angka random 6 angka untuk nomor resi
         $no_resi = sprintf("%06d", mt_rand(1, 999999));
        
         // mengambil data pengirim dari user yang login skg
         $nama_pengirim = Auth::user()->nama;
         $no_hp_pengirim = Auth::user()->pelanggan->no_hp;
         $id_kecamatan_pengirim = Auth::user()->pelanggan->id_kecamatan;
         $alamat_pengirim = Auth::user()->pelanggan->alamat;

         $pengiriman = new Pengiriman();
         
         // input ke tabel pengiriman
         $pengiriman->no_resi = $no_resi;
         $pengiriman->nama_pengirim = $nama_pengirim;
         $pengiriman->no_hp_pengirim = $no_hp_pengirim;
         $pengiriman->id_kecamatan_pengirim = $id_kecamatan_pengirim;
         $pengiriman->alamat_pengirim = $alamat_pengirim;
         $pengiriman->nama_penerima = $request->input('nama_penerima');
         $pengiriman->no_hp_penerima = $request->input('no_hp_penerima');
         $pengiriman->id_kecamatan_penerima = $request->input('id_kecamatan_penerima');
         $pengiriman->alamat_penerima = $request->input('alamat_penerima');
         $pengiriman->metode_pembayaran = $request->input('metode_pembayaran');
         $pengiriman->berat = $berat;
         $pengiriman->jumlah_biaya = $jumlah_biaya;
         $pengiriman->status_valid = false;
         $pengiriman->status_bayar = false;
         $pengiriman->id_user = Auth::user()->id;
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

         return redirect()->route('pelanggan.pengiriman.index')->with('alert', 'Data berhasil ditambahkan!');
    }

    public function kecamatan($id)
    {
        $kecamatan = Kecamatan::where('id_kota', $id)->get()->pluck('nama', 'id');
        return $kecamatan;
    }

    public function createKonfirmasi($id)
    {
        $pengiriman = Pengiriman::findOrFail($id);
        return view('pelanggan.pengiriman.konfirmasi', compact('pengiriman'));
    }

    public function storeKonfirmasi(Request $request)
    {
        $rules = [
            'foto' => 'required'
            ];
        $customMessage = [
            'required' => 'Anda belum mengupload konfirmasi pembayaran!',
            ];

        $this->validate($request, $rules, $customMessage);

        $id_pengiriman = $request->id_pengiriman;
        $foto = $request->foto;
        $pengiriman = Pengiriman::findOrFail($id_pengiriman);
        $pengiriman->foto = $foto;
        $pengiriman->save();

        return redirect()->route('pelanggan.pengiriman.index')->with('alert', 'Berhasil mengupload konfirmasi pembayaran, kami akan memeriksa konfirmasi pembayaran anda!');
    }

    public function dataTable()
    {
        $pengiriman = Pengiriman::with('kecamatan_penerima.kota')->select('pengiriman.*')
                                    ->where('pengiriman.id_user', Auth::user()->id);

        return datatables()->of($pengiriman)
            ->addIndexColumn()
            ->addColumn('status', function ($pengiriman){
                if($pengiriman->status_valid == 0){
                    if ($pengiriman->metode_pembayaran == 1) {
                        return 'Belum valid';
                    }else if($pengiriman->metode_pembayaran == 2){
                        return 'Belum valid';
                    }
                    elseif ($pengiriman->metode_pembayaran == 3) {
                        return '<a href="'. route('pelanggan.pengiriman.konfirmasi.create', $pengiriman->id) .'" class="btn btn-sm btn-warning" style="padding-bottom: 0px; padding-top: 0px;">Konfirmasi Pembayaran<span class="btn-label btn-label-right"><i class="fa fa-close"></i></span></a>';
                    }else{
                        return 'Belum valid';
                    }
                }
                else {
                    return '<a href="#" class="btn btn-sm btn-success" style="padding-bottom: 0px; padding-top: 0px;">Valid<span class="btn-label btn-label-right"><i class="fa fa-check"></i></span></a>';
                }
            })
            ->addColumn('status_bayar', function($pengiriman){
                if($pengiriman->status_bayar == 0){
                    return '<label>Belum Dibayar</label>';
                }else{
                    return '<label>Lunas</label>';
                }
            })
            ->rawColumns(['status', 'status_bayar'])
            ->make(true);
    }
}