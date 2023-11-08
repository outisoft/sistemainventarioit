<x-app-layout>
    <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Empleados /</span> Detalles </h4>
    
            <!-- Basic Bootstrap Table -->
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-header">Detalles de <strong>{{ $empleado->name }}</strong></h5>
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
                                        <td>{{ $hotel->nombre }}</td>
                                    </tr>
                                    <tr>
                                        <th class="bg-secondary">AD</th>
                                        <td>{{ $empleado->ad }}</td>
                                    </tr>
                                </table>
                                
                                <br>
                                <a href="{{ route('empleados.index') }}" class="btn btn-secondary"><i class='bx bx-arrow-back'></i>Volver</a>
                                @can('empleados.edit')
                                    <!--a href="{{ route('empleados.edit', $empleado->id) }}" class="btn btn-primary">
                                        <i class="bx bx-edit me-1"></i>
                                        Editar
                                    </a-->                            
                                @endcan
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-header">Equipos asignados</strong></h5>
                </div>

                <div class="content-wrapper">
                    <div class="table-responsive text-nowrap">
                        <div class="card-datatable table-responsive pt-0">
                            <div class="card-body">
                                <table class="table" BORDER=1 CELLPADDING=5 CELLSPACING=5>
                                    <tr>
                                        <th class="bg-secondary">Equipos vinculados</th>
                                    </tr>
                                    <tr>
                                        @foreach ($empleado->equipos as $equipo)
                                            {{ $equipo->tipo->name }}
                                            <a href="{{ route('asignacion.desvincular', ['empleado_id' => $empleado->id, 'equipo_id' => $equipo->id]) }}" class="btn btn-danger btn-sm">X</a>
                                        @endforeach
                                    </tr>
                                </table>
                                
                                <br>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-datatable table-responsive pt-0">
                    <div class="table-responsive text-nowrap" id="searchResults">
                        
                            <h5 class="card-header">No se encontro equipos asignados al empleado.</h5>
                        
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
                                        <td> {{ $equipo->orden }} </td>
                                        <td> {{ $equipo->marca }} </td>
                                        <td> {{ $equipo->modelo }} </td>
                                        <td> {{ $equipo->serie }} </td>
                                        <td> {{ $equipo->nombre_equipo }} </td>
                                        <td> {{ $equipo->ip }} </td>
                                        <td> {{ $equipo->no_contrato }} </td>
                                        <td> {{ $equipo->nombre_app }} </td>
                                        <td> {{ $equipo->so }} </td>
                                        <td> {{ $equipo->office }} </td>
                                        <td> {{ $equipo->clave }} </td>
                                        <td>
                                            <a href="{{ route('asignacion.desvincular', ['empleado_id' => $empleado->id, 'equipo_id' => $equipo->id]) }}" class="btn btn-danger btn-sm">X</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        
                    </div>
                </div>

            </div>
            <!--/ Basic Bootstrap Table -->
    
            <hr class="my-5" />
    
        </div>
        <!-- / Content -->
      </div>
</x-app-layout>
