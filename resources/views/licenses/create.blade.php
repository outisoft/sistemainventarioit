<!--Modal create-->
<div class="modal fade" id="modalCreate" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Office 365</h4>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true"></span></button>
            </div>

            <div class="modal-body">
                <form method="POST" action="{{ route('licenses.store') }}">
                    @csrf
                    <!-- Tipo -->
                    <div class="mb-3" style="display: none;">
                        <x-input-label class="form-label" for="tipo_id" :value="__('Tipo de equipo')" />
                        <div class="input-group input-group-merge">
                            <x-text-input readonly='readonly' id="tipo_id" class="form-control" type="text"
                                name="tipo_id" placeholder="Office" :value="11" required
                                autocomplete="tipo_id" />
                        </div>
                        <x-input-error :messages="$errors->get('tipo_id')" class="mt-2" />
                    </div>

                    <!-- Correo Office -->
                    <div class="mb-3">
                    <x-input-label class="form-label" for="email" :value="__('Correo office 365')" />
                        <div class="input-group input-group-merge">
                            <x-text-input type="text" class="form-control" id="email"
                                name="email" placeholder="correo@ejemplo.onmicrosoft.com" aria-label="0038628"
                                aria-describedby="basic-icon-default-fullname2" required autofocus
                                autocomplete="email" />
                        </div>
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <!-- password -->
                    <div class="mb-3">
                        <x-input-label class="form-label" for="password" :value="__('Contraseña')" />
                        <div class="input-group input-group-merge">
                            <x-text-input id="password" class="form-control" type="text"
                                name="password" placeholder="RTN-3164" :value="old('password')" required
                                autocomplete="password" />
                        </div>
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>   

                    <br>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </form>
            </div>
        </div>
    </div>
</div>