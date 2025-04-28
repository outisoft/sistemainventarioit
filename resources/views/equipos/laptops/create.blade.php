<!--Modal create-->
<div class="modal fade" id="modalCreate" tabindex="-1" role="dialog" aria-labelledby="modalCreate">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <form method="POST" action="{{ route('laptops.store') }}">
                @csrf
                <div class="modal-header">
                    <h4 class="modal-title" id="modalCreate">Laptop</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true"></span></button>
                </div>

                <div class="modal-body">
                    <!-- Region -->
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
                    <!-- Tipo -->
                    <div class="mb-3" style="display: none;">
                        <x-input-label class="form-label" for="tipo_id" :value="__('Tipo de equipo')" />
                        <div class="input-group input-group-merge">
                            <x-text-input readonly='readonly' id="tipo_id" class="form-control" type="text"
                                name="tipo_id" placeholder="Laptop" :value="4" required autocomplete="tipo_id" />
                        </div>
                        <x-input-error :messages="$errors->get('marca')" class="mt-2" />
                    </div>

                    <!-- Marca -->
                    <div class="mb-3">
                        <x-input-label class="form-label" for="marca" :value="__('BRAND')" />
                        <div class="input-group input-group-merge">
                            <x-text-input id="marca" class="form-control" type="text" name="marca"
                                placeholder="HP" :value="old('marca')" required autocomplete="marca" />
                        </div>
                        <x-input-error :messages="$errors->get('marca')" class="mt-2" />
                    </div>

                    <!-- Model -->
                    <div class="mb-3">
                        <x-input-label class="form-label" for="model" :value="__('MODEL')" />
                        <div class="input-group input-group-merge">
                            <x-text-input id="model" class="form-control" type="text" name="model"
                                placeholder="SmartBook" :value="old('model')" required autocomplete="model" />
                        </div>
                        <x-input-error :messages="$errors->get('model')" class="mt-2" />
                    </div>

                    <!-- Numero de serie -->
                    <div class="mb-3">
                        <x-input-label class="form-label" for="serial" :value="__('SERIAL NUMBER')" />
                        <div class="input-group input-group-merge">
                            <x-text-input id="serial" class="form-control" type="text" name="serial"
                                placeholder="R5BDI87D80" :value="old('serial')" required autocomplete="serial" />
                        </div>
                        <x-input-error :messages="$errors->get('serial')" class="mt-2" />
                    </div>

                    <!-- NOMBRE DE EQUIPO -->
                    <div class="mb-3">
                        <x-input-label class="form-label" for="name" :value="__('EQUIPMENTS NAME')" />
                        <div class="input-group input-group-merge">
                            <x-text-input id="name" class="form-control" type="text" name="name"
                                placeholder="TULSIS001" :value="old('name')" required autocomplete="name" />
                        </div>
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <!-- IP DE EQUIPO -->
                    <div class="mb-3">
                        <x-input-label class="form-label" for="ip" :value="__('IP')" />
                        <div class="input-group input-group-merge">
                            <x-text-input id="ip" class="form-control" type="text" name="ip"
                                placeholder="10.1.35.48" :value="old('ip')" required autocomplete="ip" />
                        </div>
                        <x-input-error :messages="$errors->get('ip')" class="mt-2" />
                    </div>

                    <!-- SO -->
                    <div class="mb-3">
                        <x-input-label class="form-label" for="so" :value="__('OPERATING SYSTEM')" />
                        <div class="input-group input-group-merge">
                            <x-text-input id="so" class="form-control" type="text" name="so"
                                placeholder="Windows 10" :value="old('so')" required autocomplete="so" />
                        </div>
                        <x-input-error :messages="$errors->get('so')" class="mt-2" />
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

                    <!-- af_code -->
                    <div id="af_field" style="display">
                        <div class="mb-3">
                            <x-input-label class="form-label" for="af_code" :value="__('Fixed Asset Code')" />
                            <div class="input-group input-group-merge">
                                <x-text-input id="af_code" class="form-control" type="text" name="af_code"
                                    placeholder="0X0X0X1" :value="old('af_code')" required autocomplete="af_code" />
                            </div>
                            <x-input-error :messages="$errors->get('af_code')" class="mt-2" />
                        </div>
                    </div>

                    <!-- Campos adicionales para arrendamiento -->
                    <div id="lease_fields" style="display: none;">
                        <div class="mb-3">
                            <x-input-label class="form-label" for="lease_id" :value="__('LEASE')" />
                            <select class="form-control" id="lease_id" name="lease_id" required>
                                <option value="">Choose a lease</option>
                                @foreach ($leases as $lease)
                                    <option value="{{ $lease->id }}"
                                        {{ old('lease_id') == $lease->id ? 'selected' : '' }}>
                                        {{ $lease->lease }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('lease_id')" class="mt-2" />
                        </div>
                    </div>

                    <!-- Agregar complemento -->
                    <div class="mb-3">
                        <x-input-label class="form-label" for="add_complement" :value="__('Add Complement?')" />
                        <div class="col-md">
                            <div class="form-check form-check-inline mt-3">
                                <input class="form-check-input" type="radio" name="add_complement" id="add_complement_yes" value="1" />
                                <label class="form-check-label" for="add_complement_yes">Yes</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="add_complement" id="add_complement_no" value="0" checked />
                                <label class="form-check-label" for="add_complement_no">No</label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" id="nextButton" class="btn btn-primary">Next</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="modalComplement" tabindex="-1" role="dialog" aria-labelledby="modalComplement">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modalComplement">Complement</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true"></span></button>
            </div>
            <div class="modal-body">
                <!-- Tipo -->
                <div class="mb-3">
                        <x-input-label class="form-label" for="type_id" :value="__('Type equipment')" />
                        <select class="form-control" id="type_id" name="type_id" required>
                            <option value="">Choose a type</option>
                            @foreach ($complements as $tipo)
                                <option value="{{ $tipo->id }}" {{ old('type_id') == $tipo->id ? 'selected' : '' }}>
                                    {{ $tipo->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Marca -->
                    <div class="mb-3">
                        <x-input-label class="form-label" for="brand" :value="__('Brand')" />
                        <div class="input-group input-group-merge">
                            <x-text-input id="brand_c" class="form-control" type="text" name="brand"
                                placeholder="HP" :value="old('brand')" required autocomplete="brand" />
                        </div>
                        <x-input-error :messages="$errors->get('brand')" class="mt-2" />
                    </div>

                    <!-- Model -->
                    <div class="mb-3">
                        <x-input-label class="form-label" for="model" :value="__('Model')" />
                        <div class="input-group input-group-merge">
                            <x-text-input id="model_c" class="form-control" type="text" name="model"
                                placeholder="Lazer MFP 432fdm" :value="old('model')" required autocomplete="model" />
                        </div>
                        <x-input-error :messages="$errors->get('model')" class="mt-2" />
                    </div>

                    <!-- Numero de serie -->
                    <div class="mb-3">
                        <x-input-label class="form-label" for="serial" :value="__('Serial number / CT')" />
                        <div class="input-group input-group-merge">
                            <x-text-input id="serial_c" class="form-control" type="text" name="serial"
                                placeholder="CNB1P50T0" :value="old('serial')" required autocomplete="serial" />
                        </div>
                        <x-input-error :messages="$errors->get('serial')" class="mt-2" />
                    </div>
                    <!-- lease? -->
                    <div class="mb-3">
                        <x-input-label class="form-label" for="lease_c" :value="__('Is it lease?')" />
                        <div class="col-md">
                            <div class="form-check form-check-inline mt-3">
                                <input class="form-check-input" type="radio" name="lease" id="lease_c"
                                    value="1" />
                                <label class="form-check-label" for="lease_c">Yes</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="lease" id="lease_c"
                                    value="0"checked />
                                <label class="form-check-label" for="lease_c">No</label>
                            </div>
                        </div>
                        <x-input-error :messages="$errors->get('lease')" class="mt-2" />
                    </div>

                    <!-- af_code -->
                    <div id="af_field_c" style="display: none;">
                        <div class="mb-3">
                            <x-input-label class="form-label" for="af_code" :value="__('Fixed Asset Code')" />
                            <div class="input-group input-group-merge">
                                <x-text-input id="af_code_c" class="form-control" type="text" name="af_code"
                                    placeholder="0X0X0X1" :value="old('af_code')" autocomplete="af_code" />
                            </div>
                            <x-input-error :messages="$errors->get('af_code')" class="mt-2" />
                        </div>
                    </div>

                    <!-- Campos adicionales para arrendamiento -->
                    <div id="lease_fields_c" style="display: none;">
                        <div class="mb-3">
                            <x-input-label class="form-label" for="lease_id" :value="__('LEASE')" />
                            <select class="form-control" id="lease_id_c" name="lease_id" required>
                                <option value="">Choose a lease</option>
                                @foreach ($leases as $lease)
                                    <option value="{{ $lease->id }}"
                                        {{ old('lease_id') == $lease->id ? 'selected' : '' }}>
                                        {{ $lease->lease }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('lease_id')" class="mt-2" />
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" id="addComplementButton" class="btn btn-secondary">Add Complement</button>
                <button type="button" id="finishButton" class="btn btn-primary" data-bs-dismiss="modal">Finish</button>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('input[name="lease"]').on('change', function() {
            if ($('#lease').is(':checked')) {
                $('#lease_fields').show();
                $('#lease_id').attr('required', true);
                $('#af_field').hide();
            } else {
                $('#lease_fields').hide();
                $('#lease_id').removeAttr('required');
                $('#af_field').show();
            }
        });

        // Trigger change event on page load to set initial state
        $('input[name="lease"]:checked').trigger('change');
    });
</script>
<script>
    $(document).ready(function() {
        $('input[name="lease_c"]').on('change', function() {
            if ($('#lease_c').is(':checked')) {
                $('#lease_fields_c').show();
                $('#lease_id_c').attr('required', true);
                $('#af_field_c').hide();
            } else {
                $('#lease_fields_c').hide();
                $('#lease_id_c').removeAttr('required');
                $('#af_field_c').show();
            }
        });

        // Trigger change event on page load to set initial state
        $('input[name="lease_c"]:checked').trigger('change');
    });
</script>
<script>
    document.getElementById('type_id').addEventListener('change', function() {
        var afCodeDiv = document.getElementById('af_field_c');
        if (this.options[this.selectedIndex].text === 'MONITOR') {
            afCodeDiv.style.display = 'block';
        } else {
            afCodeDiv.style.display = 'none';
        }
    });

    // Trigger change event on page load to handle pre-selected value
    document.getElementById('type_id').dispatchEvent(new Event('change'));
</script>
<script>
    $(document).ready(function() {
        let complements = [];

        // Cambiar el texto del botón dinámicamente según la selección
        $('input[name="add_complement"]').on('change', function() {
            if ($(this).val() == "1") {
                $('#nextButton').text('Next');
            } else {
                $('#nextButton').text('Save');
            }
        });

        $('#nextButton').on('click', function() {
            if ($('input[name="add_complement"]:checked').val() == "1") {
                // Si el usuario selecciona "Sí", mostrar el modal de complementos
                $('#modalCreate').modal('hide');
                $('#modalComplement').modal('show');
            } else {
                // Si el usuario selecciona "No", enviar el formulario directamente
                $('form').submit();
            }
        });

        $('#addComplementButton').on('click', function() {
            // Obtener los datos del complemento desde el modal
            const complement = {
                type_id: $('#type_id').val(),
                brand: $('#brand_c').val(),
                model: $('#model_c').val(),
                serial: $('#serial_c').val(),
                lease: $('input[name="lease_c"]:checked').val(),
                af_code: $('#af_code_c').val(),
                lease_id: $('#lease_id_c').val()
            };

            // Validar que los campos requeridos del complemento estén llenos
            if (!complement.type_id || !complement.brand || !complement.model || !complement.serial) {
                alert('Please fill in all required fields for the complement.');
                return;
            }

            // Agregar el complemento al array
            complements.push(complement);

            // Limpiar los campos del modal de complementos
            $('#type_id').val('');
            $('#brand_c').val('');
            $('#model_c').val('');
            $('#serial_c').val('');
            $('input[name="lease_c"][value="0"]').prop('checked', true);
            $('#af_code_c').val('');
            $('#lease_id_c').val('');

            alert('Complement added successfully!');
        });

        $('#finishButton').on('click', function() {
            // Verificar si hay datos en los campos del modal y no se presionó "Add Complement"
            const complement = {
                type_id: $('#type_id').val(),
                brand: $('#brand_c').val(),
                model: $('#model_c').val(),
                serial: $('#serial_c').val(),
                lease: $('input[name="lease_c"]:checked').val(),
                af_code: $('#af_code_c').val(),
                lease_id: $('#lease_id_c').val()
            };

            if (complement.type_id || complement.brand || complement.model || complement.serial) {
                // Validar que los campos requeridos del complemento estén llenos
                if (!complement.type_id || !complement.brand || !complement.model || !complement.serial) {
                    alert('Please fill in all required fields for the complement.');
                    return;
                }

                // Agregar el complemento al array
                complements.push(complement);
            }

            // Agregar los complementos al formulario como campos ocultos
            complements.forEach((complement, index) => {
                Object.keys(complement).forEach(key => {
                    $('<input>').attr({
                        type: 'hidden',
                        name: `complements[${index}][${key}]`,
                        value: complement[key]
                    }).appendTo('form');
                });
            });

            // Enviar el formulario
            $('form').submit();
        });

        // Configurar el estado inicial del botón al cargar la página
        $('input[name="add_complement"]:checked').trigger('change');
    });
</script>
