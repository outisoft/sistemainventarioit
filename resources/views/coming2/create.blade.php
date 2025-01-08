<!-- Toggle Between Modals -->
<div class="col-lg-4 col-md-6">
    <form method="POST" action="{{ route('coming2.store') }}">
        @csrf
        <div class="mt-3">
            <!-- Modal 1-->
            <div class="modal fade" id="modalToggle" aria-labelledby="modalToggleLabel" tabindex="-1" style="display: none"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalToggleLabel">Datos del responsable</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            @role('Administrator')
                                <div class="mb-3">
                                    <x-input-label class="form-label" for="region_id" :value="__('REGION')" />
                                    <select class="form-control" id="region_id" name="region_id">
                                        <option value="">Choose a region</option>
                                        @foreach ($regions as $region)
                                            <option value="{{ $region->id }}"
                                                {{ old('region_id') == $region->id ? 'selected' : '' }}>
                                                {{ $region->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <x-input-error :messages="$errors->get('region_id')" class="mt-2" />
                                </div>
                            @else
                                <input type="hidden" name="region_id" value="{{ auth()->user()->region_id }}">
                            @endrole
                            <!-- Operario -->
                            <div class="mb-3">
                                <x-input-label class="form-label" for="operario" :value="__('Nombre del responsable')" />
                                <div class="input-group input-group-merge">
                                    <span id="basic-icon-default-fullname2" class="input-group-text">
                                        <i class='bx bx-user'></i>
                                    </span>
                                    <x-text-input id="operario" class="form-control" type="text" name="operario"
                                        placeholder="Katrina Jones" :value="old('operario')" required
                                        autocomplete="operario" />
                                </div>
                                <x-input-error :messages="$errors->get('operario')" class="mt-2" />
                            </div>

                            <!-- Puesto -->
                            <div class="mb-3">
                                <x-input-label class="form-label" for="puesto" :value="__('Puesto')" />
                                <div class="input-group input-group-merge">
                                    <span id="basic-icon-default-fullname2" class="input-group-text">
                                        <i class='bx bxs-id-card'></i>
                                    </span>
                                    <x-text-input id="puesto" class="form-control" type="text" name="puesto"
                                        placeholder="Anfitrion ventas" :value="old('puesto')" required
                                        autocomplete="puesto" />
                                </div>
                                <x-input-error :messages="$errors->get('puesto')" class="mt-2" />
                            </div>

                            <!-- Email -->
                            <div class="mb-3">
                                <x-input-label class="form-label" for="email" :value="__('Email')" />
                                <div class="input-group input-group-merge">
                                    <span id="basic-icon-default-fullname2" class="input-group-text">
                                        <i class='bx bx-envelope'></i>
                                    </span>
                                    <x-text-input id="email" class="form-control" type="email" name="email"
                                        placeholder="ejemplo.correo@ejemplo.com" :value="old('email')" required
                                        autocomplete="email" />
                                </div>
                                <x-input-error :messages="$errors->get('email')" class="mt-2" />
                            </div>

                            <!-- Usuario -->
                            <div class="mb-3">
                                <x-input-label class="form-label" for="usuario" :value="__('Usuario')" />
                                <div class="input-group input-group-merge">
                                    <span id="basic-icon-default-fullname2" class="input-group-text">
                                        <i class='bx bx-at'></i>
                                    </span>
                                    <x-text-input id="usuario" class="form-control" type="text" name="usuario"
                                        placeholder="KJONES" :value="old('usuario')" required autocomplete="usuario" />
                                </div>
                                <x-input-error :messages="$errors->get('usuario')" class="mt-2" />
                            </div>

                            <!-- Password -->
                            <div class="mb-3">
                                <x-input-label class="form-label" for="password" :value="__('Password')" />
                                <div class="input-group input-group-merge">
                                    <span id="basic-icon-default-fullname2" class="input-group-text">
                                        <i class='bx bx-lock-alt'></i>
                                    </span>
                                    <x-text-input id="password" class="form-control" type="text" name="password"
                                        placeholder="KJONES305" :value="old('password')" required autocomplete="password" />
                                </div>
                                <x-input-error :messages="$errors->get('password')" class="mt-2" />
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-primary" data-bs-target="#modalToggle2" data-bs-toggle="modal"
                                data-bs-dismiss="modal">
                                Siguiente
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Modal 2-->
            <div class="modal fade" id="modalToggle2" aria-hidden="true" aria-labelledby="modalToggleLabel2"
                tabindex="-1">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalToggleLabel2">Datos del equipo</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>

                        <div class="modal-body">
                            <!-- #Tableta -->
                            <div class="mb-3">
                                <x-input-label class="form-label" for="numero_tableta" :value="__('Numero de Tableta')" />
                                <div class="input-group input-group-merge">
                                    <span id="basic-icon-default-fullname2" class="input-group-text">
                                        <i class='bx bx-tab'></i>
                                    </span>
                                    <x-text-input id="numero_tableta" class="form-control" type="text"
                                        name="numero_tableta" placeholder="SME305" :value="old('numero_tableta')" required
                                        autocomplete="numero_tableta" />
                                </div>
                                <x-input-error :messages="$errors->get('numero_tableta')" class="mt-2" />
                            </div>

                            <!-- Serial -->
                            <div class="mb-3">
                                <x-input-label class="form-label" for="serial" :value="__('Serial')" />
                                <div class="input-group input-group-merge">
                                    <span id="basic-icon-default-fullname2" class="input-group-text">
                                        <i class='bx bx-barcode'></i>
                                    </span>
                                    <x-text-input id="serial" class="form-control" type="text" name="serial"
                                        placeholder="R5TYS8D7HI" :value="old('serial')" required autocomplete="serial" />
                                </div>
                                <x-input-error :messages="$errors->get('serial')" class="mt-2" />
                            </div>

                            <!-- #Telefono -->
                            <div class="mb-3">
                                <x-input-label class="form-label" for="numero_telefono" :value="__('Numero de telefono')" />
                                <div class="input-group input-group-merge">
                                    <span id="basic-icon-default-fullname2" class="input-group-text">
                                        <i class='bx bx-barcode'></i>
                                    </span>
                                    <x-text-input id="numero_telefono" class="form-control" type="text"
                                        name="numero_telefono" placeholder="9984367821" :value="old('numero_telefono')" required
                                        autocomplete="numero_telefono" />
                                </div>
                                <x-input-error :messages="$errors->get('numero_telefono')" class="mt-2" />
                            </div>

                            <!-- IMEI -->
                            <div class="mb-3">
                                <x-input-label class="form-label" for="imei" :value="__('IMEI')" />
                                <div class="input-group input-group-merge">
                                    <span id="basic-icon-default-fullname2" class="input-group-text">
                                        <i class='bx bx-barcode-reader'></i>
                                    </span>
                                    <x-text-input id="imei" class="form-control" type="text" name="imei"
                                        placeholder="IMEI8648D87D87S78TSG87" :value="old('imei')" required
                                        autocomplete="imei" />
                                </div>
                                <x-input-error :messages="$errors->get('imei')" class="mt-2" />
                            </div>

                            <!-- SIM -->
                            <div class="mb-3">
                                <x-input-label class="form-label" for="sim" :value="__('SIM')" />
                                <div class="input-group input-group-merge">
                                    <span id="basic-icon-default-fullname2" class="input-group-text">
                                        <i class='bx bx-wifi-2'></i>
                                    </span>
                                    <x-text-input id="sim" class="form-control" type="text" name="sim"
                                        placeholder="8952020919580867605-" :value="old('sim')" required
                                        autocomplete="sim" />
                                </div>
                                <x-input-error :messages="$errors->get('sim')" class="mt-2" />
                            </div>

                            <!-- Politica -->
                            <div class="mb-3">
                                <x-input-label class="form-label" for="politica" :value="__('Politica aplicada')" />
                                <div class="input-group input-group-merge">
                                    <span id="basic-icon-default-fullname2" class="input-group-text">
                                        <i class='bx bx-download'></i>
                                    </span>
                                    <select name="policy_id" class="form-control" id="policy_id"
                                        aria-label="Default select example">
                                        @foreach ($politicas as $politica)
                                            <option value="{{ $politica->id }}">{{ $politica->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <x-input-error :messages="$errors->get('politica')" class="mt-2" />
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button class="btn btn-secondary" data-bs-target="#modalToggle" data-bs-toggle="modal"
                                data-bs-dismiss="modal">
                                Anterior
                            </button>
                            <button class="btn btn-primary" data-bs-target="#modalToggle3" data-bs-toggle="modal"
                                data-bs-dismiss="modal">
                                Siguiente
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Modal 3-->
            <div class="modal fade" id="modalToggle3" aria-hidden="true" aria-labelledby="modalToggleLabel2"
                tabindex="-1">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalToggleLabel2">Extras</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>

                        <div class="modal-body">

                            <!-- Configurada -->
                            <div class="mb-3">
                                <x-input-label class="form-label" for="configurada" :value="__('¿La tablet esta configurada?')" />
                                <div class="col-md">
                                    <div class="form-check form-check-inline mt-3">
                                        <input class="form-check-input" type="radio" name="configurada"
                                            id="configurada" value="1" />
                                        <label class="form-check-label" for="configurada">Si</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="configurada"
                                            id="configurada" value="0" checked />
                                        <label class="form-check-label" for="configurada">No</label>
                                    </div>
                                </div>
                            </div>

                            <!-- Carta firmada -->
                            <div class="mb-3">
                                <x-input-label class="form-label" for="carta_firmada" :value="__('¿La carta esta firmada?')" />
                                <div class="col-md">
                                    <div class="form-check form-check-inline mt-3">
                                        <input class="form-check-input" type="radio" name="carta_firmada"
                                            id="carta_firmada" value="1" />
                                        <label class="form-check-label" for="carta_firmada">Si</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="carta_firmada"
                                            id="carta_firmada" value="0"checked />
                                        <label class="form-check-label" for="carta_firmada">No</label>
                                    </div>
                                </div>
                                <x-input-error :messages="$errors->get('carta_firmada')" class="mt-2" />
                            </div>

                            <!-- Folio de baja -->
                            <div class="mb-3">
                                <x-input-label class="form-label" for="folio_baja" :value="__('Folio de baja')" />
                                <div class="input-group input-group-merge">
                                    <span id="basic-icon-default-fullname2" class="input-group-text">
                                        <i class='bx bx-trash-alt'></i>
                                    </span>
                                    <x-text-input id="folio_baja" class="form-control" type="text"
                                        name="folio_baja" placeholder="Folio de baja si existe" :value="old('folio_baja')"
                                        autocomplete="folio_baja" />
                                </div>
                                <x-input-error :messages="$errors->get('folio_baja')" class="mt-2" />
                            </div>

                            <!-- Observacion -->
                            <div class="mb-3">
                                <x-input-label class="form-label" for="observacion" :value="__('Observaciones')" />
                                <div class="input-group input-group-merge">
                                    <span id="basic-icon-default-fullname2" class="input-group-text">
                                        <i class='bx bx-list-ul'></i>
                                    </span>
                                    <textarea id="observacion" class="form-control" type="textarea" name="observacion"
                                        placeholder="Escribe tus observaciones..." :value="old('observacion')" required autocomplete="observacion"
                                        rows="4"></textarea>
                                </div>
                                <x-input-error :messages="$errors->get('observacion')" class="mt-2" />
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button class="btn btn-secondary" data-bs-target="#modalToggle2" data-bs-toggle="modal"
                                data-bs-dismiss="modal">
                                Anterior
                            </button>
                            <button type="submit" class="btn btn-primary">Guardar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
