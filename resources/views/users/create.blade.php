<x-app-layout>
    <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">
                <a href="{{ route('users.index') }}" class="btn-ico" data-toggle="tooltip" data-placement="top" title="Regresar">
                    <span>
                        <i class='bx bx-arrow-back'></i>
                    </span>
                </a>
                 .. / Usuario /</span> Nuevo </h4>
    
            <!-- Basic Bootstrap Table -->
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-header">Nuevo Registro</h5>
                </div>
                <div class="table-responsive text-nowrap">
                    <div class="card-body">
                        <form action="{{ route('register') }}" method="POST">
                            @csrf
                            <!-- Nombre -->
                            <div class="mb-3">
                                <label class="form-label" for="basic-icon-default-fullname">Nombre</label>
                                <div class="input-group input-group-merge">
                                    <span id="basic-icon-default-fullname2" class="input-group-text">
                                        <i class='bx bx-user'></i>
                                    </span>
                                    <x-text-input type="text" class="form-control" id="name"  name="name" placeholder="Juan Carlos" aria-label="Juan Carlos" aria-describedby="basic-icon-default-fullname2" required autofocus autocomplete="name" />
                                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                                </div>
                            </div>

                            <!-- Email -->
                            <div class="mb-3">
                                <label class="form-label" for="basic-icon-default-fullname">Correo</label>
                                <div class="input-group input-group-merge">
                                    <span id="basic-icon-default-fullname2" class="input-group-text">
                                        <i class='bx bx-envelope' ></i>
                                    </span>
                                    <x-text-input type="email" class="form-control" id="email"  name="email" placeholder="ejemplo@correo.com" aria-label="ejemplo@correo.com" aria-describedby="basic-icon-default-fullname2" required autocomplete="email" />
                                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                </div>
                            </div>

                            <!-- Contraseña -->
                            <div class="mb-3">
                                <label class="form-label" for="basic-icon-default-fullname">Contraseña</label>
                                <div class="input-group input-group-merge">
                                    <span id="basic-icon-default-fullname2" class="input-group-text">
                                        <i class='bx bx-barcode' ></i>
                                    </span>
                                    <x-text-input type="password" class="form-control" id="password"  name="password" placeholder="************" aria-label="************" aria-describedby="basic-icon-default-fullname2" required autocomplete="password" />
                                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                                </div>
                            </div>
                            <!-- Confirmar Contraseña -->
                            <div class="mb-3">
                                <label class="form-label" for="basic-icon-default-fullname">Confirmar contraseña</label>
                                <div class="input-group input-group-merge">
                                    <span id="basic-icon-default-fullname2" class="input-group-text">
                                        <i class='bx bx-barcode' ></i>
                                    </span>
                                    <x-text-input type="password" class="form-control" id="password_confirmation"  name="password_confirmation" placeholder="************" aria-label="************" aria-describedby="basic-icon-default-fullname2" required autocomplete="password" />
                                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary">Crear</button>
                        </form>
                    </div>
                </div>
            </div>
            <!--/ Basic Bootstrap Table -->
    
            <hr class="my-5" />
    
        </div>
        <!-- / Content -->
      </div>
</x-app-layout>