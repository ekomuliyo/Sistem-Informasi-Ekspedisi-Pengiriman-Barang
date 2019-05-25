@extends('layouts.cabang.app')

@section('assets-top')
    <script type="text/javascript" src="{{ asset('assets/blog-admin/js/instascan.min.js') }}"></script>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header text-white bg-primary">
                        Perbarui Data Surat dan Pengiriman Barang
                    </div></br>

                    @if ($message = Session::get('alert'))
                    <div class="alert alert-success alert-block">
                        <button type="button" class="close" data-dismiss="alert">×</button> 
                        <strong>{{ $message }}</strong>
                    </div>
                    @endif

                    {!! Form::model($surat, ['route' => ['cabang.surat.update', $surat->id], 'method' => 'PUT']) !!}
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Keterangan Surat</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                {!! Form::select('keterangan', ['Sedang dalam perjalanan menuju Palembang' => 'Sedang dalam perjalanan menuju Palembang', 
                                                            'Diterima oleh Cabang Palembang' =>'Diterima oleh Cabang Palembang',
                                                            'Sedang dalam perjalanan menuju Jambi'=>'Sedang dalam perjalanan menuju Jambi', 
                                                            'Diterima oleh Cabang Jambi' =>'Diterima oleh Cabang Jambi',
                                                            'Sedang dalam perjalanan menuju Pekanbaru'=>'Sedang dalam perjalanan menuju Pekanbaru', 
                                                            'Diterima oleh Cabang Pekanbaru' =>'Diterima oleh Cabang Pekanbaru',
                                                            'Sedang dalam perjalanan menuju Padang'=>'Sedang dalam perjalanan menuju Padang',
                                                            'Diterima oleh Cabang Padang' =>'Diterima oleh Cabang Padang'],  
                                                            null , ['class' => 'form-control']) !!}
                                </div>
                        </div>
                        <div class="card-body">
                            <label>Perbarui status barang : </label>
                            <a href="#" class="btn btn-sm btn-info" onclick="scanStart()" data-toggle="modal" data-target="#scanModal">Scan<i class="fa fa-search"></i></span></a></br></br>

                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Data Pengiriman Barang</label></br>
                            <table class="table table-bordered" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Pengirim</th>
                                        <th>Penerima</th>
                                        <th>Kota Tujuan</th>
                                        <th>Alamat Lengkap</th>
                                        <th>Keterangan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($pengiriman as $d)
                                    <tr>
                                        <td>{{ $d->pelanggan_pengirim->user->nama }}</td>
                                        <td>{{ $d->pelanggan_penerima->user->nama }}</td>
                                        @if($d->pelanggan_penerima->kota == 1) <td>Jakarta</td>
                                        @elseif($d->pelanggan_penerima->kota == 2)<td>Palembang</td>
                                        @elseif($d->pelanggan_penerima->kota == 3)<td>Jambi</td>
                                        @elseif($d->pelanggan_penerima->kota == 4)<td>Pekanbaru</td>
                                        @else<td>Padang</td>                                                                                                
                                        @endif
                                        <td>{{ $d->pelanggan_penerima->alamat }}</td>
                                        <td>{{ $d->status_pengiriman[$d->status_pengiriman->count()-1]->keterangan }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    <div class="card-footer bg-transparent">
                    <button class="btn btn-primary" type="submit">
                        Simpan
                    </button>
                    {!! Form::close() !!}
                    </div>
                </div>
            </div>

        <!-- modal profil -->
        <div div class="modal fade" id="scanModal" role="dialog">
            <div class="modal-dialog  modal-lg modal-dialog-centered" role="document" >
                <div class="modal-content"  style="width:690px;">
                    <div class="modal-header">
                      <h4 class="modal-title">Perbarui status barang</h4>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
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
                        <div class="col-md-4">:
                            <label for="alamat" id="alamat"></label>
                        </div>
                        <div class="col-md-2"></div>
                    </div>
                    <div class="form-group">
                        <label for="keterangan">Keterangan</label>
                        {!! Form::open(['route' => 'cabang.perbarui.status.barang', 'method' => 'POST', 'onsubmit' => "return validasiStatusPengiriman();"]) !!}
                            {!! Form::select('keterangan', ['Barang sedang dikirim' => 'Barang sedang dikirim',
                                                            'Barang sedang disortir' => 'Barang sedang disortir', 
                                                            'Barang sedang dikirim ke alamat tujuan' =>'Barang sedang dikirim alamat tujuan',
                                                            'Barang diterima oleh pelanggan'=>'Barang diterima oleh pelanggan'], 
                                                            null, ['class' => 'form-control', 'placeholder' => 'Keterangan', 'id' => 'keterangan']) !!}
                    </div>
                    <div class="form-group" id="form_nama_penerima">
                        <label for="penerima">Nama Penerima</label>
                            {!! Form::text('nama_penerima', null, ['class' => $errors->has('nama_penerima') ? 'form-control is-invalid' : 'form-control', 'placeholder' => 'Nama',  'id' => 'txt_nama_penerima']) !!}
                    </div>
                    <input type="text" name="id_pengiriman" id="id_pengiriman" hidden>
                    
                    </div>
                    <div class="modal-footer">
                        <input class="btn btn-primary" type="submit" id="btn_perbarui" value="Perbarui">
                        </input>
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
        let scanner = new Instascan.Scanner(
            {
                video: document.getElementById('preview')
            }
        );

        function scanStart(){
            scanner.addListener('scan', function(content) {
                // ketika id dari qrcode di tangkap langsung di lempar ke jquery
                $.get('/cabang/json/perbarui_status_barang?id_pengiriman='+ content, function(data){
                    var id_pengiriman = data.id;
                    var pengirim = data.pelanggan_pengirim.user.nama;
                    var penerima = data.pelanggan_penerima.user.nama;
                    var alamat = data.pelanggan_penerima.alamat;
                    var kota;
                    if (data.pelanggan_penerima.kota == 2) {
                        kota = "Palembang";
                    }else if (data.pelanggan.kota == 3){
                        kota = "Jambi";
                    }else if (data.pelanggan.kota == 4){
                        kota = "Pekanbaru";
                    }else{
                        kota = "Padang";
                    }

                    document.getElementById('pengirim').innerHTML = pengirim;
                    document.getElementById('penerima').innerHTML = penerima;
                    document.getElementById('kota').innerHTML = kota;
                    document.getElementById('alamat').innerHTML = alamat;
                    document.getElementById('id_pengiriman').value = id_pengiriman;
                });
            });
            Instascan.Camera.getCameras().then(cameras => 
            {
                if(cameras.length > 0){
                    scanner.start(cameras[0]);
                } else {
                    console.error("Camera not found!");
                }
            });
        }

        $('.modal').on('hidden.bs.modal', function(e){ 
            scanner.stop();
        }) ;
        
        // validasi apakah sudah di scan atau belum
        function validasiStatusPengiriman(){
            var id_pengiriman = document.getElementById('id_pengiriman').value;
            if (id_pengiriman <= 0 ) {
                alert("Silahkan scan barcode terlebih dahulu!");
                return false;
            }else{
                return true;
            }
        }
        
        // menampilkan field nama penerima jika memilih select barang diterima oleh pelangan
        $("#form_nama_penerima").hide();
        $("#keterangan").on('change', function(e){
            if (e.target.value == "Barang diterima oleh pelanggan") {
                $("#form_nama_penerima").show();
            }else{
                $("#form_nama_penerima").hide();
                $("#txt_nama_penerima").val("");
            }
        });
    </script>
@endsection