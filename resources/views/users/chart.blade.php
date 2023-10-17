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
                </div>
                <div class="content-wrapper">
                  <div class="table-responsive text-nowrap">
                    <div class="card-datatable table-responsive pt-0">
                        <div class="table-responsive text-nowrap">
                            <div class="card-body">
                                <div class="container" width="200" height="200">
                                    <canvas id="graficaPastel" ></canvas>
                                </div>
                                <div class="card-body">
                                  <ul class="p-0 m-0">
                                    <li class="d-flex mb-4 pb-1">
                                      <div class="avatar flex-shrink-0 me-3">
                                        <span class="avatar-initial rounded bg-label-primary"
                                          ><i class="bx bx-mobile-alt"></i
                                        ></span>
                                      </div>
                                      <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                        <div class="me-2">
                                          <h6 class="mb-0">Electronic</h6>
                                          <small class="text-muted">Mobile, Earbuds, TV</small>
                                        </div>
                                        <div class="user-progress">
                                          <small class="fw-semibold">82.5k</small>
                                        </div>
                                      </div>
                                    </li>
                                  </ul>
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
    <script src="{{ asset('assets/vendor/libs/apex-charts/apexcharts.js')}}"></script>
    <!-- Page JS -->
    <script src="{{ asset('assets/js/dashboards-analytics.js')}}"></script>
    
    <script src="{{ asset('js/chart.min.js') }}"></script>
    <script>
        var data = <?php echo json_encode($data); ?>;
        var ctx = document.getElementById('graficaPastel').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'pie',
            data: {
                datasets: [{
                    data: data.map(item => item.value),

                    backgroundColor: ['#219ebc', '#ffb703', '#fb8500'], // Colores para las partes del pastel
                }],
                labels: data.map(item => item.label),
            },
            options: {
                // Opciones de configuración de la gráfica
                responsive: true, // Hacer que la gráfica sea responsive
                maintainAspectRatio: false, // Desactivar el aspect ratio para ajustar el tamaño
                // Otras opciones de configuración
            }
        });
    </script>
</x-app-layout>
