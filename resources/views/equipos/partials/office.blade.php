<div class="formulario-10 campos-equipo" style="display: none;">
    <div class="mb-3">
        <label class="form-label" for="office">Paqueteria Office</label>
        <div class="input-group input-group-merge">
            <x-text-input type="text" class="form-control" id="office"
                name="office" aria-describedby="basic-icon-default-fullname2"
                autocomplete="office"  />
        </div>
        <x-input-error :messages="$errors->get('office')" class="mt-2" />

        <label class="form-label" for="clave_office">Clave de activacion</label>
        <div class="input-group input-group-merge">
            <x-text-input type="text" class="form-control" id="clave_office"
                name="clave_office"
                aria-describedby="basic-icon-default-fullname2"
                autocomplete="clave_office"  />
        </div>
        <x-input-error :messages="$errors->get('clave_office')" class="mt-2" />
    </div>
    <!-- Agrega más campos específicos para teclado aquí -->
</div>