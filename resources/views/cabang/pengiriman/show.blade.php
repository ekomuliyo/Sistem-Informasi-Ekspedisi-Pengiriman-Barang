@extends('layouts.cabang.app')

@section('content')

<div class="container-fluid">
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a href="#">Pengiriman Barang</a>
      </li>
      <li class="breadcrumb-item active">Tampilkan</li>
    </ol>
    <!-- Icon Cards-->
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header text-white bg-primary">
            Pengiriman Barang Detail : {{ $pengiriman->pelanggan_pengirim->user->nama }}
          </div>
          <div class="card-body">
              <table class="table table-striped">
                  <tr>
                      <th>ID</th>
                      <td>{{ $pengiriman->id }}</td>
                  </tr>
                  <tr>
                      <th>Pengirim</th>
                      <td>{{ $pengiriman->pelanggan_pengirim->user->nama }}</td>
                  </tr>
                  <tr>
                      <th>Penerima</th>
                      <td>{{ $pengiriman->pelanggan_penerima->user->nama }}</td>
                  </tr>
                  <tr>
                      <th>Kota Tujuan</th>
                        @if($pengiriman->pelanggan_penerima->kota == 1)
                            <td>Palembang</td>
                        @elseif($pengiriman->pelanggan_penerima->kota == 2)
                            <td>Jambi</td>
                        @elseif($pengiriman->pelanggan_penerima->kota == 3)
                            <td>Pekanbaru</td>
                        @else
                            <td>Padang</td>                                                                                                
                        @endif
                  </tr>
                  <tr>
                      <th>Alamat Lengkap</th>
                      <td>{{ $pengiriman->pelanggan_penerima->alamat }}</td>
                  </tr>
                  <tr>
                      <th>Keterangan</th>
                      <td>{{ $pengiriman->status_pengiriman[$pengiriman->status_pengiriman->count()-1]->keterangan }}</td>
                  </tr>
                  <tr>
                      <th>Jumlah Koli</th>
                      <td>{{ $pengiriman->koli->count() }}</br> 
                      @foreach($pengiriman->koli as $d)
                        - {{ $d->deskripsi }} </br>
                      @endforeach
                      </td>
                  </tr>
                  <tr>
                    <th>Metode Pembayaran</th>    
                    <td>
                    @if($pengiriman->metode_pembayaran == 1)
                        Bayar di Jakarta
                    @elseif($pengiriman->metode_pembayaran == 2)
                        Bayar di Tujuan
                    @elseif($pengiriman->metode_pembayaran == 3)
                        Transfer
                    else
                        Langganan
                    @endif
                    </td>              
                  </tr>
              </table>
          </div>
        </div>
      </div>
    </div>
</div>

@endsection