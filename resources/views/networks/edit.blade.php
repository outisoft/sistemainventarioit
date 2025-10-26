<!-- Modales de Edición -->
@foreach ($networks as $network)
    <div class="modal fade" id="editModal{{ $network->id }}" tabindex="-1" aria-labelledby="editModal{{ $network->id }}"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('networks.update', $network) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModal{{ $network->id }}">Edit Network</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    
                    @include('networks._form')

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endforeach
