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
            <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">
                    <a href="{{ route('tpvs.index') }}" class="btn-ico" data-toggle="tooltip" data-placement="top"
                        title="Regresar">
                        <span>
                            <i class='bx bx-arrow-back'></i>
                        </span>
                    </a>
                    / Tablet /</span> Detalles </h4>

                    <!-- Basic Bootstrap Table -->
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="card-header">Detalles de <strong>{{ $tpv->name }}</strong></h5>
                        </div>

                        <div class="content-wrapper">
                            <div class="table-responsive text-nowrap">
                                <div class="card-datatable table-responsive pt-0">
                                    <div class="card-body">
                                        <table class="table" BORDER=1 CELLPADDING=5 CELLSPACING=5>
                                            <tr>
                                                <th class="bg-secondary">Area</th>
                                                <td>{{ $tpv->area }}</td>
                                            </tr>
                                            <tr>
                                                <th class="bg-secondary">Hotel</th>
                                                <td>{{ $hotel->nombre }}</td>
                                            </tr>
                                            <tr>
                                                <th class="bg-secondary">Equipo</th>
                                                <td>{{ $tpv->equipment }}</td>
                                            </tr>
                                            <tr>
                                                <th class="bg-secondary">Marca</th>
                                                <td>{{ $tpv->brand }}</td>
                                            </tr>
                                            <tr>
                                                <th class="bg-secondary">Modelo</th>
                                                <td>{{ $tpv->model }}</td>
                                            </tr>
                                            <tr>
                                                <th class="bg-secondary">Numero de serie</th>
                                                <td>{{ $tpv->no_serial }}</td>
                                            </tr>
                                            <tr>
                                                <th class="bg-secondary">Nombre</th>
                                                <td>{{ $tpv->name }}</td>
                                            </tr>
                                            <tr>
                                                <th class="bg-secondary">IP</th>
                                                <td>{{ $tpv->ip }}</td>
                                            </tr>
                                            <tr>
                                                <th class="bg-secondary">Link</th>
                                                <td>{{ $tpv->link }}</td>
                                            </tr>
                                        </table>
                                        <br>
                                        <a href="{{ route('tpvs.index') }}" class="btn btn-secondary"><i
                                                class='bx bx-arrow-back'></i>Volver</a>
                                        @can('empleados.edit')
                                            <a href="{{ route('tpvs.edit', $tpv->id) }}" class="btn btn-primary">
                                                <i class="bx bx-edit me-1"></i>
                                                Editar
                                            </a>
                                        @endcan
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
</x-app-layout>
