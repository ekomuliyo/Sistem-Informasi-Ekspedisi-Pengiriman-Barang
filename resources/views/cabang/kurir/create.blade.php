@extends('layouts.cabang.app')


@section('content')
    <div class="container-fluid">
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="#">Kurir</a>
          </li>
          <li class="breadcrumb-item active">Tambah Kurir Baru</li>
        </ol>
        <!-- Icon Cards-->
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header text-white bg-primary">
              Tambah Kurir Baru
              </div>
              {!! Form::open(['route' => 'cabang.kurir.store', 'method' => 'POST']) !!}
                @include('cabang.kurir._form')
              {!! Form::close() !!}
            </div>
          </div>
        </div>
    </div>
@endsection