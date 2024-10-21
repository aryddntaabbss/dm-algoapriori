<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Sistem Rekomendasi Buku Perpustakaan Daerah Kota Ternate') }}</title>

        <!-- Tambahkan Favicon -->
        <link rel="icon" href="{{ asset('images/logo-pemkot.png') }}" type="image/x-icon">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>

    <body class="font-sans text-gray-900 antialiased">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 relative">
            <!-- Background Image -->
            <div class="absolute inset-0 bg-cover bg-center"
                style="background-image: url('{{ asset('images/soya-soya.jpg') }}');">
            </div>

            <!-- Overlay with transparency -->
            <div class="absolute inset-0 bg-black opacity-50"></div>

            <!-- Content -->
            <div class="relative z-10">
                <a href="/">
                    <img src="{{ asset('images/logo-pemkot.png') }}" alt="Logo" class="w-20 fill-current">
                </a>
            </div>

            <div
                class="relative z-10 w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
                {{ $slot }}
            </div>
        </div>
    </body>

</html>