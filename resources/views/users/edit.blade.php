<x-app-layout>
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
</x-app-layout>
