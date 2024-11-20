<!-- Modales de Edición -->
@foreach($users as $user)
    <div class="modal fade" id="editModal{{ $user->id }}" tabindex="-1" aria-labelledby="editModal{{ $user->id }}" aria-hidden="true">
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
                        <div class="form-group">
                            <label class="form-label" for="name">Name</label>
                            <x-text-input type="text" name="name" class="form-control"
                                value="{{ $user->name }}" required />
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="email">Email</label>
                            <x-text-input type="email" name="email" class="form-control"
                                value="{{ $user->email }}" required />
                        </div>
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
                        <div class="mb-3">
                            <label for="region_id">Region</label>
                            <select name="region_id" id="region_id" class="form-control">
                                @foreach ($regions as $region)
                                    <option value="{{ $region->id }}" {{ $region->name == $region ? 'selected' : '' }}>
                                        {{ $region->name }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('rol')" class="mt-2" />
                        </div>
                        <div class="form-group">
                                <label class="form-label" for="password">Pssword</label>
                                <x-text-input type="password" name="password" class="form-control" />
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
