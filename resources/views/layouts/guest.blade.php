<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Sistem Rekomendasi Buku Perpustakaan Daerah Kota Ternate') }}</title>

        <!-- Favicon -->
        <link rel="icon" href="{{ asset('images/logo-pemkot.png') }}" type="image/x-icon">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Styles & Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>

    <body class="font-sans text-gray-900 antialiased bg-cover bg-center"
        style="background-image: url('{{ asset('images/soya-soya.jpg') }}');">
        <div class="min-h-screen flex flex-col justify-center items-center py-6 bg-gray-900 bg-opacity-50">
            <!-- Content Box -->
            <div class="w-full sm:max-w-md bg-white shadow-lg rounded-lg px-8 py-6">
                <!-- Logo & Title -->
                <div class="mb-6 flex items-center justify-center space-x-3 pb-2 border-b-2">
                    <a href="/" class="flex items-center space-x-3 text-gray-800 hover:text-gray-900">
                        <img src="{{ asset('images/logo-pemkot.png') }}" alt="Logo" class="w-10 h-auto">
                        <span class="font-bold w-48 text-lg sm:text-xl">Dinas Perpustakaan Daerah Kota Ternate</span>
                    </a>
                </div>

                <!-- Slot Content -->
                {{ $slot }}
            </div>
        </div>
    </body>

</html>