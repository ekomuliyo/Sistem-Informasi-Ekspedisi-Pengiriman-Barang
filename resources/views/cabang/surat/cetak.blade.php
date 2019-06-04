<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Cetak Data Pengiriman Barang</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style rel="stylesheet">
    hr{ 
      border: 1.5px solid black;  
    }
    td{
        font-size:9px;
    }
    .tabel_isi{
        border: 1px solid black;
        border-collapse: collapse;
    }
    .tabel_isi_2{
        border: 1px solid black;
        border-collapse: collapse;
    }
    @media print {
        p { page-break-after: always; }
    }
    </style>
</head>
<body onload="window.print()">

    <!-- kop atas -->
    <table align="center" width="100%">
        <tr>
            <td rowspan="7"><img src="{{ asset('assets/blog-admin/image/logo.jpeg') }}" alt="Logo" width="159" height="150"></td>
            <td colspan="3" align="center"><h1><font size="12" color="red">Bunga Lintas Cargo</font></h1></td>
        </tr>
        <tr>
            <td colspan="3"><center><font size="3">Rute Pengiriman : Jakarta - Palembang - Pekanbaru - Bukit Tinggi</font></br>
                                                    <font size="5">Hadir Untuk Menunjang Kelancaran Usaha Anda</font></center></td>
        </tr>
        <tr>
            <td width="50">Head Office</td>
            <td colspan="2">: Jl. K.H Mas Mansyur No.25 A, Komp. Said Naum, Tanah Abang, Telp. 0812 1067 7914</td>
        </tr>
        <tr>
            <td>Jakarta</td>
            <td colspan="2">: Jl. Kebon Kacang I No.27 (Samping Metro Tanah Abang), Telp. 0812 1067 7913 Lantai 5 Thamrin(Lapangan Parkir Lt.5)</td>
        </tr>
        <tr>
            <td>Bukit Tinggi</td>
            <td colspan="2">: Jl. Parak Kubang Belakang Pasar Aur Kuning No.40 Telp. 0812 9499 9742</td>
        </tr>
        <tr>
            <td>Pekanbaru</td>
            <td colspan="2">: Jl. Depan Garuda Ujung Depan SMP 37, Kel. Tangkerang Kec. Marpoyan Damai Pekanbaru Hp. 0812 7557 2008</td>
        </tr>
        <tr>
            <td>Palembang</td>
            <td colspan="2">: Jl. Pandawa No.53B RT.17 RW.04 Kel. F13 Kec. Ilir Lemabang Palembang Telp. 0821 1435 3116</td>
        </tr>
    </table>
    <!-- akhir kop atas -->

    <!-- awal isi laporan harian -->
    <table width="100%" border="1px" class="tabel_isi_2">
        <tr>
            <th rowspan="2">No.</th>
            <th rowspan="2">No. SPB</th>
            <th rowspan="2">Pengirim</th>
            <th rowspan="2">Penerima</th>
            <th rowspan="2">Koli</th>
            <th rowspan="2">Kg</th>
            <th colspan="2">Keterangan</th>
        </tr>
        <tr>
            <th>COD</th>
            <th>Cash</th>
        </tr>
        <tr>
            <td>1</td>
            <td>098765</td>
            <td>Andi</td>
            <td>Rudi</td>
            <td>11</td>
            <td>10</td>
            <td>Y</td>
            <td>-</td>
        </tr>
        <tr>
            <td>2</td>
            <td>095859</td>
            <td>Aan</td>
            <td>Toni</td>
            <td>8</td>
            <td>5</td>
            <td>Y</td>
            <td>-</td>
        </tr>
        <tr>
            <td rowspan="2" colspan="4">Jumlah</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
    </table>
    <p align="right">Jakarta, 12-12-2019</p>
    <!-- akhir isi laporan harian -->

    <!-- kop atas -->
    @foreach($transaksi_pengiriman as $d)
    <table align="center">
        <tr>
            <td rowspan="7"><img src="{{ asset('assets/blog-admin/image/logo.jpeg') }}" alt="Logo" width="159" height="150"></td>
            <td colspan="3" align="center"><h1><font size="12" color="red">Bunga Lintas Cargo</font></h1></td>
        </tr>
        <tr>
            <td colspan="3"><hr></td>
        </tr>
        <tr>
            <td width="50">Head Office</td>
            <td colspan="2">: Jl. K.H Mas Mansyur No.25 A, Komp. Said Naum, Tanah Abang, Telp. 0812 1067 7914</td>
        </tr>
        <tr>
            <td>Jakarta</td>
            <td colspan="2">: Jl. Kebon Kacang I No.27 (Samping Metro Tanah Abang), Telp. 0812 1067 7913 Lantai 5 Thamrin(Lapangan Parkir Lt.5)</td>
        </tr>
        <tr>
            <td>Bukit Tinggi</td>
            <td colspan="2">: Jl. Parak Kubang Belakang Pasar Aur Kuning No.40 Telp. 0812 9499 9742</td>
        </tr>
        <tr>
            <td>Pekanbaru</td>
            <td colspan="2">: Jl. Depan Garuda Ujung Depan SMP 37, Kel. Tangkerang Kec. Marpoyan Damai Pekanbaru Hp. 0812 7557 2008</td>
        </tr>
        <tr>
            <td>Palembang</td>
            <td colspan="2">: Jl. Pandawa No.53B RT.17 RW.04 Kel. F13 Kec. Ilir Lemabang Palembang Telp. 0821 1435 3116</td>
        </tr>
        <tr>
            <td><font size="3">No. Resi : {{ $d->pengiriman->no_resi }}</font></td>
            <td colspan="2" width="1700" align="center"><font size="3" color="red">Surat Pengiriman Barang (SPB)</font></td>
            <td align="right"><font size="3" color="red">{{ $d->pengiriman->kecamatan_penerima->kota->kode }}</font></td>
        </tr>
    </table>
    <!-- akhir kop atas -->

    <!-- isi surat perjalanan -->
    <table align="center" class="tabel_isi" border="1px" width="100%">
        <tr>
            <td rowspan="2" width="200" >Penerima : {{ $d->pengiriman->nama_penerima }} </br> 
            Alamat : Kota {{ $d->pengiriman->kecamatan_penerima->kota->nama }} / {{ $d->pengiriman->kecamatan_penerima->nama }}</br>{{ $d->pengiriman->alamat_penerima }} </td>
            <td width="100" align="center" height="10">Koli</td>
            <td width="100" align="center">Rincian Koli</td>
            <td width="150" align="center">Barcode</td>
        </tr>
        <tr>
            <td align="center">{{ $d->pengiriman->koli->count() }}</td>
            <td align="center">@foreach($d->pengiriman->koli as $k) - {{ $k->deskripsi }} </br> @endforeach</td>
            <td rowspan="2" align="center">{!! QrCode::size(130)->generate($d->pengiriman->id) !!}</td>
        </tr>
        <tr>
            <td rowspan="2" width="200">Pengirim : Rudi </br> 
            Alamat : {{ $d->pengiriman->kecamatan_pengirim->kota->nama }} / {{ $d->pengiriman->kecamatan_pengirim->nama }}</br>{{ $d->pengiriman->alamat_pengirim }} </td>
            <td align="center" height="10">Total KG</td>
            <td align="center">Harga / KG</td>
        </tr>
        <tr>
            <td align="center">{{ $d->pengiriman->berat }}</td>
            <td align="center">Rp. {{ $d->pengiriman->kecamatan_penerima->ongkir[0]->harga }}</td>
            <td align="center">Rp. {{ $d->pengiriman->jumlah_biaya }}</td>
        </tr>
        <tr>
            <td align="center">Tanda Tangan Penerima</td>
            <td align="center">Tanda Tangan Pengirim</td>
            <td align="center">Petugas</td>
            <td align="center"> Tanggal</td>
        </tr>
        <tr>
            <td height="50"></td>
            <td></td>
            <td></td>
            <td align="center"><?php echo date("d-m-Y"); ?></td>
        </tr>
    </table>
    <label for="catatan"><font size="0.5">Catatan : Barang tidak kami periksa, isi paket kiriman sepenuhnya tanggung jawab pengirim dan penerima</font></label>
    <br>
    @endforeach
    <!-- akhir isi surat perjalanan -->
</body>
</html>
