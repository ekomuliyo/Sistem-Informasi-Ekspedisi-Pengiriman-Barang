<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Ongkir;
use App\Pengiriman;
Use Alert;
use App\Cabang;

class BerandaController extends Controller
{
    public function cekResi(Request $request){
        $cabang = Cabang::with('user')->get();
        $no_resi = $request->no_resi;
        $pengiriman = Pengiriman::with('status_pengiriman')->where('no_resi', $no_resi)->get();
        if ($pengiriman->isEmpty()) {
            Alert::warning('Terjadi kesalahan!', 'Nomor resi salah!, tidak ditemukan');
            return view('welcome_resi', compact('pengiriman', 'cabang'));
        }
        else{
            return view('welcome_resi', compact('pengiriman', 'cabang'));
        }
    }

    public function cekTarif(Request $request){

        $cabang = Cabang::with('user')->get();

        // handle berat dari kg atau volume
        if ($request->berat_kg == null) {
            $berat = $request->berat_volume;
        }else{
            $berat = $request->berat_kg;
        }

        $ongkir = Ongkir::where('id_kecamatan', $request->tujuan)->get();
        $dari = $request->asal;
        $kota = $ongkir[0]->kecamatan->kota->nama;
        $kecamatan = $ongkir[0]->kecamatan->nama;
        $estimasi = $ongkir[0]->estimasi;
        $tarif = $berat * $ongkir[0]->harga;


        if($ongkir->isEmpty()){
            return redirect()->back();            
        }else{
            $data = array(
                'dari' => $dari,
                'tujuan' => "Kota " . $kota . ", " . $kecamatan,
                'berat' => $berat,
                'estimasi' => $estimasi,
                'tarif' => $tarif
            );
            return view('welcome_tarif', compact('data', 'cabang'));
        }
    }

    public function jsonKecamatan(Request $request){
        if($request->has('q')){
            $cari = $request->q;
            $data = DB::table('kecamatan')->select('id', 'nama')
                        ->where('nama', 'LIKE', "%$cari%")->get();
            return response()->json($data);
        }
    }
}
