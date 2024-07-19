<x-app-layout>
    <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"> Asignacion /</span> Detalles </h4>

            <!-- Basic Bootstrap Table -->
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-header">Detalles de <strong>{{ $empleado->name }}</strong></h5>
                    <div class="navbar-nav align-items-center">
                        <div class="nav-item d-flex align-items-center">
                            <a href="{{ route('empleado.save-pdf', $empleado->id) }}" target="_blank" class="btn-ico" data-placement="top" title="Hoja de resguardo">
                                <i class='bx bxs-file-pdf icon-lg'></i>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="content-wrapper">
                    <div class="table-responsive text-nowrap">
                        <div class="card-datatable table-responsive pt-0">
                            <div class="card-body">
                                <table class="table" BORDER=1 CELLPADDING=5 CELLSPACING=5>
                                    <tr>
                                        <th class="bg-secondary">No. Colaborador</th>
                                        <td>{{ $empleado->no_empleado }}</td>
                                    </tr>
                                    <tr>
                                        <th class="bg-secondary">Nombre</th>
                                        <td>{{ $empleado->name }}</td>
                                    </tr>
                                    <tr>
                                        <th class="bg-secondary">Correo</th>
                                        <td>{{ $empleado->email }}</td>
                                    </tr>
                                    <tr>
                                        <th class="bg-secondary">Puesto</th>
                                        <td>{{ $empleado->puesto }}</td>
                                    </tr>
                                    <tr>
                                        <th class="bg-secondary">Departamento</th>
                                        <td>{{ $departamento->name }}</td>
                                    </tr>
                                    <tr>
                                        <th class="bg-secondary">Hotel</th>
                                        <td>{{ $hotel->name }}</td>
                                    </tr>
                                    <tr>
                                        <th class="bg-secondary">AD</th>
                                        <td>{{ $empleado->ad }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-header">Equipos asignados</strong></h5>
                </div>

                <div class="card-datatable table-responsive pt-0">
                    <div class="table-responsive text-nowrap" id="searchResults">

                        <table id="empleados" class="table table-striped footer">
                            <thead class="bg-primary">
                                <tr>
                                    <th>Tipo de quipo</th>
                                    <th>Orden de compra</th>
                                    <th>Marca</th>
                                    <th>Modelo</th>
                                    <th>Serie</th>
                                    <th>Nombre de equipo</th>
                                    <th>IP</th>
                                    <th>Contrato</th>
                                    <th>Nombre de App</th>
                                    <th>Sistema Operativo</th>
                                    <th>Office</th>
                                    <th>Clave de activaciion</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody id="employeeList">
                                <!-- Aquí se mostrarán los empleados -->
                                @foreach ($empleado->equipos as $equipo)
                                    <tr>
                                        <td>
                                            @if (!empty($equipo->tipo->name))
                                                {{ $equipo->tipo->name }}
                                            @else
                                                Null
                                            @endif
                                        </td>
                                        <td>
                                            @if (!empty($equipo->orden))
                                                {{ $equipo->orden }}
                                            @else
                                                Null
                                            @endif
                                        </td>
                                        <td>
                                            @if (!empty($equipo->marca))
                                                {{ $equipo->marca }}
                                            @else
                                                Null
                                            @endif
                                        </td>
                                        <td>
                                            @if (!empty($equipo->modelo))
                                                {{ $equipo->modelo }}
                                            @else
                                                Null
                                            @endif
                                        </td>
                                        <td>
                                            @if (!empty($equipo->serie))
                                                {{ $equipo->serie }}
                                            @else
                                                Null
                                            @endif
                                        </td>
                                        <td>
                                            @if (!empty($equipo->nombre_equipo))
                                                {{ $equipo->nombre_equipo }}
                                            @else
                                                Null
                                            @endif
                                        </td>
                                        <td>
                                            @if (!empty($equipo->ip))
                                                {{ $equipo->ip }}
                                            @else
                                                Null
                                            @endif
                                        </td>
                                        <td>
                                            @if (!empty($equipo->no_contrato))
                                                {{ $equipo->no_contrato }}
                                            @else
                                                Null
                                            @endif
                                        </td>
                                        <td>
                                            @if (!empty($equipo->nombre_app))
                                                {{ $equipo->nombre_app }}
                                            @else
                                                Null
                                            @endif
                                        </td>
                                        <td>
                                            @if (!empty($equipo->so))
                                                {{ $equipo->so }}
                                            @else
                                                Null
                                            @endif
                                        </td>
                                        <td>
                                            @if (!empty($equipo->office))
                                                {{ $equipo->office }}
                                            @else
                                                Null
                                            @endif
                                        </td>
                                        <td>
                                            @if (!empty($equipo->clave))
                                                {{ $equipo->clave }}
                                            @else
                                                Null
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('asignacion.desvincular', ['empleado_id' => $empleado->id, 'equipo_id' => $equipo->id]) }}"
                                                class="btn btn-danger btn-sm"><i class='bx bx-trash'></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <br>
                        <a href="{{ route('asignacion.index') }}" class="btn btn-secondary"><i
                                class='bx bx-arrow-back'></i>Volver</a>
                        <br>
                    </div>
                </div>
            </div>
            <!--/ Basic Bootstrap Table -->
            <hr class="my-5" />
        </div>
        <!-- / Content -->
    </div>
</x-app-layout>
