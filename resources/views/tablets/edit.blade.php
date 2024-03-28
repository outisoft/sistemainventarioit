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
            <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Tablets /</span> Editar </h4>

            <!-- Basic Bootstrap Table -->
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-header">Editar Registro</h5>
                </div>
                <div class="table-responsive text-nowrap">
                    <div class="card-body">
                        <form action="{{ route('tablets.update', $tablets->id) }}" method="POST" id="miFormulario">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label for="operario">Nombre del Responsable</label>
                                <x-text-input type="text" name="operario" class="form-control"
                                    value="{{ $tablets->operario }}" required />
                                <x-input-error :messages="$errors->get('operario')" class="mt-2" />
                            </div>

                            <div class="form-group">
                                <label for="puesto">Puesto</label>
                                <x-text-input type="text" name="puesto" class="form-control"
                                    value="{{ $tablets->puesto }}" required />
                                <x-input-error :messages="$errors->get('puesto')" class="mt-2" />
                            </div>

                            <div class="form-group">
                                <label for="email">Email</label>
                                <x-text-input type="email" name="email" class="form-control"
                                    value="{{ $tablets->email }}" required />
                                <x-input-error :messages="$errors->get('email')" class="mt-2" />
                            </div>

                            <div class="form-group">
                                <label for="usuario">Usuario</label>
                                <x-text-input type="text" name="usuario" class="form-control"
                                    value="{{ $tablets->usuario }}" required />
                                <x-input-error :messages="$errors->get('usuario')" class="mt-2" />
                            </div>

                            <div class="form-group">
                                <label for="password">Password</label>
                                <x-text-input type="text" name="password" class="form-control"
                                    value="{{ $tablets->password }}" required />
                                <x-input-error :messages="$errors->get('password')" class="mt-2" />
                            </div>

                            <div class="form-group">
                                <label for="numero_tableta">Numero de Tablet</label>
                                <x-text-input type="text" name="numero_tableta" class="form-control"
                                    value="{{ $tablets->numero_tableta }}" required />
                                <x-input-error :messages="$errors->get('numero_tableta')" class="mt-2" />
                            </div>

                            <div class="form-group">
                                <label for="serial">Numero de serie</label>
                                <x-text-input type="text" name="serial" class="form-control"
                                    value="{{ $tablets->serial }}" required />
                                <x-input-error :messages="$errors->get('serial')" class="mt-2" />
                            </div>

                            <div class="form-group">
                                <label for="numero_telefono">Numero de telefono</label>
                                <x-text-input type="text" name="numero_telefono" class="form-control"
                                    value="{{ $tablets->numero_telefono }}" required />
                                <x-input-error :messages="$errors->get('numero_telefono')" class="mt-2" />
                            </div>

                            <div class="form-group">
                                <label for="politica">Politica aplicada</label>
                                <x-text-input type="text" name="politica" class="form-control"
                                    value="{{ $tablets->politica }}" required />
                                <x-input-error :messages="$errors->get('politica')" class="mt-2" />
                            </div>

                            <!-- Configurada -->
                            <div class="mb-3">
                                <x-input-label class="form-label" for="configurada" :value="__('¿La tablet esta configurada?')" />
                                <div class="col-md">
                                    <div class="form-check form-check-inline mt-3">
                                        <input class="form-check-input" type="radio" name="configurada" id="configurada" value="1" {{ $configurada === '1' ? 'checked' : '' }}/>
                                        <label class="form-check-label" for="configurada">Si</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="configurada" id="configurada" value="0" {{ $configurada === '0' ? 'checked' : '' }}/>
                                        <label class="form-check-label" for="configurada">No</label>
                                    </div>
                                </div>
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
