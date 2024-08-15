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

                                <form method="POST" action="{{ route('asignacion.asignar') }}">
                                    @csrf
                                    <div class="mb-3">
                                        @if ($empleados->isEmpty())
                                            <label class="form-label" for="empleado">No se encontro empleados disponibles.</label> <a href="{{ route('empleados.index') }}">Agregar empleados -></a>
                                        @else
                                            <label class="form-label" for="empleado">Selecciona un Empleado:</label>
                                            <div class="input-group input-group-merge">
                                                <!--span id="basic-icon-default-fullname2" class="input-group-text">
                                                <i class='bx bx-user'></i>
                                            </span-->
                                                <select id="empleado_id" name="empleado_id" class="form-control"
                                                    aria-label="Default select example">
                                                    @foreach ($empleados as $empleado)
                                                        <option value="{{ $empleado->id }}">{{ $empleado->name }} -
                                                            {{ $empleado->hotel->name }} -
                                                            {{ $empleado->departamento->name }} - {{ $empleado->puesto }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        @if ($equiposSinAsignar->isEmpty())
                                            <label class="form-label" for="empleado">No se encontro equipos disponibles.</label> <a href="{{ route('equipo.create') }}">Agregar equipos -></a>
                                        @else
                                            <label class="form-label" for="equipo">Selecciona un Equipo:</label>
                                            <div class="input-group input-group-merge">
                                                <!--span id="basic-icon-default-fullname2" class="input-group-text">
                                                <i class='bx bx-desktop'></i>
                                            </span-->
                                                <select name="equipo_id" class="form-control">
                                                    @foreach ($equiposSinAsignar as $equipo)
                                                        <option value="{{ $equipo->id }}">{{ $equipo->tipo->name }} - {{ $equipo->name }}
                                                            {{ $equipo->marca }} - {{ $equipo->model }}</option>
                                                    @endforeach
                                                </select>

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
                                        <th>Nombre</th>
                                        <th>Ubicacion</th>
                                        <th>Equipo(s)</th>
                                        <th>Detalles</th>
                                    </tr>
                                </thead>
                                <tbody id="employeeList">
                                    <!-- Aquí se mostrarán los empleados -->
                                    @foreach ($empleadosConEquipos as $empleado)
                                        <tr>
                                            <td>
                                                <div style="display: flex; align-items: center;">
                                                    <img src="{{ asset('uploads/gp-Logo.png') }}" alt="user-avatar" class="employee-image"/>
                                                    <span class="employee-name" style="margin-left: 15px;">{{ Str::limit($empleado->name, 20, '...'); }}</span>
                                                </div>
                                            </td>

                                            <td class="employee-position">
                                                {{ $empleado->departamento->name }} / {{ $empleado->hotel->name }}
                                            </td>
                                            <td>
                                                <div class="assigned-items">
                                                    @foreach ($empleado->equipos as $equipo)
                                                        <span class="assigned-item">{{ $equipo->tipo->name }}</span>
                                                    @endforeach
                                                </div>
                                            </td>
                                            <!--td>                                           
                                                @foreach ($empleado->equipos as $equipo)
                                                    {{ $equipo->tipo->name }}
                                                    <a href="{{ route('asignacion.desvincular', ['empleado_id' => $empleado->id, 'equipo_id' => $equipo->id]) }}"
                                                        class="btn btn-danger btn-sm">X</a>
                                                @endforeach
                                            </td-->
                                            <td>
                                                <a href="{{ route('empleados.detalles', ['id' => $empleado->id]) }}"
                                                    class="btn-ico" data-placement="top" title="Mostrar detalles">
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
