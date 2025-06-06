<x-app-layout>
    @include('redes.ont.create')
    @include('redes.ont.edit')

    <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-style1">
                    <li class="breadcrumb-item">
                        REDES
                    </li>
                    <li class="breadcrumb-item active fw-bold">ONTS</li>
                </ol>
            </nav>

            @if ($hotels->count() === 1)
                <!-- Basic Bootstrap Table -->
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="card-header">Ont list</h5>
                        <div class="navbar-nav align-items-center">
                            <div class="nav-item d-flex align-items-center">

                                <a href="#" class="btn-ico" data-bs-target="#modalCreate" data-bs-toggle="modal"
                                    data-bs-offset="0,4" data-bs-placement="top" data-bs-html="true" title=""
                                    data-bs-original-title="<span>Add new equipment</span>">
                                    <i class='bx bx-add-to-queue icon-lg'></i>
                                </a>

                            </div>
                        </div>
                    </div>
                    @php
                        $user = auth()->user();
                        $userRegions = $user->regions;
                    @endphp

                    <div class="table-responsive text-nowrap" id="searchResults">
                        <table id="onts" class="table">
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
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody id="employeeList">
                                @foreach ($onts as $ont)
                                    <tr>
                                        <td>{{ $ont->name }}</td>
                                        <td>{{ $ont->brand }} / {{ $ont->model }} / {{ $ont->serial }}</td>
                                        <td>{{ $ont->ip }}</td>
                                        <td>{{ $ont->mac }}</td>
                                        @role('Administrator')
                                            <td>{{ $ont->region->name }} </td>
                                        @endrole
                                        <td>{{ $ont->hotel->name }} / {{ $ont->villa->name }} / {{ $ont->room->number }}
                                        </td>
                                        <td>
                                            <div class="dropdown">
                                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                    data-bs-toggle="dropdown">
                                                    <i class="bx bx-dots-vertical-rounded"></i>
                                                </button>
                                                <div class="dropdown-menu">

                                                    <a href="#" data-bs-toggle="modal"
                                                        data-bs-target="#editModal{{ $ont->id }}"
                                                        class="dropdown-item"><i class="bx bx bx-edit me-1"></i>Edit
                                                    </a>

                                                    <form action="{{ route('ont.destroy', $ont->id) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="dropdown-item btn-danger"
                                                            onclick="return confirm('Are you sure to delete this ONT?')"><i
                                                                class="bx bx-trash me-1"></i>Delete</button>
                                                    </form>
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
                                    <h5 class="card-title">{{ $hotel->name }} ({{ $hotel->onts_count }})</h5>
                                    <p class="card-text">{{ $hotel->type }}</p>
                                    <a href="{{ route('ont.details', ['hotel' => $hotel->id]) }}"
                                        class="btn btn-primary">
                                        Ver ONT's
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
