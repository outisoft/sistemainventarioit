<!-- Modales de Edición -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModal">Editar TPV</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editForm" method="POST">
                        @csrf
                        @method('PUT')

                        <!-- Area -->
                        <div class="mb-3">
                            <x-input-label class="form-label" for="area" :value="__('Area')" />
                            <div class="input-group input-group-merge">
                                <x-text-input id="aread" class="form-control" type="text"
                                    name="area" placeholder="COCINA CALIENTE" required/>
                            </div>
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <!-- hotel -->
                        <div class="mb-3">
                            <label for="hotel_id" class="form-label">Hotel</label>
                            <select class="form-control" id="hotel_id" name="hotel_id">
                                <option value="">Seleccione un hotel</option>
                                @foreach($hoteles as $hotel)
                                    <option value="{{ $hotel->id }}">{{ $hotel->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="departamento_id" class="form-label">Departamento</label>
                            <select class="form-control" id="departamento_id" name="departamento_id">
                                <option value="">Seleccione un departamento</option>
                            </select>
                        </div>

                        <!-- equipment -->
                        <div class="mb-3">
                            <x-input-label class="form-label" for="equipment" :value="__('Equipo')" />
                            <div class="input-group input-group-merge">
                                <x-text-input id="equipo" class="form-control" type="text"
                                    name="equipment" required/>
                            </div>
                            <x-input-error :messages="$errors->get('equipment')" class="mt-2" />
                        </div>

                        <!-- brand -->
                        <div class="mb-3">
                            <x-input-label class="form-label" for="brand" :value="__('Marca')" />
                            <div class="input-group input-group-merge">
                                <x-text-input id="marca" class="form-control" type="text"
                                    name="brand" required/>
                            </div>
                            <x-input-error :messages="$errors->get('brand')" class="mt-2" />
                        </div>

                        <!-- Model -->
                        <div class="mb-3">
                            <x-input-label class="form-label" for="model" :value="__('Modelo')" />
                            <div class="input-group input-group-merge">
                                <x-text-input id="modelo" class="form-control" type="text"
                                    name="model" required/>
                            </div>
                            <x-input-error :messages="$errors->get('model')" class="mt-2" />
                        </div>

                        <!-- Nombre -->
                        <div class="mb-3">
                            <x-input-label class="form-label" for="no_serial" :value="__('Numero de serie')" />
                            <div class="input-group input-group-merge">
                                <x-text-input id="serial" class="form-control" type="text"
                                    name="no_serial" required/>
                            </div>
                            <x-input-error :messages="$errors->get('no_serial')" class="mt-2" />
                        </div>

                        <!-- Nombre -->
                        <div class="mb-3">
                            <x-input-label class="form-label" for="name" :value="__('Nombre')" />
                            <div class="input-group input-group-merge">
                                <x-text-input id="nombre" class="form-control" type="text"
                                    name="name" required/>
                            </div>
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <!-- ip -->
                        <div class="mb-3">
                            <x-input-label class="form-label" for="ip" :value="__('IP')" />
                            <div class="input-group input-group-merge">
                                <x-text-input id="ips" class="form-control" type="text"
                                    name="ip" required/>
                            </div>
                            <x-input-error :messages="$errors->get('ip')" class="mt-2" />
                        </div>

                        <!-- Link -->
                        <div class="mb-3">
                            <x-input-label class="form-label" for="link" :value="__('LINK')" />
                            <div class="input-group input-group-merge">
                                <x-text-input id="links" class="form-control" type="text"
                                    name="link" required/>
                            </div>
                            <x-input-error :messages="$errors->get('link')" class="mt-2" />
                        </div>

                        <br>
                        <br>
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
                    data: { hotel_id: hotelId },
                    success: function(data) {
                        departamentoSelect.empty();
                        departamentoSelect.append('<option value="">Seleccione un departamento</option>');
                        
                        $.each(data, function(index, departamento) {
                            var selected = (departamentoSeleccionado && departamentoSeleccionado == departamento.id) ? 'selected' : '';
                            departamentoSelect.append('<option value="' + departamento.id + '" ' + selected + '>' + 
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
            var tpvId = $(this).data('tpv-id');
            
            // Cargar datos del empleado
            $.ajax({
                url: '/tpvs/' + tpvId + '/edit',
                type: 'GET',
                success: function(data) {
                    $('#editForm').attr('action', '/tpvs/' + tpvId);
                    $('#aread').val(data.tpv.area);
                    $('#hotel_id').val(data.tpv.hotel_id);
                    $('#equipo').val(data.tpv.equipment);
                    $('#marca').val(data.tpv.brand);
                    $('#modelo').val(data.tpv.model);
                    $('#serial').val(data.tpv.no_serial);
                    $('#nombre').val(data.tpv.name);
                    $('#ips').val(data.tpv.ip);
                    $('#links').val(data.tpv.link);
                    
                    // Cargar departamentos del hotel y seleccionar el actual
                    cargarDepartamentos(data.tpv.hotel_id, data.tpv.departamento_id);
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
