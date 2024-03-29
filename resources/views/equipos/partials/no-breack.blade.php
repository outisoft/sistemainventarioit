<div class="formulario-9 campos-equipo" style="display: none;">
    <div class="mb-3">
        <label class="form-label" for="marca_breack">Marca del No-Breack</label>
        <div class="input-group input-group-merge">
            <x-text-input type="text" class="form-control" id="marca_breack"
                name="marca_breack"
                aria-describedby="basic-icon-default-fullname2"
                autocomplete="marca_breack"  />
        </div>
        <x-input-error :messages="$errors->get('marca_breack')" class="mt-2" />

        <label class="form-label" for="modelo_breack">Modelo del No-Breack</label>
        <div class="input-group input-group-merge">
            <x-text-input type="text" class="form-control" id="modelo_breack"
                name="modelo_breack"
                aria-describedby="basic-icon-default-fullname2"
                autocomplete="modelo_breack"  />
        </div>
        <x-input-error :messages="$errors->get('modelo_breack')" class="mt-2" />

        <label class="form-label" for="serie_breack">Numero de Serie</label>
        <div class="input-group input-group-merge">
            <x-text-input type="text" class="form-control" id="serie_breack"
                name="serie_breack"
                aria-describedby="basic-icon-default-fullname2"
                autocomplete="serie_breack"  />
        </div>
        <x-input-error :messages="$errors->get('serie_breack')" class="mt-2" />
    </div>
    <!-- Agrega más campos específicos para teclado aquí -->
</div>