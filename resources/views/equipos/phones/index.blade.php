<x-app-layout>
@include('equipos.phones.create')
@include('equipos.phones.edit')

    <div class="content-wrapper">
        <!-- Content -->

        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"> Equipments /</span> Phones </h4>

            <!-- Basic Bootstrap Table -->
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-header">Listado de telefonos moviles</h5>
                    <div class="navbar-nav align-items-center">
                        <div class="nav-item d-flex align-items-center">
                            @can('phones.create')
                                <a href="#" class="btn-ico" data-toggle="modal" data-target="#modalCreate"
                                    data-placement="top" title="Agregar Nuevo Registro">
                                    <i class='bx bx-add-to-queue icon-lg'></i>
                                </a>
                            @endcan
                        </div>
                    </div>
                </div>

                <div class="table-responsive text-nowrap" id="searchResults">
                    <table id="tabs" class="table">
                        <thead class="bg-primary">
                            <tr>
                                <th>MARCA</th>
                                <th>MODELO</th>
                                <th>SERIE</th>
                                <th>POLITICA</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                                <!-- Otros encabezados de columnas según sea necesario -->
                            </tr>
                        </thead>
                        <tbody id="employeeList">
                        @foreach ($equipos as $equipo)
                                <tr>
                                    <td>{{ $equipo->marca }}</td>
                                    <td>{{ $equipo->model }}</td>
                                    <td>{{ $equipo->serial }}</td>
                                    <td>{{ $equipo->policy->name }}</td>
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
                                                @can('phones.edit')
                                                    <a href="#" data-bs-toggle="modal" data-bs-target="#editModal{{ $equipo->id }}" class="dropdown-item"><i class="bx bx-edit me-1"></i>Editar</a>
                                                @endcan

                                                @can('phones.destroy')
                                                    <form action="{{ route('phones.destroy', $equipo->id) }}" method="POST">
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
