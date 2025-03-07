<!--Modal create-->
<div class="modal fade" id="modalCreate" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <form method="POST" action="{{ route('laptops.store') }}">
                @csrf
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Laptop</h4>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true"></span></button>
                </div>

                <div class="modal-body">
                    <!-- Region -->
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
                                name="tipo_id" placeholder="Laptop" :value="4" required autocomplete="tipo_id" />
                        </div>
                        <x-input-error :messages="$errors->get('marca')" class="mt-2" />
                    </div>

                    <!-- Marca -->
                    <div class="mb-3">
                        <x-input-label class="form-label" for="marca" :value="__('BRAND')" />
                        <div class="input-group input-group-merge">
                            <x-text-input id="marca" class="form-control" type="text" name="marca"
                                placeholder="HP" :value="old('marca')" required autocomplete="marca" />
                        </div>
                        <x-input-error :messages="$errors->get('marca')" class="mt-2" />
                    </div>

                    <!-- Model -->
                    <div class="mb-3">
                        <x-input-label class="form-label" for="model" :value="__('MODEL')" />
                        <div class="input-group input-group-merge">
                            <x-text-input id="model" class="form-control" type="text" name="model"
                                placeholder="SmartBook" :value="old('model')" required autocomplete="model" />
                        </div>
                        <x-input-error :messages="$errors->get('model')" class="mt-2" />
                    </div>

                    <!-- Numero de serie -->
                    <div class="mb-3">
                        <x-input-label class="form-label" for="serial" :value="__('SERIAL NUMBER')" />
                        <div class="input-group input-group-merge">
                            <x-text-input id="serial" class="form-control" type="text" name="serial"
                                placeholder="R5BDI87D80" :value="old('serial')" required autocomplete="serial" />
                        </div>
                        <x-input-error :messages="$errors->get('serial')" class="mt-2" />
                    </div>

                    <!-- NOMBRE DE EQUIPO -->
                    <div class="mb-3">
                        <x-input-label class="form-label" for="name" :value="__('EQUIPMENTS NAME')" />
                        <div class="input-group input-group-merge">
                            <x-text-input id="name" class="form-control" type="text" name="name"
                                placeholder="TULSIS001" :value="old('name')" required autocomplete="name" />
                        </div>
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <!-- IP DE EQUIPO -->
                    <div class="mb-3">
                        <x-input-label class="form-label" for="ip" :value="__('IP')" />
                        <div class="input-group input-group-merge">
                            <x-text-input id="ip" class="form-control" type="text" name="ip"
                                placeholder="10.1.35.48" :value="old('ip')" required autocomplete="ip" />
                        </div>
                        <x-input-error :messages="$errors->get('ip')" class="mt-2" />
                    </div>

                    <!-- SO -->
                    <div class="mb-3">
                        <x-input-label class="form-label" for="so" :value="__('OPERATING SYSTEM')" />
                        <div class="input-group input-group-merge">
                            <x-text-input id="so" class="form-control" type="text" name="so"
                                placeholder="Windows 10" :value="old('so')" required autocomplete="so" />
                        </div>
                        <x-input-error :messages="$errors->get('so')" class="mt-2" />
                    </div>

                    <!-- ORDEN DE COMPRA -->
                    <div class="mb-3">
                        <x-input-label class="form-label" for="orden" :value="__('ORDER')" />
                        <div class="input-group input-group-merge">
                            <x-text-input id="orden" class="form-control" type="text" name="orden"
                                placeholder="ORDEN #1234" :value="old('orden')" required autocomplete="orden" />
                        </div>
                        <x-input-error :messages="$errors->get('orden')" class="mt-2" />
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
                    <div id="af_field" style="display">
                        <div class="mb-3">
                            <x-input-label class="form-label" for="af_code" :value="__('Fixed Asset Code')" />
                            <div class="input-group input-group-merge">
                                <x-text-input id="af_code" class="form-control" type="text" name="af_code"
                                    placeholder="0X0X0X1" :value="old('af_code')" required autocomplete="af_code" />
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
                $('#af_code').removeAttr('required');
            } else {
                $('#lease_fields').hide();
                $('#lease_id').removeAttr('required');
                $('#af_field').show();
                $('#af_code').attr('required', true);
            }
        });

        // Trigger change event on page load to set initial state
        $('input[name="lease"]:checked').trigger('change');
    });
</script>
