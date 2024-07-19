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
            <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Empleados /</span> Editar </h4>

            <!-- Basic Bootstrap Table -->
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-header">Editar Registro</h5>
                </div>
                <div class="table-responsive text-nowrap">
                    <div class="card-body">
                        <form action="{{ route('empleados.update', $empleados->id) }}" method="POST" id="miFormulario">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label for="no_empleado">No. Colaborador</label>
                                <x-text-input type="text" name="no_empleado" class="form-control"
                                    value="{{ $empleados->no_empleado }}" required/>
                                <x-input-error :messages="$errors->get('no_empleado')" class="mt-2" />
                            </div>
                            <div class="form-group">
                                <label for="name">Nombre</label>
                                <x-text-input type="text" name="name" class="form-control"
                                    value="{{ $empleados->name }}" required />
                                <x-input-error :messages="$errors->get('name')" class="mt-2" />
                            </div>
                            <div class="form-group">
                                <label for="email">Correo</label>
                                <x-text-input type="email" name="email" class="form-control"
                                    value="{{ $empleados->email }}" required />
                                <x-input-error :messages="$errors->get('email')" class="mt-2" />
                            </div>
                            <div class="form-group">
                                <label for="puesto">Puesto</label>
                                <x-text-input type="text" name="puesto" class="form-control"
                                    value="{{ $empleados->puesto }}" required />
                                <x-input-error :messages="$errors->get('puesto')" class="mt-2" />
                            </div>

                            <div class="form-group">
                                <label for="departamento_id">Departamento:</label>
                                <select class="form-control" id="departamento_id" name="departamento_id"
                                    aria-label="Default select example">
                                    @foreach ($departamentos as $departamento)
                                        <option value="{{ $departamento->id }}"
                                            {{ $empleados->departamento_id == $departamento->id ? 'selected' : '' }}>
                                            {{ $departamento->name }}</option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('departamento_id')" class="mt-2" />
                            </div>

                            <div class="form-group">
                                <label for="hotel_id">Hoteles:</label>
                                <select class="form-control" id="hotel_id" name="hotel_id"
                                    aria-label="Default select example">
                                    @foreach ($hoteles as $hotel)
                                        <option value="{{ $hotel->id }}"
                                            {{ $empleados->hotel_id == $hotel->id ? 'selected' : '' }}>
                                            {{ $hotel->name }}</option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('hotel_id')" class="mt-2" />
                            </div>

                            <div class="form-group">
                                <label for="ad">AD</label>
                                <x-text-input type="text" name="ad" class="form-control"
                                    value="{{ $empleados->ad }}" required />
                                <x-input-error :messages="$errors->get('ad')" class="mt-2" />
                            </div>

                            <br>

                            <button id="showToastPlacement" type="submit" class="btn btn-primary"><i
                                    class='bx bx-refresh'></i> Actualizar</button>
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
