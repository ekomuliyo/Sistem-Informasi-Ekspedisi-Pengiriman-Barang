@extends('layouts.direktur.app')

@section('content')

<div class="container-fluid">
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a href="#">Cabang</a>
      </li>
      <li class="breadcrumb-item active">Ubah</li>
    </ol>

    <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header text-white bg-primary">
              Ubah Cabang
              </div>
              {!! Form::model($cabang, ['route' => ['direktur.cabang.update', $cabang->id], 'method' => 'PUT']) !!}
                <div class="form-group">
                    <label for="nama">Nama Cabang</label>
                    {!! Form::text('nama', $cabang->user->nama, ['class' => $errors->has('nama') ? 'form-control is-invalid' : 'form-control', 'required', 'autofocus']) !!}
                </div>
                <div class="form-group">
                    <label for="no_hp">Nomor HP</label>
                    {!! Form::text('no_hp', $cabang->no_hp, ['class' => $errors->has('no_hp') ? 'form-control is-invalid' : 'form-control', 'required', 'autofocus']) !!}
                </div>
                <div class="form-group">
                    <label for="alamat">Alamat</label>
                    {!! Form::textarea('alamat', $cabang->alamat, ['class' => $errors->has('alamat') ? 'form-control is-invalid' : 'form-control', 'required', 'autofocus']) !!}
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    {!! Form::email('email', $cabang->user->email, ['class' => $errors->has('email') ? 'form-control is-invalid' : 'form-control', 'required']) !!}
                </div>
                <div class="form-group">
                    <label for="level">Level</label>
                    {!! Form::text('level', 'admin', ['class' => $errors->has('level') ? 'form-control is-invalid' : 'form-control', 'required', 'readonly']) !!}
                </div>
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