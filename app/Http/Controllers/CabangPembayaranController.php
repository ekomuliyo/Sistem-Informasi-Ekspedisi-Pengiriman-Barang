<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pengiriman;
use DB;
use DataTables;

class CabangPembayaranController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('cabang.pembayaran.index');
    }

    public function createPembayaran($id)
    {
        $pengiriman = Pengiriman::where('id_user', $id)
                        ->where('metode_pembayaran', 4)
                        ->where('status_surat', 1)->get();

        if( $pengiriman->isEmpty()){
            return redirect()->back()->with('alert', 'Data tidak bisa dibayar!');
        }else{
            return view('cabang.pembayaran.create', compact('pengiriman'));
        } 
    }

    public function update(Request $request, $id)
    {
        $pengiriman = Pengiriman::where('id_user', $id)->where('status_bayar', 0)->get();
        $jumlah_bayar = $request->input('jumlah_bayar');

        foreach($pengiriman as $d){
            $id =  $d->id;
            $pengiriman_update = Pengiriman::findOrFail($id);
            $pengiriman_update->jumlah_bayar = $jumlah_bayar;
            $pengiriman_update->status_bayar = true;
            $pengiriman_update->save();
        }

        return redirect()->route('cabang.pembayaran.index')->with('alert', 'Data berhasil dibayar!');
    }

    public function dataTable()
    {
        $pengiriman = DB::select('SELECT users.nama, pengiriman.id_user,     pengiriman.status_bayar, COUNT(pengiriman.id_user) as total_pengiriman, SUM(pengiriman.jumlah_biaya) as total_bayar 
            FROM `pengiriman` INNER JOIN users ON pengiriman.id_user = users.id 
            WHERE pengiriman.metode_pembayaran = 4 GROUP BY pengiriman.id_user, pengiriman.status_bayar');

        return DataTables::of($pengiriman)
            ->addIndexColumn()
            ->addColumn('action_bayar', function($pengiriman){
                if ($pengiriman->status_bayar == 0) {
                    return '<lable>Belum Bayar</lable> <a href="' . route('cabang.pembayaran.create', $pengiriman->id_user) . '" class="btn btn-sm btn-warning" style="padding-bottom: 0px; padding-top: 0px;">Bayar<span class="btn-label btn-label-right"><i class="fa fa-money"></i></span></a>';
                }else{
                    return '<lable>Lunas</lable>';
                }
            })
            ->rawColumns(['action_bayar'])    
            ->make(true);
    }
}
