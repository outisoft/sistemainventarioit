<div class="formulario-12 campos-equipo" style="display: none;">
    <div class="mb-3">
        <label class="form-label" for="so">Sistema Operativo</label>
        <div class="input-group input-group-merge">
            <x-text-input type="text" class="form-control" id="so"
                name="so" aria-describedby="basic-icon-default-fullname2"
                autocomplete="so"  />
        </div>
        <x-input-error :messages="$errors->get('so')" class="mt-2" />

        <label class="form-label" for="clave_so">Clave de activacion</label>
        <div class="input-group input-group-merge">
            <x-text-input type="text" class="form-control" id="clave_so"
                name="clave_so" aria-describedby="basic-icon-default-fullname2"
                autocomplete="clave_so"  />
        </div>
        <x-input-error :messages="$errors->get('clave_so')" class="mt-2" />
    </div>
    <!-- Agrega más campos específicos para teclado aquí -->
</div>