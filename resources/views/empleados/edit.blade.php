<x-app-layout>
    <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Empleados /</span> Editar </h4>
    
            <!-- Basic Bootstrap Table -->
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-header">Editar Registro</h5>
                </div>
                <div class="table-responsive text-nowrap">
                    <div class="card-body">
                        <form action="{{ route('empleados.update', $registro->id) }}" method="POST" id="miFormulario">
                            @csrf
                            @method('PUT')
    
                            <div class="form-group">
                                <label for="no_empleado">No. Colaborador</label>
                                <x-text-input type="text" name="no_empleado" class="form-control" value="{{ $registro->no_empleado }}" readonly />
                            </div>
                            <div class="form-group">
                                <label for="name">Nombre</label>
                                <x-text-input type="text" name="name" class="form-control" value="{{ $registro->name }}" required />
                            </div>
                            <div class="form-group">
                                <label for="email">Correo</label>
                                <x-text-input type="email" name="email" class="form-control" value="{{ $registro->email }}" required />
                            </div>
                            <div class="form-group">
                                <label for="puesto">Puesto</label>
                                <x-text-input type="text" name="puesto" class="form-control" value="{{ $registro->puesto }}" required />
                            </div>
                            <div class="form-group">
                                <label for="departamento">Departamento</label>
                                <x-text-input type="text" name="departamento" class="form-control" value="{{ $registro->departamento }}" required />
                            </div>
    
                            <div class="form-group">
                                <label for="hotel_id">Selecciona un hotel:</label>
                                <select class="form-control" id="hotel_id" name="hotel_id" aria-label="Default select example">
                                    @foreach ($hoteles as $hotel)
                                        <option value="{{ $hotel->id }}" {{ $hotel->id == $hotelSeleccionado->id ? 'selected' : '' }}>
                                            {{ $hotel->nombre }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
    
                            <div class="form-group">
                                <label for="ad">AD</label>
                                <x-text-input type="text" name="ad" class="form-control" value="{{ $registro->ad }}" required />
                            </div>
    
                            <button type="submit" class="btn btn-primary"><i class='bx bx-refresh' ></i> Actualizar</button>
                        </form>
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



