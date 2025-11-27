<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    {{-- Google Fonts --}}
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Poppins:wght@400;500;600;700&display=swap">

    <title>Sistem Manajemen Telur Digital</title>

    @vite('resources/css/app.css')

    <script src="//unpkg.com/alpinejs" defer></script>
</head>

    <body class="@yield('bodyClass', 'bg-[var(--pastel-green)]')">
        @yield('content')
    </body>
</html>
