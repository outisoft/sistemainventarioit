<x-app-layout>
    <div class="content-wrapper">
        <!-- Content -->

        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"> Equipments /</span> Laptops </h4>

            <!-- Basic Bootstrap Table -->
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-header">Equipments list</h5>
                    <div class="navbar-nav align-items-center">
                        <div class="nav-item d-flex align-items-center">
                            @can('laptops.create')
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

                @include('equipos.laptops.create')
                @include('equipos.laptops.edit')

                <div class="table-responsive text-nowrap" id="searchResults">
                    <table id="laptops" class="table">
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
                                <th>BRAND</th>
                                <th>MODEL</th>
                                <th>SERIAL</th>
                                <th>NAME</th>
                                <th>IP</th>
                                <th>SO</th>
                                <th>OC</th>
                                <th>LEASE?</th>
                                <th>STATUS</th>
                                <th></th>
                                <!-- Otros encabezados de columnas según sea necesario -->
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
                                    <td>{{ $equipo->orden }}</td>
                                    <td>
                                        @if ($equipo->lease)
                                            Code: <span class="badge bg-label-dark">{{ $equipo->code }}</span><br>
                                            Date: <span class="badge bg-label-info">{{ $equipo->date }}</span>
                                        @else
                                            No lease
                                        @endif
                                    </td>
                                    <td>
                                        @if ($equipo->estado === 'Libre')
                                            <span class="badge bg-label-success">{{ $equipo->estado }}</span>
                                        @elseif ($equipo->estado === 'En Uso')
                                            <span class="badge bg-label-danger">{{ $equipo->estado }}</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="dropdown">
                                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                data-bs-toggle="dropdown">
                                                <i class="bx bx-dots-vertical-rounded"></i>
                                            </button>
                                            <div class="dropdown-menu">
                                                <a href="{{ route('equipo.show', $equipo->id) }}"
                                                    class="dropdown-item"><i
                                                        class='bx bx-extension me-1'></i>Complements</a>
                                                <!-- Aquí se agregarán las opciones -->
                                                @can('laptops.edit')
                                                    <a href="#" data-bs-toggle="modal"
                                                        data-bs-target="#editModal{{ $equipo->id }}"
                                                        class="dropdown-item"><i class="bx bx-edit me-1"></i>Edit</a>
                                                @endcan

                                                @can('laptops.destroy')
                                                    <form action="{{ route('laptops.destroy', $equipo->id) }}"
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
            <!--/ Basic Bootstrap Table -->
        </div>
        <!-- / Content -->
    </div>
</x-app-layout>
<script>
    $(document).ready(function() {
        $('input[name="lease"]').on('change', function() {
            if ($('#lease').is(':checked')) {
                $('#lease_fields').show();
                $('#code').attr('required', true);
                $('#date').attr('required', true);
            } else {
                $('#lease_fields').hide();
                $('#code').removeAttr('required');
                $('#date').removeAttr('required');
            }
        });

        // Trigger change event on page load to set initial state
        $('input[name="lease"]:checked').trigger('change');
    });
</script>
