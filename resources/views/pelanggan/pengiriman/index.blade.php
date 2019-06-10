@extends('layouts.pelanggan.app')

@section('assets-top')
    <link href="{{ asset('assets/blog-admin/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    <!-- Responsive datatable examples -->
    <link href="{{ asset('assets/blog-admin/vendor/datatables/responsive.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    <div class="container-fluid">
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="#">Pengiriman &nbsp;</a>
          </li>
          <a href="{{ route('pelanggan.pengiriman.create') }}" class="btn btn-sm btn-primary">Tambah</a>
        </ol>
        @if (session('alert'))
            <div class="alert alert-success">
                {{ session('alert') }}
            </div>
        @endif
        <!-- Example DataTables Card-->
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>Nomor</th>
                    <th>No Resi</th>
                    <th>Pengirim</th>
                    <th>Penerima</th>
                    <th>Kota Tujuan</th>
                    <th>Alamat</th>
                    <th>Jumlah Biaya</th>
                    <th>Metode Pembayaran</th>
                    <th>Status Validasi</th>
                    <th>Status Pembayaran</th>
                  </tr>
                </thead>
                <tbody>

                </tbody>
              </table>
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
    $(document).ready(function (){
        $("#dataTable").DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('pelanggan.api.datatable.pengiriman') }}",
            columns:[
              {data: 'DT_RowIndex', name: 'DT_RowIndex', searchable: false, orderable: false},
              {data: 'no_resi', name: 'no_resi'},
              {data: 'nama_pengirim', name: 'nama_pengirim'},
              {data: 'nama_penerima', name: 'nama_penerima'},
              {data: 'kecamatan_penerima.kota.nama', name: 'kecamatan_penerima.kota.nama'},
              {data: 'alamat_penerima', name: 'alamat_penerima'},
              {data: 'jumlah_biaya', name: 'jumlah_biaya'},
              {data: 'metode_pembayaran', name: 'metode_pembayaran', 
                      render: function(data){
                        var metode;
                        if (data == 1) {
                          metode = "Cash";
                        }else if(data == 2){
                          metode = "COD";
                        }else if(data == 3){
                          metode = "Transfer";
                        }else{
                          metode = "Langganan";
                        }
                        return metode;
                      }},
              {data: 'status', name: 'status', searchable: false, orderable: false},
              {data: 'status_bayar', name: 'status_bayar', searchable: false, orderable: false},

            ]
        });
    });
    </script>

@endsection