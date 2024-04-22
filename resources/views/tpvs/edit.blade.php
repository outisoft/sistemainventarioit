<x-app-layout>
    <div class="container-xxl navbar-expand-xl align-items-center">
        <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
            <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                <i class="bx bx-menu bx-sm"></i>
            </a>
        </div>
    </div>
    <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="fw-bold py-3 mb-4">
                <span class="text-muted fw-light">
                    <a href="{{ route('tpvs.index') }}" class="btn-ico" data-toggle="tooltip" data-placement="top"
                        title="Regresar">
                        <span>
                            <i class='bx bx-arrow-back'></i>
                        </span>
                    </a>
                    / Tpv /</span> Editar
            </h4>

            <!-- Basic Bootstrap Table -->
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-header">Editar Registro</h5>
                </div>
                <div class="content-wrapper">
                    <div class="table-responsive text-nowrap">
                        <div class="card-datatable table-responsive pt-0">
                            <div class="table-responsive text-nowrap">
                                <div class="card-body">
                                    <form action="{{ route('tpvs.update', $tpv->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')

                                        <div class="form-group">
                                            <label class="form-label" for="area">Area</label>
                                            <x-text-input type="text" name="area" class="form-control"
                                                value="{{ $tpv->area }}" required />
                                        </div>

                                        <div class="form-group">
                                            <label for="hotel_id">Hoteles:</label>
                                            <select class="form-control" id="hotel_id" name="hotel_id"
                                                aria-label="Default select example">
                                                @foreach ($hoteles as $hotel)
                                                    <option value="{{ $hotel->id }}"
                                                        {{ $tpv->hotel_id == $hotel->id ? 'selected' : '' }}>
                                                        {{ $hotel->nombre }}</option>
                                                @endforeach
                                            </select>
                                            <x-input-error :messages="$errors->get('hotel_id')" class="mt-2" />
                                        </div>

                                        <div class="form-group">
                                            <label class="form-label" for="equipment">Equipo</label>
                                            <x-text-input type="text" name="equipment" class="form-control"
                                                value="{{ $tpv->equipment }}" required />
                                        </div>

                                        <div class="form-group">
                                            <label class="form-label" for="brand">Marca</label>
                                            <x-text-input type="text" name="brand" class="form-control"
                                                value="{{ $tpv->brand }}" required />
                                        </div>

                                        <div class="form-group">
                                            <label class="form-label" for="model">Modelo</label>
                                            <x-text-input type="text" name="model" class="form-control"
                                                value="{{ $tpv->model }}" required />
                                        </div>

                                        <div class="form-group">
                                            <label class="form-label" for="no_serial">Numero de serie</label>
                                            <x-text-input type="text" name="no_serial" class="form-control"
                                                value="{{ $tpv->no_serial }}" required />
                                        </div>

                                        <div class="form-group">
                                            <label class="form-label" for="name">Nombre</label>
                                            <x-text-input type="text" name="name" class="form-control"
                                                value="{{ $tpv->name }}" required />
                                        </div>

                                        <div class="form-group">
                                            <label class="form-label" for="ip">IP</label>
                                            <x-text-input type="text" name="ip" class="form-control"
                                                value="{{ $tpv->ip }}" required />
                                        </div>

                                        <div class="form-group">
                                            <label class="form-label" for="link">Link</label>
                                            <x-text-input type="text" name="link" class="form-control"
                                                value="{{ $tpv->link }}" required />
                                        </div>

                                        <br>
                                        <br>
                                        <button type="submit" class="btn btn-primary"><i
                                                class='bx bx-refresh'></i>Actualizar</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--/ Basic Bootstrap Table -->

            <hr class="my-5" />

        </div>
        <!-- / Content -->
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Agregar un evento al cambio de rol para mostrarlo en el select
            const rolSelect = document.getElementById('rol');
            rolSelect.addEventListener('change', function() {
                const selectedOption = rolSelect.options[rolSelect.selectedIndex];
                selectedOption.selected = true;
            });
        });
    </script>
</x-app-layout>
