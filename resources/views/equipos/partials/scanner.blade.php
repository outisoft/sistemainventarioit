<div class="formulario-11 campos-equipo" style="display: none;">
    <div class="mb-3">
        <label class="form-label" for="marca_escanner">Marca del escanner</label>
        <div class="input-group input-group-merge">
            <x-text-input type="text" class="form-control" id="marca_escanner"
                name="marca_escanner"
                aria-describedby="basic-icon-default-fullname2"
                autocomplete="marca_escanner"  />
        </div>
        <x-input-error :messages="$errors->get('marca_escanner')" class="mt-2" />

        <label class="form-label" for="modelo_escanner">Modelo del
            escanner</label>
        <div class="input-group input-group-merge">
            <x-text-input type="text" class="form-control"
                id="modelo_escanner" name="modelo_escanner"
                aria-describedby="basic-icon-default-fullname2"
                autocomplete="modelo_escanner"  />
        </div>
        <x-input-error :messages="$errors->get('modelo_escanner')" class="mt-2" />

        <label class="form-label" for="serie_escanner">Numero de Serie</label>
        <div class="input-group input-group-merge">
            <x-text-input type="text" class="form-control" id="serie_escanner"
                name="serie_escanner"
                aria-describedby="basic-icon-default-fullname2"
                autocomplete="serie_escanner"  />
        </div>
        <x-input-error :messages="$errors->get('serie_escanner')" class="mt-2" />
    </div>
    <!-- Agrega más campos específicos para teclado aquí -->
</div>