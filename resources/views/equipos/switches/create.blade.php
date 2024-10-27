<!--Modal create-->
<div class="modal fade" id="modalCreate" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">SWITCH</h4>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"></span>
                </button>
            </div>

            <div class="modal-body">
                <form action="{{ route('switches.store') }}" method="POST">
                    @csrf
                    <!-- NOMBRE -->
                    <div class="mb-3">
                        <x-input-label class="form-label" for="name" :value="__('Nombre de equipo')" />
                        <div class="input-group input-group-merge">
                            <x-text-input id="name" class="form-control" type="text"
                                name="name" placeholder="SW-123" :value="old('name')" required
                                autocomplete="name" />
                        </div>
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <!-- MARCa -->
                    <div class="mb-3">
                        <x-input-label class="form-label" for="marca" :value="__('Marca de equipo')" />
                        <div class="input-group input-group-merge">
                            <x-text-input id="marca" class="form-control" type="text"
                                name="marca" placeholder="CISCO" :value="old('marca')" required
                                autocomplete="marca" />
                        </div>
                        <x-input-error :messages="$errors->get('marca')" class="mt-2" />
                    </div>

                    <!-- Modelo -->
                    <div class="mb-3">
                        <x-input-label class="form-label" for="model" :value="__('Modelo del SW')" />
                        <div class="input-group input-group-merge">
                            <x-text-input id="model" class="form-control" type="text"
                                name="model" placeholder="SWPOUYI7" :value="old('model')" required
                                autocomplete="model" />
                        </div>
                        <x-input-error :messages="$errors->get('model')" class="mt-2" />
                    </div>

                    <!-- Serial -->
                    <div class="mb-3">
                        <x-input-label class="form-label" for="serial" :value="__('Numero de serie')" />
                        <div class="input-group input-group-merge">
                            <x-text-input id="serial" class="form-control" type="text"
                                name="serial" placeholder="52RF97FNP0A87FJ" :value="old('serial')" required
                                autocomplete="serial" />
                        </div>
                        <x-input-error :messages="$errors->get('serial')" class="mt-2" />
                    </div>

                    <!-- MAC -->
                    <div class="mb-3">
                        <x-input-label class="form-label" for="mac" :value="__('Dirección MAC')" />
                        <div class="input-group input-group-merge">
                            <x-text-input id="mac" class="form-control" type="text"
                                name="mac" maxlength="17" placeholder="00:00:00:00:00:00" :value="old('mac')" required
                                autocomplete="mac" />
                        </div>
                        <x-input-error :messages="$errors->get('mac')" class="mt-2" />
                    </div>

                    <!-- IP DE EQUIPO -->
                    <div class="mb-3">
                        <x-input-label class="form-label" for="ip" :value="__('IP del equipo')" />
                        <div class="input-group input-group-merge">
                            <x-text-input id="ip" class="form-control" type="text"
                                name="ip" placeholder="10.1.32.48" :value="old('ip')" required
                                autocomplete="ip" />
                        </div>
                        <x-input-error :messages="$errors->get('ip')" class="mt-2" />
                    </div>

                    <!-- Puertos -->
                    <div class="mb-3">
                        <x-input-label class="form-label" for="total_ports" :value="__('Total de Puertos')" />
                        <div class="input-group input-group-merge">
                            <x-text-input id="total_ports" class="form-control" type="number"
                                name="total_ports" placeholder="24" :value="old('total_ports')" required
                                autocomplete="total_ports" />
                        </div>
                        <x-input-error :messages="$errors->get('total_ports')" class="mt-2" />
                    </div>

                    <div class="form-group">
                        <label for="hotel_id">Ubicación:</label>
                        <select class="form-control" id="hotel_id" name="hotel_id" required>
                            @foreach($hotels as $hotel)
                                <option value="{{ $hotel->id }}">{{ $hotel->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <br>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </form>
            </div>
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