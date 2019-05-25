@extends('layouts.cabang.app')

@section('content')

<div class="container-fluid">
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a href="#">Surat</a>
      </li>
      <li class="breadcrumb-item active">Tampilkan</li>
    </ol>
    <!-- Icon Cards-->
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header text-white bg-primary">
            Kurir Detail Surat : {{ $surat->nomor_surat }}
          </div>
          <div class="card-body">
                <table class="table table-striped">
                  <tr>
                      <th>ID</th>
                      <td>{{ $surat->id }}</td>
                  </tr>
                  <tr>
                      <th>Nomor Surat</th>
                      <td>{{ $surat->nomor_surat }}</td>
                  </tr>
                  <tr>
                      <th>Tanggal Surat</th>
                      <td>{{ $surat->tgl_surat }}</td>
                  </tr>
                  <tr>
                      <th>Keterangan</th>
                      <td>{{ $surat->keterangan }}</td>
                  </tr>
                  <tr>
                      <th>Nama Kurir</th>
                      <td>{{ $surat->kurir->user->nama }}</td>
                  </tr>
                </table>

                <table class="table table-bordered" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Pengirim</th>
                            <th>Penerima</th>
                            <th>Kota Tujuan</th>
                            <th>Alamat Lengkap</th>
                            <th>Jumlah Biaya</th>
                            <th>Berat (Kg)</th>
                            <th>Metode Pembayaran</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pengiriman as $d)
                        <tr>
                            <td>{{ $d->pelanggan_pengirim->user->nama }}</td>
                            <td>{{ $d->pelanggan_penerima->user->nama }}</td>

                            @if($d->pelanggan_penerima->kota == 1)<td>Palembang</td>
                            @elseif($d->pelanggan_penerima->kota == 2)<td>Jambi</td>
                            @elseif($d->pelanggan_penerima->kota == 3)<td>Pekanbaru</td>
                            @else<td>Padang</td>                                                                                                
                            @endif
                            
                            <td>{{ $d->pelanggan_penerima->alamat }}</td>
                            <td>{{ $d->jumlah_biaya }}</td>
                            <td>{{ $d->berat }}</td>

                            @if($d->metode_pembayaran == 1)<td>Bayar di Jakarta</td>
                            @elseif($d->metode_pembayaran == 2)<td>Bayar di Tujuan</td>
                            @elseif($d->metode_pembayaran == 3)<td>Transfer</td>
                            @else <td>Langganan</td>   
                            @endif                         
                        </tr>
                        @endforeach
                    </tbody>
                </table>
          </div>
        </div>
      </div>
    </div>
</div>
@endsection
