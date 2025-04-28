<body class="sb-nav-fixed font-afacad">
    <nav class="sb-topnav navbar navbar-expand">
        <!-- Navbar Brand-->
        <img style="width: 80px;" class="navbar-logo ps-3" src="{{ asset('assets/logo-bispin.png') }}" alt="Logo Bispin">
        <!-- Sidebar Toggle-->
        <button class="button-sidebar btn" id="sidebarToggle" href="#!">
            <i class="fas fa-bars"></i>
        </button>
        <!-- Navbar-->
        <ul class="navbar-nav ms-auto">
            <li class="nav-item dropdown">
                <!-- Display User's Name -->
                <a class="dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    {{ Auth::user()->name }}
                </a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="{{ route('admin.profile.edit') }}">Edit Profile</a></li>
                    <li>
                        <hr class="dropdown-divider" />
                    </li>
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="dropdown-item">Logout</button>
                        </form>
                    </li>
                </ul>
            </li>
        </ul>
    </nav>
</body>