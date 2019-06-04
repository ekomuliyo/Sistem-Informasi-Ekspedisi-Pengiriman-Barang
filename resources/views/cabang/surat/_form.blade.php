    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
            <label class="control-label col-md-12">Nomor Resi</label>
                <div class="col-md-12">
                    <select id="id_pengiriman" name="id_pengiriman[]" class="form-control" multiple="multiple"></select>
                </div>
            </div>    
            <div class="form-group">
                <label class="control-label col-md-12">Nomor Surat</label>
                    <div class="col-md-12">
                        {!! Form::text('nomor_surat', "JKT/Cargo/" . $nomor_surat, ['class' => $errors->has('nomor_surat') ? 'form-control is-invalid' : 'form-control', 'readonly']) !!}
                    </div>
            </div>
            <div class="form-group">
            <label class="control-label col-md-12">Nama Kurir</label>
                <div class="col-md-12">
                    <select name="id_kurir" id="id_kurir" class ="form-control" required name="id_kurir">
                            <option value="" disabled selected hidden>Pilih Nama Kurir</option>
                            @foreach($kurir as $d)
                            <option value="{{$d->id}}">{{$d->user->nama}}</option>
                            @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-12">Tanggal Surat</label>
                <div class="col-md-12">
                    {!! Form::date('tgl_surat', null, ['class' => $errors->has('tgl_lahir') ? 'form-control is-invalid' : 'form-control', 'required', 'autofocus']) !!}
                </div>
            </div>
            
            <div class="card-footer bg-transparent">
            <button class="btn btn-primary" type="submit">
                Masukan
            </button>
            </div>
        </div>
        <div class="col-md-6">
            <h5>Data pengiriman barang</h5>
            <table class="table table-striped">
                <tr>
                    <th>Nomor Resi</th>
                    <th>Penerima</th>
                    <th>Kota Tujuan</th>
                    <th>Alamat Lengkap</th>
                </tr>
                @foreach($pengiriman as $d)
                <tr>
                    <td>{{ $d->no_resi }}</td>
                    <td>{{ $d->nama_penerima }}</td>
                    <td>{{ $d->kecamatan_penerima->kota->nama }}</td>
                    <td>{{ $d->alamat_penerima }}</td>
                </tr>
                @endforeach
            </table>
        </div>
    </div>

