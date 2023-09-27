<x-app-layout>
    <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Empleados /</span> Nuevo </h4>
    
            <!-- Basic Bootstrap Table -->
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-header">Nuevo Registro</h5>
                </div>
                <div class="content-wrapper">
                  <div class="table-responsive text-nowrap">
                    <div class="card-datatable table-responsive pt-0">
                        <div class="card-body">
                            <form action="{{ route('empleados.store') }}" method="POST" id="miFormulario">
                                @csrf
                                <!-- Numero de Colaborador -->
                                <div class="mb-3">
                                    <label class="form-label" for="basic-icon-default-fullname">Numero de Colaborador</label>
                                    <div class="input-group input-group-merge">
                                        <span id="basic-icon-default-fullname2" class="input-group-text">
                                            <i class='bx bxl-slack-old'></i>
                                        </span>
                                        <x-text-input type="text" class="form-control" id="no_empleado"  name="no_empleado" placeholder="0038628" aria-label="0038628" aria-describedby="basic-icon-default-fullname2" required autofocus autocomplete="no_empleado" />
                                        <x-input-error :messages="$errors->get('no_empleado')" class="mt-2" />
                                    </div>
                                </div>
    
                                <!-- Nombre de empleado -->
                                <div class="mb-3">
                                    <label class="form-label" for="basic-icon-default-fullname">Nombre Completo</label>
                                    <div class="input-group input-group-merge">
                                        <span id="basic-icon-default-fullname2" class="input-group-text">
                                            <i class='bx bx-user'></i>
                                        </span>
                                        <x-text-input type="text" class="form-control" id="name"  name="name" placeholder="Katrina Jones" aria-label="Katrina Jones" aria-describedby="basic-icon-default-fullname2" required autofocus autocomplete="name" />
                                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                                    </div>
                                </div>
    
                                <!-- Correo electronico -->
                                <div class="mb-3">
                                    <label class="form-label" for="basic-icon-default-fullname">Correo electronico</label>
                                    <div class="input-group input-group-merge">
                                        <span id="basic-icon-default-fullname2" class="input-group-text">
                                            <i class='bx bx-envelope' ></i>
                                        </span>
                                        <x-text-input type="email" class="form-control" id="email"  name="email" placeholder="ejemplo@correo.com" aria-label="ejemplo@correo.com" aria-describedby="basic-icon-default-fullname2" required autofocus autocomplete="email" />
                                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                    </div>
                                </div>
    
                                <!-- Puesto -->
                                <div class="mb-3">
                                    <label class="form-label" for="basic-icon-default-fullname">Puesto</label>
                                    <div class="input-group input-group-merge">
                                        <span id="basic-icon-default-fullname2" class="input-group-text">
                                            <i class='bx bxs-id-card' ></i>
                                        </span>
                                        <x-text-input type="text" class="form-control" id="puesto"  name="puesto" placeholder="Chef de partida" aria-label="Chef de partida" aria-describedby="basic-icon-default-fullname2" required autofocus autocomplete="puesto" />
                                        <x-input-error :messages="$errors->get('puesto')" class="mt-2" />
                                    </div>
                                </div>
    
                                <!-- Departamento -->
                                <div class="mb-3">
                                    <label class="form-label" for="basic-icon-default-fullname">Departamento</label>
                                    <div class="input-group input-group-merge">
                                        <span id="basic-icon-default-fullname2" class="input-group-text">
                                            <i class='bx bx-building' ></i>
                                        </span>
                                        <x-text-input type="text" class="form-control" id="departamento"  name="departamento" placeholder="Alimentos & bebidas" aria-label="Alimentos & bebidas" aria-describedby="basic-icon-default-fullname2" required autofocus autocomplete="departamento" />
                                        <x-input-error :messages="$errors->get('departamento')" class="mt-2" />
                                    </div>
                                </div>
    
                                <!-- Hotel -->
                                <div class="mb-3">
                                    <label for="exampleFormControlSelect1" class="form-label">Hotel</label>
                                    <div class="input-group input-group-merge">
                                        <span id="basic-icon-default-fullname2" class="input-group-text">
                                            <i class='bx bx-building-house'></i>
                                        </span>
                                        <select name="hotel_id" class="form-control" id="hotel_id" aria-label="Default select example">
                                            @foreach ($hoteles as $hotel)
                                            <option value="{{ $hotel->id }}">{{ $hotel->nombre }} ({{ $hotel->tipo }})</option>
                                        @endforeach
                                        </select>
                                    </div>                                
                                </div>
    
                                <!-- AD -->
                                <div class="mb-3">
                                    <label class="form-label" for="basic-icon-default-fullname">AD</label>
                                    <div class="input-group input-group-merge">
                                        <span id="basic-icon-default-fullname2" class="input-group-text">
                                            <i class='bx bx-at' ></i>
                                        </span>
                                        <x-text-input name="ad" class="form-control" id="ad" type="text" placeholder="jkatrina" aria-label="jkatrina" aria-describedby="basic-icon-default-fullname2" required/>
                                        <x-input-error :messages="$errors->get('ad')" class="mt-2" />
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary">Send</button>
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
        // Aquí se mostrarán los mensajes Toastr
        function mostrarToastr(message, type) {
            toastr[type](message, type.charAt(0).toUpperCase() + type.slice(1));
        }
    </script>
</x-app-layout>
