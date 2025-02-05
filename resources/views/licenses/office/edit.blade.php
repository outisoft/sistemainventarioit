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

                        <!-- Tipo -->
                        <div class="mb-3" style="display: none;">
                            <x-input-label class="form-label" for="type_id" :value="__('Tipo de equipo')" />
                            <div class="input-group input-group-merge">
                                <x-text-input readonly='readonly' id="type_id" class="form-control" type="text"
                                    name="type_id" placeholder="Other" :value="15" required
                                    autocomplete="type_id" />
                            </div>
                            <x-input-error :messages="$errors->get('type_id')" class="mt-2" />
                        </div>

                        <!-- Campo: tipo de la licencia -->
                        <div class="mb-3">
                            <x-input-label class="form-label" for="type" :value="__('Tipo de Office')" />
                            <select class="form-control" id="type" name="type" required>
                                <option value="">Seleccione un tipo</option>
                                <option value="MICROSOFT 365" {{ $equipo->type == 'MICROSOFT 365' ? 'selected' : '' }}>
                                    MICROSOFT 365
                                </option>
                                <option value="OFFICE 2019 PROFESSIONAL"
                                    {{ $equipo->type == 'OFFICE 2019 PROFESSIONAL' ? 'selected' : '' }}>
                                    OFFICE 2019 PROFESSIONAL
                                </option>
                                <option value="OFFICE 2019 STANDARD"
                                    {{ $equipo->type == 'OFFICE 2019 STANDARD' ? 'selected' : '' }}>
                                    OFFICE 2019 STANDARD
                                </option>
                                <option value="OFFICE 2019 HOME AND BUSINESS"
                                    {{ $equipo->type == 'OFFICE 2019 HOME AND BUSINESS' ? 'selected' : '' }}>
                                    OFFICE 2019 HOME AND BUSINESS
                                </option>
                                <option value="OFFICE 2016 PROFESSIONAL"
                                    {{ $equipo->type == 'OFFICE 2016 PROFESSIONAL' ? 'selected' : '' }}>
                                    OFFICE 2016 PROFESSIONAL
                                </option>
                                <option value="OFFICE 2016 STANDARD"
                                    {{ $equipo->type == 'OFFICE 2016 STANDARD' ? 'selected' : '' }}>
                                    OFFICE 2016 STANDARD
                                </option>
                                <option value="OFFICE 2016 HOME AND BUSINESS"
                                    {{ $equipo->type == 'OFFICE 2016 HOME AND BUSINESS' ? 'selected' : '' }}>
                                    OFFICE 2016 HOME AND BUSINESS
                                </option>
                                <option value="OFFICE 2013 PROFESSIONAL"
                                    {{ $equipo->type == 'OFFICE 2013 PROFESSIONAL' ? 'selected' : '' }}>
                                    OFFICE 2013 PROFESSIONAL
                                </option>
                                <option value="OFFICE 2013 STANDARD"
                                    {{ $equipo->type == 'OFFICE 2013 STANDARD' ? 'selected' : '' }}>
                                    OFFICE 2013 STANDARD
                                </option>
                                <option value="OFFICE 2013 HOME AND BUSINESS"
                                    {{ $equipo->type == 'OFFICE 2013 HOME AND BUSINESS' ? 'selected' : '' }}>
                                    OFFICE 2013 HOME AND BUSINESS
                                </option>
                                <option value="OFFICE 2010 PROFESSIONAL"
                                    {{ $equipo->type == 'OFFICE 2010 PROFESSIONAL' ? 'selected' : '' }}>
                                    OFFICE 2010 PROFESSIONAL
                                </option>
                                <option value="OFFICE 2010 STANDARD"
                                    {{ $equipo->type == 'OFFICE 2010 STANDARD' ? 'selected' : '' }}>
                                    OFFICE 2010 STANDARD
                                </option>
                                <option value="OFFICE 2007 ENTERPRISE"
                                    {{ $equipo->type == 'OFFICE 2007 ENTERPRISE' ? 'selected' : '' }}>
                                    OFFICE 2007 ENTERPRISE
                                </option>
                                <option value="OFFICE 2007 ULTIMATE"
                                    {{ $equipo->type == 'OFFICE 2007 ULTIMATE' ? 'selected' : '' }}>
                                    OFFICE 2007 ULTIMATE
                                </option>
                                <option value="OFFICE 2007 PROFESSIONAL"
                                    {{ $equipo->type == 'OFFICE 2007 PROFESSIONAL' ? 'selected' : '' }}>
                                    OFFICE 2007 PROFESSIONAL
                                </option>
                                <option value="OFFICE 2007 STANDARD"
                                    {{ $equipo->type == 'OFFICE 2007 STANDARD' ? 'selected' : '' }}>
                                    OFFICE 2007 STANDARD
                                </option>
                                <option value="OFFICE 2003 BASIC EDITION"
                                    {{ $equipo->type == 'OFFICE 2003 BASIC EDITION' ? 'selected' : '' }}>
                                    OFFICE 2003 BASIC EDITION
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
                            style="display: {{ $equipo->type == 'MICROSOFT 365' ? 'block' : 'none' }};">
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
        if (this.value === 'MICROSOFT 365') {
            endDateContainer.style.display = 'block';
            document.getElementById('end_date').setAttribute('required', true);
        } else {
            endDateContainer.style.display = 'none';
            document.getElementById('end_date').removeAttribute('required');
        }
    });
</script>
