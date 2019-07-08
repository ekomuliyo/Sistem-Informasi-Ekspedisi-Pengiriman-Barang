<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
use App\Ongkir;
use App\Kecamatan;
use App\Kota;

class CabangOngkirController extends Controller
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
        return view('cabang.ongkir.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cabang.ongkir.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $rules = [
            'id_kota' => 'required',
            'id_kecamatan' => 'required|unique:ongkir'
            ];
        $customMessage = [
            'required' => 'Harap pilih kota!',
            'unique' => 'Data ongkir daerah tersebut sudah ada!'
            ];

        $this->validate($request, $rules, $customMessage);

        $estimasi = $request->input('awal') . " - " . $request->input('akhir') . " hari"; 

        $ongkir = new Ongkir();
        $ongkir->asal = "Jakarta Pusat";
        $ongkir->id_kecamatan = $request->get('id_kecamatan');
        $ongkir->estimasi = $estimasi;
        $ongkir->harga = str_replace('.', '', $request->get('harga'));
        $ongkir->save();

        return redirect()->route('cabang.ongkir.index')->with('alert', 'Berhasil ditambahan!');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $ongkir = Ongkir::findOrFail($id);

        return view('cabang.ongkir.show', compact('ongkir', 'kota'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $ongkir = Ongkir::findOrFail($id);

        $kota = Kota::all();

        return view('cabang.ongkir.edit', compact('ongkir', 'kota'));
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
        $ongkir = Ongkir::findOrFail($id);

        $estimasi = $request->input('awal') . " - " . $request->input('akhir') . " hari"; 
        
        $ongkir->update([
            "estimasi" => $estimasi,
            "harga" => $request->input('harga')
        ]);

        return redirect()->route('cabang.ongkir.index')->with('alert', 'Berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $ongkir = Ongkir::findOrFail($id);
        $ongkir->delete();

        return redirect()->back()->with('alert', 'Berhasil dihapus!');
    }

    public function ongkir($id)
    {
        $ongkir = Ongkir::where('id_kecamatan', $id)->get()->pluck('harga');
        return response()->json($ongkir);
    }

    public function kecamatanPenerima($id)
    {
        $kecamatan = Kecamatan::where('id_kota', $id)->get()->pluck('nama', 'id');
        return $kecamatan;
    }

    public function kecamatan($id)
    {
        $kecamatan = Kecamatan::where('id_kota', $id)->get()->pluck('nama', 'id');
        return $kecamatan;
    }

    public function dataTable()
    {
        $ongkir = Ongkir::with('kecamatan.kota')->select('ongkir.*');

        return datatables()->eloquent($ongkir)
            ->addIndexColumn()
            ->addColumn('action', function ($ongkir){
                return view('layouts.cabang.partials._action', [
                    'model' => $ongkir,
                    'show_url' => route('cabang.ongkir.show', $ongkir->id),
                    'edit_url' => route('cabang.ongkir.edit', $ongkir->id),
                    'delete_url' => route('cabang.ongkir.destroy', $ongkir->id)
                ]);
            })
            ->rawColumns(['action'])
            ->make(true);
    }

}
