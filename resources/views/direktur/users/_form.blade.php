<div class="card-body">
    <div class="form-group">
        <label for="nama">Nama Lengkap</label>
        {!! Form::text('nama', null, ['class' => $errors->has('nama') ? 'form-control is-invalid' : 'form-control', 'required', 'autofocus']) !!}
        @if ($errors->has('nama'))
            <span class="invalid-feedback">
                <strong>{{ $errors->first('nama') }}</strong>
            </span>
        @endif
    </div>
    <div class="form-group">
        <label for="email">Email</label>
        {!! Form::email('email', null, ['class' => $errors->has('email') ? 'form-control is-invalid' : 'form-control', 'required']) !!}
        @if ($errors->has('email'))
            <span class="invalid-feedback">
                <strong>{{ $errors->first('email') }}</strong>
            </span>
        @endif
    </div>
    <div class="form-group">
        <label for="password">Password</label>
        {!! Form::password('password', ['class' => $errors->has('password') ? 'form-control is-invalid' : 'form-control']) !!}
        @if ($errors->has('password'))
            <span class="invalid-feedback">
                <strong>{{ $errors->first('password') }}</strong>
            </span>
        @endif
    </div>
    <div class="form-group">
        <label for="level">Level</label>
        {!! Form::select('level', ['pengguna' => 'Pengguna', 'admin' => 'Admin', 'direktur' => 'Direktur'], null, ['class' => $errors->has('role') ? 'form-control is-invalid' : 'form-control', 'required']) !!}
        @if ($errors->has('level'))
            <span class="invalid-feedback">
                <strong>{{ $errors->first('level') }}</strong>
            </span>
        @endif
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
            @if ($errors->has('foto'))
                <span class="invalid-feedback">
                    <strong>{{ $errors->first('foto') }}</strong>
                </span>
            @endif
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
