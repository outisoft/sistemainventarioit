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
        // Función común para crear gráficos
function crearGrafico(canvasId, datos, etiquetas, titulo) {
    const ctx = document.getElementById(canvasId).getContext('2d');
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: etiquetas,
            datasets: [{
                label: titulo,
                backgroundColor: customColors,
                borderColor: customColors,
                borderWidth: 1,
                data: datos
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
}

// Colores personalizados
const customColors = ['#2f2119', '#54402f', '#604933', '#715737', '#8d7141', '#a48c4e', '#b5a160', '#c5b87f', '#dad3ae', '#ece9d5'];

// Crear todas las gráficas
document.addEventListener('DOMContentLoaded', function() {
    // Gráfico 1: Empleados por Hotel
    const empleadosPorHotel = @json($empleadosPorHotel);
    const labelsEPH = empleadosPorHotel.map(data => data.hotel);
    const dataEPH = empleadosPorHotel.map(data => data.cantidad_empleados);
    crearGrafico('grafico1', dataEPH, labelsEPH, 'Empleados por Hotel');

    // Gráfico 2: Empleados por Departamento
    const empleadosPorDepartamento = @json($empleadosPorDepartamento);
    const labelsEPD = empleadosPorDepartamento.map(data => data.departamento);
    const dataEPD = empleadosPorDepartamento.map(data => data.cantidad_empleados);
    crearGrafico('grafico2', dataEPD, labelsEPD, 'Empleados por Departamento');

    // Gráfico 3: Equipos por Tipo
    const equiposPorTipo = @json($equiposPorTipo);
    const labelsEPT = equiposPorTipo.map(data => data.tipo);
    const dataEPT = equiposPorTipo.map(data => data.cantidad_equipos);
    crearGrafico('grafico3', dataEPT, labelsEPT, 'Equipos por Tipo');

    // Gráfico 4: Total de Laptops por Hotel
    const datosLap = @json($datosLap);
    const hotelesLap = datosLap.map(item => item.hotel);
    const equiposLaptop = datosLap.filter(item => item.tipo_equipo === 'LAPTOP').map(item => item.cantidad_equipos);
    crearGrafico('grafico4', equiposLaptop, hotelesLap, 'Total de Laptops por Hotel');

    // Gráfico 5: Total de CPUs por Hotel
    const datosCPU = @json($datosCPU);
    const hotelesCPU = datosCPU.map(item => item.hotel);
    const cantidadCPU = datosCPU.filter(item => item.tipo_equipo === 'CPU').map(item => item.cantidad_equipos);
    crearGrafico('grafico5', cantidadCPU, hotelesCPU, 'Total de CPUs por Hotel');
});
    </script>
</x-app-layout>
