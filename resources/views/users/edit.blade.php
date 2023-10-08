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
            <h4 class="fw-bold py-3 mb-4">
                <span class="text-muted fw-light">
                <a href="{{ route('users.index') }}" class="btn-ico" data-toggle="tooltip" data-placement="top" title="Regresar">
                    <span>
                        <i class='bx bx-arrow-back'></i>
                    </span>
                </a>
                 .. / Usuarios /</span> Editar 
            </h4>
    
            <!-- Basic Bootstrap Table -->
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-header">Editar Registro</h5>
                </div>
                <div class="content-wrapper">
                  <div class="table-responsive text-nowrap">
                    <div class="card-datatable table-responsive pt-0">
                        <div class="table-responsive text-nowrap">
                            <div class="card-body">
                                <form action="{{ route('users.update', $users->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-group">
                                        <label class="form-label" for="name">Nombre</label>
                                        <x-text-input type="text" name="name" class="form-control" value="{{ $users->name }}" required />
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label" for="email">Email</label>
                                        <x-text-input type="email" name="email" class="form-control" value="{{ $users->email }}" required />
                                    </div>
                                    <!-- Mostrar el rol actual del usuario -->
                                    <!--div class="form-group">
                                        <label for="rol">Rol Actual</label>
                                        <input type="text" value="{{ $users->getRoleNames()->implode(', ') }}" class="form-control" disabled>
                                    </div-->
                                    <div class="form-group">
                                        <label for="rol">Selecciona un rol:</label>
                                        @if ($tieneRoles)
                                            <!-- Campo de selección para el rol si el usuario ya tiene roles asignados -->
                                            <div class="form-group">
                                                <label for="rol">Rol</label>
                                                <select name="rol" class="form-control" id="rol">
                                                    @foreach ($roles as $rol => $nombre)
                                                        <option value="{{ $rol }}" {{ $rol == $users->roles->first()->name ? 'selected' : '' }}>
                                                            {{ $nombre }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        @else
                                            <p>Este usuario aún no tiene roles asignados.</p>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label" for="password">Contraseña</label>
                                        <x-text-input type="password" name="password" class="form-control" value="{{ $users->password }}" required />
                                    </div>
                                    <br>
                                    <button type="submit" class="btn btn-primary"><i class='bx bx-refresh' ></i>Actualizar</button>
                                </form>
                            </div>
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
        document.addEventListener('DOMContentLoaded', function () {
            // Agregar un evento al cambio de rol para mostrarlo en el select
            const rolSelect = document.getElementById('rol');
            rolSelect.addEventListener('change', function () {
                const selectedOption = rolSelect.options[rolSelect.selectedIndex];
                selectedOption.selected = true;
            });
        });
    </script>
</x-app-layout>
