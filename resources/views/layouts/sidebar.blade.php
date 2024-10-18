<aside class="sidebar-left border-right bg-white shadow" id="leftSidebar" data-simplebar>
    <a href="#" class="btn collapseSidebar toggle-btn d-lg-none text-muted ml-2 mt-3" data-toggle="toggle">
        <i class="fe fe-x"><span class="sr-only"></span></i>
    </a>
    <nav class="vertnav navbar navbar-light">
        <!-- nav bar -->
        <div class="w-full py-3 justify-center text-center">
            <a class="w-12 navbar-brand text-center" href="{{ route('dashboard') }}">
                <img src="{{ asset('images/logo-pemkot.png') }}" alt="Logo" class="avatar-img">
            </a>
        </div>
        <ul class="navbar-nav flex-fill w-100 mb-2">
            <li class="nav-item w-100">
                <a class="nav-link" href="{{ route('dashboard') }}">
                    <i class="fe fe-home fe-16"></i>
                    <span class="ml-3 item-text">Home</span>
                </a>
            </li>
        </ul>

        <ul class="navbar-nav flex-fill w-100 mb-2">
            <li class="nav-item w-100">
                <a class="nav-link" href="{{ route('buku') }}">
                    <i class="fe fe-book fe-16"></i>
                    <span class="ml-3 item-text">Manajemen Buku</span>
                </a>
            </li>
        </ul>

        <ul class="navbar-nav flex-fill w-100 mb-2">
            <li class="nav-item w-100">
                <a class="nav-link" href="{{ route('pengunjung') }}">
                    <i class="fe fe-book fe-16"></i>
                    <span class="ml-3 item-text">Pengunjung</span>
                </a>
            </li>
        </ul>

        <ul class="navbar-nav flex-fill w-100 mb-2">
            <li class="nav-item w-100">
                <a class="nav-link" href="{{ route('profile.edit') }}">
                    <i class="fe fe-user fe-16"></i>
                    <span class="ml-3 item-text">Profile</span>
                </a>
            </li>
        </ul>

        {{-- <ul class="navbar-nav flex-fill w-100 mb-2">
            <li class="nav-item active dropdown">
                <a href="#user" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link">
                    <i class="fe fe-user fe-16"></i>
                    <span class="ml-3 item-text">Users</span>
                </a>
                <ul class="collapse list-unstyled pl-4 w-100" id="user">
                    <li class="nav-item">
                        <a class="nav-link pl-3" href="{{ route('profile.edit') }}"><span class="ml-1 item-text">Profil
            User</span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link pl-3" href="{{ route('dashboard') }}"><span class="ml-1 item-text">Tambah
                    User</span></a>
        </li>
        </ul>
        </li>
        </ul> --}}
        <ul class="navbar-nav flex-fill w-100 mb-2">
            <li class="nav-item w-100">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault();
                this.closest('form').submit();">
                        <i class="fe fe-log-out fe-16"></i>
                        <span class="ml-3 item-text">Logout</span> <!-- Tambahkan kelas d-none di sini -->
                    </a>
                </form>
            </li>
        </ul>
    </nav>
</aside>