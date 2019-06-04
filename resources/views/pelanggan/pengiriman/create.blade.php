@extends('layouts.pelanggan.app')

@section('content')

<div class="container-fluid">
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="#">Pengiriman Barang</a>
        </li>
        <li class="breadcrumb-item active">Tambah Pengiriman Barang</li>
    </ol>
    <!-- Icon Cards-->
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header text-white bg-primary">
                    Tambah Pengiriman Barang
                </div></br>
                @if(Auth::user()->pelanggan->id_kecamatan == null)
                    <div class="row col-lg-12">
                        <div class="alert alert-danger">
                            <span>Anda belum bisa melakukan pengiriman, silahkan perbarui data profil anda!</span>
                        </div>
                    </div>
                @else
                    {!! Form::open(['route' => 'pelanggan.pengiriman.store', 'method' => 'POST']) !!}
                        @include('pelanggan.pengiriman._form')
                    {!! Form::close() !!}
                @endif
            </div>
        </div>
    </div>
</div>

@endsection