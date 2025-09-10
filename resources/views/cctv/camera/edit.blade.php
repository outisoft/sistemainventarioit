<!-- Modales de Edición -->
@foreach ($cameras as $camera)
    <div class="modal fade" id="editModal{{ $camera->id }}" tabindex="-1" aria-labelledby="editModal{{ $camera->id }}"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('cctv-camera.update', $camera) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="modal-header">
                        <h5 class="modal-title" id="editModal{{ $camera->id }}">Edit camera</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        @include('cctv.camera._form', ['camera' => $camera])
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
