@extends('layouts.cabang.app')

@section('assets-top')
<!-- Plugin scan Qr Code -->
<script type="text/javascript" src="{{ asset('assets/blog-admin/js/instascan.min.js') }}"></script>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header text-white bg-primary">
                    Perbarui Status Barang dan Surat Perjalanan  
                </div></br>

                @if ($message = Session::get('alert'))
                <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>{{ $message }}</strong>
                </div>
                @endif
                @if($surat->status_terima == 1)
                <div class="card-body">
                    <label>Perbarui status barang : </label>
                    <a href="#" class="btn btn-sm btn-info" onclick="scanStart()" data-toggle="modal"
                        data-target="#scanModal">Pindai<i class="fa fa-search"></i></span></a></br></br>

                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Data Pengiriman Barang</label></br>
                    <table class="table table-bordered" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Nomor Resi</th>
                                <th>Pengirim</th>
                                <th>Penerima</th>
                                <th>Kota Tujuan</th>
                                <th>Alamat Lengkap</th>
                                <th>Keterangan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($transaksi_pengiriman as $d)
                            <tr>
                                <td>{{ $d->pengiriman->no_resi }}</td>
                                <td>{{ $d->pengiriman->nama_pengirim }}</td>
                                <td>{{ $d->pengiriman->nama_penerima }}</td>
                                <td>{{ $d->pengiriman->kecamatan_penerima->kota->nama }}</td>
                                <td>{{ $d->pengiriman->alamat_penerima }}</td>
                                <td>{{ $d->pengiriman->status_pengiriman[0]->
                                        detail_status_pengiriman[$d->pengiriman->status_pengiriman[0]->detail_status_pengiriman->count()-1]->keterangan }}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @else
                <div class="row col-lg-12">
                    <div class="alert alert-danger">
                        <span>Tidak dapat memperbarui status barang, silahkan perbarui keterangan surat!</span>
                    </div>
                </div>
                @endif
                {!! Form::model($surat, ['route' => ['cabang.surat.update', $surat->id], 'method' => 'PUT']) !!}
                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Keterangan Surat</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        {!! Form::select('keterangan', ['Surat dalam perjalanan menuju Palembang' => 'Surat dalam
                        perjalanan menuju Palembang',
                        'Diterima oleh Cabang Palembang' =>'Diterima oleh Cabang Palembang',
                        'Sedang dalam perjalanan menuju Pekanbaru'=>'Sedang dalam perjalanan menuju Pekanbaru',
                        'Diterima oleh Cabang Pekanbaru' =>'Diterima oleh Cabang Pekanbaru',
                        'Sedang dalam perjalanan menuju Bukit Tinggi'=>'Sedang dalam perjalanan menuju Bukit Tinggi',
                        'Diterima oleh Cabang Bukit Tinggi / Pusat' =>'Diterima oleh Cabang Bukit Tinggi / Pusat'],
                        null , ['class' => 'form-control', 'placeholder' => 'Keterangan']) !!}
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-2">
                        <div class="card-footer bg-transparent">
                        <button class="btn btn-primary" type="submit"><i class="fa fa-save"></i>
                            Simpan
                        </button></br></br>
                        <a href="{{ route('cabang.surat.index') }}" class="btn btn-primary"><i class="fa fa-angle-double-left"></i>Kembali<span
                                class="btn-label btn-label-right"></span></a>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>

    <!-- modal perbarui status barang -->
    <div div class="modal fade" id="scanModal" role="dialog">
        <div class="modal-dialog  modal-lg modal-dialog-centered" role="document">
            <div class="modal-content" style="width:690px;">
                <div class="modal-header">
                    <h4 class="modal-title">Perbarui status barang</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                </div>

                <div class="modal-body">
                    <video id="preview"></video>

                    <div class="row">
                        <div class="col-md-3"></div>
                        <div class="col-md-3">
                            Pengirim
                        </div>
                        <div class="col-md-3">:
                            <label for="pengirim" id="pengirim"></label>
                        </div>
                        <div class="col-md-3"></div>
                    </div>
                    <div class="row">
                        <div class="col-md-3"></div>
                        <div class="col-md-3">
                            Penerima
                        </div>
                        <div class="col-md-3">:
                            <label for="penerima" id="penerima"></label>
                        </div>
                        <div class="col-md-3"></div>
                    </div>
                    <div class="row">
                        <div class="col-md-3"></div>
                        <div class="col-md-3">
                            Kota Tujuan
                        </div>
                        <div class="col-md-3">:
                            <label for="kota" id="kota"></label>
                        </div>
                        <div class="col-md-3"></div>
                    </div>
                    <div class="row">
                        <div class="col-md-3"></div>
                        <div class="col-md-3">
                            Alamat Lengkap
                        </div>
                        <div class="col-md-6">:
                            <label for="alamat" id="alamat"></label>
                        </div>
                    </div>
                    {!! Form::open(['route' => 'cabang.perbarui.status.barang', 'method' => 'POST', 'onsubmit' =>
                    "return validasiStatusPengiriman();"]) !!}
                    <div class="form-group">
                        <label for="keterangan">Keterangan</label>
                        <select name="keterangan" id="keterangan" class="form-control" required name="keterangan">
                            <option value="" disabled selected hidden>Pilih Keterangan</option>
                            <option value="Barang sedang dikirim">Barang sedang dikirim</option>
                            <option value="Barang sedang disortir">Barang sedang disortir</option>
                            <option value="Barang sedang dikirim ke alamat tujuan">Barang sedang dikirim ke alamat
                                tujuan</option>
                            <option value="Barang diterima oleh pelanggan">Barang diterima oleh pelanggan</option>
                        </select>
                    </div>
                    <div class="form-group" id="form_nama_penerima">
                        <label for="penerima">Nama Penerima</label>
                        {!! Form::text('nama_penerima', null, ['class' => $errors->has('nama_penerima') ?
                        'form-control is-invalid' : 'form-control', 'placeholder' => 'Nama', 'id' =>
                        'nama_penerima']) !!}
                    </div>
                    <input type="text" name="id_pengiriman" id="id_pengiriman" hidden>

                </div>
                <div class="modal-footer">
                    <input class="btn btn-primary" type="submit" id="btn_perbarui" value="Perbarui">
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
</div>


