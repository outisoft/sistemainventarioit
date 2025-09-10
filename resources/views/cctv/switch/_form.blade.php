<div class="row">
    <div class="col-md-6 mb-3">
        <label for="name" class="form-label required-field">Nombre</label>
        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
            value="{{ old('name', $switch->name ?? '') }}" required>
        @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
        <div class="form-text">Nombre único para identificar el switch.</div>
    </div>
    <div class="col-md-6 mb-3">
        <label for="idf" class="form-label">IDF</label>
        <input type="text" class="form-control @error('idf') is-invalid @enderror" id="idf" name="idf"
            value="{{ old('idf', $switch->idf ?? '') }}">
        @error('idf')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>
<div class="row">
    <div class="col-md-4 mb-3">
        <label for="zona" class="form-label">Zona</label>
        <select class="form-select @error('zona') is-invalid @enderror" id="zona" name="zona">
            <option value="">Seleccionar zona</option>
            <option value="A" {{ old('zona', $switch->zona ?? '') == 'A' ? 'selected' : '' }}>Zona A</option>
            <option value="B" {{ old('zona', $switch->zona ?? '') == 'B' ? 'selected' : '' }}>Zona B</option>
            <option value="C" {{ old('zona', $switch->zona ?? '') == 'C' ? 'selected' : '' }}>Zona C</option>
        </select>
        @error('zona')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    @role('Administrator')
        <div class="col-md-4 mb-3">
            <x-input-label class="form-label" for="region_id" :value="__('REGION')" />
            <select class="form-control" id="region_id" name="region_id">
                <option value="">Choose a region</option>
                @foreach ($regions as $region)
                    <option value="{{ $region->id }}"
                        {{ old('region_id', $switch->region_id ?? '') == $region->id ? 'selected' : '' }}>
                        {{ $region->name }}
                    </option>
                @endforeach
            </select>
            <x-input-error :messages="$errors->get('region_id')" class="mt-2" />
        </div>
    @else
        @if ($userRegions->count() > 1)
            <!-- Si el usuario tiene múltiples regiones, muestra un campo de selección -->
            <div class="col-md-4 mb-3">

                <x-input-label class="form-label" for="region_id" :value="__('REGION')" />
                <select name="region_id" id="region_id" class="form-control">
                    @foreach ($userRegions as $region)
                        <option value="{{ $region->id }}"
                            {{ old('region_id', $switch->region_id ?? '') == $region->id ? 'selected' : '' }}>
                            {{ $region->name }}
                        </option>
                    @endforeach
                </select>
            </div>
        @else
            <!-- Si el usuario tiene solo una región, asigna automáticamente esa región -->
            <input type="hidden" name="region_id" value="{{ $userRegions->first()->id }}">
        @endif
    @endrole

    <div class="col-md-4 mb-3">
        <label for="location_id" class="form-label">Ubicación Específica</label>
        <select class="form-select @error('location_id') is-invalid @enderror" id="location_id" name="location_id">
            <option value="">Seleccionar ubicación</option>
            @foreach ($locations as $location)
                <option value="{{ $location->id }}"
                    {{ old('location_id', $switch->location_id ?? '') == $location->id ? 'selected' : '' }}>
                    {{ $location->name }}
                </option>
            @endforeach
        </select>
        @error('location_id')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>

<!-- Sección: Información del Fabricante -->
<div class="form-section">
    <h5 class="form-section-title">Información del Fabricante</h5>
    <div class="row">
        <div class="col-md-6 mb-3">
            <label for="brand" class="form-label required-field">Marca</label>
            <input type="text" class="form-control @error('brand') is-invalid @enderror" id="brand"
                name="brand" value="{{ old('brand', $switch->brand ?? '') }}" required>
            @error('brand')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="col-md-6 mb-3">
            <label for="model" class="form-label required-field">Modelo</label>
            <input type="text" class="form-control @error('model') is-invalid @enderror" id="model"
                name="model" value="{{ old('model', $switch->model ?? '') }}" required>
            @error('model')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="row">
        <div class="col-md-4 mb-3">
            <label for="serial" class="form-label required-field">Número de Serie</label>
            <input type="text" class="form-control @error('serial') is-invalid @enderror" id="serial"
                name="serial" value="{{ old('serial', $switch->serial ?? '') }}" required>
            @error('serial')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
            <div class="form-text">Debe ser único.</div>
        </div>
        <div class="col-md-4 mb-3">
            <label for="mac" class="form-label required-field">Dirección MAC</label>
            <input type="text" class="form-control @error('mac') is-invalid @enderror" id="mac" name="mac"
                value="{{ old('mac', $switch->mac ?? '') }}" required>
            @error('mac')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
            <div class="form-text">Debe ser única.</div>
        </div>
        <div class="col-md-4 mb-3">
            <label for="ip" class="form-label required-field">Dirección IP</label>
            <input type="text" class="form-control @error('ip') is-invalid @enderror" id="ip"
                name="ip" value="{{ old('ip', $switch->ip ?? '') }}" required>
            @error('ip')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
            <div class="form-text">Debe ser única.</div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 mb-3">
            <label for="ports" class="form-label">Número de Puertos</label>
            <input type="number" class="form-control @error('ports') is-invalid @enderror" id="ports"
                name="ports" value="{{ old('ports', $switch->ports ?? 24) }}" min="1">
            @error('ports')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="col-md-6 mb-3">
            <label for="password" class="form-label">Contraseña</label>
            <div class="input-group">
                <input type="password" class="form-control @error('password') is-invalid @enderror" id="password"
                    name="password" value="{{ old('password', $switch->password ?? '') }}">
                <button class="btn btn-outline-primary" type="button" id="togglePassword">
                    <i class='bx bx-show-alt'></i>
                </button>
            </div>
            @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
