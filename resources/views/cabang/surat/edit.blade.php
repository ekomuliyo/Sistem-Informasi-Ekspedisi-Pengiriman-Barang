@extends('layouts.cabang.app')

@section('content')
    <div class="container-fluid">
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="#">Surat</a>
            </li>
            <li class="breadcrumb-item active">Ubah</li>
        </ol>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header text-white bg-primary">
                        Ubah Surat
                    </div>
                    {!! Form::model($surat, ['route' => ['cabang.surat.update', $surat->id], 'method' => 'PUT']) !!}
                    <div class="form-group">
                        <label for="nomor">Nomor Surat</label>
                        {!! Form::text('nomor_surat', $surat->nomor_surat, ['class' => $errors->has('no_surat') ? 'form-control is-invalid' : 'form-control', 'readonly']) !!}
                    </div>
                    <div class="form-group">
                    <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Nama Kurir</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <select name="id_kurir" id="nameid" class ="form-control" required name="id_kurir" readonly>
                                    <option value="{{ $surat->id_kurir }}" >{{$surat->kurir->user->nama}}</option>
                            </select>
                            </div>
                    </div>

                    <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Tanggal Surat</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input name="tgl_surat" class="form-control" value="{{ $surat->tgl_surat }}" type="date" readonly/>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="nomor">Keterangan</label>
                        {!! Form::select('keterangan', ['Sedang dalam perjalanan menuju Palembang' => 'Sedang dalam perjalanan menuju Palembang', 
                                                        'Sedang dalam perjalanan menuju Jambi'=>'Sedang dalam perjalanan menuju Jambi', 
                                                        'Sedang dalam perjalanan menuju Pekanbaru'=>'Sedang dalam perjalanan menuju Pekanbaru', 
                                                        'Sedang dalam perjalanan menuju Padang'=>'Sedang dalam perjalanan menuju Padang'], 
                                                        $surat->keterangan, ['class' => 'form-control', 'placeholder' => 'Pilih Kota']) !!}
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