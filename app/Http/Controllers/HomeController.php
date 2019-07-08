<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Pengiriman;
use App\StatusPengiriman;
use Auth;

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
    public function index()
    {
        return view('/');
    }

    public function profilDirektur($id)
    {
        $user = User::findOrFail($id);
        return view('layouts.direktur.profil', compact('user'));
    }

    public function profilCabang($id)
    {
        $user = User::findOrFail($id);
        return view('layouts.cabang.profil', compact('user'));
    }

    public function profilPelanggan($id)
    {
        $user = User::findOrFail($id);

        return view('layouts.pelanggan.profil', compact('user'));
    }

    public function profilKurir($id)
    {
        $user = User::findOrFail($id);
        return view('layouts.kurir.profil', compact('user'));
    }

    public function direktur()
    {
        $pengiriman = Pengiriman::all();
        $status_pengiriman = StatusPengiriman::all()->where('status', 1);
        return view('layouts.direktur.home', compact('pengiriman', 'status_pengiriman'));
    }

    public function direkturDetailPengiriman(){
        return view('layouts.direktur.pengiriman_detail');
    }

    public function direkturDetailPenerimaan(){
        return view('layouts.direktur.penerimaan_detail');
    }

    public function cabang()
    {
        $pengiriman = Pengiriman::all();
        $status_pengiriman = StatusPengiriman::all()->where('status', 1);
        return view('layouts.cabang.home', compact('pengiriman', 'status_pengiriman'));
    }

    public function cabangDetailPengiriman(){
        return view('layouts.cabang.pengiriman_detail');
    }

    public function cabangDetailPenerimaan(){
        return view('layouts.cabang.penerimaan_detail');
    }

    public function kurir()
    {
        $pengiriman = Pengiriman::all();
        $status_pengiriman = StatusPengiriman::all()->where('status', 1);
        return view('layouts.kurir.home', compact('pengiriman', 'status_pengiriman'));
    }

    public function kurirDetailPengiriman(){
        return view('layouts.kurir.pengiriman_detail');
    }

    public function kurirDetailPenerimaan(){
        return view('layouts.kurir.penerimaan_detail');
    }

    public function pelanggan()
    {
        $pengiriman = Pengiriman::all()->where('id_user', Auth::user()->id );
        $status_pengiriman = StatusPengiriman::all()
                            ->where('status', 1)
                            ->where('pengiriman.id_user', Auth::user()->id );
        return view('layouts.pelanggan.home', compact('pengiriman', 'status_pengiriman'));
    }

    public function pelangganDetailPengiriman(){
        return view('layouts.pelanggan.pengiriman_detail');
    }

    public function pelangganDetailPenerimaan(){
        return view('layouts.pelanggan.penerimaan_detail');
    }


}
