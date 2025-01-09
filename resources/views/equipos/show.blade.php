<x-app-layout>
    <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">
                    <a href="{{ route('equipo.index') }}" class="btn-ico" data-toggle="tooltip" data-placement="top"
                        title="Regresar">
                        <span>
                            <i class='bx bx-arrow-back'></i>
                        </span>
                    </a>
                    / Equipment /</span> Details </h4>

            <!-- Basic Bootstrap Table -->
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-header">Details <strong>{{ $equipo->name }}</strong></h5>
                </div>

                <div class="content-wrapper">
                    <div class="table-responsive text-nowrap">
                        <div class="card-datatable table-responsive pt-0">
                            <div class="card-body">
                                <table class="table" BORDER=1 CELLPADDING=5 CELLSPACING=5>
                                    <tr>
                                        <th class="bg-secondary">Type</th>
                                        <td>{{ $equipo->tipo->name }}</td>
                                    </tr>
                                    <tr>
                                        <th class="bg-secondary">Brand</th>
                                        <td>{{ $equipo->marca }}</td>
                                    </tr>
                                    <tr>
                                        <th class="bg-secondary">Modelo</th>
                                        <td>{{ $equipo->model }}</td>
                                    </tr>
                                    <tr>
                                        <th class="bg-secondary">Numero de serie</th>
                                        <td>{{ $equipo->serial }}</td>
                                    </tr>
                                    <tr>
                                        <th class="bg-secondary">IP</th>
                                        <td>{{ $equipo->ip }}</td>
                                    </tr>
                                    <tr>
                                        <th class="bg-secondary">SO</th>
                                        <td>{{ $equipo->so }}</td>
                                    </tr>
                                </table>
                                <br>
                                <a href="{{ route('equipo.index') }}" class="btn btn-secondary"><i
                                        class='bx bx-arrow-back'></i>Volver</a>
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
