<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pelanggan;

class CabangPelangganController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $pelanggan = Pelanggan::all();

        return view('cabang.pelanggan.index', compact('pelanggan'));
    }

    public function show($id)
    {
        $pelanggan = Pelanggan::findOrFail($id);

        return view('cabang.pelanggan.show', compact('pelanggan'));
    }

    public function dataTable()
    {
        $pelanggan = Pelanggan::with('user')->select('pelanggan.*');

        return datatables()->of($pelanggan)
            ->addIndexColumn()
            ->addColumn('action', function($pelanggan){
                return '<a href="' . route('cabang.pelanggan.show',$pelanggan->id) . '" class="btn btn-sm btn-outline-info" style="padding-bottom: 0px; padding-top: 0px;">
                        Tampilkan
                        <span class="btn-label btn-label-right"><i class="fa fa-eye"></i></span></a>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

}
