<!-- Modales de Edición -->
@foreach ($offices as $equipo)
    <div class="modal fade" id="editModal{{ $equipo->id }}" tabindex="-1" aria-labelledby="editModal{{ $equipo->id }}"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('office.update', $equipo) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModal{{ $equipo->id }}">Editar Office</h5>
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
                                            {{ $equipo->region_id == $region->id ? 'selected' : '' }}>
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
                                                {{ $equipo->region_id == $region->id ? 'selected' : '' }}>
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

                        <!-- Campo: tipo de la licencia -->
                        <div class="mb-3">
                            <x-input-label class="form-label" for="type" :value="__('Tipo de Office')" />
                            <select class="form-control" id="type" name="type" required>
                                <option value="">Seleccione un tipo</option>
                                <option value="365" {{ $equipo->type == '365' ? 'selected' : '' }}>Office 365
                                </option>
                                <option value="2019" {{ $equipo->type == '2019' ? 'selected' : '' }}>Office 2019
                                </option>
                                <option value="2016" {{ $equipo->type == '2016' ? 'selected' : '' }}>Office 2016
                                </option>
                                <option value="2013" {{ $equipo->type == '2013' ? 'selected' : '' }}>Office 2013
                                </option>
                                <option value="2010" {{ $equipo->type == '2010' ? 'selected' : '' }}>Office 2010
                                </option>
                                <option value="2007" {{ $equipo->type == '2007' ? 'selected' : '' }}>Office 2007
                                </option>
                                <option value="2003" {{ $equipo->type == '2003' ? 'selected' : '' }}>Office 2003
                                </option>
                            </select>
                            <x-input-error :messages="$errors->get('type')" class="mt-2" />
                        </div>

                        <!-- Campo: Clave de la licencia -->
                        <div class="mb-3">
                            <x-input-label class="form-label" for="key{{ $equipo->key }}" :value="__('Email/KEY')" />
                            <div class="input-group input-group-merge">
                                <x-text-input id="key{{ $equipo->key }}" class="form-control" type="text"
                                    name="key" placeholder="HP" value="{{ $equipo->key }}" required
                                    autocomplete="key" />
                            </div>
                            <x-input-error :messages="$errors->get('key')" class="mt-2" />
                        </div>

                        <div class="mb-3" id="end_date_container"
                            style="display: {{ $equipo->type == '365' ? 'block' : 'none' }};">
                            <x-input-label class="form-label" for="end_date{{ $equipo->end_date }}"
                                :value="__('Contract End Date')" />
                            <div class="input-group input-group-merge">
                                <x-text-input type="date" class="form-control" id="end_date{{ $equipo->end_date }}"
                                    name="end_date" value="{{ $equipo->end_date }}" autocomplete="end_date" />
                            </div>
                            <x-input-error :messages="$errors->get('end_date')" class="mt-2" />
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Actualizar</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
@endforeach
<script>
    document.getElementById('type').addEventListener('change', function() {
        const endDateContainer = document.getElementById('end_date_container');
        if (this.value === '365') {
            endDateContainer.style.display = 'block';
            document.getElementById('end_date').setAttribute('required', true);
        } else {
            endDateContainer.style.display = 'none';
            document.getElementById('end_date').removeAttribute('required');
        }
    });
</script>
