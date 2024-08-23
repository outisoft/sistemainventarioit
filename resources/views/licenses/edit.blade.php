<!-- Modales de Edición -->
@foreach($equipos as $equipo)
    <div class="modal fade" id="editModal{{ $equipo->id }}" tabindex="-1" aria-labelledby="editModal{{ $equipo->id }}" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModal{{ $equipo->id }}">Editar Office</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('licenses.update', $equipo) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <!-- email -->
                        <div class="mb-3">
                            <x-input-label class="form-label" for="email{{ $equipo->email }}" :value="__('Correo Ofice')" />
                            <div class="input-group input-group-merge">
                                <x-text-input id="email{{ $equipo->email }}" class="form-control" type="email"
                                    name="email" placeholder="HP" value="{{ $equipo->email }}" required
                                    autocomplete="email" />
                            </div>
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>

                        <!-- password -->
                        <div class="mb-3">
                            <x-input-label class="form-label" for="password{{ $equipo->password }}" :value="__('Password')" />
                            <div class="input-group input-group-merge">
                                <x-text-input id="password{{ $equipo->password }}" class="form-control" type="text"
                                    name="password" placeholder="HP" value="{{ $equipo->password }}" required
                                    autocomplete="password" />
                            </div>
                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
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