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
                        <label for="bulan">Pilih bulan :</label>
                        <div class="col-md-6">
                            <input type="month" class="form-control" name="bulan" min="2019-01" value="2019-01">
                            <div class="card-footer bg-transparent">
                                <button class="btn btn-primary" type="submit">
                                    Tampilkan
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @endsection