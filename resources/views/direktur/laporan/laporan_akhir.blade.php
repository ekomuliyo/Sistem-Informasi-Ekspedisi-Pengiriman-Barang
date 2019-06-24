@extends('layouts.direktur.app')

@section('content')

<div class="container-fluid">
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="#">Laporan Akhir</a>
        </li>
    </ol>
    <!-- Icon Cards-->
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="form-control">
                    <div class="form-group">
                        <div class="col-md-12">
                            {!! Form::open(['route' => 'direktur.laporan.akhir.create', 'method' => 'POST']) !!}
                            <div class="row">
                                <div class="col-md-2">
                                    <label for="awal">Tanggal Awal :</label>
                                </div>
                                <div class="col-md-3">
                                    <input type="date" name="date_awal">
                                </div>
                                <div class="col-md-2">
                                    <label for="akhir">Tanggal Akhir : </label>
                                </div>
                                <div class="col-md-2">
                                    <input type="date" name="date_akhir">
                                </div>
                                <div class="col-md-2">
                                    <button class="btn btn-primary" type="submit">
                                        Cetak
                                    </button>
                                </div>
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection