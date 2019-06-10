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
                        <div class="col-md-6">
                            {!! Form::open(['route' => 'direktur.laporan.akhir.create', 'method' => 'POST']) !!}
                            <label for="awal">Tanggal Awal</label>
                            <input type="date" name="date_awal">
                            <label for="akhir">Tanggal Akhir</label>
                            <input type="date" name="date_akhir">
                            <button class="btn btn-primary" type="submit">
                                Cetak
                            </button>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
