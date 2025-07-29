<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kalkulator Non-pots</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --navy-primary: #1e3a8a;
            --navy-dark: #1e40af;
            --navy-light: #3b82f6;
        }
        
        .table th {
            background-color: var(--navy-primary);
            color: white;
            text-align: center;
            font-size: 0.9rem;
            padding: 0.5rem;
        }
        .table td {
            vertical-align: middle;
            padding: 0.5rem;
        }
        .card, .btn, .form-control, .form-select {
            border-radius: 8px;
        }
        .table-responsive {
            border-radius: 8px;
            overflow: hidden;
        }
        .form-select, .form-control {
            font-size: 0.9rem;
        }
        .btn-sm {
            padding: 0.25rem 0.5rem;
        }
        .table-bordered td {
            border: 1px solid #dee2e6;
        }
        .navbar-brand {
            font-size: 1.5rem;
        }
        .bg-navy {
            background-color: var(--navy-primary) !important;
        }
        .btn-navy {
            background-color: var(--navy-primary);
            border-color: var(--navy-primary);
            color: white;
        }
        .btn-navy:hover {
            background-color: var(--navy-dark);
            border-color: var(--navy-dark);
            color: white;
        }
        .text-navy {
            color: var(--navy-primary) !important;
        }
        .border-navy {
            border-color: var(--navy-primary) !important;
        }
        .navbar-nav .nav-link:hover {
            background-color: rgba(255, 255, 255, 0.1);
            border-radius: 4px;
        }
    </style>
</head>
<body class="bg-light">
    <nav class="navbar navbar-expand-lg navbar-dark bg-navy">
        <div class="container">
            <a class="navbar-brand fw-bold" href="{{ route('calculator.index') }}">
                <i class="fas fa-calculator"></i> Kalkulator Non-post
            </a>
            <div class="navbar-nav ms-auto">
                <a class="nav-link" href="{{ route('calculator.index') }}">
                    <i class="fas fa-home"></i> Beranda
                </a>
            </div>
        </div>
    </nav>
    <main class="py-4">
        <div class="container">
            @yield('content')
        </div>
    </main>
    <footer class="bg-dark text-white text-center py-3 mt-5">
        <div class="container">
            <p class="mb-0">&copy; {{ date('Y') }} Kalkulator Non-post. All rights reserved.</p>
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>