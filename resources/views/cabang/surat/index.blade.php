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
            <a href="#">Surat &nbsp;</a>
          </li>
          <a href="{{ route('cabang.surat.create') }}" class="btn btn-sm btn-primary">Tambah</a>
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
                    <th>Nomor Surat</th>
                    <th>Tanggal Surat</th>
                    <th>Keterangan</th>
                    <th>Nama Kurir</th>
                    <th>Perbarui</th>
                    <th>Cetak</th>
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
        var date = new Date();
        $("#dataTable").DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('cabang.api.datatable.surat') }}",
            columns:[
              {data: 'id', name: 'id'},
              {data: 'nomor_surat', name: 'nomor_surat'},
              {data: 'tgl_surat', name: 'tgl_surat'},
              {data: 'keterangan', name: 'keterangan'},
              {data: 'kurir.user.nama', name: 'kurir.user.nama'},
              {data: 'perbarui', name: 'perbarui', orderable: false, searchable: false},
              {data: 'cetak', name: 'cetak', orderable: false, searchable: false},              
              {data: 'ubah', name: 'ubah', orderable: false, searchable: false}
            ]
        });
    });
    </script>

@endsection