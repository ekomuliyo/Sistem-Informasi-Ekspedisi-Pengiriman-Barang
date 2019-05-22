<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use DB;
use App\Pelanggan;
use App\Ongkir;

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
            'tujuan' => 'required'
            ];
        $customMessage = [
            'required' => 'Harap pilih kota tujuan'
            ];

        $this->validate($request, $rules, $customMessage);

        $estimasi = $request->input('awal') . " - " . $request->input('akhir') . " hari"; 

        $ongkir = new Ongkir();
        $ongkir->asal = $request->get('asal');
        $ongkir->tujuan = $request->get('tujuan');
        $ongkir->estimasi = $estimasi;
        $ongkir->harga = $request->get('harga');
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

        return view('cabang.ongkir.show', compact('ongkir'));
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

        return view('cabang.ongkir.edit', compact('ongkir'));
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

        $rules = [
            'tujuan' => 'required'
            ];
        $customMessage = [
            'required' => 'Harap pilih kota tujuan'
            ];

        $this->validate($request, $rules, $customMessage);

        $estimasi = $request->input('awal') . " - " . $request->input('akhir') . " hari"; 

        $ongkir->update([
            "asal" => $request->get('asal'),
            "tujuan" => $request->get('tujuan'),
            "estimasi" => $estimasi,
            "harga" => $request->get('harga')
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

    public function dataTable()
    {
        $ongkir = Ongkir::query();

        return datatables()->of($ongkir)
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

    public function ongkir()
    {
        $pelanggan_id = Input::get('pelanggan_id');
        $pelanggan = Pelanggan::find($pelanggan_id);
        $kota = $pelanggan->kota;

        $ongkir = Ongkir::where('tujuan', '=' , $kota)->first();
        $ongkir = $ongkir->harga;
        return response()->json($ongkir);
    }
}
