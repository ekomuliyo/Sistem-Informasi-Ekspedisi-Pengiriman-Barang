@extends('layouts.cabang.app')

@section('content')

<div class="container-fluid">
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a href="#">Ongkir</a>
      </li>
      <li class="breadcrumb-item active">Tampilkan</li>
    </ol>
    <!-- Icon Cards-->
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header text-white bg-primary">
            Kurir Detail Tujuan : {{ $ongkir->tujuan }}
          </div>
          <div class="card-body">
              <table class="table table-striped">
                  <tr>
                      <th>ID</th>
                      <td>{{ $ongkir->id }}</td>
                  </tr>
                  <tr>
                      <th>Kota Asal</th>
                      <td>{{ $ongkir->asal }}</td>
                  </tr>
                  <tr>
                      <th>Kota Tujuan</th>
                      <td>{{ $ongkir->kecamatan->kota->nama }}</td>
                  </tr>
                  <tr>
                      <th>Estimasi</th>
                      <td>{{ $ongkir->estimasi }}</td>
                  </tr>
                  <tr>
                      <th>Harga</th>
                      <td>{{ $ongkir->harga }}</td>
                  </tr>
              </table>
          </div>
        </div>
      </div>
    </div>
</div>

@endsection