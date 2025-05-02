<x-app-layout>
    <div class="content-wrapper">
        <!-- Content -->

        <div class="container-xxl flex-grow-1 container-p-y">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-style1">
                    <li class="breadcrumb-item">
                        REDES
                    </li>
                    <li class="breadcrumb-item active fw-bold">SWITCHES</li>
                </ol>
            </nav>
            @if ($hotels->count() === 1)

                <!-- Basic Bootstrap Table -->
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="card-header">Switches list</h5>
                        <div class="navbar-nav align-items-center">
                            <div class="nav-item d-flex align-items-center">
                                @can('switches.create')
                                    <a href="#" class="btn-ico" data-bs-target="#modalCreate" data-bs-toggle="modal"
                                        data-bs-offset="0,4" data-bs-placement="top" data-bs-html="true" title=""
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
                                    <th>Type</th>
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
                                        <td>{{ $switch->usage_type }} </td>
                                        <td>{{ $switch->name }} ({{ $switch->total_ports }} puertos)</td>
                                        <td>{{ $switch->marca }} / {{ $switch->model }} / {{ $switch->serial }}</td>
                                        <td>{{ $switch->ip }}</td>
                                        <td>{{ $switch->mac }}</td>
                                        @role('Administrator')
                                            <td>{{ $switch->region->name }} </td>
                                        @endrole
                                        <td>{{ $switch->hotel->name ?? 'N/A' }}</td>
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
            @else
                <div class="row">
                    @foreach ($hotels as $hotel)
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $hotel->name }}</h5>
                                    <p class="card-text">{{ $hotel->type }}</p>
                                    <a href="{{ route('switch.details', ['hotel' => $hotel->id]) }}"
                                        class="btn btn-primary">
                                        Ver switchs
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif

        </div>
        <!-- / Content -->
    </div>
</x-app-layout>
