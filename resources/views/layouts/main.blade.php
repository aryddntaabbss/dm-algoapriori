<!doctype html>
<html lang="en">

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

        <!-- Font Awesome -->
        <link href="/your-path-to-fontawesome/css/fontawesome.css" rel="stylesheet" />
        <link href="/your-path-to-fontawesome/css/brands.css" rel="stylesheet" />
        <link href="/your-path-to-fontawesome/css/solid.css" rel="stylesheet" />

        <!-- Vendor CSS Files -->
        <link rel="stylesheet" href="{{ asset('admin/css/simplebar.css') }}">
        <link rel="stylesheet" href="{{ asset('admin/css/feather.css') }}">
        <link rel="stylesheet" href="{{ asset('admin/css/dataTables.bootstrap4.css') }}">
        <link rel="stylesheet" href="{{ asset('admin/css/daterangepicker.css') }}">
        <link rel="stylesheet" href="{{ asset('admin/css/style.css') }}">
        <link rel="stylesheet" href="{{ asset('admin/css/app-light.css') }}" id="lightTheme">
        <link rel="stylesheet" href="{{ asset('admin/css/app-dark.css') }}" id="darkTheme" disabled>

        <!-- Toastr CSS -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css"
            integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g=="
            crossorigin="anonymous" referrerpolicy="no-referrer" />

        <!-- Leaflet CSS -->
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css"
            integrity="sha256-kLaT2GOSpHechhsozzB+flnD+zUyjE2LlfWPgU04xyI=" crossorigin="" />
        <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"
            integrity="sha256-WBkoXOwTeyKclOHuWtc+i2uENFpDZ9YPdf5Hf+D7ewM=" crossorigin=""></script>

        <!-- Trix Editor -->
        <link rel="stylesheet" href="{{ asset('admin/css/trix.css') }}">
        <script type="text/javascript" src="{{ asset('admin/js/trix.js') }}"></script>
        <style>
            trix-toolbar [data-trix-button-group='file-tools'] {
                display: none;
            }
        </style>

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>

    <body class="vertical light">
        @yield('body')
        <div class="wrapper">
            @yield('headerside')

            <main role="main" class=" main-content">

                @yield('main')

                <div class="container-fluid">
                    <div class="row justify-content-center">
                        <div class="col-12">
                            @yield('content')
                        </div>
                    </div>
                </div>
                @include('layouts.footer')
            </main>
        </div>

        <!-- Vendor JS Files -->
        <script src="{{ asset('admin/js/jquery.min.js') }}"></script>
        <script src="{{ asset('admin/js/popper.min.js') }}"></script>
        <script src="{{ asset('admin/js/moment.min.js') }}"></script>
        <script src="{{ asset('admin/js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('admin/js/simplebar.min.js') }}"></script>
        <script src="{{ asset('admin/js/daterangepicker.js') }}"></script>
        <script src="{{ asset('admin/js/jquery.stickOnScroll.js') }}"></script>
        <script src="{{ asset('admin/js/tinycolor-min.js') }}"></script>
        <script src="{{ asset('admin/js/config.js') }}"></script>
        <script src="{{ asset('admin/js/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('admin/js/dataTables.bootstrap4.min.js') }}"></script>

        <script>
            $(document).ready(function () {
            $('#dataTable-1').DataTable({
                autoWidth: true,
                "lengthMenu": [
                    [16, 32, 64, -1],
                    [16, 32, 64, "All"]
                ]
            });
        });
        </script>

        <script src="{{ asset('admin/js/apps.js') }}"></script>
        @yield('scrip')

        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

        <script>
            @if (Session::has('success'))
            toastr.success("{{ Session::get('success') }}");
        @endif
        @if (Session::has('error'))
            toastr.error("{{ Session::get('error') }}");
        @endif
        </script>
    </body>

</html>