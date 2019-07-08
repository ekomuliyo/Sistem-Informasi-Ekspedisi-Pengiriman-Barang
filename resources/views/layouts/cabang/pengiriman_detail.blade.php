@extends('layouts.cabang.app')

@section('assets-top')
    <link href="{{ asset('assets/blog-admin/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    <!-- Responsive datatable examples -->
    <link href="{{ asset('assets/blog-admin/vendor/datatables/responsive.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    <div class="container-fluid">
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="#">Pengiriman</a>
            </li>
            <li class="breadcrumb-item active">Detail Pengiriman</li>

        </ol>
        <!-- Example DataTables Card-->
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>No.</th>
                    <th>No Resi</th>
                    <th>Pengirim</th>
                    <th>Penerima</th>
                    <th>Kota Tujuan</th>
                    <th>Alamat</th>
                    <th>Jumlah Biaya</th>
                    <th>Metode Pembayaran</th>
                  </tr>
                </thead>
                <tbody>

                </tbody>
              </table>
    </div>
@endsection

@section('assets-bottom')
    <!-- Page level plugin JavaScript-->
    <script src="{{ asset('assets/blog-admin/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/blog-admin/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <!-- Responsive examples -->
    <script src="{{ asset('assets/blog-admin/vendor/datatables/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('assets/blog-admin/vendor/datatables/responsive.bootstrap4.min.js') }}"></script>

    <script>
    $(document).ready(function (){
        $("#dataTable").DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('cabang.api.datatable.pengiriman') }}",
            columns:[
              {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
              {data: 'no_resi', name: 'no_resi'},
              {data: 'nama_pengirim', name: 'nama_pengirim'},
              {data: 'nama_penerima', name: 'nama_penerima'},
              {data: 'kecamatan_penerima.kota.nama', name: 'kecamatan_penerima.kota.nama'},
              {data: 'alamat_penerima', name: 'alamat_penerima'},
              {data: 'jumlah_biaya', name: 'jumlah_biaya', 
                    render: function(data){
                      var number_string = data.toString(),
                        sisa     		= number_string.length % 3,
                        rupiah     		= number_string.substr(0, sisa),
                        ribuan     		= number_string.substr(sisa).match(/\d{3}/gi);
                    
                        // tambahkan titik jika yang di input sudah menjadi angka ribuan
                        if(ribuan){
                            separator = sisa ? '.' : '';
                            rupiah += separator + ribuan.join('.');
                        }

                        return "Rp. " + rupiah;
                    }},
              {data: 'metode_pembayaran', name: 'metode_pembayaran',
                    render: function(data){
                      var metode;
                      if(data == 1){
                        metode = "Cash";
                      }else if(data == 2){
                        metode = "COD";
                      }else if(data == 3){
                        metode = "Transfer";
                      }else{
                        metode = "Langganan";
                      }
                      return metode;
                    }}
            ]
        });
    });
    </script>

@endsection