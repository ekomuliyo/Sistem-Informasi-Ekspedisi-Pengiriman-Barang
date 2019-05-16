    <div class="form-group">
        <label for="nama">Nama Cabang</label>
        {!! Form::text('nama', null, ['class' => $errors->has('nama') ? 'form-control is-invalid' : 'form-control', 'required', 'autofocus']) !!}
    </div>
    <div class="form-group">
        <label for="no_hp">Nomor HP</label>
        {!! Form::number('no_hp', null, ['class' => $errors->has('no_hp') ? 'form-control is-invalid' : 'form-control', 'required', 'autofocus']) !!}
    </div>
    <div class="form-group">
        <label for="alamat">Alamat</label>
        {!! Form::textarea('alamat', null, ['class' => $errors->has('alamat') ? 'form-control is-invalid' : 'form-control', 'required', 'autofocus']) !!}
    </div>
    <div class="form-group">
        <label for="email">Email</label>
        {!! Form::email('email', null, ['class' => $errors->has('email') ? 'form-control is-invalid' : 'form-control', 'required']) !!}
    </div>
    <div class="form-group">
        <label for="email">Level</label>
        {!! Form::text('level', 'admin', ['class' => $errors->has('level') ? 'form-control is-invalid' : 'form-control', 'required', 'readonly']) !!}
    </div>
    <div class="form-group">
        <label for="password">Password</label>
        {!! Form::password('password', ['class' => $errors->has('password') ? 'form-control is-invalid' : 'form-control', 'required', 'autofocus']) !!}
    </div>
    <div class="form-group">
        <label for="foto">Foto</label>
        <div class="input-group">
            <span class="input-group-btn">
                <a id="lfm" data-input="foto" data-preview="holder" class="btn btn-primary text-white">
                    <i class="fa fa-cloud-upload"></i> Pilih
                </a>
            </span>
            {!! Form::text('foto', null, ['id' => 'foto', 'class' => $errors->has('foto') ? 'form-control is-invalid' : 'form-control', 'readonly']) !!}
        </div>
        <img id="holder" style="margin-top:15px;max-height:254px;max-width: 152px;">
    </div>
    </div>
    <div class="card-footer bg-transparent">
    <button class="btn btn-primary" type="submit">
        Masukan
    </button>
</div>

@section('assets-bottom')
    <script src="{{ asset('vendor/laravel-filemanager/js/lfm.js') }}"></script>
    <script>
        $(document).ready( function () {
            $('#lfm').filemanager('image', {prefix : "{{ URL::to('laravel-filemanager') }}"});
        });
    </script>
@endsection