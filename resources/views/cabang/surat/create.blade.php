@extends('layouts.cabang.app')

@section('content')
    <div class="container-fluid">
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="#">Surat</a>
          </li>
          <li class="breadcrumb-item active">Tambah Surat Pengiriman</li>
        </ol>
        <!-- Icon Cards-->
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header text-white bg-primary">
              Tambah Surat Pengiriman
              </div></br>
              {!! Form::open(['route' => 'cabang.surat.store', 'method' => 'POST']) !!}
                @include('cabang.surat._form')
              {!! Form::close() !!}
            </div>
          </div>
        </div>
    </div>
@endsection

@section('assets-bottom')
    <script type="text/javascript">
        $('#id_pengiriman').select2({
        placeholder: 'Cari nomor resi..',
        ajax: {
          url: '/cabang/json/no_resi',
          dataType: 'json',
          delay: 250,
          processResults: function (data) {
              return {
                results:  $.map(data, function (item) {
                  return {
                    text: item.no_resi + ' - ' + item.nama_penerima + ' ' + item.id ,
                    id: item.id
                }
              })
          };
        },
        cache: true
        },
        });
        $("#id_kurir").select2();
    </script>
@endsection