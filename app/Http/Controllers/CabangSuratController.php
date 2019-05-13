<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Surat;
use App\User;
use App\Kurir;
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
            "tgl_surat" => $request->input('tgl_surat')
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

        return view('cabang.surat.show', compact('surat'));
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
        $surat = Surat::findOrFail($id);

        $surat->keterangan = $request->input('keterangan');
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

    public function dataTable()
    {
        $surat = Surat::with(['kurir.user'])->select('surat.*')
                ->orderBy(DB::raw("DATE_FORMAT(tgl_surat, '%d-%M-%Y')"));


        return datatables()->of($surat)
        ->addColumn('action', function ($surat){
            return view('layouts.cabang.partials._action', [
                'model' => $surat,
                'show_url' => route('cabang.surat.show', $surat->id),
                'edit_url' => route('cabang.surat.edit', $surat->id),
                'delete_url' => route('cabang.surat.destroy', $surat->id)
            ]);
        })
        ->rawColumns(['action'])
        ->make(true);
    }
}
