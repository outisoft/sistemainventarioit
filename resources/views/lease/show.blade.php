<x-app-layout>
    <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-style1">
                    <li class="breadcrumb-item">
                        <a href="{{ route('lease.index') }}">LEASES</a>
                    </li>
                    <li class="breadcrumb-item active fw-bold">DETAILS</li>
                </ol>
            </nav>

            @if ($lease->equipments->isNotEmpty())
                <div class="card">
                    <div class="content-wrapper">
                        <div class="table-responsive text-nowrap">
                            <div class="card-datatable table-responsive pt-0">
                                <div class="card-body">
                                    <br>
                                    <P class="card-title"><strong>LEASE:</strong> {{ $lease->lease }}</P>
                                    <P class="card-title"><strong>END DATE:</strong> {{ $lease->end_date }}</P>
                                    <p class="card-title"><strong>TOTAL EQUIPMENT:</strong>
                                        {{ $lease->equipments->count() }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="content-wrapper">
                        <div class="table-responsive text-nowrap">
                            <div class="card-datatable table-responsive pt-0">
                                <div class="table-responsive text-nowrap" id="searchResults">
                                    <table id="lease_info" class="table">
                                        <thead class="bg-primary">
                                            <tr>
                                                <th>TYPE</th>
                                                <th>EMPLOYEE</th>
                                                <th>LOCATION</th>
                                                <th>BRAND</th>
                                                <th>MODEL</th>
                                                <th>SERIAL</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody id="employeeList">
                                            <!-- Listado de equipos -->
                                            @foreach ($lease->equipments->chunk(4) as $equipos)
                                                @foreach ($equipos as $equipo)
                                                    <tr>
                                                        <td> {{ $equipo->tipo->name }} </td>
                                                        <td>
                                                            @if ($equipo->employees->isNotEmpty())
                                                                @php
                                                                    $empleado = $equipo->employees->first();
                                                                @endphp
                                                                {{ $empleado ? $empleado->name : 'SIN ASIGNAR' }}
                                                            @else
                                                                SIN ASIGNAR
                                                            @endif
                                                        </td>
                                                        <td>
                                                            @if ($equipo->empleados->isNotEmpty() && $equipo->empleados->first()->hotel)
                                                                {{ $equipo->empleados->first()->hotel->name }} -
                                                                {{ optional($equipo->empleados->first()->departments)->name }}
                                                            @else
                                                                HOTEL NO ASIGNADO
                                                            @endif
                                                        </td>
                                                        <td>{{ $equipo->marca }}</td>
                                                        <td>{{ $equipo->model }}</td>
                                                        <td>{{ $equipo->serial }}</td>
                                                        <td>
                                                            <div class="dropdown">
                                                                <button type="button"
                                                                    class="btn p-0 dropdown-toggle hide-arrow"
                                                                    data-bs-toggle="dropdown">
                                                                    <i class="bx bx-dots-vertical-rounded"></i>
                                                                </button>
                                                                <div class="dropdown-menu">
                                                                    @can('lease.show')
                                                                        <a class="dropdown-item"
                                                                            href="{{ route('details', $equipo->id) }}"><i
                                                                                class="bx bx-show-alt me-1"></i>Show
                                                                        </a>
                                                                    @endcan
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @endforeach

                                            <!-- Listado de complementos -->
                                            @foreach ($lease->complements as $complement)
                                                <tr>
                                                    <td> {{ $complement->type->name }} </td>

                                                    <td>
                                                        @if ($complement->equipments->isNotEmpty())
                                                            @php
                                                                $empleado = $complement->equipments
                                                                    ->first()
                                                                    ->empleados->first();
                                                            @endphp
                                                            {{ $empleado ? $empleado->name : 'SIN ASIGNAR' }}
                                                        @else
                                                            SIN ASIGNAR
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if ($complement->equipments->isNotEmpty())
                                                            @php
                                                                $empleado = $complement->equipments
                                                                    ->first()
                                                                    ->empleados->first();
                                                            @endphp
                                                            @if ($empleado && $empleado->hotel)
                                                                {{ $empleado->hotel->name }} -
                                                                {{ $empleado->departments->name }}
                                                            @else
                                                                HOTEL NO ASIGNADO
                                                            @endif
                                                        @else
                                                            HOTEL NO ASIGNADO
                                                        @endif
                                                    </td>
                                                    <td>{{ $complement->brand }}</td>
                                                    <td>{{ $complement->model }}</td>
                                                    <td>{{ $complement->serial }}</td>
                                                    <td>
                                                        <div class="dropdown">
                                                            <button type="button"
                                                                class="btn p-0 dropdown-toggle hide-arrow"
                                                                data-bs-toggle="dropdown">
                                                                <i class="bx bx-dots-vertical-rounded"></i>
                                                            </button>
                                                            <div class="dropdown-menu">
                                                                @can('complements.show')
                                                                    <a class="dropdown-item"
                                                                        href="{{ route('complements.show', $complement->id) }}"><i
                                                                            class="bx bx-show-alt me-1"></i>Show
                                                                    </a>
                                                                @endcan
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach

                                            <!-- Listado de tpvs -->
                                            @foreach ($lease->tpvs as $tpv)
                                                <tr>
                                                    <td>TPV</td>
                                                    <td>
                                                        SIN ASIGNAR
                                                    </td>
                                                    <td>
                                                        {{ $tpv->departments->name }} /
                                                        {{ $tpv->hotel->name }}
                                                    </td>
                                                    <td>{{ $tpv->brand }}</td>
                                                    <td>{{ $tpv->model }}</td>
                                                    <td>{{ $tpv->no_serial }}</td>
                                                    <td>
                                                        <div class="dropdown">
                                                            <button type="button"
                                                                class="btn p-0 dropdown-toggle hide-arrow"
                                                                data-bs-toggle="dropdown">
                                                                <i class="bx bx-dots-vertical-rounded"></i>
                                                            </button>
                                                            <div class="dropdown-menu">
                                                                @can('tpvs.show')
                                                                    <a class="dropdown-item"
                                                                        href="{{ route('tpvs.show', $tpv->id) }}"><i
                                                                            class="bx bx-show-alt me-1"></i>Show
                                                                    </a>
                                                                @endcan
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            <br>

            <!--info de asignados -->
            <br>
            <a href="{{ route('lease.index') }}" class="btn btn-secondary"><i class='bx bx-arrow-back'></i>Volver</a>

            <hr class="my-5" />

        </div>
        <!-- / Content -->
    </div>
</x-app-layout>
