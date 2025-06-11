<x-app-layout>
    <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">
                    <a href="{{ route('sketchup.index') }}" class="btn-ico" data-toggle="tooltip" data-placement="top"
                        title="Regresar">
                        <span>
                            <i class='bx bx-arrow-back'></i>
                        </span>
                    </a>
                    / Licenses / SketchUp /</span> Details </h4>

            <!-- info de licensia -->
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-header">DETAILS <strong>{{ $licencia->type }}</strong></h5>
                </div>

                <div class="content-wrapper">
                    <div class="table-responsive text-nowrap">
                        <div class="card-datatable table-responsive pt-0">
                            <div class="card-body">
                                <!-- Información de la licencia -->
                                <P class="card-title"><strong>Licensias:</strong> {{ $licencia->key }}</P>
                                <p class="card-text">
                                    <strong>Tipo:</strong> {{ $licencia->type }}<br>
                                    <strong>Asignaciones Máximas:</strong> {{ $licencia->max }}<br>
                                    <strong>Asignaciones Actuales:</strong> {{ $licencia->equipo->count() }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <!--info de asignados -->

            <div class="card">
                <div class="col-12">
                    <ul class="list-group list-group-horizontal-md">
                        @foreach ($licencia->equipo as $equipo)
                            <li class="list-group-item flex-fill p-6 text-body">
                                <h6 class="d-flex align-items-center gap-2"><i
                                        class='icon-base bx bx-desktop'></i>{{ $equipo->name }}
                                </h6>
                                <address class="mb-0">
                                    @if ($equipo->positions->isNotEmpty())
                                        @foreach ($equipo->positions as $position)
                                            {{ $position->employee->name ?? 'N/A' }} -
                                            ({{ $position->position }})
                                        @endforeach
                                    @else
                                        SIN ASIGNAR
                                    @endif <br>
                                    @if ($equipo->positions->isNotEmpty() && $equipo->positions->first()->hotel)
                                        {{ $equipo->positions->first()->hotel->name }}-{{ $equipo->positions->first()->departments->name }}<br>
                                    @else
                                        HOTEL NO ASIGNADO<br>
                                    @endif
                                    {{ $equipo->serial }},<br>
                                    {{ $equipo->marca }}, {{ $equipo->model }},<br>
                                </address>
                                <p class="col-12 text-center d-flex aling-items-center">
                                <form
                                    action="{{ route('sketchup.desasignar', ['licenciaId' => $licencia->id, 'equipoId' => $equipo->id]) }}"
                                    method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger d-grid"><i class='bx bx-trash'></i>
                                    </button>
                                </form>
                                </p>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <br>
            <!--info de equipos -->
            @if ($licencia->equipo->count() >= $licencia->max)
                <div class="alert alert-warning">
                    Límite de asignaciones alcanzado ({{ $licencia->equipo->count() }}/{{ $licencia->max }}). No se
                    pueden asignar más equipos a esta licencia.
                </div>
            @else
                <div class="card">
                    <div class="content-wrapper">
                        <div class="table-responsive text-nowrap">
                            <div class="card-datatable table-responsive pt-0">
                                <div class="card-body">
                                    <h5>Equipos Disponibles</h5>
                                    <table id="officees" class="table footer">
                                        <thead class="bg-primary">
                                            <tr>
                                                <th>Nombre</th>
                                                <th>Descripción</th>
                                                <th>Empleado Asignado</th> <!-- Nueva columna -->
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($equipos as $equipo)
                                                <tr>
                                                    <td>{{ $equipo->name }} / {{ $equipo->ip }}</td>
                                                    <td>{{ $equipo->marca }} - {{ $equipo->model }} -
                                                        {{ $equipo->serial }}
                                                    </td>
                                                    <td>
                                                        @if ($equipo->positions->isNotEmpty())
                                                            @foreach ($equipo->positions as $position)
                                                                {{ $position->employee->name ?? 'N/A' }} -
                                                                ({{ $position->position }})
                                                            @endforeach
                                                        @else
                                                            SIN ASIGNAR
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if ($equipo->license->where('type_id', $licencia->type_id)->isEmpty())
                                                            <form
                                                                action="{{ route('sketchup.asignar.post', ['licenciaId' => $licencia->id, 'equipoId' => $equipo->id]) }}"
                                                                method="POST">
                                                                @csrf
                                                                <button type="submit"
                                                                    class="btn btn-primary btn-sm">Asignar</button>
                                                            </form>
                                                        @else
                                                            <button class="btn btn-secondary btn-sm" disabled>Ya tiene
                                                                licencia de este tipo</button>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            <br>
            <a href="{{ route('sketchup.index') }}" class="btn btn-secondary"><i
                    class='bx bx-arrow-back'></i>Volver</a>

            <hr class="my-5" />

        </div>
        <!-- / Content -->
    </div>
</x-app-layout>
