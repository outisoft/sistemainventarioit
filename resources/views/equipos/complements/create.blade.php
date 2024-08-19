<!--Modal create-->
<div class="modal fade" id="modalCreate" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Complemento</h4>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true"></span></button>
            </div>

            <div class="modal-body">
                <form method="POST" action="{{ route('complements.store') }}">
                    @csrf
                    <!-- Tipo -->
                    <div class="mb-3">
                        <x-input-label class="form-label" for="tipo_id" :value="__('Tipo de equipo')" />
                        <select id="tipo_id" name="tipo_id" class="form-control" aria-label="Default select example">
                            <option value="1">SCANNER</option>
                            <option value="5">MONITOR</option>
                            <option value="6">MOUSE</option>
                            <option value="7">NO-BREACK</option>
                            <option value="8">TECLADO</option>
                            <option value="9">WACOM</option>
                        </select>
                    </div>

                    <!-- Marca -->
                    <div class="mb-3">
                        <x-input-label class="form-label" for="marca" :value="__('Marca de equipo')" />
                        <div class="input-group input-group-merge">
                            <x-text-input id="marca" class="form-control" type="text"
                                name="marca" placeholder="HP" :value="old('marca')" required
                                autocomplete="marca" />
                        </div>
                        <x-input-error :messages="$errors->get('marca')" class="mt-2" />
                    </div>

                    <!-- Model -->
                    <div class="mb-3">
                        <x-input-label class="form-label" for="model" :value="__('Modelo de equipo')" />
                        <div class="input-group input-group-merge">
                            <x-text-input id="model" class="form-control" type="text"
                                name="model" placeholder="Lazer MFP 432fdm" :value="old('model')" required
                                autocomplete="model" />
                        </div>
                        <x-input-error :messages="$errors->get('model')" class="mt-2" />
                    </div>

                    <!-- Numero de serie -->
                    <div class="mb-3">
                        <x-input-label class="form-label" for="serial" :value="__('Numero de serie')" />
                        <div class="input-group input-group-merge">
                            <x-text-input id="serial" class="form-control" type="text"
                                name="serial" placeholder="CNB1P50T0" :value="old('serial')" required
                                autocomplete="serial" />
                        </div>
                        <x-input-error :messages="$errors->get('serial')" class="mt-2" />
                    </div>
                    <br>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </form>
            </div>
        </div>
    </div>
</div>
