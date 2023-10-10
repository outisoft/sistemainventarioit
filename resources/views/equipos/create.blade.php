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
                                    <select id="tipo" name="tipo" class="form-control"  aria-label="Default select example">
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
                            </div>

                            <!-- Sección para el tipo de equipo "CPU" -->
                            <div class="cpu campos-equipo mb-3" style="display: none;">
                                <div class="mb-3">

                                    <label class="form-label" for="no_equipo">Numero de equipo</label>
                                    <div class="input-group input-group-merge">
                                        <span id="basic-icon-default-fullname2" class="input-group-text">
                                            <i class='bx bx-hash' ></i>
                                        </span>
                                        <x-text-input type="text" class="form-control" id="no_equipo"  name="no_equipo" aria-describedby="basic-icon-default-fullname2" required autofocus autocomplete="name" />
                                        <x-input-error :messages="$errors->get('no_equipo')" class="mt-2" />
                                    </div>

                                    <!--label class="form-label" for="estado">Estado</label>
                                    <div class="input-group input-group-merge">
                                        <span id="basic-icon-default-fullname2" class="input-group-text">
                                            <i class='bx bx-broadcast'></i>
                                        </span>
                                        <x-text-input type="text" class="form-control" id="estado"  name="estado" aria-describedby="basic-icon-default-fullname2" required autocomplete="name" />
                                        <x-input-error :messages="$errors->get('estado')" class="mt-2" />
                                    </div-->

                                    <label class="form-label" for="equipo">Equipo</label>
                                    <div class="input-group input-group-merge">
                                        <span id="basic-icon-default-fullname2" class="input-group-text">
                                            <i class='bx bx-desktop'></i>
                                        </span>
                                        <x-text-input type="text" class="form-control" id="equipo"  name="equipo" aria-describedby="basic-icon-default-fullname2" required autocomplete="name" />
                                        <x-input-error :messages="$errors->get('equipo')" class="mt-2" />
                                    </div>

                                    <label class="form-label" for="marca_equipo">Marca del equipo</label>
                                    <div class="input-group input-group-merge">
                                        <span id="basic-icon-default-fullname2" class="input-group-text">
                                            <i class='bx bx-registered' ></i>
                                        </span>
                                        <x-text-input type="text" class="form-control" id="marca_equipo"  name="marca_equipo" aria-describedby="basic-icon-default-fullname2" required autocomplete="name" />
                                        <x-input-error :messages="$errors->get('marca_equipo')" class="mt-2" />
                                    </div>

                                    <label class="form-label" for="modelo_equipo">Modelo del equipo</label>
                                    <div class="input-group input-group-merge">
                                        <span id="basic-icon-default-fullname2" class="input-group-text">
                                            <i class='bx bxs-chalkboard' ></i>
                                        </span>
                                        <x-text-input type="text" class="form-control" id="modelo_equipo"  name="modelo_equipo" aria-describedby="basic-icon-default-fullname2" required autocomplete="name" />
                                        <x-input-error :messages="$errors->get('modelo_equipo')" class="mt-2" />
                                    </div>

                                    <label class="form-label" for="serie_equipo">Numero de serie</label>
                                    <div class="input-group input-group-merge">
                                        <span id="basic-icon-default-fullname2" class="input-group-text">
                                            <i class='bx bx-spreadsheet' ></i>
                                        </span>
                                        <x-text-input type="text" class="form-control" id="modelo_equipo"  name="serie_equipo" aria-describedby="basic-icon-default-fullname2" required autocomplete="name" />
                                        <x-input-error :messages="$errors->get('serie_equipo')" class="mt-2" />
                                    </div>

                                    <label class="form-label" for="nombre_equipo">Nombre del equipo</label>
                                    <div class="input-group input-group-merge">
                                        <span id="basic-icon-default-fullname2" class="input-group-text">
                                            <i class='bx bx-font-family' ></i>
                                        </span>
                                        <x-text-input type="text" class="form-control" id="nombre_equipo"  name="nombre_equipo" aria-describedby="basic-icon-default-fullname2" required autocomplete="name" />
                                        <x-input-error :messages="$errors->get('nombre_equipo')" class="mt-2" />
                                    </div>

                                    <label class="form-label" for="ip">Ip del equipo</label>
                                    <div class="input-group input-group-merge">
                                        <span id="basic-icon-default-fullname2" class="input-group-text">
                                            <i class='bx bx-broadcast'></i>
                                        </span>
                                        <x-text-input type="text" class="form-control" id="ip"  name="ip" aria-describedby="basic-icon-default-fullname2" required autocomplete="name" />
                                        <x-input-error :messages="$errors->get('ip')" class="mt-2" />
                                    </div>

                                    <label class="form-label" for="contrato">Numero de contrato</label>
                                    <div class="input-group input-group-merge">
                                        <span id="basic-icon-default-fullname2" class="input-group-text">
                                            <i class='bx bxs-book-bookmark' ></i>
                                        </span>
                                        <x-text-input type="text" class="form-control" id="contrato"  name="contrato" aria-describedby="basic-icon-default-fullname2" required autocomplete="name" />
                                        <x-input-error :messages="$errors->get('contrato')" class="mt-2" />
                                    </div>
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
                                    <label for="serie_monitor">Numero de serie</label>
                                    <input type="text" id="serie_monitor" name="serie_monitor" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="no_contrato">Numero de contrato</label>
                                    <input type="text" id="no_contrato" name="no_contrato" class="form-control">
                                </div>
                                <!-- Agrega más campos específicos para monitor aquí -->
                            </div>
                        
                            <!-- Sección para el tipo de equipo "Teclado" -->
                            <div class="teclado campos-equipo" style="display: none;">
                                <div class="form-group">
                                    <label for="marca_teclado">Marca del Teclado</label>
                                    <input type="text" id="marca_teclado" name="marca_teclado" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="serie_teclado">Numero de serie</label>
                                    <input type="text" id="serie_teclado" name="serie_teclado" class="form-control">
                                </div>
                                <!-- Agrega más campos específicos para teclado aquí -->
                            </div>

                            <!-- Sección para el tipo de equipo "Mouse" -->
                            <div class="mouse campos-equipo" style="display: none;">
                                <div class="form-group">
                                    <label for="marca_mouse">Marca del mouse</label>
                                    <input type="text" id="marca_mouse" name="marca_mouse" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="serie_mouse">Numero de serie</label>
                                    <input type="text" id="serie_mouse" name="serie_mouse" class="form-control">
                                </div>
                                <!-- Agrega más campos específicos para teclado aquí -->
                            </div>

                            <!-- Sección para el tipo de equipo "Cargador" -->
                            <div class="cargador campos-equipo" style="display: none;">
                                <div class="form-group">
                                    <label for="marca_cargador">Marca del cargador</label>
                                    <input type="text" id="marca_cargador" name="marca_cargador" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="modelo_cargador">Modelo del cargador</label>
                                    <input type="text" id="modelo_cargador" name="modelo_cargador" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="serie_cargador">Numero de serie</label>
                                    <input type="text" id="serie_cargador" name="serie_cargador" class="form-control">
                                </div>
                                <!-- Agrega más campos específicos para teclado aquí -->
                            </div>

                            <!-- Sección para el tipo de equipo "No breack" -->
                            <div class="no_breack campos-equipo" style="display: none;">
                                <div class="form-group">
                                    <label for="marca_breack">Marca del No-Breack</label>
                                    <input type="text" id="marca_breack" name="marca_breack" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="modelo_breack">Modelo del No-Breack</label>
                                    <input type="text" id="modelo_breack" name="modelo_breack" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="serie_breack">Numero de serie</label>
                                    <input type="text" id="serie_breack" name="serie_breack" class="form-control">
                                </div>
                                <!-- Agrega más campos específicos para teclado aquí -->
                            </div>

                            <!-- Sección para el tipo de equipo "Impresora" -->
                            <div class="impresora campos-equipo" style="display: none;">
                                <div class="form-group">
                                    <label for="marca_impresora">Marca de la impresora</label>
                                    <input type="text" id="marca_impresora" name="marca_impresora" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="modelo_impresora">Modelo de la impresora</label>
                                    <input type="text" id="modelo_impresora" name="modelo_impresora" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="serie_impresora">Numero de serie</label>
                                    <input type="text" id="serie_impresora" name="serie_impresora" class="form-control">
                                </div>
                                <!-- Agrega más campos específicos para teclado aquí -->
                            </div>

                            <!-- Sección para el tipo de equipo "Lector" -->
                            <div class="lector campos-equipo" style="display: none;">
                                <div class="form-group">
                                    <label for="marca_lector">Marca del lector</label>
                                    <input type="text" id="marca_lector" name="marca_lector" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="modelo_lector">Modelo del lector</label>
                                    <input type="text" id="modelo_lector" name="modelo_lector" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="serie_lector">Numero de serie</label>
                                    <input type="text" id="serie_lector" name="serie_lector" class="form-control">
                                </div>
                                <!-- Agrega más campos específicos para teclado aquí -->
                            </div>

                            <!-- Sección para el tipo de equipo "Scanner" -->
                            <div class="scanner campos-equipo" style="display: none;">
                                <div class="form-group">
                                    <label for="marca_escanner">Marca del escanner</label>
                                    <input type="text" id="marca_escanner" name="marca_escanner" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="modelo_escanner">Modelo del escanner</label>
                                    <input type="text" id="modelo_escanner" name="modelo_escanner" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="serie_escanner">Numero de serie</label>
                                    <input type="text" id="serie_escanner" name="serie_escanner" class="form-control">
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
                                    <label for="clave_app">Clave de activacion</label>
                                    <input type="text" id="clave_app" name="clave_app" class="form-control">
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
                                    <label for="clave_so">Clave de activacion</label>
                                    <input type="text" id="clave_so" name="clave_so" class="form-control">
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
                                    <label for="clave_office">Clave de activacion</label>
                                    <input type="text" id="clave_office" name="clave_office" class="form-control">
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