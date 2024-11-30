<!--Modal create-->
<!--div class="modal fade" id="createAPModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"-->
<div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <form action="{{ route('access-points.store') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Access Points</h4>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"></span>
                    </button>
                </div>

                <div class="modal-body">
                    <!-- Region -->
                    {{-- Región (solo visible para administradores) --}}
                    @role('Administrator')
                    <div class="mb-3">
                        <x-input-label class="form-label" for="region_id" :value="__('REGION')" />
                        <select class="form-control" id="region_id" name="region_id">
                            <option value="">Choose a region</option>
                            @foreach($regions as $region)
                                <option value="{{ $region->id }}" 
                                        {{ old('region_id') == $region->id ? 'selected' : '' }}>
                                    {{ $region->name }}
                                </option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('region_id')" class="mt-2" />
                    </div>
                        
                    @else
                        <input type="hidden" name="region_id" value="{{ auth()->user()->region_id }}">
                    @endrole

                    <!-- NOMBRE -->
                    <div class="mb-3">
                        <x-input-label class="form-label" for="name" :value="__('Name')" />
                        <div class="input-group input-group-merge">
                            <x-text-input id="name" class="form-control" type="text"
                                name="name" placeholder="AP-123" :value="old('name')" required
                                autocomplete="name" />
                        </div>
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <!-- Marca -->
                    <div class="mb-3">
                        <x-input-label class="form-label" for="marca" :value="__('Brand')" />
                        <div class="input-group input-group-merge">
                            <x-text-input id="marca" class="form-control" type="text"
                                name="marca" placeholder="CISCO" :value="old('marca')" required
                                autocomplete="marca" />
                        </div>
                        <x-input-error :messages="$errors->get('marca')" class="mt-2" />
                    </div>

                    <!-- Modelo -->
                    <div class="mb-3">
                        <x-input-label class="form-label" for="model" :value="__('Model')" />
                        <div class="input-group input-group-merge">
                            <x-text-input id="model" class="form-control" type="text"
                                name="model" placeholder="APOUYI7" :value="old('model')" required
                                autocomplete="model" />
                        </div>
                        <x-input-error :messages="$errors->get('model')" class="mt-2" />
                    </div>

                    <!-- Serial -->
                    <div class="mb-3">
                        <x-input-label class="form-label" for="serial" :value="__('Serial number')" />
                        <div class="input-group input-group-merge">
                            <x-text-input id="serial" class="form-control" type="text"
                                name="serial" placeholder="52RF97FNP0A87FJ" :value="old('serial')" required
                                autocomplete="serial" />
                        </div>
                        <x-input-error :messages="$errors->get('serial')" class="mt-2" />
                    </div>

                    <!-- MAC -->
                    <div class="mb-3">
                        <x-input-label class="form-label" for="mac" :value="__('MAC address')" />
                        <div class="input-group input-group-merge">
                            <x-text-input id="mac" class="form-control" type="text"
                                name="mac" maxlength="17" placeholder="00:00:00:00:00:00" :value="old('mac')" required
                                autocomplete="mac" />
                        </div>
                        <x-input-error :messages="$errors->get('mac')" class="mt-2" />
                    </div>

                    <!-- IP DE EQUIPO -->
                    <div class="mb-3">
                        <x-input-label class="form-label" for="ip" :value="__('IP')" />
                        <div class="input-group input-group-merge">
                            <x-text-input id="ip" class="form-control" type="text"
                                name="ip" placeholder="10.1.32.48" :value="old('ip')" required
                                autocomplete="ip" />
                        </div>
                        <x-input-error :messages="$errors->get('ip')" class="mt-2" />
                    </div>

                    <div class="mb-3">
                        <x-input-label class="form-label" for="swittch_id" :value="__('Switch')" />
                        <select class="form-control" id="swittch_id" name="swittch_id" required>
                            @foreach($switches as $switch)
                                <option value="{{ $switch->id }}">{{ $switch->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <x-input-label class="form-label" for="port_number" :value="__('Port number')" />
                        <select class="form-control" id="create_port_number" name="port_number" required>
                        </select>
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
                        selectedSwitchOption.textContent = `${selectedSwitchOption.textContent.split('(')[0]} (${data.free_ports} free ports)`;
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