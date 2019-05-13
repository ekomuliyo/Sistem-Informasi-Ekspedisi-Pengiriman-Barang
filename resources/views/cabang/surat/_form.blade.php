    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div><br />
    @endif
    
    <div class="form-group">
        <label for="nomor">Nomor Surat</label>
        {!! Form::text('nomor_surat', "JKT/Cargo/" . $nomor_surat, ['class' => $errors->has('no_surat') ? 'form-control is-invalid' : 'form-control', 'readonly']) !!}
    </div>
    <div class="form-group">
    <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Nama Kurir</label>
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
        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Tanggal Surat</label>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <input name="tgl_surat" class="form-control" placeholder="DD/MM/YYYY" type="date" required="required"/>
        </div>
    </div>
    
    <div class="card-footer bg-transparent">
    <button class="btn btn-primary" type="submit">
        Masukan
    </button>
    </div>