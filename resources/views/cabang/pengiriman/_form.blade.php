@section('assets-top')
    <style>
        .volume{
            display: none;
        }
    </style>
@endsection
    
    <div class="form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12">Nomor Surat</label>
        <div class="col-md-6">
            <select name="id_surat" id="nameid" class ="form-control" required >
                    <option value="" disabled selected hidden>Pilih Nomor Surat</option>
                    @foreach($surat as $d)
                    <option value="{{$d->id}}">{{$d->nomor_surat}}</option>
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
                    <option value="{{$d->id}}">{{$d->user->nama}}</option>
                    @endforeach
            </select>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12">Nama Penerima</label>
        <div class="col-md-6">
            <select name="id_penerima" id="nameid3" class ="form-control" required >
                    <option value="" disabled selected hidden>Pilih Nama Penerima</option>
                    @foreach($pelanggan as $d)
                    <option value="{{$d->id}}">{{$d->user->nama}}</option>
                    @endforeach
            </select>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12">Jumlah Koli</label>
        <div class="col-md-6  ">
            <input type="number" class="form-control" id="input" min="0" placeholder="Jumlah koli">
        </div>
    </div>
    <div class="form-group" id="container">
        <!-- container berapa banyak koli dimasukan -->
    </div>
    <div class="berat">
        <div class="form-group" >
            <label class="control-label col-md-3 col-sm-3 col-xs-12">Berat (Kg)</label>
            <label class="control-label col-md-3 col-sm-3 col-xs-12">Biaya Ongkir : </label>
            <div class="col-md-6  ">
                <input name="berat" type="number" class="form-control" min="0" placeholder="Kg">
            </div>
        </div>
        <label for="jumlah_biaya" class="control-label col-md-2 col-sm-2 col-xs-12">Jumlah Biaya : </label>
        <label for="jumlah_biaya" class="control-label col-md-4 col-sm-4 col-xs-12">
            Rp : <input name="jumlah_biaya" id="jumlah_biaya" readonly="readonly" class="control-label col-md-3 col-sm-3 col-xs-12" value="1000">
        </label>

    </div>
    <div class="volume" >
        <div class="form-group" >
            <label class="control-label col-md-3 col-sm-3 col-xs-12">P x L x T (Meter)</label>
            <label class="control-label col-md-3 col-sm-3 col-xs-12">Biaya Ongkir : </label>
            <div class="col-md-6  ">
                <input type="number" class="form-control" min="0" placeholder="Panjang">
            </div>
            <div class="col-md-6  ">
                <input type="number" class="form-control" min="0" placeholder="Lebar">
            </div>
            <div class="col-md-6  ">
                <input type="number" class="form-control" min="0" placeholder="Tinggi">
            </div>
        </div>
        <label for="berat" class="control-label col-md-2 col-sm-2 col-xs-12">Berat : </label>
        <label for="berat" class="control-label col-md-4 col-sm-4 col-xs-12">
            Rp : <input name="berat_volume" id="berat" readonly="readonly" class="control-label col-md-3 col-sm-3 col-xs-12" value="200000">
        </label></br>
        <label for="jumlah biaya" class="control-label col-md-2 col-sm-2 col-xs-12">Jumlah biaya : </label>
        <label for="jumlah_biaya" class="control-label col-md-4 col-sm-4 col-xs-12">
            Rp : <input name="jumlah_biaya_volume" id="jumlah_biaya" readonly="readonly" class="control-label col-md-3 col-sm-3 col-xs-12" value="200000">
        </label>
    </div>
    <a id="hideLink" class="control-label col-md-3 col-sm-3 col-xs-12" href="#">Hitung volume</a>
    </br></br>
    <div class="form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12">Metode Pembayaran</label>
        <div class="col-md-6">
            <select name="metode_pembayaran" class ="form-control" required >
                    <option value="" disabled selected hidden>Pilih metode pembayaran</option>
                    <option value="1">Bayar di Jakarta</option>
                    <option value="2">Bayar di Tujuan</option>
                    <option value="1">Transfer</option>
            </select>
        </div>
    </div>
    <div class="card-footer bg-transparent">
    <button class="btn btn-primary" type="submit">
        Masukan
    </button>
    </div>
 

@section('assets-bottom')
    <script type="text/javascript">
    
    $("#hideLink").on("click", function (){
        if ($(this).text() == "Hitung volume") {
            $(this).text("Hitung berat");
            $(".berat").hide();
            $(".volume").fadeIn("slow");
        }else{
            $(this).text("Hitung volume");
            $(".volume").hide(); 
            $(".berat").fadeIn("slow");
        }
    });

        // jumlah koli
        input.oninput = function (){
            var input = document.getElementById("input").value;
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
                elementInput.setAttribute("class", "form-control")
                divCol.appendChild(elementInput);

                container.appendChild(elementLabel);
                container.appendChild(divCol);
            }
        };

        $("#nameid").select2();
        $("#nameid2").select2();
        $("#nameid3").select2();


    </script>

@endsection