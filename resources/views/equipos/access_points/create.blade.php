<!--Modal create-->
<!--div class="modal fade" id="createAPModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"-->
<div class="modal fade" id="modalCreate" tabindex="-1" aria-labelledby="modalCreate" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{ route('access-points.store') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h4 class="modal-title" id="modalCreate">Access Points</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"></span>
                    </button>
                </div>

                <div class="modal-body">
                    <!-- Nombre -->
                    <div class="mb-3">
                        <x-input-label class="form-label" for="name" :value="__('Name')" />
                        <div class="input-group input-group-merge">
                            <x-text-input id="name" class="form-control" type="text" name="name"
                                placeholder="AP-123" :value="old('name')" required autocomplete="name" />
                        </div>
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>
                    <!-- Marca -->
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
                                placeholder="APOUYI7" :value="old('model')" required autocomplete="model" />
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

                    <div class="row">
                    <!-- MAC -->
                    <div class="col-md-6 mb-3">
                        <x-input-label class="form-label" for="mac" :value="__('MAC address')" />
                        <div class="input-group input-group-merge">
                            <x-text-input id="mac" class="form-control" type="text" name="mac"
                                maxlength="17" placeholder="00:00:00:00:00:00" :value="old('mac')" required
                                autocomplete="mac" />
                        </div>
                        <x-input-error :messages="$errors->get('mac')" class="mt-2" />
                    </div>

                    <!-- IP DE EQUIPO -->
                    <div class="col-md-6 mb-3">
                        <x-input-label class="form-label" for="ip" :value="__('IP')" />
                        <div class="input-group input-group-merge">
                            <x-text-input id="ip" class="form-control" type="text" name="ip"
                                placeholder="10.1.32.48" :value="old('ip')" required autocomplete="ip" />
                        </div>
                        <x-input-error :messages="$errors->get('ip')" class="mt-2" />
                    </div>  
                    </div>                  

                    <div class="mb-3">
                        <x-input-label class="form-label" for="swittch_id" :value="__('Switch')" />
                        <select class="form-control" id="swittch_id" name="swittch_id" required>
                            @foreach ($switches as $switch)
                                <option value="{{ $switch->id }}">{{ $switch->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <x-input-label class="form-label" for="port_number" :value="__('Port number')" />
                        <select class="form-control" id="create_port_number" name="port_number" required>
                        </select>
                    </div>

                    <!-- Hotel -->
                    <div class="col-md-6 mb-3">
                        <label for="hotel_id" class="form-label">Hotel*</label>
                        <select class="form-select" id="hotel_id" name="hotel_id" required>
                            <option value="">Seleccione un hotel</option>
                            @foreach($hotels as $hotel)
                                <option value="{{ $hotel->id }}">{{ $hotel->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Tipo de Ubicación*</label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="location_type" id="location_villa" value="villa" checked>
                            <label class="form-check-label" for="location_villa">Villa/Habitación</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="location_type" id="location_specific" value="specific">
                            <label class="form-check-label" for="location_specific">Área Específica</label>
                        </div>
                    </div>
                    
                    <!-- Sección Villa/Habitación -->
                    <div id="villa-section">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="villa_id" class="form-label">Villa*</label>
                                <select class="form-select" id="villa_id" name="villa_id" disabled>
                                    <option value="">Primero seleccione un hotel</option>
                                </select>
                                <div class="spinner-border spinner-border-sm text-primary d-none" id="villa-spinner"></div>
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label for="room_id" class="form-label">Habitación (Opcional)</label>
                                <select class="form-select" id="room_id" name="room_id" disabled>
                                    <option value="">N/A</option>
                                </select>
                                <div class="spinner-border spinner-border-sm text-primary d-none" id="room-spinner"></div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Sección Área Específica -->
                    <div id="specific-section" style="display: none;">
                        <div class="mb-3">
                            <label for="specific_location_id" class="form-label">Área Específica*</label>
                            <select class="form-select" id="specific_location_id" name="specific_location_id" disabled>
                                <option value="">Primero seleccione un hotel</option>
                            </select>
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
        const switchSelect = document.getElementById('swittch_id');
        const portSelect = document.getElementById('create_port_number');

        function updateAvailablePorts() {
            const switchId = switchSelect.value;

            if (switchId) {
                fetch(`/switches/${switchId}/available-ports`)
                    .then(response => response.json())
                    .then(data => {
                        portSelect.innerHTML = '<option value="">Select to port</option>';
                        data.available_ports.forEach(port => {
                            const option = document.createElement('option');
                            option.value = port;
                            option.textContent = `Puerto ${port}`;
                            portSelect.appendChild(option);
                        });
                        portSelect.disabled = false;

                        // Actualizar el texto de puertos libres en el switch seleccionado
                        const selectedSwitchOption = switchSelect.options[switchSelect.selectedIndex];
                        selectedSwitchOption.textContent =
                            `${selectedSwitchOption.textContent.split('(')[0]} (${data.free_ports} free ports)`;
                    });
            } else {
                portSelect.innerHTML = '<option value="">No ports available</option>';
                portSelect.disabled = true;
            }
        }

        switchSelect.addEventListener('change', updateAvailablePorts);

        // Actualizar puertos disponibles al cargar la página
        updateAvailablePorts();
    });
</script>

<style>
    .spinner-border {
        vertical-align: middle;
        margin-left: 10px;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const hotelSelect = document.getElementById('hotel_id');
        const villaSelect = document.getElementById('villa_id');
        const roomSelect = document.getElementById('room_id');
        const specificLocationSelect = document.getElementById('specific_location_id');
        const locationRadios = document.querySelectorAll('input[name="location_type"]');
        const villaSpinner = document.getElementById('villa-spinner');
        const roomSpinner = document.getElementById('room-spinner');
        
        // Mostrar/ocultar secciones según tipo de ubicación
        function toggleLocationSections() {
            const isVilla = document.querySelector('input[name="location_type"]:checked').value === 'villa';
            
            document.getElementById('villa-section').style.display = isVilla ? 'block' : 'none';
            document.getElementById('specific-section').style.display = isVilla ? 'none' : 'block';
            
            // Actualizar requeridos
            villaSelect.required = isVilla;
            specificLocationSelect.required = !isVilla;
        }
        
        // Cargar villas basadas en hotel seleccionado
        function loadVillas(hotelId) {
            if (!hotelId) {
                villaSelect.innerHTML = '<option value="">Primero seleccione un hotel</option>';
                villaSelect.disabled = true;
                roomSelect.innerHTML = '<option value="">N/A</option>';
                roomSelect.disabled = true;
                return;
            }
            
            villaSpinner.classList.remove('d-none');
            villaSelect.disabled = true;
            
            fetch(`/api/hotels/${hotelId}/villas`)
                .then(response => {
                    if (!response.ok) throw new Error('Error al cargar villas');
                    return response.json();
                })
                .then(villas => {
                    villaSelect.innerHTML = '<option value="">Seleccione una villa</option>';
                    // Ordenar las villas por nombre
                    villas.sort((a, b) => a.name.localeCompare(b.name));
                    villas.forEach(villa => {
                        const option = document.createElement('option');
                        option.value = villa.id;
                        option.textContent = villa.name;
                        villaSelect.appendChild(option);
                    });
                    villaSelect.disabled = false;
                })
                .catch(error => {
                    console.error('Error:', error);
                    villaSelect.innerHTML = '<option value="">Error al cargar villas</option>';
                })
                .finally(() => {
                    villaSpinner.classList.add('d-none');
                });
        }
        
        // Cargar habitaciones basadas en villa seleccionada
        function loadRooms(villaId) {
            if (!villaId) {
                roomSelect.innerHTML = '<option value="">N/A</option>';
                roomSelect.disabled = true;
                return;
            }
            
            roomSpinner.classList.remove('d-none');
            roomSelect.disabled = true;
            roomSelect.innerHTML = '<option value="">Cargando habitaciones...</option>';
            
            fetch(`/api/villas/${villaId}/rooms`)
                .then(response => {
                    if (!response.ok) throw new Error('Error en la respuesta del servidor');
                    return response.json();
                })
                .then(data => {
                    // Verificar si la respuesta tiene un error
                    if (data.error) {
                        throw new Error(data.details || data.error);
                    }
                    
                    roomSelect.innerHTML = '<option value="">N/A</option>';
                    
                    // Ordenar las habitaciones por número
                    if (Array.isArray(data)) {
                        data.sort((a, b) => a.number - b.number);
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
                    roomSelect.innerHTML = '<option value="">Error al cargar. Intente nuevamente.</option>';
                })
                .finally(() => {
                    roomSpinner.classList.add('d-none');
                });
        }
        
        // Cargar ubicaciones específicas basadas en hotel
        function loadSpecificLocations(hotelId) {
            if (!hotelId) {
                specificLocationSelect.innerHTML = '<option value="">Primero seleccione un hotel</option>';
                specificLocationSelect.disabled = true;
                return;
            }
            
            specificLocationSelect.disabled = true;
            specificLocationSelect.innerHTML = '<option value="">Cargando áreas...</option>';
            
            fetch(`/api/hotels/${hotelId}/specific-locations`)
                .then(response => {
                    if (!response.ok) throw new Error('Error al cargar áreas');
                    return response.json();
                })
                .then(locations => {
                    specificLocationSelect.innerHTML = '<option value="">Seleccione un área</option>';
                    locations.forEach(location => {
                        const option = document.createElement('option');
                        option.value = location.id;
                        option.textContent = location.name;
                        specificLocationSelect.appendChild(option);
                    });
                    specificLocationSelect.disabled = false;
                })
                .catch(error => {
                    console.error('Error:', error);
                    specificLocationSelect.innerHTML = '<option value="">Error al cargar</option>';
                });
        }
        
        // Event listeners
        hotelSelect.addEventListener('change', function() {
            const hotelId = this.value;
            loadVillas(hotelId);
            loadSpecificLocations(hotelId);
        });
        
        villaSelect.addEventListener('change', function() {
            loadRooms(this.value);
        });
        
        locationRadios.forEach(radio => {
            radio.addEventListener('change', toggleLocationSections);
        });
        
        // Inicializar
        toggleLocationSections();
        if (hotelSelect.value) hotelSelect.dispatchEvent(new Event('change'));
    });
</script>
