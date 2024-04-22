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
    @include('tpvs.create')
    <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Tpv's /</span> Listado </h4>

            <!-- Basic Bootstrap Table -->
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-header">Listado de Tpv's</h5>
                    <div class="navbar-nav align-items-center">
                        <div class="nav-item d-flex align-items-center">
                            <a href="#" class="btn-ico" data-bs-toggle="modal" data-bs-target="#modalToggle"
                                data-placement="top" title="Agregar Nuevo Registro">
                                <i class='bx bx-add-to-queue icon-lg'></i>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="content-wrapper">
                    <div class="table-responsive text-nowrap">
                        <div class="card-datatable table-responsive pt-0">
                            <div class="table-responsive text-nowrap" id="searchResults">
                            @if ($tpvs->isEmpty())
                                    <h5 class="card-header">No se encontro registro de Tpvs.</h5>
                                @else
                                    <table id="usuarios" class="table">
                                        <thead class="bg-primary">
                                            <tr>
                                                <th>Area</th>
                                                <th>Hotel</th>
                                                <th>Equipo</th>
                                                <th>Marca</th>
                                                <th>Modelo</th>
                                                <th>Numero de serie</th>
                                                <th>Nombre</th>
                                                <th>IP</th>
                                                <th>Link</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody id="employeeList">
                                            <!-- Aquí se mostrarán los empleados -->
                                            @foreach ($tpvs as $tpv)
                                                <tr>
                                                    <td>{{ $tpv->area }}</td>
                                                    <td>{{ $tpv->hotel->nombre }}</td>
                                                    <td>{{ $tpv->equipment }}</td>
                                                    <td>{{ $tpv->brand }}</td>
                                                    <td>{{ $tpv->model }}</td>
                                                    <td>{{ $tpv->no_serial }}</td>
                                                    <td>{{ $tpv->name }}</td>
                                                    <td>{{ $tpv->ip }}</td>
                                                    <td>{{ $tpv->link }}</td>
                                                    <td>
                                                        <div class="dropdown">
                                                            <button type="button"
                                                                class="btn p-0 dropdown-toggle hide-arrow"
                                                                data-bs-toggle="dropdown">
                                                                <i class="bx bx-dots-vertical-rounded"></i>
                                                            </button>
                                                            <div class="dropdown-menu">
                                                                
                                                                <a class="dropdown-item"
                                                                    href="{{ route('tpvs.show', $tpv->id) }}"><i
                                                                        class="bx bx-show-alt me-1"></i>Ver
                                                                </a>

                                                                <a class="dropdown-item"
                                                                    href="{{ route('tpvs.edit', $tpv->id) }}"><i
                                                                        class="bx bx-edit me-1"></i>Editar
                                                                </a>

                                                                <form action="{{ route('tpvs.destroy', $tpv->id) }}"
                                                                    method="POST">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit"
                                                                        class="dropdown-item btn-danger"
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

