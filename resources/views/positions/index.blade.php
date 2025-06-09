<x-app-layout>
    @include('positions.create')
    @include('positions.edit')

    <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-style1">
                    <li class="breadcrumb-item active fw-bold">POSITIONS</li>
                </ol>
            </nav>

            <!-- Basic Bootstrap Table -->
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-header">Positions list</h5>
                    <div class="navbar-nav align-items-center">
                        <div class="nav-item d-flex align-items-center">
                            @can('positions.create')
                                <a href="#" class="btn-ico" data-bs-toggle="modal" data-bs-target="#modalCreate"
                                    data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="top"
                                    data-bs-html="true" title=""
                                    data-bs-original-title="<span>Add new position</span>">
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
                                <table id="positions" class="table footer">
                                    <thead class="bg-primary">
                                        <tr>
                                            <th>Region</th>
                                            <th>Email</th>
                                            <th>Positions</th>
                                            <th>Department</th>
                                            <th>Hotel</th>
                                            <th>AD</th>                                           
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody id="employeeList">
                                        <!-- Aquí se mostrarán los empleados -->
                                        @foreach ($positions as $position)
                                            <tr>
                                                <td>{{ $position->region ? $position->region->name : 'Sin región asignada' }}</td>
                                                <td>{{ Str::limit($position->email, 20, ' ...') }}</td>
                                                <td>{{ Str::limit($position->position, 20, ' ...') }}</td>
                                                <td>{{ $position->departments ? $position->departments->name : 'Sin departamentos asignado' }}</td>
                                                <td>{{ $position->hotel ? $position->hotel->name : 'Sin hotel asignado' }}</td>
                                                <td>{{ $position->ad }}</td>
                                                <td>
                                                    <div class="dropdown">
                                                        <button type="button"
                                                            class="btn p-0 dropdown-toggle hide-arrow"
                                                            data-bs-toggle="dropdown">
                                                            <i class="bx bx-dots-vertical-rounded"></i>
                                                        </button>
                                                        <div class="dropdown-menu">

                                                            @can('positions.show')
                                                                <a href="{{ route('positions.show', $position->id) }}"
                                                                    class="dropdown-item"><i
                                                                        class='bx bx-show-alt'></i></i>Show</a>
                                                            @endcan

                                                            @can('positions.edit')
                                                                <a href="#" data-bs-toggle="modal"
                                                                    data-bs-target="#editModal"
                                                                    data-position-id="{{ $position->id }}"
                                                                    class="dropdown-item btn-edit"><i
                                                                        class="bx bx-edit me-1"></i>Edit</a>
                                                            @endcan

                                                            @can('positions.destroy')
                                                                <form
                                                                    action="{{ route('positions.destroy', $position->id) }}"
                                                                    method="POST">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit" class="dropdown-item btn-danger"
                                                                        onclick="return confirm('Are you sure to delete this position?')"><i
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
