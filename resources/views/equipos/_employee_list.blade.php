<div class="table-responsive text-nowrap" id="searchResults">
    
    @if ($equipos->isEmpty())
        <h5 class="card-header">No se encontro registro de equipos.</h5>
    @else
        <table class="table">
            <thead>
                <tr>
                    <th></th>
                    <th>Tipo</th>
                    <th>Numero de equipo</th>
                    <th>Estado</th>
                    <th>Marca</th>
                    <th>Modelo</th>
                    <!-- Otros encabezados de columnas según sea necesario -->
                </tr>
            </thead>
            <tbody>
                @foreach ($equipos as $equipo)
                <tr>
                    <td></td>
                    <td>{{ $equipo->tipo}}</td>
                    <td>{{ $equipo->no_equipo}}</td>
                    <td>
                        @if ($equipo->estado === 'libre')
                            <span class="badge bg-label-success">Libre</span-->
                            <!--span class="badge rounded-pill bg-success">Libre</span-->
                        @elseif ($equipo->estado === 'en uso')
                            <span class="badge bg-label-danger">En uso</span>
                            <!--span class="badge rounded-pill bg-danger">En uso</span-->
                        @endif
                    </td>
                    <td>{{ $equipo->marca }}</td>
                    <td>{{ $equipo->modelo }}</td>
                    <!-- Otros campos de la tabla -->
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
