<!-- Modales de Edición -->
@foreach($departamentos as $department)
    <div class="modal fade" id="editModal{{ $department->id }}" tabindex="-1" aria-labelledby="editModal{{ $department->id }}" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('departments.update', $department) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModal{{ $department->id }}">Edit</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">                        
                        <!-- Nombre de equipo -->
                        <div class="mb-3">
                            <x-input-label class="form-label" for="name{{ $department->name }}" :value="__('Department')" />
                            <div class="input-group input-group-merge">
                                <x-text-input id="name{{ $department->name }}" class="form-control" type="text"
                                    name="name" placeholder="HP" value="{{ $department->name }}" required
                                    autocomplete="name" />
                            </div>
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
@endforeach