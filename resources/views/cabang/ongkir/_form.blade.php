    @if(!empty($errors->first()))
        <div class="row col-lg-12">
            <div class="alert alert-danger">
                <span>{{ $errors->first() }}</span>
            </div>
        </div>
    @endif
    <div class="form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12">Kota</label>
        <div class="col-md-6">
            <select name="id_kota" id="id_kota" class ="form-control" required >
                    <option value="" disabled selected hidden>Pilih Kota</option>
                    <option value="1">Palembang</option>
                    <option value="3">Pekanbaru</option>
                    <option value="4">Bukit Tinggi</option>
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
        </div>
    </div>
    <div class="form-group">
        <label for="estimasi">Estimasi Pengiriman</label>
        <div class="row">
            <div class="col-md-1">
                {!! Form::number('awal', null, ['class' => $errors->has('awal') ? 'form-control is-invalid' : 'form-control', 'required', 'autofocus', 'min' => '1']) !!}
            </div>
            <div class="col-md-0">-</div>
            <div class="col-md-1">
                {!! Form::number('akhir', null, ['class' => $errors->has('akhir') ? 'form-control is-invalid' : 'form-control', 'required', 'autofocus', 'min' => '2']) !!}
            </div>
            <div class="col-md-9">Hari</div>
        </div>
    </div>
    <div class="form-group">
        <label for="harga">Harga (Kg)</label>
        {!! Form::number('harga', null, ['class' => $errors->has('harga') ? 'form-control is-invalid' : 'form-control', 'required', 'autofocus', 'min' => '1']) !!}
        @if ($errors->has('harga'))
                <span class="invalid-feedback">
                    <strong>{{ $errors->first('harga') }}</strong>
                </span>
        @endif
    </div>
    <div class="card-footer bg-transparent">
    <button class="btn btn-primary" type="submit">
        Masukan
    </button>
    </div>