<x-app-layout>
    @include('employees.create')
    @include('employees.edit')

    <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-style1">
                    <li class="breadcrumb-item active fw-bold">EMPLOYEES</li>
                </ol>
            </nav>

            <!-- Basic Bootstrap Table -->
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-header">Employees list</h5>
                    <div class="navbar-nav align-items-center">
                        <div class="nav-item d-flex align-items-center">
                            @can('empleados.create')
                                <a href="#" class="btn-ico" data-bs-toggle="modal" data-bs-target="#modalCreate"
                                    data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="top"
                                    data-bs-html="true" title=""
                                    data-bs-original-title="<span>Add new employee</span>">
                                    <i class='bx bx-add-to-queue icon-lg'></i>
                                </a>                                    
                            @endcan
                        </div>
                    </div>
                </div>

                <div class="content-wrapper">
                    <div class="table-responsive text-nowrap">
                        <div class="card-datatable table-responsive pt-0">
                            <div class="table-responsive text-nowrap" id="searchResults">
                                <table id="employees" class="table footer">
                                    <thead class="bg-primary">
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Position</th>
                                            <th>Location</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody id="employeeList">
                                        <!-- Aquí se mostrarán los empleados -->
                                        @foreach ($employees as $employee)
                                            <tr>
                                                <td>{{ $employee->no_employee }}</td>
                                                <td>{{ Str::limit($employee->name, 20, ' ...') }}</td>
                                                <td>
                                                    {{ $employee->position ? $employee->position->position : 'Sin puesto asignado'}} /
                                                    {{ $employee->position ? $employee->position->ad : 'Sin ad asignado'}}
                                                </td>
                                                <td>
                                                    {{ $employee->position->hotel->name ?? 'N/A' }} - 
                                                    {{ $employee->position->departments->name ?? 'N/A' }} 
                                                </td>
                                                <td>
                                                    <div class="dropdown">
                                                        <button type="button"
                                                            class="btn p-0 dropdown-toggle hide-arrow"
                                                            data-bs-toggle="dropdown">
                                                            <i class="bx bx-dots-vertical-rounded"></i>
                                                        </button>
                                                        <div class="dropdown-menu">

                                                            @can('employees.show')
                                                                <a href="{{ route('employees.show', $employee->id) }}"
                                                                    class="dropdown-item"><i
                                                                        class='bx bx-show-alt'></i></i>Show</a>
                                                            @endcan

                                                            @can('employees.edit')
                                                                <a href="#" data-bs-toggle="modal"
                                                                    data-bs-target="#editModal{{ $employee->id }}"
                                                                    class="dropdown-item"><i
                                                                        class="bx bx-edit me-1"></i>Editar
                                                                </a>
                                                            @endcan

                                                            @can('employees.destroy')
                                                                <form
                                                                    action="{{ route('employees.destroy', $employee->id) }}"
                                                                    method="POST">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit" class="dropdown-item btn-danger"
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
