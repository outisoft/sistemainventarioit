<x-app-layout>
    <nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
        id="layout-navbar">
        <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
            <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                <i class="bx bx-menu bx-sm"></i>
            </a>
        </div>

        <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
            <!-- Search -->
            <div class="navbar-nav align-items-center">
            <form action="{{ route('tablet.search') }}" method="post">
                    @csrf
                    <div class="search-box nav-item d-flex align-items-center">
                        <i class="bx bx-search fs-4 lh-0"></i>
                        <input id="searchInput" type="text" name="query" class="form-control border-0 shadow-none"
                            placeholder="Search..." aria-label="Search..." />
                    </div>
                </form>
            </div>
        </div>
    </nav>
    <!-- Modal de creacion -->
    @include('tablets.create')
    <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Tablets /</span> Listado </h4>

            <!-- Basic Bootstrap Table -->
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-header">Listado de Tabletas</h5>
                @can ('tablets.create')
                    <div class="navbar-nav align-items-center">
                        <div class="nav-item d-flex align-items-center">
                            <a href="#" class="btn-ico" data-bs-toggle="modal" data-bs-target="#modalToggle"
                                data-placement="top" title="Agregar Nuevo Registro">
                                <i class='bx bx-add-to-queue icon-lg'></i>
                            </a>
                        </div>
                    </div>
                @endcan
                </div>
                <div class="content-wrapper">
                    <div class="table-responsive text-nowrap">
                        <div class="card-datatable table-responsive pt-0">
                            <div class="table-responsive text-nowrap" id="searchResults">
                                @if ($tablets->isEmpty())
                                    <h5 class="card-header">No se encontro registro de tabletas.</h5>
                                @else
                                    <table id="usuarios" class="table">
                                        <thead class="bg-primary">
                                            <tr>
                                                <th>Responsable</th>
                                                <th>Puesto</th>
                                                <th>Email</th>
                                                <th>Usuario</th>
                                                <th>Contraseña</th>
                                                <th>Numero de tableta</th>
                                                <th>NUmero de serie</th>
                                                <th>Numero de telefono</th>
                                                <th>IMEI</th>
                                                <th>SIM</th>
                                                <th>Politica aplicada</th>
                                                <th>¿ESta configurada?</th>
                                                <th>¿Carta Firmada?</th>
                                                <th>Giacode</th>
                                                <th>Personalsdscode</th>
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
                                                    <td>{{ $tablet->serial }}</td>
                                                    <td>{{ $tablet->numero_telefono }}</td>
                                                    <td>{{ $tablet->imei }}</td>
                                                    <td>{{ $tablet->sim }}</td>
                                                    <td>{{ $tablet->politica }}</td>
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
                                                    <td>{{ $tablet->giacode }}</td>
                                                    <td>{{ $tablet->personalsdscode }}</td>
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
                                                                @can ('tablets.show')
                                                                <a class="dropdown-item"
                                                                    href="{{ route('tablets.show', $tablet->id) }}"><i
                                                                        class="bx bx-show-alt me-1"></i>Ver
                                                                </a>
                                                                @endcan

                                                                @can ('tablets.edit')
                                                                <a class="dropdown-item"
                                                                    href="{{ route('tablets.edit', $tablet->id) }}"><i
                                                                        class="bx bx-edit me-1"></i>Editar
                                                                </a>
                                                                @endcan

                                                                @can ('tablets.destroy')
                                                                <form action="{{ route('tablets.destroy', $tablet->id) }}"
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
    @include('tablets.script')
</x-app-layout>

