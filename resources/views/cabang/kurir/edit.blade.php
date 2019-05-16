@extends('layouts.cabang.app')

@section('content')

<div class="container-fluid">
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a href="#">Kurir</a>
      </li>
      <li class="breadcrumb-item active">Ubah</li>
    </ol>

    <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header text-white bg-primary">
              Ubah Kurir
              </div>
              {!! Form::model($kurir, ['route' => ['cabang.kurir.update', $kurir->id], 'method' => 'PUT']) !!}
                <div class="form-group">
                    <label for="nama">Nama Kurir</label>
                    {!! Form::text('nama', $kurir->user->nama, ['class' => $errors->has('nama') ? 'form-control is-invalid' : 'form-control', 'required', 'autofocus']) !!}
                </div>
                <div class="form-group">
                    <label for="no_hp">Nomor HP</label>
                    {!! Form::text('no_hp', $kurir->no_hp, ['class' => $errors->has('no_hp') ? 'form-control is-invalid' : 'form-control', 'required', 'autofocus']) !!}
                </div>
                <div class="form-group">
                    <label for="alamat">Alamat</label>
                    {!! Form::textarea('alamat', $kurir->alamat, ['class' => $errors->has('alamat') ? 'form-control is-invalid' : 'form-control', 'required', 'autofocus']) !!}
                </div>
                <div class="form-group">
                <label for="nama_kendaraan">Nama Kendaraan</label>
                    {!! Form::text('nama_kendaraan', null, ['class' => $errors->has('nama_kendaraan') ? 'form-control is-invalid' : 'form-control', 'required', 'autofocus']) !!}
                </div>
                <div class="form-group">
                    <label for="nomor_polisi">Nomor Polisi</label>
                    {!! Form::text('nomor_polisi', null, ['class' => $errors->has('nomor_polisi') ? 'form-control is-invalid' : 'form-control', 'required', 'autofocus']) !!}
                </div>
                <div class="form-group">
                <label for="email">Email</label>
                    {!! Form::email('email', $kurir->user->email, ['class' => $errors->has('email') ? 'form-control is-invalid' : 'form-control', 'required']) !!}
                </div>
                <div class="form-group">
                    <label for="level">Level</label>
                    {!! Form::text('level', 'kurir', ['class' => $errors->has('level') ? 'form-control is-invalid' : 'form-control', 'required', 'readonly']) !!}
                </div>
                <div class="card-footer bg-transparent">
                <button class="btn btn-primary" type="submit">
                    Masukan
                </button>

              {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>


@endsection