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
            <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">
                    <a href="{{ route('coming2.index') }}" class="btn-ico" data-toggle="tooltip" data-placement="top"
                        title="Regresar">
                        <span>
                            <i class='bx bx-arrow-back'></i>
                        </span>
                    </a>
                    .. / Tablet /</span> Detalles </h4>

            <!-- Basic Bootstrap Table -->
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-header">Detalles de Registro</h5>
                    <div class="navbar-nav align-items-center">
                        <div class="nav-item d-flex align-items-center">
                            <a href="{{ route('coming2.save-pdf', $coming2->id) }}" target="_blank" class="btn-ico" data-placement="top" title="Hoja de resguardo">
                                <i class='bx bxs-file-pdf icon-lg'></i>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="content-wrapper">
                    <div class="table-responsive text-nowrap">
                        <div class="card-datatable table-responsive pt-0">
                            <div class="table-responsive text-nowrap">
                                <div class="card-body">
                                    <!-- Operario -->
                                    <div class="form-group">
                                        <label for="operario">Nombre del Responsable</label>
                                        <x-text-input type="text" name="operario" class="form-control"
                                            value="{{ $coming2->operario }}" disabled />
                                        <x-input-error :messages="$errors->get('operario')" class="mt-2" />
                                    </div>
                                    
                                    <!-- Puesto -->
                                    <div class="form-group">
                                        <label for="puesto">Puesto</label>
                                        <x-text-input type="text" name="puesto" class="form-control"
                                            value="{{ $coming2->puesto }}" disabled />
                                        <x-input-error :messages="$errors->get('puesto')" class="mt-2" />
                                    </div>

                                    <!-- Email -->
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <x-text-input type="email" name="email" class="form-control"
                                            value="{{ $coming2->email }}" disabled />
                                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                    </div>
                                    
                                    <!-- Usuario -->
                                    <div class="form-group">
                                        <label for="usuario">Usuario</label>
                                        <x-text-input type="text" name="usuario" class="form-control"
                                            value="{{ $coming2->usuario }}" disabled />
                                        <x-input-error :messages="$errors->get('usuario')" class="mt-2" />
                                    </div>

                                    <!-- Password -->
                                    <div class="form-group">
                                        <label for="password">Password</label>
                                        <x-text-input type="text" name="password" class="form-control"
                                            value="{{ $coming2->password }}" disabled />
                                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                                    </div>

                                    <!-- Numero de tableta -->
                                    <div class="form-group">
                                        <label for="numero_tableta">Numero de Tablet</label>
                                        <x-text-input type="text" name="numero_tableta" class="form-control"
                                            value="{{ $coming2->numero_tableta }}" disabled />
                                        <x-input-error :messages="$errors->get('numero_tableta')" class="mt-2" />
                                    </div>

                                    <!-- Numero de serie -->
                                    <div class="form-group">
                                        <label for="serial">Numero de serie</label>
                                        <x-text-input type="text" name="serial" class="form-control"
                                            value="{{ $coming2->serial }}" disabled />
                                        <x-input-error :messages="$errors->get('serial')" class="mt-2" />
                                    </div>

                                    <!-- NUmero de telefono -->
                                    <div class="form-group">
                                        <label for="numero_telefono">Numero de telefono</label>
                                        <x-text-input type="text" name="numero_telefono" class="form-control"
                                            value="{{ $coming2->numero_telefono }}" disabled />
                                        <x-input-error :messages="$errors->get('numero_telefono')" class="mt-2" />
                                    </div>

                                    <!-- Imei -->
                                    <div class="form-group">
                                        <label for="imei">IMEI</label>
                                        <x-text-input type="text" name="imei" class="form-control"
                                            value="{{ $coming2->imei }}" disabled />
                                        <x-input-error :messages="$errors->get('imei')" class="mt-2" />
                                    </div>

                                    <!-- SIM -->
                                    <div class="form-group">
                                        <label for="sim">SIM</label>
                                        <x-text-input type="text" name="sim" class="form-control"
                                            value="{{ $coming2->sim }}" disabled />
                                        <x-input-error :messages="$errors->get('sim')" class="mt-2" />
                                    </div>

                                    <!-- Politica -->
                                    <div class="form-group">
                                        <label for="politica">Politica aplicada</label>
                                        <x-text-input type="text" name="politica" class="form-control"
                                            value="{{ $coming2->policies->name }}" disabled />
                                        <x-input-error :messages="$errors->get('politica')" class="mt-2" />
                                    </div>

                                    <!-- Configurada -->
                                    <div class="mb-3">
                                        <x-input-label class="form-label" for="configurada" :value="__('¿La tablet esta configurada?')" />
                                        <div class="col-md">
                                            <div class="form-check form-check-inline mt-3">
                                                <input class="form-check-input" type="radio" name="configurada" id="configurada" value="1" {{ $coming2->configurada == '1' ? 'checked' : '' }} disabled/>
                                                <label class="form-check-label" for="configurada">Si</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="configurada" id="configurada" value="0" {{ $coming2->configurada == '0' ? 'checked' : '' }} disabled/>
                                                <label class="form-check-label" for="configurada">No</label>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Carta firmada -->
                                    <div class="mb-3">
                                        <x-input-label class="form-label" for="carta_firmada" :value="__('¿La carta esta firmada?')" />
                                        <div class="col-md">
                                            <div class="form-check form-check-inline mt-3">
                                                <input class="form-check-input" type="radio" name="carta_firmada" id="carta_firmada" value="1" {{ $coming2->carta_firmada == '1' ? 'checked' : '' }} disabled/>
                                                <label class="form-check-label" for="carta_firmada">Si</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="carta_firmada" id="carta_firmada" value="0" {{ $coming2->carta_firmada == '0' ? 'checked' : '' }} disabled/>
                                                <label class="form-check-label" for="carta_firmada">No</label>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Folio de baja -->
                                    <div class="form-group">
                                        <label for="folio_baja">Folio de baja</label>
                                        <x-text-input type="text" name="folio_baja" class="form-control"
                                            value="{{ $coming2->folio_baja }}" disabled />
                                        <x-input-error :messages="$errors->get('folio_baja')" class="mt-2" />
                                    </div>

                                    <!-- Observacion -->
                                    <div class="form-group">
                                        <label for="observacion">Observacion</label>
                                        <textarea id="observacion" class="form-control" type="textarea"
                                            name="observacion" disabled
                                            autocomplete="observacion" rows="4"> {{ $coming2->observacion }}
                                        </textarea>
                                        <x-input-error :messages="$errors->get('observacion')" class="mt-2" />
                                    </div>

                                    <br>
                                    <a href="{{ route('coming2.index') }}" class="btn btn-secondary">
                                        <i class='bx bx-arrow-back'></i>
                                        Volver
                                    </a>
                                    <a href="{{ route('coming2.edit', $coming2->id) }}" class="btn btn-primary">
                                        <i class="bx bx-edit me-1"></i>
                                        Editar
                                    </a>
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
