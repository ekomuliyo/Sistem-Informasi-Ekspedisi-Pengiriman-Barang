@extends('layouts.cabang.app')

@section('content')
    <div class="container-fluid">
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="#">Ongkir</a>
          </li>
          <li class="breadcrumb-item active">Tambah Ongkir</li>
        </ol>
        <!-- Icon Cards-->
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header text-white bg-primary">
              Tambah Ongkir
              </div></br>
              {!! Form::open(['route' => 'cabang.ongkir.store', 'method' => 'POST']) !!}
                @include('cabang.ongkir._form')
              {!! Form::close() !!}
            </div>
          </div>
        </div>
    </div>
@endsection

@section('assets-bottom')
<script type="text/javascript">
  var kota = $('#id_kota');
  var kecamatan = $('#id_kecamatan');
  kota.select2().on('change', function(){
    $.ajax({
      url: '/cabang/json/kecamatan/' + kota.val(),
      type: 'GET',
      success: function(data){
        kecamatan.empty();
        $.each(data, function(value, key){
          kecamatan.append($("<option></option>").attr("value", value).text(key));
        });
        kecamatan.select2({placeholder : 'Pilih kecamatan'});
      }
    });
  }).trigger('change');

  var harga = document.getElementById('harga');
  harga.addEventListener('keyup', function(e){
      var ongkir = this.value;
      harga.value = formatRupiah(ongkir); 
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
</script>
@endsection