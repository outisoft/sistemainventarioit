<x-app-layout>
    @php
        $usedMB = round($totalSize / 1024 / 1024, 2);
        $maxCapacityMB = (int) env('BACKUP_MAX_DISK_MB', 1024);
        $percentUsed = $maxCapacityMB > 0 ? min(100, round(($usedMB / $maxCapacityMB) * 100, 2)) : 0;
        $lastFileTs = !$files->isEmpty() ? \Illuminate\Support\Facades\Storage::lastModified($files->last()) : null;
    @endphp
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

    <!-- Toast feedback -->
    <div class="position-fixed top-0 end-0 p-3" style="z-index:1080">
        <div id="backupToast" class="toast align-items-center text-bg-dark border-0" role="alert" aria-live="assertive"
            aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body" id="backupToastBody">Operación realizada.</div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
                    aria-label="Close"></button>
            </div>
        </div>
    </div>

    <div class="content-wrapper py-4">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card shadow-sm mb-4">
                    <div class="card-body">
                        <!-- Header -->
                        <div class="text-center mb-4">
                            <h1 class="h2 fw-light mb-2">
                                <i class="bx bx-cloud-download text-primary me-1"></i>Gestión de Backups
                            </h1>
                            <p class="text-muted mb-0">Sistema de copias de seguridad</p>
                        </div>

                        <!-- Métricas -->
                        <div class="row g-3 mb-3">
                            <div class="col-6 col-md-3">
                                <div class="border rounded p-3 h-100 text-center bg-light">
                                    <div class="small text-uppercase text-muted">Total</div>
                                    <div class="fs-4 fw-semibold mt-1">{{ count($files) }}</div>
                                </div>
                            </div>
                            <div class="col-6 col-md-3">
                                <div class="border rounded p-3 h-100 text-center bg-light">
                                    <div class="small text-uppercase text-muted">Espacio</div>
                                    <div class="fs-4 fw-semibold mt-1">{{ $usedMB }} MB</div>
                                </div>
                            </div>
                            <div class="col-6 col-md-3">
                                <div class="border rounded p-3 h-100 text-center bg-light">
                                    <div class="small text-uppercase text-muted">Capacidad</div>
                                    <div class="fs-6 fw-semibold mt-1">{{ $maxCapacityMB }} MB</div>
                                </div>
                            </div>
                            <div class="col-6 col-md-3">
                                <div class="border rounded p-3 h-100 text-center bg-light">
                                    <div class="small text-uppercase text-muted">Último</div>
                                    <div class="fs-6 fw-semibold mt-1">
                                        @if ($lastFileTs)
                                            <span data-bs-toggle="tooltip"
                                                title="{{ \Carbon\Carbon::createFromTimestamp($lastFileTs)->format('Y-m-d H:i:s') }}">
                                                {{ \Carbon\Carbon::createFromTimestamp($lastFileTs)->diffForHumans() }}
                                            </span>
                                        @else
                                            <span class="text-muted">No disponible</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Barra de uso -->
                        <div class="mb-4">
                            <div class="d-flex justify-content-between small mb-1">
                                <span class="text-muted">Uso de almacenamiento</span>
                                <span class="text-muted">{{ $percentUsed }}%</span>
                            </div>
                            <div class="progress" style="height:6px;">
                                <div class="progress-bar bg-dark" role="progressbar"
                                    style="width: {{ $percentUsed }}%;" aria-valuenow="{{ $percentUsed }}"
                                    aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <small class="text-muted d-block mt-1">{{ $usedMB }} MB / {{ $maxCapacityMB }} MB</small>
                        </div>

                        <!-- Acciones -->
                        <div class="d-flex justify-content-center flex-wrap gap-2 mb-4">
                            <form id="backupForm" action="{{ route('backup.create') }}" method="POST">
                                @csrf
                                <button id="generateBackupBtn" type="submit"
                                    class="btn btn-dark px-4 position-relative">
                                    <span id="btnText"><i class="fas fa-database me-2"></i>Generar Backup</span>
                                    <span id="btnSpinner"
                                        class="spinner-border spinner-border-sm position-absolute top-50 start-50 translate-middle d-none"></span>
                                </button>
                            </form>
                            <a href="{{ route('backup.index') }}" class="btn btn-outline-secondary">
                                <i class="bx bx-refresh me-1"></i>Refrescar
                            </a>
                        </div>

                        <!-- Tabla -->
                        <h2 class="h6 text-uppercase fw-semibold text-muted mb-3">Backups Disponibles</h2>
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
                                        @php
                                            $ts = \Illuminate\Support\Facades\Storage::lastModified($file);
                                            $dt = \Carbon\Carbon::createFromTimestamp($ts);
                                        @endphp
                                        <tr>
                                            <td class="fw-semibold font-monospace">{{ basename($file) }}</td>
                                            <td class="text-muted" data-order="{{ $ts }}">
                                                <span data-bs-toggle="tooltip"
                                                    title="{{ $dt->format('Y-m-d H:i:s') }}">{{ $dt->diffForHumans() }}</span>
                                            </td>
                                            <td class="fw-semibold">
                                                {{ number_format(\Illuminate\Support\Facades\Storage::size($file) / 1024 / 1024, 2) }}
                                                MB
                                            </td>
                                            <td>
                                                <div class="d-flex gap-2">
                                                    <a href="{{ route('backup.download', ['filename' => basename($file)]) }}"
                                                        class="btn btn-outline-primary btn-sm" data-bs-toggle="tooltip"
                                                        title="Descargar">
                                                        <i class='bx bxs-download'></i>
                                                    </a>
                                                    <form
                                                        action="{{ route('backup.delete', ['filename' => basename($file)]) }}"
                                                        method="POST"
                                                        onsubmit="return confirm('¿Eliminar este respaldo: {{ basename($file) }}?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-outline-danger btn-sm"
                                                            data-bs-toggle="tooltip" title="Eliminar">
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
                                                <div class="h6 mb-0">No hay respaldos disponibles</div>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {{-- ...existing code... --}}
            </div>
        </div>
    </div>

    <script>
        (function() {
            const form = document.getElementById('backupForm');
            if (form) {
                form.addEventListener('submit', function() {
                    const btn = document.getElementById('generateBackupBtn');
                    const text = document.getElementById('btnText');
                    const spinner = document.getElementById('btnSpinner');
                    btn.disabled = true;
                    if (text) text.style.opacity = '.5';
                    if (spinner) spinner.classList.remove('d-none');
                    const modal = new bootstrap.Modal(document.getElementById('backupLoaderModal'));
                    modal.show();
                });
            }

            // DataTable (si está disponible)
            if (window.DataTable && document.getElementById('backup')) {
                new DataTable('#backup', {
                    pageLength: 10,
                    order: [
                        [1, 'desc']
                    ],
                    language: {
                        search: '_INPUT_',
                        searchPlaceholder: 'Buscar...',
                        zeroRecords: 'Sin coincidencias',
                        info: 'Mostrando _START_ a _END_ de _TOTAL_',
                        infoEmpty: 'Sin datos',
                        infoFiltered: '(filtrado de _MAX_)',
                        lengthMenu: 'Mostrar _MENU_',
                        paginate: {
                            next: '›',
                            previous: '‹'
                        }
                    }
                });
            }

            // Tooltips
            if (window.bootstrap) {
                document.querySelectorAll('[data-bs-toggle="tooltip"]').forEach(el => {
                    new bootstrap.Tooltip(el);
                });
            }

            // API simple para mostrar toast (reutilizable)
            window.showBackupToast = function(msg, type = 'dark') {
                const el = document.getElementById('backupToast');
                const body = document.getElementById('backupToastBody');
                if (!el || !body) return;
                body.textContent = msg;
                el.className = 'toast align-items-center text-bg-' + type + ' border-0';
                const t = new bootstrap.Toast(el);
                t.show();
            };
        })();
    </script>
</x-app-layout>
