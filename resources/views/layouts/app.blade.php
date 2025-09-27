{{-- resources/views/layouts/app.blade.php --}}
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('SIMPERSITE', 'SIMPERSITE')</title>
    @vite('resources/css/app.css')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="//unpkg.com/alpinejs" defer></script>
</head>
<body class="bg-gray-50 font-sans">

    <div class="flex min-h-screen">
        {{-- Memanggil komponen sidebar --}}
        <x-sidebar-nav />

        <!-- Main Content Area -->
        <div class="flex-1 flex flex-col">
            {{-- Memanggil komponen header --}}
            <x-header />

            <!-- Content -->
            <main class="flex-grow p-6">
                {{-- Di sinilah konten dari halaman lain akan disisipkan --}}
                @yield('content')
            </main>
        </div>
    </div>

    {{-- Placeholder untuk script spesifik halaman --}}
    @stack('scripts')
</body>
</html>

