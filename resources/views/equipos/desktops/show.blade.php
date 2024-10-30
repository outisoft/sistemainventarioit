<x-app-layout>
    <div class="container">
        <br>
        
        <!-- Información del equipo -->
        <div class="card mb-4">
            <div class="card-header">
                <h4>Equipo: {{ $equipo->name }}</h4>
            </div>
            <div class="card-body">
                <!-- Aquí va la información actual del equipo -->
                <strong>MARCA:</strong> {{ $equipo->marca }} / <strong>MODELO:</strong> {{ $equipo->model }} / <strong>SERIAL:</strong> {{ $equipo->serial }} / <strong>IP:</strong> {{ $equipo->ip}} / <strong>SO:</strong> {{ $equipo->so }} 
            </div>
        </div>

        <!-- Complementos Asignados -->
        <div class="card mb-4">
            <div class="card-header">
                <h4>Complementos Asignados</h4>
            </div>
            <div class="card-body">
                @if($complementosAsignados->count() > 0)
                    <ul class="list-group">
                        @foreach($complementosAsignados as $complemento)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                {{ $complemento->type->name }} / {{ $complemento->brand }} / {{ $complemento->model }} / {{ $complemento->serial }}
                                <form action="{{ route('equipos.complementos.destroy', [$equipo, $complemento]) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="assigned-item" aria-label="Desvincular equipo" data-bs-original-title="Desvincular equipo"><i class='bx bx-trash'></i></button>
                                </form>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p>No hay complementos asignados.</p>
                @endif
            </div>
        </div>

        <!-- Formulario para asignar nuevos complementos -->
        <div class="card">
            <div class="card-header">
                <h4>Asignar Nuevos Complementos</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('equipos.asignar-complementos', $equipo) }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label>Seleccionar Complementos:</label>
                        <select name="complements_id[]" multiple class="form-control" required>
                            @foreach($complementosDisponibles as $complemento)
                                <option value="{{ $complemento->id }}">
                                    {{ $complemento->type->name}} / {{ $complemento->brand }} / {{ $complemento->model }} / {{ $complemento->serial }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary mt-3">
                        Asignar Complementos
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>