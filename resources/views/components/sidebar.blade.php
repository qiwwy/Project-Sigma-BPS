<div id="sidebar">
    <div class="sidebar-wrapper active">
        <div class="sidebar-header position-relative">
            <div class="d-flex justify-content-between align-items-center">
                <div class="logo d-flex align-items-center">
                    <a href="index.html" style="display: flex; align-items: center; text-decoration: none;">
                        <img src="{{ asset('assetsLandingPage/images/logo bps.png') }}" alt="Logo BPS"
                            style="width: 40px; height: auto; max-width: 100%; margin-right: 10px;">
                        <span style="font-size: 0.4em;">BPS Kota Pekalongan</span>
                    </a>
                </div>

                <div class="theme-toggle d-flex gap-2 align-items-center mt-2">
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                        aria-hidden="true" role="img" class="iconify iconify--system-uicons" width="20"
                        height="20" preserveAspectRatio="xMidYMid meet" viewBox="0 0 21 21">
                        <g fill="none" fill-rule="evenodd" stroke="currentColor" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path
                                d="M10.5 14.5c2.219 0 4-1.763 4-3.982a4.003 4.003 0 0 0-4-4.018c-2.219 0-4 1.781-4 4c0 2.219 1.781 4 4 4zM4.136 4.136L5.55 5.55m9.9 9.9l1.414 1.414M1.5 10.5h2m14 0h2M4.135 16.863L5.55 15.45m9.899-9.9l1.414-1.415M10.5 19.5v-2m0-14v-2"
                                opacity=".3"></path>
                            <g transform="translate(-210 -1)">
                                <path d="M220.5 2.5v2m6.5.5l-1.5 1.5"></path>
                                <circle cx="220.5" cy="11.5" r="4"></circle>
                                <path d="m214 5l1.5 1.5m5 14v-2m6.5-.5l-1.5-1.5M214 18l1.5-1.5m-4-5h2m14 0h2"></path>
                            </g>
                        </g>
                    </svg>
                    <div class="form-check form-switch fs-6">
                        <input class="form-check-input me-0" type="checkbox" id="toggle-dark" style="cursor: pointer">
                        <label class="form-check-label"></label>
                    </div>
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                        aria-hidden="true" role="img" class="iconify iconify--mdi" width="20" height="20"
                        preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24">
                        <path fill="currentColor"
                            d="m17.75 4.09l-2.53 1.94l.91 3.06l-2.63-1.81l-2.63 1.81l.91-3.06l-2.53-1.94L12.44 4l1.06-3m3.5 6.91l-1.64 1.25l.59 1.98l-1.7-1.17l-1.7 1.17l.59-1.98L15.75 11l2.06-.05L18.5 9l.69 1.95l2.06.05m-2.28 4.95c.83-.08 1.72 1.1 1.19 1.85c-.32.45-.66.87-1.08 1.27C15.17 23 8.84 23 4.94 19.07c-3.91-3.9-3.91-10.24 0-14.14c.4-.4.82-.76 1.27-1.08c.75-.53 1.93.36 1.85 1.19c-.27 2.86.69 5.83 2.89 8.02a9.96 9.96 0 0 0 8.02 2.89m-1.64 2.02a12.08 12.08 0 0 1-7.8-3.47c-2.17-2.19-3.33-5-3.49-7.82c-2.81 3.14-2.7 7.96.31 10.98c3.02 3.01 7.84 3.12 10.98.31Z">
                        </path>
                    </svg>
                </div>
                <div class="sidebar-toggler x">
                    <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                </div>
            </div>

        </div>
        <div class="sidebar-menu">
            <ul class="menu">
                <li class="sidebar-title">Menu</li>

                <li class="{{ request()->is('dashboard') ? 'sidebar-item active' : 'sidebar-item' }}">
                    <a href="{{ route('dashboard') }}" class='sidebar-link'>
                        <i class="bi bi-grid-fill"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                @if (session('intern')->role === 'admin')
                    <li class="sidebar-item has-sub {{ request()->is('master*') ? 'active' : '' }}">
                        <a href="#" class='sidebar-link'>
                            <i class="bi bi-collection-fill"></i>
                            <span>Master</span>
                        </a>

                        <ul class="submenu ">
                            <li class="submenu-item {{ request()->is('master/interns') ? 'active' : '' }}">
                                <a href="{{ route('interns.index') }}" class="submenu-link"><span>Peserta
                                        Magang</span></a>
                            </li>
                            <li class="submenu-item {{ request()->is('master/divisions') ? 'active' : '' }}">
                                <a href="{{ route('divisions.index') }}" class="submenu-link"><span>Divisi</span></a>
                            </li>
                            <li class="submenu-item {{ request()->is('master/schools') ? 'active' : '' }}">
                                <a href="{{ route('schools.index') }}" class="submenu-link"><span>Sekolah</span></a>
                            </li>
                        </ul>
                    </li>


                    <li class="sidebar-item has-sub {{ request()->is('registration*') ? 'active' : '' }}">
                        <a href="#" class='sidebar-link'>
                            <i class="bi bi-clipboard2-check-fill"></i>
                            <span>Registration</span>
                        </a>

                        <ul class="submenu ">
                            <li class="submenu-item {{ request()->is('registration/list') ? 'active' : '' }}">
                                <a href="{{ route('internRegister.index') }}" class="submenu-link"><span>Daftar
                                        Registrasi</span></a>
                            </li>
                            <li class="submenu-item {{ request()->is('registration/queue') ? 'active' : '' }}">
                                <a href="{{ route('internQueue.index') }}" class="submenu-link"><span>Daftar
                                        Antrian Registrasi</span></a>
                            </li>
                        </ul>
                    </li>

                    <li class="sidebar-item has-sub {{ request()->is('monitoring*') ? 'active' : '' }}">
                        <a href="#" class='sidebar-link'>
                            <i class="bi bi-person-workspace"></i>
                            <span>Monitoring</span>
                        </a>

                        <ul class="submenu ">
                            <li class="submenu-item {{ request()->is('monitoring/disposition') ? 'active' : '' }}">
                                <a href="{{ route('monitoring.disposition.index') }}"
                                    class="submenu-link"><span>Disposisi
                                        Unit</span></a>
                            </li>
                            <li class="submenu-item {{ request()->is('monitoring/information') ? 'active' : '' }}">
                                <a href="{{ route('monitoring.information.index') }}"
                                    class="submenu-link"><span>Assignment
                                        or Information</span></a>
                            </li>
                            <li class="submenu-item {{ request()->is('monitoring/group-logbook') ? 'active' : '' }}">
                                <a href="{{ route('monitoring.logbookIntern.getLogbookByIntern') }}"
                                    class="submenu-link"><span>Logbook
                                        Peserta</span></a>
                            </li>
                            <li class="submenu-item {{ request()->is('monitoring/group-presence') ? 'active' : '' }}">
                                <a href="{{ route('monitoring.presence.getPresence') }}"
                                    class="submenu-link"><span>Presensi Peserta</span></a>
                            </li>
                            <li
                                class="submenu-item {{ request()->is('monitoring/certificate-intern') ? 'active' : '' }}">
                                <a href="{{ route('monitoring.certificateIntern') }}"
                                    class="submenu-link"><span>Penilaian</span></a>
                            </li>
                        </ul>
                    </li>

                    <li class="sidebar-item has-sub {{ request()->is('cetak*') ? 'active' : '' }}">
                        <a href="#" class='sidebar-link'>
                            <i class="bi bi-collection-fill"></i>
                            <span>Cetak Laporan</span>
                        </a>

                        <ul class="submenu ">
                            <li class="submenu-item {{ request()->is('cetak/presences') ? 'active' : '' }}">
                                <a href="{{ route('cetak.presence') }}"
                                    class="submenu-link"><span>Presensi</span></a>
                            </li>
                            <li class="submenu-item {{ request()->is('cetak/logbooks') ? 'active' : '' }}">
                                <a href="{{ route('cetak.logbook') }}" class="submenu-link"><span>Logbook</span></a>
                            </li>
                        </ul>
                    </li>
                @elseif (session('intern')->role === 'intern')
                    <li class="sidebar-item has-sub {{ request()->is('activity*') ? 'active' : '' }}">
                        <a href="#" class='sidebar-link'>
                            <i class="bi bi-book-fill"></i>
                            <span>Aktivitas</span>
                        </a>
                        <ul class="submenu ">
                            <li class="submenu-item {{ request()->is('activity/presences') ? 'active' : '' }}">
                                <a href="{{ route('activity.presence.index') }}" class="submenu-link"><span>Daftar
                                        Kehadiran Anda</span></a>
                            </li>
                            <li class="submenu-item {{ request()->is('activity/logbooks') ? 'active' : '' }}">
                                <a href="{{ route('activity.logbook') }}" class="submenu-link"><span>Logbook
                                        Harian Anda</span></a>
                            </li>
                        </ul>
                    </li>

                    <li class="sidebar-item has-sub {{ request()->is('monitoring*') ? 'active' : '' }}">
                        <a href="#" class='sidebar-link'>
                            <i class="bi bi-person-workspace"></i>
                            <span>Tugas & Informasi</span>
                        </a>
                        <ul class="submenu ">
                            <li class="submenu-item {{ request()->is('monitoring/information') ? 'active' : '' }}">
                                <a href="{{ route('monitoring.information.index') }}"
                                    class="submenu-link"><span>Tugas & Informasi Anda</span></a>
                            </li>
                            <li class="submenu-item {{ request()->is('monitoring/submission') ? 'active' : '' }}">
                                <a href="{{ route('monitoring.submission.index') }}" class="submenu-link"><span>Tugas
                                        Dikumpulkan</span></a>
                            </li>
                        </ul>
                    </li>
                @else
                    <li
                        class="{{ request()->is('mentor/intern-by-division') ? 'sidebar-item active' : 'sidebar-item' }}">
                        <a href="{{ route('mentor.internByDivision') }}" class='sidebar-link'>
                            <i class="bi bi-person-circle"></i>
                            <span>Peserta Bimbingan</span>
                        </a>
                    </li>
                    <li
                        class="{{ request()->is('mentor/presence-by-division') ? 'sidebar-item active' : 'sidebar-item' }}">
                        <a href="{{ route('mentor.presenceByDivision') }}" class='sidebar-link'>
                            <i class="bi bi-clipboard2-check-fill"></i>
                            <span>Daftar Kehadiran</span>
                        </a>
                    </li>
                    <li
                        class="{{ request()->is('monitoring/information') ? 'sidebar-item active' : 'sidebar-item' }}">
                        <a href="{{ route('monitoring.information.index') }}" class='sidebar-link'>
                            <i class="bi bi-envelope-open-fill"></i>
                            <span>Assignment
                                or Information</span>
                        </a>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</div>
