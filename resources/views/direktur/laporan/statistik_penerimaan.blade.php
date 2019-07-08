@extends('layouts.direktur.app')

@section('content')

<div class="container-fluid">
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="#">Statistik Penerimaan</a>
        </li>
    </ol>
    <!-- Icon Cards-->
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div id="container"></div>
            </div>
        </div>
    </div>
</div>

@endsection


@section('assets-bottom')
<script src="{{ asset('assets/blog-admin/js/highcharts.js') }}"></script>
<script type="text/javascript">
Highcharts.chart('container', {
    chart: {
        type: 'column'
    },
    title: {
        text: 'Statistik Penerimaan Barang pada tahun <?php echo date("Y") ?>'
    },
    subtitle: {
        text: 'PT Bunga Lintas Cargo'
    },
    xAxis: {
        categories: [
            'Janurari',
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
        ],
        crosshair: true
    },
    yAxis: {
        min: 0,
        tickInterval: 1,
        title: {
            text: 'Jumlah Penerimaan'
        }
    },
    tooltip: {
        headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
        pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
            '<td style="padding:0"><b>{point.y:.0f} </b></td></tr>',
        footerFormat: '</table>',
        shared: true,
        useHTML: true
    },
    plotOptions: {
        column: {
            pointPadding: 0.2,
            borderWidth: 0
        }
    },
    series: [{
        name: 'Penerimaan',
        data: [
            {{ $bulan_januari->count()}},
            {{ $bulan_februari->count()}},
            {{ $bulan_maret->count()}},
            {{ $bulan_april->count()}},
            {{ $bulan_mei->count()}},
            {{ $bulan_juni->count()}},
            {{ $bulan_juli->count()}},
            {{ $bulan_agustus->count()}},
            {{ $bulan_september->count()}},
            {{ $bulan_oktober->count()}},
            {{ $bulan_november->count()}},
            {{ $bulan_desember->count()}},

        ]
    }]
});
</script>
@endsection