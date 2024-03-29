<div class="formulario-13 campos-equipo mb-3" style="display: none;">
    <div class="mb-3">
        <label class="form-label" for="marca_teclado">Marca del teclado</label>
        <div class="input-group input-group-merge">
            <x-text-input type="text" class="form-control" id="marca_teclado"
                name="marca_teclado"
                aria-describedby="basic-icon-default-fullname2"
                autocomplete="marca_teclado"  />
        </div>
        <x-input-error :messages="$errors->get('marca_teclado')" class="mt-2" />

        <label class="form-label" for="serie_teclado">Numero de Serie</label>
        <div class="input-group input-group-merge">
            <x-text-input type="text" class="form-control" id="serie_teclado"
                name="serie_teclado"
                aria-describedby="basic-icon-default-fullname2"
                autocomplete="serie_teclado"  />
        </div>
        <x-input-error :messages="$errors->get('serie_teclado')" class="mt-2" />
    </div>
    <!-- Agrega más campos específicos para teclado aquí -->
</div>