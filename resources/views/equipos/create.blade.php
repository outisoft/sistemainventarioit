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
                                            <select id="tipo_id" name="tipo_id" class="form-control"
                                                aria-label="Default select example">
                                                <option value="">Seleccione una opcion</option>
                                                @foreach ($tipos as $tipo)
                                                    <option value="{{ $tipo->id }}">{{ $tipo->name }}</option>
                                                @endforeach
                                            </select>

                                        </div>
                                    </div>

                                    <!-- Sección para el tipo de equipo "Aplicacion" -->
                                    @include('equipos.partials.aplicacion')

                                    <!-- Sección para el tipo de equipo "Cargador" -->
                                    @include('equipos.partials.cargador')

                                    <!-- Sección para el tipo de equipo "CPU" -->
                                    @include('equipos.partials.cpu')

                                    <!-- Sección para el tipo de equipo "Impresora" -->
                                    @include('equipos.partials.impresora')

                                    <!-- Sección para el tipo de equipo "LAPTOP" -->
                                    @include('equipos.partials.laptop')

                                    <!-- Sección para el tipo de equipo "Lector" -->
                                    @include('equipos.partials.lector')

                                    <!-- Sección para el tipo de equipo "MONITOR" -->
                                    @include('equipos.partials.monitor')

                                    <!-- Sección para el tipo de equipo "Mouse" -->
                                    @include('equipos.partials.mouse')

                                    <!-- Sección para el tipo de equipo "No breack" -->
                                    @include('equipos.partials.no-breack')

                                    <!-- Sección para el tipo de equipo "Office" -->
                                    @include('equipos.partials.office')

                                    <!-- Sección para el tipo de equipo "Scanner" -->
                                    @include('equipos.partials.scanner')

                                    <!-- Sección para el tipo de equipo "SO" -->
                                    @include('equipos.partials.so')

                                    <!-- Sección para el tipo de equipo "Teclado" -->
                                    @include('equipos.partials.teclado')

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
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script>
        $(document).ready(function() {
            $('select[name="tipo_id"]').change(function() {
                var selectedTipo = $(this).val();

                // Oculta todos los formularios
                $('.campos-equipo').hide();

                // Muestra el formulario correspondiente al tipo seleccionado
                $('.formulario-' + selectedTipo).show();
            });
        });
    </script>

</x-app-layout>
