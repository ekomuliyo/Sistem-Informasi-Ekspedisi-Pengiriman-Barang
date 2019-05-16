    <div class="form-group">
        <label for="nomor_surat">Nomor Surat</label>
        {!! Form::text('nomor_surat', "JKT/Cargo/" . $nomor_surat, ['class' => $errors->has('nomor_surat') ? 'form-control is-invalid' : 'form-control', 'readonly']) !!}
    </div>
    <div class="form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12">Nama Kurir</label>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <select name="id_kurir" id="nameid" class ="form-control" required name="id_kurir">
                    <option value="" disabled selected hidden>Pilih Nama Kurir</option>
                    @foreach($kurir as $d)
                    <option value="{{$d->id}}">{{$d->user->nama}}</option>
                    @endforeach
            </select>
            </div>
    </div>
    <div class="form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12">Tanggal Surat</label>
        <div class="col-md-6 col-sm-6 col-xs-12">
            {!! Form::date('tgl_surat', null, ['class' => $errors->has('tgl_lahir') ? 'form-control is-invalid' : 'form-control', 'required', 'autofocus']) !!}
        </div>
    </div>
    
    <div class="card-footer bg-transparent">
    <button class="btn btn-primary" type="submit">
        Masukan
    </button>
    </div>