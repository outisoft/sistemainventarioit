<x-app-layout>
    <!-- Loader global Bootstrap modal -->
    <div class="modal fade" id="backupLoaderModal" tabindex="-1" aria-hidden="true" data-bs-backdrop="static"
        data-bs-keyboard="false">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content bg-transparent border-0 shadow-none">
                <div class="modal-body text-center">
                    <div class="spinner-border text-dark" style="width: 4rem; height: 4rem;" role="status"></div>
                    <div class="mt-3 fs-5 fw-light">GENERANDO BACKUP...</div>
                </div>
            </div>
        </div>
    </div>

    <div class="content-wrapper py-4">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card shadow-sm mb-4">
                    <div class="card-body">
                        <div class="text-center mb-4">
                            <h1 class="display-6 fw-light mb-2">Gestión de Backups</h1>
                            <p class="text-muted fs-5">Sistema de copias de seguridad</p>
                        </div>
                        <div class="row text-center mb-4">
                            <div class="col-md-4 mb-3 mb-md-0">
                                <div class="card border-0 bg-light h-100">
                                    <div class="card-body">
                                        <h6 class="text-uppercase text-muted mb-2">Total</h6>
                                        <div class="fs-2 fw-bold">{{ count($files) }}</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3 mb-md-0">
                                <div class="card border-0 bg-light h-100">
                                    <div class="card-body">
                                        <h6 class="text-uppercase text-muted mb-2">Espacio</h6>
                                        <div class="fs-2 fw-bold">{{ number_format($totalSize / 1024 / 1024, 2) }} MB</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card border-0 bg-light h-100">
                                    <div class="card-body">
                                        <h6 class="text-uppercase text-muted mb-2">Último</h6>
                                        <div class="fs-2 fw-bold">
                                            @if ($files->isEmpty())
                                                <span class="text-muted">No disponible</span>
                                            @else
                                                {{ \Carbon\Carbon::createFromTimestamp(Storage::lastModified($files->last()))->diffForHumans() }}
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="text-center mb-4">
                            <form id="backupForm" action="{{ route('backup.create') }}" method="POST"
                                class="d-inline-block">
                                @csrf
                                <button id="generateBackupBtn" type="submit"
                                    class="btn btn-dark btn-lg px-4 position-relative">
                                    <span id="btnText"><i class="fas fa-database me-2"></i>Generar Backup</span>
                                    <span id="btnSpinner"
                                        class="spinner-border spinner-border-sm position-absolute top-50 start-50 translate-middle d-none"></span>
                                </button>
                            </form>
                        </div>
                        <div class="mb-3">
                            <h2 class="h5 text-uppercase fw-light mb-3">Backups Disponibles</h2>
                            <div class="table-responsive">
                                <table class="table table-bordered align-middle" id="backup">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Name</th>
                                            <th>Date</th>
                                            <th>Size</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($files as $file)
                                            <tr>
                                                <td class="fw-semibold font-monospace">{{ basename($file) }}</td>
                                                <td class="text-muted">
                                                    {{ \Carbon\Carbon::createFromTimestamp(Storage::lastModified($file))->diffForHumans() }}
                                                </td>
                                                <td class="fw-semibold">
                                                    {{ number_format(Storage::size($file) / 1024 / 1024, 2) }} MB
                                                </td>
                                                <td>
                                                    <div class="d-flex gap-2">
                                                        <a href="{{ route('backup.download', ['filename' => basename($file)]) }}"
                                                            class="btn btn-outline-primary btn-sm"
                                                            data-bs-toggle="tooltip" title="Descargar Respaldo">
                                                            <i class='bx bxs-download'></i>
                                                        </a>
                                                        <form action="{{ route('backup.delete', ['filename' => basename($file)]) }}"
                                                            method="POST"
                                                            onsubmit="return confirm('¿Estás seguro de que deseas eliminar este respaldo: {{ basename($file) }}?')">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-outline-danger btn-sm"
                                                                data-bs-toggle="tooltip" title="Eliminar Respaldo">
                                                                <i class='bx bx-trash'></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="4" class="text-center text-muted py-5">
                                                    <i class="fas fa-database fa-3x mb-3 opacity-50"></i>
                                                    <div class="h6">No hay respaldos disponibles</div>
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- ...resto del contenido... --}}
            </div>
        </div>
    </div>

    <script>
        // Bootstrap loader modal logic
        (function() {
            const form = document.getElementById('backupForm');
            if (!form) return;
            form.addEventListener('submit', function() {
                const btn = document.getElementById('generateBackupBtn');
                const text = document.getElementById('btnText');
                const spinner = document.getElementById('btnSpinner');
                btn.disabled = true;
                btn.classList.add('position-relative');
                if (text) text.style.opacity = '0.5';
                if (spinner) spinner.classList.remove('d-none');
                // Show Bootstrap modal loader
                const modal = new bootstrap.Modal(document.getElementById('backupLoaderModal'));
                modal.show();
            });
        })();
    </script>
</x-app-layout>
