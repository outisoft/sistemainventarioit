<!--Modal create-->
<div class="modal fade" id="modalCreate" tabindex="-1" role="dialog" aria-labelledby="modalCreate">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="POST" action="{{ route('companies.store') }}">
                @csrf
                <div class="modal-header">
                    <h4 class="modal-title" id="modalCreate">Company</h4>
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

                    <!-- name -->
                    <div class="mb-3">
                        <x-input-label class="form-label" for="brand" :value="__('Name Company')" />
                        <div class="input-group input-group-merge">
                            <x-text-input id="name" class="form-control" type="text" name="name"
                                placeholder="BPP" :value="old('name')" required autocomplete="name" />
                        </div>
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <!-- description -->
                    <div class="mb-3">
                        <x-input-label class="form-label" for="description" :value="__('Description Company')" />
                        <div class="input-group input-group-merge">
                            <x-text-input id="description" class="form-control" type="text" name="description" placeholder="Bahia Principe Promotions"
                                :value="old('description')" required autocomplete="description" />
                        </div>
                        <x-input-error :messages="$errors->get('description')" class="mt-2" />
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
