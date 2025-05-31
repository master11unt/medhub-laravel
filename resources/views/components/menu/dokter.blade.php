<aside>
    <div class="sidebar-brand">
        <a href="">MedHub</a>
    </div>
    <div class="sidebar-brand sidebar-brand-sm">
        <a href="">MH</a>
    </div>
    <ul class="sidebar-menu">
        <li class="menu-header">Dashboard Dokter</li>
        <li class="nav-item dropdown">
            <a href="" class="nav-link has-dropdown"><i class="fas fa-user"></i><span>Dokter</span></a>
            <ul class="dropdown-menu">
                <li class="">
                    <a href="{{ route('dokter.schedules.index') }}" class="nav-link">Jadwal Praktek</a>
                </li>
                <li class="">
                    <a class="nav-link" href="{{ route('dokter.shortProfile') }}">Profil Singkat Dokter</a>
                </li>
            </ul>
        </li>
        <li class="nav-item dropdown">
            <a href="" class="nav-link has-dropdown"><i class="fas fa-file"></i><span>Konsultasi</span></a>
            <ul class="dropdown-menu">
                <li class="">
                    <a href="{{ route('dokter.consultations') }}" class="nav-link">Daftar Chat Konsultasi</a>
                </li>
                <li class="">
                    <a href="{{ route('index.consultations') }}" class="nav-link">Data Konsultasi</a>
                </li>
                <li class="">
                    <a href="{{ route('index.prescriptions') }}" class="nav-link">Data Resep</a>
                </li>
                <li class="">
                    <a href="{{ route('index.health_records') }}" class="nav-link">Rekam Medis</a>
                </li>
            </ul>
        </li>
        <li class="nav-item dropdown">
            <a href="" class="nav-link has-dropdown"><i class="fas fa-newspaper"></i><span>Pasien</span></a>
            <ul class="dropdown-menu">
                <li class="">
                    <a href="{{ route('index.education-categories') }}" class="nav-link">Data Kategori</a>
                </li>
                <li class="">
                    <a href="{{ route('index.educations') }}" class="nav-link">Data Edukasi</a>
                </li>
            </ul>
        </li>
    </ul>
</aside>