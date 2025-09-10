<div class="row">
    <div class="col-md-6 mb-3">
        <label for="name" class="form-label required-field">Nombre</label>
        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
            value="{{ old('name', $camera->name ?? '') }}" required>
        @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
        <div class="form-text">Nombre único para identificar la cámara.</div>
    </div>
    <div class="col-md-6 mb-3">
        <label for="idf" class="form-label">IDF</label>
        <input type="text" class="form-control @error('idf') is-invalid @enderror" id="idf" name="idf"
            value="{{ old('idf', $camera->idf ?? '') }}">
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
            <option value="A" {{ old('zona', $camera->zona ?? '') == 'A' ? 'selected' : '' }}>Zona A</option>
            <option value="B" {{ old('zona', $camera->zona ?? '') == 'B' ? 'selected' : '' }}>Zona B</option>
            <option value="C" {{ old('zona', $camera->zona ?? '') == 'C' ? 'selected' : '' }}>Zona C</option>
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
                        {{ old('region_id', $camera->region_id ?? '') == $region->id ? 'selected' : '' }}>
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
                    <option value="">Choose a region</option>
                    @foreach ($userRegions as $region)
                        <option value="{{ $region->id }}"
                            {{ old('region_id', $camera->region_id ?? '') == $region->id ? 'selected' : '' }}>
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
                    {{ old('location_id', $camera->location_id ?? '') == $location->id ? 'selected' : '' }}>
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
                name="brand" value="{{ old('brand', $camera->brand ?? '') }}" required>
            @error('brand')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="col-md-6 mb-3">
            <label for="model" class="form-label required-field">Modelo</label>
            <input type="text" class="form-control @error('model') is-invalid @enderror" id="model"
                name="model" value="{{ old('model', $camera->model ?? '') }}" required>
            @error('model')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="row">
        <div class="col-md-4 mb-3">
            <label for="serial" class="form-label required-field">Número de Serie</label>
            <input type="text" class="form-control @error('serial') is-invalid @enderror" id="serial"
                name="serial" value="{{ old('serial', $camera->serial ?? '') }}" required>
            @error('serial')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
            <div class="form-text">Debe ser único.</div>
        </div>
        <div class="col-md-4 mb-3">
            <label for="mac" class="form-label required-field">Dirección MAC</label>
            <input type="text" class="form-control @error('mac') is-invalid @enderror" id="mac" name="mac"
                value="{{ old('mac', $camera->mac ?? '') }}" required>
            @error('mac')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
            <div class="form-text">Debe ser única.</div>
        </div>
        <div class="col-md-4 mb-3">
            <label for="ip" class="form-label required-field">Dirección IP</label>
            <input type="text" class="form-control @error('ip') is-invalid @enderror" id="ip"
                name="ip" value="{{ old('ip', $camera->ip ?? '') }}" required>
            @error('ip')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
            <div class="form-text">Debe ser única.</div>
        </div>
    </div>
</div>

<!-- TYPE CAMERA -->
<div class="mb-3">
    <label for="type_camera_id" class="form-label">Tipo de cámara</label>
    <select name="type_camera_id" id="type_camera_id" class="form-select" required>
        <option value="">-- Selecciona un tipo de cámara --</option>
        @foreach ($types as $type)
            <option value="{{ $type->id }}"
                {{ old('type_camera_id', $camera->type_camera_id ?? '') == $type->id ? 'selected' : '' }}>
                {{ $type->name }}
            </option>
        @endforeach
    </select>
</div>

<div class="row">
    <div class="col-md-6 mb-3">
        <label for="switch_id" class="form-label">Conectado a</label>
        <select class="form-select @error('switch_id') is-invalid @enderror" id="switch_id" name="switch_id">
            <option value="">Seleccionar switch</option>
            @foreach ($switches as $s)
                @if (!isset($switch) || $s->id != $switch->id)
                    <option value="{{ $s->id }}"
                        {{ old('switch_id', $camera->switch_id ?? '') == $s->id ? 'selected' : '' }}>
                        {{ $s->name }} ({{ $s->tipo }})
                    </option>
                @endif
            @endforeach
        </select>
        @error('switch_id')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
        <div class="form-text">Seleccione el switch al que está conectado.</div>
    </div>
    <div class="col-md-6 mb-3">
        <label for="connected_port" class="form-label">Puerto de Conexión</label>
        <input type="text" class="form-control @error('connected_port') is-invalid @enderror" id="connected_port"
            name="connected_port" value="{{ old('connected_port', $camera->connected_port ?? '') }}">
        @error('connected_port')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
        <div class="form-text">Número del puerto en el switch de conexión.</div>
    </div>
</div>

<script>
    function formatMacInput(e) {
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
    }

    document.addEventListener('DOMContentLoaded', function() {
        var macInput = document.getElementById('mac');
        if (macInput) {
            macInput.addEventListener('input', formatMacInput);

            // Formatear el valor existente al cargar (para editar)
            if (macInput.value) {
                // Simula un evento para formatear el valor inicial
                formatMacInput({
                    target: macInput
                });
            }
        }
    });
</script>
