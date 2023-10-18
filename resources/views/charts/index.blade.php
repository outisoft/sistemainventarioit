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
                <a href="{{ route('users.index') }}" class="btn-ico" data-toggle="tooltip" data-placement="top" title="Regresar">
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
                        <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                            Tablas
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="javascript:void(0);">Empleados</a></li>
                            <li><a class="dropdown-item" href="javascript:void(0);">Usuarios</a></li>
                            <li><a class="dropdown-item" href="javascript:void(0);">Equipos  </a></li>
                            <li>
                                <hr class="dropdown-divider" />
                            </li>
                            <li><a class="dropdown-item" href="javascript:void(0);">Separated link</a></li>
                        </ul>
                    </div>
                </div>
                
                <div class="content-wrapper">
                    <div class="table-responsive text-nowrap">
                        <div class="card-datatable table-responsive pt-0">
                            <div class="table-responsive text-nowrap">
                                <div class="card-body">
                                    <div class="container" width="200" height="200">
                                        <h1>Gráfica de Empleados por Hotel</h1>
                                        <canvas id="graficaEmpleadosPorHotel" width="400" height="200"></canvas>                                
                                    </div>                                
                                </div>
                            </div>
                        </div>            
                    </div>
                </div>

                <div class="content-wrapper">
                    <div class="table-responsive text-nowrap">
                        <div class="card-datatable table-responsive pt-0">
                            <div class="table-responsive text-nowrap">
                                <div class="card-body">
                                    <div class="container" width="200" height="200">
                                        <h1>Gráfica de Empleados por Departamento</h1>
                                        <canvas id="graficaEmpleadosPorDepartamento" width="400" height="200"></canvas>
                                    </div>                                
                                </div>
                            </div>
                        </div>            
                    </div>
                  </div>

                  <div class="content-wrapper">
                    <div class="table-responsive text-nowrap">
                        <div class="card-datatable table-responsive pt-0">
                            <div class="table-responsive text-nowrap">
                                <div class="card-body">
                                    <div class="container" width="200" height="200">
                                        <h1>Gráfica de Equipos por Tipo</h1>
                                        <canvas id="graficaEquiposPorTipo" width="400" height="200"></canvas>                                
                                    </div>                                
                                </div>
                            </div>
                        </div>            
                    </div>
                  </div>
                  <div class="content-wrapper">
                    <div class="table-responsive text-nowrap">
                        <div class="card-datatable table-responsive pt-0">
                            <div class="table-responsive text-nowrap">
                                <div class="card-body">
                                    <div class="container" width="200" height="200">
                                        <h1>Gráfica de Equipos por Tipo</h1>
                                        <canvas id="graficaEquiposPorTipo2" width="400" height="200"></canvas>                                
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
    
    <script src="{{ asset('assets/vendor/libs/apex-charts/apexcharts.js')}}"></script>
    <script src="{{ asset('assets/js/dashboards-analytics.js')}}"></script>
    <script>
        var empleadosPorHotel = @json($empleadosPorHotel);
    
        var labels = empleadosPorHotel.map(function(data) {
            return data.hotel;
        });
    
        var data = empleadosPorHotel.map(function(data) {
            return data.cantidad_empleados;
        });
    
        // Define un array de colores personalizados para las barras
        var customColors = ['#a9d6e5', '#89c2d9', '#61a5c2', '#468faf', '#2C7DA0', '#2A6F97', '#014F86', '#01497C', '#013A63'];
    
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

    <script>
        var empleadosPorDepartamento = @json($empleadosPorDepartamento);

        var labels = empleadosPorDepartamento.map(function(data) {
            return data.departamento;
        });

        var data = empleadosPorDepartamento.map(function(data) {
            return data.cantidad_empleados;
        });

        // Define un array de colores personalizados para las barras
        var customColors = ['#a9d6e5', '#89c2d9', '#61a5c2', '#468faf', '#2C7DA0', '#2A6F97', '#014F86', '#01497C', '#013A63'];

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

    <script>
        var equiposPorTipo = @json($equiposPorTipo);

        var labels = equiposPorTipo.map(function(data) {
            return data.tipo;
        });

        var data = equiposPorTipo.map(function(data) {
            return data.cantidad_equipos;
        });

        var customColors = ['#a9d6e5', '#89c2d9', '#61a5c2', '#468faf', '#2C7DA0', '#2A6F97', '#014F86', '#01497C', '#013A63'];

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

    <script>
        var equiposPorTipo = @json($equiposPorTipo);

        var labels = equiposPorTipo.map(function(data) {
            return data.tipo;
        });

        var data = equiposPorTipo.map(function(data) {
            return data.cantidad_equipos;
        });

        var customColors = ['#a9d6e5', '#89c2d9', '#61a5c2', '#468faf', '#2C7DA0', '#2A6F97', '#014F86', '#01497C', '#013A63'];

        var ctx = document.getElementById('graficaEquiposPorTipo2').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'pie', // Tipo de gráfica de pastel
            data: {
                labels: labels,
                datasets: [{
                    data: data,
                    backgroundColor: customColors, // Asigna los colores personalizados
                    borderWidth: 6
                }]
            }
        });
    </script>
</x-app-layout>
