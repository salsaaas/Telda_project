@extends ('layouts.head')

@section('body-class', 'bg-light')

@section('main')
<style>
    .sidebar {
        width: 220px;
        min-height: 100vh;
        position: fixed;
        top: 0;
        left: 0;
        z-index: 1030;
        background-color: white;
        border-right: 1px solid #ddd;
        transition: all 0.3s ease;
    }

    .sidebar.collapsed {
        margin-left: -220px;
    }

    .main-content {
        margin-left: 220px;
        transition: all 0.3s ease;
    }

    .main-content.full {
        margin-left: 0;
    }

    @media (max-width: 768px) {
        .sidebar {
            position: fixed;
            width: 220px;
            top: 0;
            left: 0;
            height: 100%;
        }

        .main-content {
            margin-left: 0;
        }
    }
</style>

<div class="d-flex">
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
                <a  href="{{ route('pots.index') }} " class="nav-link text-dark">
                    <i class="fas fa-calculator me-2"></i>Pots
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
        <main class="py-4 px-3">
            @yield('content')
        </main>

        <!-- Footer -->
        <footer class="bg-dark text-white text-center py-3 mt-5">
            <div class="container">
                <p class="mb-0">&copy; {{ date('Y') }} Kalkulator Non-pots. All rights reserved.</p>
            </div>
        </footer>
    </div>
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
