<x-app-layout>
    @section('css')
        <link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    @endsection

    @include('equipos.desktops.create')
    @include('equipos.desktops.edit')
    <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-style1">
                    <li class="breadcrumb-item">
                        <a href="{{ route('equipo.index') }}">EQUIPMENTS</a>
                    </li>
                    <li class="breadcrumb-item active fw-bold">DESKTOPS</li>
                </ol>
            </nav>

            <!-- Basic Bootstrap Table -->
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-header">Desktops</h5>
                    <div class="navbar-nav align-items-center">
                        <div class="nav-item d-flex align-items-center">
                            <a href="{{ url('desktops/trashes') }}" class="btn-ico">
                                <i class="bx bx-trash icon-lg" data-bs-toggle="tooltip" data-popup="tooltip-custom"
                                    data-bs-placement="top" class="assigned-item" aria-label="Trashes"
                                    data-bs-original-title="Trashes"></i>
                            </a>
                            @can('desktops.create')
                                <a href="#" class="btn-ico" data-toggle="modal" data-target="#modalCreate"
                                    data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="top"
                                    data-bs-html="true" title=""
                                    data-bs-original-title="<span>Add new equipment</span>">
                                    <i class='bx bx-add-to-queue icon-lg'></i>
                                </a>
                            @endcan
                        </div>
                    </div>
                </div>

                <div class="content-wrapper">
                    <div class="table-responsive text-nowrap">
                        <div class="card-datatable table-responsive pt-0">
                            <div class="card-datatable table-responsive pt-0">
                                <table id="desktops" class="table">
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
                                            <th>Brand</th>
                                            <th>Model</th>
                                            <th>Serial</th>
                                            <th>Name</th>
                                            <th>Ip</th>
                                            <th>SO</th>
                                            <th>LEASE? OR AF CODE</th>
                                            <th>Status</th>
                                            <th></th>
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
                                                <td>{{ $equipo->marca }}</td>
                                                <td>{{ $equipo->model }}</td>
                                                <td>{{ $equipo->serial }}</td>
                                                <td>{{ $equipo->name }}</td>
                                                <td>{{ $equipo->ip }}</td>
                                                <td>{{ $equipo->so }}</td>
                                                <td>
                                                    @if ($equipo->lease_id && $equipo->lease)
                                                        <div>
                                                            Lease Code: <span
                                                                class="badge bg-label-dark">{{ $equipo->leases->lease }}</span><br>
                                                            End Date: <span
                                                                class="badge bg-label-info">{{ $equipo->leases->end_date }}</span>
                                                        </div>
                                                    @else
                                                        <span class="badge bg-label-danger">No</span>
                                                        <span class="badge bg-label-dark">{{ $equipo->af_code }}</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($equipo->estado === 'Libre')
                                                        <span
                                                            class="badge bg-label-success">{{ $equipo->estado }}</span>
                                                    @elseif ($equipo->estado === 'En Uso')
                                                        <span
                                                            class="badge bg-label-danger">{{ $equipo->estado }}</span>
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
                                                            <a href="{{ route('equipo.show', $equipo->id) }}"
                                                                class="dropdown-item"><i
                                                                    class='bx bx-extension me-1'></i>Complements</a>

                                                            <!-- Aquí se agregarán las opciones -->
                                                            @can('desktops.edit')
                                                                <a href="#" data-bs-toggle="modal"
                                                                    data-bs-target="#editModal{{ $equipo->id }}"
                                                                    class="dropdown-item"><i
                                                                        class="bx bx-edit me-1"></i>Edit</a>
                                                            @endcan

                                                            @can('desktops.destroy')
                                                                <form action="{{ route('desktops.trash', $equipo->id) }}"
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
                                                <!-- Otros campos de la tabla -->
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
