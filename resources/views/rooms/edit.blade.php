<!-- Modales de Edición -->
@foreach ($rooms as $room)
    <div class="modal fade" id="editModal{{ $room->id }}" tabindex="-1" aria-labelledby="editModal{{ $room->id }}"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModal{{ $room->id }}">Editar room: {{ $room->name }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('rooms.update', $room) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <!-- Region -->
                        @role('Administrator')
                            <div class="mb-3">
                                <x-input-label class="form-label" for="region_id" :value="__('REGION')" />
                                <select class="form-control" id="region_id" name="region_id"
                                    aria-label="Default select example">
                                    @foreach ($regions as $region)
                                        <option value="{{ $region->id }}"
                                            {{ $room->region_id == $region->id ? 'selected' : '' }}>
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
                                                {{ $room->region_id == $region->id ? 'selected' : '' }}>
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

                        <!-- Number -->
                        <div class="mb-3">
                            <x-input-label class="form-label" for="number" :value="__('Number')" />
                            <div class="input-group input-group-merge">
                                <x-text-input id="number" class="form-control" type="number" name="number"
                                    value="{{ $room->number }}" required autofocus />
                                <x-input-error :messages="$errors->get('number')" class="mt-2" />
                            </div>
                        </div>

                        <!-- villa -->
                        <div class="mb-3">
                            <x-input-label class="form-label" for="villa_id" :value="__('Locations')" />
                            <select class="form-control" id="villa_id" name="villa_id"
                                aria-label="Default select example">
                                @foreach ($villas as $villa)
                                    <option value="{{ $villa->id }}"
                                        {{ $room->villa_id == $villa->id ? 'selected' : '' }}>
                                        {{ $villa->name }}</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('villa_id')" class="mt-2" />
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
@endforeach
