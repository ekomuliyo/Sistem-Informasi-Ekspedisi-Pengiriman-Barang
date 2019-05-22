@extends('layouts.cabang.app')

@section('assets-top')
    <style>
        .volume{
            display: none;
        }
    </style>
@endsection

@section('content')

<div class="container-fluid">
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a href="#">Pengiriman</a>
      </li>
      <li class="breadcrumb-item active">Ubah</li>
    </ol>

    <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header text-white bg-primary">
              Ubah Pengiriman
              </div>
              {!! Form::model($pengiriman, ['route' => ['cabang.pengiriman.update', $pengiriman->id], 'method' => 'PUT']) !!}
                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Nomor Surat</label>
                    <div class="col-md-6">
                        <select name="id_surat" id="nameid" class ="form-control" required >
                                <option value="" disabled selected hidden>Pilih Nomor Surat</option>
                                @foreach($surat as $d)
                                <option value="{{$d->id}}" 
                                @if($d->id == $pengiriman->id_surat) 
                                    selected = "selected"
                                @endif>
                                {{$d->nomor_surat}}</option>
                                @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Nama Pengirim</label>
                    <div class="col-md-6">
                        <select name="id_pengirim" id="nameid2" class ="form-control" required >
                                <option value="" disabled selected hidden>Pilih Nama Pengirim</option>
                                @foreach($pelanggan as $d)
                                <option value="{{$d->id}}"
                                @if($d->id == $pengiriman->id_pengirim)
                                    selected = "selected"
                                @endif
                                >{{$d->user->nama}}</option>
                                @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Nama Penerima</label>
                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Biaya Ongkir : Rp. <label for="ongkir" id="ongkir"> 0</label></label>
                    <div class="col-md-6">
                        <select name="id_penerima" id="nameid3" class ="form-control" required >
                                <option value="" disabled selected hidden>Pilih Nama Penerima</option>
                                @foreach($pelanggan as $d)
                                <option value="{{$d->id}}"
                                @if($d->id == $pengiriman->id_penerima)
                                    selected = "selected"
                                @endif
                                >{{$d->user->nama}}</option>
                                @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Jumlah Koli</label>
                    <div class="col-md-6  ">
                        <input type="number" value="{{ $koli->count() }}" class="form-control" id="input_koli" min="0" placeholder="Jumlah koli" required readonly>
                    </div>
                </div>
                <div class="form-group" id="container">
                    <!-- container berapa banyak koli dimasukan -->
                </div>
                <div class="berat">
                    <div class="form-group" >
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Berat (Kg)</label>
                        <div class="col-md-6  ">
                            <input name="berat_kg" type="number" id="berat_kg" value="{{ $pengiriman->berat }}" class="form-control" min="0" placeholder="Kg">
                        </div>
                    </div>
                    <label for="jumlah_biaya" class="control-label col-md-2 col-sm-2 col-xs-12">Jumlah Biaya : </label>
                    <label for="jumlah_biaya" class="control-label col-md-4 col-sm-4 col-xs-12">
                        Rp : <input name="jumlah_biaya_kg" id="jumlah_biaya_kg" readonly="readonly" class="control-label col-md-4 col-sm-4 col-xs-12" value="{{ $pengiriman->jumlah_biaya }}">
                    </label>
                </div>
                <div class="volume" >
                    <div class="form-group" >
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">P x L x T (CM) = PxLxT / 4000</label>
                        <div class="col-md-6  ">
                            <input type="number" class="form-control" min="0" id="panjang" placeholder="Panjang">
                        </div>
                        <div class="col-md-6  ">    
                            <input type="number" class="form-control" min="0" id="lebar" placeholder="Lebar">
                        </div>
                        <div class="col-md-6  ">
                            <input type="number" class="form-control" min="0" id="tinggi" placeholder="Tinggi">
                        </div>
                    </div>
                    <label for="berat" class="control-label col-md-2 col-sm-2 col-xs-12">Total Berat : </label>
                    <label for="berat" class="control-label col-md-4 col-sm-4 col-xs-12">
                        <input name="berat_volume" id="berat_volume" readonly="readonly" class="control-label col-md-4 col-sm-4 col-xs-12" > Kg
                    </label></br>
                    <label for="jumlah biaya" class="control-label col-md-2 col-sm-2 col-xs-12">Jumlah biaya : </label>
                    <label for="jumlah_biaya" class="control-label col-md-4 col-sm-4 col-xs-12">
                        <input name="jumlah_biaya_volume" id="jumlah_biaya_volume" readonly="readonly" class="control-label col-md-4 col-sm-4 col-xs-12">
                    </label>
                </div>
                <a id="hideLink" class="control-label col-md-3 col-sm-3 col-xs-12" href="#">Hitung volume</a>
                </br></br>
                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Metode Pembayaran</label>
                    <div class="col-md-6">
                        <select name="metode_pembayaran" class ="form-control" required >
                                <option value="" disabled selected hidden>Pilih metode pembayaran</option>
                                <option value="1"
                                    @if($pengiriman->metode_pembayaran == 1)
                                        selected = 'selected' 
                                    @endif>Bayar di Jakarta</option>
                                <option value="2" 
                                    @if($pengiriman->metode_pembayaran == 2)
                                        selected = 'selected' 
                                    @endif>Bayar di Tujuan</option>
                                <option value="3" 
                                    @if($pengiriman->metode_pembayaran == 3)
                                        selected = 'selected' 
                                    @endif>Transfer</option>
                                <option value="4" 
                                    @if($pengiriman->metode_pembayaran == 4)
                                        selected = 'selected' 
                                    @endif>Langganan</option>                    
                        </select>
                    </div>
                </div>
                <div class="card-footer bg-transparent">
                <button class="btn btn-primary" type="submit">
                    Masukan
                </button>
                </div>
              {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@endsection

@section('assets-bottom')

<script type="text/javascript">

        const arrayKoli = [
            @foreach($koli as $d)
                "{{ $d->deskripsi }}",
            @endforeach
        ];

        $(document).ready(function(){
            ongkir = 0;

            // mengambil data ongkir dari data sebelumnya
            var pelanggan = document.getElementById('nameid3');
            var pelanggan_id = pelanggan.options[pelanggan.selectedIndex].value;
            $.get('/cabang/json-ongkir?pelanggan_id=' + pelanggan_id, function(data){
                document.getElementById("ongkir").innerHTML = data;
                ongkir = data; // mengeset nilai ongkir di variabel global
            });
                // mengambil biaya ongkir berdasarkan kota pelanggan penerima ketika di ubah lagi
            $("#nameid3").on('change', function(e){
                var ongkir_id = document.getElementById('ongkir');
                var pelanggan_id = e.target.value;
                $.get('/cabang/json-ongkir?pelanggan_id=' + pelanggan_id, function(data){
                    ongkir_id.innerHTML = data;
                    ongkir = data;
                });
            });

            // hitung jumlah biaya dari kg
            $("#berat_kg").on('input', function(){
                var jumlah_biaya_kg = document.getElementById('jumlah_biaya_kg');
                var berat_kg = document.getElementById("berat_kg").value; 
                jumlah_biaya_kg.value = ongkir * berat_kg;
            })
            // mengambil data koli dari data sebelumnya
            if($("#input_koli").val()){
                var input = document.getElementById("input_koli").value;
                var container = document.getElementById("container");

                for (let i = 0; i < input; i++) {
                    var elementLabel = document.createElement("label");
                    var textLabel = document.createTextNode("Koli " + (i+1));
                    elementLabel.setAttribute("class", "control-label col-md-3 col-sm-3 col-xs-12");
                    elementLabel.appendChild(textLabel);

                    var divCol = document.createElement("div");
                    divCol.setAttribute("class", "col-md-6");

                    var elementInput = document.createElement("input");
                    elementInput.setAttribute("type", "text");
                    elementInput.setAttribute("name", "koli[]");
                    elementInput.setAttribute("class", "form-control");
                    elementInput.setAttribute("value", arrayKoli[i]);
                    elementInput.setAttribute("required", "required");
                    divCol.appendChild(elementInput);

                    container.appendChild(elementLabel);
                    container.appendChild(divCol);
                }
            }
            
            // membuat jumlah input koli berdasarkan data input baru
            $("#input_koli").keyup(function (){
                var input = document.getElementById("input_koli").value;
                var container = document.getElementById("container");

                while(container.hasChildNodes()){
                    container.removeChild(container.lastChild);
                }

                for (let i = 0; i < input; i++) {
                    var elementLabel = document.createElement("label");
                    var textLabel = document.createTextNode("Koli " + (i+1));
                    elementLabel.setAttribute("class", "control-label col-md-3 col-sm-3 col-xs-12");
                    elementLabel.appendChild(textLabel);

                    var divCol = document.createElement("div");
                    divCol.setAttribute("class", "col-md-6");

                    var elementInput = document.createElement("input");
                    elementInput.setAttribute("type", "text");
                    elementInput.setAttribute("name", "koli[]");
                    elementInput.setAttribute("class", "form-control");
                    elementInput.setAttribute("required", "required");
                    divCol.appendChild(elementInput);

                    container.appendChild(elementLabel);
                    container.appendChild(divCol);
                }
            });

            // menampilkan metode perhitungan kg / volume
            $("#hideLink").on("click", function (){
                if ($(this).text() == "Hitung volume") {
                    $(this).text("Hitung berat");
                    $(".berat").hide();
                    $("#berat_kg").val("");
                    $("#jumlah_biaya_kg").val("");
                    $(".volume").show("slow")
                }else{
                    $(this).text("Hitung volume");
                    $(".volume").hide();
                    $("#panjang").val("");
                    $("#lebar").val("");
                    $("#tinggi").val("");
                    $("#berat_volume").val("");
                    $("#jumlah_biaya_volume").val(""); 
                    $(".berat").show("slow");                    
                }
            });

            // menghitung berdasarkan volume 
            var berat_volume = document.getElementById("berat_volume");
            var jumlah_biaya_volume = document.getElementById("jumlah_biaya_volume");
            $("#panjang").on("input", function(){
                panjang = document.getElementById("panjang").value;
                berat_volume.value = (panjang * lebar * tinggi) / 4000;
                jumlah_biaya_volume.value = berat_volume.value * ongkir;
            });

            $("#lebar").on("input", function(){
                lebar = document.getElementById("lebar").value;
                berat_volume.value = (panjang * lebar * tinggi) / 4000;
                jumlah_biaya_volume.value = berat_volume.value * ongkir;

            });

            $("#tinggi").on("input", function(){
                tinggi = document.getElementById("tinggi").value;
                berat_volume.value = (panjang * lebar * tinggi) / 4000;
                jumlah_biaya_volume.value = berat_volume.value * ongkir;

            });
        });
        
</script>

@endsection