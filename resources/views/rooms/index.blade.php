<x-app-layout>
    @include('rooms.create')
    @include('rooms.edit')
    <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">

            <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-style1">
                    <li class="breadcrumb-item active fw-bold">ROOMS</li>
                </ol>
            </nav>

            <!-- Basic Bootstrap Table -->
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-header">Rooms</h5>
                    <div class="navbar-nav align-items-center">
                        <div class="nav-item d-flex align-items-center">
                            <a href="#" class="btn-ico" data-bs-toggle="modal" data-bs-target="#modalCreate"
                                data-placement="top" title="Agregar Hotel">
                                <i class='bx bx-add-to-queue icon-lg'></i>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="content-wrapper">
                    <div class="table-responsive text-nowrap">
                        <div class="card-datatable table-responsive pt-0">
                            <div class="table-responsive text-nowrap" id="searchResults">
                                <table id="rooms" class="table">
                                    <thead class="bg-primary">
                                        <tr>
                                            <th>Hotel</th>
                                            <th>Villa</th>
                                            <th>No. Room</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody id="employeeList">
                                        <!-- Aquí se mostrarán los empleados -->
                                        @foreach ($rooms as $room)
                                            @if (
                                                $room->villa &&
                                                    $room->villa->hotel &&
                                                    in_array($room->villa->hotel->region_id, $userRegions->pluck('id')->toArray()))
                                                <tr>
                                                    <td>{{ $room->villa->hotel ? $room->villa->hotel->name : 'N/A' }}
                                                    </td>
                                                    <td>{{ $room->villa->name }}</td>
                                                    <td>{{ $room->number }}</td>
                                                    <td>
                                                        <div class="dropdown">
                                                            <button type="button"
                                                                class="btn p-0 dropdown-toggle hide-arrow"
                                                                data-bs-toggle="dropdown">
                                                                <i class="bx bx-dots-vertical-rounded"></i>
                                                            </button>
                                                            <div class="dropdown-menu">

                                                                @can('hotels.edit')
                                                                    <a href="#" data-bs-toggle="modal"
                                                                        data-bs-target="#editModal{{ $room->id }}"
                                                                        class="dropdown-item"><i
                                                                            class="bx bx-edit me-1"></i>Editar</a>
                                                                @endcan

                                                                @can('hotels.destroy')
                                                                    <form action="{{ route('rooms.destroy', $room->id) }}"
                                                                        method="POST">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <button type="submit"
                                                                            class="dropdown-item btn-danger"
                                                                            onclick="return confirm('¿Estás seguro de eliminar el registro de la habitacion {{ $room->number }} de la villa {{ $room->villa }} ?')"><i
                                                                                class="bx bx-trash me-1"></i>Eliminar</button>
                                                                    </form>
                                                                @endcan
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endif
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
