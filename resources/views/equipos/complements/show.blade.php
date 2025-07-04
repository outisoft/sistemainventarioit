<x-app-layout>
    <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-style1">
                    <li class="breadcrumb-item">
                        <a href="{{ route('equipo.index') }}">EQUIPMENTS</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('complements.index') }}">COMPLEMENTS</a>
                    </li>
                    <li class="breadcrumb-item active fw-bold">DETAILS</li>
                </ol>
            </nav>

            <!-- Basic Bootstrap Table -->
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-header">Details <strong>{{ $complement->name }}</strong></h5>
                </div>

                <div class="content-wrapper">
                    <div class="table-responsive text-nowrap">
                        <div class="card-datatable table-responsive pt-0">
                            <div class="card-body">
                                <table class="table" BORDER=1 CELLPADDING=5 CELLSPACING=5>
                                    <tr>
                                        <th class="bg-secondary">Type</th>
                                        <td>{{ $complement->type->name }}</td>
                                    </tr>

                                    @if (!empty($complement->tipo_conexion))
                                        <tr>
                                            <th class="bg-secondary">Tipo de conexión</th>
                                            <td>{{ $complement->tipo_conexion }}</td>
                                        </tr>
                                    @endif

                                    @if (!empty($complement->tipo_presentacion))
                                        <tr>
                                            <th class="bg-secondary">Tipo de presentacion</th>
                                            <td>{{ $complement->tipo_presentacion }}</td>
                                        </tr>
                                    @endif

                                    <tr>
                                        <th class="bg-secondary">Brand</th>
                                        <td>{{ $complement->brand }}</td>
                                    </tr>
                                    <tr>
                                        <th class="bg-secondary">Modelo</th>
                                        <td>{{ $complement->model }}</td>
                                    </tr>
                                    <tr>
                                        <th class="bg-secondary">Numero de serie / CT</th>
                                        <td>{{ $complement->serial }}</td>
                                    </tr>
                                    <tr>
                                        <th class="bg-secondary">ASSIGNED TO...</th>
                                        <td>
                                            @if ($complement->equipments->count() > 0)
                                                @foreach ($complement->equipments as $equipment)
                                                    {{ $equipment->name }}
                                                @endforeach
                                            @else
                                                To no assigned equipment
                                            @endif
                                        </td>
                                    </tr>
                                </table>
                                <br>
                                <a href="{{ route('complements.index') }}" class="btn btn-secondary"><i
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
