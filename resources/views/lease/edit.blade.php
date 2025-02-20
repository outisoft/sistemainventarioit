<!-- Modales de Edición -->
@foreach ($leases as $lease)
    <div class="modal fade" id="editModal{{ $lease->id }}" tabindex="-1" aria-labelledby="editModal{{ $lease->id }}"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('lease.update', $lease) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModal{{ $lease->id }}">Edit Lease</h5>
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
                                            {{ $lease->region_id == $region->id ? 'selected' : '' }}>
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
                                                {{ $lease->region_id == $region->id ? 'selected' : '' }}>
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

                        <!-- Campo: Lease -->
                        <div class="mb-3">
                            <x-input-label class="form-label" for="lease{{ $lease->lease }}" :value="__('Lease')" />
                            <div class="input-group input-group-merge">
                                <x-text-input id="lease{{ $lease->lease }}" class="form-control" type="text"
                                    name="lease" placeholder="HP" value="{{ $lease->lease }}" required
                                    autocomplete="lease" />
                            </div>
                            <x-input-error :messages="$errors->get('lease')" class="mt-2" />
                        </div>

                        <!-- Campo: End Date -->
                        <div class="mb-3">
                            <x-input-label class="form-label" for="end_date{{ $lease->end_date }}" :value="__('End Date')" />
                            <div class="input-group input-group-merge">
                                <x-text-input id="end_date{{ $lease->end_date }}" class="form-control" type="date"
                                    name="end_date" value="{{ $lease->end_date }}" required autocomplete="end_date" />
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
