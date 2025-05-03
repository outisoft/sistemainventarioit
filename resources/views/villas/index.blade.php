<x-app-layout>
    @include('villas.create')
    @include('villas.edit')
    <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">

            <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-style1">
                    <li class="breadcrumb-item active fw-bold">VILLAS</li>
                </ol>
            </nav>

            @if ($hotels->count() === 1)
                <!-- Mostrar la tabla de villas si el usuario tiene acceso a un solo hotel -->
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="card-header">Villas</h5>
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
                                    <table id="villas" class="table">
                                        <thead class="bg-primary">
                                            <tr>
                                                <th>Hotel</th>
                                                <th>No. Villa</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody id="employeeList">
                                            @foreach ($villas as $villa)
                                                @if ($villa->hotel->id === $hotels->first()->id)
                                                    <tr>
                                                        <td>{{ $villa->hotel->name }}</td>
                                                        <td>{{ $villa->name }}</td>
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
                                                                            data-bs-target="#editModal{{ $villa->id }}"
                                                                            class="dropdown-item"><i
                                                                                class="bx bx-edit me-1"></i>Editar</a>
                                                                    @endcan

                                                                    @can('hotels.destroy')
                                                                        <form
                                                                            action="{{ route('villas.destroy', $villa->id) }}"
                                                                            method="POST">
                                                                            @csrf
                                                                            @method('DELETE')
                                                                            <button type="submit"
                                                                                class="dropdown-item btn-danger"
                                                                                onclick="return confirm('¿Estás seguro de eliminar el registro de la villa {{ $villa->name }}?')"><i
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
            @else
                <!-- Mostrar las tarjetas de hoteles si el usuario tiene acceso a más de un hotel -->
                <div class="row">
                    @foreach ($hotels as $hotel)
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $hotel->name }} ({{ $hotel->villas_count }})</h5>
                                    <p class="card-text">{{ $hotel->type }}</p>
                                    <a href="{{ route('villas.show', ['hotel' => $hotel->id]) }}"
                                        class="btn btn-primary">
                                        Ver Villas
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
            <!--/ Basic Bootstrap Table -->
        </div>
        <!-- / Content -->
    </div>
</x-app-layout>
