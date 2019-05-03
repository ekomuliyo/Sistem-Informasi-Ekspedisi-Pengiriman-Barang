@extends('layouts.direktur.app')

@section('assets-top')
    <!-- Page level plugin CSS-->
    <link href="{{ asset('assets/blog-admin/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    <!-- Responsive datatable examples -->
    <link href="{{ asset('assets/blog-admin/vendor/datatables/responsive.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    <div class="container-fluid">
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="#">Cabang</a>
          </li>
          <li class="breadcrumb-item active">Table</li>
        </ol>
        <!-- Example DataTables Card-->
        <div class="card mb-3">
          <div class="card-header">
            <i class="fa fa-list"></i> Cabang
            <a href="{{ route('direktur.cabang.create') }}" class="btn btn-sm btn-primary">Tambah</a>
          </div>
          <div class="card-body table-responsive">
            <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Nama Cabang</th>
                    <th>Alamat</th>
                    <th>No HP</th>
                    <th>Email</th>
                    <th>Level</th>
                    <th>Aksi</th>
                    <th>Status</th>
                  </tr>
                </thead>
                <tbody>

                </tbody>
              </table>
            </div>
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
                ajax: "{{ route('direktur.api.datatable.cabang') }}",
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'user.nama', name: 'user.nama'},
                    {data: 'alamat', name: 'alamat'},
                    {data: 'no_hp', name: 'no_hp'},
                    {data: 'user.email', name: 'user.email'},
                    {data: 'user.level', name: 'user.level'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                    {data: 'action_status', name: 'action_status', orderable: false, searchable: false}
                ]
            });
        });
    </script>
@endsection