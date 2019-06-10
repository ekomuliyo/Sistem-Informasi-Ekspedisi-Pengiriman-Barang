<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Pengiriman;
use App\Koli;
use App\StatusPengiriman;
use App\User;
use App\Kota;
use App\DetailStatusPengiriman;
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
        return view('cabang.pengiriman.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // handel berat berdasarkan kg / volume
        if ($request->input('berat_kg') == null && $request->input('jumlah_biaya_kg') == null) {
            $berat = $request->input('berat_volume');
            $jumlah_biaya = $request->input('jumlah_biaya_volume');
        }else{
            $berat = $request->input('berat_kg');
            $jumlah_biaya = $request->input('jumlah_biaya_kg');
        }
        
        // mengambil angka random 6 angka untuk nomor resi
        $no_resi = sprintf("%06d", mt_rand(1, 999999));

        $pengiriman = new Pengiriman();
        
        // input ke tabel pengiriman
        $pengiriman->no_resi = $no_resi;
        $pengiriman->nama_pengirim = $request->input('nama_pengirim');
        $pengiriman->no_hp_pengirim = $request->input('no_hp_pengirim');
        $pengiriman->id_kecamatan_pengirim = $request->input('id_kecamatan_pengirim');
        $pengiriman->alamat_pengirim = $request->input('alamat_pengirim');
        $pengiriman->nama_penerima = $request->input('nama_penerima');
        $pengiriman->no_hp_penerima = $request->input('no_hp_penerima');
        $pengiriman->id_kecamatan_penerima = $request->input('id_kecamatan_penerima');
        $pengiriman->alamat_penerima = $request->input('alamat_penerima');
        $pengiriman->metode_pembayaran = $request->input('metode_pembayaran');
        $pengiriman->berat = $berat;
        $pengiriman->jumlah_biaya = $jumlah_biaya;
        $pengiriman->status_valid = true;
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
        
        return redirect()->route('cabang.pengiriman.index')->with('alert', 'Data berhasil ditambahkan!');
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
        $kota = Kota::all();
        $koli = Koli::all()->where('id_pengiriman', $pengiriman->id);

        return view('cabang.pengiriman.edit', compact('pengiriman', 'kota', 'koli'));
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
        // dd($request->all());
        // handle berat dan jumlah biya berdasarkan kg / volume
        if ($request->input('berat_kg') == null && $request->input('jumlah_biaya_kg') == null) {
            $berat = $request->input('berat_volume');
            $jumlah_biaya = $request->input('jumlah_biaya_volume');
        }else{
            $berat = $request->input('berat_kg');
            $jumlah_biaya = $request->input('jumlah_biaya_kg');
        }
        
        $pengiriman = Pengiriman::findOrFail($id);
        
        // mengubah data dari tabel pengiriman
        $pengiriman->nama_pengirim = $request->input('nama_pengirim');
        $pengiriman->no_hp_pengirim = $request->input('no_hp_pengirim');
        $pengiriman->id_kecamatan_pengirim = $request->input('id_kecamatan_pengirim');
        $pengiriman->alamat_pengirim = $request->input('alamat_pengirim');
        $pengiriman->nama_penerima = $request->input('nama_penerima');
        $pengiriman->no_hp_penerima = $request->input('no_hp_penerima');
        $pengiriman->id_kecamatan_penerima = $request->input('id_kecamatan_penerima');
        $pengiriman->alamat_penerima = $request->input('alamat_penerima');
        $pengiriman->metode_pembayaran = $request->input('metode_pembayaran');
        $pengiriman->berat = $berat;
        $pengiriman->jumlah_biaya = $jumlah_biaya;
        $pengiriman->save();
        
        $id_pengiriman = $pengiriman->id; // mengambil id pengiriman setelah di ubah

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


    public function createStatusBarang()
    {
        $id_pengiriman = Input::get('id_pengiriman');
        $status_pengiriman = StatusPengiriman::with('pengiriman.kecamatan_penerima.kota')
                            ->where('status_pengiriman.id_pengiriman', $id_pengiriman)
                            ->where('status_pengiriman.status', 0)->first();
        if ($status_pengiriman) {
            return response()->json([
                'pesan' =>  'data json berhasil didapatkan',
                'kode' => 1,
                'data' => $status_pengiriman
                ]);
        }
        return response()->json([
            'pesan' => 'data json tidak ada',
            'kode' => 0,
            'data' => $status_pengiriman
        ]);
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
        $status_pengiriman = StatusPengiriman::where('id_pengiriman', $id_pengiriman)->first();
        $status_pengiriman->update(['status' => $status]);

        $id_status_pengiriman = $status_pengiriman->id;

        // menyimpan ke tabel detail_status_pengiriman
        $detail_status = new DetailStatusPengiriman ();
        $detail_status->id_status_pengiriman = $id_status_pengiriman;
        $detail_status->keterangan = $keterangan;
        $detail_status->id_user = Auth::user()->id;
        $detail_status->save();

        // mencari nomor pelanggan penerima dari id_pengiriman yang baru di masukan
        $pengiriman = Pengiriman::find($id_pengiriman);

        // format nomor hp di ubah dari awal 08 menjadi 628, sesuai dengan format nomor seluler di indonesia
        $no = $pengiriman->no_hp_penerima;
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

    public function createStatus($id)
    {
        $pengiriman = Pengiriman::where('id', $id)->get();
        return view('cabang.pengiriman.validasi', compact('pengiriman'));
    }

    public function storeStatus(Request $request)
    {
        $id_pengiriman = $request->id_pengiriman;
        $pengiriman = Pengiriman::findOrFail($id_pengiriman);
        $validasi = $request->validasi;

        if ($validasi == 1) {
            if($pengiriman->metode_pembayaran == 2){
                $pengiriman->update([
                    'status_valid' => $validasi,
                    'status_bayar' => false
                ]);
            }else if($pengiriman->metode_pembayaran == 4){
                $pengiriman->update([
                    'status_valid' => $validasi,
                    'status_bayar' => false
                ]);
            }else{
                $pengiriman->update([
                    'status_valid' => $validasi,
                    'status_bayar' => true
                ]);
            }
            return redirect()->route('cabang.pengiriman.index')->with('alert', 'Data berhasil divalidasi!');
        }else{
            return redirect()->route('cabang.pengiriman.index')->with('alert', 'Data gagal divalidasi!');
        }
    }

    public function dataTable()
    {

        $pengiriman = Pengiriman::with('kecamatan_penerima.kota')->select('pengiriman.*');

        return datatables()->eloquent($pengiriman)
        ->addIndexColumn()
        ->addColumn('ubah', function($pengiriman){
            return '<a href="'. route('cabang.pengiriman.edit', $pengiriman->id) . '" class="btn btn-sm btn-outline-secondary" style="padding-bottom: 0px; padding-top: 0px;">
            Ubah
            <span class="btn-label btn-label-right"><i class="fa fa-edit"></i></span></a>';
        })
        ->addColumn('action_status', function ($pengiriman){
            if($pengiriman->status_valid == 1){
                return '<a href="#" class="btn btn-sm btn-success" style="padding-bottom: 0px; padding-top: 0px;">Valid<span class="btn-label btn-label-right"></span></a>';
            }
            else {
                return '<label>Belum Valid</label> <a href="' . route('cabang.pengiriman.status.create', $pengiriman->id) . '" class="btn btn-sm btn-warning" style="padding-bottom: 0px; padding-top: 0px;">Validasi<span class="btn-label btn-label-right"><i class="fa fa-check"></i></span></a>';
            }
        })
        ->rawColumns(['ubah', 'action_status'])
        ->make(true);
    }
}
