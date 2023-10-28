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
                        
                            <div class="mb-3">
                                <label for="tipo" class="form-label">Tipo de Equipo</label>
                                <div class="input-group input-group-merge">
                                    <select id="tipo_id" name="tipo_id" class="form-control"  aria-label="Default select example">
                                            <option value="">Seleccione una opcion</option>
                                            <option value="3">CPU</option>
                                            <option value="6">Monitor</option>
                                            <option value="12">Teclado</option>
                                            <option value="7">Mouse</option>
                                            <option value="2">Cargador</option>
                                            <option value="8">No Breack</option>
                                            <option value="4">Impresora</option>
                                            <option value="5">Lector</option>
                                            <option value="10">Escanner de Pasaporte</option>
                                            <option value="1">Aplicacion</option>
                                            <option value="11">Sistema Operativo</option>
                                            <option value="9">Office</option>
                                            <!-- Agrega más opciones de tipo de equipo aquí -->
                                    </select>
                                </div>
                            </div>

                            <!-- Sección para el tipo de equipo "CPU" -->
                            <div class="3 campos-equipo mb-3" style="display: none;">
                                <div class="mb-3">
                                    <label class="form-label" for="orden">Orden de compra</label>
                                    <div class="input-group input-group-merge">
                                        <x-text-input type="text" class="form-control" id="orden"  name="orden" aria-describedby="basic-icon-default-fullname2" autocomplete="orden" />
                                        <x-input-error :messages="$errors->get('orden')" class="mt-2" />
                                    </div>

                                    <label class="form-label" for="marca_equipo">Marca del equipo</label>
                                    <div class="input-group input-group-merge">
                                        <x-text-input type="text" class="form-control" id="marca_equipo"  name="marca_equipo" aria-describedby="basic-icon-default-fullname2" autocomplete="name" />
                                        <x-input-error :messages="$errors->get('marca_equipo')" class="mt-2" />
                                    </div>

                                    <label class="form-label" for="modelo_equipo">Modelo del equipo</label>
                                    <div class="input-group input-group-merge">
                                        <x-text-input type="text" class="form-control" id="modelo_equipo"  name="modelo_equipo" aria-describedby="basic-icon-default-fullname2" autocomplete="name" />
                                        <x-input-error :messages="$errors->get('modelo_equipo')" class="mt-2" />
                                    </div>

                                    <label class="form-label" for="serie_equipo">Numero de serie</label>
                                    <div class="input-group input-group-merge">
                                        <x-text-input type="text" class="form-control" id="modelo_equipo"  name="serie_equipo" aria-describedby="basic-icon-default-fullname2"  autocomplete="name" />
                                        <x-input-error :messages="$errors->get('serie_equipo')" class="mt-2" />
                                    </div>

                                    <label class="form-label" for="nombre_equipo">Nombre del equipo</label>
                                    <div class="input-group input-group-merge">
                                        <x-text-input type="text" class="form-control" id="nombre_equipo"  name="nombre_equipo" aria-describedby="basic-icon-default-fullname2"  autocomplete="name" />
                                        <x-input-error :messages="$errors->get('nombre_equipo')" class="mt-2" />
                                    </div>

                                    <label class="form-label" for="ip">Ip del equipo</label>
                                    <div class="input-group input-group-merge">
                                        <x-text-input type="text" class="form-control" id="ip"  name="ip" aria-describedby="basic-icon-default-fullname2"  autocomplete="name" />
                                        <x-input-error :messages="$errors->get('ip')" class="mt-2" />
                                    </div>

                                    <label class="form-label" for="contrato">Numero de contrato</label>
                                    <div class="input-group input-group-merge">
                                        <x-text-input type="text" class="form-control" id="contrato"  name="contrato" aria-describedby="basic-icon-default-fullname2" autocomplete="name" />
                                        <x-input-error :messages="$errors->get('contrato')" class="mt-2" />
                                    </div>
                                </div>
                                <!-- Agrega más campos específicos para CPU aquí -->
                            </div>

                            <!-- Sección para el tipo de equipo "CPU" -->
                            <div class="6 campos-equipo mb-3" style="display: none;">
                                <div class="mb-3">
                                    <label class="form-label" for="marca_monitor">Marca del monitor</label>
                                    <div class="input-group input-group-merge">
                                        <x-text-input type="text" class="form-control" id="marca_monitor"  name="marca_monitor" aria-describedby="basic-icon-default-fullname2" autocomplete="marca_monitor" />
                                        <x-input-error :messages="$errors->get('marca_monitor')" class="mt-2" />
                                    </div>

                                    <label class="form-label" for="modelo_monitor">Modelo del monitor</label>
                                    <div class="input-group input-group-merge">
                                        <x-text-input type="text" class="form-control" id="modelo_monitor"  name="modelo_monitor" aria-describedby="basic-icon-default-fullname2" autocomplete="modelo_monitor" />
                                        <x-input-error :messages="$errors->get('modelo_monitor')" class="mt-2" />
                                    </div>

                                    <label class="form-label" for="serie_monitor">Numero de serie</label>
                                    <div class="input-group input-group-merge">
                                        <x-text-input type="text" class="form-control" id="modelo_equipo"  name="serie_monitor" aria-describedby="basic-icon-default-fullname2" autocomplete="serie_monitor" />
                                        <x-input-error :messages="$errors->get('serie_monitor')" class="mt-2" />
                                    </div>

                                    <label class="form-label" for="no_contrato">Numero de contrato</label>
                                    <div class="input-group input-group-merge">
                                        <x-text-input type="text" class="form-control" id="no_contrato"  name="no_contrato" aria-describedby="basic-icon-default-fullname2" autocomplete="name" />
                                        <x-input-error :messages="$errors->get('no_contrato')" class="mt-2" />
                                    </div>
                                </div>
                                <!-- Agrega más campos específicos para CPU aquí -->
                            </div>
                        
                            <!-- Sección para el tipo de equipo "Teclado" -->
                            <div class="12 campos-equipo mb-3" style="display: none;">
                                <div class="mb-3">
                                    <label class="form-label" for="marca_teclado">Marca del teclado</label>
                                    <div class="input-group input-group-merge">
                                        <x-text-input type="text" class="form-control" id="marca_teclado"  name="marca_teclado" aria-describedby="basic-icon-default-fullname2" autocomplete="marca_teclado" />
                                        <x-input-error :messages="$errors->get('marca_teclado')" class="mt-2" />
                                    </div>

                                    <label class="form-label" for="serie_teclado">Numero de Serie</label>
                                    <div class="input-group input-group-merge">
                                        <x-text-input type="text" class="form-control" id="serie_teclado"  name="serie_teclado" aria-describedby="basic-icon-default-fullname2" autocomplete="serie_teclado" />
                                        <x-input-error :messages="$errors->get('serie_teclado')" class="mt-2" />
                                    </div>
                                </div>
                                <!-- Agrega más campos específicos para teclado aquí -->
                            </div>

                            <!-- Sección para el tipo de equipo "Mouse" -->
                            <div class="7 campos-equipo" style="display: none;">
                                <div class="mb-3">
                                    <label class="form-label" for="marca_mouse">Marca del mouse</label>
                                    <div class="input-group input-group-merge">
                                        <x-text-input type="text" class="form-control" id="marca_mouse"  name="marca_mouse" aria-describedby="basic-icon-default-fullname2" autocomplete="marca_mouse" />
                                        <x-input-error :messages="$errors->get('marca_mouse')" class="mt-2" />
                                    </div>

                                    <label class="form-label" for="serie_mouse">Numero de Serie</label>
                                    <div class="input-group input-group-merge">
                                        <x-text-input type="text" class="form-control" id="serie_mouse"  name="serie_mouse" aria-describedby="basic-icon-default-fullname2" autocomplete="serie_mouse" />
                                        <x-input-error :messages="$errors->get('serie_mouse')" class="mt-2" />
                                    </div>
                                </div>
                                <!-- Agrega más campos específicos para teclado aquí -->
                            </div>

                            <!-- Sección para el tipo de equipo "Cargador" -->
                            <div class="2 campos-equipo" style="display: none;">
                                <div class="mb-3">
                                    <label class="form-label" for="marca_cargador">Marca del cargador</label>
                                    <div class="input-group input-group-merge">
                                        <x-text-input type="text" class="form-control" id="marca_cargador"  name="marca_cargador" aria-describedby="basic-icon-default-fullname2" autocomplete="marca_cargador" />
                                        <x-input-error :messages="$errors->get('marca_cargador')" class="mt-2" />
                                    </div>

                                    <label class="form-label" for="modelo_cargador">Modelo del cargador</label>
                                    <div class="input-group input-group-merge">
                                        <x-text-input type="text" class="form-control" id="modelo_cargador"  name="modelo_cargador" aria-describedby="basic-icon-default-fullname2" autocomplete="modelo_cargador" />
                                        <x-input-error :messages="$errors->get('modelo_cargador')" class="mt-2" />
                                    </div>

                                    <label class="form-label" for="serie_cargador">Numero de Serie</label>
                                    <div class="input-group input-group-merge">
                                        <x-text-input type="text" class="form-control" id="serie_cargador"  name="serie_cargador" aria-describedby="basic-icon-default-fullname2" autocomplete="serie_cargador" />
                                        <x-input-error :messages="$errors->get('serie_cargador')" class="mt-2" />
                                    </div>
                                </div>
                                <!-- Agrega más campos específicos para teclado aquí -->
                            </div>

                            <!-- Sección para el tipo de equipo "No breack" -->
                            <div class="8 campos-equipo" style="display: none;">
                                <div class="mb-3">
                                    <label class="form-label" for="marca_breack">Marca del No-Breack</label>
                                    <div class="input-group input-group-merge">
                                        <x-text-input type="text" class="form-control" id="marca_breack"  name="marca_breack" aria-describedby="basic-icon-default-fullname2" autocomplete="marca_breack" />
                                        <x-input-error :messages="$errors->get('marca_breack')" class="mt-2" />
                                    </div>

                                    <label class="form-label" for="modelo_breack">Modelo del No-Breack</label>
                                    <div class="input-group input-group-merge">
                                        <x-text-input type="text" class="form-control" id="modelo_breack"  name="modelo_breack" aria-describedby="basic-icon-default-fullname2" autocomplete="modelo_breack" />
                                        <x-input-error :messages="$errors->get('modelo_breack')" class="mt-2" />
                                    </div>

                                    <label class="form-label" for="serie_breack">Numero de Serie</label>
                                    <div class="input-group input-group-merge">
                                        <x-text-input type="text" class="form-control" id="serie_breack"  name="serie_breack" aria-describedby="basic-icon-default-fullname2" autocomplete="serie_breack" />
                                        <x-input-error :messages="$errors->get('serie_breack')" class="mt-2" />
                                    </div>
                                </div>
                                <!-- Agrega más campos específicos para teclado aquí -->
                            </div>

                            <!-- Sección para el tipo de equipo "Impresora" -->
                            <div class="4 campos-equipo" style="display: none;">
                                <div class="mb-3">
                                    <label class="form-label" for="marca_impresora">Marca de la impresora</label>
                                    <div class="input-group input-group-merge">
                                        <x-text-input type="text" class="form-control" id="marca_impresora"  name="marca_impresora" aria-describedby="basic-icon-default-fullname2" autocomplete="marca_impresora" />
                                        <x-input-error :messages="$errors->get('marca_impresora')" class="mt-2" />
                                    </div>

                                    <label class="form-label" for="modelo_impresora">Modelo de la impresora</label>
                                    <div class="input-group input-group-merge">
                                        <x-text-input type="text" class="form-control" id="modelo_impresora"  name="modelo_impresora" aria-describedby="basic-icon-default-fullname2" autocomplete="modelo_impresora" />
                                        <x-input-error :messages="$errors->get('modelo_impresora')" class="mt-2" />
                                    </div>

                                    <label class="form-label" for="serie_impresora">Numero de Serie</label>
                                    <div class="input-group input-group-merge">
                                        <x-text-input type="text" class="form-control" id="serie_breack"  name="serie_impresora" aria-describedby="basic-icon-default-fullname2" autocomplete="serie_impresora" />
                                        <x-input-error :messages="$errors->get('serie_impresora')" class="mt-2" />
                                    </div>
                                </div>
                                <!-- Agrega más campos específicos para teclado aquí -->
                            </div>

                            <!-- Sección para el tipo de equipo "Lector" -->
                            <div class="5 campos-equipo" style="display: none;">
                                <div class="mb-3">
                                    <label class="form-label" for="marca_lector">Marca del lector</label>
                                    <div class="input-group input-group-merge">
                                        <x-text-input type="text" class="form-control" id="marca_lector"  name="marca_lector" aria-describedby="basic-icon-default-fullname2" autocomplete="marca_lector" />
                                        <x-input-error :messages="$errors->get('marca_lector')" class="mt-2" />
                                    </div>

                                    <label class="form-label" for="modelo_lector">Modelo del lector</label>
                                    <div class="input-group input-group-merge">
                                        <x-text-input type="text" class="form-control" id="modelo_lector"  name="modelo_lector" aria-describedby="basic-icon-default-fullname2" autocomplete="modelo_lector" />
                                        <x-input-error :messages="$errors->get('modelo_lector')" class="mt-2" />
                                    </div>

                                    <label class="form-label" for="serie_lector">Numero de Serie</label>
                                    <div class="input-group input-group-merge">
                                        <x-text-input type="text" class="form-control" id="serie_breack"  name="serie_lector" aria-describedby="basic-icon-default-fullname2" autocomplete="serie_lector" />
                                        <x-input-error :messages="$errors->get('serie_lector')" class="mt-2" />
                                    </div>
                                </div>
                                <!-- Agrega más campos específicos para teclado aquí -->
                            </div>

                            <!-- Sección para el tipo de equipo "Scanner" -->
                            <div class="10 campos-equipo" style="display: none;">
                                <div class="mb-3">
                                    <label class="form-label" for="marca_escanner">Marca del escanner</label>
                                    <div class="input-group input-group-merge">
                                        <x-text-input type="text" class="form-control" id="marca_escanner"  name="marca_escanner" aria-describedby="basic-icon-default-fullname2" autocomplete="marca_escanner" />
                                        <x-input-error :messages="$errors->get('marca_escanner')" class="mt-2" />
                                    </div>

                                    <label class="form-label" for="modelo_escanner">Modelo del escanner</label>
                                    <div class="input-group input-group-merge">
                                        <x-text-input type="text" class="form-control" id="modelo_escanner"  name="modelo_escanner" aria-describedby="basic-icon-default-fullname2" autocomplete="modelo_escanner" />
                                        <x-input-error :messages="$errors->get('modelo_escanner')" class="mt-2" />
                                    </div>

                                    <label class="form-label" for="serie_escanner">Numero de Serie</label>
                                    <div class="input-group input-group-merge">
                                        <x-text-input type="text" class="form-control" id="serie_escanner"  name="serie_escanner" aria-describedby="basic-icon-default-fullname2" autocomplete="serie_escanner" />
                                        <x-input-error :messages="$errors->get('serie_escanner')" class="mt-2" />
                                    </div>
                                </div>
                                <!-- Agrega más campos específicos para teclado aquí -->
                            </div>

                            <!-- Sección para el tipo de equipo "Aplicacion" -->
                            <div class="1 campos-equipo" style="display: none;">
                                <div class="mb-3">
                                    <label class="form-label" for="nombre_app">Nombre de la aplicacion</label>
                                    <div class="input-group input-group-merge">
                                        <x-text-input type="text" class="form-control" id="nombre_app"  name="nombre_app" aria-describedby="basic-icon-default-fullname2" autocomplete="nombre_app" />
                                        <x-input-error :messages="$errors->get('nombre_app')" class="mt-2" />
                                    </div>

                                    <label class="form-label" for="clave_app">Clave de activacion</label>
                                    <div class="input-group input-group-merge">
                                        <x-text-input type="text" class="form-control" id="clave_app"  name="clave_app" aria-describedby="basic-icon-default-fullname2" autocomplete="clave_app" />
                                        <x-input-error :messages="$errors->get('clave_app')" class="mt-2" />
                                    </div>
                                </div>
                                <!-- Agrega más campos específicos para teclado aquí -->
                            </div>

                            <!-- Sección para el tipo de equipo "SO" -->
                            <div class="11 campos-equipo" style="display: none;">
                                <div class="mb-3">
                                    <label class="form-label" for="so">Sistema Operativo</label>
                                    <div class="input-group input-group-merge">
                                        <x-text-input type="text" class="form-control" id="so"  name="so" aria-describedby="basic-icon-default-fullname2" autocomplete="so" />
                                        <x-input-error :messages="$errors->get('so')" class="mt-2" />
                                    </div>

                                    <label class="form-label" for="clave_so">Clave de activacion</label>
                                    <div class="input-group input-group-merge">
                                        <x-text-input type="text" class="form-control" id="clave_so"  name="clave_so" aria-describedby="basic-icon-default-fullname2" autocomplete="clave_so" />
                                        <x-input-error :messages="$errors->get('clave_so')" class="mt-2" />
                                    </div>
                                </div>
                                <!-- Agrega más campos específicos para teclado aquí -->
                            </div>

                            <!-- Sección para el tipo de equipo "Office" -->
                            <div class="9 campos-equipo" style="display: none;">
                                <div class="mb-3">
                                    <label class="form-label" for="office">Paqueteria Office</label>
                                    <div class="input-group input-group-merge">
                                        <x-text-input type="text" class="form-control" id="office"  name="office" aria-describedby="basic-icon-default-fullname2" autocomplete="office" />
                                        <x-input-error :messages="$errors->get('office')" class="mt-2" />
                                    </div>

                                    <label class="form-label" for="clave_office">Clave de activacion</label>
                                    <div class="input-group input-group-merge">
                                        <x-text-input type="text" class="form-control" id="clave_office"  name="clave_office" aria-describedby="basic-icon-default-fullname2" autocomplete="clave_office" />
                                        <x-input-error :messages="$errors->get('clave_office')" class="mt-2" />
                                    </div>
                                </div>
                                <!-- Agrega más campos específicos para teclado aquí -->
                            </div>
                        
                            <!-- Agrega más secciones para otros tipos de equipo aquí -->
                            <br>
                            <button type="submit" class="btn btn-primary">Guardar Equipo</button>
                        </form-->
                        
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
            $('#tipo_id').change(function() {
                var selectedTipo = $(this).val();
    
                // Oculta todas las secciones de tipo de equipo
                $('.campos-equipo').hide();
    
                // Muestra la sección correspondiente al tipo seleccionado
                $('.' + selectedTipo).show();
            });
        });
    </script>

</x-app-layout>