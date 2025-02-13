<!-- Modales de Edición -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModal">Edit employee</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editForm" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- Region -->
                    {{-- Región (solo visible para administradores) --}}
                    @role('Administrator')
                        <div class="mb-3">
                            <x-input-label class="form-label" for="region_id" :value="__('REGION')" />
                            <select class="form-control" id="region_id" name="region_id"
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
                                <x-input-label class="form-label" for="region_id" :value="__('REGION')" />
                                <select class="form-control" id="region_id" name="region_id"
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

                    <!-- No. Empleado -->
                    <div class="mb-3">
                        <x-input-label class="form-label" for="no_empleado" :value="__('Employee number')" />
                        <div class="input-group input-group-merge">
                            <x-text-input id="empleado" class="form-control" type="text" name="no_empleado"
                                placeholder="3004568" required />
                        </div>
                        <x-input-error :messages="$errors->get('no_empleado')" class="mt-2" />
                    </div>

                    <!-- Nombre -->
                    <div class="mb-3">
                        <x-input-label class="form-label" for="name" :value="__('Name')" />
                        <div class="input-group input-group-merge">
                            <x-text-input id="nombre" class="form-control" type="text" name="name"
                                placeholder="Auixchik Mutula" required />
                        </div>
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <!-- Email -->
                    <div class="mb-3">
                        <x-input-label class="form-label" for="email" :value="__('Email')" />
                        <div class="input-group input-group-merge">
                            <x-text-input id="correo" class="form-control" type="email" name="email"
                                placeholder="ejemplo@correo.com" required autocomplete="email" />
                        </div>
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <!-- Puesto -->
                    <div class="mb-3">
                        <x-input-label class="form-label" for="puesto" :value="__('JOB POSITION')" />
                        <div class="input-group input-group-merge">
                            <x-text-input id="job" class="form-control" type="text" name="puesto"
                                placeholder="Soporte IT" required autocomplete="puesto" />
                        </div>
                        <x-input-error :messages="$errors->get('puesto')" class="mt-2" />
                    </div>

                    <!-- hotel -->
                    <div class="mb-3">
                        <x-input-label class="form-label" for="hotel_id" :value="__('HOTEL')" />
                        <select class="form-control" id="hotel_id" name="hotel_id">
                            <option value="">Seleccione un hotel</option>
                            @foreach ($hoteles as $hotel)
                                <option value="{{ $hotel->id }}">{{ $hotel->name }}</option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('hotel_id')" class="mt-2" />
                    </div>

                    <!-- department -->
                    <div class="mb-3">
                        <x-input-label class="form-label" for="departamento_id" :value="__('DEPARTMENTS')" />
                        <select class="form-control" id="departamento_id" name="departamento_id">
                            <option value="">Seleccione un departamento</option>
                        </select>
                        <x-input-error :messages="$errors->get('departamento_id')" class="mt-2" />
                    </div>

                    <!-- AD -->
                    <div class="mb-3">
                        <x-input-label class="form-label" for="ad" :value="__('AD')" />
                        <div class="input-group input-group-merge">
                            <x-text-input id="adi" class="form-control" type="text" name="ad"
                                placeholder="Soporte IT" required autocomplete="ad" />
                        </div>
                        <x-input-error :messages="$errors->get('ad')" class="mt-2" />
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Actualizar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // Función para cargar departamentos
        function cargarDepartamentos(hotelId, departamentoSeleccionado = null) {
            var departamentoSelect = $('#departamento_id');

            if (hotelId) {
                $.ajax({
                    url: '/get-departamentos',
                    type: 'GET',
                    data: {
                        hotel_id: hotelId
                    },
                    success: function(data) {
                        departamentoSelect.empty();
                        departamentoSelect.append(
                            '<option value="">Seleccione un departamento</option>');

                        $.each(data, function(index, departamento) {
                            var selected = (departamentoSeleccionado &&
                                    departamentoSeleccionado == departamento.id) ?
                                'selected' : '';
                            departamentoSelect.append('<option value="' + departamento.id +
                                '" ' + selected + '>' +
                                departamento.name + '</option>');
                        });
                    }
                });
            } else {
                departamentoSelect.empty();
                departamentoSelect.append('<option value="">Primero seleccione un hotel</option>');
            }
        }

        // Manejar click en botón editar
        $('.btn-edit').click(function() {
            var empleadoId = $(this).data('empleado-id');

            // Cargar datos del empleado
            $.ajax({
                url: '/empleados/' + empleadoId + '/edit',
                type: 'GET',
                success: function(data) {
                    $('#editForm').attr('action', '/empleados/' + empleadoId);
                    $('#nombre').val(data.empleado.name);
                    $('#empleado').val(data.empleado.no_empleado);
                    $('#correo').val(data.empleado.email);
                    $('#job').val(data.empleado.puesto);
                    $('#hotel_id').val(data.empleado.hotel_id);
                    $('#adi').val(data.empleado.ad);
                    $('#region').val(data.empleado.region_id);

                    // Cargar departamentos del hotel y seleccionar el actual
                    cargarDepartamentos(data.empleado.hotel_id, data.empleado
                        .departamento_id);
                }
            });
        });

        // Manejar cambio de hotel
        $('#hotel_id').change(function() {
            var hotelId = $(this).val();
            cargarDepartamentos(hotelId);
        });

        // Manejar guardado de cambios
        $('#saveChanges').click(function() {
            var form = $('#editForm');
            $.ajax({
                url: form.attr('action'),
                type: 'POST',
                data: form.serialize(),
                success: function(response) {
                    $('#editModal').modal('hide');
                    // Recargar la página o actualizar la fila en la tabla
                    window.location.reload();
                },
                error: function(xhr) {
                    // Manejar errores
                    alert('Error al guardar los cambios');
                }
            });
        });
    });
</script>
