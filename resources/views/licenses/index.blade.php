<x-app-layout>
    @section('css')
        <link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    @endsection

    @include('licenses.create')
    <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Equipos /</span> Office 365 </h4>

            <!-- Basic Bootstrap Table -->
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-header">Licencias office 365</h5>
                    <div class="navbar-nav align-items-center">
                        <div class="nav-item d-flex align-items-center">
                            <a href="#" class="btn-ico" data-toggle="modal" data-target="#modalCreate"
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
                                @if ($licenses->isEmpty())
                                    <h5 class="card-header">No se encontro registro de licencias 365.</h5>
                                @else
                                    <table id="tabla" class="table footer">
                                        <thead class="bg-primary">
                                            <tr>
                                                <th>Producto</th>
                                                <th>Password</th>
                                                <th>Licencias Disponibles</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody id="licensesList">
                                            <!-- Aquí se mostrarán las licenias -->
                                            @foreach($licenses as $license)
                                            <tr>
                                                <td>{{ $license->product_name }}</td>
                                                <td>{{ $license->password }}</td>
                                                <td>{{ $license->remaining_licenses }} de {{ $license->total_licenses }}</td>
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
                                                                    href="{{ route('licenses.show', $license->id) }}"><i
                                                                        class="bx bx-show-alt me-1"></i>Ver</a>
                                                            @endcan

                                                            @can('licenses.edit')
                                                                <a class="dropdown-item"
                                                                    href="{{ route('licenses.edit', $license->id) }}"><i
                                                                        class="bx bx-edit me-1"></i>Editar</a>
                                                            @endcan

                                                            @can('licenses.destroy')
                                                                <form
                                                                    action="{{ route('licenses.destroy', $license->id) }}"
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
