<x-app-layout>
    <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"></span> History </h4>

            <!-- Basic Bootstrap Table -->
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-header">History</h5>
                </div>
                <div class="content-wrapper">
                    <div class="table-responsive text-nowrap">
                        <div class="card-datatable table-responsive pt-0">
                            <div class="mb-3">
                                <form action="{{ route('backup.create') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-primary">Crear Nuevo Respaldo</button>
                                </form>
                            </div>

                            <div class="mb-3">
                                <form action="{{ route('backup.restore') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <label for="backup_file">Restaurar Respaldo</label>
                                        <input type="file" name="backup_file" class="form-control" required>
                                    </div>
                                    <button type="submit" class="btn btn-warning">Restaurar</button>
                                </form>
                            </div>

                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Nombre del Archivo</th>
                                        <th>Fecha</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($files as $file)
                                    <tr>
                                        <td>{{ basename($file) }}</td>
                                        <td>{{ \Carbon\Carbon::createFromTimestamp(Storage::lastModified($file)) }}</td>
                                        <td>
                                            <a href="{{ route('backup.download', ['filename' => basename($file)]) }}" 
                                            class="btn btn-sm btn-success">Descargar</a>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="3">No hay respaldos disponibles</td>
                                    </tr>
                                    @endforelse
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
