<x-app-layout>
    <div class="container-xxl navbar-expand-xl align-items-center">
        <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
          <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
            <i class="bx bx-menu bx-sm"></i>
          </a>
        </div>
      </div>
    <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Empleados /</span> Asignacion </h4>
    
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
                                    <label class="form-label" for="empleado">Selecciona un Empleado:</label>
                                    <div class="input-group input-group-merge">
                                        <!--span id="basic-icon-default-fullname2" class="input-group-text">
                                            <i class='bx bx-user'></i>
                                        </span-->
                                        <select id="empleado_id" name="empleado_id" class="form-control" aria-label="Default select example">
                                            @foreach ($empleados as $empleado)
                                                <option value="{{ $empleado->id }}">{{ $empleado->name }} - {{ $empleado->hotel->nombre }} - {{ $empleado->departamento->name }} - {{ $empleado->puesto }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                        
                                <div class="form-group">
                                    @if ($equiposSinAsignar->isEmpty())
                                        <h5 class="card-header">No se encontro equipos disponibles.</h5>
                                    @else
                                        <label class="form-label" for="equipo">Selecciona un Equipo:</label>
                                        <div class="input-group input-group-merge">
                                            <!--span id="basic-icon-default-fullname2" class="input-group-text">
                                                <i class='bx bx-desktop'></i>
                                            </span-->
                                            <select name="equipo_id" class="form-control">
                                                @foreach($equiposSinAsignar as $equipo)
                                                    <option value="{{ $equipo->id }}">{{ $equipo->tipo->name }} - {{ $equipo->marca }} - {{ $equipo->modelo }}</option>
                                                @endforeach
                                            </select>
                                            
                                        </div>
                                    @endif
                                </div>
                                <br>
                                <button type="submit" class="btn btn-primary">Asignar Equipo</button>
                            </form>
                            <br>
                            <hr class="my-0">
                            <br>
                            <h5 class="card-header">Equipos asignados.</h5>
                            @if ($empleadosConEquipos->isEmpty())
                                <h5 class="card-header">No se encontro asignaciones entre empleados y equipos.</h5>
                            @else
                                <ul>
                                    @foreach ($empleadosConEquipos as $empleado)
                                        <li>
                                            {{ $empleado->name }}:
                                            @foreach ($empleado->equipos as $equipo)
                                                {{ $equipo->tipo->name }}
                                                <a href="{{ route('asignacion.desvincular', ['empleado_id' => $empleado->id, 'equipo_id' => $equipo->id]) }}" class="btn btn-danger btn-sm">X</a>
                                            @endforeach
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                        </div>
                    </div>            
                  </div>
                </div>
            </div>
            <!--/ Basic Bootstrap Table -->
    
            <hr class="my-5" />
    
        </div>
        <!-- / Content -->
      </div>
    <script>

    
</x-app-layout>
