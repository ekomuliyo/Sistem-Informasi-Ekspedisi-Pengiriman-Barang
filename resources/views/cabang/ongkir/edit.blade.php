@extends('layouts.cabang.app')

@section('content')

<div class="container-fluid">
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a href="#">Ongkir</a>
      </li>
      <li class="breadcrumb-item active">Ubah</li>
    </ol>

    <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header text-white bg-primary">
              Ubah Ongkir
              </div>
              {!! Form::model($ongkir, ['route' => ['cabang.ongkir.update', $ongkir->id], 'method' => 'PUT']) !!}
                <div class="form-group">
                    <label for="asal">Kota Asal</label>
                    {!! Form::text('asal', 'jakarta', ['class' => $errors->has('asal') ? 'form-control is-invalid' : 'form-control', 'readonly']) !!}
                </div>
                <div class="form-group">
                    <label for="tujuan">Kota Tujuan</label>
                    {!! Form::select('tujuan', ['1' => 'Palembang', '2'=>'Jambi', '3'=>'Pekanbaru', '4'=>'Padang'], null, ['class' => 'form-control', 'placeholder' => 'Pilih Kota']) !!}
                </div>
                <div class="form-group">
                    <label for="estimasi">Estimasi Pengiriman</label>
                    <div class="row">
                        <div class="col-md-1">
                            {!! Form::number('awal', $ongkir->estimasi{0}, ['class' => $errors->has('awal') ? 'form-control is-invalid' : 'form-control', 'required', 'autofocus', 'min' => '1']) !!}
                        </div>
                        <div class="col-md-0">-</div>
                        <div class="col-md-1">
                            {!! Form::number('akhir', $ongkir->estimasi{4}, ['class' => $errors->has('akhir') ? 'form-control is-invalid' : 'form-control', 'required', 'autofocus', 'min' => '2']) !!}
                        </div>
                        <div class="col-md-9">Hari</div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="harga">Harga (Kg)</label>
                    {!! Form::number('harga', null, ['class' => $errors->has('harga') ? 'form-control is-invalid' : 'form-control', 'required', 'autofocus', 'min' => '1']) !!}
                </div>
                <div class="card-footer bg-transparent">
                <button class="btn btn-primary" type="submit">
                    Masukan
                </button>
                </div>
              {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>


@endsection