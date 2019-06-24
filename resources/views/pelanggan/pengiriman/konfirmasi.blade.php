@extends('layouts.pelanggan.app')

@section('content')

<div class="container-fluid">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="#">Konfirmasi</a>
        </li>
    </ol>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header text-white bg-primary">
                    Konfirmasi pembayaran
                </div>
                @if(!empty($errors->first()))
                    <div class="row col-lg-12">
                        <div class="alert alert-danger">
                            <span>{{ $errors->first() }}</span>
                        </div>
                    </div>
                @endif
                {!! Form::open(['route' => 'pelanggan.pengiriman.konfirmasi.store', 'method' => 'POST']) !!}
                <div class="form-control">
                    <h6>Silahkan lakukan pembayaran!!</br>
                    Nomor Rekening Mandiri : 905098190809809 A/n PT. Bunga Lintas Cargo</br>
                    Sejumlah : Rp. {{ $pengiriman->jumlah_biaya}}</h6>  
                </div>
                <div class="form-control">
                    <label for="foto">Upload bukti pembayaran</label>
                    <div class="input-group">
                        <span class="input-group-btn">
                            <a id="lfm" data-input="foto" data-preview="holder" class="btn btn-primary text-white">
                                <i class="fa fa-cloud-upload"></i> Pilih
                            </a>
                        </span>
                        {!! Form::text('foto', null, ['id' => 'foto', 'class' => $errors->has('foto') ? 'form-control is-invalid' : 'form-control', 'required', 'readonly']) !!}
                    </div>
                </div>
                <img id="holder" style="margin-top:15px;max-height:300px;max-width: 300px;">

                <input type="text" name="id_pengiriman" value="{{ $pengiriman->id }}" hidden>
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

@section('assets-bottom')
    <script src="{{ asset('vendor/laravel-filemanager/js/lfm.js') }}"></script>
    <script>
        $(document).ready( function () {
            $('#lfm').filemanager('image', {prefix : "{{ URL::to('laravel-filemanager') }}"});
        });
    </script>
@endsection