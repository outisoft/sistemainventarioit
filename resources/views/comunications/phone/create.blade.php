<!--Modal create-->
<div class="modal fade" id="modalCreate" tabindex="-1" role="dialog" aria-labelledby="modalCreate">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <form method="POST" action="{{ route('phones.store') }}">
                @csrf
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">New Phone</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true"></span>
                    </button>
                </div>

                <div class="modal-body">
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

                    <!-- Extension -->
                    <div class="mb-3">
                        <x-input-label class="form-label" for="extension" :value="__('Extension')" />
                        <div class="input-group input-group-merge">
                            <x-text-input id="extension" class="form-control" type="text" name="extension"
                                placeholder="28028" :value="old('extension')" required autocomplete="extension" />
                        </div>
                        <x-input-error :messages="$errors->get('extension')" class="mt-2" />
                    </div>

                    <!-- Service -->
                    <div class="mb-3">
                        <x-input-label class="form-label" for="service" :value="__('Service')" />
                        <div class="input-group input-group-merge">
                            <x-text-input id="service" class="form-control" type="text" name="service"
                                placeholder="MITEL" :value="old('service')" required autocomplete="service" />
                        </div>
                        <x-input-error :messages="$errors->get('service')" class="mt-2" />
                    </div>

                    <!-- Model -->
                    <div class="mb-3">
                        <x-input-label class="form-label" for="model" :value="__('Model')" />
                        <div class="input-group input-group-merge">
                            <x-text-input id="model" class="form-control" type="text" name="model"
                                placeholder="5312 IP Phone" :value="old('model')" required autocomplete="model" />
                        </div>
                        <x-input-error :messages="$errors->get('model')" class="mt-2" />
                    </div>

                    <!-- Serial -->
                    <div class="mb-3">
                        <x-input-label class="form-label" for="serial" :value="__('Serial Number')" />
                        <div class="input-group input-group-merge">
                            <x-text-input id="serial" class="form-control" type="text" name="serial"
                                placeholder="R52BJ98SUY" :value="old('serial')" required autocomplete="serial" />
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
