<x-app-layout>
    <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Inventario /</span> Nuevo </h4>

            <!-- Basic Bootstrap Table -->
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-header">Nuevo Registro</h5>
                </div>
                
                <div class="table-responsive text-nowrap">
                    <div class="card-body">
                        <form action="{{ route('inventario.store') }}" method="POST">
                            @csrf
                            <!-- Equipo -->
                            <div class="mb-3">
                                <label class="form-label" for="basic-icon-default-fullname">Nombre</label>
                                <div class="input-group input-group-merge">
                                    <span id="basic-icon-default-fullname2" class="input-group-text">
                                        <i class='bx bx-desktop'></i>
                                    </span>
                                    <x-text-input type="text" class="form-control" id="nombre"  name="nombre" placeholder="Lenovo" aria-label="Lenovo" aria-describedby="basic-icon-default-fullname2" required autofocus autocomplete="nombre" />
                                    <x-input-error :messages="$errors->get('nombre')" class="mt-2" />
                                </div>
                            </div>

                            <!-- ip -->
                            <div class="mb-3">
                                <label class="form-label" for="basic-icon-default-fullname">Cantidad</label>
                                <div class="input-group input-group-merge">
                                    <span id="basic-icon-default-fullname2" class="input-group-text">
                                        <i class='bx bx-broadcast'></i>
                                    </span>
                                    <x-text-input type="text" class="form-control" id="cantidad"  name="cantidad" placeholder="10.1.35.48" aria-label="10.1.35.48" aria-describedby="basic-icon-default-fullname2" required autofocus autocomplete="name" />
                                    <x-input-error :messages="$errors->get('Cantidad')" class="mt-2" />
                                </div>
                            </div>

                            <!-- Numero -->
                            <div class="mb-3">
                                <label class="form-label" for="basic-icon-default-fullname">Precio</label>
                                <div class="input-group input-group-merge">
                                    <span id="basic-icon-default-fullname2" class="input-group-text">
                                        <i class='bx bx-hash' ></i>
                                    </span>
                                    <x-text-input type="text" class="form-control" id="precio"  name="precio" placeholder="SG6T-SHD8-LPOI-FDK9-43DS" aria-label="SG6T-SHD8-LPOI-FDK9-43DS" aria-describedby="basic-icon-default-fullname2" required autofocus autocomplete="name" />
                                    <x-input-error :messages="$errors->get('precio')" class="mt-2" />
                                </div>
                            </div>

                            <!-- Hotel -->
                            <!--div class="mb-3">
                                <label class="form-label" for="basic-icon-default-fullname">Hotel</label>
                                <div class="input-group input-group-merge">
                                    <span id="basic-icon-default-fullname2" class="input-group-text">
                                        <i class='bx bxs-buildings' ></i>
                                    </span>
                                    <x-text-input type="text" class="form-control" id="name"  name="name" placeholder="Bahia Principe" aria-label="Bahia Principe" aria-describedby="basic-icon-default-fullname2" required autofocus autocomplete="name" />
                                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                                </div>
                            </div-->

                            <button type="submit" class="btn btn-secondary">Send</button>
                        </form>
                    </div>
                </div>
            </div>
            <!--/ Basic Bootstrap Table -->

            <hr class="my-5" />

        </div>
        <!-- / Content -->
    </div>
</x-app-layout>
