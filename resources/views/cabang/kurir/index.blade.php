@extends('layouts.cabang.app')

@section('assets-top')
    <link href="{{ asset('assets/blog-admin/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    <!-- Responsive datatable examples -->
    <link href="{{ asset('assets/blog-admin/vendor/datatables/responsive.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')

@section('content')
    <div class="container-fluid">
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="#">Kurir &nbsp;</a>
          </li>
          <a href="{{ route('cabang.kurir.create') }}" class="btn btn-sm btn-primary">Tambah</a>
        </ol>
        <!-- Example DataTables Card-->
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Nama Kurir</th>
                    <th>Alamat</th>
                    <th>No HP</th>
                    <th>Nama Kendaraan</th>
                    <th>Nomor Polisi</th>
                    <th>Email</th>
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
            ajax: "{{ route('cabang.api.datatable.kurir') }}",
            columns:[
              {data: 'id', name: 'id'},
              {data: 'user.nama', name: 'user.nama'},
              {data: 'alamat', name: 'alamat'},
              {data: 'no_hp', name: 'no_hp'},
              {data: 'nama_kendaraan', name: 'nama_kendaraan'},
              {data: 'nomor_polisi', name: 'nomor_polisi'},
              {data: 'user.email', name: 'user.email'},
              {data: 'action', name: 'action', orderable: false, searchable: false}
            ]
        });
    });
    </script>

@endsection