<x-app-layout>
    @section('css')
        <link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    @endsection
    <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="fw-bold py-3 mb-4">Asignacion </h4>

            <!-- Basic Bootstrap Table -->
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-header">Asignacion de equipo</h5>
                </div>
                <div class="content-wrapper">
                    <div class="table-responsive text-nowrap">
                        <div class="card-datatable table-responsive pt-0">
                            <div class="container">

                                <form method="POST" action="{{ route('asignar') }}" id="colaboradorForm">
                                    @csrf
                                    
                                    <style>
                                        .form-row {
                                            display: flex;
                                            gap: 10px; /* Espacio entre los inputs */
                                        }
                                        .form-group {
                                            flex: 1; /* Ajusta el tamaño de los inputs */
                                        }
                                    </style>
                                    <div class="mb-3">
                                        @if ($empleados->isEmpty())
                                            <label class="form-label" for="empleado">No se encontro empleados disponibles.</label> <a href="{{ route('empleados.index') }}">Agregar empleados -></a>
                                        @else
                                            <!-- Buscador de Colaborador -->
                                            <div class="form-group">
                                                <label class="form-label" for="search_employee">Buscar Empleado</label>
                                                <div class="input-group input-group-merge">

                                                    <x-text-input id="search_employee" class="form-control" type="text" placeholder="Buscar por No. Colaborador, AD o email"
                                                        name="search_employee" />
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="form-group" style="display: none;">
                                                    <label for="id_empleado">id</label>
                                                    <input type="text" id="empleado_id" class="form-control" name="empleado_id">
                                                </div>
                                                
                                                <!-- Numero de Colaborador -->
                                                <div class="form-group">
                                                    <label class="form-label" for="basic-icon-default-fullname">Numero de Colaborador</label>
                                                    <div class="input-group input-group-merge">

                                                        <x-text-input id="no_empleado" class="form-control" type="number"
                                                            name="no_empleado" disabled />
                                                    </div>
                                                </div>

                                                <!-- Nombre de Colaborador -->
                                                <div class="form-group">
                                                    <label class="form-label" for="basic-icon-default-fullname">Nombre de Colaborador</label>
                                                    <div class="input-group input-group-merge">

                                                        <x-text-input id="name" class="form-control" type="text"
                                                            name="name" disabled />
                                                    </div>
                                                </div>
                                                <!-- Email de Colaborador -->
                                                <div class="form-group">
                                                    <label class="form-label" for="basic-icon-default-fullname">Email</label>
                                                    <div class="input-group input-group-merge">

                                                        <x-text-input id="email" class="form-control" type="email"
                                                            name="email" disabled />
                                                    </div>
                                                </div>
                                                <!-- AD de Colaborador -->
                                                <div class="form-group">
                                                    <label class="form-label" for="basic-icon-default-fullname">AD</label>
                                                    <div class="input-group input-group-merge">

                                                        <x-text-input id="ad" class="form-control" type="text"
                                                            name="ad" disabled />
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                    <hr class="my-0">
                                    <div class="form-group">
                                        @if ($equiposSinAsignar->isEmpty())
                                            <label class="form-label" for="empleado">No se encontro equipos disponibles.</label> <a href="{{ route('equipo.index') }}">Agregar equipos -></a>
                                        @else        
                                            <!-- Buscador de equipo -->
                                            <div class="form-group">
                                                <label class="form-label" for="search_equipment">Buscar equipo</label>
                                                <div class="input-group input-group-merge">

                                                    <x-text-input id="search_equipment" class="form-control" type="text" placeholder="Buscar por Numero de serie o nombre de equipo" 
                                                        name="search_equipment" />
                                                </div>
                                            </div>
                                            
                                            <div class="form-row">
                                                    <div class="form-group" style="display: none;">
                                                        <label for="equipo_id">id</label>
                                                        <input type="text" id="equipo_id" class="form-control" name="equipo_id">
                                                    </div>

                                                    <!-- Numero de serie de equipo -->
                                                    <div class="form-group">
                                                        <label class="form-label" for="serial">Numero de serie</label>
                                                        <div class="input-group input-group-merge">

                                                            <x-text-input id="serial" class="form-control" type="text" disabled
                                                                name="serial" />
                                                        </div>
                                                    </div>

                                                    <!-- Nombre del equipo -->
                                                    <div class="form-group">
                                                        <label class="form-label" for="nameE">Nombre del equipo</label>
                                                        <div class="input-group input-group-merge">

                                                            <x-text-input id="nameE" class="form-control" type="text" disabled
                                                                name="nameE" />
                                                        </div>
                                                    </div>

                                                    <!-- Marca del equipo -->
                                                    <div class="form-group">
                                                        <label class="form-label" for="marca">Marca</label>
                                                        <div class="input-group input-group-merge">

                                                            <x-text-input id="marca" class="form-control" type="text" disabled
                                                                name="marca" />
                                                        </div>
                                                    </div>

                                                    <!-- Modelo del equipo -->
                                                    <div class="form-group">
                                                        <label class="form-label" for="model">Modelo</label>
                                                        <div class="input-group input-group-merge">

                                                            <x-text-input id="model" class="form-control" type="text" disabled
                                                                name="model" />
                                                        </div>
                                                    </div>
                                                </div>
                                        @endif
                                    </div>
                                    <br>
                                    @if ($equiposSinAsignar->isEmpty())
                                    @else
                                        <button type="submit" class="btn btn-primary">Asignar Equipo</button>
                                    @endif
                                </form>
                                <br>
                                <hr class="my-0">
                            </div>
                        </div>
                    </div>
                </div>
                @if ($empleadosConEquipos->isEmpty())
                    <label class="form-label card-header" for="empleado">No se encontro asignaciones entre empleados y equipos.</label>
                @else

                    <div class="card-datatable table-responsive pt-0">
                        <div class="table-responsive text-nowrap" id="searchResults">
                            <table id="asignacion" class="table table-striped footer">
                                <thead class="bg-primary">
                                    <tr>
                                        <th>Empleado</th>
                                        <th>Ubicacion</th>
                                        <th>Equipo(s)</th>
                                        <th>Detalles</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody id="employeeList">
                                    <!-- Aquí se mostrarán los empleados -->
                                    @foreach ($empleadosConEquipos as $empleado)
                                        <tr>
                                            <td>
                                                <div style="display: flex; align-items: center;">
                                                    <img src="{{ asset('uploads/gp-Logo.png') }}" alt="user-avatar" class="employee-image"/>
                                                    <span class="employee-name" style="margin-left: 15px;">{{ Str::limit($empleado->name, 20, '...'); }} (#{{$empleado->no_empleado}})</span>
                                                </div>
                                            </td>

                                            <td class="employee-position">
                                                {{ $empleado->hotel->name }} / {{ $empleado->departments->name }}
                                            </td>
                                            <td>
                                                <div class="assigned-items">
                                                    @foreach ($empleado->equipos as $equipo)
                                                        <span data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="assigned-item" aria-label="{{ $equipo->name }}/{{ $equipo->serial }}" data-bs-original-title="{{ $equipo->name }}/{{ $equipo->serial }}" >{{ $equipo->tipo->name }}
                                                            <a data-placement="top" title="Desvincular equipo" href="{{ route('desvincular', ['empleado_id' => $empleado->id, 'equipo_id' => $equipo->id]) }}">X</a>
                                                        </span>
                                                    @endforeach
                                                </div>
                                            </td>
                                            <td>
                                                {{ $equipo->name }}
                                            </td>
                                            <td>
                                                <a href="{{ route('assignment.show', $empleado->id) }}" class="btn-ico" data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="assigned-item" aria-label="Mostrar detalles" data-bs-original-title="Mostrar detalles">
                                                    <i class='bx bx-detail me-1'></i>Ver
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                @endif
            </div>
            <!--/ Basic Bootstrap Table -->

            <hr class="my-5" />

        </div>
        <!-- / Content -->
    </div>
</x-app-layout>

<script>
    document.getElementById('search_equipment').addEventListener('input', function() {
        let numeroSerie = this.value;

        if (numeroSerie.length > 0) {
            fetch(`/equipos/${numeroSerie}`)
                .then(response => response.json())
                .then(data => {
                    if (data.error) {
                        alert(data.error);
                    } else {
                        document.getElementById('equipo_id').value = data.id;
                        document.getElementById('serial').value = data.serial;
                        document.getElementById('nameE').value = data.name;
                        document.getElementById('marca').value = data.marca;
                        document.getElementById('model').value = data.model;
                        // Rellena otros campos según los datos obtenidos
                    }
                })
                .catch(error => console.error('Error:', error));
        }
    });
</script>

<script>
    document.getElementById('search_employee').addEventListener('input', function() {
        let numeroColaborador = this.value;

        if (numeroColaborador.length > 0) {
            fetch(`/empleado/${numeroColaborador}`)
                .then(response => response.json())
                .then(data => {
                    if (data.error) {
                        alert(data.error);
                    } else {
                        document.getElementById('empleado_id').value = data.id;
                        document.getElementById('no_empleado').value = data.no_empleado;
                        document.getElementById('name').value = data.name;
                        document.getElementById('email').value = data.email;
                        document.getElementById('ad').value = data.ad;
                        // Rellena otros campos según los datos obtenidos
                    }
                })
                .catch(error => console.error('Error:', error));
        }
    });
</script>

