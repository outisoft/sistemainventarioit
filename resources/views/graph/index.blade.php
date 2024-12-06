<x-app-layout>
    <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">

            <!-- Basic Bootstrap Table -->
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-header">MICROSOFT 365</h5>
                </div>
                <div class="content-wrapper">
                    <div class="table-responsive text-nowrap">
                        <div class="card-datatable table-responsive pt-0">
                            <div class="container">
                                <h1>Inventario de Microsoft 365</h1>

                                <h2>Usuarios</h2>
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Nombre</th>
                                            <th>Email</th>
                                            <th>Estado</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($users as $user)
                                            <tr>
                                                <td>{{ $user->getDisplayName() }}</td>
                                                <td>{{ $user->getMail() }}</td>
                                                <td>{{ $user->getAccountEnabled() ? 'Activo' : 'Inactivo' }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                                <h2>Dispositivos</h2>
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Nombre</th>
                                            <th>Tipo</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($devices as $device)
                                            <tr>
                                                <td>{{ $device->getDisplayName() }}</td>
                                                <td>{{ $device->getDeviceCategory() }}</td>
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
