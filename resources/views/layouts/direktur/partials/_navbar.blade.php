<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
    <a class="navbar-brand" href="#">PT BUNGA LINTAS CARGO</a>
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Dashboard">
            <a class="nav-link" href="#">
            <i class="fa fa-fw fa-home"></i>
            <span class="nav-link-text">Dashboard</span>
            </a>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Users">
            <a class="nav-link" href="{{ route('direktur.cabang.index') }}">
            <i class="fa fa-fw fa-user"></i>
            <span class="nav-link-text">Kelola Cabang</span>
            </a>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Users">
            <a class="nav-link" href="#">
            <i class="fa fa-fw fa-user"></i>
            <span class="nav-link-text">Ongkir</span>
            </a>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Users">
            <a class="nav-link" href="#">
            <i class="fa fa-fw fa-user"></i>
            <span class="nav-link-text">Pelanggan</span>
            </a>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Users">
            <a class="nav-link" href="#">
            <i class="fa fa-fw fa-user"></i>
            <span class="nav-link-text">Kurir</span>
            </a>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Users">
            <a class="nav-link" href="{{ route('direktur.users.index') }}">
            <i class="fa fa-fw fa-user"></i>
            <span class="nav-link-text">Users</span>
            </a>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Users">
            <a class="nav-link" href="{{ route('direktur.users.index') }}">
            <i class="fa fa-fw fa-user"></i>
            <span class="nav-link-text">Akun Saya</span>
            </a>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Posts">
            <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseMultiLaporan" data-parent="#exampleAccordion">
            <i class="fa fa-bar-chart"></i>
            <span class="nav-link-text">Laporan</span>
            </a>
            <ul class="sidenav-second-level collapse" id="collapseMultiLaporan">
            <li>
                <a href="#">Statistik Pengiriman</a>
            </li>
            <li>
                <a href="#">Statistik Penerimaan</a>
            </li>
            <li>
                <a href="#">Laporan Akhir</a>
            </li>
            </ul>
        </li>
        </ul>
        <ul class="navbar-nav sidenav-toggler">
        <li class="nav-item">
            <a class="nav-link text-center" id="sidenavToggler">
            <i class="fa fa-fw fa-angle-left"></i>
            </a>
        </li>
        </ul>
        <ul class="navbar-nav ml-auto">

        <li class="dropdown user user-menu">
            <a href="#" class="nav-link" data-toggle="dropdown">
              <img src="#" class="user-image" alt="User Image" width="25" hegiht="25">
              <span class="hidden-xs">#</span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                  <center>
                      <img src="#" class="img-circle" alt="User Image" width="25" hegiht="25">
                    </center>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="#" class="btn btn-default btn-flat">Profil</a>
                </div>
                <div class="pull-right">
                  <a href="{{ route('logout') }}" class="btn btn-default btn-flat" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Keluar</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                </div>
              </li>
            </ul>
          </li>

        <li class="nav-item">
            <form class="form-inline my-2 my-lg-0 mr-lg-2">
            <div class="input-group">
                <input class="form-control" type="text" placeholder="Search for...">
                <span class="input-group-append">
                <button class="btn btn-primary" type="button">
                    <i class="fa fa-search"></i>
                </button>
                </span>
            </div>
            </form>
        </li>
        </ul>
    </div>
</nav>