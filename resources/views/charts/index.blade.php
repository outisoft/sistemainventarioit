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
                    .. / Usuarios /</span> Grafica </h4>

            <!-- Basic Bootstrap Table -->
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-header">Graficas de Registros</h5>
                    <div class="btn-group">
                        <button type="button" class="btn btn-primary dropdown-toggle" id="menu" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Tablas
                        </button>
                        <ul class="dropdown-menu">
                            <li value="op-1"><a class="dropdown-item">Empleados por hotel</a></li>
                            <li value="op-2"><a class="dropdown-item">Empleados por departamento</a></li>
                            <li value="op-3"><a class="dropdown-item">Equipos por tipo</a></li>
                            <li value="op-4"><a class="dropdown-item">Laptops por hotel</a></li>
                            <li value="op-5"><a class="dropdown-item">CPU por hotel</a></li>
                            <li>
                                <hr class="dropdown-divider" />
                            </li>
                        </ul>
                    </div>
                </div>                

                <!--Graficas-->
                <div class="content-wrapper">
                    <div class="table-responsive text-nowrap">
                        <div class="card-datatable table-responsive pt-0">
                            <div class="table-responsive text-nowrap">
                                <div class="card-body">
                                    <div id="op-1-content" class="container" width="200" height="200">
                                        <a href="{{ url('exportar-grafica')}}">Exportar grafica</a>
                                        <h1>Total de Empleados por Hotel</h1>
                                        <canvas id="graficaEmpleadosPorHotel" width="400" height="200"></canvas>
                                        <br>
                                    </div>
                                    <div id="op-2-content" class="container" width="200" height="200">
                                        <h1>Total de Empleados por Departamento</h1>
                                        <canvas id="graficaEmpleadosPorDepartamento" width="400"
                                            height="200"></canvas>
                                        <br>
                                    </div>
                                    <div id="op-3-content" class="container" width="200" height="200">
                                        <h1>Total de Equipos por Tipo</h1>
                                        <canvas id="graficaEquiposPorTipo" width="400" height="200"></canvas>
                                        <br>
                                    </div>
                                    <div id="op-4-content" class="container" width="200" height="200">
                                        <h1>Total de Laptops por Hotel</h1>
                                        <canvas id="chartlap" width="400" height="200"></canvas>
                                        <br>
                                    </div>
                                    <div id="op-5-content" class="container" width="200" height="200">
                                        <h1>Total de CPU por Hotel</h1>
                                        <canvas id="grafica" width="400" height="200"></canvas>
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
    <!-- Vendors JS -->
    <script src="{{ asset('js/chart.min.js') }}"></script>

    <!--empleados por hotel-->
    <script>
        var empleadosPorHotel = @json($empleadosPorHotel);

        var labels = empleadosPorHotel.map(function(data) {
            return data.hotel;
        });

        var data = empleadosPorHotel.map(function(data) {
            return data.cantidad_empleados;
        });


        // Define un array de colores personalizados para las barras
        var customColors = ['#2f2119', '#54402f', '#604933', '#715737', '#8d7141', '#a48c4e', '#b5a160', '#c5b87f',
            '#dad3ae'
        ];

        var ctx = document.getElementById('graficaEmpleadosPorHotel').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Empleados',
                    data: data,
                    backgroundColor: customColors, // Asigna los colores personalizados
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>

    <!--empleados por departamento-->
    <script>
        var empleadosPorDepartamento = @json($empleadosPorDepartamento);

        var labels = empleadosPorDepartamento.map(function(data) {
            return data.departamento;
        });

        var data = empleadosPorDepartamento.map(function(data) {
            return data.cantidad_empleados;
        });

        // Define un array de colores personalizados para las barras
        var customColors = ['#2f2119', '#54402f', '#604933', '#715737', '#8d7141', '#a48c4e', '#b5a160', '#c5b87f',
            '#dad3ae', '#ece9d5'
        ];

        var ctx = document.getElementById('graficaEmpleadosPorDepartamento').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Cantidad de Empleados',
                    data: data,
                    backgroundColor: customColors,
                    borderColor: customColors,
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>

    <!--equipos por tipo-->
    <script>
        var equiposPorTipo = @json($equiposPorTipo);

        var labels = equiposPorTipo.map(function(data) {
            return data.tipo;
        });

        var data = equiposPorTipo.map(function(data) {
            return data.cantidad_equipos;
        });

        var customColors = ['#2f2119', '#54402f', '#604933', '#715737', '#8d7141', '#a48c4e', '#b5a160', '#c5b87f',
            '#dad3ae', '#ece9d5'
        ];

        var ctx = document.getElementById('graficaEquiposPorTipo').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Cantidad de Equipos',
                    data: data,
                    backgroundColor: customColors, // Asigna los colores personalizados
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
    <!--TOTAL DE LAPTOPS POR HOTEL-->
    <script>
        var datosLap = @json($datosLap);

        var hoteles = datosLap.map(item => item.hotel);

        var equiposLaptop = datosLap.filter(item => item.tipo_equipo === 'LAPTOP').map(item => item.cantidad_equipos);

        var ctx = document.getElementById('grafica').getContext('2d');

        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: hoteles,
                datasets: [{
                    label: 'Equipos Laptop',
                    data: equiposLaptop,
                    backgroundColor: '#c5b87f',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
    <!--TOTAL DE CPU POR HOTEL-->
    <script>
        var datosCPU = @json($datosCPU);
        var datosLap = @json($datosLap);

        var hoteles = datosCPU.map(item => item.hotel);
        var hotelesLap = datosLap.map(item => item.hotel);
        /*var equiposCPU = datos.filter(item => item.tipo_equipo === 'CPU').map(item => item.cantidad_equipos);
        var equiposLaptop = datos.filter(item => item.tipo_equipo === 'laptop').map(item => item.cantidad_equipos);*/

        var cantidadCPU = datosCPU.filter(item => item.tipo_equipo === 'CPU').map(function(cantidadCPU) {
            return cantidadCPU.cantidad_equipos;
        });

        var cantidadLap = datosLap.filter(item => item.tipo_equipo === 'LAPTOP').map(function(cantidadLap) {
            return cantidadLap.cantidad_equipos;
        });

        var ctx = document.getElementById('chartlap').getContext('2d');

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: hoteles,
                datasets: [{
                    label: 'Equipos CPU',
                    data: cantidadCPU,
                    backgroundColor: '#8d7141',
                }, ]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>

<script>
    const dropdown = document.getElementById('menu');
    const contents = document.querySelectorAll('.content');

    dropdown.addEventListener('change', () => {
        const selectedOption = dropdown.value;

        contents.forEach(content => {
            if (content.id === selectedOption + '-content') {
                content.style.display = 'block';
            } else {
                content.style.display = 'none';
            }
        });
    });
</script>

</x-app-layout>
