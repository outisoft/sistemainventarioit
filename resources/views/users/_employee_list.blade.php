@section('css')
    <link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
@endsection
<div class="table-responsive text-nowrap" id="searchResults">
    @if ($users->isEmpty())
        <h5 class="card-header">No se encontro registro de usuarios.</h5>
    @else
        <table id="usuarios" class="table">
            <thead class="bg-primary">
                <tr>
                    <th>Nombre</th>
                    <th>Correo Electrónico</th>
                    <th>Rol</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody id="employeeList">
                <!-- Aquí se mostrarán los empleados -->
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            @foreach ($user->roles as $rol)
                                {{ $rol->name }}
                                @if (!$loop->last)
                                    , <!-- Agregar coma si no es el último rol -->
                                @endif
                            @endforeach
                        </td>
                        <td>
                            <div class="dropdown">
                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                    data-bs-toggle="dropdown">
                                    <i class="bx bx-dots-vertical-rounded"></i>
                                </button>
                                <div class="dropdown-menu">
                                    <!-- Aquí se agregarán las opciones -->
                                    <a class="dropdown-item" href="{{ route('users.show', $user->id) }}"><i
                                            class="bx bx-show-alt me-1"></i>Ver</a>
                                    <a class="dropdown-item" href="{{ route('users.edit', $user->id) }}"><i
                                            class="bx bx-edit me-1"></i>Editar</a>
                                    <form action="{{ route('users.destroy', $user->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="dropdown-item btn-danger"
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
@section('js')
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <script>
        //new DataTable('#usuarios');
        $('#usuarios').DataTable({
            "searching": false,
            "lengthChange": false,
            "info": false
        });
    </script>
@endsection
