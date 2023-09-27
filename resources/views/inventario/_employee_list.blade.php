<div class="table-responsive text-nowrap" id="searchResults">
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
                            <img width="15" height="15" src="https://img.icons8.com/ios-glyphs/30/menu-2.png" alt="menu-2"/>
                        </button>
                        <div class="dropdown-menu">
                            <a href="{{ route('inventario.show', $inv->id) }}" class="dropdown-item">
                                <i class="bx bx-show-alt me-1"></i> Show
                            </a>
                            <a href="{{ route('inventario.edit', $inv->id) }}" class="dropdown-item" href="javascript:void(0);">
                                <i class="bx bx-edit me-1"></i> Edit
                            </a>
                            <form class="dropdown-item" action="{{ route('inventario.destroy', $inv->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit">
                                    <i class="bx bx-trash me-1"></i> Eliminar
                                </button>
                            </form>
                        </div>
                    </div>                                                                                        
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>