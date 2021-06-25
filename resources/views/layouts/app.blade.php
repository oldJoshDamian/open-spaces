<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="theme-color" content="#10b981">
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="apple-mobile-web-app-title" content="Open Spaces" />
    <meta name="apple-mobile-web-app-status-bar-style" content="#10b981" />

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200;0,300;0,400;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,600;1,700;1,800&display=swap" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <link rel="manifest" href="{{ asset('manifest.json') }}">
    <link rel="icon" href="{{ asset('icon/logo.png') }}" type="image/x-icon">
    <link rel="apple--icon" href="{{ asset('icon/logo_180.png') }}">

    @livewireStyles

    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}" defer></script>
    <script src="{{ asset('js/pdf.js') }}" defer></script>
    <script src="{{ asset('js/pdf.worker.min.js') }}" defer></script>
    {{--  @env('local')
    <script src="https://cdn.jsdelivr.net/npm/eruda"></script>
    <script>
        eruda.init();
    </script>
    @endenv --}}
</head>

<body class="font-sans antialiased">
    <x-jet-banner />

    <div class="min-h-screen bg-gray-300 bg-opacity-75">
        @livewire('navigation-menu')

        <!-- Page Heading -->
        @if (isset($header))
        <header class="bg-white sticky top-16 shadow">
            <div class="px-4 py-5 mx-auto max-w-7xl sm:px-6 lg:px-8">
                {{ $header }}
            </div>
        </header>
        @endif

        <!-- Page Content -->
        <main>
            {{ $slot }}
            <script type="module" src="https://cdn.jsdelivr.net/npm/@pwabuilder/pwaupdate"></script>
            <div class="relative z-50 flex justify-center">
                <pwa-update swpath="/service-worker.js"></pwa-update>
            </div>
        </main>
    </div>

    @stack('modals')

    @livewireScripts

    <script>
        // Check that service workers are supported
        if ('serviceWorker' in navigator) {
            window.addEventListener('load', function() {
                navigator.serviceWorker.register('/service-worker.js').then(console.log('service worker registered'));
            })
        }
    </script>
</body>
</html>