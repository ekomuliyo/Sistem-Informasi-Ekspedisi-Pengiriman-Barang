<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Pelanggan;
class PelangganUsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function update(Request $request, $id)
    {
        // dd($request->all());
        $user = User::findOrFail($id);
        $pelanggan = Pelanggan::where('id_user', $user->id);

        $pelanggan->update([
            'no_hp' => $request->input('pelanggan')['no_hp'],
            'jenis_kelamin' => $request->input('pelanggan')['jenis_kelamin'],
            'tgl_lahir' => $request->input('pelanggan')['tgl_lahir'],
            'id_kecamatan' => $request->input('pelanggan')['id_kecamatan'],
            'alamat' => $request->input('pelanggan')['alamat']
        ]);

        $password = $request->get('password') ? bcrypt($request->get('password')) : $user->password;
        $foto = $request->input('foto');

        $user->update([
            'nama' => $request->input('nama'),
            'email' => $request->input('email'),
            'password' => $password,
            'foto' => $foto,
        ]);

        return redirect()->back()->with('alert', 'Data profil berhasil diubah!');
    }
}
