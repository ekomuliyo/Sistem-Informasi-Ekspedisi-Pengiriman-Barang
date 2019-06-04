<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Kurir;

class KurirUsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function update(Request $request, $id)
    {
        // dd($request->all());

        $user = User::findOrFail($id);
        $kurir = Kurir::where('id_user', $user->id);
        
        $foto = $request->get('foto') ? $request->get('foto') : '/images/user-icon.png';
        $password = $request->get('password') ? bcrypt($request->get('password')) : $user->password;
        $user->update([
            'nama' => $request->input('nama'),
            'email' => $request->input('email'),
            'password' => $password,
            'foto' => $foto,
            ]);
            
        $kurir->update([
            'no_hp' => $request->input('kurir')['no_hp'],
            'alamat' => $request->input('kurir')['alamat'],
            'nama_kendaraan' => $request->input('kurir')['nama_kendaraan'],
            'nomor_polisi' => $request->input('kurir')['nomor_polisi']
        ]);
        
        return redirect()->back()->with('alert', 'Data profil berhasil diubah!');
    }
}
