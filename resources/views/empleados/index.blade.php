<x-app-layout>
    @section('css')
        <link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    @endsection

    <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Empleado /</span> Listado </h4>

            <!-- Basic Bootstrap Table -->
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-header">Listado de Empleados</h5>
                    <div class="navbar-nav align-items-center">
                        <div class="nav-item d-flex align-items-center">

                            @can('empleados.create')
                                <a href="#" class="btn-ico" data-toggle="modal" data-target="#modalCreate"
                                    data-placement="top" title="Agregar Nuevo Registro">
                                    <i class='bx bx-add-to-queue icon-lg'></i>
                                </a>
                            @endcan

                        </div>
                    </div>
                </div>
                @include('empleados.create')

                <div class="content-wrapper">
                    <div class="table-responsive text-nowrap">
                        <div class="card-datatable table-responsive pt-0">
                            <div class="table-responsive text-nowrap" id="searchResults">
                                @if ($empleados->isEmpty())
                                    <h5 class="card-header">No se encontro registro de empleados.</h5>
                                @else
                                    <table id="tabla" class="table footer">
                                        <thead class="bg-primary">
                                            <tr>
                                                <th>Nombre</th>
                                                <th>Puesto</th>
                                                <th>Hotel</th>
                                                <th>Departamento</th>
                                                <th>AD</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody id="employeeList">
                                            <!-- Aquí se mostrarán los empleados -->
                                            @foreach ($empleados as $empleado)
                                                <tr>
                                                    <td>{{ Str::limit($empleado->name, 20, ' ...') }}</td>
                                                    <td>{{ Str::limit($empleado->puesto, 20, ' ...') }}</td>
                                                    <td>{{ $empleado->hotel->name }}</td>
                                                    <td>{{ $empleado->departamento->name }}</td>
                                                    <!--td>{{ $empleado->equipo?->tipo ?? 'Sin equipo asignado' }}</td-->
                                                    <td>{{ $empleado->ad }}</td>
                                                    <td>
                                                        <div class="dropdown">
                                                            <button type="button"
                                                                class="btn p-0 dropdown-toggle hide-arrow"
                                                                data-bs-toggle="dropdown">
                                                                <i class="bx bx-dots-vertical-rounded"></i>
                                                            </button>
                                                            <div class="dropdown-menu">

                                                                <a href="{{ route('empleados.equipos', $empleado->id) }}" class="dropdown-item">Ver Equipos</a>
                                                                <!-- Aquí se agregarán las opciones -->
                                                                @can('empleados.show')
                                                                    <a class="dropdown-item"
                                                                        href="{{ route('empleados.show', $empleado->id) }}"><i
                                                                            class="bx bx-show-alt me-1"></i>Ver</a>
                                                                @endcan

                                                                @can('empleados.edit')
                                                                    <a class="dropdown-item"
                                                                        href="{{ route('empleados.edit', $empleado->id) }}"><i
                                                                            class="bx bx-edit me-1"></i>Editar</a>
                                                                @endcan

                                                                @can('empleados.destroy')
                                                                    <form
                                                                        action="{{ route('empleados.destroy', $empleado->id) }}"
                                                                        method="POST">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <button type="submit"
                                                                            class="dropdown-item btn-danger"
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
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--/ Basic Bootstrap Table -->
        </div>
        <!-- / Content -->
    </div>
</x-app-layout>

