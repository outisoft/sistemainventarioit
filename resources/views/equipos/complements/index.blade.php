<x-app-layout>
    <div class="content-wrapper">
        <!-- Content -->

        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"> Equipments /</span> Complements </h4>

            <!-- Basic Bootstrap Table -->
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-header">Complement's list</h5>
                    <div class="navbar-nav align-items-center">
                        <div class="nav-item d-flex align-items-center">
                            @can('complements.create')
                                <a href="#" class="btn-ico" data-toggle="modal" data-target="#modalCreate"
                                    data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="top"
                                    data-bs-html="true" title=""
                                    data-bs-original-title="<span>Add new complement</span>">
                                    <i class='bx bx-add-to-queue icon-lg'></i>
                                </a>
                            @endcan
                        </div>
                    </div>
                </div>
                @include('equipos.complements.create')
                @include('equipos.complements.edit')
                <div class="table-responsive text-nowrap" id="searchResults">
                    <table id="complements" class="table">
                        <thead class="bg-primary">
                            <tr>
                                @role('Administrator')
                                    <th>Region</th>
                                @else
                                    @if ($userRegions->count() > 1)
                                        <th>Region</th>
                                    @else
                                    @endif
                                @endrole
                                <th>TYPE</th>
                                <th>BRAND</th>
                                <th>MODEL</th>
                                <th>SERIAL / CT</th>
                                <th>ASSIGNED TO...</th>
                                <th>LEASE?</th>
                                <th>ACTIONS</th>
                                <!-- Otros encabezados de columnas según sea necesario -->
                            </tr>
                        </thead>
                        <tbody id="employeeList">
                            @foreach ($equipos as $equipo)
                                <tr>
                                    @role('Administrator')
                                        <td>{{ $equipo->region->name }} </td>
                                    @else
                                        @if ($userRegions->count() > 1)
                                            <td>{{ $equipo->region->name }} </td>
                                        @else
                                        @endif
                                    @endrole
                                    <td>{{ $equipo->type->name }}</td>
                                    <td>{{ $equipo->brand }}</td>
                                    <td>{{ $equipo->model }}</td>
                                    <td>{{ $equipo->serial }}</td>
                                    <td>
                                        @if ($equipo->equipments->count() > 0)
                                            @foreach ($equipo->equipments as $equipment)
                                                {{ $equipment->name }}
                                            @endforeach
                                        @else
                                            To no assigned equipment
                                        @endif
                                    </td>
                                    <td>
                                        @if ($equipo->lease)
                                            Code: <span class="badge bg-label-dark">{{ $equipo->code }}</span><br>
                                            Date: <span class="badge bg-label-info">{{ $equipo->date }}</span>
                                        @else
                                            No lease
                                        @endif
                                    </td>
                                    <td>
                                        <div class="dropdown">
                                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                data-bs-toggle="dropdown">
                                                <i class="bx bx-dots-vertical-rounded"></i>
                                            </button>
                                            <div class="dropdown-menu">
                                                @can('complements.show')
                                                    <a class="dropdown-item"
                                                        href="{{ route('complements.show', $equipo->id) }}"><i
                                                            class="bx bx-show-alt me-1"></i>Show
                                                    </a>
                                                @endcan
                                                @can('complements.edit')
                                                    <a href="#" data-bs-toggle="modal"
                                                        data-bs-target="#editModal{{ $equipo->id }}"
                                                        class="dropdown-item"><i class="bx bx-edit me-1"></i>Edit</a>
                                                @endcan

                                                @can('complements.destroy')
                                                    <form action="{{ route('complements.destroy', $equipo->id) }}"
                                                        method="POST">
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
