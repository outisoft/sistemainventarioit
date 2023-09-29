<x-app-layout>
    <div class="content-wrapper">
        <!-- Content -->

        <div class="container-xxl flex-grow-1 container-p-y">
          <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Equipos /</span> Nuevo </h4>

          <!-- Basic Bootstrap Table -->
          <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="card-header">Nuevo Equipo</h5>
            </div>

            <div class="content-wrapper">
                <div class="table-responsive text-nowrap">
                  <div class="card-datatable table-responsive pt-0">
                      <div class="card-body">
                        <form action="{{ route('equipo.store') }}" method="POST">
                            @csrf
                        
                            <div class="form-group">
                                <label for="tipo">Tipo de Equipo</label>
                                <select id="tipo" name="tipo" class="form-control">
                                    <option value="teclado">Teclado</option>
                                    <option value="cpu">CPU</option>
                                    <option value="monitor">Monitor</option>
                                    <!-- Agrega más opciones de tipo de equipo aquí -->
                                </select>
                            </div>

                            <!-- Sección para el tipo de equipo "CPU" -->
                            <div class="cpu campos-equipo" style="display: none;">
                                <div class="form-group">
                                    <label for="cpu_procesador">Procesador de la CPU</label>
                                    <input type="text" id="cpu_procesador" name="cpu_procesador" class="form-control">
                                </div>
                                <!-- Agrega más campos específicos para CPU aquí -->
                            </div>
                        
                            <!-- Sección para el tipo de equipo "Teclado" -->
                            <div class="teclado campos-equipo" style="display: none;">
                                <div class="form-group">
                                    <label for="teclado_marca">Marca del Teclado</label>
                                    <input type="text" id="teclado_marca" name="teclado_marca" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="teclado_marca">Modelo del Teclado</label>
                                    <input type="text" id="teclado_modelo" name="teclado_modelo" class="form-control">
                                </div>
                                <!-- Agrega más campos específicos para teclado aquí -->
                            </div>
                        
                            <!-- Sección para el tipo de equipo "Monitor" -->
                            <div class="monitor campos-equipo" style="display: none;">
                                <div class="form-group">
                                    <label for="monitor_tamaño">Tamaño del Monitor</label>
                                    <input type="text" id="monitor_tamaño" name="monitor_tamaño" class="form-control">
                                </div>
                                <!-- Agrega más campos específicos para monitor aquí -->
                            </div>
                        
                            <!-- Agrega más secciones para otros tipos de equipo aquí -->
                            <br>
                            <button type="submit" class="btn btn-primary">Guardar Equipo</button>
                        </form>
                        
                      </div>
                  </div>            
                </div>
              </div>
          </div>
          <!--/ Basic Bootstrap Table -->

          <hr class="my-5" />

        </div>
        <!-- / Content -->
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#tipo').change(function() {
                var selectedTipo = $(this).val();

                // Oculta todas las secciones de tipo de equipo
                $('.campos-equipo').hide();

                // Muestra la sección correspondiente al tipo seleccionado
                $('.' + selectedTipo).show();
            });
        });
    </script>

</x-app-layout>