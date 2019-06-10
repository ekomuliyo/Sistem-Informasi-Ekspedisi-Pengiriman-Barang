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
            <a href="#">Ongkir &nbsp;</a>
          </li>
          <a href="{{ route('cabang.ongkir.create') }}" class="btn btn-sm btn-primary">Tambah</a>
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
                    <th>Asal</th>
                    <th>Kota Tujuan</th>
                    <th>Kecamatan</th>
                    <th>Estimari (Hari)</th>
                    <th>Harga (Kg)</th>
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
            ajax: "{{ route('cabang.api.datatable.ongkir') }}",
            columns:[
              {data: 'DT_RowIndex', name: 'DT_RowIndex', searchable: false, orderable: false},
              {data: 'asal', name: 'asal'},
              {data: 'kecamatan.kota.nama', name: 'kecamatan.kota.nama'},
              {data: 'kecamatan.nama', name: 'kecamatan.nama'},
              {data: 'estimasi', name: 'estimasi'},
              {data: 'harga', name: 'harga'},
              {data: 'action', name: 'action', orderable: false, searchable: false}
            ]
        });
    });
    </script>

@endsection