<!--Modal create-->
<div class="modal fade" id="modalCreate" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="POST" action="{{ route('tpvs.store') }}">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="modalToggleLabel">New Tpv</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true"></span></button>
                </div>
                <div class="modal-body">
                    <!-- Region -->
                    {{-- Región (solo visible para administradores) --}}
                    @role('Administrator')
                        <div class="mb-3">
                            <x-input-label class="form-label" for="region_id" :value="__('REGION')" />
                            <select class="form-control" id="region_id" name="region_id" required>
                                <option value="">Choose a region</option>
                                @foreach ($regions as $region)
                                    <option value="{{ $region->id }}"
                                        {{ old('region_id') == $region->id ? 'selected' : '' }}>
                                        {{ $region->name }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('region_id')" class="mt-2" />
                        </div>
                    @else
                        @if ($userRegions->count() > 1)
                            <!-- Si el usuario tiene múltiples regiones, muestra un campo de selección -->
                            <div class="mb-3">

                                <x-input-label class="form-label" for="region_id" :value="__('REGION')" />
                                <select name="region_id" id="region_id" class="form-control" required>
                                    @foreach ($userRegions as $region)
                                        <option value="{{ $region->id }}">{{ $region->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        @else
                            <!-- Si el usuario tiene solo una región, asigna automáticamente esa región -->
                            <input type="hidden" name="region_id" value="{{ $userRegions->first()->id }}">
                        @endif
                    @endrole

                    <!-- Area -->
                    <div class="mb-3">
                        <x-input-label class="form-label" for="area" :value="__('Area')" />
                        <select class="form-control" name="area" id="area">
                            <option value="BAR">BAR</option>
                            <option value="COCINA CALIENTE">COCINA CALIENTE</option>
                            <option value="COCINA FRIA">COCINA FRIA</option>
                            <option value="PASTELERIA">PASTELERIA</option>
                        </select>
                        <x-input-error :messages="$errors->get('area')" class="mt-2" />
                    </div>

                    <div class="mb-3">
                        <x-input-label class="form-label" for="hotels_id" :value="__('Hotel')" />
                        <select class="form-control" id="hotels_id" name="hotel_id">
                            <option value="">Select hotel</option>
                            @foreach ($hoteles as $hotel)
                                <option value="{{ $hotel->id }}">{{ $hotel->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <x-input-label class="form-label" for="departamentos_id" :value="__('Departments')" />
                        <select class="form-control" id="departamentos_id" name="departamento_id" disabled>
                            <option value="">The first select to hotel</option>
                        </select>
                    </div>

                    <!-- Equipo -->
                    <div class="mb-3">
                        <x-input-label class="form-label" for="equipment" :value="__('Equipment')" />
                        <div class="input-group input-group-merge">
                            <x-text-input id="equipment" class="form-control" type="text" name="equipment"
                                placeholder="AIO" :value="old('equipment')" required autocomplete="equipment" />
                        </div>
                        <x-input-error :messages="$errors->get('equipment')" class="mt-2" />
                    </div>

                    <!-- Marca -->
                    <div class="mb-3">
                        <x-input-label class="form-label" for="brand" :value="__('Brand')" />
                        <div class="input-group input-group-merge">
                            <x-text-input id="brand" class="form-control" type="text" name="brand"
                                placeholder="ELO TOUCH" :value="old('brand')" required autocomplete="brand" />
                        </div>
                        <x-input-error :messages="$errors->get('brand')" class="mt-2" />
                    </div>

                    <!-- Modelo -->
                    <div class="mb-3">
                        <x-input-label class="form-label" for="model" :value="__('Model')" />
                        <div class="input-group input-group-merge">
                            <x-text-input id="model" class="form-control" type="text" name="model"
                                placeholder="15E2-E" :value="old('model')" required autocomplete="model" />
                        </div>
                        <x-input-error :messages="$errors->get('model')" class="mt-2" />
                    </div>

                    <!-- Numero de serie -->
                    <div class="mb-3">
                        <x-input-label class="form-label" for="no_serial" :value="__('Serial number')" />
                        <div class="input-group input-group-merge">
                            <x-text-input id="no_serial" class="form-control" type="text" name="no_serial"
                                placeholder="L45EFGFF783" :value="old('no_serial')" required autocomplete="no_serial" />
                        </div>
                        <x-input-error :messages="$errors->get('no_serial')" class="mt-2" />
                    </div>

                    <!-- Nombre -->
                    <div class="mb-3">
                        <x-input-label class="form-label" for="name" :value="__('Name')" />
                        <div class="input-group input-group-merge">
                            <x-text-input id="name" class="form-control" type="text" name="name"
                                placeholder="RESTPV001" :value="old('name')" required autocomplete="name" />
                        </div>
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <!-- IP -->
                    <div class="mb-3">
                        <x-input-label class="form-label" for="ip" :value="__('IP')" />
                        <div class="input-group input-group-merge">
                            <x-text-input id="ip" class="form-control" type="text" name="ip"
                                placeholder="10.1.22.34" :value="old('ip')" required autocomplete="ip" />
                        </div>
                        <x-input-error :messages="$errors->get('ip')" class="mt-2" />
                    </div>

                    <!-- Link -->
                    <div class="mb-3">
                        <x-input-label class="form-label" for="link" :value="__('Link')" />
                        <div class="input-group input-group-merge">
                            <x-text-input id="link" class="form-control" type="text" name="link"
                                placeholder="https://tpvbp.grupo-pinero.com/" :value="old('link')" required
                                autocomplete="link" />
                        </div>
                        <x-input-error :messages="$errors->get('link')" class="mt-2" />
                    </div>
                    <!-- lease? -->
                    <div class="mb-3">
                        <x-input-label class="form-label" for="lease" :value="__('Is it lease?')" />
                        <div class="col-md">
                            <div class="form-check form-check-inline mt-3">
                                <input class="form-check-input" type="radio" name="lease" id="lease"
                                    value="1" />
                                <label class="form-check-label" for="lease">Yes</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="lease" id="lease"
                                    value="0"checked />
                                <label class="form-check-label" for="lease">No</label>
                            </div>
                        </div>
                        <x-input-error :messages="$errors->get('lease')" class="mt-2" />
                    </div>

                    <!-- Campos adicionales para arrendamiento -->
                    <div id="lease_fields" style="display: none;">
                        <div class="mb-3">
                            <x-input-label class="form-label" for="code" :value="__('Lease Code')" />
                            <input type="text" class="form-control" id="code" name="code">
                            <x-input-error :messages="$errors->get('code')" class="mt-2" />
                        </div>
                        <div class="mb-3">
                            <x-input-label class="form-label" for="date" :value="__('Contract End Date')" />
                            <input type="date" class="form-control" id="date" name="date">
                            <x-input-error :messages="$errors->get('date')" class="mt-2" />
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#hotels_id').change(function() {
            var hotelId = $(this).val();
            var departamentoSelect = $('#departamentos_id');

            if (hotelId) {
                // Habilitar el select de departamentos
                departamentoSelect.prop('disabled', false);

                // Realizar la petición AJAX
                $.ajax({
                    url: '/get-departamentos',
                    type: 'GET',
                    data: {
                        hotel_id: hotelId
                    },
                    success: function(data) {
                        departamentoSelect.empty();
                        departamentoSelect.append(
                            '<option value="">Select department</option>');

                        $.each(data, function(index, departamento) {
                            departamentoSelect.append('<option value="' +
                                departamento.id + '">' + departamento.name +
                                '</option>');
                        });
                    }
                });
            } else {
                // Si no hay hotel seleccionado, deshabilitar y limpiar el select de departamentos
                departamentoSelect.prop('disabled', true);
                departamentoSelect.empty();
                departamentoSelect.append('<option value="">Firts select hotel</option>');
            }
        });
    });
</script>
<script>
    $(document).ready(function() {
        $('input[name="lease"]').on('change', function() {
            if ($('#lease').is(':checked')) {
                $('#lease_fields').show();
                $('#code').attr('required', true);
                $('#date').attr('required', true);
            } else {
                $('#lease_fields').hide();
                $('#code').removeAttr('required');
                $('#date').removeAttr('required');
            }
        });

        // Trigger change event on page load to set initial state
        $('input[name="lease"]:checked').trigger('change');
    });
</script>
