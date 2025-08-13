@extends ('layouts.head')

@section('body-class', 'bg-light')

@section('main')
<style>
    /* pastikan tinggi penuh */
    html, body { height: 100%; }

    .sidebar {
        width: 220px;
        height: 100vh;                 /* sidebar full tinggi */
        position: fixed;
        top: 0;
        left: 0;
        z-index: 1030;
        background-color: #fff;
        border-right: 1px solid #ddd;
        transition: transform .3s ease; /* pakai transform, lebih halus */
        will-change: transform;
    }
    .sidebar.collapsed {
        transform: translateX(-220px);  /* geser keluar layar */
    }

    .main-content {
        /* ruang untuk sidebar */
        margin-left: 220px;

        /* kolom fleksibel */
        min-height: 100vh;
        display: flex;
        flex-direction: column;

        transition: margin-left .3s ease;
    }
    .main-content.full {
        margin-left: 0;
    }

    /* footer horizontal full width */
    .site-footer {
        position: relative;
        width: 100%;
    }

    /* cegah gaya “footer vertikal kanan” dari template lain */
    footer, .copyright {
        writing-mode: horizontal-tb !important;
        transform: none !important;
        right: auto !important;
        bottom: auto !important;
        position: relative !important;
    }

    @media (max-width: 768px) {
        .main-content { margin-left: 0; } /* konten full saat mobile */
    }
</style>

<!-- HAPUS wrapper d-flex luar: tidak perlu karena sidebar fixed -->
<!-- Sidebar -->
<nav id="sidebar" class="sidebar shadow-sm">
    <div class="p-4">
        <h5 class="fw-bold text-danger">Menu</h5>
        <ul class="nav flex-column mt-3">
            <li class="nav-item mb-2">
                <a href="{{ route('nonpots.index') }}" class="nav-link text-dark">
                    <i class="fas fa-calculator me-2"></i> Non-Pots
                </a>
            </li>
            <li class="nav-item mb-2">
                <a href="{{ route('pots.index') }}" class="nav-link text-dark">
                    <i class="fas fa-calculator me-2"></i> Pots
                </a>
            </li>

            @auth
                <li class="nav-item mb-2">
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button class="btn btn-link nav-link text-dark p-0" type="submit">
                            <i class="fas fa-sign-out-alt me-2"></i> Logout
                        </button>
                    </form>
                </li>
            @else
                <li class="nav-item mb-2">
                    <a href="{{ route('login') }}" class="nav-link text-dark">
                        <i class="fas fa-sign-in-alt me-2"></i> Login
                    </a>
                </li>
                <li class="nav-item mb-2">
                    <a href="{{ route('register') }}" class="nav-link text-dark">
                        <i class="fas fa-user-plus me-2"></i> Register
                    </a>
                </li>
            @endauth
        </ul>
    </div>
</nav>

<!-- Konten Utama -->
<div id="mainContent" class="main-content w-100">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-telkom border-bottom shadow-sm mb-3">
        <div class="container">
            <!-- Tombol toggle sidebar -->
            <button class="btn btn-outline-light me-3" id="toggleSidebar">
                <i class="fas fa-bars"></i>
            </button>

            <a class="text-white navbar-brand fw-bold" href="{{ route('nonpots.index') }}">
                <i class="fas fa-calculator me-1"></i> Kalkulator Paket
            </a>

            <div class="d-flex">
                @auth
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-outline-light rounded-pill">
                            <i class="fas fa-sign-out-alt me-1"></i> Logout
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="btn btn-outline-light rounded-pill">
                        <i class="fas fa-sign-in-alt me-1"></i> Login
                    </a>
                @endauth
            </div>
        </div>
    </nav>

    <!-- Konten -->
    <main class="py-4 px-3 flex-grow-1">
        @yield('content')
    </main>

    <!-- Footer horizontal (mt-auto dorong ke bawah) -->
    <footer class="site-footer bg-dark text-white text-center py-3 mt-auto">
        <div class="container">
            <p class="mb-0">&copy; {{ date('Y') }} Kalkulator Non-pots. All rights reserved.</p>
        </div>
    </footer>
</div>

<!-- Script toggle -->
<script>
    const toggleBtn = document.getElementById('toggleSidebar');
    const sidebar = document.getElementById('sidebar');
    const mainContent = document.getElementById('mainContent');

    toggleBtn.addEventListener('click', () => {
        sidebar.classList.toggle('collapsed');
        mainContent.classList.toggle('full');
    });
</script>
@endsection
