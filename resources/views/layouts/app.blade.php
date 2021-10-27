<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="theme-color" content="#0652c5">
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="apple-mobile-web-app-title" content="Open Spaces" />
    <meta name="apple-mobile-web-app-status-bar-style" content="#0652c5" />

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200;0,300;0,400;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,600;1,700;1,800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&display=swap" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    {{-- <link rel="manifest" href="/manifest.json"> --}}
    <link rel="icon" href="/icon/open spaces - logo _ edited.png" type="image/x-icon">
    <link rel="apple--icon" href="/icon/open spaces - logo _ edited.png">

    @livewireStyles

    <!-- Scripts -->
    <script src="{{ asset('js/pdf.js') }}" defer></script>
    <script src="{{ asset('js/pdf.worker.min.js') }}" defer></script>
    <script src="{{ mix('js/app.js') }}" defer></script>
    @env('local')
    <script src="https://cdn.jsdelivr.net/npm/eruda"></script>
    <script>
        eruda.init();

    </script>
    @endenv
</head>

<body class="antialiased font-breadcrumb">
    <x-jet-banner />

    <div class="min-h-screen bg-gray-300 bg-opacity-75">
        @livewire('navigation-menu')

        <!-- Page Heading -->
        @if (isset($header))
        <header style="z-index: 5;" class="sticky bg-white shadow top-16">
            <div class="px-4 py-5 mx-auto max-w-7xl sm:px-6 lg:px-8">
                {{ $header }}
            </div>
        </header>
        @endif

        <!-- Page Content -->
        <main>
            @can('search')
            <div class="px-4 mx-auto my-4 sm:px-6 lg:px-8 max-w-7xl">
                @livewire('search.search-all')
            </div>
            <div class="py-6 border-t border-gray-300">
                {{ $slot }}
            </div>
            @endcan
            @cannot('search')
            {{ $slot }}
            @endcannot
            <script type="module" src="https://cdn.jsdelivr.net/npm/@pwabuilder/pwaupdate"></script>
            <div class="relative z-50 flex justify-center">
                <pwa-update swpath="/service-worker.js"></pwa-update>
            </div>
        </main>
    </div>

    @stack('modals')

    @livewireScripts

    {{-- <script>
        if ('serviceWorker' in navigator) {
            window.addEventListener('load', function() {
                navigator.serviceWorker.register('/service-worker.js').then(console.log('service worker registered'));
            })
        }

    </script> --}}
</body>

</html>
