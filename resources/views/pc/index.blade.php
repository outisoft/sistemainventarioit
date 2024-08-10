<x-app-layout>
    @section('css')
        <link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    @endsection

    <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Equipos /</span> PC's & Laptops </h4>

            <!-- Basic Bootstrap Table -->
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-header">PC's & Laptops</h5>
                    <div class="navbar-nav align-items-center">
                        <div class="nav-item d-flex align-items-center">
                            <a href="#" class="btn-ico" data-toggle="modal" data-target="#modalCreate"
                                data-placement="top" title="Agregar Nuevo Registro">
                                <i class='bx bx-add-to-queue icon-lg'></i>
                            </a>
                        </div>
                    </div>
                </div>

                @include('pc.create')
                <div class="content-wrapper">
                    <div class="table-responsive text-nowrap">
                        <div class="card-datatable table-responsive pt-0">
                            <div class="card-datatable table-responsive pt-0">
                            <table class="table">
                                    <thead class="bg-primary">
                                        <tr>
                                            <th>Empleado</th>
                                            <th>Ubicacion</th>
                                            <th>Equipo</th>
                                            <th colspan="2">Acciones</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($pcs as $pc)
                                            <tr>
                                                <td>{{ $pc->empleado->name }}</td>
                                                <td>
                                                {{ $pc->empleado->departamento->name }} de {{ $pc->empleado->hotel->name }}
                                                </td>
                                                <td>
                                                    {{ $pc->name }}
                                                </td>
                                                <td width="10px">
                                                    @can('roles.edit')
                                                        <a href="#" data-bs-toggle="modal" data-bs-target="#editRoleModal{{ $pc->id }}" class="btn btn-sm btn-primary">Editar</a>
                                                    @endcan
                                                </td>
                                                <td width="10px">
                                                    @can('roles.destroy')
                                                        <form action="{{ route('pc.destroy', $pc) }} " onclick="return confirm('¿Estás seguro de eliminar este equipo?')"  method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit"
                                                                class="btn btn-sm btn-danger">Eliminar</button>
                                                        </form>
                                                    @endcan
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
            <!--/ Basic Bootstrap Table -->
        </div>
        <!-- / Content -->
    </div>
</x-app-layout>