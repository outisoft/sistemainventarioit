<!-- Modales de Edición -->
@foreach ($equipos as $equipo)
    <div class="modal fade" id="editModal{{ $equipo->id }}" tabindex="-1" aria-labelledby="editModal{{ $equipo->id }}"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('desktops.update', $equipo) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModal{{ $equipo->id }}">Edit: {{ $equipo->name }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        <!-- Region -->
                        @role('Administrator')
                            <div class="mb-3">
                                <x-input-label class="form-label" for="region_id" :value="__('REGION')" />
                                <select class="form-control" id="region_id" name="region_id"
                                    aria-label="Default select example">
                                    @foreach ($regions as $region)
                                        <option value="{{ $region->id }}"
                                            {{ $equipo->region_id == $region->id ? 'selected' : '' }}>
                                            {{ $region->name }}</option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('region_id')" class="mt-2" />
                            </div>
                        @else
                            @if ($userRegions->count() > 1)
                                <!-- Si el usuario tiene múltiples regiones, muestra un campo de selección -->
                                <div class="mb-3">
                                    <x-input-label class="form-label" for="region_id" :value="__('REGION')" />
                                    <select class="form-control" id="region_id" name="region_id"
                                        aria-label="Default select example">
                                        @foreach ($userRegions as $region)
                                            <option value="{{ $region->id }}"
                                                {{ $equipo->region_id == $region->id ? 'selected' : '' }}>
                                                {{ $region->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <x-input-error :messages="$errors->get('region_id')" class="mt-2" />
                                </div>
                            @else
                                <!-- Si el usuario tiene solo una región, asigna automáticamente esa región -->
                                <input type="hidden" name="region_id" value="{{ $userRegions->first()->id }}">
                            @endif
                        @endrole

                        <!-- Marca -->
                        <div class="mb-3">
                            <x-input-label class="form-label" for="marca{{ $equipo->marca }}" :value="__('Brand')" />
                            <div class="input-group input-group-merge">
                                <x-text-input id="marca{{ $equipo->marca }}" class="form-control" type="text"
                                    name="marca" placeholder="HP" value="{{ $equipo->marca }}" required
                                    autocomplete="marca" />
                            </div>
                            <x-input-error :messages="$errors->get('marca')" class="mt-2" />
                        </div>

                        <!-- Modelo -->
                        <div class="mb-3">
                            <x-input-label class="form-label" for="model{{ $equipo->model }}" :value="__('Model')" />
                            <div class="input-group input-group-merge">
                                <x-text-input id="model{{ $equipo->model }}" class="form-control" type="text"
                                    name="model" placeholder="HP" value="{{ $equipo->model }}" required
                                    autocomplete="model" />
                            </div>
                            <x-input-error :messages="$errors->get('model')" class="mt-2" />
                        </div>

                        <!-- Serial -->
                        <div class="mb-3">
                            <x-input-label class="form-label" for="serial{{ $equipo->serial }}" :value="__('Serial number')" />
                            <div class="input-group input-group-merge">
                                <x-text-input id="serial{{ $equipo->serial }}" class="form-control" type="text"
                                    name="serial" placeholder="HP" value="{{ $equipo->serial }}" required
                                    autocomplete="serial" />
                            </div>
                            <x-input-error :messages="$errors->get('serial')" class="mt-2" />
                        </div>

                        <!-- Nombre -->
                        <div class="mb-3">
                            <x-input-label class="form-label" for="name{{ $equipo->name }}" :value="__('Equipment name')" />
                            <div class="input-group input-group-merge">
                                <x-text-input id="name{{ $equipo->name }}" class="form-control" type="text"
                                    name="name" placeholder="HP" value="{{ $equipo->name }}" required
                                    autocomplete="name" />
                            </div>
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <!-- IP -->
                        <div class="mb-3">
                            <x-input-label class="form-label" for="ip{{ $equipo->ip }}" :value="__('IP')" />
                            <div class="input-group input-group-merge">
                                <x-text-input id="ip{{ $equipo->ip }}" class="form-control" type="text"
                                    name="ip" placeholder="HP" value="{{ $equipo->ip }}" required
                                    autocomplete="ip" />
                            </div>
                            <x-input-error :messages="$errors->get('ip')" class="mt-2" />
                        </div>

                        <!-- SO -->
                        <div class="mb-3">
                            <x-input-label class="form-label" for="so{{ $equipo->so }}" :value="__('Operating system')" />
                            <div class="input-group input-group-merge">
                                <x-text-input id="so{{ $equipo->so }}" class="form-control" type="text"
                                    name="so" placeholder="Windows 11" value="{{ $equipo->so }}" required
                                    autocomplete="so" />
                            </div>
                            <x-input-error :messages="$errors->get('so')" class="mt-2" />
                        </div>

                        <!-- ORDEN DE COMPRA -->
                        <div class="mb-3">
                            <x-input-label class="form-label" for="orden{{ $equipo->orden }}" :value="__('Order')" />
                            <div class="input-group input-group-merge">
                                <x-text-input id="orden{{ $equipo->orden }}" class="form-control" type="text"
                                    name="orden" placeholder="HP" value="{{ $equipo->orden }}" required
                                    autocomplete="orden" />
                            </div>
                            <x-input-error :messages="$errors->get('orden')" class="mt-2" />
                        </div>

                        <!-- lease -->
                        <div class="mb-3">
                            <x-input-label class="form-label" for="lease" :value="__('Is it lease?')" />
                            <div class="col-md">
                                <div class="form-check form-check-inline mt-3">
                                    <input class="form-check-input" type="radio" name="lease" id="lease_si"
                                        value="1" {{ $equipo->lease ? 'checked' : '' }} />
                                    <label class="form-check-label" for="lease_si">Yes</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="lease" id="lease_no"
                                        value="0" {{ !$equipo->lease ? 'checked' : '' }} />
                                    <label class="form-check-label" for="lease_no">No</label>
                                </div>
                            </div>
                            <x-input-error :messages="$errors->get('lease')" class="mt-2" />
                        </div>

                        <!-- af_code-->
                        <div id="af_field_edit" style="display">
                            <div class="mb-3">
                                <x-input-label class="form-label" for="af_code{{ $equipo->af_code }}" :value="__('Fixed Asset Code')" />
                                <div class="input-group input-group-merge">
                                    <x-text-input id="af_code{{ $equipo->af_code }}" class="form-control" type="text"
                                        name="af_code" placeholder="HP" value="{{ $equipo->af_code }}" required
                                        autocomplete="af_code" />
                                </div>
                                <x-input-error :messages="$errors->get('af_code')" class="mt-2" />
                            </div>
                        </div>

                        <!-- Campos adicionales para arrendamiento -->
                        <div id="lease_fields_edit" style="display: {{ $equipo->lease ? 'block' : 'none' }};">
                            <div class="mb-3">
                                <x-input-label class="form-label" for="lease_id" :value="__('LEASE')" />
                                <select class="form-control" id="lease_id" name="lease_id"
                                    aria-label="Default select example">
                                    <option value="">Choose a lease</option>
                                    @foreach ($leases as $lease)
                                        <option value="{{ $lease->id }}"
                                            {{ $equipo->lease_id == $lease->id ? 'selected' : '' }}>
                                            {{ $lease->lease }}
                                        </option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('lease_id')" class="mt-2" />
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            // Attach event handler to each modal when it is shown
            $('.modal').on('shown.bs.modal', function() {
                var modal = $(this);
                modal.find('input[name="lease"]').on('change', function() {
                    if (modal.find('#lease_si').is(':checked')) {
                        modal.find('#lease_fields_edit').show();
                        modal.find('#lease_id').attr('required', true);

                        modal.find('#af_field_edit').hide();
                        modal.find('#af_code').removeAttr('required');
                        modal.find('#af_code').val('');
                    } else {
                        modal.find('#lease_fields_edit').hide();
                        modal.find('#lease_id').removeAttr('required');
                        modal.find('#lease_id').val('');

                        modal.find('#af_field_edit').show();
                        modal.find('#af_code').attr('required', true);
                    }
                });

                // Trigger change event on page load to set initial state
                modal.find('input[name="lease"]:checked').trigger('change');
            });
        });
    </script>
@endforeach