@endsection

@section('assets-bottom')
<script>
let scanner = new Instascan.Scanner({
    video: document.getElementById('preview')
});

function scanStart() {
    scanner.addListener('scan', function(content) {
        // ketika id dari qrcode di tangkap langsung di lempar ke jquery
        $.get('/cabang/json/perbarui_status_barang?id_pengiriman=' + content, function(data) {

            if (data.kode == 1) {
                var id_pengiriman = data.data.id_pengiriman;
                var pengirim = data.data.pengiriman.nama_pengirim;
                var penerima = data.data.pengiriman.nama_penerima;
                var alamat = data.data.pengiriman.alamat_penerima;
                var kota = data.data.pengiriman.kecamatan_penerima.kota.nama;
                document.getElementById('pengirim').innerHTML = pengirim;
                document.getElementById('penerima').innerHTML = penerima;
                document.getElementById('kota').innerHTML = kota;
                document.getElementById('alamat').innerHTML = alamat;
                document.getElementById('id_pengiriman').value = id_pengiriman;
            }else{
                alert("Gagal dipindai, barang tidak ditemukan!");
            }
        });
    });
    Instascan.Camera.getCameras().then(cameras => {
        if (cameras.length > 0) {
            scanner.start(cameras[0]);
        } else {
            console.error("Camera not found!");
        }
    });
}

$('.modal').on('hidden.bs.modal', function(e) {
    scanner.stop();
});

// validasi apakah sudah di scan atau belum
function validasiStatusPengiriman() {
    var id_pengiriman = document.getElementById('id_pengiriman').value;
    if (id_pengiriman <= 0) {
        alert("Silahkan pindai barcode terlebih dahulu!");
        return false;
    } else {
        return true;
    }
}

// menampilkan field nama penerima jika memilih select barang diterima oleh pelangan
$("#form_nama_penerima").hide();
$("#keterangan").on('change', function(e) {
    if (e.target.value == "Barang diterima oleh pelanggan") {
        $("#form_nama_penerima").show();
    } else {
        $("#form_nama_penerima").hide();
        $("#nama_penerima").val("");
    }
});
</script>
@endsection