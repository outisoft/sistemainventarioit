<x-app-layout>
  <div class="container-xxl navbar-expand-xl align-items-center">
    <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
      <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
        <i class="bx bx-menu bx-sm"></i>
      </a>
    </div>
  </div>
  <div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">  </span> Home</h4>
    <!-- Horizontal -->
    <!--h5 class="pb-1 mb-4">Horizontal</h5-->
    <div class="row mb-5">
      <div class="col-md">
        <div class="card mb-3">
          <div class="row g-0">
            <div class="card text-center">
              <div class="card-header">
                Inventario
              </div>
              <div class="card-body">
                <h5 class="card-title">Registros de inventario</h5>
                <p class="card-text">Crea, Lee, actualiza y elimina los datos registrados del inventaio. </p>
                <a href="{{ route('inventario.index')}}" class="btn btn-primary">Ir</a>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md">
        <div class="col-md">
          <div class="card mb-3">
            <div class="row g-0">
              <div class="card text-center">
                <div class="card-header">
                  Historial
                </div>
                <div class="card-body">
                  <h5 class="card-title">Registro de historial</h5>
                  <p class="card-text">Historial de resgitrso realizadon dentro de la plataforma.</p>
                  <a href="{{ route('historial.index')}}" class="btn btn-primary">Ir</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="row mb-5">
      <div class="col-md">
        <div class="card mb-3">
          <div class="row g-0">
            <div class="card text-center">
              <div class="card-header">
                Empleados
              </div>
              <div class="card-body">
                <h5 class="card-title">Registros de Empleados</h5>
                <p class="card-text">Crea, Lee, actualiza y elimina los datos registrados de los empleados. </p>
                <a href="{{ route('empleados.index')}}" class="btn btn-primary">Ir</a>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md">
        <div class="col-md">
          <div class="card mb-3">
            <div class="row g-0">
              <div class="card text-center">
                <div class="card-header">
                  Historial
                </div>
                <div class="card-body">
                  <h5 class="card-title">Registro de Usuarios</h5>
                  <p class="card-text">Crea, Lee, actualiza y elimina los datos registrados de los usuarios.</p>
                  <a href="{{ route('users.index')}}" class="btn btn-primary">Ir</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  <!--/ Horizontal -->
  </div>
  

</x-app-layout>