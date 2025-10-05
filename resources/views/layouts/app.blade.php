<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
        <!-- PWA Meta Tags -->
        <link rel="manifest" href="{{ asset('manifest.webmanifest') }}">
        <link rel="manifest" href="{{ asset('build/manifest.webmanifest') }}">
        
        <!-- Standard PWA Meta Tags -->
        <meta name="mobile-web-app-capable" content="yes">
        <meta name="theme-color" content="#6366f1">
        <meta name="application-name" content="UniPulse">
        
        <!-- Apple/Safari Specific Meta Tags -->
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-title" content="UniPulse">
        <meta name="apple-mobile-web-app-status-bar-style" content="default">
        <meta name="apple-touch-fullscreen" content="yes">
        
        <!-- Apple Touch Icons (Safari) -->
        <link rel="apple-touch-icon" sizes="57x57" href="/image/campus_voice.png">
        <link rel="apple-touch-icon" sizes="60x60" href="/image/campus_voice.png">
        <link rel="apple-touch-icon" sizes="72x72" href="/image/campus_voice.png">
        <link rel="apple-touch-icon" sizes="76x76" href="/image/campus_voice.png">
        <link rel="apple-touch-icon" sizes="114x114" href="/image/campus_voice.png">
        <link rel="apple-touch-icon" sizes="120x120" href="/image/campus_voice.png">
        <link rel="apple-touch-icon" sizes="144x144" href="/image/campus_voice.png">
        <link rel="apple-touch-icon" sizes="152x152" href="/image/campus_voice.png">
        <link rel="apple-touch-icon" sizes="180x180" href="/image/campus_voice.png">
        
        <!-- Apple Startup Images -->
        <link rel="apple-touch-startup-image" href="/image/campus_voice.png">
        
        <!-- Firefox/Mozilla Specific -->
        <meta name="msapplication-TileColor" content="#6366f1">
        <meta name="msapplication-config" content="/browserconfig.xml">
        
        <!-- Additional PWA Meta Tags for better compatibility -->
        <meta name="format-detection" content="telephone=no">
        <meta name="msapplication-tap-highlight" content="no">
        <meta name="mobile-web-app-capable" content="yes">
        
        <!-- Favicon -->
        <link rel="icon" type="image/png" sizes="32x32" href="/image/campus_voice.png">
        <link rel="icon" type="image/png" sizes="16x16" href="/image/campus_voice.png">
        <link rel="shortcut icon" href="/favicon.ico"
        

    </head>
    <body class="font-sans antialiased transition-all duration-300">
        <!-- PWA Install Button -->
        <button id="installPWA" class="fixed top-16 right-4 btn-secondary z-50 hidden" style="display: none;">
            <svg class="w-5 h-5 inline-block mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
            </svg>
            Install App
        </button>

        <div class="min-h-screen depth-layer-1 pb-12">
            <!-- Page Heading -->
            @hasSection('header')
                <header class="frosted-card mx-4 mt-4 mb-6">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        @yield('header')
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
                @yield('content')
            </main>

            <!-- Bottom Navigation -->
            @include('components.bottom-navigation')
        </div>

        <!-- Theme Detection Script -->
        <script>
            // Automatically detect and apply system theme preference
            if (window.matchMedia && window.matchMedia('(prefers-color-scheme: light)').matches) {
                document.body.classList.add('light');
            }
            
            // Listen for theme changes
            window.matchMedia('(prefers-color-scheme: light)').addEventListener('change', e => {
                if (e.matches) {
                    document.body.classList.add('light');
                } else {
                    document.body.classList.remove('light');
                }
            });
        </script>
    </body>
</html>
