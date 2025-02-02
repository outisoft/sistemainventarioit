<!--Modal create-->
<div class="modal fade" id="modalCreate" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="POST" action="{{ route('adobe.store') }}">
                @csrf
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Adobe</h4>
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
                        <x-input-label class="form-label" for="type_id" :value="__('Tipo de equipo')" />
                        <div class="input-group input-group-merge">
                            <x-text-input readonly='readonly' id="type_id" class="form-control" type="text"
                                name="type_id" placeholder="Other" :value="15" required autocomplete="type_id" />
                        </div>
                        <x-input-error :messages="$errors->get('type_id')" class="mt-2" />
                    </div>

                    <!-- TYPE -->
                    <div class="mb-3">
                        <x-input-label class="form-label" for="type" :value="__('Tipo de Adobe')" />
                        <select class="form-control" id="type" name="type" required>
                            <option value="">Select Adobe</option>
                            <option value="CREATIVE CLOUD">ADOBE CREATIVE CLOUD</option>
                            <option value="ACROBAT PRO 2020">ADOBE ACROBAT PRO 2020</option>
                            <!-- Agrega más opciones si es necesario -->
                        </select>
                        <x-input-error :messages="$errors->get('type')" class="mt-2" />
                    </div>

                    <!-- KEY -->
                    <div class="mb-3">
                        <x-input-label class="form-label" for="key" :value="__('Email/KEY')" />
                        <div class="input-group input-group-merge">
                            <x-text-input id="key" class="form-control" type="text" name="key"
                                placeholder="XCD64-8768V-OT54E-BNG67C-M986RE" :value="old('key')" required
                                autocomplete="key" />
                        </div>
                        <x-input-error :messages="$errors->get('key')" class="mt-2" />
                    </div>

                    <!-- Campo: Fecha de expiración (solo para Office 365) -->
                    <div class="mb-3" id="fecha_expiracion_container" style="display: none;">
                        <x-input-label class="form-label" for="end_date" :value="__('End Date')" />
                        <div class="input-group input-group-merge">
                            <x-text-input id="end_date" class="form-control" type="date" name="end_date"
                                placeholder="XCD64-8768V-OT54E-BNG67C-M986RE" :value="old('end_date')" required
                                autocomplete="end_date" />
                        </div>
                        <x-input-error :messages="$errors->get('end_date')" class="mt-2" />
                    </div>

                    <br>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    document.getElementById('type').addEventListener('change', function() {
        const fechaExpiracionContainer = document.getElementById('fecha_expiracion_container');
        if (this.value === 'CREATIVE CLOUD') {
            fechaExpiracionContainer.style.display = 'block';
            document.getElementById('end_date').setAttribute('required', true);
        } else {
            fechaExpiracionContainer.style.display = 'none';
            document.getElementById('end_date').removeAttribute('required');
        }
    });
</script>
