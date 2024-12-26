<div x-data="{ isOpen: false }" @keydown.window.prevent.cmd.k.stop="isOpen = true"
    @keydown.window.prevent.ctrl.k.stop="isOpen = true" @keydown.window.escape="isOpen = false">
    <!-- Botón de búsqueda -->
    <div class="navbar-nav align-items-center">
        <div class="nav-item d-flex align-items-center">
            <i class="bx bx-search bx-md"></i>
            <button @click="isOpen = true" type="text" class="form-control border-0 shadow-none ps-1 ps-sm-2">
                <span class="ml-2 text-sm text-gray-500">Search...
                    <span class="ml-2 text-gray-400">Ctrl + K</span>
                </span>
            </button>
        </div>
    </div>

    <!-- Modal de búsqueda -->
    <div x-show="isOpen">
        <div aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel1">Search</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col mb-6">
                                <label for="nameBasic" class="form-label">Search...</label>
                                <input type="text" id="nameBasic" class="form-control" placeholder="Search..." />
                            </div>
                        </div>
                        <div class="row g-6">
                            <div class="col mb-0">
                                <label for="emailBasic" class="form-label">Email</label>
                                <input type="email" id="emailBasic" class="form-control" placeholder="xxxx@xxx.xx" />
                            </div>
                            <div class="col mb-0">
                                <label for="dobBasic" class="form-label">DOB</label>
                                <input type="date" id="dobBasic" class="form-control" />
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                            Close
                        </button>
                        <button type="button" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
