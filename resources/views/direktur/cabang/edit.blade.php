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
                        @if ($errors->has('nama'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('nama') }}</strong>
                            </span>
                        @endif
                </div>
                <div class="form-group">
                    <label for="nama">Nomor HP</label>
                        {!! Form::text('no_hp', $cabang->no_hp, ['class' => $errors->has('no_hp') ? 'form-control is-invalid' : 'form-control', 'required', 'autofocus']) !!}
                        @if ($errors->has('no_hp'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('no_hp') }}</strong>
                            </span>
                        @endif
                </div>
                <div class="form-group">
                    <label for="nama">Alamat</label>
                    {!! Form::textarea('alamat', $cabang->alamat, ['class' => $errors->has('alamat') ? 'form-control is-invalid' : 'form-control', 'required', 'autofocus']) !!}
                    @if ($errors->has('alamat'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('alamat') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="email">Level</label>
                    {!! Form::text('level', 'admin', ['class' => $errors->has('level') ? 'form-control is-invalid' : 'form-control', 'required', 'readonly']) !!}
                    @if ($errors->has('level'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('level') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    {!! Form::password('password', ['class' => $errors->has('password') ? 'form-control is-invalid' : 'form-control']) !!}
                    @if ($errors->has('password'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="foto">Foto</label>
                    <div class="input-group">
                        <span class="input-group-btn">
                            <a id="lfm" data-input="foto" data-preview="holder" class="btn btn-primary text-white">
                                <i class="fa fa-cloud-upload"></i> Pilih
                            </a>
                        </span>
                        {!! Form::text('foto', null, ['id' => 'foto', 'class' => $errors->has('foto') ? 'form-control is-invalid' : 'form-control', 'readonly']) !!}
                        @if ($errors->has('foto'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('foto') }}</strong>
                            </span>
                        @endif
                    </div>
                    <img id="holder" style="margin-top:15px;max-height:254px;max-width: 152px;">
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