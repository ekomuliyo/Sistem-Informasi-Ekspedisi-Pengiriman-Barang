<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Surat;
use App\User;
use App\Kurir;
use App\Pengiriman;
use App\TransaksiPengirimanSurat;
use App\StatusPengiriman;
use App\DetailStatusPengiriman;
use Auth;
use DB;
Use Alert;
use Illuminate\Support\Facades\Session;

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

    public function createSurat(){
        $pengiriman = Pengiriman::all()
            ->where('status_surat', 0)
            ->where('status_valid', 1);
        
        return response()->json($pengiriman->values());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $surat = new Surat();
        $surat->nomor_surat = $request->input('nomor_surat');
        $surat->id_kurir = $request->input('id_kurir');
        $surat->tgl_surat = $request->input('tgl_surat');
        $surat->keterangan = "Data surat belum diperbarui!";
        $surat->status_terima = true;
        $surat->save();

        $id_surat = $surat->id;

        $array_pengiriman = $request->input('id_pengiriman');
        for ($i=0; $i < count($array_pengiriman); $i++) { 
            $transaksi = new TransaksiPengirimanSurat();
            $transaksi->id_pengiriman = $array_pengiriman[$i];
            $transaksi->id_surat = $id_surat;
            $transaksi->save();

            $pengiriman = Pengiriman::find($array_pengiriman[$i]);
            // mengubah status surat pengiriman menjadi true
            $pengiriman->update(['status_surat' => true]);

            // mengambil id pengiriman dan nomor penerima pada setiap pengiriman yang dipilih
            $no = $pengiriman->no_hp_penerima;
            $id_pengiriman = $pengiriman->id;
            // // mengirim pesan ke wa penerima setelah input data,
            // format nomor hp di ubah dari awal 08 menjadi 628, sesuai dengan format nomor seluler di indonesia
            $prefix = '0';
            $str = $no;
            if (substr($str, 0, strlen($prefix)) == $prefix) {$str = substr($str, strlen($prefix));}
            $no_wa_penerima = "62".$str;

            $keterangan = "Barang anda dalam proses packing di cabang jakarta, nomor resi: $pengiriman->no_resi";
            // mengirim pesan ke wa
            $my_apikey = config('api_key'); 
            $destination = $no_wa_penerima; 
            $message = $keterangan; 
            $api_url = "http://panel.apiwha.com/send_message.php"; 
            $api_url .= "?apikey=". urlencode ($my_apikey); 
            $api_url .= "&number=". urlencode ($destination); 
            $api_url .= "&text=". urlencode ($message); 
            $my_result_object = json_decode(file_get_contents($api_url, false)); 
            
            // input ke tabel status_pengiriman
            $status_pengiriman = new StatusPengiriman(); 
            $status_pengiriman->id_pengiriman = $id_pengiriman;
            $status_pengiriman->save();

            $id_status = $status_pengiriman->id;
            
            $detail_status = new DetailStatusPengiriman();
            $detail_status->id_status_pengiriman = $id_status;
            $detail_status->keterangan = $keterangan;
            $detail_status->id_user = Auth::user()->id;
            $detail_status->save();
        }

        return redirect()->route('cabang.surat.index')->with('alert', 'Berhasil ditambahkan!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $transaksi = TransaksiPengirimanSurat::all()->where('id_surat', $id);

        $surat = Surat::findOrFail($id);
        $kurir = Kurir::all();

        return view('cabang.surat.edit', compact('surat', 'kurir', 'transaksi'));
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
        $surat->nomor_surat = $request->input('nomor_surat');
        $surat->id_kurir = $request->input('id_kurir');
        $surat->tgl_surat = $request->input('tgl_surat');
        $surat->save();

        Alert::success('Berhasil', 'Data surat berhasil diubah!');

        return redirect()->back();
    }


    public function cetak($id)
    {
        $transaksi_pengiriman = TransaksiPengirimanSurat::all()->where('id_surat', $id);
        return view('cabang.surat.cetak', compact('transaksi_pengiriman'));
    }

    public function perbarui($id)
    {
        $surat = Surat::findOrFail($id);
        $transaksi_pengiriman = TransaksiPengirimanSurat::with('pengiriman.status_pengiriman.detail_status_pengiriman')
                        ->where('id_surat', $id)->get();
        return view('cabang.surat.perbarui', compact('transaksi_pengiriman', 'surat'));
    }

    public function status($id){
        $surat = Surat::findOrFail($id);
        if($surat->status_terima == true){
            $surat->status_terima = false;
            $surat->keterangan = "Surat berangkat [". Auth::user()->nama . "]";
            $surat->update();
        }else{
            $surat->status_terima =true;
            $surat->keterangan = "Surat diterima [". Auth::user()->nama . "]";
            $surat->update();
        }

        return redirect()->back()->with('alert', 'Keterangan surat berhasil diperbarui!');
    }

    public function noResi(Request $request)
    {
        if ($request->has('q')) {
            $cari = $request->q;
            $data = DB::table('pengiriman')->select('id', 'no_resi', 'nama_penerima')
            ->where('no_resi', 'LIKE', "%$cari%")
            ->where('status_surat', 0)
            ->where('status_valid', 1)->get();
            return response()->json($data);
        }
    }

    public function dataTable()
    {
        $surat = Surat::with('kurir.user')->select('surat.*');

        return datatables()->of($surat)
        ->addIndexColumn()
        ->addColumn('ubah', function($surat){
            return '<a href="'. route('cabang.surat.edit', $surat->id) . '" class="btn btn-sm btn-outline-secondary" style="padding-bottom: 0px; padding-top: 0px;">
            Ubah
            <span class="btn-label btn-label-right"><i class="fa fa-edit"></i></span></a>';
        })
        ->addColumn('cetak', function ($surat){
            return '<a href="' . route('cabang.surat.cetak', $surat->id) . '" class="btn btn-sm btn-success" style="padding-bottom: 0px; padding-top: 0px;"><span class="btn-label btn-label-right"><i class="fa fa-print"></i></span></a>';
        })
        ->addColumn('status', function($surat){
            if ($surat->status_terima == 1) {
                return '<a href="'. route('cabang.surat.status', $surat->id). '"><button type="submit" class="btn btn-sm btn-warning" style="padding-bottom: 0px; padding-top: 0px;" onclick="return confirm('. "'Anda yakin?'" .');"><i class="fa fa-car"> Berangkat</button></a>';
            }else{
                return '<a href="'. route('cabang.surat.status', $surat->id). '"><button type="submit" class="btn btn-sm btn-primary" style="padding-bottom: 0px; padding-top: 0px;" onclick="return confirm('. "'Anda yakin?'" .');"><i class="fa fa-check"></i> Terima</button></a>';
            }
        })
        ->addColumn('perbarui', function ($surat){
            return '<a href="' . route('cabang.surat.perbarui', $surat->id) . '" class="btn btn-sm btn-info" style="padding-bottom: 0px; padding-top: 0px;"><span class="btn-label btn-label-right"><i class="fa fa-edit"></i></span></a>';
        })
        ->rawColumns(['ubah', 'status', 'cetak', 'perbarui'])
        ->make(true);
    }
}
