<x-app-layout>
    <div class="container-xxl navbar-expand-xl align-items-center">
        <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
            <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                <i class="bx bx-menu bx-sm"></i>
            </a>
        </div>
    </div>

    <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">
                    <a href="{{ route('users.index') }}" class="btn-ico" data-toggle="tooltip" data-placement="top"
                        title="Regresar">
                        <span>
                            <i class='bx bx-arrow-back'></i>
                        </span>
                    </a>
                    .. / Usuarios /</span> Graficas </h4>

            <!-- Basic Bootstrap Table -->
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <!--h5 class="card-header">Graficas de Registros</h5-->
                    <div class="btn-group">
                        <!-- Selección de gráfica -->
                        <select class="btn btn-primary dropdown-toggle" id="seleccionGrafica"
                            onchange="mostrarGrafica()">
                            <option class="select-option" value="">Seleccionar grafica</option>
                            <option class="select-option" value="grafico1">Empleados por hotel</option>
                            <option class="select-option" value="grafico2">Empleados por departamento</option>
                            <option class="select-option" value="grafico3">Equipos por tipo</option>
                            <option class="select-option" value="grafico4">Laptops por hotel</option>
                            <option class="select-option" value="grafico5">CPU por hotel</option>
                        </select>
                    </div>
                </div>

                <!-- Encabezado para cada gráfica -->
                <h2 id="encabezadoGrafico1">Encabezado Gráfico 1</h2>
                <h2 id="encabezadoGrafico2">Encabezado Gráfico 2</h2>
                <h2 id="encabezadoGrafico3">Encabezado Gráfico 3</h2>
                <h2 id="encabezadoGrafico4">Encabezado Gráfico 4</h2>
                <h2 id="encabezadoGrafico5">Encabezado Gráfico 5</h2>

                <!--Graficas-->
                <div class="content-wrapper">
                    <div class="table-responsive text-nowrap">
                        <div class="card-datatable table-responsive pt-0">
                            <div class="table-responsive text-nowrap">
                                <div class="card-body">
                                    <div id="op-1-content" class="container" width="200" height="200">
                                        <!--a href="{{ url('exportar-grafica') }}">Exportar grafica</a-->
                                        <canvas id="grafico1" width="400" height="200"></canvas>
                                        <br>
                                    </div>
                                    <div id="op-2-content" class="container" width="200" height="200">
                                        <canvas id="grafico2" width="400" height="200"></canvas>
                                        <br>
                                    </div>
                                    <div id="op-3-content" class="container" width="200" height="200">
                                        <canvas id="grafico3" width="400" height="200"></canvas>
                                        <br>
                                    </div>
                                    <div id="op-4-content" class="container" width="200" height="200">
                                        <canvas id="grafico4" width="400" height="200"></canvas>
                                        <br>
                                    </div>
                                    <div id="op-5-content" class="container" width="200" height="200">
                                        <canvas id="grafico5" width="400" height="200"></canvas>
                                        <br>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--/ Basic Bootstrap Table -->
        </div>
        <!-- / Content -->
    </div>

    <script>
        //<!--empleados por hotel-->
        var empleadosPorHotel = @json($empleadosPorHotel);

        var labelsEPH = empleadosPorHotel.map(function(data) {
            return data.hotel;
        });

        var dataEPH = empleadosPorHotel.map(function(data) {
            return data.cantidad_empleados;
        });

        //empleados por departamento
        var empleadosPorDepartamento = @json($empleadosPorDepartamento);

        var labelsEPD = empleadosPorDepartamento.map(function(data) {
            return data.departamento;
        });

        var dataEPD = empleadosPorDepartamento.map(function(data) {
            return data.cantidad_empleados;
        });

        //equipos por tipo
        var equiposPorTipo = @json($equiposPorTipo);

        var labelsEPT = equiposPorTipo.map(function(data) {
            return data.tipo;
        });

        var dataEPT = equiposPorTipo.map(function(data) {
            return data.cantidad_equipos;
        });

        //TOTAL DE LAPTOPS POR HOTEL
        var datosLap = @json($datosLap);

        var hoteles = datosLap.map(item => item.hotel);

        var equiposLaptop = datosLap.filter(item => item.tipo_equipo === 'LAPTOP').map(item => item.cantidad_equipos);

        //TOTAL DE CPU POR HOTEL
        var datosCPU = @json($datosCPU);
        var datosLap = @json($datosLap);

        var hoteles2 = datosCPU.map(item => item.hotel);
        var hotelesLap = datosLap.map(item => item.hotel);

        var cantidadCPU = datosCPU.filter(item => item.tipo_equipo === 'CPU').map(function(cantidadCPU) {
            return cantidadCPU.cantidad_equipos;
        });

        var cantidadLap = datosLap.filter(item => item.tipo_equipo === 'LAPTOP').map(function(cantidadLap) {
            return cantidadLap.cantidad_equipos;
        });

        // Define un array de colores personalizados para las barras
        var customColors = ['#2f2119', '#54402f', '#604933', '#715737', '#8d7141', '#a48c4e', '#b5a160', '#c5b87f',
            '#dad3ae', '#ece9d5'
        ];

        // Datos y etiquetas para cada gráfico
        const datosYEtiquetas = [{
                datos: dataEPH,
                etiquetas: labelsEPH,
            },
            {
                datos: dataEPD,
                etiquetas: labelsEPD,
            },
            {
                datos: dataEPT,
                etiquetas: labelsEPT,
            },
            {
                datos: equiposLaptop,
                etiquetas: hoteles,
            },
            {
                datos: cantidadCPU,
                etiquetas: hoteles2,
            }
        ];

        // Configuración común para los gráficos
        const configuracionComun = {
            type: 'bar',
            data: {
                labels: [],
                datasets: [{
                    label: [],
                    backgroundColor: customColors,
                    borderColor: customColors,
                    borderWidth: 1,
                    data: []
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        };

        // Crear los gráficos y ocultarlos
        datosYEtiquetas.forEach((item, index) => {
            const canvas = document.getElementById(`grafico${index + 1}`);
            canvas.style.display = 'none';

            const encabezado = document.getElementById(`encabezadoGrafico${index + 1}`);
            encabezado.style.display = 'none';

            const configuracionGrafico = {
                ...configuracionComun,
                data: {
                    ...configuracionComun.data,
                    labels: item.etiquetas,
                    datasets: [{
                        ...configuracionComun.data.datasets[0],
                        data: item.datos
                    }]
                }
            };
            new Chart(canvas.getContext('2d'), configuracionGrafico);
        });

        // Función para mostrar la gráfica seleccionada
        function mostrarGrafica() {
            // Oculta todas las gráficas
            datosYEtiquetas.forEach((_, index) => {
                const canvas = document.getElementById(`grafico${index + 1}`);
                canvas.style.display = 'none';

                const encabezado = document.getElementById(`encabezadoGrafico${index + 1}`);
                encabezado.style.display = 'none';
            });

            // Muestra la gráfica seleccionada
            const seleccion = document.getElementById('seleccionGrafica').value;
            const seleccionCanvas = document.getElementById(seleccion);
            seleccionCanvas.style.display = 'block';

            const seleccionEncabezado = document.getElementById(`encabezado${seleccion.charAt(seleccion.length - 1)}`);
            seleccionEncabezado.style.display = 'block';
        }
    </script>
</x-app-layout>
