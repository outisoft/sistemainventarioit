<div class="formulario-4 campos-equipo" style="display: none;">
    <div class="mb-3">
        <label class="form-label" for="marca_impresora">Marca de la
            impresora</label>
        <div class="input-group input-group-merge">
            <x-text-input type="text" class="form-control"
                id="marca_impresora" name="marca_impresora"
                aria-describedby="basic-icon-default-fullname2"
                autocomplete="marca_impresora"  />
        </div>
        <x-input-error :messages="$errors->get('marca_impresora')" class="mt-2" />

        <label class="form-label" for="modelo_impresora">Modelo de la
            impresora</label>
        <div class="input-group input-group-merge">
            <x-text-input type="text" class="form-control"
                id="modelo_impresora" name="modelo_impresora"
                aria-describedby="basic-icon-default-fullname2"
                autocomplete="modelo_impresora"  />
        </div>
        <x-input-error :messages="$errors->get('modelo_impresora')" class="mt-2" />

        <label class="form-label" for="serie_impresora">Numero de Serie</label>
        <div class="input-group input-group-merge">
            <x-text-input type="text" class="form-control" id="serie_breack"
                name="serie_impresora"
                aria-describedby="basic-icon-default-fullname2"
                autocomplete="serie_impresora"  />
        </div>
        <x-input-error :messages="$errors->get('serie_impresora')" class="mt-2" />
    </div>
    <!-- Agrega más campos específicos para teclado aquí -->
</div>