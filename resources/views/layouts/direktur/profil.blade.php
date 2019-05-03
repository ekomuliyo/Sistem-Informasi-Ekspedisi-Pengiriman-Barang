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
                        <img src="{{ asset(Auth::user()->foto) }}" class="rounded-circle" width="100" height="100" ></br> 
                        <a href="#">Ganti foto profil</a>
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

    </div>

</div>
@endsection