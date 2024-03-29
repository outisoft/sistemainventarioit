<div class="formulario-7 campos-equipo mb-3" style="display: none;">
    <div class="mb-3">
        <label class="form-label" for="marca_monitor">Marca del monitor</label>
        <div class="input-group input-group-merge">
            <x-text-input type="text" class="form-control" id="marca_monitor"
                name="marca_monitor"
                aria-describedby="basic-icon-default-fullname2"
                autocomplete="marca_monitor"  />
        </div>
        <x-input-error :messages="$errors->get('marca_monitor')" class="mt-2" />

        <label class="form-label" for="modelo_monitor">Modelo del monitor</label>
        <div class="input-group input-group-merge">
            <x-text-input type="text" class="form-control" id="modelo_monitor"
                name="modelo_monitor"
                aria-describedby="basic-icon-default-fullname2"
                autocomplete="modelo_monitor"  />
        </div>
        <x-input-error :messages="$errors->get('modelo_monitor')" class="mt-2" />

        <label class="form-label" for="serie_monitor">Numero de serie</label>
        <div class="input-group input-group-merge">
            <x-text-input type="text" class="form-control" id="modelo_equipo"
                name="serie_monitor"
                aria-describedby="basic-icon-default-fullname2"
                autocomplete="serie_monitor"  />
        </div>
        <x-input-error :messages="$errors->get('serie_monitor')" class="mt-2" />

        <label class="form-label" for="no_contrato">Numero de contrato</label>
        <div class="input-group input-group-merge">
            <x-text-input type="text" class="form-control" id="no_contrato"
                name="no_contrato" aria-describedby="basic-icon-default-fullname2"
                autocomplete="name"  />
        </div>
        <x-input-error :messages="$errors->get('no_contrato')" class="mt-2" />
    </div>
    <!-- Agrega más campos específicos para CPU aquí -->
</div>