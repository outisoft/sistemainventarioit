<div class="formulario-1 campos-equipo" style="display: none;">
    <div class="mb-3">
        <label class="form-label" for="nombre_app">Nombre de la aplicacion</label>
        <div class="input-group input-group-merge">
            <x-text-input type="text" class="form-control" id="nombre_app"
                name="nombre_app" aria-describedby="basic-icon-default-fullname2"
                autocomplete="nombre_app"  />
        </div>
        <x-input-error :messages="$errors->get('nombre_app')" class="mt-2" />

        <label class="form-label" for="clave_app">Clave de activacion</label>
        <div class="input-group input-group-merge">
            <x-text-input type="text" class="form-control" id="clave_app"
                name="clave_app" aria-describedby="basic-icon-default-fullname2"
                autocomplete="clave_app"  />
        </div>
        <x-input-error :messages="$errors->get('clave_app')" class="mt-2" />
    </div>
    <!-- Agrega más campos específicos para teclado aquí -->
</div>