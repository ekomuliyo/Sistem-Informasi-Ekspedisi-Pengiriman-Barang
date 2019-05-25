<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Cetak Data Pengiriman Barang</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
    @foreach($pengiriman as $d)
    <table style="background-color: #ffffff; filter: alpha(opacity=40); opacity: 0.95;border:1px black solid;"  >
        <tr>
            <td width="250">Pengirim : {{ $d->pelanggan_pengirim->user->nama }}</td>
            <td width="250">Penerima : {{ $d->pelanggan_penerima->user->nama }}</td>
            <td rowspan="5">{!! QrCode::size(200)->generate($d->id); !!}</td>
        </tr>
        <tr>
            <td>Kota Asal : Jakarta</td>
            @if($d->pelanggan_penerima->kota == 1)<td>Kota : Palembang</td>
            @elseif($d->pelanggan_penerima->kota == 2)<td>Kota : Jambi</td>
            @elseif($d->pelanggan_penerima->kota == 3)<td>Kota : Pekanbaru</td>
            @else<td>Kota : Padang</td>                                                                                                
            @endif
            <td></td>
        </tr>
        <tr>
            <td>Alamat Pengirim : </br> {{ $d->pelanggan_pengirim->alamat }}</td>
            <td>Alamat Penerima : </br> {{ $d->pelanggan_penerima->alamat }}</td>
            <td></td>
        </tr>
        <tr>
            <td>Berat : {{ $d->berat}} Kg</td>
            <td>Jumlah Biaya : Rp. {{ $d->jumlah_biaya }},-</td>
            <td></td>
        </tr>
        <tr>
            @if($d->metode_pembayaran == 1) <td>Metode Pembayaran : </br>Bayar di Jakarta</td>
            @elseif($d->metode_pembayaran == 2) <td>Metode Pembayaran : </br>Bayar di Tujuan</td>
            @elseif($d->metode_pembayaran == 3) <td>Metode Pembayaran : </br>Transfer</td>
            @else<td>Metode Pembayaran : </br>Langganan</td>
            @endif
            <td>No Resi : {{ $d->id }}</td>
        </tr>
    </table></br>
    @endforeach
</body>
</html>
