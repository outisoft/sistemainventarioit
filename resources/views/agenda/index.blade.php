<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agenda</title>
    <style>
        /* Reset y estilos generales */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Arial', sans-serif;
        }

        body {
            background-color: #fff;
            color: #202124;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            line-height: 1.5;
        }

        /* Header */
        header {
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 10px 15px 0;
        }

        .top-nav {
            display: flex;
            justify-content: flex-end;
            width: 100%;
            padding: 8px 0;
        }

        nav ul {
            display: flex;
            list-style: none;
            align-items: center;
            flex-wrap: wrap;
            justify-content: flex-end;
        }

        nav ul li {
            margin-left: 12px;
        }

        nav ul li a {
            text-decoration: none;
            color: rgba(0, 0, 0, 0.87);
            font-size: 13px;
            display: flex;
            align-items: center;
        }

        nav ul li a:hover {
            text-decoration: underline;
        }

        /* Logo */
        .logo {
            margin: 15px 0 20px;
        }

        .logo img {
            width: 250px;
            height: auto;
        }

        /* Search box */
        .search-container {
            width: 100%;
            max-width: 584px;
            position: relative;
            margin-bottom: 15px;
        }

        .search-box {
            width: 100%;
            padding: 10px 40px;
            border: 1px solid #dfe1e5;
            border-radius: 24px;
            font-size: 16px;
            outline: none;
            height: 44px;
        }

        .search-box:hover,
        .search-box:focus {
            box-shadow: 0 1px 6px rgba(32, 33, 36, 0.28);
            border-color: rgba(223, 225, 229, 0);
        }

        .search-icon {
            position: absolute;
            left: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: #9aa0a6;
        }

        .voice-icon,
        .camera-icon {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: #4285f4;
        }

        .camera-icon {
            right: 45px;
        }

        /* Buttons */
        .buttons {
            display: flex;
            gap: 8px;
            margin-bottom: 20px;
            flex-wrap: wrap;
            justify-content: center;
        }

        .btn {
            background-color: #f8f9fa;
            border: 1px solid #f8f9fa;
            border-radius: 4px;
            color: #3c4043;
            padding: 8px 12px;
            font-size: 14px;
            cursor: pointer;
            min-width: 120px;
            margin: 4px;
        }

        .btn:hover {
            box-shadow: 0 1px 1px rgba(0, 0, 0, 0.1);
            border: 1px solid #dadce0;
            color: #202124;
        }

        /* Tabla deslizable verticalmente */
        .table-wrapper {
            width: 100%;
            max-width: 95%;
            margin: 0 auto 20px;
            border: 1px solid #dfe1e5;
            border-radius: 8px;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .scrollable-table {
            max-height: 50vh;
            overflow-y: auto;
            display: block;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 14px;
            min-width: 600px;
        }

        thead {
            position: sticky;
            top: 0;
            z-index: 10;
        }

        th,
        td {
            padding: 10px 12px;
            text-align: left;
            border-bottom: 1px solid #e0e0e0;
        }

        th {
            background-color: #f8f9fa;
            color: #3c4043;
            font-weight: 500;
            position: sticky;
            top: 0;
        }

        tbody tr:hover {
            background-color: #f5f5f5;
        }

        /* Footer */
        footer {
            background-color: #f2f2f2;
            padding: 10px 15px;
            margin-top: auto;
        }

        .footer-top {
            padding: 10px 0;
            border-bottom: 1px solid #dadce0;
            color: #70757a;
            font-size: 14px;
        }

        .footer-bottom {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            padding-top: 10px;
        }

        .footer-links {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }

        .footer-links a {
            text-decoration: none;
            color: #70757a;
            font-size: 13px;
            white-space: nowrap;
        }

        .footer-links a:hover {
            text-decoration: underline;
        }

        /* Media Queries para mejor responsividad */
        @media (max-width: 768px) {
            .logo img {
                width: 100px;
            }

            .search-box {
                padding: 8px 35px;
                font-size: 14px;
            }

            .camera-icon {
                right: 40px;
            }

            .btn {
                padding: 6px 10px;
                min-width: 100px;
                font-size: 13px;
            }

            th,
            td {
                padding: 8px 10px;
                font-size: 13px;
            }

            .table-wrapper {
                max-width: 100%;
                border-radius: 0;
                border-left: none;
                border-right: none;
            }
        }

        @media (max-width: 480px) {
            header {
                padding: 5px 10px 0;
            }

            nav ul li {
                margin-left: 8px;
            }

            .logo {
                margin: 10px 0 15px;
            }

            .logo img {
                width: 80px;
            }

            .search-container {
                margin-bottom: 10px;
            }

            .buttons {
                margin-bottom: 15px;
            }

            .footer-links {
                justify-content: center;
                gap: 8px;
            }

            .footer-bottom {
                flex-direction: column;
                align-items: center;
                gap: 8px;
            }

            .scrollable-table {
                max-height: 60vh;
            }
        }

        @media (max-width: 360px) {
            nav ul li a {
                font-size: 12px;
            }

            .btn {
                min-width: 90px;
                font-size: 12px;
            }

            .footer-links a {
                font-size: 12px;
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
            <input type="text" class="search-box" placeholder="Buscar con Google o escribir una URL">
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

    <footer>
        <div class="footer-top">
            <span>España</span>
        </div>
        <div class="footer-bottom">
            <div class="footer-links">
                <a href="#">Sobre Google</a>
                <a href="#">Publicidad</a>
                <a href="#">Negocios</a>
            </div>
            <div class="footer-links">
                <a href="#">Privacidad</a>
                <a href="#">Condiciones</a>
                <a href="#">Preferencias</a>
            </div>
        </div>
    </footer>

    @section('scripts')
        <script>
            $(document).ready(function() {
                const searchInput = $('#search-input');
                const resultsContainer = $('#results-container');
                const resultsBody = $('#results-body');
                const noResults = $('#no-results');
                const clearSearch = $('#clear-search');

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
                            if (data.length > 0) {
                                resultsBody.empty();
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
                                resultsContainer.show();
                            } else {
                                resultsBody.empty();
                                noResults.show();
                                resultsContainer.show();
                            }
                        },
                        error: function() {
                            console.error('Error en la búsqueda');
                        }
                    });
                }

                // Búsqueda al escribir (con debounce para no saturar el servidor)
                let searchTimeout;
                searchInput.on('input', function() {
                    clearTimeout(searchTimeout);
                    searchTimeout = setTimeout(performSearch, 300);
                });

                // Limpiar búsqueda
                clearSearch.on('click', function() {
                    searchInput.val('');
                    resultsContainer.hide();
                    searchInput.focus();
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
