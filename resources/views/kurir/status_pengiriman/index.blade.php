@extends('layouts.kurir.app')

@section('assets-top')
    <!-- Page level plugin CSS-->
    <link href="{{ asset('assets/blog-admin/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    <!-- Responsive datatable examples -->
    <link href="{{ asset('assets/blog-admin/vendor/datatables/responsive.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />

    <!-- Plugin scan Qr Code -->
    <script type="text/javascript" src="{{ asset('assets/blog-admin/js/instascan.min.js') }}"></script>
@endsection

@section('content')
    <div class="container-fluid">
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="#">Status Pengiriman</a>
          </li>
          <li class="breadcrumb-item active">Tabel</li>
        </ol>
        @if (session('alert'))
            <div class="alert alert-success">
                {{ session('alert') }}
            </div>
        @endif
        <!-- Example DataTables Card-->
        <div class="card mb-3">
          <div class="card-header">
            <i class="fa fa-list"></i> Status Pengiriman
          </div>
          <div class="card-body table-responsive">
            <div class="table-responsive">
                <label>Terima Barang: </label>
                <a href="#" class="btn btn-sm btn-info" onclick="scanStart()" data-toggle="modal" data-target="#scanModal">Pindai<i class="fa fa-search"></i></span></a></br></br>

              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Pengirim</th>
                    <th>Penerima</th>
                    <th>Kota Tujuan</th>
                    <th>Jumlah Biaya</th>
                    <th>Berat (Kg)</th>
                    <th>Keterangan</th>
                  </tr>
                </thead>
                <tbody>

                </tbody>
              </table>
            </div>
          </div>
        </div>

        <!-- modal terima barang -->
        <div div class="modal fade" id="scanModal" role="dialog">
            <div class="modal-dialog  modal-lg modal-dialog-centered" role="document" >
                <div class="modal-content"  style="width:690px;">
                    <div class="modal-header">
                      <h4 class="modal-title">Terima Barang</h4>
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
                    {!! Form::open(['route' => 'kurir.status_pengiriman.store', 'method' => 'POST', 'onsubmit' => "return validasiStatusPengiriman();"]) !!}
                    <div class="form-group" id="form_nama_penerima">
                        <label for="penerima">Nama Penerima</label>
                            {!! Form::text('nama_penerima', null, ['class' => $errors->has('nama_penerima') ? 'form-control is-invalid' : 'form-control', 'placeholder' => 'Nama',  'id' => 'txt_nama_penerima', 'required']) !!}
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
@endsection

@section('assets-bottom')
    <!-- Page level plugin JavaScript-->
    <script src="{{ asset('assets/blog-admin/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/blog-admin/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <!-- Responsive examples -->
    <script src="{{ asset('assets/blog-admin/vendor/datatables/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('assets/blog-admin/vendor/datatables/responsive.bootstrap4.min.js') }}"></script>
    <script>
        $(document).ready(function(){
            $("#dataTable").DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('kurir.api.datatable.status_pengiriman') }}",
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'pelanggan_pengirim.user.nama', name: 'pelanggan_pengirim.user.nama'},
                    {data: 'pelanggan_penerima.user.nama', name: 'pelanggan_penerima.user.nama'},
                    {data: 'pelanggan_penerima.kota', name: 'pelanggan_penerima.kota', 
                        render: function(data){
                        var kota;
                        if (data == 2){
                            kota = "Palembang";
                        }
                        else if(data == 3){
                            kota = "Jambi";
                        }else if(data == 4){
                            kota = "Pekanbaru";
                        }else if(data == 5){
                            kota = "Padang";
                        }
                        return kota;
                        }},
                    {data: 'jumlah_biaya', name: 'jumlah_biaya'},
                    {data: 'berat', name: 'berat'},
                    {data: 'status_pengiriman', name: 'status_pengiriman',
                        render: function(data){
                            return data[data.length-1].keterangan;
                        }}
                ]
            });
        });

        let scanner = new Instascan.Scanner(
            {
                video: document.getElementById('preview')
            }
        );

        function scanStart(){
            scanner.addListener('scan', function(content) {
                // ketika id dari qrcode di tangkap langsung di lempar ke jquery
                $.get('/kurir/json/perbarui_status_barang?id_pengiriman='+ content, function(data){
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

            $('.modal').on('hidden.bs.modal', function(e){ 
            scanner.stop();
            }) ;
        }

        // validasi apakah sudah di scan atau belum
        function validasiStatusPengiriman(){
          var id_pengiriman = document.getElementById('id_pengiriman').value;
          if (id_pengiriman <= 0 ) {
            alert("Silahkan scan barcode terlebih dahulu!");
            return false;
          }else{return true;}
        }
    </script>
@endsection