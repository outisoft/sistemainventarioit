<!--Modal create-->
<div class="modal fade" id="modalCreate" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <form method="POST" action="{{ route('lease.store') }}">
                @csrf
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Lease</h4>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"><span
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

                    <!-- Lease -->
                    <div class="mb-3">
                        <x-input-label class="form-label" for="brand" :value="__('Lease')" />
                        <div class="input-group input-group-merge">
                            <x-text-input id="lease" class="form-control" type="text" name="lease"
                                placeholder="MEX.18" :value="old('lease')" required autocomplete="lease" />
                        </div>
                        <x-input-error :messages="$errors->get('lease')" class="mt-2" />
                    </div>

                    <!-- end_date -->
                    <div class="mb-3">
                        <x-input-label class="form-label" for="end_date" :value="__('End Date')" />
                        <div class="input-group input-group-merge">
                            <x-text-input id="end_date" class="form-control" type="date" name="end_date"
                                :value="old('end_date')" required autocomplete="end_date" />
                        </div>
                        <x-input-error :messages="$errors->get('end_date')" class="mt-2" />
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>

            </form>
        </div>
    </div>
</div>
