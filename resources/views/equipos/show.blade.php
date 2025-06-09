<x-app-layout>
    <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-style1">
                    <li class="breadcrumb-item">
                        <a href="{{ route('equipo.index') }}">EQUIPMENTS</a>
                    </li>
                    <li class="breadcrumb-item active fw-bold">DETAILS</li>
                </ol>
            </nav>

            <!-- Basic Bootstrap Table -->
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-header">DETAILS <strong>{{ $equipo->name }}</strong></h5>
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
                                    <tr>
                                        <th class="bg-secondary">ASSIGNED TO...</th>
                                        <td>
                                            @if ($equipo->positions->count() > 0)
                                                @foreach ($equipo->positions as $position)
                                                    {{ $position->employee->name ?? 'N/A' }} -
                                                    ({{ $position->position }})
                                                @endforeach
                                            @else
                                                To no assigned equipment
                                            @endif
                                        </td>
                                    </tr>
                                </table>
                                <br>
                                <a href="{{ route('equipo.index') }}" class="btn btn-secondary"><i
                                        class='bx bx-arrow-back'></i>Volver</a>
                            </div>
                        </div>
                    </div>

                    @if ($complementosAsignados->count() > 0)
                        <div class="card-header">
                            <h6 class="card-header">ASSIGNED COMPLEMENT</strong></h6>
                        </div>
                        <div class="table-responsive text-nowrap" id="searchResults">
                            <table id="empleados" class="table">
                                <thead class="bg-primary">
                                    <tr>
                                        <th>EQUIPMENT TYPE</th>
                                        <th>BRAND</th>
                                        <th>MODEL</th>
                                        <th>SERIAL</th>
                                    </tr>
                                </thead>
                                <tbody id="employeeList">
                                    <!-- Aquí se mostrarán los empleados -->
                                    @foreach ($complementosAsignados as $complemento)
                                        <tr>
                                            <td>
                                                {{ $complemento->type->name }}
                                            </td>
                                            <td>
                                                {{ $complemento->brand }}
                                            </td>
                                            <td>
                                                {{ $complemento->model }}
                                            </td>
                                            <td>
                                                {{ $complemento->serial }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="card-header">
                            <p>No complement(s) assigned. <a href="{{ route('complements.index') }}"> Add complement(s)
                                    -></a></p>
                        </div>
                    @endif
                </div>
            </div>
            <!--/ Basic Bootstrap Table -->

            <hr class="my-5" />

        </div>
        <!-- / Content -->
    </div>
</x-app-layout>
