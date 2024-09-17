<!-- Modales de Edición -->
@foreach($users as $user)
    <div class="modal fade" id="editModal{{ $user->id }}" tabindex="-1" aria-labelledby="editModal{{ $user->id }}" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModal{{ $user->id }}">Editar Usuario: {{ $user->name }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('users.update', $user->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label class="form-label" for="name">Nombre</label>
                            <x-text-input type="text" name="name" class="form-control"
                                value="{{ $user->name }}" required />
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="email">Email</label>
                            <x-text-input type="email" name="email" class="form-control"
                                value="{{ $user->email }}" required />
                        </div>

                        <!-- hotel -->
                        <div class="mb-3">
                            <label for="rol">Rol</label>
                            <select name="rol" id="rol" class="form-control">
                                @foreach ($roles as $role)
                                    <option value="{{ $role->name }}" {{ $role->name == $role ? 'selected' : '' }}>
                                        {{ $role->name }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('rol')" class="mt-2" />
                        </div>

                        <div class="form-group">
                                <label class="form-label" for="password">Contraseña</label>
                                <x-text-input type="password" name="password" class="form-control" />
                        </div>
                        <br>

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
