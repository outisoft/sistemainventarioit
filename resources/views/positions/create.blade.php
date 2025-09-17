<!--Modal create-->
<div class="col-lg-4 col-md-6">
    <form method="POST" action="{{ route('positions.store') }}">
        @csrf
        <div class="mt-3">
            <div class="modal fade" id="modalCreate" aria-labelledby="modalCreate" tabindex="-1" style="display: none"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="modalCreate">New position</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><span
                                    aria-hidden="true"></span></button>
                        </div>

                        <div class="modal-body">
                            @include('positions._form')
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>


