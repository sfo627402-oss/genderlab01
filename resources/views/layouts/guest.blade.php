<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Authentification</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;600;700;800&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-inter antialiased hero-bg min-h-screen flex items-center justify-center p-6 sm:p-0">
        <div class="w-full sm:max-w-md">
            <div class="text-center mb-10">
                <a href="/" class="inline-flex items-center">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-48 w-auto">
                </a>
                <p class="text-white/40 text-sm mt-4 uppercase tracking-widest font-bold">Molecular Bird Sexing</p>
            </div>

            <div class="glass rounded-[2rem] p-8 sm:p-10 shadow-2xl relative overflow-hidden">
                <!-- Decorative blob -->
                <div class="absolute -top-10 -right-10 w-32 h-32 bg-bio-500/10 rounded-full blur-3xl"></div>
                
                {{ $slot }}
            </div>
            
            <p class="text-center mt-8 text-white/30 text-xs">
                © {{ date('Y') }}. Tous droits réservés.
            </p>
        </div>
    </body>
</html>
