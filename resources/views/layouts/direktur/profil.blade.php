@extends('layouts.direktur.app')

@section('assets-top')
<style>
    .panel{
        padding-left: 30px;
    }
</style>
@endsection

@section('content')

<div class="container-fluid">
    <!-- Breadcrumbs -->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="#">Profil</a>
        </li>
    </ol>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="row align-self-center">
                    <div class="col-md-12">
                        <center><img src="{{ asset(Auth::user()->foto) }}" id="holder" class="rounded-circle" width="100" height="100" ></center></br> 
                        <a id="lfm" data-input="foto" data-preview="holder" class="btn btn-primary text-white" href="#">Ganti Foto</a>
                        <!-- mengambil nama file -->
                        {!! Form::model($user, ['route' => ['direktur.users.update', $user->id], 'method' => 'PUT']) !!}
                        <div class="form-group">
                        <div class="input-group">
                            {!! Form::text('foto', null, ['id' => 'foto', 'class' => $errors->has('foto') ? 'form-control is-invalid' : 'form-control', 'readonly', 'hidden']) !!}
                            @if ($errors->has('foto'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('foto') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-12">
            <div class="card">
                <div class="row panel">
                    <div class="col-md-4">
                        <label for="email">Nama</label>
                    </div>
                    <div class="col-md-8">
                        <label for="email">{{ $user->nama }}</label>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-12">
            <div class="card">
                <div class="row panel">
                    <div class="col-md-4">
                        <label for="email">Email</label>
                    </div>
                    <div class="col-md-8">
                        <label for="email">{{ $user->email }}</label>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-12">
            <div class="card">
                <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#profilModal">Ubah</a>
            </div>
        </div>

        <div class="col-md-12">
            <div class="card">
                <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#ubahPasswordModal">Ubah Password</a>
            </div>
        </div>


        <!-- modal profil -->
        <div div class="modal fade" id="profilModal" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                      <h4 class="modal-title">Ubah Profil</h4>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                  
                    <div class="modal-body">
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
                    </div>

                    <div class="modal-footer">
                        <button class="btn btn-primary" type="submit">
                            Ubah
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- modal ubah password -->
        <div div class="modal fade" id="ubahPasswordModal" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                      <h4 class="modal-title">Ubah Profil</h4>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                  
                    <div class="modal-body">
                    <div class="form-group">
                        <label for="password">Password Baru</label>
                        {!! Form::password('password', ['class' => $errors->has('password') ? 'form-control is-invalid' : 'form-control']) !!}
                        @if ($errors->has('password'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>
                    </div>

                    <div class="modal-footer">
                        <button class="btn btn-primary" type="submit">
                            Ubah
                        </button>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>

    </div>
</div>


@endsection


@section('assets-bottom')
    <script src="{{ asset('vendor/laravel-filemanager/js/lfm.js') }}"></script>
    <script>
        $(document).ready( function () {
            $('#lfm').filemanager('image', {prefix : "{{ URL::to('laravel-filemanager') }}"});
        });
    </script>
@endsection