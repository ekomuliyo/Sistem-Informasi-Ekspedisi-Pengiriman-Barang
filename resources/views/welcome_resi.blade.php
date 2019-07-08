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
                    <a href="{{ url('/') }}" class="scrollto">
                        <img src="{{ asset('images/logo.jpeg') }}" alt="PT Bunga Lintas Cargo" height="60px" width="100px">
                    </a>
                </h1>
                <!-- Uncomment below if you prefer to use an image logo -->
                <!-- <a href="#body"><img src="img/logo.png" alt="" title="" /></a>-->
            </div>

            <nav id="nav-menu-container">
                <ul class="nav-menu">
                    <li><a href="{{ url('/') }}">Beranda</a></li>
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


    <main id="main">

        <section id="services">
            <div class="container">
                <div class="section-header" style="padding-top:60px">
                    <h2>CEK RESI</h2>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>No Resi</th>
                                    <th>Tanggal Dikirim</th>
                                    <th>Asal</th>
                                    <th>Tujuan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($pengiriman->isNotEmpty())
                                <tr>
                                    <td>{{ $pengiriman[0]->no_resi }}</td>
                                    <td>{{ $pengiriman[0]->status_pengiriman[0]->created_at }}</td>
                                    <td>{{ $pengiriman[0]->kecamatan_pengirim->kota->nama }}</td>
                                    <td>{{ $pengiriman[0]->kecamatan_penerima->kota->nama }}</td>
                                </tr>
                                @endif
                            </tbody>
                        </table>

                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Pengirim</th>
                                    <th>Penerima</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($pengiriman->isNotEmpty())
                                <tr>
                                    <td>{{ $pengiriman[0]->nama_pengirim }}</td>
                                    <td>{{ $pengiriman[0]->alamat_pengirim }}</td>
                                </tr>
                                <tr>
                                    <td>{{ $pengiriman[0]->nama_penerima }}</td>
                                    <td>{{ $pengiriman[0]->alamat_penerima }}</td>
                                </tr>
                                @endif
                            </tbody>
                        </table>

                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th colspan="2">Status Pengiriman</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($pengiriman->isNotEmpty())
                                @foreach($pengiriman[0]->status_pengiriman[0]->detail_status_pengiriman as $data)
                                <tr>
                                    <td>{{ $data->created_at }}</td>
                                    <td>{{ $data->keterangan }}</td>
                                </tr>
                                @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </section>

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
                Created by <a href="https://bootstrapmade.com/">Eko Muliyo & Ainun Hilaliyyah</a>
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

    <!-- Template Main Javascript File -->
    <script src="{{ asset('js/main.js') }}"></script>
    
    <!-- library sweet alert -->
    @include('sweetalert::alert')
</body>
</html>