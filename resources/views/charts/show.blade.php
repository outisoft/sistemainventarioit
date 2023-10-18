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
                                    <form method="GET" action="{{ route('charts.index') }}">
                                        <label for="tipo_seleccionado">Selecciona el tipo:</label>
                                        <select name="tipo_seleccionado" id="tipo_seleccionado">
                                            <option value="hotel" {{ $tipoSeleccionado === 'hotel' ? 'selected' : '' }}>Hotel</option>
                                            <option value="departamento" {{ $tipoSeleccionado === 'departamento' ? 'selected' : '' }}>Departamento</option>
                                        </select>
                                        <button type="submit">Actualizar</button>
                                    </form>
                                    
                                    <canvas id="graficaEmpleados"></canvas>
                                    
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
    <script>
        var ctx = document.getElementById('graficaEmpleados').getContext('2d');
    
        var data = {
            labels: ['Tipo 1', 'Tipo 2', 'Tipo 3'],
            datasets: [
                {
                    label: 'Cantidad de Empleados',
                    data: [{{ $empleadosTipo1 }}, {{ $empleadosTipo2 }}, {{ $empleadosTipo3 }}],
                    backgroundColor: ['blue', 'green', 'orange']
                }
            ]
        };
    
        var opciones = {
            responsive: true,
            maintainAspectRatio: false
        };
    
        var graficaEmpleados = new Chart(ctx, {
            type: 'bar',
            data: data,
            options: opciones
        });
    </script>
      
</x-app-layout>
