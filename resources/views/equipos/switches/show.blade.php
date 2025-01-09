<x-app-layout>
    <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">
                    <a href="{{ route('switches.index') }}" class="btn-ico" data-toggle="tooltip" data-placement="top"
                        title="Regresar">
                        <span>
                            <i class='bx bx-arrow-back'></i>
                        </span>
                    </a>
                    / Switch /</span> Details </h4>

            <!-- Basic Bootstrap Table -->
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-header">Details <strong>{{ $switch->name }}</strong></h5>
                </div>

                <div class="content-wrapper">
                    <div class="table-responsive text-nowrap">
                        <div class="card-datatable table-responsive pt-0">
                            <div class="card-body">
                                <table class="table" BORDER=1 CELLPADDING=5 CELLSPACING=5>
                                    <tr>
                                        <th class="bg-secondary">Brand</th>
                                        <td>{{ $switch->marca }}</td>
                                    </tr>
                                    <tr>
                                        <th class="bg-secondary">Modelo</th>
                                        <td>{{ $switch->model }}</td>
                                    </tr>
                                    <tr>
                                        <th class="bg-secondary">Numero de serie</th>
                                        <td>{{ $switch->serial }}</td>
                                    </tr>
                                    <tr>
                                        <th class="bg-secondary">Mac Address</th>
                                        <td>{{ $switch->mac }}</td>
                                    </tr>
                                    <tr>
                                        <th class="bg-secondary">IP</th>
                                        <td>{{ $switch->ip }}</td>
                                    </tr>
                                    <tr>
                                        <th class="bg-secondary">Total Port</th>
                                        <td>{{ $switch->total_ports }}</td>
                                    </tr>
                                </table>
                                <br>
                                <h4>Access Points</h4>
                                <table class="table" CELLPADDING=5 CELLSPACING=5>
                                    <thead>
                                        <tr>
                                            <th class="bg-secondary">Name</th>
                                            <th class="bg-secondary">Brand</th>
                                            <th class="bg-secondary">Model</th>
                                            <th class="bg-secondary">Serial</th>
                                            <th class="bg-secondary">Mac Address</th>
                                            <th class="bg-secondary">IP</th>
                                            <th class="bg-secondary">Port</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($switch->accessPoints as $ap)
                                            <tr>
                                                <td>{{ $ap->name }}</td>
                                                <td>{{ $ap->marca }}</td>
                                                <td>{{ $ap->model }}</td>
                                                <td>{{ $ap->serial }}</td>
                                                <td>{{ $ap->mac }}</td>
                                                <td>{{ $ap->ip }}</td>
                                                <td>{{ $ap->port_number }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <br>
                                <a href="{{ route('switches.index') }}" class="btn btn-secondary"><i
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
