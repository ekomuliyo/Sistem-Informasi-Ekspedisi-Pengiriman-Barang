@extends('layouts.direktur.app')

@section('content')

<div class="container-fluid">
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a href="#">Users</a>
      </li>
      <li class="breadcrumb-item active">Ubah</li>
    </ol>
    <!-- Icon Cards-->
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header text-white bg-primary">
            Edit User
          </div>
          {!! Form::model($user, ['route' => ['direktur.users.update', $user->id], 'method' => 'PUT']) !!}
            @include('direktur.users._form')
        {!! Form::close() !!}
        </div>
      </div>
    </div>
</div>

@endsection