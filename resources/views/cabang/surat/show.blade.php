@extends('layouts.cabang.app')

@section('content')

<div class="container-fluid">
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a href="#">Surat</a>
      </li>
      <li class="breadcrumb-item active">Tampilkan</li>
    </ol>
    <!-- Icon Cards-->
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header text-white bg-primary">
            Kurir Detail Surat : {{ $surat->nomor_surat }}
          </div>
          <div class="card-body">
              <table class="table table-striped">
                  <tr>
                      <th>ID</th>
                      <td>{{ $surat->id }}</td>
                  </tr>
                  <tr>
                      <th>Nomor Surat</th>
                      <td>{{ $surat->nomor_surat }}</td>
                  </tr>
                  <tr>
                      <th>Tanggal Surat</th>
                      <td>{{ $surat->tgl_surat }}</td>
                  </tr>
                  <tr>
                      <th>Keterangan</th>
                      <td>{{ $surat->keterangan }}</td>
                  </tr>
                  <tr>
                      <th>Nama Kurir</th>
                      <td>{{ $surat->kurir->user->nama }}</td>
                  </tr>
              </table>
          </div>
        </div>
      </div>
    </div>
</div>

@endsection