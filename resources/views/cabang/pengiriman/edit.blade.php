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
                <div class="row">
                <div class="col-md-6">
                    <label class="control-label col-md-12"><h2>Data Pengirim</h2></label>
                    <hr>
                    <div class="form-group">
                        <label class="control-label col-md-12">Nama Pengirim</label>
                        <div class="col-md-12">
                            <input type="text" class="form-control" name="nama_pengirim" value="{{ $pengiriman->nama_pengirim }}" required placeholder="Nama pengirim">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-12">Nomor HP / Wa Pengirim</label>
                        <div class="col-md-12">
                            <input type="number" class="form-control" name="no_hp_pengirim" value="{{ $pengiriman->no_hp_pengirim }}" required placeholder="No Hp / Wa Pengirim">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-12">Kota Pengirim</label>
                        <div class="col-md-12">
                            <select name="id_kota_pengirim" id="id_kota_pengirim" class ="form-control" required >
                                    <option value="" disabled selected hidden>Pilih kota</option>
                                    <option value="5" @if($pengiriman->kecamatan_pengirim->kota->id == 5)
                                        selected
                                    @endif>Jakarta Pusat</option>
                                    <option value="6" @if($pengiriman->kecamatan_pengirim->kota->id == 6)
                                        selected
                                    @endif>Jakarta Barat</option>
                                    <option value="7" @if($pengiriman->kecamatan_pengirim->kota->id == 7)
                                        selected
                                    @endif>Jakarta Utara</option>
                                    <option value="8" @if($pengiriman->kecamatan_pengirim->kota->id == 8)
                                        selected
                                    @endif>Jakarta Timur</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-12">Kecamatan Pengirim</label>
                        <div class="col-md-12">
                            <select name="id_kecamatan_pengirim" id="id_kecamatan_pengirim" class ="form-control" required >
                                    <option value="" disabled selected hidden>Pilih Kecamatan</option>
                            </select>
                        </div>
                    </div>
                    <input type="text" value="{{ $pengiriman->id_kecamatan_pengirim }}" id="kecamatan_pengirim_terpilih" hidden>                
                    <div class="form-group">
                        <label class="control-label col-md-12">Alamat Lengkap Pengirim</label>
                        <div class="col-md-12">
                            <textarea class="form-control" name="alamat_pengirim" rows="5" required>{{ $pengiriman->alamat_pengirim }}</textarea>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <label class="control-label col-md-12"><h2>Data Penerima</h2></label>
                    <hr>
                    <div class="form-group">
                        <label class="control-label col-md-12">Nama Penerima</label>
                        <div class="col-md-12">
                            <input type="text" class="form-control" name="nama_penerima" value="{{ $pengiriman->nama_penerima }}" required placeholder="Nama penerima">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-12">Nomor HP / Wa penerima</label>
                        <div class="col-md-12">
                            <input type="number" class="form-control" name="no_hp_penerima" value="{{ $pengiriman->no_hp_penerima }}" required placeholder="No Hp / Wa Penerima">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-12">Kota Penerima</label>
                        <div class="col-md-12">
                            <select name="id_kota_penerima" id="id_kota_penerima" class ="form-control" required >
                                    <option value="" disabled selected hidden>Pilih kota</option>
                                    <option value="1" @if($pengiriman->kecamatan_penerima->kota->id == 1)
                                        selected
                                    @endif>Palembang</option>
                                    <option value="2" @if($pengiriman->kecamatan_penerima->kota->id == 2)
                                        selected
                                    @endif>Jambi</option>
                                    <option value="3" @if($pengiriman->kecamatan_penerima->kota->id == 3)
                                        selected
                                    @endif>Pekanbaru</option>
                                    <option value="4" @if($pengiriman->kecamatan_penerima->kota->id == 4)
                                        selected
                                    @endif>Padang</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-12">Kecamatan Penerima</label>
                        <div class="col-md-12">
                            <select name="id_kecamatan_penerima" id="id_kecamatan_penerima" class ="form-control" required >
                                    <option value="" disabled selected hidden>Pilih Kecamatan</option>
                            </select>
                        </div>
                    </div>
                    <input type="text" value="{{ $pengiriman->id_kecamatan_penerima }}" id="kecamatan_penerima_terpilih" hidden>                
                    <div class="form-group">
                        <label class="control-label col-md-12">Alamat Lengkap Penerima</label>
                        <div class="col-md-12">
                            <textarea class="form-control" name="alamat_penerima" rows="5" required>{{ $pengiriman->alamat_penerima }}</textarea>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label col-md-12">Jumlah Koli</label>
                        <div class="col-md-12">
                            <input type="number" class="form-control" id="input_koli" value="{{ $pengiriman->koli->count() }}" readonly required>
                        </div>
                    </div>
                    <div class="form-group" id="container">
                        <!-- container berapa banyak koli dimasukan -->
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label col-md-12">Biaya ongkir anda : Rp. <label for="ongkir" id="ongkir"></label></label>
                    </div>
                    <div class="form-group">
                    <label class="control-label col-md-12">Metode Pembayaran</label>
                    <div class="col-md-12">
                        <select name="metode_pembayaran" class ="form-control" required >
                                <option value="" disabled selected hidden>Pilih metode pembayaran</option>
                                <option value="1" @if($pengiriman->metode_pembayaran == 1 ) 
                                    selected
                                @endif>Cash</option>
                                <option value="2" @if($pengiriman->metode_pembayaran == 2 ) 
                                    selected
                                @endif>COD</option>
                                <option value="3" @if($pengiriman->metode_pembayaran == 3 ) 
                                    selected
                                @endif>Transfer</option>
                                <option value="4" @if($pengiriman->metode_pembayaran == 4 ) 
                                    selected
                                @endif>Langganan</option>                    
                        </select>
                </div></br>
                <div class="berat">
                        <div class="form-group" >
                            <label class="control-label col-md-12">Berat (Kg)</label>
                            <div class="col-md-12">
                                <input name="berat_kg" type="double" id="berat_kg" 
                                    class="form-control" placeholder="Kg" value="{{ $pengiriman->berat }}"
                                    step="0.1">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <label for="jumlah_biaya" class="control-label col-md-12">Jumlah Biaya : </label>
                            </div>
                            <div class="col-md-8">
                                <label for="jumlah_biaya" class="control-label col-md-12">
                                Rp : <input name="jumlah_biaya_kg" id="jumlah_biaya_kg" readonly="readonly" class="control-label col-md-6" value="{{ $pengiriman->jumlah_biaya }}">
                                </label>
                            </div>
                        </div>

                    </div>
                    <div class="volume" >
                        <div class="form-group" >
                            <label class="control-label col-md-12">P x L x T (CM) = PxLxT / 4000</label>
                            <div class="col-md-12">
                                <input type="number" class="form-control" min="0" id="panjang" placeholder="Panjang">
                            </div>
                            <div class="col-md-12">    
                                <input type="number" class="form-control" min="0" id="lebar" placeholder="Lebar">
                            </div>
                            <div class="col-md-12">
                                <input type="number" class="form-control" min="0" id="tinggi" placeholder="Tinggi">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <label for="berat" class="control-label col-md-12">Total Berat : </label>
                            </div>
                            <div class="col-md-8">
                                <label for="berat" class="control-label col-md-12">
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <input name="berat_volume" id="berat_volume" readonly="readonly" class="control-label col-md-5" > Kg
                                </label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <label for="jumlah biaya" class="control-label col-md-12">Jumlah biaya : Rp</label>
                            </div>
                            <div class="col-md-8">
                                <label for="jumlah_biaya" class="control-label col-md-12">
                                    Rp. <input name="jumlah_biaya_volume" id="jumlah_biaya_volume" readonly="readonly" class="control-label col-md-5">
                                </label>
                            </div>
                        </div>

                    </div>
                    <a id="hideLink" class="control-label col-md-3 col-sm-3 col-xs-12" href="#">Hitung volume</a>
                    </br></br>
                    <div class="card-footer bg-transparent">
                    <button class="btn btn-primary" type="submit">
                        Ubah
                    </button>
                </div>
                </div>
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

            // mengambil data kecamatan pengirim berdasarkan kota
            var kota_pengirim = $('#id_kota_pengirim');
            var kecamatan_pengirim = $('#id_kecamatan_pengirim');
            var kecamatan_pengirim_terpilih = $('#kecamatan_pengirim_terpilih').val();
            
            kota_pengirim.select2().on('change', function(){
                $.ajax({
                url: '/cabang/json/kecamatan/' + kota_pengirim.val(),
                type: 'GET',
                success: function(data){
                    kecamatan_pengirim.empty();
                    kecamatan_pengirim.append('<option value="" disabled selected hidden>Pilih Kecamatan</option>');
                    $.each(data, function(value, key){
                        if (value == kecamatan_pengirim_terpilih) {
                            kecamatan_pengirim.append('<option value="'+value+'" selected>'+key+'</option>');
                        }else{
                            kecamatan_pengirim.append('<option value="'+value+'">'+key+'</option>');                    
                        }
                    });

                    kecamatan_pengirim.select2();
                }});
            }).trigger('change');

            // mengambil data kecamatan penerima berdasarkan kota
            var kota_penerima = $('#id_kota_penerima');
            var kecamatan_penerima = $('#id_kecamatan_penerima');
            var kecamatan_penerima_terpilih = $('#kecamatan_penerima_terpilih').val();

            kota_penerima.select2().on('change', function(){
                $.ajax({
                url: '/cabang/json/kecamatan/' + kota_penerima.val(),
                type: 'GET',
                success: function(data){
                    kecamatan_penerima.empty();
                    kecamatan_penerima.append('<option value="" disabled selected hidden>Pilih Kecamatan</option>');
                    $.each(data, function(value, key){
                        if (value == kecamatan_penerima_terpilih) {
                            kecamatan_penerima.append('<option value="'+value+'" selected>'+key+'</option>');
                        }else{
                            kecamatan_penerima.append('<option value="'+value+'">'+key+'</option>');                    
                        }
                    });

                    kecamatan_penerima.select2();
                }});
            }).trigger('change')

            // mengeset nilai ongkir dari data sebelumnya
            $.ajax({
                url: '/cabang/json-ongkir/' + kecamatan_penerima_terpilih,
                type: 'GET',
                success: function(data){
                    document.getElementById('ongkir').innerHTML = data;
                    ongkir = data;
                }
            });

            // mengeset nilai ongkir saat dipilih
            kecamatan_penerima.select2().on('change', function(){
                $.ajax({
                    url: '/cabang/json-ongkir/' + kecamatan_penerima.val(),
                    type: 'GET',
                    success: function(data){
                        document.getElementById('ongkir').innerHTML = data;
                        ongkir = data;
                    }
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
                    divCol.setAttribute("class", "col-md-12");

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

            // menghitung jumlah biaya berdasarkan volume 
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


        $("#id_pengirim").select2();
        
</script>

@endsection