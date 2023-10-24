<div class="table-responsive text-nowrap" id="searchResults">
    
    @if ($equipos->isEmpty())
        <h5 class="card-header">No se encontro registro de equipos.</h5>
    @else
        <table class="table">
            <thead>
                <tr>
                    <th></th>
                    <th>Tipo</th>
                    <th>Marca</th>
                    <th>Modelo</th>
                    <th>Nombre del Equipo</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                    <!-- Otros encabezados de columnas según sea necesario -->
                </tr>
            </thead>
            <tbody>
                @foreach ($equipos as $equipo)
                <tr>
                    <td></td>
                    <td>{{ $equipo->tipo->name}}</td>
                    <td>{{ $equipo->marca }}</td>
                    <td>{{ $equipo->modelo }}</td>
                    <td>{{ $equipo->nombre_equipo }}</td>
                    <td>
                        @if ($equipo->estado === 'Libre')
                            <span class="badge bg-label-success">{{$equipo->estado}}</td></span-->
                            <!--span class="badge rounded-pill bg-success">Libre</span-->
                        @elseif ($equipo->estado === 'En Uso')
                            <span class="badge bg-label-danger">{{$equipo->estado}}</span>
                            <!--span class="badge rounded-pill bg-danger">En uso</span-->
                        @endif
                    </td>
                    <td>
                        <div class="dropdown">
                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                <i class="bx bx-dots-vertical-rounded"></i>
                            </button>
                            <div class="dropdown-menu">
                                <!-- Aquí se agregarán las opciones -->
                                <a class="dropdown-item" href="{{ route('equipo.show', $equipo->id) }}"><i class="bx bx-show-alt me-1"></i>Ver</a>
                                <a class="dropdown-item" href="{{ route('equipo.edit', $equipo->id) }}"><i class="bx bx-edit me-1"></i>Editar</a>
                                <form action="{{ route('equipo.destroy', $equipo->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="dropdown-item btn-danger" onclick="return confirm('¿Estás seguro de eliminar este equipo?')"><i class="bx bx-trash me-1"></i>Eliminar</button>
                                </form>
                            </div>
                        </div>
                    </td>
                    <!-- Otros campos de la tabla -->
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
