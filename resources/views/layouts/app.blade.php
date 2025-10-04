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
        <link rel="manifest" href="{{ asset('build/manifest.webmanifest') }}">>
        
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
        <link rel="apple-touch-icon" sizes="57x57" href="/images/icons/icon-72x72.png">
        <link rel="apple-touch-icon" sizes="60x60" href="/images/icons/icon-72x72.png">
        <link rel="apple-touch-icon" sizes="72x72" href="/images/icons/icon-72x72.png">
        <link rel="apple-touch-icon" sizes="76x76" href="/images/icons/icon-96x96.png">
        <link rel="apple-touch-icon" sizes="114x114" href="/images/icons/icon-128x128.png">
        <link rel="apple-touch-icon" sizes="120x120" href="/images/icons/icon-128x128.png">
        <link rel="apple-touch-icon" sizes="144x144" href="/images/icons/icon-144x144.png">
        <link rel="apple-touch-icon" sizes="152x152" href="/images/icons/icon-152x152.png">
        <link rel="apple-touch-icon" sizes="180x180" href="/images/icons/icon-180x180.png">
        
        <!-- Apple Startup Images -->
        <link rel="apple-touch-startup-image" href="/images/icons/icon-512x512.png">
        
        <!-- Firefox/Mozilla Specific -->
        <meta name="msapplication-TileColor" content="#6366f1">
        <meta name="msapplication-config" content="/browserconfig.xml">
        
        <!-- Additional PWA Meta Tags for better compatibility -->
        <meta name="format-detection" content="telephone=no">
        <meta name="msapplication-tap-highlight" content="no">
        <meta name="mobile-web-app-capable" content="yes">
        
        <!-- Favicon -->
        <link rel="icon" type="image/png" sizes="32x32" href="/images/icons/icon-72x72.png">
        <link rel="icon" type="image/png" sizes="16x16" href="/images/icons/icon-72x72.png">
        <link rel="shortcut icon" href="/favicon.ico">>
        

    </head>
    <body class="font-sans antialiased">
        <!-- PWA Install Button -->
        <button id="installPWA" class="fixed top-4 right-4 bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg shadow-lg transition-all duration-300 z-50 hidden" style="display: none;">
            <svg class="w-5 h-5 inline-block mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
            </svg>
            Install App
        </button>

        <div class="min-h-screen bg-gray-100">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @hasSection('header')
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        @yield('header')
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
                @yield('content')
            </main>
        </div>
    </body>
</html>
