<!--Modal create-->
<div class="modal fade" id="modalCreate" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            
            <form method="POST" action="{{ route('desktops.store') }}">
            @csrf
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Desktop</h4>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true"></span></button>
                </div>

                <div class="modal-body">
                    <!-- Tipo -->
                    <div class="mb-3" style="display: none;">
                        <x-input-label class="form-label" for="tipo_id" :value="__('Tipo de equipo')" />
                        <div class="input-group input-group-merge">
                            <x-text-input readonly='readonly' id="tipo_id" class="form-control" type="text"
                                name="tipo_id" placeholder="Desktop" :value="2" required
                                autocomplete="tipo_id" />
                        </div>
                        <x-input-error :messages="$errors->get('marca')" class="mt-2" />
                    </div>

                    {{-- Región (solo visible para administradores) --}}
                    @role('Administrator')

                    <!-- Region -->
                    <div class="mb-3">
                        <x-input-label class="form-label" for="region_id" :value="__('REGION')" />
                        <select class="form-control" id="region_id" name="region_id">
                            <option value="">Choose a region</option>
                            @foreach($regions as $region)
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

                    <!-- Marca -->
                    <div class="mb-3">
                        <x-input-label class="form-label" for="marca" :value="__('Equipment Brand')" />
                        <div class="input-group input-group-merge">
                            <x-text-input id="marca" class="form-control" type="text"
                                name="marca" placeholder="HP" :value="old('marca')" required
                                autocomplete="marca" />
                        </div>
                        <x-input-error :messages="$errors->get('marca')" class="mt-2" />
                    </div>

                    <!-- Model -->
                    <div class="mb-3">
                        <x-input-label class="form-label" for="model" :value="__('Model')" />
                        <div class="input-group input-group-merge">
                            <x-text-input id="model" class="form-control" type="text"
                                name="model" placeholder="SmartBook" :value="old('model')" required
                                autocomplete="model" />
                        </div>
                        <x-input-error :messages="$errors->get('model')" class="mt-2" />
                    </div>

                    <!-- Numero de serie -->
                    <div class="mb-3">
                        <x-input-label class="form-label" for="serial" :value="__('Serial number')" />
                        <div class="input-group input-group-merge">
                            <x-text-input id="serial" class="form-control" type="text"
                                name="serial" placeholder="R5BDI87D80" :value="old('serial')" required
                                autocomplete="serial" />
                        </div>
                        <x-input-error :messages="$errors->get('serial')" class="mt-2" />
                    </div>

                    <!-- NOMBRE DE EQUIPO -->
                    <div class="mb-3">
                        <x-input-label class="form-label" for="name" :value="__('Equipment Name')" />
                        <div class="input-group input-group-merge">
                            <x-text-input id="name" class="form-control" type="text"
                                name="name" placeholder="TULSIS001" :value="old('name')" required
                                autocomplete="name" />
                        </div>
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <!-- IP DE EQUIPO -->
                    <div class="mb-3">
                        <x-input-label class="form-label" for="ip" :value="__('IP')" />
                        <div class="input-group input-group-merge">
                            <x-text-input id="ip" class="form-control" type="text"
                                name="ip" placeholder="10.1.35.48" :value="old('ip')" required
                                autocomplete="ip" />
                        </div>
                        <x-input-error :messages="$errors->get('ip')" class="mt-2" />
                    </div>

                    <!-- SO -->
                    <div class="mb-3">
                        <x-input-label class="form-label" for="so" :value="__('Operating system')" />
                        <div class="input-group input-group-merge">
                            <x-text-input id="so" class="form-control" type="text"
                                name="so" placeholder="Windows 10" :value="old('so')" required
                                autocomplete="so" />
                        </div>
                        <x-input-error :messages="$errors->get('so')" class="mt-2" />
                    </div>

                    <!-- ORDEN DE COMPRA -->
                    <div class="mb-3">
                        <x-input-label class="form-label" for="orden" :value="__('Order')" />
                        <div class="input-group input-group-merge">
                            <x-text-input id="orden" class="form-control" type="text"
                                name="orden" placeholder="ORDEN #1234" :value="old('orden')" required
                                autocomplete="orden" />
                        </div>
                        <x-input-error :messages="$errors->get('orden')" class="mt-2" />
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
