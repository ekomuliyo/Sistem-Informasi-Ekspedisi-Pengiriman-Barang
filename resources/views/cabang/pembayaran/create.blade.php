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
            <a href="#">Pembayaran</a>
        </li>
        <li class="breadcrumb-item active">Pelanggan Langganan</li>
        <li class="breadcrumb-item active">Rincian Pembayaran</li>
    </ol>
    <!-- Icon Cards-->
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header text-white bg-primary">
                    Rincian Pembayaran
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <tr>
                            <th>Nama Pelanggan</th>
                            <td>{{ $pengiriman[0]->nama_pengirim }}</td>
                        </tr>
                        <tr>
                            <th>Total Pengiriman</th>
                            <td>{{ $pengiriman->count() }}</td>
                        </tr>
                        <?php $sum_total_bayar = 0; ?>
                        @foreach($pengiriman as $d)
                        <?php $sum_total_bayar = $sum_total_bayar + $d->jumlah_biaya ?>
                        @endforeach
                        <tr>
                            <th>Total Bayar</th>
                            <td id="id_total_bayar">Rp. {{ formatRupiah($sum_total_bayar) }}</td>
                        </tr>
                    </table>
                    
                    <table class="table table-bordered">
                        <tr>
                            <th>No.</th>
                            <th>Nama Penerima</th>
                            <th>Kota Penerima</th>
                            <th>Alamat Lengkap</th>
                            <th>Tanggal Dikirim</th>
                            <th>Tanggal Diterima</th>
                        </tr>
                        
                        <?php $no = 0; ?>
                        @foreach($pengiriman as $d)
                        <?php $no++ ?>
                        <tr>
                            <td>{{ $no }}</td>
                            <td>{{ $d->nama_penerima }}</td>
                            <td>{{ $d->kecamatan_penerima->kota->nama }}</td>
                            <td>{{ $d->kecamatan_penerima->nama }} {{ $d->alamat_penerima }}</td>
                            <td>{{ $d->created_at }}</td>
                            <td>{{ $d->status_pengiriman[0]->detail_status_pengiriman[$d->status_pengiriman[0]
                                ->detail_status_pengiriman->count()-1]->created_at }}</td>
                            </tr>
                            @endforeach
                        </table>
                        
                        {!! Form::open(['route' => ['cabang.pembayaran.update', $pengiriman[0]->id_user ], 'method' => 'PUT', 'onsubmit' =>
                            "return validasiPembayaran();"]) !!}
                            <div class="form-group">
                                <label class="control-label col-md-12">Masukan Uang Bayar</label>
                                <div class="col-md-12">
                                    <input type="text" class="form-control" id="id_jumlah_bayar" name="jumlah_bayar" min="1"
                                    placeholder="Jumlah Bayar" required>
                                </div>
                            </div>
                            <div class="col md-12">
                                <input class="btn btn-primary" type="submit" id="btn_perbarui" value="Bayar">
                            </div>
                            {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>


@endsection

@section('assets-bottom')
<script type="text/javascript">
    var total_bayar = document.getElementById('id_total_bayar').textContent;
    var jumlah_bayar = document.getElementById('id_jumlah_bayar');

    jumlah_bayar.addEventListener('keyup', function(e){
        var bayar = this.value;
        jumlah_bayar.value = formatRupiah(bayar);
    });

    function formatRupiah(angka){
        var number_string = angka.replace(/[^,\d]/g, '').toString(),
        split   		= number_string.split(','),
        sisa     		= split[0].length % 3,
        rupiah     		= split[0].substr(0, sisa),
        ribuan     		= split[0].substr(sisa).match(/\d{3}/gi);

        // tambahkan titik jika yang di input sudah menjadi angka ribuan
        if(ribuan){
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }

        return rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
    }


    function validasiPembayaran() {

        total_bayar = total_bayar.split('Rp. ').join('');
        total_bayar = total_bayar.split('.').join('');
        
        jumlah_bayar = jumlah_bayar.value;
        jumlah_bayar = jumlah_bayar.split('.').join('');

        
        if (parseInt(jumlah_bayar) < parseInt(total_bayar)) {
            alert("Uang yang anda masukan tidak cukup!");
            return false;
        }else{
            return true;
        }
    }
</script>
@endsection