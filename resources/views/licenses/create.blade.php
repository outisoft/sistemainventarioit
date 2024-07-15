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
                    <!-- Correo Office -->
                    <div class="mb-3">
                    <x-input-label class="form-label" for="total_licenses" :value="__('Correo office 365')" />
                        <div class="input-group input-group-merge">
                            <x-text-input type="text" class="form-control" id="product_name"
                                name="product_name" placeholder="correo@ejemplo.onmicrosoft.com" aria-label="0038628"
                                aria-describedby="basic-icon-default-fullname2" required autofocus
                                autocomplete="product_name" />
                        </div>
                        <x-input-error :messages="$errors->get('product_name')" class="mt-2" />
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

                    <!-- Total de licencias -->
                    <div class="mb-3">
                        <x-input-label class="form-label" for="total_licenses" :value="__('Total de licencias')" />
                        <div class="input-group input-group-merge">
                            <x-text-input id="total_licenses" class="form-control" type="number"
                                name="total_licenses" placeholder="5" :value="old('total_licenses')" required
                                autocomplete="total_licenses" />
                        </div>
                        <x-input-error :messages="$errors->get('total_licenses')" class="mt-2" />
                    </div>

                    <!-- ELicenias aplicadas -->
                    <div class="mb-3">
                        <x-input-label class="form-label" for="applied_licenses" :value="__('Licencias aplicadas')" />
                        <div class="input-group input-group-merge">
                            <x-text-input id="applied_licenses" class="form-control" type="number"
                                name="applied_licenses" placeholder="2" :value="old('applied_licenses')"
                                required autocomplete="applied_licenses" />
                        </div>
                        <x-input-error :messages="$errors->get('applied_licenses')" class="mt-2" />
                    </div>

                    <br>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </form>
            </div>
        </div>
    </div>
</div>