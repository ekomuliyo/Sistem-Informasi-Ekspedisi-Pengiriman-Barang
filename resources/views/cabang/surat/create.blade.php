@extends('layouts.cabang.app')

@section('content')
    <div class="container-fluid">
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="#">Surat</a>
          </li>
          <li class="breadcrumb-item active">Tambah Surat Pengiriman</li>
        </ol>
        <!-- Icon Cards-->
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header text-white bg-primary">
              Tambah Surat Pengiriman
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
      $(document).ready(function(){
        $("input").on('click', function(){
          console.log("HAI");
        });

        $("#item").on('click', function(){
          console.log("HAi juga");
        });
      })
        $('#id_pengiriman').select2({
        placeholder: 'Cari nomor resi..',
        ajax: {
          url: '/cabang/json/no_resi',
          dataType: 'json',
          delay: 250,
          processResults: function (data) {
              return {
                results:  $.map(data, function (item) {
                  return {
                    text: item.no_resi + ' - ' + item.nama_penerima,
                    id: item.id
                }
              })
          };
        },
        cache: true
        },
        });
        $("#id_kurir").select2();
    </script>

    <!-- Vue JS -->
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
    <!-- Axios -->
    <script src="https://unpkg.com/axios@0.19.0/dist/axios.min.js"></script>

    
    <script language="Javascript">
      const url = "/cabang/api/surat/create";
      const vm = new Vue({
        el: '#app',
        data: {
          results: [], selected:[], selectAll: false
        },
        mounted(){
          axios.get('http://localhost:8000/cabang/api/surat/create').then(response => {
            this.results = response.data
          })
        },
        methods: {
          select() {
            this.selected = [];
            if(!this.selectAll){
              for(let i in this.results){
                this.selected.push(this.results[i].no_resi + ' ' + this.results[i].nama_penerima);
              }
            }
          }
        }
      });


    </script>

@endsection