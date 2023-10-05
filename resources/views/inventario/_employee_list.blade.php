<div class="table-responsive text-nowrap" id="searchResults">
    @if ($inventario->isEmpty())
        <h5 class="card-header">No se encontro registro.</h5>
    @else
    <table class="table">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Cantidad</th>
                <th>Precio</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody class="table-border-bottom-0">
            @foreach($inventario as $inv)
            <tr>
                <td>{{ $inv->nombre }}</td>
                <td>{{ $inv->cantidad }}</td>
                <td>{{ $inv->precio }}</td>
                <td>
                    <div class="dropdown">
                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                            <i class="bx bx-dots-vertical-rounded"></i>
                        </button>
                        <div class="dropdown-menu">
                            <!-- Aquí se agregarán las opciones -->
                            <a class="dropdown-item" href="{{ route('inventario.show', $inv->id) }}"><i class="bx bx-show-alt me-1"></i>Ver</a>
                            <a class="dropdown-item" href="{{ route('inventario.edit', $inv->id) }}"><i class="bx bx-edit me-1"></i>Editar</a>
                            <form action="{{ route('inventario.destroy', $inv->id) }}" method="POST">
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