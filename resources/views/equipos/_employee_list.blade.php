<div class="table-responsive text-nowrap" id="searchResults">
    <table class="table">
        <thead>
            <tr>
                <th></th>
                <th>Tipo de equipo</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody id="employeeList">
            <!-- Aquí se mostrarán los empleados -->
            @foreach($equipos as $equipo)
                <tr>
                    <td></td>
                    <td>{{ $equipo->tipo }}</td>
                    <td>
                        <div class="dropdown">
                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                <img width="15" height="15" src="https://img.icons8.com/ios-glyphs/30/menu-2.png" alt="menu-2"/>
                            </button>
                            <div class="dropdown-menu">
                                <a href="{{ route('equipo.show', $equipo->id) }}" class="dropdown-item">
                                    <i class="bx bx-show-alt me-1"></i> Show
                                </a>
                                <a href="{{ route('equipo.edit', $equipo->id) }}" class="dropdown-item" href="javascript:void(0);">
                                    <i class="bx bx-edit me-1"></i> Edit
                                </a>
                                <form class="dropdown-item" action="{{ route('equipo.destroy', $equipo->id) }}" method="POST" class="d-inline">
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
