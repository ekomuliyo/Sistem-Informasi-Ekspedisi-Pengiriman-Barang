@extends('layouts.cabang.app')

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
          <a href="{{ route('cabang.pengiriman.create') }}" class="btn btn-sm btn-primary">Tambah</a>
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
                    <th>ID</th>
                    <th>Pengirim</th>
                    <th>Penerima</th>
                    <th>Kota Tujuan</th>
                    <th>Biaya</th>
                    <th>Kg</th>
                    <th>Aksi</th>
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
            ajax: "{{ route('cabang.api.datatable.pengiriman') }}",
            columns:[
              {data: 'id', name: 'id'},
              {data: 'pelanggan_pengirim.user.nama', name: 'pelanggan_pengirim.user.nama'},
              {data: 'pelanggan_penerima.user.nama', name: 'pelanggan_penerima.user.nama'},
              {data: 'pelanggan_penerima.kota', name: 'pelanggan_penerima.kota', 
                render: function(data){
                  var kota;
                  if (data == 1){
                    kota = "Palembang";
                  }
                  else if(data == 2){
                    kota = "Jambi";
                  }else if(data == 3){
                    kota = "Pekanbaru";
                  }else{
                    kota = "Padang";
                  }
                  return kota;
                }},
              {data: 'jumlah_biaya', name: 'jumlah_biaya'},
              {data: 'berat', name: 'berat'},
              {data: 'action', name: 'action', orderable: false, searchable: false}
            ]
        });
    });
    </script>

@endsection