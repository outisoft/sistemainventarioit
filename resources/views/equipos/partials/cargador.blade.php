<div class="formulario-2 campos-equipo" style="display: none;">
    <div class="mb-3">
        <label class="form-label" for="marca_cargador">Marca del cargador</label>
        <div class="input-group input-group-merge">
            <x-text-input type="text" class="form-control" id="marca_cargador"
                name="marca_cargador"
                aria-describedby="basic-icon-default-fullname2"
                autocomplete="marca_cargador"  />
        </div>
        <x-input-error :messages="$errors->get('marca_cargador')" class="mt-2" />

        <label class="form-label" for="modelo_cargador">Modelo del cargador</label>
        <div class="input-group input-group-merge">
            <x-text-input type="text" class="form-control" id="modelo_cargador"
                name="modelo_cargador"
                aria-describedby="basic-icon-default-fullname2"
                autocomplete="modelo_cargador"  />
        </div>
        <x-input-error :messages="$errors->get('modelo_cargador')" class="mt-2" />

        <label class="form-label" for="serie_cargador">Numero de Serie</label>
        <div class="input-group input-group-merge">
            <x-text-input type="text" class="form-control" id="serie_cargador"
                name="serie_cargador"
                aria-describedby="basic-icon-default-fullname2"
                autocomplete="serie_cargador"  />
        </div>
        <x-input-error :messages="$errors->get('serie_cargador')" class="mt-2" />
    </div>
    <!-- Agrega más campos específicos para teclado aquí -->
</div>