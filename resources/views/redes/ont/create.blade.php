<!--Modal create-->
<div class="modal fade" id="modalCreate" tabindex="-1" aria-labelledby="modalCreate" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('ont.store') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h4 class="modal-title" id="modalCreate">ONT</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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

                    <!-- NOMBRE -->
                    <div class="mb-3">
                        <x-input-label class="form-label" for="name" :value="__('Equipment name')" />
                        <div class="input-group input-group-merge">
                            <x-text-input id="name" class="form-control" type="text" name="name"
                                placeholder="ONT-123" :value="old('name')" required autocomplete="name" />
                        </div>
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <!-- Brand -->
                    <div class="mb-3">
                        <x-input-label class="form-label" for="brand" :value="__('Brand')" />
                        <div class="input-group input-group-merge">
                            <x-text-input id="brand" class="form-control" type="text" name="brand"
                                placeholder="HUAWEI" :value="old('brand')" required autocomplete="marca" />
                        </div>
                        <x-input-error :messages="$errors->get('brand')" class="mt-2" />
                    </div>

                    <!-- Modelo -->
                    <div class="mb-3">
                        <x-input-label class="form-label" for="model" :value="__('Model')" />
                        <div class="input-group input-group-merge">
                            <x-text-input id="model" class="form-control" type="text" name="model"
                                placeholder="ONTOUYI7" :value="old('model')" required autocomplete="model" />
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

                    <!-- Hotel -->
                    <div class="mb-3">
                        <label for="hotel_id">Hotel</label>
                        <select name="hotel_id" id="hotel_id" class="form-control" required>
                            <option value="">Seleccione un hotel</option>
                            @foreach ($hotels as $hotel)
                                <option value="{{ $hotel->id }}">{{ $hotel->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Villa -->
                    <div class="mb-3">
                        <label for="villa_id">Villa</label>
                        <select name="villa_id" id="villa_id" class="form-control" disabled required>
                            <option value="">Seleccione un hotel primero</option>
                        </select>
                    </div>

                    <!-- Room -->
                    <div class="mb-3">
                        <label for="room_id">Habitación</label>
                        <select name="room_id" id="room_id" class="form-control" disabled required>
                            <option value="">Seleccione una villa primero</option>
                        </select>
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
        const hotelSelect = document.getElementById('hotel_id');
        const villaSelect = document.getElementById('villa_id');
        const roomSelect = document.getElementById('room_id');

        // Cargar villas basadas en hotel seleccionado
        function loadVillas(hotelId) {
            if (!hotelId) {
                villaSelect.innerHTML = '<option value="">Seleccione un hotel primero</option>';
                villaSelect.disabled = true;
                roomSelect.innerHTML = '<option value="">Seleccione una villa primero</option>';
                roomSelect.disabled = true;
                return;
            }

            villaSelect.innerHTML = '<option value="">Cargando villas...</option>';
            villaSelect.disabled = true;

            fetch(`/api/hotels/${hotelId}/villas`)
                .then(response => {
                    if (!response.ok) throw new Error('Error al cargar villas');
                    return response.json();
                })
                .then(villas => {
                    villas.sort((a, b) => a.name.localeCompare(b.name));

                    villaSelect.innerHTML = '<option value="">Seleccione una villa</option>';
                    villas.forEach(villa => {
                        const option = document.createElement('option');
                        option.value = villa.id;
                        option.textContent = villa.name;
                        villaSelect.appendChild(option);
                    });
                    villaSelect.disabled = false;
                })
                .catch(error => {
                    console.error('Error al cargar villas:', error);
                    villaSelect.innerHTML = '<option value="">Error al cargar villas</option>';
                });
        }

        // Cargar habitaciones basadas en villa seleccionada
        function loadRooms(villaId) {
            if (!villaId) {
                roomSelect.innerHTML = '<option value="">Seleccione una villa primero</option>';
                roomSelect.disabled = true;
                return;
            }

            roomSelect.innerHTML = '<option value="">Cargando habitaciones...</option>';
            roomSelect.disabled = true;

            fetch(`/api/villas/${villaId}/rooms`)
                .then(response => {
                    if (!response.ok) throw new Error('Error al cargar habitaciones');
                    return response.json();
                })
                .then(data => {
                    // Verificar si la respuesta tiene un error
                    if (data.error) {
                        throw new Error(data.details || data.error);
                    }

                    roomSelect.innerHTML = '<option value="">N/A</option>';

                    // Verificar que data sea un array
                    if (Array.isArray(data)) {
                        data.forEach(room => {
                            const option = document.createElement('option');
                            option.value = room.id;
                            // Mostrar número y región si está disponible
                            const regionInfo = room.region ? ` (${room.region.name})` : '';
                            option.textContent = `Habitación ${room.number}${regionInfo}`;
                            option.dataset.region = room.region_id; // Si necesitas esta info
                            roomSelect.appendChild(option);
                        });
                    } else {
                        throw new Error('Formato de datos inválido');
                    }

                    roomSelect.disabled = false;
                })
                .catch(error => {
                    console.error('Error al cargar habitaciones:', error);
                    roomSelect.innerHTML = '<option value="">Error al cargar habitaciones</option>';
                });
        }

        // Event listeners
        hotelSelect.addEventListener('change', function() {
            const hotelId = this.value;
            loadVillas(hotelId);
        });

        villaSelect.addEventListener('change', function() {
            const villaId = this.value;
            loadRooms(villaId);
        });

        // Inicializar
        villaSelect.disabled = true;
        roomSelect.disabled = true;
    });
</script>
