<x-app-layout>
    <div class="container">
        <br>

        <!-- Información del equipo -->
        <div class="card mb-4">
            <div class="card-header">
                <h4>Equipment: {{ $equipo->name }}</h4>
            </div>
            <div class="card-body">
                <!-- Aquí va la información actual del equipo -->
                <strong>BRAND:</strong> {{ $equipo->marca }} / <strong>MODEL:</strong> {{ $equipo->model }} /
                <strong>SERIAL:</strong> {{ $equipo->serial }} / <strong>IP:</strong> {{ $equipo->ip }} /
                <strong>SO:</strong> {{ $equipo->so }}
            </div>
        </div>

        <!-- Complementos Asignados -->
        <div class="card mb-4">
            <div class="card-header">
                <p>ASSIGNED COMPLEMENTS</p>
            </div>
            <div class="card-body">
                @if ($complementosAsignados->count() > 0)
                    <ul class="list-group">
                        @foreach ($complementosAsignados as $complemento)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                {{ $complemento->type->name }} / {{ $complemento->brand }} / {{ $complemento->model }} /
                                {{ $complemento->serial }}
                                <form action="{{ route('equipos.complementos.destroy', [$equipo, $complemento]) }}"
                                    method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" data-bs-toggle="tooltip"
                                        data-popup="tooltip-custom" data-bs-placement="top" class="assigned-item"
                                        aria-label="Delete" data-bs-original-title="Desvincular equipo"><i
                                            class='bx bx-trash'></i></button>
                                </form>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p>NO COMPLEMENT ASSIGNED.</p>
                @endif
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <p>ASSIGN COMPLEMENTS</p>
            </div>
            <div class="card-body">
                <table id="officees" class="table footer">
                    <thead class="bg-primary">
                        <tr>
                            <th>TYPE</th>
                            <th>BRAND</th>
                            <th>MODEL</th>
                            <th>SERIAL</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($complementosDisponibles as $complemento)
                            <tr>
                                <td>{{ $complemento->type->name }}</td>
                                <td>{{ $complemento->brand }}</td>
                                <td>{{ $complemento->model }}</td>
                                <td>{{ $complemento->serial }}</td>
                                <td>
                                    <form action="{{ route('equipos.asignar-complementos', $equipo) }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="complements_id[]" value="{{ $complemento->id }}">
                                        <button type="submit" class="btn btn-primary btn-sm">Asignar</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div><br>

        <!-- Formulario para asignar nuevos complementos -->
        <!--div class="card">
            <div class="card-header">
                <h4>ASSIGN COMPLEMENTS</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('equipos.asignar-complementos', $equipo) }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label>Select complement:</label>
                        <select name="complements_id[]" multiple class="form-control" required>
                            @foreach ($complementosDisponibles as $complemento)
<option value="{{ $complemento->id }}">
                                    {{ $complemento->type->name }} / {{ $complemento->brand }} /
                                    {{ $complemento->model }} / {{ $complemento->serial }}
                                </option>
@endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary mt-3">
                        Assign
                    </button>
                </form>
            </div>
        </div-->
    </div>


</x-app-layout>
