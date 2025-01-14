<!--Modal create-->
<div class="modal fade" id="modalCreate" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="POST" action="{{ route('other.store') }}">
                @csrf
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Others</h4>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true"></span></button>
                </div>

                <div class="modal-body">
                    <!-- Region -->
                    {{-- Región (solo visible para administradores) --}}
                    @role('Administrator')
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
                    
                    <!-- Tipo -->
                    <div class="mb-3" style="display: none;">
                        <x-input-label class="form-label" for="tipo_id" :value="__('Tipo de equipo')" />
                        <div class="input-group input-group-merge">
                            <x-text-input readonly='readonly' id="tipo_id" class="form-control" type="text"
                                name="tipo_id" placeholder="Other" :value="13" required
                                autocomplete="tipo_id" />
                        </div>
                        <x-input-error :messages="$errors->get('tipo_id')" class="mt-2" />
                    </div>

                    <!-- Name -->
                    <div class="mb-3">
                        <x-input-label class="form-label" for="no_contrato" :value="__('Name')" />
                        <div class="input-group input-group-merge">
                            <x-text-input id="no_contrato" class="form-control" type="text"
                                name="no_contrato" placeholder="Fire TV" :value="old('no_contrato')" required
                                autocomplete="no_contrato" />
                        </div>
                        <x-input-error :messages="$errors->get('no_contrato')" class="mt-2" />
                    </div>

                    <!-- Marca -->
                    <div class="mb-3">
                        <x-input-label class="form-label" for="marca" :value="__('Brand')" />
                        <div class="input-group input-group-merge">
                            <x-text-input id="marca" class="form-control" type="text"
                                name="marca" placeholder="Amazon" :value="old('marca')" required
                                autocomplete="marca" />
                        </div>
                        <x-input-error :messages="$errors->get('marca')" class="mt-2" />
                    </div>

                    <!-- Model -->
                    <div class="mb-3">
                        <x-input-label class="form-label" for="model" :value="__('Model')" />
                        <div class="input-group input-group-merge">
                            <x-text-input id="model" class="form-control" type="text"
                                name="model" placeholder="E9L29Y" :value="old('model')" required
                                autocomplete="model" />
                        </div>
                        <x-input-error :messages="$errors->get('model')" class="mt-2" />
                    </div>

                    <!-- Numero de serie -->
                    <div class="mb-3">
                        <x-input-label class="form-label" for="serial" :value="__('Serial number')" />
                        <div class="input-group input-group-merge">
                            <x-text-input id="serial" class="form-control" type="text"
                                name="serial" placeholder="840080597126" :value="old('serial')" required
                                autocomplete="serial" />
                        </div>
                        <x-input-error :messages="$errors->get('serial')" class="mt-2" />
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
