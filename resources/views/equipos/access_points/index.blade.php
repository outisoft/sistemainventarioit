<x-app-layout>
    <div class="content-wrapper">
        <!-- Content -->

        <div class="container-xxl flex-grow-1 container-p-y">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-style1">
                    <li class="breadcrumb-item">
                        REDES
                    </li>
                    <li class="breadcrumb-item active fw-bold">ACCESS POINTS</li>
                </ol>
            </nav>

            <!-- Basic Bootstrap Table -->
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-header">AP's list</h5>
                    <div class="navbar-nav align-items-center">
                        <div class="nav-item d-flex align-items-center">

                            @can('access_points.create')
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
                @include('equipos.access_points.edit')
                @include('equipos.access_points.create')

                <div class="table-responsive text-nowrap" id="searchResults">
                    <table id="aps" class="table">
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
                                <th>Name</th>
                                <th>IP</th>
                                <th>MAC</th>
                                <th>SW</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($accessPoints as $ap)
                                <tr>
                                    @role('Administrator')
                                        <td>{{ $ap->region->name }} </td>
                                    @else
                                        @if ($userRegions->count() > 1)
                                            <td>{{ $ap->region->name }} </td>
                                        @else
                                        @endif
                                    @endrole
                                    <td>{{ $ap->name }}</td>
                                    <td>{{ $ap->ip }}</td>
                                    <td>{{ $ap->mac }}</td>
                                    <td>{{ $ap->swittch->name }} (Pto: {{ $ap->port_number }})</td>
                                    <td>
                                        <div class="dropdown">

                                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                data-bs-toggle="dropdown">
                                                <i class="bx bx-dots-vertical-rounded"></i>
                                            </button>
                                            <div class="dropdown-menu">
                                                @can('access_points.show')
                                                    <a class="dropdown-item"
                                                        href="{{ route('access-points.show', $ap->id) }}"><i
                                                            class="bx bx-show-alt me-1"></i>Show
                                                    </a>
                                                @endcan
                                                @can('access_points.edit')
                                                    <a href="#" data-bs-toggle="modal"
                                                        data-bs-target="#editModal{{ $ap->id }}"
                                                        class="dropdown-item"><i class="bx bx-edit me-1"></i>Edit</a>
                                                @endcan

                                                @can('access_points.destroy')
                                                    <form action="{{ route('access-points.destroy', $ap->id) }}"
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