</div>

<!-- Sección: Configuración de Red -->
<div class="form-section">
    <h5 class="form-section-title">Configuración de Red</h5>
    <div class="row">
        <div class="col-md-6 mb-3">
            <label for="tipo" class="form-label required-field">Tipo de Switch</label>
            <select class="form-select @error('tipo') is-invalid @enderror" id="tipo" name="tipo" required>
                <option value="idf" {{ old('tipo', $switch->tipo ?? 'idf') == 'idf' ? 'selected' : '' }}>IDF
                </option>
                <option value="principal" {{ old('tipo', $switch->tipo ?? '') == 'principal' ? 'selected' : '' }}>
                    Principal</option>
                <option value="secundario" {{ old('tipo', $switch->tipo ?? '') == 'secundario' ? 'selected' : '' }}>
                    Secundario</option>
            </select>
            @error('tipo')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-check-label" for="from_provider">¿Viene de proveedor?</label>
            <div class="form-check form-switch mt-2">
                <input class="form-check-input" type="checkbox" id="from_provider" name="from_provider"
                    value="1" {{ old('from_provider', $switch->from_provider ?? 0) ? 'checked' : '' }}>
                <label class="form-check-label" for="from_provider">Sí, viene de proveedor</label>
            </div>
            @error('from_provider')
                <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div id="connectionFields" class="connection-fields">
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="connected_to_id" class="form-label">Conectado a</label>
                <select class="form-select @error('connected_to_id') is-invalid @enderror" id="connected_to_id"
                    name="connected_to_id">
                    <option value="">Seleccionar switch</option>
                    @foreach ($switches as $s)
                        @if (!isset($switch) || $s->id != $switch->id)
                            <option value="{{ $s->id }}"
                                {{ old('connected_to_id', $switch->connected_to_id ?? '') == $s->id ? 'selected' : '' }}>
                                {{ $s->name }} ({{ $s->tipo }})
                            </option>
                        @endif
                    @endforeach
                </select>
                @error('connected_to_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                <div class="form-text">Seleccione el switch al que está conectado.</div>
            </div>
            <div class="col-md-6 mb-3">
                <label for="connected_port" class="form-label">Puerto de Conexión</label>
                <input type="text" class="form-control @error('connected_port') is-invalid @enderror"
                    id="connected_port" name="connected_port"
                    value="{{ old('connected_port', $switch->connected_port ?? '') }}">
                @error('connected_port')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                <div class="form-text">Número del puerto en el switch de conexión.</div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Mostrar/ocultar campos de conexión según el tipo de switch
        const tipoSelect = document.getElementById('tipo');
        const connectionFields = document.getElementById('connectionFields');

        function toggleConnectionFields() {
            if (tipoSelect.value === 'principal') {
                connectionFields.style.display = 'none';
                document.getElementById('from_provider').disabled = false;
            } else {
                connectionFields.style.display = 'block';
                document.getElementById('from_provider').disabled = true;
                document.getElementById('from_provider').checked = false;
            }
        }

        tipoSelect.addEventListener('change', toggleConnectionFields);
        toggleConnectionFields(); // Ejecutar al cargar la página

        // Alternar visibilidad de la contraseña
        document.getElementById('togglePassword').addEventListener('click', function() {
            const passwordInput = document.getElementById('password');
            const icon = this.querySelector('i');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                icon.classList.remove('bi-eye');
                icon.classList.add('bi-eye-slash');
            } else {
                passwordInput.type = 'password';
                icon.classList.remove('bi-eye-slash');
                icon.classList.add('bi-eye');
            }
        });
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
