<!--Modal create-->
<div class="col-lg-4 col-md-6">
    <form method="POST" action="{{ route('employees.store') }}">
        @csrf
        <div class="mt-3">
            <div class="modal fade" id="modalCreate" aria-labelledby="modalCreate" tabindex="-1" style="display: none"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="modalCreate">New employee</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><span
                                    aria-hidden="true"></span></button>
                        </div>

                        <div class="modal-body">
                            {{-- SECCIÓN DE DATOS DEL EMPLEADO (Siempre visible) --}}
                            <h4 class="modal-title">Datos Personales</h4>
                            <hr>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="no_employee" class="form-label">Número de Empleado</label>
                                    <input type="text" name="no_employee" id="no_employee" class="form-control @error('no_employee') is-invalid @enderror" value="{{ old('no_employee') }}" required>
                                    @error('no_employee') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="name" class="form-label">Nombre Completo</label>
                                    <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required>
                                    @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                            </div>
                            @role('Administrator')
                                <div class="mb-3">
                                    <x-input-label class="form-label" for="region_id" :value="__('REGION')" />
                                    <select class="form-select" id="region_id" name="region_id" required>
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
                            @endif

                            {{-- SECCIÓN DE DATOS DEL PUESTO --}}
                            <h4 class="modal-title">Información del Puesto</h4>
                            <hr>

                            {{-- RADIO BUTTONS PARA ELEGIR --}}
                            <div class="mb-3">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="position_choice" id="choice_new" value="new" {{ old('position_choice', 'new') == 'new' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="choice_new">Crear Puesto Nuevo</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="position_choice" id="choice_existing" value="existing" {{ old('position_choice') == 'existing' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="choice_existing">Usar Puesto Existente (sin asignar)</label>
                                </div>
                            </div>

                            {{-- FORMULARIO PARA PUESTO EXISTENTE (Inicialmente oculto) --}}
                            <div id="existing_position_fields">
                                <div class="mb-3">
                                    <label for="position_id_existing" class="form-label">Seleccionar Puesto</label>
                                    <select name="position_id_existing" id="position_id_existing" class="form-select @error('position_id_existing') is-invalid @enderror">
                                        <option value="" disabled selected>Seleccione un puesto disponible...</option>
                                        @foreach($unassignedPositions as $position)
                                            <option value="{{ $position->id }}" {{ old('position_id_existing') == $position->id ? 'selected' : '' }}>
                                                {{ $position->position }} - ({{ $position->email }}) - [{{ $position->region->name ?? 'N/A' }}]
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('position_id_existing') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                            </div>
                            
                            {{-- FORMULARIO PARA PUESTO NUEVO (Inicialmente visible) --}}
                            <div id="new_position_fields">
                                {{-- Aquí va el formulario de creación de puesto que ya tenías --}}
                                <div class="mb-3">
                                    <label for="puesto" class="form-label">Nombre del Puesto</label>
                                    <input type="text" name="puesto" id="puesto" class="form-control @error('puesto') is-invalid @enderror" value="{{ old('puesto') }}">
                                    @error('puesto') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}">
                                        @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label for="ad" class="form-label">Usuario Active Directory (AD)</label>
                                        <input type="text" name="ad" id="ad" class="form-control @error('ad') is-invalid @enderror" value="{{ old('ad') }}">
                                        @error('ad') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="hotel_id" class="form-label">Hotel</label>
                                        <select name="hotel_id" id="hotels_id" class="form-select @error('hotel_id') is-invalid @enderror">
                                            <option value="" disabled selected>Seleccione un hotel...</option>
                                            @foreach($hotels as $hotel)
                                                <option value="{{ $hotel->id }}" {{ old('hotel_id') == $hotel->id ? 'selected' : '' }}>{{ $hotel->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('hotel_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <x-input-label class="form-label" for="department_id" :value="__('DEPARTMENTS')" />
                                        <select name="departamento_id" id="department_id" class="form-select @error('departamento_id') is-invalid @enderror" disabled>
                                            <option value="" disabled selected>Seleccione un depto...</option>
                                            
                                        </select>
                                        @error('departamento_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const choiceNew = document.getElementById('choice_new');
        const choiceExisting = document.getElementById('choice_existing');
        const newPositionFields = document.getElementById('new_position_fields');
        const existingPositionFields = document.getElementById('existing_position_fields');

        function togglePositionFields() {
            if (choiceNew.checked) {
                newPositionFields.style.display = 'block';
                existingPositionFields.style.display = 'none';
            } else {
                newPositionFields.style.display = 'none';
                existingPositionFields.style.display = 'block';
            }
        }

        // Ejecutar al cargar la página para manejar el estado 'old()' en caso de error de validación
        togglePositionFields();

        // Añadir listeners para los cambios
        choiceNew.addEventListener('change', togglePositionFields);
        choiceExisting.addEventListener('change', togglePositionFields);
    });
</script>

<script>
    $(document).ready(function() {
        $('#hotels_id').change(function() {
            var hotelId = $(this).val();
            var departamentoSelect = $('#department_id');

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
                            '<option value="">Choose a department</option>');

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
                departamentoSelect.append('<option value="">First select a hotel</option>');
            }
        });
    });
</script>
@endpush
