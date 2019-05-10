@extends('layouts.cabang.app')

@section('content')
    <div class="container-fluid">
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="#">Ongkir</a>
          </li>
          <li class="breadcrumb-item active">Tambah Ongkir Baru</li>
        </ol>
        <!-- Icon Cards-->
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header text-white bg-primary">
              Tambah Ongkir Baru
              </div></br>
              {!! Form::open(['route' => 'cabang.ongkir.store', 'method' => 'POST']) !!}
                @include('cabang.ongkir._form')
              {!! Form::close() !!}
            </div>
          </div>
        </div>
    </div>
@endsection