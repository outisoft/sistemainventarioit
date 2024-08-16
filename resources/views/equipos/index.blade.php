<x-app-layout>
    @section('css')
        <link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    @endsection
    <div class="content-wrapper">
        <!-- Content -->

        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Equipos /</span> Listado </h4>

            <!-- Basic Bootstrap Table -->
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-header">Listado de Equipos</h5>
                    <div class="navbar-nav align-items-center">
                        <div class="nav-item d-flex align-items-center">
                            @can('equipo.create')
                                <a href="{{ route('equipo.create') }}" class="btn-ico" data-toggle="tooltip"
                                    data-placement="top" title="Agregar Nuevo Registro">
                                    <i class='bx bx-add-to-queue icon-lg'></i>
                                </a>
                            @endcan
                        </div>
                    </div>
                </div>

                <div class="table-responsive text-nowrap" id="searchResults">
                    <table id="tabla" class="table">
                            <thead class="bg-primary">
                                <tr>
                                    <th>Tipo</th>
                                    <th>Marca</th>
                                    <th>Modelo</th>
                                    <th>Nombre de equipo</th>
                                    <th>Estado</th>
                                    <th>Acciones</th>
                                    <!-- Otros encabezados de columnas según sea necesario -->
                                </tr>
                            </thead>
                            <tbody id="employeeList">
                                @foreach ($equipos as $equipo)
                                    <tr>
                                        <td>{{ $equipo->tipo->name }}</td>
                                        <td>{{ $equipo->marca }}</td>
                                        <td>{{ $equipo->model }}</td>
                                        <td>{{ $equipo->name }}</td>
                                        <td>
                                            @if ($equipo->estado === 'Libre')
                                                <span class="badge bg-label-success">{{ $equipo->estado }}</span>
                                                </td>
                                                <!--span class="badge rounded-pill bg-success">Libre</span-->
                                            @elseif ($equipo->estado === 'En Uso')
                                                <span class="badge bg-label-danger">{{ $equipo->estado }}</span>
                                                <!--span class="badge rounded-pill bg-danger">En uso</span-->
                                            @endif
                                        </td>
                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                            data-bs-toggle="dropdown">
                                            <i class="bx bx-dots-vertical-rounded"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <!-- Aquí se agregarán las opciones -->
                                            @can('equipo.show')
                                                <a class="dropdown-item" href="{{ route('equipo.show', $equipo->id) }}"><i
                                                        class="bx bx-show-alt me-1"></i>Ver</a>
                                            @endcan

                                            @can('equipo.edit')
                                                <a class="dropdown-item" href="{{ route('equipo.edit', $equipo->id) }}"><i
                                                        class="bx bx-edit me-1"></i>Editar</a>
                                            @endcan

                                            @can('equipo.destroy')
                                                <form action="{{ route('equipo.destroy', $equipo->id) }}" method="POST">
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
                                <!-- Otros campos de la tabla -->
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
