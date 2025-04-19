<x-app-layout>
    <!-- Modal de creacion -->
    @include('tpvs.create')
    @include('tpvs.edit')
    <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-style1">
                    <li class="breadcrumb-item">
                        <a href="{{ route('equipo.index') }}">EQUIPMENTS</a>
                    </li>
                    <li class="breadcrumb-item active fw-bold">TPV's</li>
                </ol>
            </nav>

            <!-- Basic Bootstrap Table -->
            <div class="card">
                @can('tpvs.create')
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="card-header">Tpv's list</h5>
                        <div class="navbar-nav align-items-center">
                            <div class="nav-item d-flex align-items-center">
                                @can('tpvs.create')
                                    <a href="#" class="btn-ico" data-bs-toggle="modal" data-bs-target="#modalCreate"
                                        data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="top"
                                        data-bs-html="true" title=""
                                        data-bs-original-title="<span>Add new equipment</span>">
                                        <i class='bx bx-add-to-queue icon-lg'></i>
                                    </a>
                                @endcan
                            </div>
                        </div>
                    </div>
                @endcan
                <div class="content-wrapper">
                    <div class="table-responsive text-nowrap">
                        <div class="card-datatable table-responsive pt-0">
                            <div class="table-responsive text-nowrap" id="searchResults">
                                <table id="tpvs" class="table">
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
                                            <th>Area</th>
                                            <th>Department</th>
                                            <th>Hotel</th>
                                            <th>Equipo</th>
                                            <th>Brand</th>
                                            <th>Model</th>
                                            <th>Serial</th>
                                            <th>Name</th>
                                            <th>IP</th>
                                            <th>Link</th>
                                            <th>LEASE?</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody id="employeeList">
                                        <!-- Aquí se mostrarán los empleados -->
                                        @foreach ($tpvs as $tpv)
                                            <tr>
                                                @role('Administrator')
                                                    <td>{{ $tpv->region->name }} </td>
                                                @else
                                                    @if ($userRegions->count() > 1)
                                                        <td>{{ $tpv->region->name }} </td>
                                                    @else
                                                    @endif
                                                @endrole
                                                <td>{{ $tpv->area }}</td>
                                                <td>{{ $tpv->departments->name }}</td>
                                                <td>{{ $tpv->hotel->name }}</td>
                                                <td>{{ $tpv->equipment }}</td>
                                                <td>{{ $tpv->brand }}</td>
                                                <td>{{ $tpv->model }}</td>
                                                <td>{{ $tpv->no_serial }}</td>
                                                <td>{{ $tpv->name }}</td>
                                                <td>{{ $tpv->ip }}</td>
                                                <td>{{ Str::limit($tpv->link, 15, ' ...') }}</td>
                                                <td>
                                                    @if ($tpv->lease_id && $tpv->lease)
                                                        <div>
                                                            Lease Code: <span
                                                                class="badge bg-label-dark">{{ $tpv->leases->lease }}</span><br>
                                                            End Date: <span
                                                                class="badge bg-label-info">{{ $tpv->leases->end_date }}</span>
                                                        </div>
                                                    @else
                                                        <span class="badge bg-label-danger">No</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <div class="dropdown">
                                                        <button type="button"
                                                            class="btn p-0 dropdown-toggle hide-arrow"
                                                            data-bs-toggle="dropdown">
                                                            <i class="bx bx-dots-vertical-rounded"></i>
                                                        </button>
                                                        <div class="dropdown-menu">
                                                            @can('tpvs.show')
                                                                <a class="dropdown-item"
                                                                    href="{{ route('tpvs.show', $tpv->id) }}"><i
                                                                        class="bx bx-show-alt me-1"></i>Show
                                                                </a>
                                                            @endcan

                                                            @can('tpvs.edit')
                                                                <a href="#" data-bs-toggle="modal"
                                                                    data-bs-target="#editModal{{ $tpv->id }}"
                                                                    data-hotel-id="{{ $tpv->hotel_id }}"
                                                                    data-departamento-id="{{ $tpv->departamento_id }}"
                                                                    class="dropdown-item"><i
                                                                        class="bx bx-edit me-1"></i>Edit</a>
                                                            @endcan

                                                            @can('tpvs.destroy')
                                                                <form action="{{ route('tpvs.destroy', $tpv->id) }}"
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
                    </div>
                </div>
            </div>
            <!--/ Basic Bootstrap Table -->
        </div>
        <!-- / Content -->
    </div>
</x-app-layout>
