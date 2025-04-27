<!-- Modales de Edición -->
@foreach ($onts as $ont)

@php
    $villas = \App\Models\Villa::where('hotel_id', $ont->hotel_id)->get();
    $rooms = \App\Models\Room::where('villa_id', $ont->villa_id)->get();
@endphp

    <div class="modal fade" id="editModal{{ $ont->id }}" tabindex="-1" aria-labelledby="editModal{{ $ont->id }}"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('ont.update', $ont) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="modal-header">
                        <h5 class="modal-title" id="editModal{{ $ont->id }}">Editar ont: {{ $ont->name }}</h5>
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
                                            {{ $ont->region_id == $region->id ? 'selected' : '' }}>
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
                                    <select class="form-control" id="region_id" name="region_id" aria-label="Default select example">
                                        @foreach ($userRegions as $region)
                                            <option value="{{ $region->id }}" {{ $ont->region_id == $region->id ? 'selected' : '' }}>
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

                        <!-- Name -->
                        <div class="mb-3">
                            <x-input-label class="form-label" for="name" :value="__('Equipment name')" />
                            <div class="input-group input-group-merge">
                                <x-text-input id="name{{ $ont->name }}" class="form-control" type="text"
                                    name="name" placeholder="ONT-123" value="{{ $ont->name }}" required
                                    autocomplete="name" />
                            </div>
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <!-- brand -->
                        <div class="mb-3">
                            <x-input-label class="form-label" for="brand" :value="__('Brand')" />
                            <div class="input-group input-group-merge">
                                <x-text-input id="brand{{ $ont->brand }}" class="form-control" type="text"
                                    name="brand" placeholder="HUAWEI" value="{{ $ont->brand }}" required
                                    autocomplete="brand" />
                            </div>
                            <x-input-error :messages="$errors->get('brand')" class="mt-2" />
                        </div>

                        <!-- Modelo -->
                        <div class="mb-3">
                            <x-input-label class="form-label" for="model{{ $ont->model }}" :value="__('Model')" />
                            <div class="input-group input-group-merge">
                                <x-text-input id="model{{ $ont->model }}" class="form-control" type="text"
                                    name="model" placeholder="ONT45RT7" value="{{ $ont->model }}" required
                                    autocomplete="model" />
                            </div>
                            <x-input-error :messages="$errors->get('model')" class="mt-2" />
                        </div>

                        <!-- Serial -->
                        <div class="mb-3">
                            <x-input-label class="form-label" for="serial{{ $ont->serial }}" :value="__('Serial')" />
                            <div class="input-group input-group-merge">
                                <x-text-input id="serial{{ $ont->serial }}" class="form-control" type="text"
                                    name="serial" placeholder="52RSCF78N93" value="{{ $ont->serial }}" required
                                    autocomplete="serial" />
                            </div>
                            <x-input-error :messages="$errors->get('serial')" class="mt-2" />
                        </div>

                        <!-- MAC -->
                        <div class="mb-3">
                            <x-input-label class="form-label" for="mac{{ $ont->mac }}" :value="__('MAC address')" />
                            <div class="input-group input-group-merge">
                                <x-text-input id="mac-edit" class="form-control" type="text" name="mac"
                                    placeholder="12:C0:96:24:00" value="{{ $ont->mac }}" required
                                    autocomplete="mac" />
                            </div>
                            <x-input-error :messages="$errors->get('mac')" class="mt-2" />
                        </div>

                        <!-- IP -->
                        <div class="mb-3">
                            <x-input-label class="form-label" for="ip{{ $ont->ip }}" :value="__('IP')" />
                            <div class="input-group input-group-merge">
                                <x-text-input id="ip{{ $ont->ip }}" class="form-control" type="text"
                                    name="ip" placeholder="10.01.2.31" value="{{ $ont->ip }}" required
                                    autocomplete="ip" />
                            </div>
                            <x-input-error :messages="$errors->get('ip')" class="mt-2" />
                        </div>

                        <div class="mb-3">
                            <x-input-label class="form-label" for="hotel_id_edit" :value="__('Hotel')" />
                            <select class="form-control" id="hotel_id_edit" name="hotel_id"
                                aria-label="Default select example">
                                @foreach ($hotels as $location)
                                    <option value="{{ $location->id }}"
                                        {{ $ont->hotel_id == $location->id ? 'selected' : '' }}>
                                        {{ $location->name }}</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('hotel_id')" class="mt-2" />
                        </div>

                        <div class="mb-3">
                            <label for="villa_id_edit">Villa</label>
                            <select name="villa_id" id="villa_id_edit" class="form-control" required>
                                <option value="">Seleccione una villa</option>
                                @foreach($villas as $villa)
                                    <option value="{{ $villa->id }}" 
                                        {{ $ont->villa_id == $villa->id ? 'selected' : '' }}>
                                        {{ $villa->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        
                        <div class="mb-3">
                            <label for="room_id_edit">Habitación</label>
                            <select name="room_id" id="room_id_edit" class="form-control" required>
                                <option value="">Seleccione una habitación</option>
                                @foreach($rooms as $room)
                                    <option value="{{ $room->id }}" 
                                        {{ $ont->room_id == $room->id ? 'selected' : '' }}>
                                        {{ $room->number }}
                                    </option>
                                @endforeach
                            </select>
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
    document.addEventListener('DOMContentLoaded', function() {
        const hotelSelect = document.getElementById('hotel_id_edit');
        const villaSelect = document.getElementById('villa_id_edit');
        const roomSelect = document.getElementById('room_id_edit');

        if (hotelSelect && villaSelect) {
            hotelSelect.addEventListener('change', function() {
                const hotelId = this.value;
                
                if (!hotelId) {
                    villaSelect.innerHTML = '<option value="">Seleccione un hotel primero</option>';
                    villaSelect.disabled = true;
                    roomSelect.innerHTML = '<option value="">Seleccione una villa primero</option>';
                    roomSelect.disabled = true;
                    return;
                }
                
                // Mostrar carga
                villaSelect.innerHTML = '<option value="">Cargando villas...</option>';
                villaSelect.disabled = false;
                
                fetch(`/api/villas?hotel_id=${hotelId}`)
                    .then(response => {
                        if (!response.ok) {
                            throw new Error(`Error al cargar villas: ${response.statusText}`);
                        }
                        return response.json();
                    })
                    .then(villas => {
                        villaSelect.innerHTML = '<option value="">Seleccione una villa</option>';
                        
                        // Ordenar las villas por nombre
                        villas.sort((a, b) => a.name.localeCompare(b.name));
                        
                        villas.forEach(villa => {
                            const option = new Option(villa.name, villa.id);
                            villaSelect.appendChild(option);
                        });
                        
                        // Resetear habitaciones
                        roomSelect.innerHTML = '<option value="">Seleccione una villa primero</option>';
                        roomSelect.disabled = true;
                    })
                    .catch(error => {
                        console.error('Error al cargar villas:', error);
                        villaSelect.innerHTML = '<option value="">Error al cargar villas</option>';
                        villaSelect.disabled = true;
                    });
            });
            
            villaSelect.addEventListener('change', function() {
                const villaId = this.value;
                
                if (!villaId) {
                    roomSelect.innerHTML = '<option value="">Seleccione una villa primero</option>';
                    roomSelect.disabled = true;
                    return;
                }
                
                // Mostrar carga
                roomSelect.innerHTML = '<option value="">Cargando habitaciones...</option>';
                roomSelect.disabled = false;
                
                fetch(`/api/rooms?villa_id=${villaId}`)
                    .then(response => {
                        if (!response.ok) {
                            throw new Error(`Error al cargar habitaciones: ${response.statusText}`);
                        }
                        return response.json();
                    })
                    .then(rooms => {
                        roomSelect.innerHTML = '<option value="">Seleccione una habitación</option>';
                        
                        // Ordenar las habitaciones por número
                        rooms.sort((a, b) => a.number - b.number);
                        
                        rooms.forEach(room => {
                            const option = new Option(room.number, room.id);
                            roomSelect.appendChild(option);
                        });
                    })
                    .catch(error => {
                        console.error('Error al cargar habitaciones:', error);
                        roomSelect.innerHTML = '<option value="">Error al cargar habitaciones</option>';
                        roomSelect.disabled = true;
                    });
            });
        }
    });
</script>