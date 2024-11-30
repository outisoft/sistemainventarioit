<x-app-layout>
@include('equipos.mobiles.create')
@include('equipos.mobiles.edit')

    <div class="content-wrapper">
        <!-- Content -->

        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"> Equipments /</span> Mobiles </h4>

            <!-- Basic Bootstrap Table -->
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-header">Mobile phone list</h5>
                    <div class="navbar-nav align-items-center">
                        <div class="nav-item d-flex align-items-center">
                            @can('mobile.create')
                                <a href="#" class="btn-ico" data-toggle="modal" data-target="#modalCreate" 
                                    data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="top" 
                                    data-bs-html="true" title="" data-bs-original-title="<span>Add new equipment</span>">
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
                                <th>BRAND</th>
                                <th>MODEL</th>
                                <th>SERIAL</th>
                                <th>POLICY</th>
                                <th>STATUS</th>
                                <th>ACTIONS</th>
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
                                                @can('mobile.edit')
                                                    <a href="#" data-bs-toggle="modal" data-bs-target="#editModal{{ $equipo->id }}" class="dropdown-item"><i class="bx bx-edit me-1"></i>Edit</a>
                                                @endcan

                                                @can('mobile.destroy')
                                                    <form action="{{ route('mobiles.destroy', $equipo->id) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="dropdown-item btn-danger"
                                                            onclick="return confirm('Are you sure to delete?')"><i
                                                                class="bx bx-trash me-1"></i>Delete</button>
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