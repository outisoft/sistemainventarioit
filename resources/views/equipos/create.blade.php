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
                                    <option value="">Seleccione una opcion</option>
                                    <option value="cpu">CPU</option>
                                    <option value="monitor">Monitor</option>
                                    <option value="teclado">Teclado</option>
                                    <option value="mouse">Mouse</option>
                                    <option value="cargador">Cargador</option>
                                    <option value="no_breack">No Breack</option>
                                    <option value="impresora">Impresora</option>
                                    <option value="lector">Lector</option>
                                    <option value="scanner">Escanner de Pasaporte</option>
                                    <option value="aplicacion">Aplicacion</option>
                                    <option value="so">Sistema Operativo</option>
                                    <option value="office">Office</option>
                                    <!-- Agrega más opciones de tipo de equipo aquí -->
                                </select>
                            </div>

                            <!-- Sección para el tipo de equipo "CPU" -->
                            <div class="cpu campos-equipo" style="display: none;">
                                <div class="form-group">
                                    <label for="no_equipo">Numero de equipo</label>
                                    <input type="text" id="no_equipo" name="no_equipo" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="estado">Estado</label>
                                    <input type="text" id="estado" name="estado" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="equipo">Equipo</label>
                                    <input type="text" id="equipo" name="equipo" class="form-control">
                                </div>

                                <div class="form-group">
                                    <label for="marca_equipo">Marca del equipo</label>
                                    <input type="text" id="marca_equipo" name="marca_equipo" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="modelo_equipo">Modelo del equipo</label>
                                    <input type="text" id="modelo_equipo" name="modelo_equipo" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="serie_equipo">Numero de serie</label>
                                    <input type="text" id="serie_equipo" name="serie_equipo" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="nombre_equipo">Nombre del equipo</label>
                                    <input type="text" id="nombre_equipo" name="nombre_equipo" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="ip">Ip del equipo</label>
                                    <input type="text" id="ip" name="ip" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="contrato">Numero de contrato</label>
                                    <input type="text" id="contrato" name="contrato" class="form-control">
                                </div>
                                <!-- Agrega más campos específicos para CPU aquí -->
                            </div>
                        
                            <!-- Sección para el tipo de equipo "Monitor" -->
                            <div class="monitor campos-equipo" style="display: none;">
                                <div class="form-group">
                                    <label for="marca_monitor">Marca del Monitor</label>
                                    <input type="text" id="marca_monitor" name="marca_monitor" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="modelo_monitor">Modelo del Monitor</label>
                                    <input type="text" id="modelo_monitor" name="modelo_monitor" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="serie">Numero de serie</label>
                                    <input type="text" id="serie" name="serie" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="contrato">Numero de contrato</label>
                                    <input type="text" id="contrato" name="contrato" class="form-control">
                                </div>
                                <!-- Agrega más campos específicos para monitor aquí -->
                            </div>
                        
                            <!-- Sección para el tipo de equipo "Teclado" -->
                            <div class="teclado campos-equipo" style="display: none;">
                                <div class="form-group">
                                    <label for="marca">Marca del Teclado</label>
                                    <input type="text" id="marca" name="marca" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="serie">Numero de serie</label>
                                    <input type="text" id="serie" name="serie" class="form-control">
                                </div>
                                <!-- Agrega más campos específicos para teclado aquí -->
                            </div>

                            <!-- Sección para el tipo de equipo "Mouse" -->
                            <div class="mouse campos-equipo" style="display: none;">
                                <div class="form-group">
                                    <label for="marca">Marca del mouse</label>
                                    <input type="text" id="marca" name="marca" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="serie">Numero de serie</label>
                                    <input type="text" id="serie" name="serie" class="form-control">
                                </div>
                                <!-- Agrega más campos específicos para teclado aquí -->
                            </div>

                            <!-- Sección para el tipo de equipo "Cargador" -->
                            <div class="cargador campos-equipo" style="display: none;">
                                <div class="form-group">
                                    <label for="marca">Marca del cargador</label>
                                    <input type="text" id="marca" name="marca" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="modelo">Modelo del cargador</label>
                                    <input type="text" id="modelo" name="modelo" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="serie">Numero de serie</label>
                                    <input type="text" id="serie" name="serie" class="form-control">
                                </div>
                                <!-- Agrega más campos específicos para teclado aquí -->
                            </div>

                            <!-- Sección para el tipo de equipo "No breack" -->
                            <div class="no_breack campos-equipo" style="display: none;">
                                <div class="form-group">
                                    <label for="marca">Marca del No-Breack</label>
                                    <input type="text" id="marca" name="marca" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="modelo">Modelo del No-Breack</label>
                                    <input type="text" id="modelo" name="modelo" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="serie">Numero de serie</label>
                                    <input type="text" id="serie" name="serie" class="form-control">
                                </div>
                                <!-- Agrega más campos específicos para teclado aquí -->
                            </div>

                            <!-- Sección para el tipo de equipo "Impresora" -->
                            <div class="no_breack campos-equipo" style="display: none;">
                                <div class="form-group">
                                    <label for="marca">Marca de la impresora</label>
                                    <input type="text" id="marca" name="marca" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="modelo">Modelo de la impresora</label>
                                    <input type="text" id="modelo" name="modelo" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="serie">Numero de serie</label>
                                    <input type="text" id="serie" name="serie" class="form-control">
                                </div>
                                <!-- Agrega más campos específicos para teclado aquí -->
                            </div>

                            <!-- Sección para el tipo de equipo "Lector" -->
                            <div class="no_breack campos-equipo" style="display: none;">
                                <div class="form-group">
                                    <label for="marca">Marca del lector</label>
                                    <input type="text" id="marca" name="marca" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="modelo">Modelo del lector</label>
                                    <input type="text" id="modelo" name="modelo" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="serie">Numero de serie</label>
                                    <input type="text" id="serie" name="serie" class="form-control">
                                </div>
                                <!-- Agrega más campos específicos para teclado aquí -->
                            </div>

                            <!-- Sección para el tipo de equipo "Scanner" -->
                            <div class="scanner campos-equipo" style="display: none;">
                                <div class="form-group">
                                    <label for="marca">Marca del escanner</label>
                                    <input type="text" id="marca" name="marca" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="modelo">Modelo del escanner</label>
                                    <input type="text" id="modelo" name="modelo" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="serie">Numero de serie</label>
                                    <input type="text" id="serie" name="serie" class="form-control">
                                </div>
                                <!-- Agrega más campos específicos para teclado aquí -->
                            </div>

                            <!-- Sección para el tipo de equipo "Aplicacion" -->
                            <div class="aplicacion campos-equipo" style="display: none;">
                                <div class="form-group">
                                    <label for="nombre_app">Nombre de la aplicacion</label>
                                    <input type="text" id="nombre_app" name="nombre_app" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="clave">Clave de activacion</label>
                                    <input type="text" id="clave" name="clave" class="form-control">
                                </div>
                                <!-- Agrega más campos específicos para teclado aquí -->
                            </div>

                            <!-- Sección para el tipo de equipo "SO" -->
                            <div class="so campos-equipo" style="display: none;">
                                <div class="form-group">
                                    <label for="so">Sistema operativo</label>
                                    <input type="text" id="so" name="so" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="clave">Clave de activacion</label>
                                    <input type="text" id="clave" name="clave" class="form-control">
                                </div>
                                <!-- Agrega más campos específicos para teclado aquí -->
                            </div>

                            <!-- Sección para el tipo de equipo "Office" -->
                            <div class="office campos-equipo" style="display: none;">
                                <div class="form-group">
                                    <label for="office">Paqueteria Office</label>
                                    <input type="text" id="office" name="office" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="clave">Clave de activacion</label>
                                    <input type="text" id="clave" name="clave" class="form-control">
                                </div>
                                <!-- Agrega más campos específicos para teclado aquí -->
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
    <script>
        // Aquí se mostrarán los mensajes Toastr
        function mostrarToastr(message, type) {
            toastr[type](message, type.charAt(0).toUpperCase() + type.slice(1));
        }
    </script>
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