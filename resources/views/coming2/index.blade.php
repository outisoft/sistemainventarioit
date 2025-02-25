<x-app-layout>
    <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-style1">
                    <li class="breadcrumb-item active fw-bold">COMING2</li>
                </ol>
            </nav>

            <!-- Basic Bootstrap Table -->
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-header">Tablet's List</h5>
                    @can('coming2.create')
                        <div class="navbar-nav align-items-center">
                            <div class="nav-item d-flex align-items-center">
                                <a href="{{ route('co2.trashed') }}" class="btn-ico">
                                    <i class="bx bx-trash icon-lg" data-bs-toggle="tooltip" data-popup="tooltip-custom"
                                        data-bs-placement="top" class="assigned-item" aria-label="Papelera"
                                        data-bs-original-title="Papelera"></i>
                                </a>
                                <a href="#" class="btn-ico" data-bs-toggle="modal" data-bs-target="#modalToggle">
                                    <i class="bx bx-add-to-queue icon-lg" data-bs-toggle="tooltip"
                                        data-popup="tooltip-custom" data-bs-placement="top" class="assigned-item"
                                        aria-label="Nuevo registro" data-bs-original-title="Nuevo registro"></i>
                                </a>
                            </div>
                        </div>
                    @endcan
                </div>
                <!-- Modal de creacion -->
                @include('coming2.create')
                <div class="content-wrapper">
                    <div class="table-responsive text-nowrap">
                        <div class="card-datatable table-responsive pt-0">
                            <div class="table-responsive text-nowrap" id="searchResults">
                                <table id="tabletas" class="table">
                                    <thead class="bg-primary">
                                        <tr>
                                            <th>Responsable</th>
                                            <th>Puesto</th>
                                            <th>Email</th>
                                            <th>Usuario</th>
                                            <th>Contraseña</th>
                                            <th>No. de tableta</th>
                                            <th>Modelo</th>
                                            <th>No. de serie</th>
                                            <th>Numero de telefono</th>
                                            <th>IMEI</th>
                                            <th>SIM</th>
                                            <th>Politica</th>
                                            <th>¿Esta configurada?</th>
                                            <th>¿Carta Firmada?</th>
                                            <th>Folio de baja</th>
                                            <th>Observacion</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody id="employeeList">
                                        <!-- Aquí se mostrarán los empleados -->
                                        @foreach ($tablets as $tablet)
                                            <tr>
                                                <td>{{ $tablet->operario }}</td>
                                                <td>{{ $tablet->puesto }}</td>
                                                <td>{{ $tablet->email }}</td>
                                                <td>{{ $tablet->usuario }}</td>
                                                <td>{{ $tablet->password }}</td>
                                                <td>{{ $tablet->numero_tableta }}</td>
                                                <td>{{ $tablet->model }}</td>
                                                <td>{{ $tablet->serial }}</td>
                                                <td>{{ $tablet->numero_telefono }}</td>
                                                <td>{{ $tablet->imei }}</td>
                                                <td>{{ $tablet->sim }}</td>
                                                <td>{{ $tablet->policies->name }}</td>
                                                <td>
                                                    @if ($tablet->configurada == '1')
                                                        <span class="badge bg-label-success">Si</span>
                                                    @else
                                                        <span class="badge bg-label-danger">No</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($tablet->carta_firmada == '1')
                                                        <span class="badge bg-label-success">Si</span>
                                                    @else
                                                        <span class="badge bg-label-danger">No</span>
                                                    @endif
                                                </td>
                                                <td>{{ $tablet->folio_baja }}</td>
                                                <td>{{ $tablet->observacion }}</td>
                                                <td>
                                                    <div class="dropdown">
                                                        <button type="button"
                                                            class="btn p-0 dropdown-toggle hide-arrow"
                                                            data-bs-toggle="dropdown">
                                                            <i class="bx bx-dots-vertical-rounded"></i>
                                                        </button>
                                                        <div class="dropdown-menu">
                                                            @can('coming2.show')
                                                                <a class="dropdown-item"
                                                                    href="{{ route('coming2.show', $tablet->id) }}"><i
                                                                        class="bx bx-show-alt me-1"></i>Ver
                                                                </a>
                                                            @endcan

                                                            @can('coming2.edit')
                                                                <a class="dropdown-item"
                                                                    href="{{ route('coming2.edit', $tablet->id) }}"><i
                                                                        class="bx bx-edit me-1"></i>Editar
                                                                </a>
                                                            @endcan

                                                            <form action="{{ route('co2.trash', $tablet->id) }}"
                                                                method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="dropdown-item btn-danger"
                                                                    onclick="return confirm('¿Estás seguro de eliminar este equipo?')"><i
                                                                        class="bx bx-trash me-1"></i>Eliminar</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
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
