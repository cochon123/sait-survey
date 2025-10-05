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
        <link rel="manifest" href="{{ asset('build/manifest.webmanifest') }}">
        <meta name="mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-title" content="UniPulse">
        <meta name="theme-color" content="#6366f1">
        <meta name="apple-mobile-web-app-status-bar-style" content="default">
        <link rel="apple-touch-icon" href="/images/icons/icon-192x192.png">
        

    </head>
    <body class="font-sans antialiased depth-layer-1">
        <!-- Theme Toggle -->
        <button id="themeToggle" class="theme-toggle fixed top-4 right-4 z-50">
            <svg class="sun-icon hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
            </svg>
            <svg class="moon-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
            </svg>
        </button>

        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 px-4">
            <div class="w-full sm:max-w-md mt-6 frosted-card">
                {{ $slot }}
            </div>
        </div>

        <!-- Theme Toggle Script -->
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const themeToggle = document.getElementById('themeToggle');
                const body = document.body;
                
                // Check for saved theme preference or default to dark mode
                const savedTheme = localStorage.getItem('theme');
                if (savedTheme === 'light') {
                    body.classList.add('light');
                }
                
                if (themeToggle) {
                    themeToggle.addEventListener('click', function() {
                        body.classList.toggle('light');
                        
                        // Save theme preference
                        if (body.classList.contains('light')) {
                            localStorage.setItem('theme', 'light');
                        } else {
                            localStorage.setItem('theme', 'dark');
                        }
                    });
                }
            });
        </script>
    </body>
</html>
