<x-app-layout>
    <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"> Departments /</span> List </h4>

            <!-- Basic Bootstrap Table -->
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-header">Departments</h5>
                    <div class="navbar-nav align-items-center">
                        <div class="nav-item d-flex align-items-center">
                        @can('departments.create')
                            <a href="#" class="btn-ico" data-toggle="modal" data-target="#modalCreate" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="top" data-bs-html="true" title="" data-bs-original-title="<span>Add new employee</span>">
                                <i class='bx bx-add-to-queue icon-lg'></i>
                            </a>
                        @endcan
                        </div>
                    </div>
                </div>
                @include('departments.create')
                @include('departments.edit')

                <div class="content-wrapper">
                    <div class="table-responsive text-nowrap">
                        <div class="card-datatable table-responsive pt-0">
                            <div class="table-responsive text-nowrap" id="searchResults">
                                <table id="hotels" class="table">
                                    <thead class="bg-primary">
                                        <tr>
                                            <th>Name</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody id="employeeList">
                                        <!-- Aquí se mostrarán los empleados -->
                                        @foreach ($departamentos as $departamento)
                                            <tr>
                                                <td>{{ $departamento->name }}</td>
                                                <td>
                                                    <div class="dropdown">
                                                        <button type="button"
                                                            class="btn p-0 dropdown-toggle hide-arrow"
                                                            data-bs-toggle="dropdown">
                                                            <i class="bx bx-dots-vertical-rounded"></i>
                                                        </button>
                                                        <div class="dropdown-menu">
                                                            @can('departments.show')
                                                                <a class="dropdown-item"
                                                                    href="{{ route('departments.show', $departamento->id) }}"><i
                                                                        class="bx bx-show-alt me-1"></i>Show
                                                                </a>
                                                            @endcan

                                                            @can('departments.edit')
                                                                <a href="#" data-bs-toggle="modal" data-bs-target="#editModal{{ $departamento->id }}" 
                                                                    class="dropdown-item"><i class="bx bx-edit me-1"></i>Edit
                                                                </a>
                                                            @endcan

                                                            @can('departments.destroy')
                                                            <form action="{{ route('departments.destroy', $departamento->id) }}"
                                                                method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit"
                                                                    class="dropdown-item btn-danger"
                                                                    onclick="return confirm('¿Estás seguro de eliminar este equipo?')"><i
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
