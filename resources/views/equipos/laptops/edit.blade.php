<!-- Modales de Edición -->
@foreach ($equipos as $equipo)
    <div class="modal fade" id="editModal{{ $equipo->id }}" tabindex="-1" aria-labelledby="editModal{{ $equipo->id }}"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModal{{ $equipo->id }}">Edit: {{ $equipo->name }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('laptops.update', $equipo) }}" method="POST">
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

                        <!-- Marca -->
                        <div class="mb-3">
                            <x-input-label class="form-label" for="marca{{ $equipo->marca }}" :value="__('BRAND')" />
                            <div class="input-group input-group-merge">
                                <x-text-input id="marca{{ $equipo->marca }}" class="form-control" type="text"
                                    name="marca" placeholder="HP" value="{{ $equipo->marca }}" required
                                    autocomplete="marca" />
                            </div>
                            <x-input-error :messages="$errors->get('marca')" class="mt-2" />
                        </div>

                        <!-- Modelo -->
                        <div class="mb-3">
                            <x-input-label class="form-label" for="model{{ $equipo->model }}" :value="__('MODEL')" />
                            <div class="input-group input-group-merge">
                                <x-text-input id="model{{ $equipo->model }}" class="form-control" type="text"
                                    name="model" placeholder="PROBOOK" value="{{ $equipo->model }}" required
                                    autocomplete="model" />
                            </div>
                            <x-input-error :messages="$errors->get('model')" class="mt-2" />
                        </div>

                        <!-- Serial -->
                        <div class="mb-3">
                            <x-input-label class="form-label" for="serial{{ $equipo->serial }}" :value="__('SERIAL NUMBER')" />
                            <div class="input-group input-group-merge">
                                <x-text-input id="serial{{ $equipo->serial }}" class="form-control" type="text"
                                    name="serial" placeholder="52NS0WPM4R" value="{{ $equipo->serial }}" required
                                    autocomplete="serial" />
                            </div>
                            <x-input-error :messages="$errors->get('serial')" class="mt-2" />
                        </div>

                        <!-- Nombre -->
                        <div class="mb-3">
                            <x-input-label class="form-label" for="name{{ $equipo->name }}" :value="__('EQUIPMENTS NAME')" />
                            <div class="input-group input-group-merge">
                                <x-text-input id="name{{ $equipo->name }}" class="form-control" type="text"
                                    name="name" placeholder="TULSIS001" value="{{ $equipo->name }}" required
                                    autocomplete="name" />
                            </div>
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <!-- IP -->
                        <div class="mb-3">
                            <x-input-label class="form-label" for="ip{{ $equipo->ip }}" :value="__('IP')" />
                            <div class="input-group input-group-merge">
                                <x-text-input id="ip{{ $equipo->ip }}" class="form-control" type="text"
                                    name="ip" placeholder="10.1.22.116" value="{{ $equipo->ip }}" required
                                    autocomplete="ip" />
                            </div>
                            <x-input-error :messages="$errors->get('ip')" class="mt-2" />
                        </div>

                        <!-- SO -->
                        <div class="mb-3">
                            <x-input-label class="form-label" for="so{{ $equipo->so }}" :value="__('OPERATING SYSTEM')" />
                            <div class="input-group input-group-merge">
                                <x-text-input id="so{{ $equipo->so }}" class="form-control" type="text"
                                    name="so" placeholder="Windows 11" value="{{ $equipo->so }}" required
                                    autocomplete="so" />
                            </div>
                            <x-input-error :messages="$errors->get('so')" class="mt-2" />
                        </div>

                        <!-- ORDEN DE COMPRA -->
                        <div class="mb-3">
                            <x-input-label class="form-label" for="orden{{ $equipo->orden }}" :value="__('ORDER')" />
                            <div class="input-group input-group-merge">
                                <x-text-input id="orden{{ $equipo->orden }}" class="form-control" type="text"
                                    name="orden" placeholder="HP" value="{{ $equipo->orden }}" required
                                    autocomplete="orden" />
                            </div>
                            <x-input-error :messages="$errors->get('orden')" class="mt-2" />
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">CLOSE</button>
                            <button type="submit" class="btn btn-primary">UPDATE</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endforeach
