<!--Modal create-->
<div class="modal fade" id="modalCreate" tabindex="-1" role="dialog" aria-labelledby="modalCreate">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="POST" action="{{ route('other.store') }}">
                @csrf
                <div class="modal-header">
                    <h4 class="modal-title" id="modalCreate">Others</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true"></span></button>
                </div>

                <div class="modal-body">
                    <!-- Region -->
                    {{-- Región (solo visible para administradores) --}}
                    @role('Administrator')
                        <div class="mb-3">
                            <x-input-label class="form-label" for="region_id" :value="__('REGION')" />
                            <select class="form-control" id="region_id" name="region_id" required>
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
                        @if ($userRegions->count() > 1)
                            <!-- Si el usuario tiene múltiples regiones, muestra un campo de selección -->
                            <div class="mb-3">

                                <x-input-label class="form-label" for="region_id" :value="__('REGION')" />
                                <select name="region_id" id="region_id" class="form-control" required>
                                    @foreach ($userRegions as $region)
                                        <option value="{{ $region->id }}">{{ $region->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        @else
                            <!-- Si el usuario tiene solo una región, asigna automáticamente esa región -->
                            <input type="hidden" name="region_id" value="{{ $userRegions->first()->id }}">
                        @endif
                    @endrole

                    <!-- Tipo -->
                    <div class="mb-3" style="display: none;">
                        <x-input-label class="form-label" for="tipo_id" :value="__('Tipo de equipo')" />
                        <div class="input-group input-group-merge">
                            <x-text-input readonly='readonly' id="tipo_id" class="form-control" type="text"
                                name="tipo_id" placeholder="Other" :value="13" required autocomplete="tipo_id" />
                        </div>
                        <x-input-error :messages="$errors->get('tipo_id')" class="mt-2" />
                    </div>

                    <!-- Name -->
                    <div class="mb-3">
                        <x-input-label class="form-label" for="nombre" :value="__('Name')" />
                        <div class="input-group input-group-merge">
                            <x-text-input id="nombre" class="form-control" type="text" name="nombre"
                                placeholder="Fire TV" :value="old('nombre')" required autocomplete="nombre" />
                        </div>
                        <x-input-error :messages="$errors->get('nombre')" class="mt-2" />
                    </div>

                    <!-- Marca -->
                    <div class="mb-3">
                        <x-input-label class="form-label" for="marca" :value="__('Brand')" />
                        <div class="input-group input-group-merge">
                            <x-text-input id="marca" class="form-control" type="text" name="marca"
                                placeholder="Amazon" :value="old('marca')" required autocomplete="marca" />
                        </div>
                        <x-input-error :messages="$errors->get('marca')" class="mt-2" />
                    </div>

                    <!-- Model -->
                    <div class="mb-3">
                        <x-input-label class="form-label" for="model" :value="__('Model')" />
                        <div class="input-group input-group-merge">
                            <x-text-input id="model" class="form-control" type="text" name="model"
                                placeholder="E9L29Y" :value="old('model')" required autocomplete="model" />
                        </div>
                        <x-input-error :messages="$errors->get('model')" class="mt-2" />
                    </div>

                    <!-- Numero de serie -->
                    <div class="mb-3">
                        <x-input-label class="form-label" for="serial" :value="__('Serial number')" />
                        <div class="input-group input-group-merge">
                            <x-text-input id="serial" class="form-control" type="text" name="serial"
                                placeholder="840080597126" :value="old('serial')" required autocomplete="serial" />
                        </div>
                        <x-input-error :messages="$errors->get('serial')" class="mt-2" />
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
