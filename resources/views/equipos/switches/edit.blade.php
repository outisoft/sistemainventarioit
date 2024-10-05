<!-- Modales de Edición -->
@foreach($switches as $equipo)
    <div class="modal fade" id="editModal{{ $equipo->id }}" tabindex="-1" aria-labelledby="editModal{{ $equipo->id }}" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModal{{ $equipo->id }}">Editar equipo: {{ $equipo->name }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('switches.update', $equipo) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <!-- Nmae -->
                        <div class="mb-3">
                            <x-input-label class="form-label" for="name{{ $equipo->name }}" :value="__('Nombre de equipo')" />
                            <div class="input-group input-group-merge">
                                <x-text-input id="name{{ $equipo->name }}" class="form-control" type="text"
                                    name="name" placeholder="SW-123" value="{{ $equipo->name }}" required
                                    autocomplete="name" />
                            </div>
                            <x-input-error :messages="$errors->get('marca')" class="mt-2" />
                        </div>

                        <!-- Marca -->
                        <div class="mb-3">
                            <x-input-label class="form-label" for="marca{{ $equipo->marca }}" :value="__('Marca de equipo')" />
                            <div class="input-group input-group-merge">
                                <x-text-input id="marca{{ $equipo->marca }}" class="form-control" type="text"
                                    name="marca" placeholder="SISCO" value="{{ $equipo->marca }}" required
                                    autocomplete="marca" />
                            </div>
                            <x-input-error :messages="$errors->get('marca')" class="mt-2" />
                        </div>

                        <!-- Modelo -->
                        <div class="mb-3">
                            <x-input-label class="form-label" for="model{{ $equipo->model }}" :value="__('Modelo del equipo')" />
                            <div class="input-group input-group-merge">
                                <x-text-input id="model{{ $equipo->model }}" class="form-control" type="text"
                                    name="model" placeholder="45RT7" value="{{ $equipo->model }}" required
                                    autocomplete="model" />
                            </div>
                            <x-input-error :messages="$errors->get('model')" class="mt-2" />
                        </div>

                        <!-- Serial -->
                        <div class="mb-3">
                            <x-input-label class="form-label" for="serial{{ $equipo->serial }}" :value="__('Serie del equipo')" />
                            <div class="input-group input-group-merge">
                                <x-text-input id="serial{{ $equipo->serial }}" class="form-control" type="text"
                                    name="serial" placeholder="52RSCF78N93" value="{{ $equipo->serial }}" required
                                    autocomplete="serial" />
                            </div>
                            <x-input-error :messages="$errors->get('serial')" class="mt-2" />
                        </div>

                        <!-- MAC -->
                        <div class="mb-3">
                            <x-input-label class="form-label" for="mac{{ $equipo->mac }}" :value="__('MAC del equipo')" />
                            <div class="input-group input-group-merge">
                                <x-text-input id="mac-edit" class="form-control" type="text"
                                    name="mac" placeholder="12:C0:96:24:00" value="{{ $equipo->mac }}" required
                                    autocomplete="mac" />
                            </div>
                            <x-input-error :messages="$errors->get('mac')" class="mt-2" />
                        </div>

                        <!-- IP -->
                        <div class="mb-3">
                            <x-input-label class="form-label" for="ip{{ $equipo->ip }}" :value="__('IP del equipo')" />
                            <div class="input-group input-group-merge">
                                <x-text-input id="ip{{ $equipo->ip }}" class="form-control" type="text"
                                    name="ip" placeholder="10.01.2.31" value="{{ $equipo->ip }}" required
                                    autocomplete="ip" />
                            </div>
                            <x-input-error :messages="$errors->get('ip')" class="mt-2" />
                        </div>

                        <!-- Total Ports -->
                        <div class="mb-3">
                            <x-input-label class="form-label" for="total_ports{{ $equipo->total_ports }}" :value="__('Total de puertos')" />
                            <div class="input-group input-group-merge">
                                <x-text-input id="total_ports{{ $equipo->total_ports }}" class="form-control" type="text"
                                    name="total_ports" placeholder="24" value="{{ $equipo->total_ports }}" required
                                    autocomplete="total_ports" />
                            </div>
                            <x-input-error :messages="$errors->get('total_ports')" class="mt-2" />
                        </div>

                        <!-- Locations -->
                        <div class="mb-3">
                            <label for="hotel_id">Ubicacion</label>
                            <select class="form-control" id="hotel_id" name="hotel_id"
                                aria-label="Default select example">
                                @foreach ($hotels as $location)
                                    <option value="{{ $location->id }}"
                                        {{ $equipo->hotel_id == $location->id ? 'selected' : '' }}>
                                        {{ $location->name }}</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('hotel_id')" class="mt-2" />
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-primary">Actualizar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endforeach

<script>
    document.getElementById('mac-edit').addEventListener('input', function(e) {
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