<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar user panel (optional) -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ asset('user.png') }} " class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>{{ \Auth::user()->name  }}</p>
                <p>{{ \Auth::user()->role  }}</p>
                <!-- Status -->
            </div>
        </div>
        <!-- Sidebar Menu -->
        <ul class="sidebar-menu tree" data-widget="tree">
            <li class="header">MAIN MENU</li>
            <!-- Optionally, you can add icons to the links -->
            <li class="{{ Request::is('home') ? 'active' : '' }}">
                <a href="{{ url('/home') }}">
                    <i class="fa fa-tachometer"></i>
                    <span>Dashboard</span></a>
            </li>

            @can('roleadmin')
            <li class="{{ Request::is('home') ? 'active' : '' }}">
                <a href="#">
                    <i class="fa fa-tachometer"></i>
                    <span>User</span></a>
            </li>
            @endcan

            <li class="treeview {{ Request::is('alatukurs*') ? 'active' : '' }}" style="height: auto;">
                <a href="#">
                    <i class="fa fa-wrench"></i>
                        <span>Alat Ukur</span>
                        <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                        </span>
                </a>
                    <ul class="treeview-menu" style="display: {{ Request::is('alatukurs*') ? 'block' : '' }};">
                        <li class="{{ Request::is('alatukurs') ? 'active' : '' }}">
                            <a href="/alatukurs"><i class="fa fa-wrench"></i> Data Alat Ukur</a>
                        </li>
                        <li class="{{ Request::is('alatukursr') ? 'active' : '' }}">
                            <a href="/alatukursr"><i class="fa fa-ban"></i> Alat Ukur Rusak</a>
                        </li>
                    </ul>
            </li>
            
            {{-- <li class=""><a href="/alatukurs"><i class="fa fa-wrench"></i> <span>Alat Ukur</span></a></li>
            <li class=""><a href="/alatukursr"><i class="fa fa-ban"></i> <span>Alat Ukur Rusak</span></a></li> --}}
            <li class="{{ Request::is('pics*') ? 'active' : '' }}">
                <a href="/pics">
                    <i class="fa fa-users"></i>
                    <span>PIC Alat</span></a>
            </li>

            <li class="{{ Request::is('pinjams*') ? 'active' : '' }}">
                <a href="/pinjams">
                    <i class="fa fa-list-alt"></i>
                    <span>Peminjaman</span></a>
            </li>

            <li class="{{ Request::is('lokasi_alatukurs*') ? 'active' : '' }}">
                <a href="/lokasi_alatukurs">
                    <i class="fa fa-location-arrow"></i>
                    <span>Lokasi Alat Ukur</span></a>
            </li>
            
            <li class="{{ Request::is('tempat_kalibrasis*') ? 'active' : '' }}">
                <a href="/tempat_kalibrasis">
                    <i class="fa fa-map-pin"></i>
                    <span>Tempat Kalibrasi</span></a>
            </li>

            <li class="{{ Request::is('kalibrasis*') ? 'active' : '' }}">
                <a href="/kalibrasis">
                    <i class="fa fa-link"></i>
                    <span>Riwayat Kalibrasi</span></a>
            </li>

            <!-- <li class="active"><a href="{{ route('makers.index') }}"><i class="fa fa-link"></i> <span>Maker</span></a></li> -->
            <!-- <li class="active"><a href="{{ route('departemens.index') }}"><i class="fa fa-link"></i> <span>Departemen</span></a></li> -->
        </ul>
        <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>
