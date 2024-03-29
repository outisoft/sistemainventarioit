<div class="formulario-8 campos-equipo" style="display: none;">
    <div class="mb-3">
        <label class="form-label" for="marca_mouse">Marca del mouse</label>
        <div class="input-group input-group-merge">
            <x-text-input type="text" class="form-control" id="marca_mouse"
                name="marca_mouse" aria-describedby="basic-icon-default-fullname2"
                autocomplete="marca_mouse"  />
        </div>
        <x-input-error :messages="$errors->get('marca_mouse')" class="mt-2" />

        <label class="form-label" for="serie_mouse">Numero de Serie</label>
        <div class="input-group input-group-merge">
            <x-text-input type="text" class="form-control" id="serie_mouse"
                name="serie_mouse" aria-describedby="basic-icon-default-fullname2"
                autocomplete="serie_mouse"  />
        </div>
        <x-input-error :messages="$errors->get('serie_mouse')" class="mt-2" />
    </div>
    <!-- Agrega más campos específicos para teclado aquí -->
</div>