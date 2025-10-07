<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Student Propositions - SAIT Survey</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    <!-- Styles / Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- PWA Manifest -->
    <link rel="manifest" href="{{ asset('build/manifest.webmanifest') }}">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <style>
      /* Appliquer un flou sur tout le contenu sauf les modals lorsque le body a la classe 'modal-open' */
      body.modal-open > :not(#auth-modal):not(#one-day-modal) {
        filter: blur(5px);
      }
    </style>
</head>
