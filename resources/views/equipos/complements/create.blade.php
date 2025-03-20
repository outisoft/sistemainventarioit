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
                    <div class="mb-3">
                        <x-input-label class="form-label" for="type_id" :value="__('Type equipment')" />
                        <select class="form-control" id="type_id" name="type_id" required>
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
                        <x-input-label class="form-label" for="serial" :value="__('Serial number / CT')" />
                        <div class="input-group input-group-merge">
                            <x-text-input id="serial" class="form-control" type="text" name="serial"
                                placeholder="CNB1P50T0" :value="old('serial')" required autocomplete="serial" />
                        </div>
                        <x-input-error :messages="$errors->get('serial')" class="mt-2" />
                    </div>

                    <!-- lease? -->
                    <div class="mb-3">
                        <x-input-label class="form-label" for="lease" :value="__('Is it lease?')" />
                        <div class="col-md">
                            <div class="form-check form-check-inline mt-3">
                                <input class="form-check-input" type="radio" name="lease" id="lease"
                                    value="1" />
                                <label class="form-check-label" for="lease">Yes</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="lease" id="lease"
                                    value="0"checked />
                                <label class="form-check-label" for="lease">No</label>
                            </div>
                        </div>
                        <x-input-error :messages="$errors->get('lease')" class="mt-2" />
                    </div>

                    <!-- af_code -->
                    <div id="af_field" style="display: none;">
                        <div class="mb-3">
                            <x-input-label class="form-label" for="af_code" :value="__('Fixed Asset Code')" />
                            <div class="input-group input-group-merge">
                                <x-text-input id="af_code" class="form-control" type="text" name="af_code"
                                    placeholder="0X0X0X1" :value="old('af_code')" autocomplete="af_code" />
                            </div>
                            <x-input-error :messages="$errors->get('af_code')" class="mt-2" />
                        </div>
                    </div>

                    <!-- Campos adicionales para arrendamiento -->
                    <div id="lease_fields" style="display: none;">
                        <div class="mb-3">
                            <x-input-label class="form-label" for="lease_id" :value="__('LEASE')" />
                            <select class="form-control" id="lease_id" name="lease_id" required>
                                <option value="">Choose a lease</option>
                                @foreach ($leases as $lease)
                                    <option value="{{ $lease->id }}"
                                        {{ old('lease_id') == $lease->id ? 'selected' : '' }}>
                                        {{ $lease->lease }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('lease_id')" class="mt-2" />
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>

            </form>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('input[name="lease"]').on('change', function() {
            if ($('#lease').is(':checked')) {
                $('#lease_fields').show();
                $('#lease_id').attr('required', true);
                $('#af_field').hide();
            } else {
                $('#lease_fields').hide();
                $('#lease_id').removeAttr('required');
                $('#af_field').show();
            }
        });

        // Trigger change event on page load to set initial state
        $('input[name="lease"]:checked').trigger('change');
    });
</script>
<script>
    document.getElementById('type_id').addEventListener('change', function() {
        var afCodeDiv = document.getElementById('af_field');
        if (this.options[this.selectedIndex].text === 'MONITOR') {
            afCodeDiv.style.display = 'block';
        } else {
            afCodeDiv.style.display = 'none';
        }
    });

    // Trigger change event on page load to handle pre-selected value
    document.getElementById('type_id').dispatchEvent(new Event('change'));
</script>
