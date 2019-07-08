@extends('layouts.cabang.app')

@section('assets-top')

<link rel="stylesheet" href="{{ asset('assets/blog-admin/vendor/magnific-popup/magnific-popup.css') }}">

@endsection

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
            <a href="#">Pengiriman</a>
        </li>
        <li class="breadcrumb-item active">
            Validasi Pengiriman
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
                            <a href="{{ asset($pengiriman[0]->foto) }}" class="view"><img src="{{ asset($pengiriman[0]->foto) }}" alt="Bukti pembayaran"
                                width="300" height="300"></a>
                        </div>
                    </div></br>

                    <input type="text" name="id_pengiriman" value="{{ $pengiriman[0]->id }}" hidden>

                    <div class="card-footer bg-transparent">
                        <button class="btn btn-primary" type="submit" name="validasi" value="1"><i class="fa fa-check-circle"></i>
                            VALIDASI
                        </button>
                        <button class="btn btn-warning" type="submit" name="validasi" value="0"> <i class="fa fa-times"></i>
                            BATAL
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

                    <input type="text" name="id_pengiriman" value="{{ $pengiriman[0]->id }}" hidden>

                    <div class="card-footer bg-transparent">
                        <button class="btn btn-primary" type="submit" name="validasi" value="1"><i class="fa fa-check-circle"></i>
                            VALIDASI
                        </button>
                        <button class="btn btn-warning" type="submit" name="validasi" value="0"> <i class="fa fa-times"></i>
                            BATAL
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

@section('assets-bottom')
<script src="{{ asset('assets/blog-admin/vendor/magnific-popup/magnific-popup.min.js') }}"></script>
<script type="text/javascript">
$(".view").magnificPopup({
  type: 'image'
});
</script>
@endsection