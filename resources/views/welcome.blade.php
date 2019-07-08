<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>PT Bunga Lintas Cargo | Home</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicons -->
    <link href="img/favicon.png" rel="icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Raleway:300,400,500,700,800|Montserrat:300,400,700" rel="stylesheet">

    <!-- Bootstrap CSS File -->
    <link href="{{ asset('assets/blog-admin/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    
    <!-- Libraries CSS Files -->
    <link href="{{ asset('assets/blog-admin/vendor/magnific-popup/magnific-popup.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/blog-admin/vendor/owlcarousel/owl.carousel.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/blog-admin/vendor/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/blog-admin/vendor/ionicons/ionicons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/blog-admin/vendor/animate/animate.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/blog-admin/vendor/bootstrap/css/select2.min.css') }}" rel="stylesheet">
    



    <!-- Main Stylesheet File -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">

    <!-- =======================================================
    Theme Name: Reveal
    Theme URL: https://bootstrapmade.com/reveal-bootstrap-corporate-template/
    Author: BootstrapMade.com
    License: https://bootstrapmade.com/license/
  ======================================================= -->
</head>

<body id="body">

    <!--==========================
    Header
  ============================-->
    <header id="header">
        <div class="container">

            <div id="logo" class="pull-left">
                <h1>
                    <a href="#body" class="scrollto">
                        <img src="{{ asset('images/logo.jpeg') }}" alt="PT Bunga Lintas Cargo" height="60px" width="100px">
                    </a>
                </h1>
                <!-- Uncomment below if you prefer to use an image logo -->
                <!-- <a href="#body"><img src="img/logo.png" alt="" title="" /></a>-->
            </div>

            <nav id="nav-menu-container">
                <ul class="nav-menu">
                    <li class="menu-active"><a href="#body">Beranda</a></li>
                    <li><a href="#services">Layanan</a></li>
                    <li><a href="#about">Tentang Kami</a></li>
                    <li><a href="#contact">Hubungi Kami</a></li>
                    @if(Auth::check())
                        @if(Auth::user()->level == 'direktur')
                        <li class="menu-has-children"><a href="#">Hai, {{ Auth::user()->nama }}</a>
                            <ul>
                            <li><a href="{{ url('/direktur') }}">Dashbord</a></li>
                            </ul>
                        </li>
                        @elseif(Auth::user()->level == 'admin')
                        <li class="menu-has-children"><a href="#">Hai, {{ Auth::user()->nama }}</a>
                            <ul>
                            <li><a href="{{ url('/cabang') }}">Dashbord</a></li>
                            </ul>
                        </li>
                        @elseif(Auth::user()->level == 'kurir')
                        <li class="menu-has-children"><a href="#">Hai, {{ Auth::user()->nama }}</a>
                            <ul>
                            <li><a href="{{ url('/kurir') }}">Dashbord</a></li>
                            </ul>
                        </li>
                        @else
                        <li class="menu-has-children"><a href="#">Hai, {{ Auth::user()->nama }}</a>
                            <ul>
                            <li><a href="{{ url('/pelanggan') }}">Dashbord</a></li>
                            </ul>
                        </li>
                        @endif
                    @else
                    <li><a href="{{ route('login') }}">Masuk</a></li>
                    <li><a href="{{ route('register') }}">Daftar</a></li>
                    @endif
                </ul>
            </nav>
            <!-- #nav-menu-container -->
        </div>
    </header>
    <!-- #header -->

    <!--==========================
    Intro Section
  ============================-->
    <section id="intro">

        <div class="intro-content">
            <h2>Selamat Datang Di Website Resmi PT Bunga Lintas Cargo
                <br>Jakarta - Palembang - Pekanbaru - Bukit Tinggi<br>
                <span>KAMI SIAP MELAYANI ANDA</span>
            </h2>
        </div>

        <div id="intro-carousel" class="owl-carousel">
            <div class="item" style="background-image: url('{{ asset('images/background_1.jpg') }}');"></div>
            <div class="item" style="background-image: url('{{ asset('images/background_2.jpg') }}');"></div>
            <div class="item" style="background-image: url('{{ asset('images/background_3.jpg') }}');"></div>
        </div>

    </section>
    <!-- #intro -->

    <main id="main">

        <!--==========================
    Services Section
  ============================-->
        <section id="services">
            <div class="container">
                <div class="section-header">
                    <h2>Layanan</h2>
                </div>

                <div class="row">
                    <div class="col-lg-6">
                        <div class="box wow fadeInLeft">
                            <div class="icon"><i class="fa fa-car"></i></div>
                            <h4 class="title">CEK RESI</h4>
                            <form method="POST" action="{{ route('cek.resi') }}">
                                {{ csrf_field() }}
                                <input type="number" class="form-control" name="no_resi" placeholder="Nomor Resi">
                                <button type="submit" class="btn cta-btn align-middle">Cek</button>
                            </form>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="box wow fadeInRight">
                            <div class="icon"><i class="fa fa-money"></i></div>
                            <h4 class="title">CEK TARIF</h4>
                            <form method="POST" action="{{ route('cek.tarif') }}">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <input type="text" class="form-control" value="Jakarta Pusat" name="asal" readonly>
                                </div>
                                <div class="form-group">
                                    <select name="tujuan" id="tujuan" class="form-control" required>
                                        <option value="" disabled selected>Tujuan</option>
                                    </select>
                                </div>
                                <!-- perhitungan KG -->
                                <div class="kg">
                                <div class="form-group">
                                    <input type="number" id="berat_kg" class="form-control" name="berat_kg" placeholder="Berat (Kg)" min="1">
                                </div>
                                </div>
                                <!-- perhitungan volume -->
                                <div class="volume">
                                    <div class="form-group">
                                        <input type="number" id="panjang" class="form-control" name="panjang" placeholder="Panjang (Cm)">
                                    </div>
                                    <div class="form-group">
                                        <input type="number" id="lebar" class="form-control" name="lebar" placeholder="Lebar (Cm)">
                                    </div>
                                    <div class="form-group">
                                        <input type="number" id="tinggi" class="form-control" name="tinggi" placeholder="Tinggi (Cm)">
                                    </div>
                                    <div class="form-group">
                                        <input type="number" id="berat_volume" class="form-control" name="berat_volume" placeholder="Kg" readonly>
                                    </div>
                                </div>
                                <a href="" id="hide">Hitung berdasarkan volume</a><br>
                                <button type="submit" class="btn cta-btn align-middle">Cek</button>
                            </form>
                        </div>
                    </div>

                </div>

            </div>
        </section>
        <!-- #services -->

        <!--==========================
      About Section
    ============================-->
        <section id="about" class="wow fadeInUp">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 about-img">
                        <img src="{{ asset('images/about-img.jpg') }}" alt="">
                    </div>

                    <div class="col-lg-6 content">
                        <h2>Tentang Kami</h2>
                        <h3>Visi</h3>
                        <ul>
                            <li><i class="ion-android-checkmark-circle"></i> Menjadi perusahaan jasa expedisi yang handal, aman, mudah & terpercaya</li>
                        </ul>
                        <h3>Misi</h3>
                        <ul>
                            <li><i class="ion-android-checkmark-circle"></i> Menyediakan jasa expedisi yang dapat diandalkan dan terpercaya.</li>
                            <li><i class="ion-android-checkmark-circle"></i> Profesionalitas dan etos kerja yang tinggi guna dapat memberikan pelayanan yang terbaik.</li>
                            <li><i class="ion-android-checkmark-circle"></i> Berperan aktif dalam pendistribusian barang atau cargo.</li>
                        </ul>
                    </div>
                </div>

            </div>
        </section>
        <!-- #about -->

        <!--==========================
      Contact Section
    ============================-->
        <section id="contact" class="wow fadeInUp">
            <div class="container">
                <div class="section-header">
                    <h2>Hubungi Kami</h2>
                </div>

                <div class="row contact-info">
                    @foreach($cabang as $data)
                    <div class="col-md-4">
                        <div class="contact-address">
                            <i class="ion-ios-location-outline"></i>
                            <h3>{{ $data->user->nama }}</h3>
                            <address>{{ $data->alamat }}</address>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="contact-phone">
                            <i class="ion-ios-telephone-outline"></i>
                            <h3>Nomor Handphone</h3>
                            <p>{{ $data->no_hp }}</p>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="contact-email">
                            <i class="ion-ios-email-outline"></i>
                            <h3>Email</h3>
                            <p>{{ $data->user->email }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </section>
        <!-- #contact -->

    </main>

    <!--==========================
    Footer
  ============================-->
    <footer id="footer">
        <div class="container">
            <div class="copyright">
                &copy; Copyright <strong>2019</strong>. PT Bunga Lintas Cargo
            </div>
            <div class="credits">
                <!--
          All the links in the footer should remain intact.
          You can delete the links only if you purchased the pro version.
          Licensing information: https://bootstrapmade.com/license/
          Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/buy/?theme=Reveal
        -->
                Created by <a href="#">Eko Muliyo & Ainun Hilaliyyah</a>
            </div>
        </div>
    </footer>
    <!-- #footer -->

    <a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>

    <!-- JavaScript Libraries -->
    <script src="{{ asset('assets/blog-admin/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/blog-admin/vendor/jquery/jquery.sticky.js') }}"></script>
    <script src="{{ asset('assets/blog-admin/vendor/owlcarousel/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('assets/blog-admin/vendor/wow/wow.min.js') }}"></script>
    <script src="{{ asset('assets/blog-admin/vendor/superfish/superfish.min.js') }}"></script>
    <script src="{{ asset('assets/blog-admin/vendor/magnific-popup/magnific-popup.min.js') }}"></script>
    <script src="{{ asset('assets/blog-admin/vendor/easing/easing.min.js') }}"></script>
    <script src="{{ asset('assets/blog-admin/vendor/jquery/select2.min.js') }}"></script>


    <!-- library sweet alert -->
    @include('sweetalert::alert')

    <!-- Template Main Javascript File -->
    <script src="{{ asset('js/main.js') }}"></script>

    <script type="text/javascript">
    $("#hide").on("click", function(e){
        e.preventDefault();
        if ($(this).text() == "Hitung berdasarkan volume") {
            $(this).text("Hitung berdasarkan kg")
            $(".kg").hide()
            $(".volume").show("slow")
            $("#berat_kg").val("")
        }else{
            $(this).text("Hitung berdasarkan volume")
            $(".volume").hide()
            $(".kg").show("slow")
            $("#berat_volume").val("")
            $("#panjang").val("")
            $("#lebar").val("")
            $("#tinggi").val("")
        }
    });

    $("#tujuan").select2({
        placeholder: 'Tujuan kecamatan',
        ajax: {
          url: '/json/kecamatan',
          dataType: 'json',
          delay: 250,
          processResults: function (data) {
              return {
                results:  $.map(data, function (item) {
                  return {
                    text: item.nama,
                    id: item.id
                }
              })
          };
        },
        cache: true
        },
        });

        var panjang = 0;
        var lebar = 0;
        var tinggi = 0;

        $("#berat_volume").value = 1100;

        $("#panjang").on('input', function(){
            panjang = this.value;
            $("#berat_volume").val(Math.round((panjang * lebar * tinggi) / 4000)); 
        });

        $("#lebar").on('input', function(){
            lebar = this.value;
            $("#berat_volume").val(Math.round((panjang * lebar * tinggi) / 4000)); 
        });

        $("#tinggi").on('input', function(){
            tinggi = this.value;
            $("#berat_volume").val(Math.round((panjang * lebar * tinggi) / 4000)); 
        });

    </script>
</body>
</html>