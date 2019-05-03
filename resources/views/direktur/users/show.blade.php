@extends('layouts.direktur.app')

@section('content')

<div class="container-fluid">
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a href="#">Users</a>
      </li>
      <li class="breadcrumb-item active">Tampilkan Detail</li>
    </ol>
    <!-- Icon Cards-->
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header text-white bg-primary">
            User Detail : {{ $user->name }}
          </div>
          <div class="card-body">
              <table class="table table-striped">
                  <tr>
                      <th>ID</th>
                      <td>{{ $user->id }}</td>
                  </tr>
                  <tr>
                      <th>Nama</th>
                      <td>{{ $user->nama }}</td>
                  </tr>
                  <tr>
                      <th>E-Mail</th>
                      <td>{{ $user->email }}</td>
                  </tr>
                  <tr>
                      <th>Level</th>
                      <td>{{ $user->level }}</td>
                  </tr>
                  <tr>
                      <th>Foto</th>
                      <td><img src="{{ asset($user->foto) }}" alt="Foto" height="150" width="150"></td>
                  </tr>
              </table>
          </div>
        </div>
      </div>
    </div>
</div>

@endsection