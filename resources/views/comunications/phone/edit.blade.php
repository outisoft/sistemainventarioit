<!-- Modal de Edición -->
<div class="modal fade" id="editModal{{ $phone->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $phone->id }}"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel{{ $phone->id }}">Editar Teléfono de Escritorio</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Formulario de Edición -->
                <form id="editForm{{ $phone->id }}" action="{{ route('phones.update', $phone->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="extension" class="form-label">Extensión:</label>
                        <input type="text" name="extension" id="extension" class="form-control"
                            value="{{ $phone->extension }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="service" class="form-label">Servicio:</label>
                        <input type="text" name="service" id="service" class="form-control"
                            value="{{ $phone->service }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="model" class="form-label">Modelo:</label>
                        <input type="text" name="model" id="model" class="form-control"
                            value="{{ $phone->model }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="serial" class="form-label">Serial:</label>
                        <input type="text" name="serial" id="serial" class="form-control"
                            value="{{ $phone->serial }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="hotel_id_edit_{{ $phone->id }}" class="form-label">Hotel:</label>
                        <select name="hotel_id" id="hotel_id_edit_{{ $phone->id }}" class="form-control" required>
                            <option value="">Seleccione un hotel</option>
                            @foreach ($hotels as $hotel)
                                <option value="{{ $hotel->id }}"
                                    {{ $phone->room->villa->hotel->id == $hotel->id ? 'selected' : '' }}>
                                    {{ $hotel->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="villa_id_edit_{{ $phone->id }}" class="form-label">Villa:</label>
                        <select name="villa_id" id="villa_id_edit_{{ $phone->id }}" class="form-control" required>
                            <option value="">Seleccione una villa</option>
                            @foreach ($villas as $villa)
                                <option value="{{ $villa->id }}"
                                    {{ $phone->room->villa->id == $villa->id ? 'selected' : '' }}>
                                    {{ $villa->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="room_id_edit_{{ $phone->id }}" class="form-label">Habitación:</label>
                        <select name="room_id" id="room_id_edit_{{ $phone->id }}" class="form-control" required>
                            <option value="">Seleccione una habitación</option>
                            @foreach ($rooms as $room)
                                <option value="{{ $room->id }}"
                                    {{ $phone->room->id == $room->id ? 'selected' : '' }}>
                                    {{ $room->number }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button type="submit" form="editForm{{ $phone->id }}" class="btn btn-primary">Guardar
                    Cambios</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        // Cuando se abre el modal de edición
        $('[id^=editModal]').on('show.bs.modal', function(event) {
            var modal = $(this);
            var phoneId = modal.attr('id').replace('editModal', '');

            // Forzar el evento 'change' en el dropdown de hotel
            $('#hotel_id_edit_' + phoneId).trigger('change');

            // Forzar el evento 'change' en el dropdown de villa
            $('#villa_id_edit_' + phoneId).trigger('change');
        });

        // Cargar villas al cambiar el hotel en el modal de edición
        $('[id^=hotel_id_edit]').change(function() {
            var hotelId = $(this).val();
            var phoneId = $(this).attr('id').replace('hotel_id_edit_', '');
            if (hotelId) {
                $.ajax({
                    url: "{{ route('getVillas') }}",
                    type: "GET",
                    data: {
                        hotel_id: hotelId
                    },
                    success: function(data) {
                        $('#villa_id_edit_' + phoneId).empty();
                        $('#villa_id_edit_' + phoneId).append(
                            '<option value="">Seleccione una villa</option>');
                        $.each(data, function(key, value) {
                            $('#villa_id_edit_' + phoneId).append(
                                '<option value="' + value.id + '">' + value
                                .name + '</option>');
                        });
                    },
                    error: function(xhr, status, error) {
                        console.error("Error al cargar villas:", error);
                    }
                });
            } else {
                $('#villa_id_edit_' + phoneId).empty();
                $('#room_id_edit_' + phoneId).empty();
            }
        });

        // Cargar habitaciones al cambiar la villa en el modal de edición
        $('[id^=villa_id_edit]').change(function() {
            var villaId = $(this).val();
            var phoneId = $(this).attr('id').replace('villa_id_edit_', '');
            if (villaId) {
                $.ajax({
                    url: "{{ route('getRooms') }}",
                    type: "GET",
                    data: {
                        villa_id: villaId
                    },
                    success: function(data) {
                        $('#room_id_edit_' + phoneId).empty();
                        $('#room_id_edit_' + phoneId).append(
                            '<option value="">Seleccione una habitación</option>');
                        $.each(data, function(key, value) {
                            $('#room_id_edit_' + phoneId).append(
                                '<option value="' + value.id + '">' + value
                                .number + '</option>');
                        });
                    },
                    error: function(xhr, status, error) {
                        console.error("Error al cargar habitaciones:", error);
                    }
                });
            } else {
                $('#room_id_edit_' + phoneId).empty();
            }
        });
    });
</script>
