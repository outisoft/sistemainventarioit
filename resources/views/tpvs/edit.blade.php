<!-- Modales de Edición -->
@foreach ($tpvs as $tpv)
    <div class="modal fade" id="editModal{{ $tpv->id }}" tabindex="-1" aria-labelledby="editModal{{ $tpv->id }}"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="editForm{{ $tpv->id }}" method="POST" action="{{ route('tpvs.update', $tpv->id) }}">
                    @csrf
                    @method('PUT')
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModal">Edit TPV</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        {{-- Región (solo visible para administradores) --}}
                        @role('Administrator')
                            <div class="mb-3">
                                <x-input-label class="form-label" for="region_id{{ $tpv->id }}" :value="__('REGION')" />
                                <select class="form-control" id="region_id{{ $tpv->id }}" name="region_id"
                                    aria-label="Default select example">
                                    @foreach ($regions as $region)
                                        <option value="{{ $region->id }}">{{ $region->name }}</option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('region_id')" class="mt-2" />
                            </div>
                        @else
                            @if ($userRegions->count() > 1)
                                <!-- Si el usuario tiene múltiples regiones, muestra un campo de selección -->
                                <div class="mb-3">
                                    <x-input-label class="form-label" for="region_id{{ $tpv->id }}"
                                        :value="__('REGION')" />
                                    <select class="form-control" id="region_id{{ $tpv->id }}" name="region_id"
                                        aria-label="Default select example">
                                        @foreach ($userRegions as $region)
                                            <option value="{{ $region->id }}">{{ $region->name }}</option>
                                        @endforeach
                                    </select>
                                    <x-input-error :messages="$errors->get('region_id')" class="mt-2" />
                                </div>
                            @else
                                <!-- Si el usuario tiene solo una región, asigna automáticamente esa región -->
                                <input type="hidden" name="region_id" value="{{ $userRegions->first()->id }}">
                            @endif
                        @endrole

                        <!-- Area -->
                        <div class="mb-3">
                            <x-input-label class="form-label" for="area{{ $tpv->id }}" :value="__('Area')" />
                            <div class="input-group input-group-merge">
                                <select class="form-control" name="area" id="area">
                                    <option value="{{ $tpv->area }}">{{ $tpv->area }}</option>
                                    <option value="BAR">BAR</option>
                                    <option value="COCINA CALIENTE">COCINA CALIENTE</option>
                                    <option value="COCINA FRIA">COCINA FRIA</option>
                                    <option value="PASTELERIA">PASTELERIA</option>
                                    <option value="TOTEM CLIENTES">TOTEM CLIENTES</option>
                                </select>
                            </div>
                            <x-input-error :messages="$errors->get('area')" class="mt-2" />
                        </div>

                        <!-- hotel -->
                        <div class="mb-3">
                            <x-input-label class="form-label" for="hotel_id{{ $tpv->id }}" :value="__('Hotel')" />
                            <select class="form-control" id="hotel_id{{ $tpv->id }}" name="hotel_id">
                                <option value="">Seleccione un hotel</option>
                                @foreach ($hoteles as $hotel)
                                    <option value="{{ $hotel->id }}"
                                        {{ $hotel->id == $tpv->hotel_id ? 'selected' : '' }}>
                                        {{ $hotel->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <x-input-label class="form-label" for="departamento_id{{ $tpv->id }}"
                                :value="__('Department')" />
                            <select class="form-control" id="departamento_id{{ $tpv->id }}"
                                name="departamento_id">
                                <option value="">Seleccione un departamento</option>
                                <!-- Los departamentos se cargarán dinámicamente aquí -->
                            </select>
                        </div>

                        <!-- equipment -->
                        <div class="mb-3">
                            <x-input-label class="form-label" for="equipment{{ $tpv->id }}" :value="__('equipment')" />
                            <div class="input-group input-group-merge">
                                <x-text-input id="equipment{{ $tpv->id }}" class="form-control" type="text"
                                    name="equipment" required value="{{ $tpv->equipment }}" />
                            </div>
                            <x-input-error :messages="$errors->get('equipment')" class="mt-2" />
                        </div>

                        <!-- brand -->
                        <div class="mb-3">
                            <x-input-label class="form-label" for="brand{{ $tpv->id }}" :value="__('Brand')" />
                            <div class="input-group input-group-merge">
                                <x-text-input id="brand{{ $tpv->id }}" class="form-control" type="text"
                                    name="brand" value="{{ $tpv->brand }}" required />
                            </div>
                            <x-input-error :messages="$errors->get('brand')" class="mt-2" />
                        </div>

                        <!-- Model -->
                        <div class="mb-3">
                            <x-input-label class="form-label" for="model{{ $tpv->id }}" :value="__('Model')" />
                            <div class="input-group input-group-merge">
                                <x-text-input id="model{{ $tpv->id }}" class="form-control" type="text"
                                    name="model" value="{{ $tpv->model }}" required />
                            </div>
                            <x-input-error :messages="$errors->get('model')" class="mt-2" />
                        </div>

                        <!-- Nombre -->
                        <div class="mb-3">
                            <x-input-label class="form-label" for="no_serial{{ $tpv->id }}" :value="__('Serial number')" />
                            <div class="input-group input-group-merge">
                                <x-text-input id="no_serial{{ $tpv->id }}" class="form-control" type="text"
                                    name="no_serial" value="{{ $tpv->no_serial }}" required />
                            </div>
                            <x-input-error :messages="$errors->get('no_serial')" class="mt-2" />
                        </div>

                        <!-- Nombre -->
                        <div class="mb-3">
                            <x-input-label class="form-label" for="name{{ $tpv->id }}" :value="__('Name')" />
                            <div class="input-group input-group-merge">
                                <x-text-input id="name{{ $tpv->id }}" class="form-control" type="text"
                                    name="name" value="{{ $tpv->name }}" required />
                            </div>
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <!-- ip -->
                        <div class="mb-3">
                            <x-input-label class="form-label" for="ip{{ $tpv->id }}" :value="__('IP')" />
                            <div class="input-group input-group-merge">
                                <x-text-input id="ip{{ $tpv->id }}" class="form-control" type="text"
                                    name="ip" value="{{ $tpv->ip }}" required />
                            </div>
                            <x-input-error :messages="$errors->get('ip')" class="mt-2" />
                        </div>

                        <!-- Link -->
                        <div class="mb-3">
                            <x-input-label class="form-label" for="link{{ $tpv->id }}" :value="__('LINK')" />
                            <div class="input-group input-group-merge">
                                <x-text-input id="link{{ $tpv->id }}" class="form-control" type="text"
                                    name="link" value="{{ $tpv->link }}" required />
                            </div>
                            <x-input-error :messages="$errors->get('link')" class="mt-2" />
                        </div>

                        <!-- lease -->
                        <div class="mb-3">
                            <x-input-label class="form-label" for="lease" :value="__('Is it lease?')" />
                            <div class="col-md">
                                <div class="form-check form-check-inline mt-3">
                                    <input class="form-check-input" type="radio" name="lease" id="lease_si"
                                        value="1" {{ $tpv->lease ? 'checked' : '' }} />
                                    <label class="form-check-label" for="lease_si">Yes</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="lease" id="lease_no"
                                        value="0" {{ !$tpv->lease ? 'checked' : '' }} />
                                    <label class="form-check-label" for="lease_no">No</label>
                                </div>
                            </div>
                            <x-input-error :messages="$errors->get('lease')" class="mt-2" />
                        </div>

                        <!-- Campos adicionales para arrendamiento -->
                        <div id="lease_fields_edit" style="display: {{ $tpv->lease ? 'block' : 'none' }};">
                            <div class="mb-3">
                                <x-input-label class="form-label" for="lease_id" :value="__('LEASE')" />
                                <select class="form-control" id="lease_id" name="lease_id"
                                    aria-label="Default select example">
                                    <option value="">Choose a lease</option>
                                    @foreach ($leases as $lease)
                                        <option value="{{ $lease->id }}"
                                            {{ $tpv->lease_id == $lease->id ? 'selected' : '' }}>
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
@endforeach

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

<script>
    $(document).ready(function() {
        function loadDepartamentos(hotelId, selectedDepartamentoId = null, tpvId) {
            var departamentoSelect = $('#departamento_id' + tpvId);

            if (hotelId) {
                // Realizar la petición AJAX para obtener los departamentos del hotel seleccionado
                $.ajax({
                    url: '/get-departments',
                    type: 'GET',
                    data: {
                        hotel_id: hotelId
                    },
                    success: function(data) {
                        departamentoSelect.empty();
                        departamentoSelect.append(
                            '<option value="">Seleccione un departamento</option>');
                        $.each(data, function(index, departamento) {
                            var selected = departamento.id == selectedDepartamentoId ?
                                'selected' : '';
                            departamentoSelect.append('<option value="' + departamento.id +
                                '" ' + selected + '>' + departamento.name + '</option>');
                        });
                    },
                    error: function() {
                        console.error('Error al cargar los departamentos.');
                    }
                });
            } else {
                departamentoSelect.empty();
                departamentoSelect.append('<option value="">Seleccione un departamento</option>');
            }
        }

        // Evento para cambiar de hotel
        $(document).on('change', '[id^=hotel_id]', function() {
            var hotelId = $(this).val();
            var tpvId = $(this).attr('id').replace('hotel_id', '');
            loadDepartamentos(hotelId, null, tpvId); // Cargar departamentos sin seleccionar ninguno
        });

        // Evento al abrir el modal
        $('[id^=editModal]').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget); // Botón que abrió el modal
            var modal = $(this);
            var tpvId = modal.attr('id').replace('editModal', '');
            var hotelId = button.data('hotel-id'); // Obtener hotel_id del botón
            var departamentoId = button.data('departamento-id'); // Obtener departamento_id del botón

            // Establecer el valor del hotel en el select
            modal.find('#hotel_id' + tpvId).val(hotelId);

            // Cargar departamentos con el seleccionado
            loadDepartamentos(hotelId, departamentoId, tpvId);
        });
    });
</script>
