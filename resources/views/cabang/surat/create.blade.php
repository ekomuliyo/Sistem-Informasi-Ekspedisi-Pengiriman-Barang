@extends('layouts.cabang.app')

@section('content')
    <div class="container-fluid">
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="#">Surat</a>
          </li>
          <li class="breadcrumb-item active">Tambah Surat Baru</li>
        </ol>
        <!-- Icon Cards-->
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header text-white bg-primary">
              Tambah Surat Baru
              </div></br>
              {!! Form::open(['route' => 'cabang.surat.store', 'method' => 'POST']) !!}
                @include('cabang.surat._form')
              {!! Form::close() !!}
            </div>
          </div>
        </div>
    </div>
@endsection

@section('assets-bottom')

    <script type="text/javascript">
        $("#nameid").select2();
    </script>

@endsection