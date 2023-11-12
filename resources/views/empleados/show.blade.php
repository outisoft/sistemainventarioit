<x-app-layout>
    <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Empleados /</span> Detalles </h4>

            <!-- Basic Bootstrap Table -->
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-header">Detalles de <strong>{{ $registro->name }}</strong></h5>
                </div>

                <div class="content-wrapper">
                    <div class="table-responsive text-nowrap">
                        <div class="card-datatable table-responsive pt-0">
                            <div class="card-body">
                                <table class="table" BORDER=1 CELLPADDING=5 CELLSPACING=5>
                                    <tr>
                                        <th class="bg-secondary">No. Colaborador</th>
                                        <td>{{ $registro->no_empleado }}</td>
                                    </tr>
                                    <tr>
                                        <th class="bg-secondary">Nombre</th>
                                        <td>{{ $registro->name }}</td>
                                    </tr>
                                    <tr>
                                        <th class="bg-secondary">Correo</th>
                                        <td>{{ $registro->email }}</td>
                                    </tr>
                                    <tr>
                                        <th class="bg-secondary">Puesto</th>
                                        <td>{{ $registro->puesto }}</td>
                                    </tr>
                                    <tr>
                                        <th class="bg-secondary">Departamento</th>
                                        <td>{{ $departamento->name }}</td>
                                    </tr>
                                    <tr>
                                        <th class="bg-secondary">Hotel</th>
                                        <td>{{ $hotel->nombre }}</td>
                                    </tr>
                                    <tr>
                                        <th class="bg-secondary">AD</th>
                                        <td>{{ $registro->ad }}</td>
                                    </tr>
                                </table>
                                <br>
                                <a href="{{ route('empleados.index') }}" class="btn btn-secondary"><i
                                        class='bx bx-arrow-back'></i>Volver</a>
                                @can('empleados.edit')
                                    <a href="{{ route('empleados.edit', $registro->id) }}" class="btn btn-primary">
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
