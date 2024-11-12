<ul class="sidebar-menu">
    <li class="menu-header">Dashboard</li>
    <li class="nav-item dropdown {{ Request::routeIs('dashboard_admin') ? 'active' : '' }}">
        <a href="#" class="nav-link has-dropdown">
            <i class="fas fa-fire"></i>
            <span>Dashboard</span>
        </a>
        <ul class="dropdown-menu">
            <li class="{{ Request::routeIs('dashboard_admin') ? 'active' : '' }}">
                <a class="nav-link {{ Request::routeIs('dashboard_admin') ? 'active' : '' }}"
                    href="{{ route('dashboard_admin') }}">General Dashboard</a>
            </li>
        </ul>
    </li>
    @if (Auth::guard('admin')?->user()?->role_id == 2)
        <li class="menu-header">User</li>
        <li class="nav-item {{ Request::routeIs('students.*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('students.index') }}"><i class="fas fa-users"></i> <span>User
                    Mahasiswa</span></a>
        </li>
        <li class="nav-item {{ Request::routeIs('study_plan_cards.*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('study_plan_cards.index') }}"><i class="fas fa-file"></i> <span>KRS
                    Mahasiswa</span></a>
        </li>
        {{-- <li class="nav-item {{Request::routeIs('user_class_courses.*')?'active':''}}">
        <a class="nav-link" href="{{route('user_class_courses.index')}}"><i class="fas fa-file"></i> <span>Kelas Mahasiswa</span></a>
    </li> --}}
        <li class="menu-header">Kelompok Kelas</li>
        <li class="nav-item {{ Request::routeIs('class_courses.*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('class_courses.index') }}"><i class="fas fa-file"></i> <span>Kelompok
                    Kelas</span></a>
        </li>
        <li class="nav-item {{ Request::routeIs('schedule_class_courses.*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('schedule_class_courses.index') }}"><i class="fas fa-file"></i>
                <span>Jadwal Kelompok Kelas</span></a>
        </li>
        <li class="menu-header">Master Data</li>
        <li class="nav-item {{ Request::routeIs('courses.*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('courses.index') }}"><i class="fas fa-file"></i> <span>Mata
                    Kuliah</span></a>
        </li>
        <li class="nav-item {{ Request::routeIs('schedule_study_plan_cards.*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('schedule_study_plan_cards.index') }}"><i class="fas fa-file"></i>
                <span>Jadwal KRS</span></a>
        </li>
        <li class="nav-item {{ Request::routeIs('academic_years.*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('academic_years.index') }}"><i class="fas fa-file"></i> <span>Tahun
                    Akademik</span></a>
        </li>
        <li class="menu-header">Setting</li>
        <li class="nav-item {{ Request::routeIs('approve_students.*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('approve_students') }}"><i class="fas fa-users"></i> <span>Pemilihan
                    Dosen Wali</span></a>
        </li>
    @elseif(Auth::guard('admin')?->user()?->role_id == 3)
        <li class="menu-header">User</li>
        <li class="nav-item {{ Request::routeIs('students.*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('students.index') }}"><i class="fas fa-users"></i> <span>User
                    Mahasiswa</span></a>
        </li>
        <li class="nav-item {{ Request::routeIs('exam_user_sessions.*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('exam_user_sessions.index') }}"><i class="fas fa-book"></i> <span>Hasil
                    Ujian Mahasiswa</span></a>
        </li>
        <li class="nav-item {{ Request::routeIs('certificate_receives.*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('certificate_receives.index') }}"><i class="fas fa-book"></i>
                <span>Pengajuan SKD Mahasiswa</span></a>
        </li>
        <li class="nav-item {{ Request::routeIs('re_registrations.*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('re_registrations.index') }}"><i class="fas fa-book"></i> <span>Daftar
                    Ulang Mahasiswa</span></a>
        </li>
        <li class="menu-header">Ujian</li>
        <li class="nav-item {{ Request::routeIs('exam_sessions.*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('exam_sessions.index') }}"><i class="fas fa-book"></i> <span>Sesi
                    Ujian</span></a>
        </li>
        <li class="nav-item {{ Request::routeIs('exam_levels.*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('exam_levels.index') }}"><i class="fas fa-book"></i> <span>Level
                    Ujian</span></a>
        </li>
        <li class="nav-item dropdown {{ Request::routeIs('exams.*', 'exam_questions.*') ? 'active' : '' }}">
            <a href="#" class="nav-link has-dropdown">
                <i class="fas fa-book"></i>
                <span>Soal Ujian</span>
            </a>
            <ul class="dropdown-menu">
                <li class="{{ Request::routeIs('exams.*') ? 'active' : '' }}">
                    <a class="nav-link {{ Request::routeIs('exams.*') ? 'active' : '' }}"
                        href="{{ route('exams.index') }}">Daftar Ujian</a>
                </li>
            </ul>
            <ul class="dropdown-menu">
                <li class="{{ Request::routeIs('exam_questions.*') ? 'active' : '' }}">
                    <a class="nav-link {{ Request::routeIs('exam_questions.*') ? 'active' : '' }}"
                        href="{{ route('exam_questions.index') }}">Daftar Soal</a>
                </li>
            </ul>
        </li>
        <li class="menu-header">Settings</li>
        <li class="nav-item {{ Request::routeIs('information_services.*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('information_services.index') }}"><i class="fas fa-cogs"></i>
                <span>Setting Informasi</span></a>
        </li>
        <li class="nav-item {{ Request::routeIs('information_service_payments.*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('information_service_payments.index') }}"><i class="fas fa-cogs"></i>
                <span>Setting Pembayaran</span></a>
        </li>
        <li class="nav-item {{ Request::routeIs('registration_periodes.*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('registration_periodes.index') }}"><i class="fas fa-calendar"></i>
                <span>Periode Pendaftaran</span></a>
        </li>
        <li class="menu-header">Penilaian</li>
        <li class="nav-item {{ Request::routeIs('exam_scores.*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('exam_scores.index') }}"><i class="fas fa-list"></i> <span>Konversi
                    Nilai Tes</span></a>
        </li>
    @elseif(Auth::guard('lecturer')->check())
        <li class="nav-item {{ Request::routeIs('students.*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('students.index') }}"><i class="fas fa-users"></i> <span>User
                    Mahasiswa</span></a>
        </li>
    @else
        <li class="menu-header">Payments</li>
        <li class="nav-item {{ Request::routeIs('user_payments.*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('user_payments.index') }}"><i class="fas fa-credit-card"></i>
                <span>Pembayaran</span></a>
        </li>
        <li class="nav-item {{ Request::routeIs('payment_types.*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('payment_types.index') }}"><i class="fas fa-credit-card"></i>
                <span>Tipe Pembayaran</span></a>
        </li>
        <li class="menu-header">Administrator</li>
        <li class="nav-item {{ Request::routeIs('admins.*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('admins.index') }}"><i class="fas fa-file"></i>
                <span>Admin</span></a>
        </li>
        <li class="nav-item {{ Request::routeIs('roles.*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('roles.index') }}"><i class="fas fa-file"></i> <span>Role</span></a>
        </li>
        <li class="nav-item {{ Request::routeIs('faculties.*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('faculties.index') }}"><i class="fas fa-file"></i>
                <span>Fakultas</span></a>
        </li>
        <li class="nav-item {{ Request::routeIs('information_sources.*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('information_sources.index') }}"><i class="fas fa-file"></i>
                <span>Sumber Informasi</span></a>
        </li>
        <li class="nav-item {{ Request::routeIs('religions.*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('religions.index') }}"><i class="fas fa-file"></i>
                <span>Agama</span></a>
        </li>
        <li class="nav-item {{ Request::routeIs('study_programs.*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('study_programs.index') }}"><i class="fas fa-file"></i> <span>Program
                    Studi</span></a>
        </li>
        <li class="nav-item {{ Request::routeIs('file_uploads.*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('file_uploads.index') }}"><i class="fas fa-file"></i> <span>File
                    Upload</span></a>
        </li>
        <li class="nav-item {{ Request::routeIs('registration_paths.*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('registration_paths.index') }}"><i class="fas fa-file"></i>
                <span>Jalur Registrasi</span></a>
        </li>
        <li class="nav-item {{ Request::routeIs('lecturers.*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('lecturers.index') }}"><i class="fas fa-file"></i>
                <span>Dosen</span></a>
        </li>
        <li class="dropdown {{ Request::routeIs(['news.*', 'news-category.*']) ? 'active' : '' }}">
            <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fa fa-newspaper"></i>
                <span>Informasi / Berita</span></a>
            <ul class="dropdown-menu">
                <li class="nav-item {{ Request::routeIs('news-category.*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('news-category.index') }}"><i class="fa fa-newspaper"></i>
                        <span>Kategori Berita</span></a>
                </li>
                <li class="nav-item {{ Request::routeIs('news.*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('news.index') }}"><i class="fa fa-newspaper"></i>
                        <span>Informasi / Berita</span></a>
                </li>
            </ul>
        </li>
        <li class="menu-header">Pengaturan Lokasi</li>
        <li class="nav-item {{ Request::routeIs('sub_districts.*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('sub_districts.index') }}"><i class="fas fa-map-marker"></i>
                <span>Kelurahan</span></a>
        </li>
        <li class="nav-item {{ Request::routeIs('districts.*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('districts.index') }}"><i class="fas fa-map-marker"></i>
                <span>Kecamatan</span></a>
        </li>
        <li class="nav-item {{ Request::routeIs('cities.*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('cities.index') }}"><i class="fas fa-map-marker"></i>
                <span>Kota</span></a>
        </li>
        <li class="nav-item {{ Request::routeIs('provincies.*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('provincies.index') }}"><i class="fas fa-map-marker"></i>
                <span>Provinsi</span></a>
        </li>
    @endif
</ul>

<div class="mt-4 mb-4 p-3 hide-sidebar-mini">
    <a href="" class="btn btn-primary btn-lg btn-block btn-icon-split">
        <i class=""></i> UNAKI
    </a>
</div>
