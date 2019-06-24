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

    <?php
        function rupiah($angka){
            $hasil_rupiah = number_format($angka,0,'.','.');
            return $hasil_rupiah;
        } 
    ?>

    <!-- awal isi laporan harian -->
    <table width="100%" border="1px" class="tabel_isi_2" id="tabel_isi_2">
        <tr>
            <th rowspan="2">No.</th>
            <th rowspan="2">No. SPB</th>
            <th rowspan="2">Pengirim</th>
            <th rowspan="2">Penerima</th>
            <th rowspan="2">Koli</th>
            <th rowspan="2">Kg</th>
            <th colspan="4">Keterangan</th>
        </tr>
        <tr>
            <th>Cash</th>
            <th>COD</th>
            <th>Transfer</th>
            <th>Langganan</th>
        </tr>
        <?php $no=0; ?>
        @foreach($transaksi_pengiriman as $d)
        <?php $no++ ?>
        <tr>
            <td>{{ $no }}</td>
            <td>{{ $d->pengiriman->no_resi }}</td>
            <td>{{ $d->pengiriman->nama_pengirim }}</td>
            <td>{{ $d->pengiriman->nama_penerima }}</td>
            <td>{{ $d->pengiriman->koli->count() }}</td>
            <td>{{ $d->pengiriman->berat }}</td>
            @if($d->pengiriman->metode_pembayaran == 1)
            <td>{{ rupiah($d->pengiriman->jumlah_biaya) }}</td>
            <td></td>
            <td></td>
            <td></td>
            @elseif($d->pengiriman->metode_pembayaran == 2)
            <td></td>
            <td>{{ rupiah($d->pengiriman->jumlah_biaya) }}</td>
            <td></td>
            <td></td>
            @elseif($d->pengiriman->metode_pembayaran == 3)
            <td></td>
            <td></td>
            <td>{{ rupiah($d->pengiriman->jumlah_biaya) }}</td>
            <td></td>
            @else
            <td></td>
            <td></td>
            <td></td>
            <td>{{ rupiah($d->pengiriman->jumlah_biaya) }}</td>
            @endif
        </tr>
        @endforeach
        <tr>
            <td rowspan="2" colspan="4">Jumlah</td>
            <td id="total_koli"></td>
            <td id="total_kg"></td>
            <td id="total_cash"></td>
            <td id="total_cod"></td>
            <td id="total_transfer"></td>
            <td id="total_langganan"></td>
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
            <td align="center">Rp. {{ rupiah($d->pengiriman->kecamatan_penerima->ongkir[0]->harga) }}</td>
            <td align="center">Rp. {{ rupiah($d->pengiriman->jumlah_biaya) }}</td>
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

<script type="text/javascript">
    var table = document.getElementById("tabel_isi_2");
    var sumKoli = 0;
    var sumKg = 0;
    var sumCash = 0;
    var sumCOD = 0;
    var sumTransfer = 0;
    var sumLangganan = 0;

    for (let i = 2; i < table.rows.length-1; i++) {
        // menjumlahkan total koli
        sumKoliTampung = parseInt(table.rows[i].cells[4].innerHTML);
        if (isNaN(sumKoliTampung)) {
            sumKoliTampung = 0
        }
        sumKoli = sumKoli + sumKoliTampung;

        // menjumlahkan total kg
        sumKgTampung = parseInt(table.rows[i].cells[5].innerHTML);
        if (isNaN(sumKoliTampung)) {
            sumKgTampung = 0
        }
        sumKg = sumKg + sumKgTampung;

        // menjumlahkan total cash
        sumCashTampung = table.rows[i].cells[6].innerHTML;
        if (isNaN(sumCashTampung)) {
            sumCashTampung = 0
        }
        sumCash = sumCash + parseInt(sumCashTampung.replace('.',''));

        // menjumlahkan total cod
        sumCODTampung = table.rows[i].cells[7].innerHTML;
        if (isNaN(sumCODTampung)) {
            sumCODTampung = 0
        }
        sumCOD = sumCOD + parseInt(sumCODTampung.replace('.',''));

        // menjumlahkan total transfer
        sumTransferTampung = table.rows[i].cells[8].innerHTML;
        if (isNaN(sumTransferTampung)) {
            sumTransferTampung = 0
        }
        sumTransfer = sumTransfer + parseInt(sumTransferTampung.replace('.',''));
                
        // menjumlahkan total langganan
        sumLanggananTampung = table.rows[i].cells[9].innerHTML;
        if (isNaN(sumLanggananTampung)) {
            sumLanggananTampung = 0
        }
        sumLangganan = sumLangganan + parseInt(sumLanggananTampung.replace('.','')) ;
    }   

    document.getElementById("total_koli").innerHTML = sumKoli;
    document.getElementById("total_kg").innerHTML = sumKg;
    document.getElementById("total_cash").innerHTML = formatRupiah(sumCash);
    document.getElementById("total_cod").innerHTML = formatRupiah(sumCOD);
    document.getElementById("total_transfer").innerHTML = formatRupiah(sumTransfer);
    document.getElementById("total_langganan").innerHTML = formatRupiah(sumLangganan);

    // fungsi format rupiah
    function formatRupiah(angka){
        var number_string = angka.toString(),
        sisa     		= number_string.length % 3,
        rupiah     		= number_string.substr(0, sisa),
        ribuan     		= number_string.substr(sisa).match(/\d{3}/gi);
    
        // tambahkan titik jika yang di input sudah menjadi angka ribuan
        if(ribuan){
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }
        return rupiah;
    }

</script>

</html>
