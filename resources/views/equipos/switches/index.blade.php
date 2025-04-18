<x-app-layout>
    <div class="content-wrapper">
        <!-- Content -->

        <div class="container-xxl flex-grow-1 container-p-y">
            <nav aria-label="b7 readcrumb">
                <ol class="breadcrumb breadcrumb-style1">
                    <li class="breadcrumb-item active fw-bold">SWITCHES</li>
                </ol>
            </nav>

            <!-- Tarjeta de hoteles -->
            <!--div-- class="row g-6 mb-6">
                @foreach ($hoteles as $hotel)
<div class="col-xl-4-c col-lg-6 col-md-6">
                        <div class="card card-border-shadow-primary h-100">
                            <div class="card-body">
                                <div class="d-flex align-items-center mb-2">
                                    <div class="avatar me-4">
                                        <span class="avatar-initial rounded bg-label-primary"><i class="icon-base bx bx-server icon-lg"></i> </span>
                                    </div>
                                    <h4 class="mb-0">{{ $hotel->total_sw }}</h4>
                                </div>
                                <p class="mb-2">{{ $hotel->hotel }}</p>
                                <p class="mb-0">
                                    <span class="text-heading fw-medium me-2">{{ $hotel->region }} </span>
                                    <span class="text-body-secondary">
                                        <a href="{{ route('hotels.switches', $hotel->id) }}">
                                            Show<i class='bx bx-right-arrow-alt'></i>
                                        </a>
                                    </span>
                                </p>
                            </div>
                        </div>
                    </div>
@endforeach
            </div--><br>
            <!-- Tarjeta de hoteles -->

            <!-- Basic Bootstrap Table -->
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-header">Switches list</h5>
                    <div class="navbar-nav align-items-center">
                        <div class="nav-item d-flex align-items-center">
                            @can('switches.create')
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
                @php
                    $user = auth()->user();
                    $userRegions = $user->regions;
                @endphp
                @include('equipos.switches.create')
                @include('equipos.switches.edit')

                <div class="table-responsive text-nowrap" id="searchResults">
                    <table id="switchs" class="table">
                        <thead class="bg-primary">
                            <tr>
                                <th>Name</th>
                                <th>Details</th>
                                <th>IP</th>
                                <th>MAC</th>
                                @role('Administrator')
                                    <th>Region</th>
                                @endrole
                                <th>Location</th>
                                <th>Observations</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="employeeList">
                            @foreach ($switches as $switch)
                                <tr>
                                    <td>{{ $switch->name }} ({{ $switch->total_ports }} puertos)</td>
                                    <td>{{ $switch->marca }} / {{ $switch->model }} / {{ $switch->serial }}</td>
                                    <td>{{ $switch->ip }}</td>
                                    <td>{{ $switch->mac }}</td>
                                    @role('Administrator')
                                        <td>{{ $switch->region->name }} </td>
                                    @endrole
                                    <td>{{ $switch->hotel->name }}</td>
                                    <td>{{ $switch->observacion }}</td>
                                    <td>
                                        <div class="dropdown">
                                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                data-bs-toggle="dropdown">
                                                <i class="bx bx-dots-vertical-rounded"></i>
                                            </button>
                                            <div class="dropdown-menu">
                                                @can('switches.show')
                                                    <a class="dropdown-item"
                                                        href="{{ route('switches.show', $switch->id) }}"><i
                                                            class="bx bx-show-alt me-1"></i>Show
                                                    </a>
                                                @endcan

                                                @can('switches.edit')
                                                    <a href="#" data-bs-toggle="modal"
                                                        data-bs-target="#editModal{{ $switch->id }}"
                                                        class="dropdown-item"><i class="bx bx-edit me-1"></i>Edit</a>
                                                @endcan

                                                @can('switches.destroy')
                                                    <form action="{{ route('switches.destroy', $switch->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="dropdown-item btn-danger"
                                                            onclick="return confirm('Are you sure to delete this equipment?')"><i
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
