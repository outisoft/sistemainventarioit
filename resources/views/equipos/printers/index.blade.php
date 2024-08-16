<x-app-layout>
    <div class="content-wrapper">
        <!-- Content -->

        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Impresoras /</span> Listado </h4>

            <!-- Basic Bootstrap Table -->
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-header">Listado de Impresoras</h5>
                    <div class="navbar-nav align-items-center">
                        <div class="nav-item d-flex align-items-center">
                                <a href="{{ route('equipo.create') }}" class="btn-ico" data-toggle="tooltip"
                                    data-placement="top" title="Agregar Nuevo Registro">
                                    <i class='bx bx-add-to-queue icon-lg'></i>
                                </a>
                        </div>
                    </div>
                </div>

                <div class="table-responsive text-nowrap" id="searchResults">
                    <table id="tabla" class="table">
                            <thead class="bg-primary">
                                <tr>
                                    <th>Marca</th>
                                    <th>Modelo</th>
                                    <th>Estado</th>
                                    <th>Acciones</th>
                                    <!-- Otros encabezados de columnas según sea necesario -->
                                </tr>
                            </thead>
                            <tbody id="employeeList">
                        </tbody>
                    </table>
                </div>
            </div>
            <!--/ Basic Bootstrap Table -->
        </div>
        <!-- / Content -->
    </div>
</x-app-layout>
