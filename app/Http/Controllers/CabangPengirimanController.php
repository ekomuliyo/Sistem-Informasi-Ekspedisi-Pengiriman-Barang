<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Surat;
use App\Pelanggan;
use App\Pengiriman;
use App\Koli;
use App\StatusPengiriman;
use App\User;
use DB;
use Auth;

class CabangPengirimanController extends Controller
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
        return view('cabang.pengiriman.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $surat = Surat::all();
        $pelanggan = Pelanggan::all()->where('id', '!=', '1');
        return view('cabang.pengiriman.create', compact('surat', 'pelanggan'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // hanle berat berdasarkan kg / volume
        if ($request->input('berat_kg') == null && $request->input('jumlah_biaya_kg') == null) {
            $berat = $request->input('berat_volume');
            $jumlah_biaya = $request->input('jumlah_biaya_volume');
        }else{
            $berat = $request->input('berat_kg');
            $jumlah_biaya = $request->input('jumlah_biaya_kg');
        }
        
        $pengiriman = new Pengiriman();
        
        // input ke tabel pengiriman
        $pengiriman->id_surat = $request->input('id_surat');
        $pengiriman->id_pengirim = $request->input('id_pengirim');
        $pengiriman->id_penerima = $request->input('id_penerima');
        $pengiriman->metode_pembayaran = $request->input('metode_pembayaran');
        $pengiriman->berat = $berat;
        $pengiriman->jumlah_biaya = $jumlah_biaya;
        $pengiriman->status = true;
        $pengiriman->save();

        $id_pengiriman = $pengiriman->id; // mengambil id pengiriman setelah di input

        
        
        // input ke tabel koli sesuai dengan jumlah koli
        $arrayKoli = $request->input('koli');
        for ($i=0; $i < count($arrayKoli); $i++) { 
            $koli = new Koli();
            $koli->id_pengiriman = $id_pengiriman;
            $koli->deskripsi = $arrayKoli[$i];
            $koli->save();
        }
        
        // mengirim pesan ke wa pelanggan setelah input data,
        // format nomor hp di ubah dari awal 08 menjadi 628, sesuai dengan format nomor seluler di indonesia
        $no = $pengiriman->pelanggan_penerima->no_hp;
        $prefix = '0';
        $str = $no;
        if (substr($str, 0, strlen($prefix)) == $prefix) {$str = substr($str, strlen($prefix));}
        $no_wa_penerima = "62".$str;

        
        // input ke tabel status_pengiriman
        $keterangan = "Barang dalam proses packing di cabang jakarta";
        $status_pengiriman = new StatusPengiriman(); 
        $status_pengiriman->id_pengiriman = $id_pengiriman;
        $status_pengiriman->keterangan = $keterangan;
        $status_pengiriman->id_user = Auth::user()->id;
        $status_pengiriman->save();
        
        // mengirim pesan ke wa
        $my_apikey = "738ZKMREU3Q7S2CHDFDH"; 
        $destination = $no_wa_penerima; 
        $message = $keterangan; 
        $api_url = "http://panel.apiwha.com/send_message.php"; 
        $api_url .= "?apikey=". urlencode ($my_apikey); 
        $api_url .= "&number=". urlencode ($destination); 
        $api_url .= "&text=". urlencode ($message); 
        $my_result_object = json_decode(file_get_contents($api_url, false)); 


        return redirect()->route('cabang.pengiriman.index')->with('alert', 'Data berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pengiriman = Pengiriman::findOrFail($id);
        return view('cabang.pengiriman.show', compact('pengiriman'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pengiriman = Pengiriman::findOrFail($id);
        $surat = Surat::all();
        $pelanggan = Pelanggan::all()->where('id', '!=', 1);
        $koli = Koli::all()->where('id_pengiriman', $pengiriman->id);

        return view('cabang.pengiriman.edit', compact('pengiriman', 'surat', 'pelanggan', 'koli'));
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
        // handle berat dan jumlah biya berdasarkan kg / volume
        if ($request->input('berat_kg') == null && $request->input('jumlah_biaya_kg') == null) {
            $berat = $request->input('berat_volume');
            $jumlah_biaya = $request->input('jumlah_biaya_volume');
        }else{
            $berat = $request->input('berat_kg');
            $jumlah_biaya = $request->input('jumlah_biaya_kg');
        }
        
        $pengiriman = Pengiriman::findOrFail($id);
        $id_pengiriman = $pengiriman->id; // mengambil id pengiriman setelah di ubah
        
        // mengubah data dari tabel pengiriman
        $pengiriman->id_surat = $request->input('id_surat');
        $pengiriman->id_pengirim = $request->input('id_pengirim');
        $pengiriman->id_penerima = $request->input('id_penerima');
        $pengiriman->metode_pembayaran = $request->input('metode_pembayaran');
        $pengiriman->berat = $berat;
        $pengiriman->jumlah_biaya = $jumlah_biaya;
        $pengiriman->status = true;
        $pengiriman->save();


        // mengubah data koli
        $arrayKoli = $request->input('koli');
        $koli = Koli::all()->where('id_pengiriman', $id_pengiriman);
        $i = 0;
        foreach ($koli as $key => $value) {
            DB::table('koli')->where('id', $value->id)->update([
            'deskripsi' => $arrayKoli[$i]
            ]);
            $i++;
        }
        
        return redirect()->route('cabang.pengiriman.index')->with('alert', 'Data berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pengiriman = Pengiriman::findOrFail($id);

        $pengiriman->delete();

        return redirect()->back()->with('alert', 'Data berhasil dihapus!');
    }

    public function createStatusBarang()
    {
        $id_pengiriman = Input::get('id_pengiriman');
        $pengiriman = Pengiriman::with('pelanggan_pengirim.user', 'pelanggan_penerima.user')->where('id', $id_pengiriman)->first();
        return response()->json($pengiriman);
    }

    public function storeStatusBarang(Request $request)
    {
        // menghandel apakah status barang sudah diterima atau belum
        // jika sudah diterima maka status pengiriman bernilai true
        if ($request->input('nama_penerima')) {
            $status = true;
        }else{
            $status = false;
        }

        $id_pengiriman = $request->input('id_pengiriman');
        $keterangan = $request->input('keterangan') . ", " . $request->input('nama_penerima') . " [" . Auth::user()->nama . "]";

        // menyimpan ke tabel status_pengiriman
        $status_pengiriman = new StatusPengiriman();

        $status_pengiriman->id_pengiriman = $id_pengiriman;
        $status_pengiriman->keterangan = $keterangan;
        $status_pengiriman->id_user = Auth::user()->id;
        $status_pengiriman->status = $status;
        $status_pengiriman->save();


        // mencari nomor pelanggan penerima dari id_pengiriman yang baru di masukan
        $pengiriman = Pengiriman::find($id_pengiriman);

        // format nomor hp di ubah dari awal 08 menjadi 628, sesuai dengan format nomor seluler di indonesia
        $no = $pengiriman->pelanggan_penerima->no_hp;
        $prefix = '0';
        $str = $no;
        if (substr($str, 0, strlen($prefix)) == $prefix) {$str = substr($str, strlen($prefix));}
        $no_wa_penerima = "62".$str;

        // mengirim pesan ke wa
        $my_apikey = "738ZKMREU3Q7S2CHDFDH"; 
        $destination = $no_wa_penerima; 
        $message = $keterangan; 
        $api_url = "http://panel.apiwha.com/send_message.php"; 
        $api_url .= "?apikey=". urlencode ($my_apikey); 
        $api_url .= "&number=". urlencode ($destination); 
        $api_url .= "&text=". urlencode ($message); 
        $my_result_object = json_decode(file_get_contents($api_url, false));
        
        return redirect()->back()->with('alert', 'Status pengiriman barang berhasil diperbarui!');
    }

    public function dataTable()
    {

        $pengiriman = Pengiriman::with('pelanggan_pengirim.user', 'pelanggan_penerima.user')->select('pengiriman.*');

        return datatables()->eloquent($pengiriman)
        ->addColumn('action', function ($pengiriman){
            return view('layouts.cabang.partials._action', [
                'model' => $pengiriman,
                'show_url' => route('cabang.pengiriman.show', $pengiriman->id),
                'edit_url' => route('cabang.pengiriman.edit', $pengiriman->id),
                'delete_url' => route('cabang.pengiriman.destroy', $pengiriman->id)
            ]);
        })
        ->rawColumns(['action'])
        ->make(true);
    }
}
