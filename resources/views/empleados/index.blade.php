<x-app-layout>
    @section('css')
        <link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    @endsection

    <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Employees /</span> List </h4>

            <!-- Basic Bootstrap Table -->
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-header">Employees list</h5>
                    <div class="navbar-nav align-items-center">
                        <div class="nav-item d-flex align-items-center">

                            @can('empleados.create')
                                <a href="#" class="btn-ico" data-toggle="modal" data-target="#modalCreate" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="top" data-bs-html="true" title="" data-bs-original-title="<span>Add new employee</span>">
                                    <i class='bx bx-add-to-queue icon-lg'></i>
                                </a>
                            @endcan

                        </div>
                    </div>
                </div>
                @include('empleados.create')
                @include('empleados.edit')

                <div class="content-wrapper">
                    <div class="table-responsive text-nowrap">
                        <div class="card-datatable table-responsive pt-0">
                            <div class="table-responsive text-nowrap" id="searchResults">
                                <table id="employees" class="table footer">
                                    <thead class="bg-primary">
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Job</th>
                                            @role('Administrator')
                                                <th>Region</th>
                                            @endrole
                                            <th>Hotel</th>
                                            <th>Department</th>
                                            <th>AD</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody id="employeeList">
                                        <!-- Aquí se mostrarán los empleados -->
                                        @foreach ($empleados as $empleado)
                                            <tr>
                                                <td>{{ $empleado->no_empleado}}</td>
                                                <td>{{ Str::limit($empleado->name, 20, ' ...') }}</td>
                                                <td>{{ Str::limit($empleado->puesto, 20, ' ...') }}</td>
                                                @role('Administrator')
                                                    <td>{{ $empleado->region->name}} </td>
                                                @endrole
                                                <td>{{ $empleado->hotel->name }}</td>
                                                <td>{{ $empleado->departments->name }}</td>
                                                <!--td>{{ $empleado->equipo?->tipo ?? 'Sin equipo asignado' }}</td-->
                                                <td>{{ $empleado->ad }}</td>
                                                <td>
                                                    <div class="dropdown">
                                                        <button type="button"
                                                            class="btn p-0 dropdown-toggle hide-arrow"
                                                            data-bs-toggle="dropdown">
                                                            <i class="bx bx-dots-vertical-rounded"></i>
                                                        </button>
                                                        <div class="dropdown-menu">

                                                            @can('empleados.show')
                                                                <a href="{{ route('assignment.show', $empleado->id) }}" class="dropdown-item"><i class='bx bx-show-alt'></i></i>Show</a>
                                                            @endcan

                                                            @can('empleados.edit')
                                                                <a href="#" data-bs-toggle="modal" data-bs-target="#editModal" data-empleado-id="{{ $empleado->id }}" class="dropdown-item btn-edit"><i class="bx bx-edit me-1"></i>Edit</a>
                                                            @endcan

                                                            @can('empleados.destroy')
                                                                <form
                                                                    action="{{ route('empleados.destroy', $empleado->id) }}"
                                                                    method="POST">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit"
                                                                        class="dropdown-item btn-danger"
                                                                        onclick="return confirm('Are you sure to delete this employee?')"><i
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
                    </div>
                </div>
            </div>
            <!--/ Basic Bootstrap Table -->
        </div>
        <!-- / Content -->
    </div>
</x-app-layout>

