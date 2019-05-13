    <div class="form-group">
        <label for="nama">Kota Asal</label>
        {!! Form::text('asal', 'jakarta', ['class' => $errors->has('asal') ? 'form-control is-invalid' : 'form-control', 'readonly']) !!}
    </div>
    <div class="form-group">
        <label for="nama">Kota Tujuan</label>
        {!! Form::select('tujuan', ['palembang' => 'Palembang', 'jambi'=>'Jambi', 'pekanbaru'=>'Pekanbaru', 'padang'=>'Padang'], null, ['class' => 'form-control', 'placeholder' => 'Pilih Kota']) !!}
    </div>
    <div class="form-group">
        <label for="nama">Estimasi Pengiriman</label>
        <div class="row">
            <div class="col-md-1">
                {!! Form::number('awal', null, ['class' => $errors->has('akhir') ? 'form-control is-invalid' : 'form-control', 'required', 'autofocus', 'min' => '1']) !!}
            </div>
            <div class="col-md-0">-</div>
            <div class="col-md-1">
                {!! Form::number('akhir', null, ['class' => $errors->has('akhir') ? 'form-control is-invalid' : 'form-control', 'required', 'autofocus', 'min' => '2']) !!}
            </div>
            <div class="col-md-9">Hari</div>
        </div>
    </div>
    <div class="form-group">
        <label for="nama">Harga (Kg)</label>
        {!! Form::number('harga', null, ['class' => $errors->has('harga') ? 'form-control is-invalid' : 'form-control', 'required', 'autofocus', 'min' => '1']) !!}
    </div>
    <div class="card-footer bg-transparent">
    <button class="btn btn-primary" type="submit">
        Masukan
    </button>
    </div>