
    <h1>Historial de Cambios para {{ $registro->nombre }}</h1>

    <table class="table">
        <thead>
            <tr>
                <th>Acción</th>
                <th>Descripción</th>
                <th>Fecha y Hora</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($historial as $registroHistorial)
                <tr>
                    <td>{{ $registroHistorial->accion }}</td>
                    <td>{{ $registroHistorial->descripcion }}</td>
                    <td>{{ $registroHistorial->created_at }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    
    <a href="{{ route('inventario.index') }}" class="btn btn-secondary">Volver</a>

