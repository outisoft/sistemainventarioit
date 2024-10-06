<x-app-layout>
    <div class="content-wrapper">
        <!-- Content -->

        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"> Equipos /</span> Access Point </h4>

            <!-- Basic Bootstrap Table -->
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-header">Listado de AP's</h5>
                    <div class="navbar-nav align-items-center">
                        <div class="nav-item d-flex align-items-center">

                            @can('access_points.create')
                                <a href="#" class="btn-ico" data-toggle="modal" data-target="#createModal"
                                    data-placement="top" title="Agregar Nuevo Registro">
                                    <i class='bx bx-add-to-queue icon-lg'></i>
                                </a>
                            @endcan
                        </div>
                    </div>
                </div>
                @include('equipos.access_points.edit')
                @include('equipos.access_points.create')

                <div class="table-responsive text-nowrap" id="searchResults">
                    <table id="aps" class="table">
                        <thead class="bg-primary">
                            <tr>
                                <th>Nombre</th>
                                <th>IP</th>
                                <th>MAC</th>
                                <th>SW Conectado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($accessPoints as $ap)
                                <tr>
                                    <td>{{ $ap->name }}</td>
                                    <td>{{ $ap->ip }}</td>
                                    <td>{{ $ap->mac }}</td>
                                    <td>{{ $ap->swittch->name }} (Pto: {{ $ap->port_number }})</td>
                                    <td>
                                        <div class="dropdown">
                                            
                                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                data-bs-toggle="dropdown">
                                                <i class="bx bx-dots-vertical-rounded"></i>
                                            </button>
                                            <div class="dropdown-menu">
                                                @can('access_points.edit')
                                                    <a href="#" data-bs-toggle="modal" data-bs-target="#editModal{{ $ap->id }}" class="dropdown-item"><i class="bx bx-edit me-1"></i>Editar</a>
                                                @endcan

                                                @can('access_points.destroy')
                                                    <form action="{{ route('access-points.destroy', $ap->id) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="dropdown-item btn-danger"
                                                            onclick="return confirm('¿Estás seguro de eliminar este AP?')"><i
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
