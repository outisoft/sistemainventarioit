<x-app-layout>
    @section('css')
        <link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    @endsection
    <div class="content-wrapper">
        <!-- Content -->

        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Equipments /</span> List </h4>

            <!-- Basic Bootstrap Table -->
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-header">Equipment list</h5>
                    <!--div class="navbar-nav align-items-center">
                        <div class="nav-item d-flex align-items-center">
                            @can('equipo.create')
    <a href="{{ route('equipo.create') }}" class="btn-ico" data-toggle="tooltip"
                                                                            data-placement="top" title="Agregar Nuevo Registro">
                                                                            <i class='bx bx-add-to-queue icon-lg'></i>
                                                                        </a>
@endcan
                        </div>
                    </div-->
                </div>

                <div class="table-responsive text-nowrap" id="searchResults">
                    <table id="tabla" class="table">
                        <thead class="bg-primary">
                            <tr>
                                <th>Type</th>
                                <th>Brand</th>
                                <th>Model</th>
                                <th>Serial</th>
                                <th>Status</th>
                                @can('details')
                                    <th></th>
                                @endcan
                                <!--th>Acciones</th-->
                                <!-- Otros encabezados de columnas según sea necesario -->
                            </tr>
                        </thead>
                        <tbody id="employeeList">
                            @foreach ($equipos as $equipo)
                                <tr>
                                    <td>{{ $equipo->tipo->name }}</td>
                                    <td>{{ $equipo->marca }}</td>
                                    <td>{{ $equipo->model }}</td>
                                    <td>{{ $equipo->serial }}</td>
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

                            @can('details')
                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                            data-bs-toggle="dropdown">
                                            <i class="bx bx-dots-vertical-rounded"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="{{ route('details', $equipo->id) }}"><i
                                                    class="bx bx-show-alt me-1"></i>Show
                                            </a>
                                        </div>
                                    </div>
                                </td>
                            @endcan
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
