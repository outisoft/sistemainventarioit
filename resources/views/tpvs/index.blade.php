<x-app-layout>
    <!-- Modal de creacion -->
    @include('tpvs.create')
    <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Tpv's /</span> Listado </h4>

            <!-- Basic Bootstrap Table -->
            <div class="card">
                @can('tpvs.create')
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
                @endcan
                <div class="content-wrapper">
                    <div class="table-responsive text-nowrap">
                        <div class="card-datatable table-responsive pt-0">
                            <div class="table-responsive text-nowrap" id="searchResults">
                            @if ($tpvs->isEmpty())
                                    <h5 class="card-header">No se encontro registro de Tpvs.</h5>
                                @else
                                    <table id="tpvs" class="table">
                                        <thead class="bg-primary">
                                            <tr>
                                                <th>Area</th>
                                                <th>Departamento</th>
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
                                                    <td>{{ $tpv->departamento->name }}</td>
                                                    <td>{{ $tpv->hotel->name }}</td>
                                                    <td>{{ $tpv->equipment }}</td>
                                                    <td>{{ $tpv->brand }}</td>
                                                    <td>{{ $tpv->model }}</td>
                                                    <td>{{ $tpv->no_serial }}</td>
                                                    <td>{{ $tpv->name }}</td>
                                                    <td>{{ $tpv->ip }}</td>
                                                    <td>{{ Str::limit($tpv->link, 15, ' ...') }}</td>
                                                    <td>
                                                        <div class="dropdown">
                                                            <button type="button"
                                                                class="btn p-0 dropdown-toggle hide-arrow"
                                                                data-bs-toggle="dropdown">
                                                                <i class="bx bx-dots-vertical-rounded"></i>
                                                            </button>
                                                            <div class="dropdown-menu">
                                                                @can('tpvs.show')
                                                                    <a class="dropdown-item"
                                                                        href="{{ route('tpvs.show', $tpv->id) }}"><i
                                                                            class="bx bx-show-alt me-1"></i>Ver
                                                                    </a>
                                                                @endcan

                                                                @can('tpvs.edit')
                                                                    <a class="dropdown-item"
                                                                        href="{{ route('tpvs.edit', $tpv->id) }}"><i
                                                                            class="bx bx-edit me-1"></i>Editar
                                                                    </a>
                                                                @endcan

                                                                @can('tpvs.destroy')
                                                                <form action="{{ route('tpvs.destroy', $tpv->id) }}"
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


