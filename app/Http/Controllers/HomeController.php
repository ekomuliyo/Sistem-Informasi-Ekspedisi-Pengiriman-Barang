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

    public function direktur()
    {
        return view('direktur.users.index');
    }

    public function cabang()
    {
        return view('cabang.ongkir.index');
    }
}
