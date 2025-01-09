<x-app-layout>    
    <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">
                <a href="{{ route('coming2.index') }}" class="btn-ico" data-toggle="tooltip"
                    data-placement="top" title="Regresar">
                    <span>
                        <i class='bx bx-arrow-back'></i>
                    </span>
                </a>
                /Coming2 / Tablets /</span> Papelera </h4>

            <!-- Basic Bootstrap Table -->
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-header">Papelera de Tabletas</h5>
                </div>
                <div class="content-wrapper">
                    <div class="table-responsive text-nowrap">
                        <div class="card-datatable table-responsive pt-0">
                            <div class="table-responsive text-nowrap" id="searchResults">
                                <table id="tabletas" class="table">
                                    <thead class="bg-primary">
                                        <tr>
                                            <th>Responsable</th>
                                            <th>Puesto</th>
                                            <th>Email</th>
                                            <th>Usuario</th>
                                            <th>Contraseña</th>
                                            <th>Numero de tableta</th>
                                            <th>Numero de serie</th>
                                            <th>Numero de telefono</th>
                                            <th>IMEI</th>
                                            <th>SIM</th>
                                            <th>Politica aplicada</th>
                                            <th>¿Esta configurada?</th>
                                            <th>¿Carta Firmada?</th>
                                            <th>Folio de baja</th>
                                            <th>Observacion</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody id="employeeList">
                                        <!-- Aquí se mostrarán los empleados -->
                                        @foreach ($tablets as $tablet)
                                            <tr>
                                                <td>{{ $tablet->operario }}</td>
                                                <td>{{ $tablet->puesto }}</td>
                                                <td>{{ $tablet->email }}</td>
                                                <td>{{ $tablet->usuario }}</td>
                                                <td>{{ $tablet->password }}</td>
                                                <td>{{ $tablet->numero_tableta }}</td>
                                                <td>{{ $tablet->serial }}</td>
                                                <td>{{ $tablet->numero_telefono }}</td>
                                                <td>{{ $tablet->imei }}</td>
                                                <td>{{ $tablet->sim }}</td>
                                                <td>{{ $tablet->policies->name }}</td>
                                                <td>
                                                    @if ($tablet->configurada == '1')
                                                        <span class="badge bg-label-success">Si</span> 
                                                    @else
                                                        <span class="badge bg-label-danger">No</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($tablet->carta_firmada == '1')
                                                        <span class="badge bg-label-success">Si</span> 
                                                    @else
                                                        <span class="badge bg-label-danger">No</span>
                                                    @endif
                                                </td>
                                                <td>{{ $tablet->folio_baja }}</td>
                                                <td>{{ $tablet->observacion }}</td>
                                                <td>
                                                    <div class="dropdown">
                                                        <button type="button"
                                                            class="btn p-0 dropdown-toggle hide-arrow"
                                                            data-bs-toggle="dropdown">
                                                            <i class="bx bx-dots-vertical-rounded"></i>
                                                        </button>
                                                        <div class="dropdown-menu">

                                                            <form action="{{ route('co2.restore', $tablet->id) }}" method="POST">
                                                                @csrf
                                                                <button type="submit" class="dropdown-item"><i class='bx bx-reset me-1'></i>Restaurar</button>
                                                            </form>

                                                            @can ('coming2.destroy')
                                                            <form action="{{ route('coming2.destroy', $tablet->id) }}"
                                                                method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit"
                                                                    class="dropdown-item btn-danger"
                                                                    onclick="return confirm('¿Estás seguro de eliminar este equipo?')"><i
                                                                        class="bx bx-trash me-1"></i>Eliminar</button>
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

