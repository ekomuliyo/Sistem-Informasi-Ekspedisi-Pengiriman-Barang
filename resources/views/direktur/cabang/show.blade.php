@extends('layouts.direktur.app')

@section('content')

<div class="container-fluid">
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a href="#">Cabang</a>
      </li>
      <li class="breadcrumb-item active">Tampilkan</li>
    </ol>
    <!-- Icon Cards-->
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header text-white bg-primary">
            Cabang Detail : {{ $cabang->name }}
          </div>
          <div class="card-body">
              <table class="table table-striped">
                  <tr>
                      <th>ID</th>
                      <td>{{ $cabang->id }}</td>
                  </tr>
                  <tr>
                      <th>Nama</th>
                      <td>{{ $cabang->user->nama }}</td>
                  </tr>
                  <tr>
                      <th>E-Mail</th>
                      <td>{{ $cabang->user->email }}</td>
                  </tr>
                  <tr>
                      <th>Alamat</th>
                      <td>{{ $cabang->alamat }}</td>
                  </tr>
                  <tr>
                      <th>Nomor HP</th>
                      <td>{{ $cabang->no_hp }}</td>
                  </tr>
                  <tr>
                      <th>Level</th>
                      <td>{{ $cabang->user->level }}</td>
                  </tr>
                  <tr>
                      <th>Foto</th>
                      <td><img src="{{ asset($cabang->user->foto) }}" alt="Foto" height="150" width="150"></td>
                  </tr>
              </table>
          </div>
        </div>
      </div>
    </div>
</div>

@endsection