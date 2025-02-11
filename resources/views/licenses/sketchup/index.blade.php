<x-app-layout>
    @include('licenses.sketchup.create')
    @include('licenses.sketchup.edit')

    <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Licenses /</span> SketchUp </h4>

            <!-- Basic Bootstrap Table -->
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-header">SketchUp Licenses</h5>
                    <div class="navbar-nav align-items-center">
                        <div class="nav-item d-flex align-items-center">
                            @can('licenses.create')
                                <a href="#" class="btn-ico" data-toggle="modal" data-target="#modalCreate"
                                    data-placement="top" title="Agregar Nuevo Registro">
                                    <i class='bx bx-add-to-queue icon-lg'></i>
                                </a>
                            @endcan
                        </div>
                    </div>
                </div>

                <div class="content-wrapper">
                    <div class="table-responsive text-nowrap">
                        <div class="card-datatable table-responsive pt-0">
                            <div class="table-responsive text-nowrap" id="searchResults">
                                <table id="licenses" class="table footer">
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
                                            <th>SKETCHUP</th>
                                            <th>EMAIL/KEY</th>
                                            <th>FECHA DE EXPIRACION</th>
                                            <th>TOTAL</th>
                                            <th>ACCTIONS</th>
                                        </tr>
                                    </thead>
                                    <tbody id="licensesList">
                                        <!-- Aquí se mostrarán las licenias -->
                                        @foreach ($licenses as $sketchup)
                                            <tr>
                                                @role('Administrator')
                                                    <td>{{ $sketchup->region->name }} </td>
                                                @else
                                                    @if ($userRegions->count() > 1)
                                                        <td>{{ $sketchup->region->name }} </td>
                                                    @else
                                                    @endif
                                                @endrole

                                                <td>{{ $sketchup->type }}</td>
                                                <td>{{ $sketchup->key }}</td>

                                                <td>
                                                    @if (!empty($sketchup->end_date))
                                                        {{ $sketchup->end_date }}
                                                    @else
                                                        PERPETUA
                                                    @endif
                                                    @php
                                                        $statusClass = [
                                                            'Active' => 'badge bg-label-success',
                                                            'Near expiration' => 'badge bg-label-warning',
                                                            'Expired' => 'badge bg-label-danger',
                                                        ][$sketchup->getStatus()];
                                                    @endphp
                                                    <span class="{{ $statusClass }}">
                                                        {{ $sketchup->getStatus() }}
                                                    </span>
                                                </td>

                                                <td>EN USO {{ $sketchup->equipo->count() }} DE {{ $sketchup->max }}</td>
                                                <td>
                                                    <div class="dropdown">
                                                        <button type="button"
                                                            class="btn p-0 dropdown-toggle hide-arrow"
                                                            data-bs-toggle="dropdown">
                                                            <i class="bx bx-dots-vertical-rounded"></i>
                                                        </button>
                                                        <div class="dropdown-menu">
                                                            @can('licenses.show')
                                                                <a class="dropdown-item"
                                                                    href="{{ route('sketchup.show', $sketchup->id) }}"><i
                                                                        class="bx bx-show-alt me-1"></i>Show
                                                                </a>
                                                            @endcan

                                                            @can('licenses.edit')
                                                                <a href="#" data-bs-toggle="modal"
                                                                    data-bs-target="#editModal{{ $sketchup->id }}"
                                                                    class="dropdown-item"><i
                                                                        class="bx bx-edit me-1"></i>Edit</a>
                                                            @endcan

                                                            @can('licenses.destroy')
                                                                <form
                                                                    action="{{ route('sketchup.destroy', $sketchup->id) }}"
                                                                    method="POST">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit" class="dropdown-item btn-danger"
                                                                        onclick="return confirm('Are you sure to delete {{ $sketchup->type }}?')"><i
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
