<x-app-layout>
    <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"></span> History </h4>

            <!-- Basic Bootstrap Table -->
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-header">BACKUP</h5>
                </div>
                <div class="content-wrapper">
                    <div class="table-responsive text-nowrap">
                        <div class="card-datatable table-responsive pt-0">
                            <div class="container">
                                <h1>Gestión de Respaldos</h1>

                                @if(session('success'))
                                    <div class="alert alert-success">
                                        {{ session('success') }}
                                    </div>
                                @endif

                                @if(session('error'))
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
                                            <div class="card-body">
                                                <table class="table">
                                                    <thead>
                                                        <tr>
                                                            <th>Nombre</th>
                                                            <th>Fecha</th>
                                                            <th>Acciones</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @forelse($files as $file)
                                                        <tr>
                                                            <td>{{ basename($file) }}</td>
                                                            <td>
                                                                {{ \Carbon\Carbon::createFromTimestamp(Storage::lastModified($file))->diffForHumans() }}
                                                            </td>
                                                            <td>
                                                                <a href="{{ route('backup.download', ['filename' => basename($file)]) }}" 
                                                                class="btn btn-sm btn-success">
                                                                <i class="fas fa-download"></i> Descargar
                                                                </a>
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
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="card">
                                            <div class="card-header">
                                                Restaurar Base de Datos
                                            </div>
                                            <div class="card-body">
                                                <form action="{{ route('backup.restore') }}" method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="form-group">
                                                        <label for="backup_file">
                                                            Seleccionar archivo de respaldo 
                                                            <small>(ZIP o SQL)</small>
                                                        </label>
                                                        <input type="file" 
                                                            name="backup_file" 
                                                            id="backup_file" 
                                                            class="form-control @error('backup_file') is-invalid @enderror" 
                                                            accept=".zip,.sql" 
                                                            required>
                                                        
                                                        @error('backup_file')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>

                                                    <div class="alert alert-warning">
                                                        <strong>Precaución:</strong> 
                                                        Restaurar un respaldo sobrescribirá la base de datos actual.
                                                    </div>

                                                    <button type="submit" class="btn btn-danger">
                                                        <i class="fas fa-upload"></i> Restaurar Base de Datos
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
            </div>
            <!--/ Basic Bootstrap Table -->
        </div>
        <!-- / Content -->
    </div>
</x-app-layout>
