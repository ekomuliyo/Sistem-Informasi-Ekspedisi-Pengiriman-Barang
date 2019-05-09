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
                        @if ($errors->has('nama'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('nama') }}</strong>
                            </span>
                        @endif
                </div>
                <div class="form-group">
                    <label for="nama">Nomor HP</label>
                        {!! Form::text('no_hp', $kurir->no_hp, ['class' => $errors->has('no_hp') ? 'form-control is-invalid' : 'form-control', 'required', 'autofocus']) !!}
                        @if ($errors->has('no_hp'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('no_hp') }}</strong>
                            </span>
                        @endif
                </div>
                <div class="form-group">
                    <label for="nama">Alamat</label>
                    {!! Form::textarea('alamat', $kurir->alamat, ['class' => $errors->has('alamat') ? 'form-control is-invalid' : 'form-control', 'required', 'autofocus']) !!}
                    @if ($errors->has('alamat'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('alamat') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group">
                <label for="nama">Nama Kendaraan</label>
                    {!! Form::text('nama_kendaraan', null, ['class' => $errors->has('nama_kendaraan') ? 'form-control is-invalid' : 'form-control', 'required', 'autofocus']) !!}
                    @if ($errors->has('nama_kendaraan'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('nama_kendaraan') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="nama">Nomor Polisi</label>
                    {!! Form::text('nomor_polisi', null, ['class' => $errors->has('nomor_polisi') ? 'form-control is-invalid' : 'form-control', 'required', 'autofocus']) !!}
                    @if ($errors->has('nomor_polisi'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('nomor_polisi') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group">
                <label for="email">Email</label>
                    {!! Form::email('email', $kurir->user->email, ['class' => $errors->has('email') ? 'form-control is-invalid' : 'form-control', 'required']) !!}
                    @if ($errors->has('email'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="email">Level</label>
                    {!! Form::text('level', 'kurir', ['class' => $errors->has('level') ? 'form-control is-invalid' : 'form-control', 'required', 'readonly']) !!}
                    @if ($errors->has('level'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('level') }}</strong>
                        </span>
                    @endif
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