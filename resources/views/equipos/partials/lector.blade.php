<div class="formulario-6 campos-equipo" style="display: none;">
    <div class="mb-3">
        <label class="form-label" for="marca_lector">Marca del lector</label>
        <div class="input-group input-group-merge">
            <x-text-input type="text" class="form-control" id="marca_lector"
                name="marca_lector"
                aria-describedby="basic-icon-default-fullname2"
                autocomplete="marca_lector"  />
        </div>
        <x-input-error :messages="$errors->get('marca_lector')" class="mt-2" />

        <label class="form-label" for="modelo_lector">Modelo del lector</label>
        <div class="input-group input-group-merge">
            <x-text-input type="text" class="form-control" id="modelo_lector"
                name="modelo_lector"
                aria-describedby="basic-icon-default-fullname2"
                autocomplete="modelo_lector"  />
        </div>
        <x-input-error :messages="$errors->get('modelo_lector')" class="mt-2" />

        <label class="form-label" for="serie_lector">Numero de Serie</label>
        <div class="input-group input-group-merge">
            <x-text-input type="text" class="form-control" id="serie_breack"
                name="serie_lector"
                aria-describedby="basic-icon-default-fullname2"
                autocomplete="serie_lector"  />
        </div>
        <x-input-error :messages="$errors->get('serie_lector')" class="mt-2" />
    </div>
    <!-- Agrega más campos específicos para teclado aquí -->
</div>