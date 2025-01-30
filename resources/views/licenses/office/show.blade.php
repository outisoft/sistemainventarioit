<x-app-layout>
    <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">
                    <a href="{{ route('office.index') }}" class="btn-ico" data-toggle="tooltip" data-placement="top"
                        title="Regresar">
                        <span>
                            <i class='bx bx-arrow-back'></i>
                        </span>
                    </a>
                    / Licenses / Office /</span> Details </h4>

            <!-- info de licensia -->
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-header">Details <strong>{{ $licencia->type }}</strong></h5>
                </div>

                <div class="content-wrapper">
                    <div class="table-responsive text-nowrap">
                        <div class="card-datatable table-responsive pt-0">
                            <div class="card-body">
                                <!-- Información de la licencia -->
                                <h5 class="card-title">Licencia: {{ $licencia->key }}</h5>
                                <p class="card-text">
                                    <strong>Tipo:</strong> Microsoft Office {{ $licencia->type }}<br>
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
                <div class="content-wrapper">
                    <div class="table-responsive text-nowrap">
                        <div class="card-datatable table-responsive pt-0">
                            <div class="card-body">
                                <!-- Lista de equipos asignados -->
                                <h5>Equipos Asignados</h5>
                                @if ($licencia->equipo->isEmpty())
                                    <p>No hay equipos asignados.</p>
                                @else
                                    <div class="row g-5">
                                        @foreach ($licencia->equipo as $equipo)
                                            <div class="col-md-5 col-xxl-4">
                                                <div class="card h-100">
                                                    <div class="card-body">
                                                        <div class="bg-label-primary rounded-3 text-center mb-4 pt-6">
                                                            <i class='bx bx-desktop bx-lg'></i>
                                                        </div>
                                                        <h5 class="mb-2">{{ $equipo->name }} </h5>
                                                        @if ($equipo->empleados->isNotEmpty())
                                                            <p>{{ $equipo->empleados->first()->name }}</p>
                                                        @else
                                                            <p> Sin asignar</p>
                                                        @endif
                                                        <div class="row mb-4 g-3">
                                                            <div class="col-6">
                                                                <div class="d-flex align-items-center">
                                                                    <div>
                                                                        <h6 class="mb-0 text-nowrap">
                                                                            {{ $equipo->serial }}
                                                                        </h6>
                                                                        <small>Serial</small>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-6">
                                                                <div class="d-flex align-items-center">
                                                                    <div>
                                                                        <h6 class="mb-0 text-nowrap">
                                                                            {{ $equipo->marca }}
                                                                            {{ $equipo->model }}
                                                                        </h6>
                                                                        <small>Model</small>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-12 text-center d-flex aling-items-center">
                                                            <form
                                                                action="{{ route('licencias.desasignar', ['licenciaId' => $licencia->id, 'equipoId' => $equipo->id]) }}"
                                                                method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit"
                                                                    class="btn btn-danger w-100 d-grid">Desasignar</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <!--info de equipos -->
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
                                                    @if ($equipo->empleados->isNotEmpty())
                                                        {{ $equipo->empleados->first()->name }}
                                                    @else
                                                        Sin asignar
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($equipo->license->isEmpty())
                                                        <form
                                                            action="{{ route('licencias.asignar.post', ['licenciaId' => $licencia->id, 'equipoId' => $equipo->id]) }}"
                                                            method="POST">
                                                            @csrf
                                                            <button type="submit"
                                                                class="btn btn-primary btn-sm">Asignar</button>
                                                        </form>
                                                    @else
                                                        <button class="btn btn-secondary btn-sm" disabled>Ya tiene
                                                            licencia</button>
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
            <br>
            <a href="{{ route('office.index') }}" class="btn btn-secondary"><i class='bx bx-arrow-back'></i>Volver</a>

            <hr class="my-5" />

        </div>
        <!-- / Content -->
    </div>
</x-app-layout>
