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
                                        <h1>Gráfica de Hotel por Tipo CPU</h1>
                                        <canvas id="graficaEmpleados" width="400" height="200"></canvas>                                
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
                                        <table>
                                            <thead>
                                                <tr>
                                                    <th>Hotel</th>
                                                    <th>Nombre del Empleado</th>
                                                    <th>Correo Electrónico</th>
                                                    <!-- Agrega más columnas según tus necesidades -->
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($hoteles as $hotel)
                                                <tr>
                                                    <td>{{ $hotel->nombre }}</td>
                                                    <td>
                                                        @foreach($hotel->empleados as $empleado)
                                                            {{ $empleado->name }}<br>
                                                        @endforeach
                                                    </td>
                                                    <td>
                                                        @foreach($hotel->empleados as $empleado)
                                                            {{ $empleado->email }}<br>
                                                        @endforeach
                                                    </td>
                                                    <!-- Agrega más columnas según tus necesidades -->
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>                                                                      
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
                                    <table>
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Nombre</th>
                                                <!-- Agrega más columnas según tus necesidades -->
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($equiposCpu as $equipo)
                                            <tr>
                                                <td>{{ $equipo->id }}</td>
                                                <td>{{ $equipo->tipo->name }}</td>
                                                <!-- Agrega más columnas según tus necesidades -->
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                                                   
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
                                        <table>
                                            <thead>
                                                <tr>
                                                    <th>Hotel</th>
                                                    <th>Cantidad de Equipos CPU</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($hotels as $hotel)
                                                <tr>
                                                    <td>{{ $hotel->nombre }}</td>
                                                    <td>{{ $hotel->equiposCpu->count() }}</td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                                                        
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
                                        <h1>Gráfica de Hotel por Tipo CPU</h1>
                                        <canvas id="graficaEquipos"></canvas>                                                                        
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

    <!--script>
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
    </script-->

    <script>
        // Datos de ejemplo: Reemplaza estos datos con los resultados reales
        const contadorEmpleadosCpu = 5; // Supongamos que tienes 5 empleados con tipo "cpu"
    
        // Configuración de la gráfica
        const ctx = document.getElementById('graficaEmpleados').getContext('2d');
        const data = {
            labels: ['Tipo CPU'],
            datasets: [{
                label: 'Cantidad de empleados',
                data: [contadorEmpleadosCpu],
                backgroundColor: ['blue'], // Color de la barra
            }],
        };
        const config = {
            type: 'bar',
            data: data,
        };
    
        // Crea y muestra la gráfica
        const myChart = new Chart(ctx, config);
    </script>

    <script>
        var ctx = document.getElementById('graficaEquipos').getContext('2d');

        var data = {
            labels: @json($labels),
            datasets: [{
                label: 'Cantidad de Equipos CPU por Hotel',
                data: @json($data),
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1,
            }],
        };

        var options = {
            scales: {
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Cantidad de Equipos CPU',
                    },
                },
            },
        };

        var myChart = new Chart(ctx, {
            type: 'bar',
            data: data,
            options: options,
        });

    </script>

</x-app-layout>
