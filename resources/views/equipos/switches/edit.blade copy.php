<x-app-layout>
    <div class="container">
        <br>

        <form method="POST" action="{{ route('switches.update', $switch->id) }}" id="editSwitchForm">
            @csrf
            @method('PUT')

            <!-- Datos del Switch -->
            <div class="card mb-4">
                <div class="card-header">Información del Dispositivo</div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="name" class="form-label">Nombre*</label>
                            <input type="text" class="form-control" id="name" name="name"
                                value="{{ old('name', $switch->name) }}" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="hotel_id" class="form-label">Hotel*</label>
                            <select class="form-control" id="hotel_id" name="hotel_id" required disabled>
                                @foreach ($hotels as $hotel)
                                    <option value="{{ $hotel->id }}"
                                        {{ $switch->hotel_id == $hotel->id ? 'selected' : '' }}>
                                        {{ $hotel->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <!-- Más campos (marca, modelo, serial, etc.) -->
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="marca" class="form-label">Marca</label>
                            <input type="text" class="form-control" id="marca" name="marca"
                                value="{{ old('marca', $switch->marca) }}">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="model" class="form-label">Modelo</label>
                            <input type="text" class="form-control" id="model" name="model"
                                value="{{ old('model', $switch->model) }}">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="serial" class="form-label">Serial</label>
                            <input type="text" class="form-control" id="serial" name="serial"
                                value="{{ old('serial', $switch->serial) }}">
                        </div>
                    </div>

                    <!-- Campos de red -->
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="mac" class="form-label">MAC</label>
                            <input type="text" class="form-control" id="mac" name="mac"
                                value="{{ old('mac', $switch->mac) }}" placeholder="Formato: 00:1A:2B:3C:4D:5E">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="ip" class="form-label">IP</label>
                            <input type="text" class="form-control" id="ip" name="ip"
                                value="{{ old('ip', $switch->ip) }}">
                        </div>
                    </div>

                    <!-- Región y puertos -->
                    <div class="row">

                        {{-- Región (solo visible para administradores) --}}
                        @role('Administrator')
                            <div class="col-md-6 mb-3">
                                <x-input-label class="form-label" for="region_id" :value="__('REGION')" />
                                <select class="form-control" id="region_id" name="region_id"
                                    aria-label="Default select example">
                                    @foreach ($regions as $region)
                                        <option value="{{ $region->id }}"
                                            {{ $switch->region_id == $region->id ? 'selected' : '' }}>
                                            {{ $region->name }}</option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('region_id')" class="mt-2" />
                            </div>
                        @else
                            @if ($userRegions->count() > 1)
                                <!-- Si el usuario tiene múltiples regiones, muestra un campo de selección -->
                                <div class="col-md-6 mb-3">
                                    <x-input-label class="form-label" for="region_id" :value="__('REGION')" />
                                    <select class="form-control" id="region_id" name="region_id"
                                        aria-label="Default select example">
                                        @foreach ($userRegions as $region)
                                            <option value="{{ $region->id }}"
                                                {{ $switch->region_id == $region->id ? 'selected' : '' }}>
                                                {{ $region->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <x-input-error :messages="$errors->get('region_id')" class="mt-2" />
                                </div>
                            @else
                                <!-- Si el usuario tiene solo una región, asigna automáticamente esa región -->
                                <input type="hidden" name="region_id" value="{{ $userRegions->first()->id }}">
                            @endif
                        @endrole

                        <div class="col-md-6 mb-3">
                            <label for="total_ports" class="form-label">Puertos Totales</label>
                            <input type="number" class="form-control" id="total_ports" name="total_ports"
                                value="{{ old('total_ports', $switch->total_ports) }}" min="1">
                        </div>
                    </div>
                </div>
            </div>

            <!-- En la sección de ubicación -->
            <div class="card mb-4">
                <div class="card-header">Ubicación</div>
                <div class="card-body">
                    @if (!$hasLocation)
                        <div class="alert alert-warning">
                            Este switch no tiene ubicación asignada. Por favor seleccione una.
                        </div>
                    @endif

                    <div class="mb-3">
                        <label class="form-label">Tipo de Ubicación*</label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="location_type" id="location_villa"
                                value="villa"
                                {{ old('location_type', $currentLocation['type']) == 'villa' ? 'checked' : '' }}
                                disabled>
                            <label class="form-check-label" for="location_villa">Villa</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="location_type"
                                id="location_specific" value="specific"
                                {{ old('location_type', $currentLocation['type']) == 'specific' ? 'checked' : '' }}
                                disabled>
                            <label class="form-check-label" for="location_specific">Área Específica</label>
                        </div>
                    </div>

                    <!-- Sección Villa -->
                    <div id="villa-section"
                        style="{{ old('location_type', $currentLocation['type']) == 'villa' ? '' : 'display:none;' }}">
                        <div class="mb-3">
                            <label for="villa_id" class="form-label">Villa*</label>
                            <select class="form-control" id="villa_id" name="villa_id"
                                {{ old('location_type', $currentLocation['type']) == 'villa' ? '' : 'disabled' }}
                                disabled>
                                <option value="">Seleccione una villa</option>
                                @if (isset($villasByHotel[$switch->hotel_id]))
                                    @foreach ($villasByHotel[$switch->hotel_id] as $villa)
                                        <option value="{{ $villa['id'] }}"
                                            {{ old('villa_id', $currentLocation['villa_id']) == $villa['id'] ? 'selected' : '' }}>
                                            {{ $villa['name'] }}
                                        </option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>

                    <!-- Sección Área Específica -->
                    <div id="specific-section"
                        style="{{ old('location_type', $currentLocation['type']) == 'specific' ? '' : 'display:none;' }}">
                        <div class="mb-3">
                            <label for="specific_location_id" class="form-label">Área Específica*</label>
                            <select class="form-control" id="specific_location_id" name="specific_location_id"
                                {{ old('location_type', $currentLocation['type']) == 'specific' ? '' : 'disabled' }}
                                disabled>
                                <option value="">Seleccione un área</option>
                                @if (isset($locationsByHotel[$switch->hotel_id]))
                                    @foreach ($locationsByHotel[$switch->hotel_id] as $location)
                                        <option value="{{ $location['id'] }}"
                                            {{ old('specific_location_id', $currentLocation['specific_location_id']) == $location['id'] ? 'selected' : '' }}>
                                            {{ $location['name'] }}
                                        </option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Observaciones -->
            <div class="card mb-4">
                <div class="card-header">Observaciones</div>
                <div class="card-body">
                    <div class="mb-3">
                        <label for="observacion" class="form-label">Notas</label>
                        <textarea class="form-control" id="observacion" name="observacion" rows="3">{{ old('observacion', $switch->observacion) }}</textarea>
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-between">
                <a href="{{ route('switches.index') }}" class="btn btn-secondary">Cancelar</a>
                <button type="submit" class="btn btn-primary">Guardar Cambios</button>
            </div>
        </form>
    </div>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Elementos del DOM
                const hotelSelect = document.getElementById('hotel_id');
                const villaSelect = document.getElementById('villa_id');
                const specificLocationSelect = document.getElementById('specific_location_id');
                const locationTypeRadios = document.querySelectorAll('input[name="location_type"]');

                // Datos precargados desde Laravel
                const villasByHotel = @json($villasByHotel);
                const locationsByHotel = @json($locationsByHotel);

                // Valores actuales
                const currentValues = {
                    locationType: @json($currentLocation['type']),
                    villaId: @json($currentLocation['villa_id']),
                    specificLocationId: @json($currentLocation['specific_location_id'])
                };

                // Actualizar opciones basado en hotel seleccionado
                function updateLocationOptions() {
                    const hotelId = hotelSelect.value;

                    // Actualizar villas
                    updateSelectOptions(villaSelect, villasByHotel[hotelId]);

                    // Actualizar ubicaciones específicas
                    updateSelectOptions(specificLocationSelect, locationsByHotel[hotelId]);

                    // Restaurar selección actual si existe
                    restoreCurrentSelection();
                }

                // Función genérica para actualizar opciones de un select
                function updateSelectOptions(selectElement, items) {
                    selectElement.innerHTML = '<option value="">Seleccione...</option>';

                    if (items && items.length > 0) {
                        items.forEach(item => {
                            const option = document.createElement('option');
                            option.value = item.id;
                            option.textContent = item.name;
                            selectElement.appendChild(option);
                        });
                    }
                }

                // Restaurar selección guardada
                function restoreCurrentSelection() {
                    if (currentValues.locationType === 'villa' && currentValues.villaId) {
                        const optionExists = Array.from(villaSelect.options).some(opt => opt.value == currentValues
                            .villaId);
                        if (optionExists) villaSelect.value = currentValues.villaId;
                    } else if (currentValues.locationType === 'specific' && currentValues.specificLocationId) {
                        const optionExists = Array.from(specificLocationSelect.options).some(opt => opt.value ==
                            currentValues.specificLocationId);
                        if (optionExists) specificLocationSelect.value = currentValues.specificLocationId;
                    }
                }

                // Cambiar entre tipos de ubicación
                function toggleLocationSections() {
                    const isVilla = document.querySelector('input[name="location_type"]:checked').value === 'villa';

                    document.getElementById('villa-section').style.display = isVilla ? 'block' : 'none';
                    document.getElementById('specific-section').style.display = isVilla ? 'none' : 'block';

                    villaSelect.disabled = !isVilla;
                    specificLocationSelect.disabled = isVilla;
                }

                // Event listeners
                hotelSelect.addEventListener('change', updateLocationOptions);

                locationTypeRadios.forEach(radio => {
                    radio.addEventListener('change', toggleLocationSections);
                });

                // Inicialización
                updateLocationOptions();
                toggleLocationSections();

                // Debug: Verificar datos en consola
                console.log('Datos iniciales:', {
                    currentValues,
                    villasByHotel,
                    locationsByHotel
                });
            });
        </script>
    @endpush
</x-app-layout>
