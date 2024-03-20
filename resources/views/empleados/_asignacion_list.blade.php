<div class="table-responsive text-nowrap" id="resultados">
    @if ($empleados->isEmpty())
        <h5 class="card-header">No se encontro registro de empleados.</h5>
    @else
    <table id="asignacion" class="table table-striped footer">
        <thead class="bg-primary">
            <tr>
                <th>Nombre</th>
                <th>Hotel</th>
                <th>AD</th>
                <th>Equipo</th>
                <th>Fecha</th>
                <th>Detalles</th>
            </tr>
        </thead>
        <tbody id="employeeList">
            <!-- Aquí se mostrarán los empleados -->
            @foreach ($empleadosConEquipos as $empleado)
                <tr>
                    <td>{{ $empleado->name }}</td>
                    <td>{{ $empleado->hotel->nombre }}</td>
                    <td>{{ $empleado->ad }}</td>
                    <td>
                        @foreach ($empleado->equipos as $equipo)
                            {{ $equipo->tipo->name }}
                            <a href="{{ route('asignacion.desvincular', ['empleado_id' => $empleado->id, 'equipo_id' => $equipo->id]) }}"
                                class="btn btn-danger btn-sm">X</a>
                        @endforeach
                    </td>
                    <td>{{ \Carbon\Carbon::parse($empleado->created_at)->format('d/m/Y') }}
                    </td>
                    <td>
                        <a href="{{ route('empleados.detalles', ['id' => $empleado->id]) }}"
                            class="btn-ico" data-placement="top" title="Mostrar detalles">
                            <i class='bx bx-detail me-1'></i>Ver
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    @endif
</div>