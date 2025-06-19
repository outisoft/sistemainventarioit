<!-- Modales de Edición -->
@foreach ($companies as $company)
    <div class="modal fade" id="editModal{{ $company->id }}" tabindex="-1" aria-labelledby="editModal{{ $company->id }}"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('companies.update', $company) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModal{{ $company->id }}">Edit: {{ $company->serial }}</h5>
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
                                            {{ $company->region_id == $region->id ? 'selected' : '' }}>
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
                                                {{ $company->region_id == $region->id ? 'selected' : '' }}>
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

                        <!-- name -->
                        <div class="mb-3">
                            <x-input-label class="form-label" for="name{{ $company->name }}"
                                :value="__('Company Name')" />
                            <div class="input-group input-group-merge">
                                <x-text-input id="name{{ $company->name }}" class="form-control"
                                    type="text" name="name" placeholder="HP" value="{{ $company->name }}"
                                    required autocomplete="name" />
                            </div>
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <!-- description -->
                        <div class="mb-3">
                            <x-input-label class="form-label" for="description{{ $company->description }}" :value="__('Company Description')" />
                            <div class="input-group input-group-merge">
                                <x-text-input id="description{{ $company->description }}" class="form-control" type="text"
                                    name="description" placeholder="HP" value="{{ $company->description }}" required
                                    autocomplete="description" />
                            </div>
                            <x-input-error :messages="$errors->get('description')" class="mt-2" />
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
