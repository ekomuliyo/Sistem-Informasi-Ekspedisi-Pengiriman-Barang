<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{ asset('assets/blog-admin/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <title>Cetak Laporan Akhir</title>
    <style rel="stylesheet">
    td{
        font-size:14px;
    }
    </style>
</head>

<body onload="window.print()">

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
    }
    function formatRupiah($angka){
        $hasil_rupiah = number_format($angka,0,'.','.');
        return $hasil_rupiah;
    } 
    ?>

    <!-- kop atas -->
    <table width="100%">
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
    <!-- akhir kop atas --></br>

    <h5>Dari Tanggal : <?php echo tanggal_indo($awal)?> S/D <?php echo tanggal_indo($akhir)?> </h5>

    <table class="table table-bordered text-center" id="table">
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
        @foreach($status_pengiriman as $data)
        <?php $no++ ?>
        <tr>
            <td>{{ $no }}</td>
            <td>{{ $data->pengiriman->no_resi }}</td>
            <td>{{ $data->pengiriman->nama_pengirim }}</td>
            <td>{{ $data->pengiriman->nama_penerima }}</td>
            <td>{{ $data->pengiriman->koli->count() }}</td>
            <td>{{ $data->pengiriman->berat }}</td>
            @if($data->pengiriman->metode_pembayaran == 1)
            <td>{{ formatRupiah($data->pengiriman->jumlah_biaya) }}</td>
            <td></td>
            <td></td>
            <td></td>
            @elseif($data->pengiriman->metode_pembayaran == 2)
            <td></td>
            <td>{{ formatRupiah($data->pengiriman->jumlah_biaya) }}</td>
            <td></td>
            <td></td>
            @elseif($data->pengiriman->metode_pembayaran == 3)
            <td></td>
            <td></td>
            <td>{{ formatRupiah($data->pengiriman->jumlah_biaya) }}</td>
            <td></td>
            @else
            <td></td>
            <td></td>
            <td></td>
            <td>{{ formatRupiah($data->pengiriman->jumlah_biaya) }}</td>
            @endif
        </tr>
        @endforeach
        <tr>
            <td colspan="4">Total</td>
            <td id="total_koli"></td>
            <td id="total_kg"></td>
            <td id="total_cash"></td>
            <td id="total_cod"></td>
            <td id="total_transfer"></td>
            <td id="total_langganan"></td>
        </tr>
    </table>
    <h6>Total pendapatan : Rp. <label id="total_pendapatan"></label></h6>
</body>
<script src="{{ asset('assets/blog-admin/vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('assets/blog-admin/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script type="text/javascript">

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

    var table = document.getElementById("table");
    var sumCash = 0;
    var sumCOD = 0
    var sumTransfer = 0;
    var sumLangganan = 0;
    for (let i = 2; i < table.rows.length-1; i++) {

        // menjumlahkan total cash
        sumCashTampung = table.rows[i].cells[6].innerHTML;
        sumCashTampung = parseInt(sumCashTampung.replace('.', ''));
        if (isNaN(sumCashTampung)) {
            sumCashTampung = 0;
        }        
        sumCash = sumCash + sumCashTampung;

        
        // menjumlahkan total cod
        sumCODTampung = table.rows[i].cells[7].innerHTML;
        sumCODTampung = parseInt(sumCODTampung.replace('.', ''));
        if (isNaN(sumCODTampung)) {
            sumCODTampung = 0;
        }
        sumCOD = sumCOD + sumCODTampung;

        // menjumlahkan total transfer
        sumTransferTampung = table.rows[i].cells[8].innerHTML;
        sumTransferTampung = parseInt(sumTransferTampung.replace('.', ''));
        if(isNaN(sumTransferTampung)){
            sumTransferTampung = 0;
        }
        sumTransfer = sumTransfer + sumTransferTampung;

        // menjumlahkan total langganan
        sumLanggananTampung = table.rows[i].cells[9].innerHTML;
        sumLanggananTampung = parseInt(sumLanggananTampung.replace('.', ''));
        if(isNaN(sumLanggananTampung)){
            sumLanggananTampung = 0;
        }
        sumLangganan = sumLangganan + sumLanggananTampung;
    }
    document.getElementById("total_cash").innerHTML = formatRupiah(sumCash);
    document.getElementById("total_cod").innerHTML = formatRupiah(sumCOD);
    document.getElementById("total_transfer").innerHTML = formatRupiah(sumTransfer);
    document.getElementById("total_langganan").innerHTML = formatRupiah(sumLangganan);

    // menambahkan seluruh total pendapatan
    var total_pendapatan = sumCash + sumCOD + sumTransfer + sumLangganan;

    document.getElementById("total_pendapatan").innerHTML = formatRupiah(total_pendapatan);
    
</script>
</html>