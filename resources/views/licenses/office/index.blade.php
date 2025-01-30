<x-app-layout>
    @include('licenses.office.create')
    @include('licenses.office.edit')
    <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Licencias /</span> Office </h4>

            <!-- Basic Bootstrap Table -->
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-header">Licencias office</h5>
                    <div class="navbar-nav align-items-center">
                        <div class="nav-item d-flex align-items-center">
                            <a href="#" class="btn-ico" data-toggle="modal" data-target="#modalCreate"
                                data-placement="top" title="Agregar Nuevo Registro">
                                <i class='bx bx-add-to-queue icon-lg'></i>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="content-wrapper">
                    <div class="table-responsive text-nowrap">
                        <div class="card-datatable table-responsive pt-0">
                            <div class="table-responsive text-nowrap" id="searchResults">
                                <table id="office" class="table footer">
                                    <thead class="bg-primary">
                                        <tr>
                                            @role('Administrator')
                                                <th>REGION</th>
                                            @else
                                                @if ($userRegions->count() > 1)
                                                    <th>REGION</th>
                                                @else
                                                @endif
                                            @endrole
                                            <th>OFFICE</th>
                                            <th>EMAIL/KEY</th>
                                            <th>FECHA DE EXPIRACION</th>
                                            <th>TOTAL</th>
                                            <th>ACCTIONS</th>
                                        </tr>
                                    </thead>
                                    <tbody id="licensesList">
                                        <!-- Aquí se mostrarán las licenias -->
                                        @foreach ($offices as $office)
                                            <tr>
                                                @role('Administrator')
                                                    <td>{{ $office->region->name }} </td>
                                                @else
                                                    @if ($userRegions->count() > 1)
                                                        <td>{{ $office->region->name }} </td>
                                                    @else
                                                    @endif
                                                @endrole

                                                <td>Microsoft Office {{ $office->type }}</td>
                                                <td>{{ $office->key }}</td>

                                                <td>
                                                    @if (!empty($office->end_date))
                                                        {{ $office->end_date }}
                                                    @else
                                                        Permanente
                                                    @endif
                                                </td>

                                                <td>{{ $office->max }}</td>
                                                <td>
                                                    <div class="dropdown">
                                                        <button type="button"
                                                            class="btn p-0 dropdown-toggle hide-arrow"
                                                            data-bs-toggle="dropdown">
                                                            <i class="bx bx-dots-vertical-rounded"></i>
                                                        </button>
                                                        <div class="dropdown-menu">
                                                            <a class="dropdown-item"
                                                                href="{{ route('office.show', $office->id) }}"><i
                                                                    class="bx bx-show-alt me-1"></i>Show
                                                            </a>

                                                            <a href="#" data-bs-toggle="modal"
                                                                data-bs-target="#editModal{{ $office->id }}"
                                                                class="dropdown-item"><i
                                                                    class="bx bx-edit me-1"></i>Edit</a>

                                                            <form action="{{ route('office.destroy', $office->id) }}"
                                                                method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="dropdown-item btn-danger"
                                                                    onclick="return confirm('Are you sure to delete?')"><i
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
                    </div>
                </div>
            </div>
            <!--/ Basic Bootstrap Table -->
        </div>
        <!-- / Content -->
    </div>
</x-app-layout>
