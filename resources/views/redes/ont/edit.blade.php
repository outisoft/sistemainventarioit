<form method="POST" action="{{ isset($ont) ? route('access-points.update', $ont->id) : route('access-points.store') }}">
    @csrf
    @isset($ont)
        @method('PUT')
    @endisset

    <div class="form-group">
        <label for="hotel_id">Hotel</label>
        <select name="hotel_id" id="hotel_id" class="form-control" required>
            <option value="">Seleccione un hotel</option>
            @foreach ($hotels as $hotel)
                <option value="{{ $hotel->id }}"
                    @isset($ont) {{ $ont->hotel_id == $hotel->id ? 'selected' : '' }} @endisset>
                    {{ $hotel->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label for="villa_id">Villa</label>
        <select name="villa_id" id="villa_id" class="form-control" required
            @empty($ont->villa_id) disabled @endempty>
            <option value="">
                @isset($ont)
                    Seleccione una villa
                @else
                    Seleccione un hotel primero
                @endisset
            </option>
            @isset($ont)
                @foreach ($villas as $villa)
                    <option value="{{ $villa->id }}" {{ $ont->villa_id == $villa->id ? 'selected' : '' }}>
                        {{ $villa->name }}
                    </option>
                @endforeach
            @endisset
        </select>
    </div>

    <div class="form-group">
        <label for="room_id">Habitación</label>
        <select name="room_id" id="room_id" class="form-control" required
            @empty($ont->room_id) disabled @endempty>
            <option value="">
                @isset($ont)
                    Seleccione una habitación
                @else
                    Seleccione una villa primero
                @endisset
            </option>
            @isset($ont)
                @foreach ($rooms as $room)
                    <option value="{{ $room->id }}" {{ $ont->room_id == $room->id ? 'selected' : '' }}>
                        {{ $room->room_number }}
                    </option>
                @endforeach
            @endisset
        </select>
    </div>

    <button type="submit" class="btn btn-primary">Guardar</button>
</form>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const hotelSelect = document.getElementById('hotel_id');
        const villaSelect = document.getElementById('villa_id');
        const roomSelect = document.getElementById('room_id');

        if (!hotelSelect || !villaSelect || !roomSelect) return;

        // Cargar villas cuando cambia el hotel
        hotelSelect.addEventListener('change', function() {
            const hotelId = this.value;
            const villaSelect = document.getElementById('villa_id');
            const roomSelect = document.getElementById('room_id');

            // Resetear selects dependientes
            villaSelect.innerHTML = '<option value="">Cargando villas...</option>';
            villaSelect.disabled = true;
            roomSelect.innerHTML = '<option value="">Seleccione una villa primero</option>';
            roomSelect.disabled = true;

            if (!hotelId) {
                villaSelect.innerHTML = '<option value="">Seleccione un hotel primero</option>';
                return;
            }

            fetch(`/api/villas?hotel_id=${hotelId}`)
                .then(response => {
                    if (!response.ok) throw new Error('Error en la respuesta');
                    return response.json();
                })
                .then(villas => {
                    villaSelect.innerHTML = '<option value="">Seleccione una villa</option>';

                    villas.forEach(villa => {
                        const option = document.createElement('option');
                        option.value = villa.id;
                        option.textContent = villa.name;
                        villaSelect.appendChild(option);
                    });

                    villaSelect.disabled = false;
                })
                .catch(error => {
                    console.error('Error:', error);
                    villaSelect.innerHTML = '<option value="">Error al cargar villas</option>';
                });
        });

        // Cargar habitaciones cuando cambia la villa
        villaSelect.addEventListener('change', function() {
            const villaId = this.value;
            const roomSelect = document.getElementById('room_id');

            // Resetear select de habitaciones
            roomSelect.innerHTML = '<option value="">Cargando habitaciones...</option>';
            roomSelect.disabled = true;

            if (!villaId) {
                roomSelect.innerHTML = '<option value="">Seleccione una villa primero</option>';
                return;
            }

            fetch(`/api/rooms?villa_id=${villaId}`)
                .then(response => {
                    if (!response.ok) throw new Error('Error en la respuesta');
                    return response.json();
                })
                .then(rooms => {
                    roomSelect.innerHTML = '<option value="">Seleccione una habitación</option>';

                    rooms.forEach(room => {
                        const option = document.createElement('option');
                        option.value = room.id;
                        option.textContent = room
                            .name; // room_number viene como name por el as
                        roomSelect.appendChild(option);
                    });

                    roomSelect.disabled = false;
                })
                .catch(error => {
                    console.error('Error:', error);
                    roomSelect.innerHTML = '<option value="">Error al cargar habitaciones</option>';
                });
        });

        // Disparar evento change si hay hotel seleccionado al cargar (para edición)
        if (hotelSelect.value) {
            hotelSelect.dispatchEvent(new Event('change'));

            // Si también hay villa seleccionada, disparar su cambio después de un pequeño delay
            if (villaSelect.value) {
                setTimeout(() => {
                    villaSelect.dispatchEvent(new Event('change'));
                }, 300);
            }
        }
    });
</script>
