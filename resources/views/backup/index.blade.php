<x-app-layout>
    <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">

            <!-- Basic Bootstrap Table -->
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-header">BACKUP</h5>
                </div>
                <div class="content-wrapper">
                    <div class="table-responsive text-nowrap">
                        <div class="card-datatable table-responsive pt-0">
                            <div class="container">

                                @if (session('success'))
                                    <div class="alert alert-success">
                                        {{ session('success') }}
                                    </div>
                                @endif

                                @if (session('error'))
                                    <div class="alert alert-danger">
                                        {{ session('error') }}
                                    </div>
                                @endif

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="card mb-4">
                                            <div class="card-header">
                                                Crear Nuevo Respaldo
                                            </div>
                                            <div class="card-body">
                                                <form action="{{ route('backup.create') }}" method="POST">
                                                    @csrf
                                                    <button type="submit" class="btn btn-primary">
                                                        <i class="fas fa-database"></i> Crear Respaldo
                                                    </button>
                                                </form>
                                            </div>
                                        </div>

                                        <div class="card">
                                            <div class="card-header">
                                                Listado de Respaldos
                                            </div>

                                            @if ($files->isEmpty())
                                                <div class="alert alert-info">
                                                    No se encontraron archivos de respaldo.
                                                    @if (config('app.debug'))
                                                        <br>
                                                        <small>Ruta de búsqueda:
                                                            {{ storage_path('app/Laravel') }}</small>
                                                    @endif
                                                </div>
                                            @else
                                                <div class="content-wrapper card-datatable table-responsive pt-0">
                                                    <table id="backup" class="table table-striped">
                                                        <thead class="bg-primary">
                                                            <tr>
                                                                <th>Nombre</th>
                                                                <th>Fecha</th>
                                                                <th></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @forelse($files as $file)
                                                                <tr>
                                                                    <td>{{ basename($file) }}</td>
                                                                    <td>
                                                                        {{ \Carbon\Carbon::createFromTimestamp(Storage::lastModified($file))->diffForHumans() }}
                                                                    </td>
                                                                    <td class="d-flex align-items-center">
                                                                        <a href="{{ route('backup.download', ['filename' => basename($file)]) }}"
                                                                            class="btn btn-ico" data-bs-toggle="tooltip"
                                                                            data-bs-placement="top" data-bs-html="true"
                                                                            title=""
                                                                            data-bs-original-title="<span>Download Backup</span>">
                                                                            <i class='bx bxs-download'></i>
                                                                        </a>

                                                                        <form
                                                                            action="{{ route('backup.delete', ['filename' => basename($file)]) }}"
                                                                            method="POST">
                                                                            @csrf
                                                                            @method('DELETE')
                                                                            <button type="submit" class="btn btn-ico"
                                                                                data-bs-toggle="tooltip"
                                                                                data-bs-placement="top"
                                                                                data-bs-html="true" title=""
                                                                                data-bs-original-title="<span>Delete Backup</span>"
                                                                                onclick="return confirm('Are you sure to delete this backup?')">
                                                                                <i class='bx bx-trash'></i></button>
                                                                        </form>
                                                                    </td>
                                                                </tr>
                                                            @empty
                                                                <tr>
                                                                    <td colspan="3" class="text-center">
                                                                        No hay respaldos disponibles
                                                                    </td>
                                                                </tr>
                                                            @endforelse
                                                        </tbody>
                                                    </table>
                                                </div>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="card">
                                            <div class="card-header">
                                                Importar Datos
                                            </div>
                                            <div class="card-body">
                                                <form action="{{ route('backup.restore') }}" method="POST"
                                                    enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="form-group">
                                                        <label for="backup_file">
                                                            Seleccionar archivo SQL con datos
                                                            <small>(archivos SQL con sentencias INSERT)</small>
                                                        </label>
                                                        <input type="file" name="backup_file" id="backup_file"
                                                            class="form-control @error('backup_file') is-invalid @enderror"
                                                            accept=".sql" required>

                                                        @error('backup_file')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                    <br>

                                                    <div class="alert alert-info">
                                                        <strong>Notas:</strong>
                                                        <ul>
                                                            <li>Solo se procesarán las sentencias INSERT INTO.</li>
                                                            <li>Las tablas deben existir en la base de datos.</li>
                                                            <li>La estructura de las tablas debe coincidir con los datos
                                                                a importar.</li>
                                                        </ul>
                                                    </div>

                                                    <button type="submit" class="btn btn-primary">
                                                        <i class="fas fa-upload"></i> Importar Datos
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
            </div>
            <!--/ Basic Bootstrap Table -->
        </div>
        <!-- / Content -->
    </div>
</x-app-layout>
