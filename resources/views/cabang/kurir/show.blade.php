@extends('layouts.cabang.app')

@section('content')

<div class="container-fluid">
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a href="#">Kurir</a>
      </li>
      <li class="breadcrumb-item active">Tampilkan</li>
    </ol>
    <!-- Icon Cards-->
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header text-white bg-primary">
            Kurir Detail : {{ $kurir->user->nama }}
          </div>
          <div class="card-body">
              <table class="table table-striped">
                  <tr>
                      <th>ID</th>
                      <td>{{ $kurir->id }}</td>
                  </tr>
                  <tr>
                      <th>Nama</th>
                      <td>{{ $kurir->user->nama }}</td>
                  </tr>
                  <tr>
                      <th>Alamat</th>
                      <td>{{ $kurir->alamat }}</td>
                  </tr>
                  <tr>
                      <th>Nomor HP</th>
                      <td>{{ $kurir->no_hp }}</td>
                  </tr>
                  <tr>
                      <th>Nama Kendaraan</th>
                      <td>{{ $kurir->nama_kendaraan }}</td>
                  </tr>
                  <tr>
                      <th>Nomor Polisi</th>
                      <td>{{ $kurir->nomor_polisi }}</td>
                  </tr>
                  <tr>
                      <th>E-Mail</th>
                      <td>{{ $kurir->user->email }}</td>
                  </tr>
                  <tr>
                      <th>Level</th>
                      <td>{{ $kurir->user->level }}</td>
                  </tr>
                  <tr>
                      <th>Foto</th>
                      <td><img src="{{ asset($kurir->user->foto) }}" class="rounded-circle" alt="Foto" height="150" width="150"></td>
                  </tr>
              </table>
          </div>
        </div>
      </div>
    </div>
</div>

@endsection