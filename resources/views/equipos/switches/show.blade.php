<x-app-layout>
    <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">

            <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-style1">
                    <li class="breadcrumb-item">
                        <a href="{{ route('switches.index') }}">SWITCHES</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('hotels.switches', $switch->hotel->id) }}">{{ $switch->hotel->name }}</a>
                    </li>
                    <li class="breadcrumb-item active fw-bold">DETAILS</li>
                </ol>
            </nav>
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-header">DETAILS <strong>{{ $switch->name }}</strong></h5>
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

                                @if ($switch->accessPoints->isEmpty())
                                @else
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
                                @endif

                                <!-- BREACK ASIGNADO -->
                                @if ($switch->breack->isNotEmpty())
                                    <div class="card">
                                        <div class="col-12">
                                            <ul class="list-group list-group-horizontal-md">
                                                @foreach ($switch->breack as $breack)
                                                    <li class="list-group-item flex-fill p-6 text-body">
                                                        <h6 class="d-flex align-items-center gap-2">
                                                            <i class='icon-base bx bxs-car-battery'></i>
                                                            NO BREACK
                                                        </h6>
                                                        <address class="mb-0">
                                                            {{ $breack->serial }},<br>
                                                            {{ $breack->brand }}, {{ $breack->model }}<br>
                                                        </address>
                                                        <p class="col-12 text-center d-flex aling-items-center">
                                                        <form
                                                            action="{{ route('breack.desasignar', ['switch' => $switch->id, 'breack' => $breack->id]) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger d-grid"><i
                                                                    class='bx bx-trash'></i>
                                                            </button>
                                                        </form>
                                                        </p>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                    <br>
                                @else
                                    <!-- LISTADO DE BREACKS -->
                                    <div class="card-header">
                                        <p>ASSIGN COMPLEMENTS</p>
                                    </div>
                                    <div class="card-body">
                                        <table id="officees" class="table footer">
                                            <thead class="bg-primary">
                                                <tr>
                                                    <th>TYPE</th>
                                                    <th>BRAND</th>
                                                    <th>MODEL</th>
                                                    <th>SERIAL</th>
                                                    <th>Acciones</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($cDisponibles as $complemento)
                                                    <tr>
                                                        <td>{{ $complemento->type->name }}</td>
                                                        <td>{{ $complemento->brand }}</td>
                                                        <td>{{ $complemento->model }}</td>
                                                        <td>{{ $complemento->serial }}</td>
                                                        <td>
                                                            <form action="{{ route('breack.asignar', $switch) }}"
                                                                method="POST">
                                                                @csrf
                                                                <input type="hidden" name="complements_id[]"
                                                                    value="{{ $complemento->id }}">
                                                                <button type="submit"
                                                                    class="btn btn-primary btn-sm">Asignar</button>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                @endif
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
