<div class="formulario-5 campos-equipo mb-3" style="display: none;">
    <div class="mb-3">
        <label class="form-label" for="orden">Orden de compra</label>
        <div class="input-group input-group-merge">
            <x-text-input type="text" class="form-control" id="orden"
                name="orden" aria-describedby="basic-icon-default-fullname2"
                autocomplete="orden"  />
        </div>
        <x-input-error :messages="$errors->get('orden')" class="mt-2" />

        <label class="form-label" for="marca_equipo">Marca del equipo</label>
        <div class="input-group input-group-merge">
            <x-text-input type="text" class="form-control" id="marca_equipo"
                name="marca_equipo"
                aria-describedby="basic-icon-default-fullname2"
                autocomplete="name"  />
        </div>
        <x-input-error :messages="$errors->get('marca_equipo')" class="mt-2" />

        <label class="form-label" for="modelo_equipo">Modelo del equipo</label>
        <div class="input-group input-group-merge">
            <x-text-input type="text" class="form-control" id="modelo_equipo"
                name="modelo_equipo"
                aria-describedby="basic-icon-default-fullname2"
                autocomplete="modelo_equipo"  />
        </div>
        <x-input-error :messages="$errors->get('modelo_equipo')" class="mt-2" />

        <label class="form-label" for="serie_equipo">Numero de serie</label>
        <div class="input-group input-group-merge">
            <x-text-input type="text" class="form-control" id="modelo_equipo"
                name="serie_equipo"
                aria-describedby="basic-icon-default-fullname2"
                autocomplete="serie_equipo"  />
        </div>
        <x-input-error :messages="$errors->get('serie_equipo')" class="mt-2" />

        <label class="form-label" for="nombre_equipo">Nombre del equipo</label>
        <div class="input-group input-group-merge">
            <x-text-input type="text" class="form-control" id="nombre_equipo"
                name="nombre_equipo"
                aria-describedby="basic-icon-default-fullname2"
                autocomplete="nombre_equipo"  />
        </div>
        <x-input-error :messages="$errors->get('nombre_equipo')" class="mt-2" />

        <label class="form-label" for="ip">Ip del equipo</label>
        <div class="input-group input-group-merge">
            <x-text-input type="text" class="form-control" id="ip"
                name="ip" aria-describedby="basic-icon-default-fullname2"
                autocomplete="name"  />
        </div>
        <x-input-error :messages="$errors->get('ip')" class="mt-2" />

        <label class="form-label" for="contrato">Numero de contrato</label>
        <div class="input-group input-group-merge">
            <x-text-input type="text" class="form-control" id="contrato"
                name="contrato" aria-describedby="basic-icon-default-fullname2"
                autocomplete="name"  />
        </div>
        <x-input-error :messages="$errors->get('contrato')" class="mt-2" />
    </div>
    <!-- Agrega más campos específicos para CPU aquí -->
</div>