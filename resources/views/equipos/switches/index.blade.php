<x-app-layout>
    <div class="content-wrapper">
        <!-- Content -->

        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"> Equipos /</span> Switches </h4>

            <!-- Basic Bootstrap Table -->
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-header">Listado de switches</h5>
                    <div class="navbar-nav align-items-center">
                        <div class="nav-item d-flex align-items-center">
                            @can('switches.create')
                                <a href="#" class="btn-ico" data-toggle="modal" data-target="#modalCreate"
                                    data-placement="top" title="Agregar Nuevo Registro">
                                    <i class='bx bx-add-to-queue icon-lg'></i>
                                </a>
                            @endcan
                        </div>
                    </div>
                </div>
                @include('equipos.switches.create')
                @include('equipos.switches.edit')

                <div class="table-responsive text-nowrap" id="searchResults">
                    <table id="switchs" class="table">
                        <thead class="bg-primary">
                            <tr>
                                <th>Nombre</th>
                                <th>Detalles del SW</th>
                                <th>IP</th>
                                <th>MAC</th>
                                <th>Ubicación</th>
                                <th>Observaciones</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody id="employeeList">
                            @foreach($switches as $switch)
                                <tr>
                                    <td>{{ $switch->name }} ({{ $switch->total_ports }} puertos)</td>
                                    <td>{{ $switch->marca}} / {{ $switch->model }} / {{ $switch->serial }}</td>
                                    <td>{{ $switch->ip }}</td>
                                    <td>{{ $switch->mac }}</td>
                                    <td>{{ $switch->hotel->name }}</td>
                                    <td>{{ $switch->observacion }}</td>
                                    <td>
                                        <div class="dropdown">
                                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                data-bs-toggle="dropdown">
                                                <i class="bx bx-dots-vertical-rounded"></i>
                                            </button>
                                            <div class="dropdown-menu">
                                                <!-- Aquí se agregarán las opciones -->
                                                @can('switches.edit')
                                                    <a href="#" data-bs-toggle="modal" data-bs-target="#editModal{{ $switch->id }}" class="dropdown-item"><i class="bx bx-edit me-1"></i>Editar</a>
                                                @endcan

                                                @can('switches.destroy')
                                                    <form action="{{ route('switches.destroy', $switch->id) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="dropdown-item btn-danger"
                                                            onclick="return confirm('¿Estás seguro de eliminar este equipo?')"><i
                                                                class="bx bx-trash me-1"></i>Eliminar</button>
                                                    </form>
                                                @endcan
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <!--/ Basic Bootstrap Table -->
        </div>
        <!-- / Content -->
    </div>
</x-app-layout>
