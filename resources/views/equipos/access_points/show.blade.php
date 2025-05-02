<x-app-layout>
    <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-style1">
                    <li class="breadcrumb-item">
                        REDES
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('access-points.index') }}">ACCESS POINTS</a>
                    </li>
                    <li class="breadcrumb-item active fw-bold">DETAILS</li>
                </ol>
            </nav>

            <!-- Basic Bootstrap Table -->
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-header">Details <strong>{{ $accessPoint->name }}</strong></h5>
                </div>

                <div class="content-wrapper">
                    <div class="table-responsive text-nowrap">
                        <div class="card-datatable table-responsive pt-0">
                            <div class="card-body">
                                <table class="table" BORDER=1 CELLPADDING=5 CELLSPACING=5>
                                    <tr>
                                        <th class="bg-secondary">Brand</th>
                                        <td>{{ $accessPoint->marca }}</td>
                                    </tr>
                                    <tr>
                                        <th class="bg-secondary">Modelo</th>
                                        <td>{{ $accessPoint->model }}</td>
                                    </tr>
                                    <tr>
                                        <th class="bg-secondary">Numero de serie</th>
                                        <td>{{ $accessPoint->serial }}</td>
                                    </tr>
                                    <tr>
                                        <th class="bg-secondary">Mac Address</th>
                                        <td>{{ $accessPoint->mac }}</td>
                                    </tr>
                                    <tr>
                                        <th class="bg-secondary">IP</th>
                                        <td>{{ $accessPoint->ip }}</td>
                                    </tr>
                                    <tr>
                                        <th class="bg-secondary">Switch conectado</th>
                                        <td>{{ $swittch->name }}</td>
                                    </tr>
                                    <tr>
                                        <th class="bg-secondary">Puerto en uso</th>
                                        <td>{{ $accessPoint->port_number }}</td>
                                    </tr>
                                </table>
                                <br>
                                <a href="{{ route('access-points.index') }}" class="btn btn-secondary"><i
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
