<x-app-layout>
    <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"> Asignacion /</span> Detalles </h4>

            <!-- Basic Bootstrap Table -->
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-header">Detalles de <strong>{{ $empleado->name }} </strong></h5>
                    <div class="navbar-nav align-items-center">
                        <div class="nav-item d-flex align-items-center">
                            <a href="{{ route('generateQRCode', $empleado->id) }}" target="_blank" class="btn-ico" data-placement="top" title="Codigo QR">
                                <i class='bx bx-qr-scan icon-lg'></i>
                            </a>
                            <a href="{{ route('save-pdf', $empleado->id) }}" target="_blank" class="btn-ico" data-placement="top" title="Hoja de resguardo">
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
                                    <th>Sistema Operativo</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody id="employeeList">
                                <!-- Aquí se mostrarán los empleados -->
                                @foreach ($equiposAsignados as $equipo)
                                    <tr>
                                        <td>
                                            {{ $equipo->tipo->name }}
                                        </td>
                                        <td>
                                            {{ $equipo->orden }}
                                        </td>
                                        <td>
                                            {{ $equipo->marca }}
                                        </td>
                                        <td>
                                            {{ $equipo->model }}
                                        </td>
                                        <td>
                                            {{ $equipo->serial }}
                                        </td>
                                        <td>
                                            {{ $equipo->name }}
                                        </td>
                                        <td>
                                            {{ $equipo->ip }}
                                        </td>
                                        <td>
                                            {{ $equipo->so }}
                                        </td>
                                        <td>
                                            <a href="{{ route('desvincular', ['empleado_id' => $empleado->id, 'equipo_id' => $equipo->id]) }}"
                                                class="btn btn-danger btn-sm"><i class='bx bx-trash'></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <br>
                        <div class="card-header">
                            <h5 class="card-header">Complementos Asignados</strong></h5>
                        </div>
                        @if ($complementosAsignados->count() > 0)
                            <table id="empleados" class="table table-striped footer">
                                <thead class="bg-primary">
                                    <tr>
                                        <th>Tipo de quipo</th>
                                        <th>Marca</th>
                                        <th>Modelo</th>
                                        <th>Serie</th>
                                    </tr>
                                </thead>
                                <tbody id="employeeList">
                                    <!-- Aquí se mostrarán los empleados -->
                                    @foreach ($complementosAsignados as $complemento)
                                        <tr>
                                            <td>
                                                {{ $complemento->type->name }}
                                            </td>
                                            <td>
                                                {{ $complemento->brand }}
                                            </td>
                                            <td>
                                                {{ $complemento->model }}
                                            </td>
                                            <td>
                                                {{ $complemento->serial }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <p>No hay complementos asignados.</p>
                        @endif
                        <br>
                        <a href="{{ route('assignment.index') }}" class="btn btn-secondary"><i
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
