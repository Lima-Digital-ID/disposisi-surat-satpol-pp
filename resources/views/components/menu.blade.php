<nav class="pcoded-navbar">
    <div class="nav-list">
        <div class="pcoded-inner-navbar main-menu">
            {{-- master --}}
            <div class="pcoded-navigation-label">Dashboard</div>
            <ul class="pcoded-item pcoded-left-item">
                <li class="{{ Request::segment(1) == 'dashboard' ? 'active' : '' }}">
                    <a href="{{ url('dashboard') }}" class="waves-effect waves-dark">
                        <span class="pcoded-micon">
                            <i class="feather icon-home"></i>
                        </span>
                        <span class="pcoded-mtext">Dashboard</span>
                    </a>
                </li>
            </ul>
            {{-- end master --}}

            <div class="pcoded-navigation-label">Surat</div>
            <ul class="pcoded-item pcoded-left-item">
                <!-- Surat Masuk ---!>
                @if (auth()->user()->level == 'Administrator' || auth()->user()->level == 'TU')
                <li class="{{ Request::segment(1) == 'surat_masuk' ? 'active' : '' }}">
                    <a href="{{ route('surat_masuk.index') }}" class="waves-effect waves-dark">
                        <span class="pcoded-micon">
                            <i class="fa fa-download"></i>
                        </span>
                        <span class="pcoded-mtext">Surat Masuk</span>
                        {{-- <span class="pcoded-mtext">Surat Masuk &nbsp;<span class="badge badge-light">{{
                            \App\Models\SuratMasuk::where('status','0')->where('id_penerima',auth()->user()->id)->count();
                        }}</span></span> --}}
                    </a>
                </li>
                @endif
                <!-- End Surat Masuk ---!>
                <!-- Surat Keluar ---!>
                <li class="{{ Request::segment(1) == 'surat_keluar' ? 'active' : '' }}">
                    <a href="{{ route('surat_keluar.index') }}" class="waves-effect waves-dark">
                        <span class="pcoded-micon">
                            <i class="fa fa-upload"></i>
                        </span>
                        <span class="pcoded-mtext">Surat Keluar</span>
                    </a>
                </li>
                <!-- End Surat Keluar ---!>
                <!-- Arsip ---!>
                @if(auth()->user()->level == 'Administrator' || auth()->user()->level == 'TU')
                <li class="{{ Request::segment(1) == 'arsip' ? 'active' : '' }}">
                    <a href="{{ route('arsip.index') }}" class="waves-effect waves-dark">
                        <span class="pcoded-micon">
                            <i class="ti ti-archive"></i>
                        </span>
                        <span class="pcoded-mtext">Arsip</span>
                    </a>
                </li>
                @endif
                <!-- End Arsip ---!>
            </ul>

            <div class="pcoded-navigation-label">Disposisi</div>
            <ul class="pcoded-item pcoded-left-item">
                <!-- Disposisi---!>
                <li class="{{ Request::segment(1) == 'disposisi' ? 'active' : '' }}">
                    <a href="{{ route('disposisi.index') }}" class="waves-effect waves-dark">
                        <span class="pcoded-micon">
                            <i class="fa fa-envelope"></i>
                        </span>
                        <span class="pcoded-mtext">Disposisi</span>
                    </a>
                </li>
                <!-- End Disposisi---!>
            </ul>

            @if (auth()->user()->level == 'Administrator' || auth()->user()->level == 'Admin')
<div class="pcoded-navigation-label">Data Master</div>
            <ul class="pcoded-item pcoded-left-item">
                <!-- Rekap Laporan Surat ---!>
                <li class="{{ Request::segment(1) == 'laporan_surat' ? 'active' : '' }}">
                    <a href="{{ route('laporan_surat.index') }}" class="waves-effect waves-dark">
                        <span class="pcoded-micon">
                            <i class="ti-agenda"></i>
                        </span>
                        <span class="pcoded-mtext">Rekap Laporan Surat</span>
                    </a>
                </li>
                <!-- End Rekap Laporan Surat ---!>
                <!-- Jenis Surat ---!>
                <li class="{{ Request::segment(1) == 'jenis_surat' ? 'active' : '' }}">
                    <a href="{{ route('jenis_surat.index') }}" class="waves-effect waves-dark">
                        <span class="pcoded-micon">
                            <i class="ti-envelope"></i>
                        </span>
                        <span class="pcoded-mtext">Jenis Surat</span>
                    </a>
                </li>
                <!-- End Jenis Surat ---!>
                <!-- Jenis Surat ---!>
                <li class="{{ Request::segment(1) == 'lokasi-surat' ? 'active' : '' }}">
                    <a href="{{ route('lokasi-surat.index') }}" class="waves-effect waves-dark">
                        <span class="pcoded-micon">
                            <i class="ti-folder"></i>
                        </span>
                        <span class="pcoded-mtext">Lokasi Surat</span>
                    </a>
                </li>
                <!-- End Jenis Surat ---!>
                <!-- Pengirim Surat ---!>
                <li class="{{ Request::segment(1) == 'pengirim' ? 'active' : '' }}">
                    <a href="{{ route('pengirim.index') }}" class="waves-effect waves-dark">
                        <span class="pcoded-micon">
                            <i class="ti-user"></i>
                        </span>
                        <span class="pcoded-mtext">Pengirim Surat</span>
                    </a>
                </li>
                <!-- End Pengirim Surat ---!>
                <!-- Golongan ---!>
                <li class="{{ Request::segment(1) == 'golongan' ? 'active' : '' }}">
                    <a href="{{ route('golongan.index') }}" class="waves-effect waves-dark">
                        <span class="pcoded-micon">
                            <i class="fa fa-database"></i>
                        </span>
                        <span class="pcoded-mtext">Golongan</span>
                    </a>
                </li>
                <!-- End Golongan ---!>
                <!-- Jabatan ---!>
                <li class="{{ Request::segment(1) == 'jabatan' ? 'active' : '' }}">
                    <a href="{{ route('jabatan.index') }}" class="waves-effect waves-dark">
                        <span class="pcoded-micon">
                            <i class="fa fa-database"></i>
                        </span>
                        <span class="pcoded-mtext">Jabatan</span>
                    </a>
                </li>
                <!-- End Jabatan ---!>
                <!-- Unit Kerja ---!>
                {{-- <li class="{{ Request::segment(1) == 'unit_kerja' ? 'active' : '' }}">
                    <a href="{{ route('unit_kerja.index') }}" class="waves-effect waves-dark">
                        <span class="pcoded-micon">
                            <i class="fa fa-database"></i>
                        </span>
                        <span class="pcoded-mtext">Unit Kerja</span>
                    </a>
                </li> --}}
                <!-- End Unit Kerja ---!>
                <!-- User ---!>
                <li class="{{ Request::segment(1) == 'user' ? 'active' : '' }}">
                    <a href="{{ route('user.index') }}" class="waves-effect waves-dark">
                        <span class="pcoded-micon">
                            <i class="fa fa-user"></i>
                        </span>
                        <span class="pcoded-mtext">User</span>
                    </a>
                </li>
                <!-- End User ---!>
@endif
            </ul>
        </div>
    </div>
</nav>
