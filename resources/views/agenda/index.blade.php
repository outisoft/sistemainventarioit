<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agenda</title>
    <style>
        /* Tipografía y base más moderna */
        * {
            box-sizing: border-box;
        }

        html,
        body {
            height: 100%;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
            color: #202124;
            background: #ffffff;
            margin: 0;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        header {
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 18px 16px 6px;
        }

        .top-nav {
            width: 100%;
            display: flex;
            justify-content: flex-end;
            padding: 6px 0;
        }

        .logo {
            margin: 12px 0 18px;
        }

        .logo img {
            width: 200px;
            height: auto;
            opacity: 0.95;
        }

        /* Búsqueda: tarjeta sutil con sombra y filtro */
        .search-container {
            width: 100%;
            max-width: 760px;
            position: relative;
            margin-bottom: 18px;
        }

        .search-box {
            width: 100%;
            padding: 12px 44px;
            border-radius: 28px;
            border: 1px solid #e6e7eb;
            background: linear-gradient(180deg, #fff, #fcfdff);
            box-shadow: 0 6px 18px rgba(16, 24, 40, 0.06);
            font-size: 15px;
            color: #1f2937;
            outline: none;
            height: 46px;
            transition: box-shadow .18s ease, border-color .15s ease;
        }

        .search-box::placeholder {
            color: #9aa0a6;
            font-weight: 400;
        }

        .search-box:focus {
            box-shadow: 0 10px 30px rgba(34, 88, 232, 0.06);
            border-color: rgba(66, 133, 244, 0.28);
        }

        .search-icon {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: #9aa0a6;
        }

        .voice-icon {
            position: absolute;
            right: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: #4285f4;
        }

        /* Buttons minimalistas */
        .btn {
            background: transparent;
            border: 1px solid transparent;
            color: #374151;
            padding: 8px 12px;
            border-radius: 8px;
            cursor: pointer;
            transition: background .12s ease, box-shadow .12s ease, transform .06s ease;
        }

        .btn:hover {
            background: #f3f4f6;
            box-shadow: none;
            color: #111827;
            transform: translateY(-1px);
        }

        /* Table card: centrado, más compacto y elegante */
        .table-responsive {
            max-width: 820px;
            margin: 18px auto 28px;
            border-radius: 14px;
            overflow: hidden;
            background: #ffffff;
            box-shadow: 0 8px 28px rgba(16, 24, 40, 0.06);
            border: 1px solid #eef0f3;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 14px;
            min-width: 480px;
        }

        thead th {
            background: linear-gradient(180deg, #fbfcfd, #f8fafc);
            color: #28303a;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 12px;
            letter-spacing: .06em;
            padding: 12px 14px;
            border-bottom: 1px solid #eef0f3;
        }

        tbody td {
            padding: 10px 14px;
            color: #374151;
            border-bottom: 1px solid #f1f3f5;
            vertical-align: middle;
        }

        tbody tr:hover {
            background: rgba(66, 133, 244, 0.03);
        }

        /* Primera y última celda redondeadas para apariencia de tarjeta */
        thead th:first-child {
            border-top-left-radius: 14px;
        }

        thead th:last-child {
            border-top-right-radius: 14px;
        }

        tbody tr:last-child td:first-child {
            border-bottom-left-radius: 14px;
        }

        tbody tr:last-child td:last-child {
            border-bottom-right-radius: 14px;
            border-bottom: none;
        }

        /* Texto y estado */
        .muted {
            color: #6b7280;
            font-size: 13px;
        }

        .accent {
            color: #4285f4;
            font-weight: 600;
        }

        /* Footer - minimal & elegant (fixed at bottom) */
        .site-footer {
            position: fixed;
            left: 0;
            right: 0;
            bottom: 0;
            z-index: 2000;
            background: linear-gradient(180deg, #fbfdff 0%, #f7f8fa 100%);
            border-top: 1px solid #eef2f7;
            color: #374151;
            padding: 28px 16px;
        }

        .site-footer .footer-inner {
            max-width: 920px;
            margin: 0 auto;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            flex-wrap: wrap;
        }

        .site-footer .footer-links {
            display: flex;
            gap: 18px;
            flex-wrap: wrap;
            align-items: center;
        }

        .site-footer .footer-links a {
            color: #475569;
            text-decoration: none;
            font-size: 13px;
            padding: 6px 4px;
            transition: color .12s ease, transform .08s ease;
        }

        .site-footer .footer-links a:hover {
            color: #0f172a;
            transform: translateY(-1px);
        }

        .site-footer .meta {
            color: #667085;
            font-size: 13px;
            display: flex;
            gap: 12px;
            align-items: center;
            flex-wrap: wrap;
        }

        .site-footer .muted-small {
            color: #94a3b8;
            font-size: 12px;
        }

        .site-footer .social {
            display: flex;
            gap: 8px;
            align-items: center;
        }

        .site-footer .social a {
            display: inline-flex;
            width: 28px;
            height: 28px;
            align-items: center;
            justify-content: center;
            border-radius: 6px;
            background: #fff;
            border: 1px solid #e6eef9;
            color: #2b6cb0;
            text-decoration: none;
            box-shadow: 0 2px 6px rgba(11, 46, 96, 0.03);
            transition: transform .12s ease, box-shadow .12s ease;
        }

        .site-footer .social a:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 18px rgba(11, 46, 96, 0.06);
        }

        main {
            flex: 1;
            padding-bottom: 140px;
            /* reserva espacio para el footer fijo */
        }

        @media (max-width: 640px) {
            .site-footer {
                padding: 16px 12px;
            }

            .site-footer .footer-inner {
                flex-direction: column;
                text-align: center;
                gap: 12px;
            }

            .site-footer .meta {
                justify-content: center;
            }

            main {
                padding-bottom: 180px;
                /* más espacio si el footer se hace alto en móvil */
            }
        }

        @media (max-width: 900px) {
            .table-responsive {
                max-width: 95%;
                margin: 16px auto;
            }

            .logo img {
                width: 160px;
            }

            .search-box {
                max-width: 100%;
            }
        }

        @media (max-width: 560px) {

            thead th:nth-child(5),
            tbody td:nth-child(5),
            thead th:nth-child(3),
            tbody td:nth-child(3) {
                display: none;
            }

            table {
                min-width: 360px;
            }
        }
    </style>
</head>

<body>
    <header>
        <nav class="top-nav">
            <ul>
                <li><a href="#"><button class="btn">Iniciar sesión</button></a></li>
            </ul>
        </nav>

        <div class="logo">
            <img src="{{ asset('images/logo_gp_50.png') }}" alt="Google">
        </div>

        <div class="search-container">
            <span class="search-icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="11" cy="11" r="8"></circle>
                    <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                </svg>
            </span>
            <input type="text" id="search-input" class="search-box" placeholder="Buscar Nombre, correo, extensión">
            <span class="voice-icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="10"></circle>
                    <line x1="12" y1="8" x2="12" y2="16"></line>
                    <line x1="8" y1="12" x2="16" y2="12"></line>
                </svg>
            </span>
        </div>
    </header>

    <main>
        <!-- Tabla de resultados (inicialmente oculta) -->
        <div id="results-container" style="display: none;">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="thead-light">
                        <tr>
                            <th>Nombre</th>
                            <th>Puesto</th>
                            <th>Departamento</th>
                            <th>Hotel</th>
                            <th>Extensión</th>
                            <th>Correo</th>
                        </tr>
                    </thead>
                    <tbody id="results-body">
                        <!-- Los resultados se cargarán aquí via AJAX -->
                    </tbody>
                </table>
            </div>
            <div id="no-results" class="text-center py-4" style="display: none;">
                <p>No se encontraron resultados</p>
            </div>
        </div>
    </main>

    <footer class="site-footer" role="contentinfo">
        <div class="footer-inner">
            <div class="footer-left">
                <nav class="footer-links" aria-label="Enlaces del pie de página">
                    <a href="#">Sobre</a>
                    <a href="#">Publicidad</a>
                    <a href="#">Negocios</a>
                    <a href="#">Privacidad</a>
                    <a href="#">Condiciones</a>
                </nav>
            </div>

            <div class="footer-right meta" aria-hidden="false">
                <div class="muted-small">España</div>
                <div class="muted-small">© {{ date('Y') }} Tu Empresa</div>
                <div class="social" aria-label="Redes sociales">
                    <a href="#" title="Twitter" aria-label="Twitter">
                        <!-- simple twitter icon -->
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                            <path
                                d="M23 3a10.9 10.9 0 0 1-3.14 1.53A4.48 4.48 0 0 0 12 7.77v1A10.66 10.66 0 0 1 3 4s-4 9 5 13a11.64 11.64 0 0 1-7 2c9 5 20 0 20-11.5a4.5 4.5 0 0 0-.08-.83A7.72 7.72 0 0 0 23 3z">
                            </path>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </footer>

    @section('scripts')
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>
            $(document).ready(function() {
                const searchInput = $('#search-input');
                const resultsContainer = $('#results-container');
                const resultsBody = $('#results-body');
                const noResults = $('#no-results');

                // Función para realizar la búsqueda
                function performSearch() {
                    const query = searchInput.val().trim();

                    if (query.length === 0) {
                        resultsContainer.hide();
                        return;
                    }

                    $.ajax({
                        url: "{{ route('agenda.buscar') }}",
                        method: 'GET',
                        data: {
                            q: query
                        },
                        dataType: 'json',
                        success: function(data) {
                            resultsBody.empty();
                            if (data.length > 0) {
                                data.forEach(function(item) {
                                    resultsBody.append(`
                                    <tr>
                                        <td>${item.nombre}</td>
                                        <td>${item.puesto}</td>
                                        <td>${item.departamento}</td>
                                        <td>${item.hotel}</td>
                                        <td>${item.extension}</td>
                                        <td>${item.correo}</td>
                                    </tr>
                                `);
                                });
                                noResults.hide();
                            } else {
                                noResults.show();
                            }
                            resultsContainer.show();
                        },
                        error: function() {
                            console.error('Error en la búsqueda');
                            resultsBody.empty();
                            noResults.show();
                            resultsContainer.show();
                        }
                    });
                }

                // Búsqueda al escribir (sin debounce, ejecuta en cada tecla)
                searchInput.on('input', function() {
                    performSearch();
                });

                // Permitir búsqueda con Enter
                searchInput.on('keypress', function(e) {
                    if (e.which === 13) {
                        performSearch();
                    }
                });
            });
        </script>
    @endsection
</body>

</html>
