<!--Modal create-->
<div class="modal fade" id="modalCreate" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <form method="POST" action="{{ route('complements.store') }}">
                @csrf
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Complement</h4>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true"></span></button>
                </div>

                <div class="modal-body">
                    <!-- Tipo -->
                    <div class="mb-3">
                        <x-input-label class="form-label" for="type_id" :value="__('Type equipment')" />
                        <select class="form-control" id="type_id" name="type_id">
                            <option value="">Choose a type</option>
                            @foreach ($tipos as $tipo)
                                <option value="{{ $tipo->id }}" {{ old('type_id') == $tipo->id ? 'selected' : '' }}>
                                    {{ $tipo->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Marca -->
                    <div class="mb-3">
                        <x-input-label class="form-label" for="brand" :value="__('Brand')" />
                        <div class="input-group input-group-merge">
                            <x-text-input id="brand" class="form-control" type="text" name="brand"
                                placeholder="HP" :value="old('brand')" required autocomplete="brand" />
                        </div>
                        <x-input-error :messages="$errors->get('brand')" class="mt-2" />
                    </div>

                    <!-- Model -->
                    <div class="mb-3">
                        <x-input-label class="form-label" for="model" :value="__('Model')" />
                        <div class="input-group input-group-merge">
                            <x-text-input id="model" class="form-control" type="text" name="model"
                                placeholder="Lazer MFP 432fdm" :value="old('model')" required autocomplete="model" />
                        </div>
                        <x-input-error :messages="$errors->get('model')" class="mt-2" />
                    </div>

                    <!-- Numero de serie -->
                    <div class="mb-3">
                        <x-input-label class="form-label" for="serial" :value="__('Serial number')" />
                        <div class="input-group input-group-merge">
                            <x-text-input id="serial" class="form-control" type="text" name="serial"
                                placeholder="CNB1P50T0" :value="old('serial')" required autocomplete="serial" />
                        </div>
                        <x-input-error :messages="$errors->get('serial')" class="mt-2" />
                    </div>

                    {{-- Región (solo visible para administradores) --}}
                    @role('Administrator')

                        <!-- Region -->
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
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>

            </form>
        </div>
    </div>
</div>
