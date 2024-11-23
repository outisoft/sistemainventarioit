<!--Modal create-->
<div class="modal fade" id="modalCreate" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            
            <form method="POST" action="{{ route('phones.store') }}">
                @csrf
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">New Phone</h4>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true"></span></button>
                </div>

                <div class="modal-body">
                    <!-- Extension -->
                    <div class="mb-3">
                        <x-input-label class="form-label" for="extension" :value="__('Extension')" />
                        <div class="input-group input-group-merge">
                            <x-text-input id="extension" class="form-control" type="text"
                                name="extension" placeholder="28028" :value="old('extension')" required
                                autocomplete="extension" />
                        </div>
                        <x-input-error :messages="$errors->get('extension')" class="mt-2" />
                    </div>

                    <!-- Service -->
                    <div class="mb-3">
                        <x-input-label class="form-label" for="service" :value="__('Service')" />
                        <div class="input-group input-group-merge">
                            <x-text-input id="service" class="form-control" type="text"
                                name="service" placeholder="MITEL" :value="old('service')" required
                                autocomplete="service" />
                        </div>
                        <x-input-error :messages="$errors->get('service')" class="mt-2" />
                    </div>

                    <!-- Model -->
                    <div class="mb-3">
                        <x-input-label class="form-label" for="model" :value="__('Model')" />
                        <div class="input-group input-group-merge">
                            <x-text-input id="model" class="form-control" type="text"
                                name="model" placeholder="5312 IP Phone" :value="old('model')" required
                                autocomplete="model" />
                        </div>
                        <x-input-error :messages="$errors->get('model')" class="mt-2" />
                    </div>

                    <!-- Serial -->
                    <div class="mb-3">
                        <x-input-label class="form-label" for="serial" :value="__('Serial Number')" />
                        <div class="input-group input-group-merge">
                            <x-text-input id="serial" class="form-control" type="text"
                                name="serial" placeholder="R52BJ98SUY" :value="old('serial')" required
                                autocomplete="serial" />
                        </div>
                        <x-input-error :messages="$errors->get('serial')" class="mt-2" />
                    </div>

                    <!-- Remarks -->
                    <div class="mb-3">
                        <x-input-label class="form-label" for="remarks" :value="__('Observaciones')" />
                        <div class="input-group input-group-merge">
                            <textarea id="remarks" class="form-control" type="textarea"
                                name="remarks" placeholder="Escribe tus observaciones..." :value="old('remarks')" required
                                autocomplete="remarks" rows="3"></textarea>
                        </div>
                        <x-input-error :messages="$errors->get('remarks')" class="mt-2" />
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            
            </form>
        </div>
    </div>
</div>
