<div class="table-responsive text-nowrap" id="searchResults">
    @if ($empleados->isEmpty())
        <h5 class="card-header">No se encontro registro de empleados.</h5>
    @else
    <table class="table">
        <thead>
            <tr>
                <th></th>
                <th>Nombre</th>
                <th>Puesto</th>
                <th>Hotel</th>
                <th>Departamento</th>
                <th>Ad</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody id="employeeList">
            <!-- Aquí se mostrarán los empleados -->
            @foreach($empleados as $empleado)
                <tr>
                    <td></td>
                    <td>{{ $empleado->name }}</td>
                    <td>{{ $empleado->puesto }}</td>
                    <td>{{ $empleado->hotel->nombre }}</td>
                    <td>{{ $empleado->departamento->name }}</td>
                    <!--td>{{ $empleado->equipo?->tipo ?? 'Sin equipo asignado' }}</td-->
                    <td>{{ $empleado->ad }}</td>
                    <td>
                        <div class="dropdown">
                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                <i class="bx bx-dots-vertical-rounded"></i>
                            </button>
                            <div class="dropdown-menu">
                                <!-- Aquí se agregarán las opciones -->
                                <a class="dropdown-item" href="{{ route('empleados.show', $empleado->id) }}"><i class="bx bx-show-alt me-1"></i>Ver</a>
                                <a class="dropdown-item" href="{{ route('empleados.edit', $empleado->id) }}"><i class="bx bx-edit me-1"></i>Editar</a>
                                <form action="{{ route('empleados.destroy', $empleado->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="dropdown-item btn-danger" onclick="return confirm('¿Estás seguro de eliminar este equipo?')"><i class="bx bx-trash me-1"></i>Eliminar</button>
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
