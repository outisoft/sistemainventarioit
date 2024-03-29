<div class="formulario-3 campos-equipo mb-3" style="display: none;">
    <div class="mb-3">
        <label class="form-label" for="orden_cpu">Orden de compra</label>
        <div class="input-group input-group-merge">
            <x-text-input type="text" class="form-control" id="orden_cpu"
                name="orden_cpu" aria-describedby="basic-icon-default-fullname2"
                autocomplete="orden"  />
        </div>
        <x-input-error :messages="$errors->get('orden_cpu')" class="mt-2" />

        <label class="form-label" for="marca_cpu">Marca del equipo</label>
        <div class="input-group input-group-merge">
            <x-text-input type="text" class="form-control" id="marca_cpu"
                name="marca_cpu" aria-describedby="basic-icon-default-fullname2"
                autocomplete="name"  />
        </div>
        <x-input-error :messages="$errors->get('marca_cpu')" class="mt-2" />

        <label class="form-label" for="modelo_cpu">Modelo del equipo</label>
        <div class="input-group input-group-merge">
            <x-text-input type="text" class="form-control" id="modelo_cpu"
                name="modelo_cpu" aria-describedby="basic-icon-default-fullname2"
                autocomplete="name"  />
        </div>
        <x-input-error :messages="$errors->get('modelo_cpu')" class="mt-2" />

        <label class="form-label" for="serie_cpu">Numero de serie</label>
        <div class="input-group input-group-merge">
            <x-text-input type="text" class="form-control" id="serie_cpu"
                name="serie_cpu" aria-describedby="basic-icon-default-fullname2"
                autocomplete="name"  />
        </div>
        <x-input-error :messages="$errors->get('serie_cpu')" class="mt-2" />

        <label class="form-label" for="nombre_equipo_cpu">Nombre del
            equipo</label>
        <div class="input-group input-group-merge">
            <x-text-input type="text" class="form-control"
                id="nombre_equipo_cpu" name="nombre_equipo_cpu"
                aria-describedby="basic-icon-default-fullname2"
                autocomplete="name"  />
        </div>
        <x-input-error :messages="$errors->get('nombre_equipo_cpu')" class="mt-2" />

        <label class="form-label" for="ip_cpu">Ip del equipo</label>
        <div class="input-group input-group-merge">
            <x-text-input type="text" class="form-control" id="ip_cpu"
                name="ip_cpu" aria-describedby="basic-icon-default-fullname2"
                autocomplete="name"  />
        </div>
        <x-input-error :messages="$errors->get('ip_cpu')" class="mt-2" />

        <label class="form-label" for="contrato_cpu">Numero de contrato</label>
        <div class="input-group input-group-merge">
            <x-text-input type="text" class="form-control" id="contrato_cpu"
                name="contrato_cpu"
                aria-describedby="basic-icon-default-fullname2"
                autocomplete="name"  />
        </div>
        <x-input-error :messages="$errors->get('contrato_cpu')" class="mt-2" />
    </div>
    <!-- Agrega más campos específicos para CPU aquí -->
</div>