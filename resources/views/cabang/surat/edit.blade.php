@extends('layouts.cabang.app')

@section('content')
    <div class="container-fluid">
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="#">Surat</a>
            </li>
            <li class="breadcrumb-item active">Ubah</li>
        </ol>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header text-white bg-primary">
                        Ubah Surat Jalan
                    </div>
                    {!! Form::model($surat, ['route' => ['cabang.surat.update', $surat->id], 'method' => 'PUT']) !!}
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Nomor Resi</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select id="no_resi" name="no_resi[]" class="form-control" multiple="multiple">
                                    @foreach($transaksi as $d)
                                        <option value="{{ $d->pengiriman->id }}" selected>{{ $d->pengiriman->no_resi }} - {{ $d->pengiriman->nama_penerima }}</option>
                                    @endforeach
                                </select>
                            </div>
                    </div>    
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Nomor Surat</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                {!! Form::text('nomor_surat', $surat->nomor_surat, ['class' => $errors->has('nomor_surat') ? 'form-control is-invalid' : 'form-control']) !!}
                            </div>
                        </div>
                    <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Nama Kurir</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <select name="id_kurir" id="id_kurir" class ="form-control" required name="id_kurir">
                                @foreach($kurir as $d)
                                    <option value="{{ $d->id }}" 
                                    @if($d->id == $surat->id_kurir)
                                        selected = "selected"
                                    @endif>{{ $d->user->nama }}</option>
                                @endforeach
                            </select>
                            </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Tanggal Surat</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input name="tgl_surat" class="form-control" value="{{ $surat->tgl_surat }}" type="date"/>
                        </div>
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
        $('#no_resi').select2({
        placeholder: 'Cari nomor resi..',
        ajax: {
          url: '/cabang/json/no_resi',
          dataType: 'json',
          delay: 250,
          processResults: function (data) {
              return {
                results:  $.map(data, function (item) {
                  return {
                    text: item.id + (' - ') + item.nama_penerima,
                    id: item.id
                }
              })
          };
        },
        cache: true
        },
        });

        $("#id_kurir").select2();
        $('#no_resi').prop("disabled", true);
    </script>
@endsection