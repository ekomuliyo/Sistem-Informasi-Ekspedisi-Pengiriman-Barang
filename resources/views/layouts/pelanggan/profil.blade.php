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
                        <a href="#" data-toggle="modal" data-target="#profilModal">
                        <label for="nama">{{ $user->nama }}</label>
                        </a>
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
                        <a href="#" data-toggle="modal" data-target="#profilModal">
                        <label for="email">{{ $user->email }}</label>
                        </a>
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
                        <a href="#" data-toggle="modal" data-target="#profilModal">
                        @if( $user->pelanggan->no_hp != null)
                            <label for="no_hp">{{ $user->pelanggan->no_hp }}</label>
                        @else
                            <label for="no_hp">-</label>
                        @endif
                        </a>
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
                        <a href="#" data-toggle="modal" data-target="#profilModal">
                        @if($user->pelanggan->jenis_kelamin == 1)
                            <label for="jenis_kelamin">Laki-laki</label>
                        @elseif($user->pelanggan->jenis_kelamin == 2)
                            <label for="jenis_kelamin">Perempuan</label>
                        @else
                            <label for="jenis_kelamin">-</label>
                        @endif
                        </a>
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
                        <a href="#" data-toggle="modal" data-target="#profilModal">
                        @if( $user->pelanggan->tgl_lahir)
                            <label for="tgl_lahir">{{ $user->pelanggan->tgl_lahir }}</label>
                        @else
                            <label for="tgl_lahir">-</label>
                        @endif
                        </a>
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
                        <a href="#" data-toggle="modal" data-target="#profilModal">
                        @if($user->pelanggan->id_kecamatan != null)
                            @if($user->pelanggan->kecamatan->kota->id == '5')
                                <label for="kota">Jakarta Pusat</label>                            
                            @elseif($user->pelanggan->kecamatan->kota->id == '6')
                                <label for="kota">Jakarta Barat</label>
                            @elseif($user->pelanggan->kecamatan->kota->id == '7')
                                <label for="kota">Jakarta Utara</label>
                            @elseif($user->pelanggan->kecamatan->kota->id == '8')
                                <label for="kota">Jakarta Timur</label> 
                            @endif
                        @else
                            <label for="kota">-</label>
                        @endif                           
                        </a>
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
                        <a href="#" data-toggle="modal" data-target="#profilModal">
                            @if( $user->pelanggan->alamat != null)
                            <label for="alamat">{{ $user->pelanggan->alamat }}</label>
                            @else
                            <label for="alamat">-</label>
                            @endif
                        </a>
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
                            {!! Form::text('pelanggan[no_hp]', null, ['class' => $errors->has('no_hp') ? 'form-control is-invalid' : 'form-control', 'required', 'autofocus', 'Placeholder' => 'Nomor HP']) !!}
                        </div>

                        <div class="form-group">
                            <label for="jenis_kelamin">Jenis Kelamin</label>
                                <div class="form-control">
                                    <label class="radio-inline">
                                        <input type="radio" name="pelanggan[jenis_kelamin]" value="1"
                                        @if($user->pelanggan->jenis_kelamin == 1) checked @endif>Laki-Laki
                                    </label> &nbsp;&nbsp;
                                    <label class="radio-inline">
                                        <input type="radio" name="pelanggan[jenis_kelamin]" value="2"
                                        @if($user->pelanggan->jenis_kelamin == 2) checked @endif>Perempuan
                                    </label>
                                </div>
                        </div>

                        <div class="form-group">
                            <label for="tgl_lahir">Tanggal Lahir</label>
                            {!! Form::date('pelanggan[tgl_lahir]', null, ['class' => $errors->has('tgl_lahir') ? 'form-control is-invalid' : 'form-control', 'required', 'autofocus']) !!}
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-12">Kota</label>
                            <div class="col-md-12">
                                <select name="id_kota" id="id_kota" class="form-control" style="width: 100%" required >
                                        <option value="" disabled selected hidden>Pilih kota</option>
                                        @if($user->pelanggan->kecamatan != null)
                                            <option value="5" @if($user->pelanggan->kecamatan->kota->id == 5 )
                                                selected
                                            @endif>Jakarta Pusat</option>
                                            <option value="6" @if($user->pelanggan->kecamatan->kota->id == 6 )
                                                selected
                                            @endif>Jakarta Barat</option>
                                            <option value="7" @if($user->pelanggan->kecamatan->kota->id == 7 )
                                                selected
                                            @endif>Jakarta Utara</option>
                                            <option value="8" @if($user->pelanggan->kecamatan->kota->id == 8 )
                                                selected
                                            @endif>Jakarta Timur</option>
                                        @else
                                            <option value="5">Jakarta Pusat</option>
                                            <option value="6">Jakarta Barat</option>
                                            <option value="7">Jakarta Utara</option>
                                            <option value="8">Jakarta Timur</option>
                                        @endif
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-12">Kecamatan</label>
                            <div class="col-md-12">
                                <select name="pelanggan[id_kecamatan]" id="id_kecamatan" class="form-control" style="width: 100%" required >
                                        <option value="" disabled selected hidden>Pilih Kecamatan</option>
                                </select>
                            </div>
                        </div>

                        <input type="text" value="{{ $user->pelanggan->id_kecamatan }}" id="kecamatan_terpilih" hidden>                

                        <div class="form-group">
                            <label for="alamat">Alamat Lengkap</label>
                            {!! Form::textarea('pelanggan[alamat]', null, ['class' => $errors->has('alamat') ? 'form-control is-invalid' : 'form-control', 'required', 'autofocus', 'Placeholder' => 'Alamat Lengkap']) !!}
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
                      <h4 class="modal-title">Ubah Password</h4>
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

            // mengambil data kecamatan pengirim berdasarkan kota
            var kota = $('#id_kota');
            var kecamatan = $('#id_kecamatan');
            var kecamatan_terpilih = $('#kecamatan_terpilih').val();
            
            kota.select2().on('change', function(){
                $.ajax({
                url: '/pelanggan/json/kecamatan/' + kota.val(),
                type: 'GET',
                success: function(data){
                    kecamatan.empty();
                    kecamatan.append('<option value="" disabled selected hidden>Pilih Kecamatan</option>');
                    $.each(data, function(value, key){
                        if (value == kecamatan_terpilih) {
                            kecamatan.append('<option value="'+value+'" selected>'+key+'</option>');
                        }else{
                            kecamatan.append('<option value="'+value+'">'+key+'</option>');                    
                        }
                    });

                    kecamatan.select2();
                }});
            }).trigger('change');
        });
    </script>
@endsection