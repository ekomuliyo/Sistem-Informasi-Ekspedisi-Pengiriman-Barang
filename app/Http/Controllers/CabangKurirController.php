<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Kurir;
use App\User;
use Datatables;

class CabangKurirController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('cabang.kurir.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cabang.kurir.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'nama' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6'
        ]);

        
        $request['password'] = bcrypt($request->get('password'));
        $request['foto'] = $request->get('foto') ? $request->get('foto') : '/images/user-icon.png';
        
        User::create($request->all());
        
        $id = User::select('id')->where('email', $request->email)->get(); // mendapatkan id email dari yang baru di input
        $id_user = json_decode($id, true);

        $kurir = new Kurir();
        $kurir->no_hp = $request->input('no_hp');
        $kurir->alamat = $request->input('alamat');
        $kurir->nama_kendaraan = $request->input('nama_kendaraan');
        $kurir->nomor_polisi = $request->input('nomor_polisi');
        $kurir->id_user = $id_user[0]["id"];
        $kurir->save();

        return redirect()->route('cabang.kurir.index')->with('alert', 'Berhasil Ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $kurir = Kurir::findOrFail($id);

        return view('cabang.kurir.show', compact('kurir'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $kurir = Kurir::findOrFail($id);
        
        return view('cabang.kurir.edit', compact('kurir'));
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

        $this->validate($request, [
            'email' => 'required|string|email|max:255|unique:users,email,' . $id
        ]);

        $kurir = Kurir::findOrFail($id);
        $user = User::findOrFail($kurir->id_user);
        $input = $request->all();

        $kurir->update([
            'no_hp' => $input['no_hp'],
            'alamat' => $input['alamat'],
            'nama_kendaraan' => $input['nama_kendaraan'],
            'nomor_polisi' => $input['nomor_polisi'],
        ]);

        $user->update([
            'nama' => $input['nama'],
            'email' => $input['email'],
        ]);

        return redirect()->route('cabang.kurir.index')->with('alert', 'Berhasil Diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $kurir = Kurir::findOrFail($id);
        $kurir->delete();
        return redirect()->back()->with('alert', 'Berhasil Dihapus!');
    }

    public function dataTable()
    {
        $kurir = Kurir::with('user')->select('kurir.*');

        return datatables()->of($kurir)
            ->addColumn('action', function ($kurir){
                return view('layouts.cabang.partials._action', [
                    'model' => $kurir,
                    'show_url' => route('cabang.kurir.show', $kurir->id),
                    'edit_url' => route('cabang.kurir.edit', $kurir->id),
                    'delete_url' => route('cabang.kurir.destroy', $kurir->id)
                ]);
            })
            ->rawColumns(['action'])
            ->make(true);
    }
}
