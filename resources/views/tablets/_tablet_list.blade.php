<div class="table-responsive text-nowrap" id="searchResults">
    @if ($tablet->isEmpty())
        <h5 class="card-header">No se encontro registro de tabletas.</h5>
    @else
        <table id="tablets" class="table">
            <thead class="bg-primary">
                <tr>
                    <th>Responsable</th>
                    <th>Puesto</th>
                    <th>Email</th>
                    <th>Usuario</th>
                    <th>Contraseña</th>
                    <th>Numero de tableta</th>
                    <th>NUmero de serie</th>
                    <th>Numero de telefono</th>
                    <th>IMEI</th>
                    <th>SIM</th>
                    <th>Politica aplicada</th>
                    <th>¿ESta configurada?</th>
                    <th>¿Carta Firmada?</th>
                    <th>Giacode</th>
                    <th>Personalsdscode</th>
                    <th>Folio de baja</th>
                    <th>Observacion</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody id="employeeList">
                <!-- Aquí se mostrarán los empleados -->
                @foreach ($tablet as $tablet)
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
                        <td>{{ $tablet->politica }}</td>
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
                        <td>{{ $tablet->giacode }}</td>
                        <td>{{ $tablet->personalsdscode }}</td>
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
                                    <a class="dropdown-item"
                                        href="{{ route('tablets.show', $tablet->id) }}"><i
                                            class="bx bx-show-alt me-1"></i>Ver</a>
                                    <a class="dropdown-item"
                                        href="{{ route('tablets.edit', $tablet->id) }}"><i
                                            class="bx bx-edit me-1"></i>Editar</a>
                                    <form action="{{ route('tablets.destroy', $tablet->id) }}"
                                        method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="dropdown-item btn-danger"
                                            onclick="return confirm('¿Estás seguro de eliminar este equipo?')"><i
                                                class="bx bx-trash me-1"></i>Eliminar</button>
                                    </form>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@include('tablets.script')