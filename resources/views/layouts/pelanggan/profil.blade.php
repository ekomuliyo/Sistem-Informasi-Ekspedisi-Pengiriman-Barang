@extends('layouts.pelanggan.app')

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

    @if (session('alert'))
        <div class="alert alert-success">
            {{ session('alert') }}
        </div>
    @endif

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="row align-self-center">
                    <div class="col-md-12">
                        <center><img src="{{ asset(Auth::user()->foto) }}" id="holder" class="rounded-circle" width="100" height="100" ></center></br> 
                        <a id="lfm" data-input="foto" data-preview="holder" class="btn btn-primary text-white" href="#">Ganti Foto</a>
                        <!-- mengambil nama file -->
                        {!! Form::model($user, ['route' => ['pelanggan.users.update', $user->id], 'method' => 'PUT']) !!}
                        <div class="form-group">
                        <div class="input-group">
                            {!! Form::text('foto', null, ['id' => 'foto', 'class' => $errors->has('foto') ? 'form-control is-invalid' : 'form-control', 'readonly', 'hidden']) !!}
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="card">
                <div class="row panel">
                    <div class="col-md-4">
                        <label for="nama">Nama</label>
                    </div>
                    <div class="col-md-8">
                        <label for="nama">{{ $user->nama }}</label>
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
                <div class="row panel">
                    <div class="col-md-4">
                        <label for="no_hp">No. HP / WA</label>
                    </div>
                    <div class="col-md-8">
                        <label for="no_hp">{{ $user->pelanggan->no_hp }}</label>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="card">
                <div class="row panel">
                    <div class="col-md-4">
                        <label for="jenis_kelamin">Jenis Kelamin</label>
                    </div>
                    <div class="col-md-8">
                        @if($user->pelanggan->jenis_kelamin == 1)
                            <label for="jenis_kelamin">Laki-laki</label>
                        @elseif($user->pelanggan->jenis_kelamin == 2)
                            <label for="jenis_kelamin">Perempuan</label>
                        @else
                            <label for="jenis_kelamin">-</label>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="card">
                <div class="row panel">
                    <div class="col-md-4">
                        <label for="tgl_lahir">Tanggal Lahir</label>
                    </div>
                    <div class="col-md-8">
                        <label for="tgl_lahir">{{ $user->pelanggan->tgl_lahir }}</label>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="card">
                <div class="row panel">
                    <div class="col-md-4">
                        <label for="kota">Kota</label>
                    </div>
                    <div class="col-md-8">
                        @if($user->pelanggan->kota == '1')
                            <label for="kota">Jakarta</label>                            
                        @elseif($user->pelanggan->kota == '2')
                            <label for="kota">Palembang</label>
                        @elseif($user->pelanggan->kota == '3')
                            <label for="kota">Jambi</label>
                        @elseif($user->pelanggan->kota == '4')
                            <label for="kota">Pekanbaru</label> 
                        @elseif($user->pelanggan->kota == '5')
                            <label for="kota">Padang</label>
                        @else
                            <label for="kota">-</label>
                        @endif                           
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="card">
                <div class="row panel">
                    <div class="col-md-4">
                        <label for="alamat">Alamat Lengkap</label>
                    </div>
                    <div class="col-md-8">
                        <label for="alamat">{{ $user->pelanggan->alamat }}</label>
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
                        </div>

                        <div class="form-group">
                            <label for="email">Email</label>
                            {!! Form::email('email', null, ['class' => $errors->has('email') ? 'form-control is-invalid' : 'form-control', 'required']) !!}
                        </div>

                        <div class="form-group">
                            <label for="no_hp">No. HP / WA</label>
                            {!! Form::text('pelanggan[no_hp]', null, ['class' => $errors->has('no_hp') ? 'form-control is-invalid' : 'form-control', 'required', 'autofocus']) !!}
                        </div>

                        <div class="form-group">
                            <label for="nama">Jenis Kelamin</label>
                            {!! Form::select('pelanggan[jenis_kelamin]', ['1' => 'Laki-laki', '2' => 'Perempuan'], null, ['class' => 'form-control', 'required', 'autofocus']) !!}
                        </div>

                        <div class="form-group">
                            <label for="tgl_lahir">Tanggal Lahir</label>
                            {!! Form::date('pelanggan[tgl_lahir]', null, ['class' => $errors->has('tgl_lahir') ? 'form-control is-invalid' : 'form-control', 'required', 'autofocus']) !!}
                        </div>

                        <div class="form-group">
                            <label for="kota">Kota</label>
                            {!! Form::select('pelanggan[kota]', ['1' => 'Jakarta', '2' => 'Palembang', '3' => 'Jambi', '4' => 'Pekanbaru', '5' => 'Padang'], null, ['class' => 'form-control', 'required', 'autofocus']) !!}
                        </div>

                        <div class="form-group">
                            <label for="alamat">Alamat Lengkap</label>
                            {!! Form::textarea('pelanggan[alamat]', null, ['class' => $errors->has('alamat') ? 'form-control is-invalid' : 'form-control', 'required', 'autofocus']) !!}
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