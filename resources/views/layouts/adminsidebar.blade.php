<aside class="sidebar-left border-right bg-white shadow" id="leftSidebar" data-simplebar>
    <a href="#" class="btn collapseSidebar toggle-btn d-lg-none text-muted ml-2 mt-3" data-toggle="toggle">
        <i class="fe fe-x"><span class="sr-only"></span></i>
    </a>
    <nav class="vertnav navbar navbar-light">
        <div class="d-flex align-items-center justify-content-center p-2 mb-4 border-bottom">
            <a class="d-flex align-items-center text-decoration-none text-dark fw-semibold"
                href="{{ route('admin.dashboard') }}">
                <img src="{{ asset('images/logo-pemkot.png') }}" alt="Logo" class="me-2"
                    style="width: 30px; height: auto;">
                <span class="font-bold">Dinas Perpustakaan Daerah Kota Ternate</span>
            </a>
        </div>

        <!-- Home Link -->
        <ul class="navbar-nav flex-fill w-100 mb-2">
            <li class="nav-item w-100">
                <a class="nav-link {{ Request::is('admin.dashboard*') ? 'actives' : '' }}"
                    href="{{ route('admin.dashboard') }}">
                    <i class="fe fe-home fe-16"></i>
                    <span class="ml-3 item-text">Beranda</span>
                </a>
            </li>
        </ul>

        <!-- Manajemen Buku Link -->
        <ul class="navbar-nav flex-fill w-100 mb-2">
            <li class="nav-item w-100">
                <a class="nav-link {{ Request::is('admin.buku*') ? 'actives' : '' }}" href="{{ route('admin.buku') }}">
                    <i class="fe fe-book fe-16"></i>
                    <span class="ml-3 item-text">Manajemen Buku</span>
                </a>
            </li>
        </ul>

        <!-- Pengunjung Link -->
        <ul class="navbar-nav flex-fill w-100 mb-2">
            <li class="nav-item w-100">
                <a class="nav-link {{ Request::is('admin.pengunjung*') ? 'actives' : '' }}"
                    href="{{ route('admin.pengunjung') }}">
                    <i class="fe fe-users fe-16"></i>
                    <span class="ml-3 item-text">Pengunjung</span>
                </a>
            </li>
        </ul>

        <!-- Rekomendasi Link -->
        <ul class="navbar-nav flex-fill w-100 mb-2">
            <li class="nav-item w-100">
                <a class="nav-link {{ Request::is('admin.rek-apriori*') ? 'actives' : '' }}"
                    href="{{ route('admin.rek-apriori') }}">
                    <i class="fe fe-list fe-16"></i>
                    <span class="ml-3 item-text">Rekomendasi</span>
                </a>
            </li>
        </ul>

        <!-- Manajemen User Link  -->
        <ul class="navbar-nav flex-fill w-100 mb-2">
            <li class="nav-item w-100">
                <a class="nav-link {{ Request::is('admin.users*') ? 'actives' : '' }}"
                    href="{{ route('admin.users.index') }}">
                    <i class="fe fe-users fe-16"></i>
                    <span class="ml-3 item-text">Manajemen User</span>
                </a>
            </li>
        </ul>

        <!-- Profile Link -->
        <ul class="navbar-nav flex-fill w-100 mb-2">
            <li class="nav-item w-100">
                <a class="nav-link {{ Request::is('admin.profile*') ? 'actives' : '' }}"
                    href="{{ route('profile.edit') }}">
                    <i class="fe fe-user fe-16"></i>
                    <span class="ml-3 item-text">Profile</span>
                </a>
            </li>
        </ul>

        <!-- Logout Link -->
        <ul class="navbar-nav flex-fill w-100 mb-2">
            <li class="nav-item w-100">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <a class="nav-link" href="javascript:void(0);"
                        onclick="event.preventDefault(); this.closest('form').submit();">
                        <i class="fe fe-log-out fe-16"></i>
                        <span class="ml-3 item-text ">Logout</span>
                    </a>
                </form>
            </li>
        </ul>
    </nav>
</aside>