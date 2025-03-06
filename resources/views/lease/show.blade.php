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

            <!-- info de licensia -->
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
            </div>
            <br>

            @if ($lease->equipments->isNotEmpty())
                <div class="card">
                    <div class="content-wrapper">
                        <ul class="list-group list-group-horizontal-md">
                            @foreach ($lease->equipments as $equipo)
                                <li class="list-group-item flex-fill p-6 text-body">
                                    <h6 class="d-flex align-items-center gap-2"><i
                                            class='icon-base bx bx-desktop'></i>{{ $equipo->name }}
                                    </h6>
                                    <address class="mb-0">
                                        @if ($equipo->empleados->isNotEmpty())
                                            {{ $equipo->empleados->first()->name }}
                                        @else
                                            SIN ASIGNAR
                                        @endif <br>
                                        @if ($equipo->empleados->isNotEmpty() && $equipo->empleados->first()->hotel)
                                            {{ $equipo->empleados->first()->hotel->name }}-{{ $equipo->empleados->first()->departments->name }}<br>
                                        @else
                                            HOTEL NO ASIGNADO<br>
                                        @endif
                                        {{ $equipo->serial }},<br>
                                        {{ $equipo->marca }}, {{ $equipo->model }},<br>
                                    </address>
                                </li>
                            @endforeach
                        </ul>
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
