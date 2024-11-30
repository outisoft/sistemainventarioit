<!-- Modales de Edición -->
@foreach($hotels as $hotel)
    <div class="modal fade" id="editModal{{ $hotel->id }}" tabindex="-1" aria-labelledby="editModal{{ $hotel->id }}" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModal{{ $hotel->id }}">Editar hotel: {{ $hotel->name }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('hotels.update', $hotel) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <!-- Name -->
                        <div class="mb-3">
                            <x-input-label class="form-label" for="name" :value="__('Nombre')" />
                            <div class="input-group input-group-merge">
                                <x-text-input id="name" class="form-control" type="text" name="name"
                                    value="{{ $hotel->name }}" required autofocus />
                                <x-input-error :messages="$errors->get('name')" class="mt-2" />
                            </div>
                        </div>

                        <!-- tipo -->
                        <div class="mb-3">
                            <x-input-label class="form-label" for="type" :value="__('Tipo')" />
                            <div class="input-group input-group-merge">
                                <x-text-input id="type" class="form-control" type="text" name="type"
                                    value="{{ $hotel->type }}" required autofocus />
                                <x-input-error :messages="$errors->get('type')" class="mt-2" />
                            </div>
                        </div>

                        <!-- Reegion -->
                        <div class="form-group">
                            <x-input-label class="form-label" for="region_id" :value="__('Region')" />
                            <select class="form-control" id="region_id" name="region_id"
                                aria-label="Default select example">
                                @foreach ($regions as $region)
                                    <option value="{{ $region->id }}"
                                        {{ $hotel->region_id == $region->id ? 'selected' : '' }}>
                                        {{ $region->name }}</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('region_id')" class="mt-2" />
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Departamentos</label>
                            @foreach($departments as $department)
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" 
                                            name="department_ids[]" 
                                            value="{{ $department->id }}" 
                                            id="department_ids{{ $hotel->id }}{{ $department->id }}"
                                            {{ $hotel->departments->contains($department->id) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="department_ids{{ $hotel->id }}{{ $department->id }}">
                                        {{ $department->name }}
                                    </label>
                                </div>
                            @endforeach
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