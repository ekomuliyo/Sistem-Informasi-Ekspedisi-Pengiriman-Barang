@extends('layouts.cabang.app')

@section('content')

<div class="container-fluid">
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a href="#">Ongkir</a>
      </li>
      <li class="breadcrumb-item active">Ubah</li>
    </ol>

    <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header text-white bg-primary">
              Ubah Ongkir
              </div>
              {!! Form::model($ongkir, ['route' => ['cabang.ongkir.update', $ongkir->id], 'method' => 'PUT']) !!}
              <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Kota</label>
                    <div class="col-md-6">
                        <select name="id_kota" id="id_kota" class ="form-control" required >
                                <option value="" disabled selected hidden>Pilih Kota</option>
                                @foreach($kota as $d)
                                <option value="{{ $d->id }}" @if($d->id == $ongkir->kecamatan->id_kota)
                                    selected 
                                @endif> {{ $d->nama }} </option>
                                @endforeach
                        </select>
                    </div>
                    @if ($errors->has('id_kota'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('id_kota') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Kecamatan</label>
                    <div class="col-md-6">
                        <select name="id_kecamatan" id="id_kecamatan" class ="form-control" required >
                                <option value="" disabled selected hidden>Pilih Kecamatan</option>
                        </select>
                        @if ($errors->has('id_kecamatan'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('id_kecamatan') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <input type="text" value="{{ $ongkir->id_kecamatan }}" id="kecamatan_terpilih" hidden>                
                <div class="form-group">
                    <label for="estimasi">Estimasi Pengiriman</label>
                    <div class="row">
                        <div class="col-md-1">
                            {!! Form::number('awal', $ongkir->estimasi{0}, ['class' => $errors->has('awal') ? 'form-control is-invalid' : 'form-control', 'required', 'autofocus', 'min' => '1']) !!}
                        </div>
                        <div class="col-md-0">-</div>
                        <div class="col-md-1">
                            {!! Form::number('akhir', $ongkir->estimasi{4}, ['class' => $errors->has('akhir') ? 'form-control is-invalid' : 'form-control', 'required', 'autofocus', 'min' => '2']) !!}
                        </div>
                        <div class="col-md-9">Hari</div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="harga">Harga (Kg)</label>
                    {!! Form::number('harga', null, ['class' => $errors->has('harga') ? 'form-control is-invalid' : 'form-control', 'required', 'autofocus', 'min' => '1']) !!}
                </div>
                <div class="card-footer bg-transparent">
                <button class="btn btn-primary" type="submit">
                    Ubah
                </button>
                </div>
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
    var kecamatanTerpilih = $('#kecamatan_terpilih').val();
    
    kota.select2().on('change', function(){
        $.ajax({
        url: '/cabang/json/kecamatan/' + kota.val(),
        type: 'GET',
        success: function(data){
            kecamatan.empty();
            $.each(data, function(value, key){
                if (value == kecamatanTerpilih) {
                    kecamatan.append('<option value="'+value+'" selected>'+key+'</option>');
                }else{
                    kecamatan.append('<option value="'+value+'">'+key+'</option>');                    
                }
            });
            kecamatan.select2();
        }
        });
    }).trigger('change');

    $('#id_kota').prop("disabled", true);
    $('#id_kecamatan').prop("disabled", true);
</script>
@endsection
