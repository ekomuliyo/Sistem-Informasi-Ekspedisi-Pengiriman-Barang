@extends('layouts.cabang.app')

@section('content')

<?php
    function formatRupiah($angka){
        $hasil_rupiah = number_format($angka,0,'.','.');
        return $hasil_rupiah;
    } 
?>

<div class="container-fluid">
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="#">Validasi Pengiriman</a>
        </li>
    </ol>
    <!-- Icon Cards-->
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header text-white bg-primary">
                    Validasi Pengiriman : {{ $pengiriman[0]->nama_penerima }}
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <tr>
                            <th>Nomor Resi</th>
                            <td>{{ $pengiriman[0]->no_resi }}</td>
                        </tr>
                        <tr>
                            <th>Pengirim</th>
                            <td>{{ $pengiriman[0]->nama_pengirim }}</td>
                        </tr>
                        <tr>
                            <th>Penerima</th>
                            <td>{{ $pengiriman[0]->nama_penerima }}</td>
                        </tr>
                        <tr>
                            <th>Kota Tujuan</th>
                            <td>{{ $pengiriman[0]->kecamatan_penerima->kota->nama }}</td>
                        </tr>
                        <tr>
                            <th>Alamat Lengkap</th>
                            <td>{{ $pengiriman[0]->alamat_penerima }}</td>
                        </tr>
                        <tr>
                            <th>Metode Pembayaran</th>
                            @if($pengiriman[0]->metode_pembayaran == 1)
                            <td>Cash</td>
                            @elseif($pengiriman[0]->metode_pembayaran == 2)
                            <td>COD</td>
                            @elseif($pengiriman[0]->metode_pembayaran == 3)
                            <td>Transfer</td>
                            @else
                            <td>Langganan</td>
                            @endif
                        </tr>
                        <tr>
                            <th>Jumlah Bayar</th>
                            <td>Rp. {{  formatRupiah($pengiriman[0]->jumlah_biaya) }}</td>
                        </tr>
                    </table>
                    @if($pengiriman[0]->metode_pembayaran == 3)
                    @if($pengiriman[0]->foto != null)
                    {!! Form::open(['route' => 'cabang.pengiriman.status.store', 'method' => 'POST']) !!}
                    <div class="row">
                        <div class="col-md-12">
                            <h5>Bukti Pembayaran</h5>
                        </div>
                        <div class="col-md-12">
                            <img src="{{ asset($pengiriman[0]->foto) }}" alt="Bukti pembayaran"
                                width="300" height="300">
                        </div>
                    </div></br>

                    <label class="radio-inline">
                        <input type="radio" name="validasi" value="1" checked required>Validasi
                    </label> &nbsp;&nbsp;
                    <label class="radio-inline">
                        <input type="radio" name="validasi" value="0">Batal
                    </label>

                    <input type="text" name="id_pengiriman" value="{{ $pengiriman[0]->id }}" hidden>

                    <div class="card-footer bg-transparent">
                        <button class="btn btn-primary" type="submit">
                            Validasi
                        </button>
                    </div>
                    {!! Form::close() !!}
                    @else
                    <div class="row col-lg-12">
                        <div class="alert alert-danger">
                            <span>Pelanggan belum melakukan konfirmasi pembayaran!</span>
                        </div>
                    </div>
                    @endif
                    @else
                    {!! Form::open(['route' => 'cabang.pengiriman.status.store', 'method' => 'POST']) !!}
                    <h6>Validasi Pengiriman</h6>
                    <label class="radio-inline">
                        <input type="radio" name="validasi" value="1" checked required>Validasi
                    </label> &nbsp;&nbsp;
                    <label class="radio-inline">
                        <input type="radio" name="validasi" value="0">Batal
                    </label>

                    <input type="text" name="id_pengiriman" value="{{ $pengiriman[0]->id }}" hidden>

                    <div class="card-footer bg-transparent">
                        <button class="btn btn-primary" type="submit">
                            Validasi
                        </button>
                    </div>
                    {!! Form::close() !!}
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@endsection