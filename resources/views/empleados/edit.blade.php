<!-- Modales de Edición -->
@foreach($empleados as $empleado)
    <div class="modal fade" id="editModal{{ $empleado->id }}" tabindex="-1" aria-labelledby="editModal{{ $empleado->id }}" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModal{{ $empleado->id }}">Editar empleado: {{ $empleado->name }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('empleados.update', $empleado) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <!-- No. Empleado -->
                        <div class="mb-3">
                            <x-input-label class="form-label" for="no_empleado{{ $empleado->no_empleado }}" :value="__('Numero de empleado')" />
                            <div class="input-group input-group-merge">
                                <x-text-input id="no_empleado{{ $empleado->no_empleado }}" class="form-control" type="text"
                                    name="no_empleado" placeholder="30045698" value="{{ $empleado->no_empleado }}" required
                                    autocomplete="no_empleado" />
                            </div>
                            <x-input-error :messages="$errors->get('no_empleado')" class="mt-2" />
                        </div>

                        <!-- Nombre -->
                        <div class="mb-3">
                            <x-input-label class="form-label" for="name{{ $empleado->name }}" :value="__('Nombre de empleado')" />
                            <div class="input-group input-group-merge">
                                <x-text-input id="name{{ $empleado->name }}" class="form-control" type="text"
                                    name="name" placeholder="Auixchik Mutula" value="{{ $empleado->name }}" required
                                    autocomplete="name" />
                            </div>
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <!-- Email -->
                        <div class="mb-3">
                            <x-input-label class="form-label" for="email{{ $empleado->email }}" :value="__('Correo electronico')" />
                            <div class="input-group input-group-merge">
                                <x-text-input id="email{{ $empleado->email }}" class="form-control" type="email"
                                    name="email" placeholder="ejemplo@correo.com" value="{{ $empleado->email }}" required
                                    autocomplete="email" />
                            </div>
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>

                        <!-- Puesto -->
                        <div class="mb-3">
                            <x-input-label class="form-label" for="puesto{{ $empleado->puesto }}" :value="__('Puesto')" />
                            <div class="input-group input-group-merge">
                                <x-text-input id="puesto{{ $empleado->puesto }}" class="form-control" type="text"
                                    name="puesto" placeholder="Soporte IT" value="{{ $empleado->puesto }}" required
                                    autocomplete="puesto" />
                            </div>
                            <x-input-error :messages="$errors->get('puesto')" class="mt-2" />
                        </div>

                        <!-- hotel -->
                        <div class="mb-3">
                            <label for="hotel_id">Hotel</label>
                            <select class="form-control" id="hotel_id" name="hotel_id"
                                aria-label="Default select example">
                                @foreach ($hoteles as $hotel)
                                    <option value="{{ $hotel->id }}"
                                        {{ $empleado->hotel_id == $hotel->id ? 'selected' : '' }}>
                                        {{ $hotel->name }}</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('hotel_id')" class="mt-2" />
                        </div>

                        <!-- Departamento -->
                        <div class="mb-3">
                            <label for="departamento_id">Departamento</label>
                            <select class="form-control" id="departamento_id" name="departamento_id"
                                aria-label="Default select example">
                                @foreach ($departamentos as $departamento)
                                    <option value="{{ $departamento->id }}"
                                        {{ $empleado->departamento_id == $departamento->id ? 'selected' : '' }}>
                                        {{ $departamento->name }}</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('departamento_id')" class="mt-2" />
                        </div>

                        <!-- AD -->
                        <div class="mb-3">
                            <x-input-label class="form-label" for="ad{{ $empleado->ad }}" :value="__('AD')" />
                            <div class="input-group input-group-merge">
                                <x-text-input id="ad{{ $empleado->ad }}" class="form-control" type="text"
                                    name="ad" placeholder="Soporte IT" value="{{ $empleado->ad }}" required
                                    autocomplete="ad" />
                            </div>
                            <x-input-error :messages="$errors->get('ad')" class="mt-2" />
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