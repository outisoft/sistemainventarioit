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
                        <div class="card-body">
                            <!-- Formulario para asignar un equipo a un empleado -->
                            <form action="{{ route('asignar.equipo') }}" method="POST">
                                @csrf
                                <!-- Empleado -->
                                <div class="mb-3">
                                    <label for="empleado_id" class="form-label">Selecciona un empleado</label>
                                    <div class="input-group input-group-merge">
                                        <span id="basic-icon-default-fullname2" class="input-group-text">
                                            <i class='bx bx-user-plus' ></i>
                                        </span>
                                        <select name="empleado_id" id="empleado_id" class="form-control"  aria-label="Default select example">
                                            @foreach ($vincular as $empleado)
                                                <option value="{{ $empleado->id }}">{{ $empleado->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    
                                    <label for="equipo_id" class="form-label">Selecciona un Equipo:</label>
                                    <div class="input-group input-group-merge">
                                        <span id="basic-icon-default-fullname2" class="input-group-text">
                                            <i class='bx bx-desktop'></i>
                                        </span>
                                        <select class="form-control" name="equipo_id" id="equipo_id" aria-label="Default select example">
                                            @foreach ($equipos as $equipo)
                                                <option value="{{ $equipo->id }}">{{ $equipo->tipo }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <br>
                                    <button type="submit" class="btn btn-primary">Asignar Equipo</button>
                                </div>                                
                            </form>

                            <!-- Formulario para desvincular un equipo de un empleado -->
                            <form action="{{ route('desvincular.equipo') }}" method="POST">
                                @csrf
                                <label class="form-label" for="empleado_id_desvincular">Selecciona un Empleado:</label>
                                <div class="input-group input-group-merge">
                                    <span id="basic-icon-default-fullname2" class="input-group-text">
                                        <i class='bx bx-user-minus' ></i>
                                    </span>
                                    <select class="form-control" name="empleado_id_desvincular" id="empleado_id_desvincular">
                                        @foreach ($desvincular as $empleado)
                                            <option value="{{ $empleado->id }}">{{ $empleado->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <br>
                                <button type="submit" class="btn btn-primary">Desvincular Equipo</button>
                            </form>
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
