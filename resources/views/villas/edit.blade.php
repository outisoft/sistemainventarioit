<!-- Modales de Edición -->
@foreach ($villas as $villa)
    <div class="modal fade" id="editModal{{ $villa->id }}" tabindex="-1" aria-labelledby="editModal{{ $villa->id }}"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModal{{ $villa->id }}">Editar villa: {{ $villa->name }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('villas.update', $villa) }}" method="POST">
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
                                            {{ $villa->region_id == $region->id ? 'selected' : '' }}>
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
                                                {{ $villa->region_id == $region->id ? 'selected' : '' }}>
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
                            <x-input-label class="form-label" for="name" :value="__('Nombre')" />
                            <div class="input-group input-group-merge">
                                <x-text-input id="name" class="form-control" type="text" name="name"
                                    value="{{ $villa->name }}" required autofocus />
                                <x-input-error :messages="$errors->get('name')" class="mt-2" />
                            </div>
                        </div>

                        <!-- Hotel -->
                        <div class="mb-3">
                            <x-input-label class="form-label" for="hotel_id" :value="__('Locations')" />
                            <select class="form-control" id="hotel_id" name="hotel_id"
                                aria-label="Default select example">
                                @foreach ($hotels as $hotel)
                                    <option value="{{ $hotel->id }}"
                                        {{ $villa->hotel_id == $hotel->id ? 'selected' : '' }}>
                                        {{ $hotel->name }}</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('hotel_id')" class="mt-2" />
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endforeach
