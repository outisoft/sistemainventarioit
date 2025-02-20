<!-- Modales de Edición -->
@foreach ($equipos as $equipo)
    <div class="modal fade" id="editModal{{ $equipo->id }}" tabindex="-1" aria-labelledby="editModal{{ $equipo->id }}"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('complements.update', $equipo) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModal{{ $equipo->id }}">Edit: {{ $equipo->type->name }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        <!-- Region -->
                        {{-- Región (solo visible para administradores) --}}
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

                        <!-- Tipo -->
                        <div class="mb-3">
                            <x-input-label class="form-label" for="type_id" :value="__('Type equipment')" />
                            <select class="form-control" id="type_id" name="type_id" required>
                                <option value="">Choose a type</option>
                                @foreach ($tipos as $tipo)
                                    <option value="{{ $tipo->id }}"
                                        {{ $equipo->type_id == $tipo->id ? 'selected' : '' }}>
                                        {{ $tipo->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Marca -->
                        <div class="mb-3">
                            <x-input-label class="form-label" for="brand{{ $equipo->brand }}" :value="__('Brand')" />
                            <div class="input-group input-group-merge">
                                <x-text-input id="brand{{ $equipo->brand }}" class="form-control" type="text"
                                    name="brand" placeholder="HP" value="{{ $equipo->brand }}" required
                                    autocomplete="brand" />
                            </div>
                            <x-input-error :messages="$errors->get('brand')" class="mt-2" />
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
                            <x-input-label class="form-label" for="serial{{ $equipo->serial }}" :value="__('Serial number / CT')" />
                            <div class="input-group input-group-merge">
                                <x-text-input id="serial{{ $equipo->serial }}" class="form-control" type="text"
                                    name="serial" placeholder="HP" value="{{ $equipo->serial }}" required
                                    autocomplete="serial" />
                            </div>
                            <x-input-error :messages="$errors->get('serial')" class="mt-2" />
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
                    } else {
                        modal.find('#lease_fields_edit').hide();
                        modal.find('#lease_id').removeAttr('required');
                        modal.find('#lease_id').val('');
                    }
                });

                // Trigger change event on page load to set initial state
                modal.find('input[name="lease"]:checked').trigger('change');
            });
        });
    </script>
@endforeach
