<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

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
        return view('/home');
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

    public function direktur()
    {
        return view('layouts.direktur.home');
    }

    public function cabang()
    {
        return view('layouts.cabang.home');
    }

    public function pelanggan()
    {
        return view('layouts.pelanggan.home');
    }
}
