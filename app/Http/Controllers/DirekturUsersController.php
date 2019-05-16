<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Datatables;
use DB;

class DirekturUsersController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        
        $request['foto'] = $request->get('foto') ? $request->get('foto') : '/images/user-icon.png';
        $request['password'] = $request->get('password') ? bcrypt($request->get('password')) : $user->password;

        $user->update($request->all());

        return redirect()->back()->with('alert', 'Data profil berhasil diubah!');
    }

}
