@extends('layouts.direktur.app')

@section('content')
    <div class="container-fluid">
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="#">Cabang</a>
          </li>
          <li class="breadcrumb-item active">Tambah Cabang Baru</li>
        </ol>
        <!-- Icon Cards-->
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header text-white bg-primary">
              Tambah Cabang Baru
              </div>
              {!! Form::open(['route' => 'direktur.cabang.store', 'method' => 'POST']) !!}
                @include('direktur.cabang._form')
              {!! Form::close() !!}
            </div>
          </div>
        </div>
    </div>
@endsection