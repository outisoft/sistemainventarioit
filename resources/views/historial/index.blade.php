<x-app-layout>
    <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"></span> Historial </h4>

            <!-- Basic Bootstrap Table -->
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-header">Historial</h5>
                </div>
                <div class="content-wrapper">
                    <div class="table-responsive text-nowrap">
                        <div class="card-datatable table-responsive pt-0">
                            <table id="equipos" class="table table-striped">
                                <thead class="bg-primary">
                                    <tr>
                                        <th></th>
                                        <th>Acción</th>
                                        <th>Descripción</th>
                                        <th>Usuario</th>
                                        <th>Fecha</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($historial as $registro)
                                        <tr>
                                            <td></td>
                                            <td>{{ $registro->accion }}</td>
                                            <td>{{ $registro->descripcion }}</td>
                                            <td>
                                                <div style="display: flex; align-items: center;">
                                                    <img src="{{ $registro->user->image }}" alt="user-avatar" class="employee-image"/>
                                                    <span class="employee-name" style="margin-left: 15px;">{{ Str::limit($registro->user->name, 20, '...'); }}</span>
                                                </div>
                                            </td>
                                            <td>{{ \Carbon\Carbon::parse($registro->created_at)->isoFormat('dddd D [de] MMMM [del] YYYY') }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!--/ Basic Bootstrap Table -->
        </div>
        <!-- / Content -->
    </div>
</x-app-layout>
