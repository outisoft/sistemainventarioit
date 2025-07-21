<!-- Modales de Edición -->
@foreach ($users as $user)
    <div class="modal fade" id="editModal{{ $user->id }}" tabindex="-1" aria-labelledby="editModal{{ $user->id }}"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('users.update', $user->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModal{{ $user->id }}">User: {{ $user->name }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <x-input-label class="form-label" for="name" :value="__('Name')" />
                            <x-text-input type="text" name="name" class="form-control" value="{{ $user->name }}"
                                required />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <div class="form-group">
                            <x-input-label class="form-label" for="email" :value="__('Email')" />
                            <x-text-input type="email" name="email" class="form-control" value="{{ $user->email }}"
                                required />
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>

                        <div class="mb-3">
                            <x-input-label class="form-label" for="rol" :value="__('Rol')" />
                            <select name="rol" id="rol" class="form-control">
                                @foreach ($roles as $role)
                                    <option value="{{ $role->name }}"
                                        {{ $user->roles->contains('name', $role->name) ? 'selected' : '' }}>
                                        {{ $role->name }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('rol')" class="mt-2" />
                        </div>
                        <div class="mb-3">
                            <x-input-label class="form-label" for="regions" :value="__('Region')" />
                            <select class="form-control select2" id="regions" name="regions[]" multiple
                                aria-label="Default select example">
                                @foreach ($regions as $region)
                                    <option value="{{ $region->id }}"
                                        {{ in_array($region->id, $user->regions->pluck('id')->toArray()) ? 'selected' : '' }}>
                                        {{ $region->name }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('regions')" class="mt-2" />
                        </div>

                        <!-- Password -->
                        <div class="form-group">
                            <x-input-label class="form-label" for="password" :value="__('Nueva Contraseña')" />
                            <div class="input-group input-group-merge">
                                <x-text-input id="password" name="password" type="password" class="form-control"
                                    autocomplete="new-password" />
                                <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
                            </div>
                        </div>

                        <div class="form-group">
                            <x-input-label class="form-label" for="password_confirmation" :value="__('Confirmar Contraseña')" />
                            <div class="input-group input-group-merge">
                                <x-text-input id="password_confirmation" name="password_confirmation" type="password"
                                    class="form-control" autocomplete="new-password" />
                                <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
                            </div>
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
