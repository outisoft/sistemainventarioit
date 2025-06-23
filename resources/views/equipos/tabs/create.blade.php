<!--Modal create-->
<div class="modal fade" id="modalCreate" tabindex="-1" role="dialog" aria-labelledby="modalCreate">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="POST" action="{{ route('tabs.store') }}">
                @csrf
                <div class="modal-header">
                    <h4 class="modal-title" id="modalCreate">Tablets</h4>
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
                                name="tipo_id" placeholder="Tablet" :value="10" required autocomplete="tipo_id" />
                        </div>
                        <x-input-error :messages="$errors->get('tipo_id')" class="mt-2" />
                    </div>

                    <!-- Marca -->
                    <div class="mb-3">
                        <x-input-label class="form-label" for="marca" :value="__('BRAND')" />
                        <div class="input-group input-group-merge">
                            <x-text-input id="marca" class="form-control" type="text" name="marca"
                                placeholder="SAMSUNG" :value="old('marca')" required autocomplete="marca" />
                        </div>
                        <x-input-error :messages="$errors->get('marca')" class="mt-2" />
                    </div>

                    <!-- Model -->
                    <div class="mb-3">
                        <x-input-label class="form-label" for="model" :value="__('MODEL')" />
                        <div class="input-group input-group-merge">
                            <x-text-input id="model" class="form-control" type="text" name="model"
                                placeholder="GALAXY TAB" :value="old('model')" required autocomplete="model" />
                        </div>
                        <x-input-error :messages="$errors->get('model')" class="mt-2" />
                    </div>

                    <!-- Numero de serie -->
                    <div class="mb-3">
                        <x-input-label class="form-label" for="serial" :value="__('SERIAL NUMBER')" />
                        <div class="input-group input-group-merge">
                            <x-text-input id="serial" class="form-control" type="text" name="serial"
                                placeholder="CNB1P50T0" :value="old('serial')" required autocomplete="serial" />
                        </div>
                        <x-input-error :messages="$errors->get('serial')" class="mt-2" />
                    </div>

                    <!-- Politica -->
                    <div class="mb-3">
                        <x-input-label class="form-label" for="policy_id" :value="__('POLICY')" />
                        <div class="input-group input-group-merge">
                            <select name="policy_id" class="form-control" id="policy_id"
                                aria-label="Default select example">
                                @foreach ($policies as $policy)
                                    <option value="{{ $policy->id }}">{{ $policy->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <x-input-error :messages="$errors->get('policy_id')" class="mt-2" />
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
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const leaseRadios = document.querySelectorAll('input[name="lease"]');
        const leaseFields = document.getElementById('lease_fields');
        const afField = document.getElementById('af_field');
        const leaseId = document.getElementById('lease_id');
        const afCode = document.getElementById('af_code');

        // Función para manejar el cambio de estado
        function toggleFields() {
            const isLease = document.querySelector('input[name="lease"]:checked').value === '1';

            if (isLease) {
                leaseFields.style.display = 'block';
                afField.style.display = 'none';
                leaseId.setAttribute('required', 'required');
                leaseId.removeAttribute('disabled');
                afCode.removeAttribute('required');
                afCode.setAttribute('disabled', 'disabled');
            } else {
                leaseFields.style.display = 'none';
                afField.style.display = 'block';
                afCode.setAttribute('required', 'required');
                afCode.removeAttribute('disabled');
                leaseId.removeAttribute('required');
                leaseId.setAttribute('disabled', 'disabled');
            }
        }

        // Agregar eventos a los radios
        leaseRadios.forEach(radio => {
            radio.addEventListener('change', toggleFields);
        });

        // Ejecutar al cargar la página para establecer el estado inicial
        toggleFields();
    });
</script>
