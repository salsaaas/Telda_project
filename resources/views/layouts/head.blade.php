<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kalkulator Non-Pots dan Pots</title>

    {{-- Styles & CDN --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet">

    <style>
        :root {
            --telkom-primary: #e60000;
            --telkom-dark: #cc0000;
            --telkom-light: #ff4d4d;
        }

        /* Custom styling seperti sebelumnya */
        .navbar-brand { font-size: 1.5rem; }
        .bg-telkom { background-color: var(--telkom-primary) !important; }
        .btn-telkom { background-color: var(--telkom-primary); color: white; border-color: var(--telkom-primary); }
        .btn-telkom:hover { background-color: var(--telkom-dark); color: white; }
        .text-telkom { color: var(--telkom-primary); }
    </style>
</head>

<body class="@yield('body-class')">
    @yield('main')

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    @stack('scripts')
</body>
</html>
