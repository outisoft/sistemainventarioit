<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Inventario</title>

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="https://bsuite.grupo-pinero.com/bsuite/favicon.ico">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet" />

    <!--Data tables-->
    <link href="https://cdn.datatables.net/1.13.6/css/dataTables.uikit.min.css" rel="stylesheet">

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/fonts/boxicons.css') }}" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/core.css') }}" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/theme-default.css') }}"
        class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset('assets/css/demo.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/serach.css') }}" />

    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />

    @yield('css')
    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />

    <!--Charts-Graficas-->
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/apex-charts/apex-charts.css') }}" />
    <script src="https://cdn.jsdelivr.net/npm/chart.js" nonce="{{ csp_nonce() }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js" nonce="{{ csp_nonce() }}"></script>

    <!-- Helpers -->
    <script src="{{ asset('assets/vendor/js/helpers.js') }}" nonce="{{ csp_nonce() }}"></script>

    <!--Datatables-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js" nonce="{{ csp_nonce() }}"></script>
    <script src="{{ asset('assets/js/config.js') }}" nonce="{{ csp_nonce() }}"></script>

    @livewireStyles

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->

</head>

<body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <!-- Menu -->
            @include('layouts.menu')
            <!-- / Menu -->

            <!-- Layout container -->
            <div class="layout-page">
                @include('layouts.navigation')
                <!-- / Navbar -->

                <!-- Content wrapper -->
                <div class="content-wrapper">
                    <!-- Content -->
                    <main>
                        {{ $slot }}
                    </main>
                    <!-- / Content -->

                    <footer class="content-footer footer bg-footer-theme">
                        <div
                            class="container-fluid d-flex flex-md-row flex-column justify-content-between align-items-md-center gap-1 py-3">
                            <div>
                                <a href="{{ route('home') }}">
                                    <img src="{{ asset('images/gp-Logo.png') }}" alt="Imagen de ejemplo" width="36"
                                        height="36" />
                                </a>
                            </div>
                            <div>
                                <a href="#" class="footer-link me-4" target="_blank">Grupo Piñero</a>
                            </div>
                        </div>
                    </footer>
                    <div class="content-backdrop fade"></div>
                </div>
                <!-- Content wrapper -->
            </div>
            <!-- / Layout page -->
        </div>

        <!-- Overlay -->
        <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <!-- / Layout wrapper -->

    <!-- Swiper JS -->
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js" nonce="{{ csp_nonce() }}"></script>

    <script src="https://cdn.jsdelivr.net/gh/livewire/livewire@v3.x.x/dist/livewire.js" nonce="{{ csp_nonce() }}">
    </script>
    @livewireScripts
    <script nonce="{{ csp_nonce() }}">
        $(document).ready(function() {
            // Debug: Verifica que todo está cargado
            console.log('jQuery version:', $.fn.jquery);
            console.log('Bootstrap Modal:', typeof $.fn.modal !== 'undefined');

            // Solución para modales con HTTPS
            $(document).on('click', '[data-target="#modalCreate"]', function(e) {
                e.preventDefault();
                $('#modalCreate').modal('show');
            });
        });
    </script>
    @stack('scripts')
</body>
@yield('js')
@include('layouts.scripts')

</html>
