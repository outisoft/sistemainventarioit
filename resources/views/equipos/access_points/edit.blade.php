<!-- Modales de Edición -->
@foreach($accessPoints as $equipo)
    <div class="modal fade" id="editModal{{ $equipo->id }}" role="dialog" tabindex="-1" aria-labelledby="editModal{{ $equipo->id }}" aria-hidden="true"7>
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="editAccessPointForm" action="{{ route('access-points.update', $equipo) }}" method="POST">    
                @csrf
                @method('PUT')
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModal">Edit AP</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="edit_access_point_id" name="id">
                        <!-- Region -->
                        {{-- Región (solo visible para administradores) --}}
                        @role('Administrator')
                        <div class="mb-3">
                            <x-input-label class="form-label" for="region_id" :value="__('REGION')" />
                            <select class="form-control" id="region_id" name="region_id"
                                aria-label="Default select example">
                                @foreach ($regions as $region)
                                    <option value="{{ $region->id }}"
                                        {{ $equipo->region_id == $region->id ? 'selected' : '' }}>
                                        {{ $region->name }}</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('region_id')" class="mt-2" />
                        </div>
                            
                        @else
                            <input type="hidden" name="region_id" value="{{ auth()->user()->region_id }}">
                        @endrole
                        <!-- Nmae -->
                        <div class="mb-3">
                            <x-input-label class="form-label" for="name{{ $equipo->name }}" :value="__('Name')" />
                            <div class="input-group input-group-merge">
                                <x-text-input id="edit_name" class="form-control" type="text"
                                    name="name" placeholder="SW-123" value="{{ $equipo->name }}" required
                                    autocomplete="name" />
                            </div>
                            <x-input-error :messages="$errors->get('marca')" class="mt-2" />
                        </div>

                        <!-- Marca -->
                        <div class="mb-3">
                            <x-input-label class="form-label" for="marca{{ $equipo->marca }}" :value="__('Brand')" />
                            <div class="input-group input-group-merge">
                                <x-text-input id="edit_marca" class="form-control" type="text"
                                    name="marca" placeholder="CISCO" value="{{ $equipo->marca }}" required
                                    autocomplete="marca" />
                            </div>
                            <x-input-error :messages="$errors->get('marca')" class="mt-2" />
                        </div>

                        <!-- Modelo -->
                        <div class="mb-3">
                            <x-input-label class="form-label" for="model{{ $equipo->model }}" :value="__('Model')" />
                            <div class="input-group input-group-merge">
                                <x-text-input id="edit_model" class="form-control" type="text"
                                    name="model" placeholder="45RT7" value="{{ $equipo->model }}" required
                                    autocomplete="model" />
                            </div>
                            <x-input-error :messages="$errors->get('model')" class="mt-2" />
                        </div>

                        <!-- Serial -->
                        <div class="mb-3">
                            <x-input-label class="form-label" for="serial{{ $equipo->serial }}" :value="__('Serial number')" />
                            <div class="input-group input-group-merge">
                                <x-text-input id="edit_serial" class="form-control" type="text"
                                    name="serial" placeholder="52RSCF78N93" value="{{ $equipo->serial }}" required
                                    autocomplete="serial" />
                            </div>
                            <x-input-error :messages="$errors->get('serial')" class="mt-2" />
                        </div>

                        <!-- MAC -->
                        <div class="mb-3">
                            <x-input-label class="form-label" for="mac{{ $equipo->mac }}" :value="__('MAC address')" />
                            <div class="input-group input-group-merge">
                                <x-text-input id="edit_mac" class="form-control" type="text"
                                    name="mac" placeholder="12:C0:96:24:00" value="{{ $equipo->mac }}" required
                                    autocomplete="mac" />
                            </div>
                            <x-input-error :messages="$errors->get('mac')" class="mt-2" />
                        </div>

                        <!-- IP -->
                        <div class="mb-3">
                            <x-input-label class="form-label" for="ip{{ $equipo->ip }}" :value="__('IP')" />
                            <div class="input-group input-group-merge">
                                <x-text-input id="edit_ip" class="form-control" type="text"
                                    name="ip" placeholder="10.01.2.31" value="{{ $equipo->ip }}" required
                                    autocomplete="ip" />
                            </div>
                            <x-input-error :messages="$errors->get('ip')" class="mt-2" />
                        </div>

                        <!-- Switch ID -->
                        <div class="mb-3">
                            <x-input-label class="form-label" for="swittch_id" :value="__('Switch')" />
                            <select class="form-control" id="edit_switch_id" name="swittch_id" required>
                                @foreach($switches as $switch)
                                    <option value="{{ $switch->id }}" {{ $equipo->switch_id == $switch->id ? 'selected' : '' }}>
                                        {{ $switch->name }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('swittch_id')" class="mt-2" />
                        </div>
                        <div class="form-group">
                            <x-input-label class="form-label" for="port_number" :value="__('Port number')" />
                            <select class="form-control" id="edit_port_number" name="port_number" required>
                                <option value="{{ $equipo->port_number }}">{{ $equipo->port_number }}</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endforeach
<script>
    document.getElementById('edit_mac').addEventListener('input', function(e) {
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