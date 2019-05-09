<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Cabang;
use DataTables;

class DirekturCabangController extends Controller
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
        return view('direktur.cabang.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('direktur.cabang.create');
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

        $cabang = new Cabang();
        $cabang->no_hp = $request->input('no_hp');
        $cabang->alamat = $request->input('alamat');
        $cabang->id_user = $id_user[0]["id"];
        $cabang->save();

        return redirect()->route('direktur.cabang.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $cabang = Cabang::findOrFail($id);
        return view('direktur.cabang.show', compact('cabang'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cabang = Cabang::findOrFail($id);
        return view('direktur.cabang.edit', compact('cabang'));
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

        $cabang = Cabang::findOrFail($id);
        $user = User::findOrFail($cabang->id_user);
        $input = $request->all();

        $cabang->update([
            'alamat' => $input['alamat'],
            'no_hp' => $input['no_hp'],
        ]);
            

        $user->update([
            'nama' => $input['nama'],
            'email' => $input['email'],
        ]);

        return redirect()->route('direktur.cabang.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function status($id)
    {
        $cabang = Cabang::findOrFail($id);

        if($cabang->user->status == true)
        {
            $cabang->user->status = false;
            $cabang->user->update();
        }
        else {
            $cabang->user->status = true;
            $cabang->user->update();
        }

        return redirect()->back();
    }


    public function dataTable()
    {
        $cabang = Cabang::with('user')->select('cabang.*');

        return Datatables::of($cabang)
            ->addColumn('action', function ($cabang){
                return view('layouts.direktur.partials._action', [
                    'model' => $cabang,
                    'show_url' => route('direktur.cabang.show', $cabang->id),
                    'edit_url' => route('direktur.cabang.edit', $cabang->id),
                ]);
            })
            ->addColumn('action_status', function ($cabang){
                    if($cabang->user->status == 1){
                        return '<a href="' . route('direktur.cabang.status', $cabang->id) . '" class="btn btn-sm btn-success" style="padding-bottom: 0px; padding-top: 0px;"> Aktif <span class="btn-label btn-label-right"><i class="fa fa-check"></i></span></a>';
                    }
                    else {
                        return '<a href="' . route('direktur.cabang.status', $cabang->id) . '" class="btn btn-sm btn-warning" style="padding-bottom: 0px; padding-top: 0px;"> Blokir <span class="btn-label btn-label-right"><i class="fa fa-close"></i></span></a>';
                    }
            })
            ->rawColumns(['action', 'action_status'])
            ->make(true);
    }
}
