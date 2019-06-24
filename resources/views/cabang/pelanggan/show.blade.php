@extends('layouts.cabang.app')

@section('content')

<!-- untuk mengambil data tanggal dengan php -->
<?php
    function tanggal_indo($tanggal)
    {
    	$bulan = array (1 =>   'Januari',
    				'Februari',
    				'Maret',
    				'April',
    				'Mei',
    				'Juni',
    				'Juli',
    				'Agustus',
    				'September',
    				'Oktober',
    				'November',
    				'Desember'
    			);
    	$split = explode('-', $tanggal);
    	return $split[2] . ' ' . $bulan[ (int)$split[1] ] . ' ' . $split[0];
    }?>

<div class="container-fluid">
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="#">Pelanggan</a>
        </li>
        <li class="breadcrumb-item active">Tampilkan</li>
    </ol>
    <!-- Icon Cards-->
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header text-white bg-primary">
                    Detail Pelanggan :
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12" align="center">
                            <img src="{{ asset($pelanggan->user->foto) }}" class="rounded-circle" alt="Foto" width="200"
                                height="200">
                        </div>
                    </div>
                    <table class="table table-striped">
                        <tr>
                            <th>ID</th>
                            <td>{{ $pelanggan->id }}</td>
                        </tr>
                        <tr>
                            <th>Nama</th>
                            <td>{{ $pelanggan->user->nama }}</td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td>{{ $pelanggan->user->email }}</td>
                        </tr>
                        <tr>
                            <th>Jenis Kelamin</th>
                            @if($pelanggan->jenis_kelamin == 1)
                            <td>Laki-Laki</td>
                            @else
                            <td>Perempuan</td>
                            @endif
                        </tr>
                        <tr>
                            <th>Tanggal Lahir</th>
                            <td>{{ tanggal_indo($pelanggan->tgl_lahir) }}</td>
                        </tr>
                        <tr>
                            <th>Kota</th>
                            <td>{{ $pelanggan->kecamatan->kota->nama }}</td>
                        </tr>
                        <tr>
                            <th>Kecamatan</th>
                            <td>{{ $pelanggan->kecamatan->nama }}</td>
                        </tr>
                        <tr>
                            <th>Alamat Lengkap</th>
                            <td>{{ $pelanggan->alamat }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection