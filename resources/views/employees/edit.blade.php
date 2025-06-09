<!-- Modales de Edición -->
@foreach ($employees as $employee)
    <div class="modal fade" id="editModal{{ $employee->id }}" tabindex="-1" aria-labelledby="editModal{{ $employee->id }}"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModal{{ $employee->id }}">Editar employee: {{ $employee->name }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('employees.update', $employee) }}" method="POST">
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
                                            {{ $employee->region_id == $region->id ? 'selected' : '' }}>
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
                                                {{ $employee->region_id == $region->id ? 'selected' : '' }}>
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

                        <!-- No Colaborador -->
                        <div class="mb-3">
                            <x-input-label class="form-label" for="no_employee" :value="__('Numero de empleado')" />
                            <div class="input-group input-group-merge">
                                <x-text-input id="no_employee" class="form-control" type="text" name="no_employee"
                                    value="{{ $employee->no_employee }}" required autofocus />
                                <x-input-error :messages="$errors->get('no_employee')" class="mt-2" />
                            </div>
                        </div>

                        <!-- Name -->
                        <div class="mb-3">
                            <x-input-label class="form-label" for="name" :value="__('Nombre')" />
                            <div class="input-group input-group-merge">
                                <x-text-input id="name" class="form-control" type="text" name="name"
                                    value="{{ $employee->name }}" required autofocus />
                                <x-input-error :messages="$errors->get('name')" class="mt-2" />
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
    </div>
@endforeach
