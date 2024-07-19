<x-app-layout>
    @section('css')
        <link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    @endsection

    <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Equipos /</span> PC's & Laptops </h4>

            <!-- Basic Bootstrap Table -->
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-header">PC's & Laptops</h5>
                    <div class="navbar-nav align-items-center">
                        <div class="nav-item d-flex align-items-center">
                            <a href="#" class="btn-ico" data-toggle="modal" data-target="#modalCreate"
                                data-placement="top" title="Agregar Nuevo Registro">
                                <i class='bx bx-add-to-queue icon-lg'></i>
                            </a>
                        </div>
                    </div>
                </div>

                @include('pc.create')
                <div class="content-wrapper">
                    <div class="table-responsive text-nowrap">
                        <div class="card-datatable table-responsive pt-0">
                            <div class="table-responsive text-nowrap" id="searchResults">
                                @if ($pcs->isEmpty())
                                    <h5 class="card-header">No se encontro registro de licencias 365.</h5>
                                @else
                                    <table id="tabla" class="table footer">
                                        <thead class="bg-primary">
                                            <tr>
                                                <th>Tipo</th>
                                                <th>Marca</th>
                                                <th>Modelo</th>
                                                <th>Numero de serie</th>
                                                <th>Empleado</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody id="licensesList">
                                            <!-- Aquí se mostrarán las licenias -->
                                            @foreach($pcs as $pc)
                                            <tr>
                                                <td>{{ $pc->tipo }}</td>
                                                <td>{{ $pc->marca }}</td>
                                                <td>{{ $pc->modelo }}</td>
                                                <td>{{ $pc->numero_serie }}</td>

                                                <td>{{ $pc->empleado ? $pc->empleado->name : 'Sin asignar' }}</td>
                                                <td>
                                                    <div class="dropdown">
                                                        <button type="button"
                                                            class="btn p-0 dropdown-toggle hide-arrow"
                                                            data-bs-toggle="dropdown">
                                                            <i class="bx bx-dots-vertical-rounded"></i>
                                                        </button>
                                                        <div class="dropdown-menu">
                                                            <!-- Aquí se agregarán las opciones -->
                                                            @can('licenses.show')
                                                                <a class="dropdown-item"
                                                                    href="{{ route('pc.show', $pc->id) }}"><i
                                                                        class="bx bx-show-alt me-1"></i>Ver</a>
                                                            @endcan

                                                            @can('licenses.edit')
                                                                <a class="dropdown-item"
                                                                    href="{{ route('pc.edit', $pc->id) }}"><i
                                                                        class="bx bx-edit me-1"></i>Editar</a>
                                                            @endcan

                                                            @can('licenses.destroy')
                                                                <form
                                                                    action="{{ route('pc.destroy', $pc->id) }}"
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
