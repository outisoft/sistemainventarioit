<!--Modal create-->
<div class="modal fade" id="modalCreate" tabindex="-1" aria-labelledby="modalCreate" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('switches.store') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h4 class="modal-title" id="modalCreate">SWITCH</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <!-- Region -->
                    {{-- Región (solo visible para administradores) --}}
                    @role('Administrator')
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
                        @if ($userRegions->count() > 1)
                            <!-- Si el usuario tiene múltiples regiones, muestra un campo de selección -->
                            <div class="mb-3">

                                <x-input-label class="form-label" for="region_id" :value="__('REGION')" />
                                <select name="region_id" id="region_id" class="form-control">
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

                    <!-- Type -->
                    <div class="mb-3">
                        <x-input-label class="form-label" for="usage_type" :value="__('Type')" />
                        <select class="form-control" name="usage_type" id="usage_type">
                            <option value="ADMINISTRATIVE">ADMINISTRATIVE</option>
                            <option value="CUSTOMERS">CUSTOMERS</option>
                        </select>
                        <x-input-error :messages="$errors->get('usage_type')" class="mt-2" />
                    </div>

                    <!-- NOMBRE -->
                    <div class="mb-3">
                        <x-input-label class="form-label" for="name" :value="__('Equipment name')" />
                        <div class="input-group input-group-merge">
                            <x-text-input id="name" class="form-control" type="text" name="name"
                                placeholder="SW-123" :value="old('name')" required autocomplete="name" />
                        </div>
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <!-- MARCa -->
                    <div class="mb-3">
                        <x-input-label class="form-label" for="marca" :value="__('Brand')" />
                        <div class="input-group input-group-merge">
                            <x-text-input id="marca" class="form-control" type="text" name="marca"
                                placeholder="CISCO" :value="old('marca')" required autocomplete="marca" />
                        </div>
                        <x-input-error :messages="$errors->get('marca')" class="mt-2" />
                    </div>

                    <!-- Modelo -->
                    <div class="mb-3">
                        <x-input-label class="form-label" for="model" :value="__('Model')" />
                        <div class="input-group input-group-merge">
                            <x-text-input id="model" class="form-control" type="text" name="model"
                                placeholder="SWPOUYI7" :value="old('model')" required autocomplete="model" />
                        </div>
                        <x-input-error :messages="$errors->get('model')" class="mt-2" />
                    </div>

                    <!-- Serial -->
                    <div class="mb-3">
                        <x-input-label class="form-label" for="serial" :value="__('Serial number')" />
                        <div class="input-group input-group-merge">
                            <x-text-input id="serial" class="form-control" type="text" name="serial"
                                placeholder="52RF97FNP0A87FJ" :value="old('serial')" required autocomplete="serial" />
                        </div>
                        <x-input-error :messages="$errors->get('serial')" class="mt-2" />
                    </div>

                    <!-- MAC -->
                    <div class="mb-3">
                        <x-input-label class="form-label" for="mac" :value="__('MAC address')" />
                        <div class="input-group input-group-merge">
                            <x-text-input id="mac" class="form-control" type="text" name="mac"
                                maxlength="17" placeholder="00:00:00:00:00:00" :value="old('mac')" required
                                autocomplete="mac" />
                        </div>
                        <x-input-error :messages="$errors->get('mac')" class="mt-2" />
                    </div>

                    <!-- IP DE EQUIPO -->
                    <div class="mb-3">
                        <x-input-label class="form-label" for="ip" :value="__('IP')" />
                        <div class="input-group input-group-merge">
                            <x-text-input id="ip" class="form-control" type="text" name="ip"
                                placeholder="10.1.32.48" :value="old('ip')" required autocomplete="ip" />
                        </div>
                        <x-input-error :messages="$errors->get('ip')" class="mt-2" />
                    </div>

                    <!-- Puertos -->
                    <div class="mb-3">
                        <x-input-label class="form-label" for="total_ports" :value="__('Total ports')" />
                        <div class="input-group input-group-merge">
                            <x-text-input id="total_ports" class="form-control" type="number" name="total_ports"
                                placeholder="24" :value="old('total_ports')" required autocomplete="total_ports" />
                        </div>
                        <x-input-error :messages="$errors->get('total_ports')" class="mt-2" />
                    </div>

                    <!-- Hotel -->
                    <div class="mb-3">
                        <x-input-label class="form-label" for="hotel_id" :value="__('Locations')" />
                        <select class="form-control" id="hotel_id" name="hotel_id" required>
                            @foreach ($hotels as $hotel)
                                <option value="{{ $hotel->id }}">{{ $hotel->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label>Tipo de Ubicación</label>
                        <div>
                            <input type="radio" name="location_type" value="villa" checked> Villa
                            <input type="radio" name="location_type" value="specific"> Área Específica
                        </div>
                    </div>

                    <div id="villa-section">
                        <div class="mb-3">
                            <label>Villa</label>
                            <select name="villa_id" class="form-control">
                                <option value="">Choose a villa</option>
                                @foreach ($hotels as $hotel)
                                    @foreach ($hotel->villas as $villa)
                                        <option value="{{ $villa->id }}" data-hotel="{{ $hotel->id }}">
                                            {{ $villa->name }}
                                        </option>
                                    @endforeach
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div id="specific-section" style="display:none;">
                        <div class="mb-3">
                            <label>Area Específica</label>
                            <select name="specific_location_id" class="form-control">
                                <option value="">Choose Area</option>
                                @foreach ($hotels as $hotel)
                                    @foreach ($hotel->specificLocations as $location)
                                        <option value="{{ $location->id }}" data-hotel="{{ $hotel->id }}">
                                            {{ $location->name }}
                                        </option>
                                    @endforeach
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <!-- Observacion -->
                    <div class="form-group">
                        <x-input-label class="form-label" for="observacion" :value="__('Observations')" />
                        <div class="input-group input-group-merge">
                            <textarea id="observacion" class="form-control" type="textarea" name="observacion"
                                placeholder="Escribe tus observaciones..." :value="old('observacion')" required autocomplete="observacion"
                                rows="4"></textarea>
                        </div>
                        <x-input-error :messages="$errors->get('observacion')" class="mt-2" />
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
    document.getElementById('ip').addEventListener('input', function(e) {
        const isValid = /^(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)(\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)){3}$/
            .test(e.target.value);
        e.target.classList.toggle('is-invalid', !isValid && e.target.value !== '');
    });
</script>

<script>
    document.getElementById('mac').addEventListener('input', function(e) {
        let mac = e.target.value;

        // Eliminar cualquier carácter no válido (que no sea 0-9, A-F o ":")
        mac = mac.replace(/[^A-Fa-f0-9]/g, '');

        // Insertar dos puntos después de cada dos caracteres
        if (mac.length > 2) {
            mac = mac.match(/.{1,2}/g).join(':');
        }

        // Limitar la longitud a 17 caracteres (por ejemplo: 00:11:22:33:44:55)
        if (mac.length > 17) {
            mac = mac.substring(0, 17);
        }

        // Convertir a mayúsculas
        mac = mac.toUpperCase();

        // Actualizar el campo de input con el valor formateado
        e.target.value = mac;
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const hotelSelect = document.querySelector('select[name="hotel_id"]');
        const villaSection = document.getElementById('villa-section');
        const specificSection = document.getElementById('specific-section');
        const locationRadios = document.querySelectorAll('input[name="location_type"]');

        function toggleSections() {
            const isVilla = document.querySelector('input[name="location_type"]:checked').value === 'villa';
            villaSection.style.display = isVilla ? 'block' : 'none';
            specificSection.style.display = isVilla ? 'none' : 'block';
        }

        function filterOptions(select, hotelId) {
            const options = select.querySelectorAll('option');
            options.forEach(option => {
                if (!option.value || option.dataset.hotel == hotelId) {
                    option.style.display = 'block';
                } else {
                    option.style.display = 'none';
                }
            });
            select.value = '';
        }

        hotelSelect.addEventListener('change', function() {
            const hotelId = this.value;
            filterOptions(document.querySelector('select[name="villa_id"]'), hotelId);
            filterOptions(document.querySelector('select[name="specific_location_id"]'), hotelId);
        });

        locationRadios.forEach(radio => {
            radio.addEventListener('change', toggleSections);
        });

        // Inicializar
        toggleSections();
        hotelSelect.dispatchEvent(new Event('change'));
    });
</script>
