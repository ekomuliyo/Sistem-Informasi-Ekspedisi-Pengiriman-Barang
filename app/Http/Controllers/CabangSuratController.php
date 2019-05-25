<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Surat;
use App\User;
use App\Kurir;
use App\Pengiriman;
use DB;

class CabangSuratController extends Controller
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
        return view('cabang.surat.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $nomor_surat ;
        $surat = Surat::all()->sortByDesc('id')->first();

        if($surat == null){
            $nomor_surat = 1;
        }else{
            $nomor_surat = $surat->id + 1;
        }

        $kurir = Kurir::all();
        
        
        return view('cabang.surat.create', compact('nomor_surat', 'kurir'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        Surat::create([
            "nomor_surat" => $request->input('nomor_surat'),
            "id_kurir" => $request->input('id_kurir'),
            "tgl_surat" => $request->input('tgl_surat'),
            "keterangan" => "Surat dalam perjalanan menuju Palembang"
        ]);

        return redirect()->route('cabang.surat.index')->with('alert', 'Berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $surat = Surat::findOrFail($id);
        $pengiriman = Pengiriman::all()->where('id_surat', $id);

        return view('cabang.surat.show', compact('surat', 'pengiriman'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $surat = Surat::findOrFail($id);
        $kurir = Kurir::all();

        return view('cabang.surat.edit', compact('surat', 'kurir'));
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
        dd($request->all());
        $surat = Surat::findOrFail($id);

        
        $nomor_surat = $request->input('nomor_surat') ? $request->input('nomor_surat') : $surat->nomor_surat;
        $id_kurir = $request->input('id_kurir') ? $request->input('id_kurir') : $surat->id_kurir;
        $tgl_surat = $request->input('tgl_surat') ? $request->input('tgl_surat') : $surat->tgl_surat;
        $keterangan = $request->input('keterangan') ? $request->input('keterangan') : $surat->keterangan;

        $surat->nomor_surat = $nomor_surat;
        $surat->id_kurir = $id_kurir;
        $surat->tgl_surat = $tgl_surat;

        $surat->save();

        return redirect()->route('cabang.surat.index')->with('alert', 'Berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $surat = Surat::findOrFail($id);
        $surat->delete();

        return redirect()->back()->with('alert', 'Berhasil dihapus!');
    }

    public function cetak($id)
    {
        $pengiriman = Pengiriman::all()->where('id_surat', $id);
        return view('cabang.surat.cetak', compact('pengiriman'));
    }

    public function perbarui($id)
    {
        $surat = Surat::findOrFail($id);
        $pengiriman = Pengiriman::where('id_surat', $id)->get();
        return view('cabang.surat.perbarui', compact('surat', 'pengiriman'));
    }

    public function dataTable()
    {
        $surat = Surat::with('kurir.user')->select('surat.*');

        return datatables()->of($surat)
        ->addColumn('action', function ($surat){
            return view('layouts.cabang.partials._action', [
                'model' => $surat,
                'show_url' => route('cabang.surat.show', $surat->id),
                'edit_url' => route('cabang.surat.edit', $surat->id),
                'delete_url' => route('cabang.surat.destroy', $surat->id)
            ]);
        })
        ->addColumn('cetak', function ($surat){
            return '<a href="' . route('cabang.surat.cetak', $surat->id) . '" class="btn btn-sm btn-success" style="padding-bottom: 0px; padding-top: 0px;"><span class="btn-label btn-label-right"><i class="fa fa-print"></i></span></a>';
        })
        ->addColumn('perbarui', function ($surat){
            return '<a href="' . route('cabang.surat.perbarui', $surat->id) . '" class="btn btn-sm btn-info" style="padding-bottom: 0px; padding-top: 0px;"><span class="btn-label btn-label-right"><i class="fa fa-edit"></i></span></a>';
        })
        ->rawColumns(['action', 'cetak', 'perbarui'])
        ->make(true);
    }
}
