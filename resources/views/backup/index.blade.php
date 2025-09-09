<x-app-layout>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 40px 20px;
        }

        .header {
            text-align: center;
            margin-bottom: 60px;
            padding-bottom: 30px;
            border-bottom: 1px solid #e5e5e5;
        }

        .header h1 {
            font-size: 2.5rem;
            font-weight: 300;
            margin-bottom: 10px;
            letter-spacing: -0.02em;
        }

        .header p {
            font-size: 1.1rem;
            color: #666666;
            font-weight: 300;
        }

        .stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 30px;
            margin-bottom: 60px;
        }

        .stat-card {
            text-align: center;
            padding: 30px 20px;
            border: 1px solid #e5e5e5;
            transition: all 0.2s ease;
        }

        .stat-card:hover {
            border-color: #000000;
        }

        .stat-card h3 {
            font-size: 0.9rem;
            font-weight: 400;
            color: #666666;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            margin-bottom: 15px;
        }

        .stat-card .number {
            font-size: 2.2rem;
            font-weight: 200;
            color: #000000;
        }

        .controls {
            text-align: center;
            margin-bottom: 60px;
        }

        .btn {
            background-color: #000000;
            color: #ffffff;
            border: none;
            padding: 15px 40px;
            font-size: 1rem;
            font-weight: 400;
            cursor: pointer;
            transition: all 0.2s ease;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            display: inline-flex;
            align-items: center;
            gap: 10px;
        }

        .btn:hover {
            background-color: #333333;
        }

        .btn:disabled {
            background-color: #cccccc;
            cursor: not-allowed;
        }

        .btn-outline {
            background-color: #ffffff;
            color: #000000;
            border: 1px solid #000000;
        }

        .btn-outline:hover {
            background-color: #000000;
            color: #ffffff;
        }

        .btn-outline:disabled {
            background-color: #ffffff;
            color: #cccccc;
            border-color: #cccccc;
        }

        .btn-small {
            padding: 8px 20px;
            font-size: 0.85rem;
        }

        .backup-section {
            margin-bottom: 40px;
        }

        .backup-section h2 {
            font-size: 1.5rem;
            font-weight: 300;
            margin-bottom: 30px;
            text-transform: uppercase;
            letter-spacing: 0.1em;
        }

        .backup-table {
            width: 100%;
            border-collapse: collapse;
            border: 1px solid #e5e5e5;
        }

        .backup-table th {
            background-color: #f8f8f8;
            padding: 20px 15px;
            text-align: left;
            font-weight: 400;
            color: #000000;
            border-bottom: 1px solid #e5e5e5;
            text-transform: uppercase;
            font-size: 0.85rem;
            letter-spacing: 0.1em;
        }

        .backup-table td {
            padding: 20px 15px;
            border-bottom: 1px solid #f0f0f0;
            vertical-align: middle;
        }

        .backup-table tr:hover {
            background-color: #fafafa;
        }

        .backup-table tr:last-child td {
            border-bottom: none;
        }

        .status-badge {
            padding: 6px 12px;
            font-size: 0.75rem;
            font-weight: 400;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            border: 1px solid;
            display: inline-block;
        }

        .status-completed {
            background-color: #ffffff;
            color: #000000;
            border-color: #000000;
        }

        .status-failed {
            background-color: #000000;
            color: #ffffff;
            border-color: #000000;
        }

        .status-progress {
            background-color: #f0f0f0;
            color: #666666;
            border-color: #cccccc;
        }

        .type-badge {
            padding: 6px 12px;
            font-size: 0.75rem;
            font-weight: 400;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            background-color: #f8f8f8;
            color: #000000;
            border: 1px solid #e5e5e5;
        }

        .actions {
            display: flex;
            gap: 10px;
            align-items: center;
        }

        .loading {
            display: inline-block;
            width: 16px;
            height: 16px;
            border: 2px solid #ffffff;
            border-radius: 50%;
            border-top-color: transparent;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            to {
                transform: rotate(360deg);
            }
        }

        .empty-state {
            text-align: center;
            padding: 80px 20px;
            color: #666666;
        }

        .empty-state .icon {
            font-size: 4rem;
            margin-bottom: 20px;
            opacity: 0.3;
        }

        .empty-state h3 {
            font-size: 1.2rem;
            font-weight: 300;
            margin-bottom: 10px;
            color: #000000;
        }

        .empty-state p {
            font-size: 1rem;
            font-weight: 300;
        }

        .toast {
            position: fixed;
            top: 30px;
            right: 30px;
            background-color: #000000;
            color: #ffffff;
            padding: 15px 25px;
            font-size: 0.9rem;
            font-weight: 400;
            transform: translateX(400px);
            transition: transform 0.3s ease;
            z-index: 1000;
            border: 1px solid #000000;
        }

        .toast.show {
            transform: translateX(0);
        }

        .toast.error {
            background-color: #ffffff;
            color: #000000;
            border: 2px solid #000000;
        }

        .backup-name {
            font-weight: 500;
            font-family: 'Courier New', monospace;
            font-size: 0.9rem;
        }

        .backup-date {
            color: #666666;
            font-size: 0.9rem;
        }

        .backup-size {
            font-weight: 500;
        }

        /* Loader pantalla completa */
        .overlay-loader {
            position: fixed;
            inset: 0;
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(2px);
            display: none;
            align-items: center;
            justify-content: center;
            z-index: 3000;
        }

        .overlay-loader .spinner {
            width: 60px;
            height: 60px;
            border: 6px solid #000;
            border-top-color: transparent;
            border-radius: 50%;
            animation: spin 0.9s linear infinite;
        }

        /* Reutiliza @keyframes spin ya definido */

        /* Spinner pequeño dentro del botón */
        .btn .loading-inline {
            width: 16px;
            height: 16px;
            border: 2px solid currentColor;
            border-top-color: transparent;
            border-radius: 50%;
            animation: spin 1s linear infinite;
            display: none;
        }

        /* Centrado del spinner cuando está cargando */
        .btn.is-loading {
            position: relative;
            justify-content: center;
        }

        .btn.is-loading #btnSpinner {
            display: inline-block !important;
            position: absolute;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
        }

        .btn.is-loading #btnText {
            opacity: 0;
        }

        @media (max-width: 768px) {
            .container {
                padding: 20px 15px;
            }

            .header h1 {
                font-size: 2rem;
            }

            .stats {
                grid-template-columns: 1fr;
                gap: 20px;
            }

            .backup-table {
                font-size: 0.9rem;
            }

            .backup-table th,
            .backup-table td {
                padding: 15px 10px;
            }

            .actions {
                flex-direction: column;
                gap: 8px;
            }

            .btn-small {
                width: 100%;
                justify-content: center;
            }
        }

        @media (max-width: 480px) {

            .backup-table th:nth-child(3),
            .backup-table td:nth-child(3),
            .backup-table th:nth-child(4),
            .backup-table td:nth-child(4) {
                display: none;
            }
        }
    </style>
    <!-- Loader global -->
    <div id="backupLoader" class="overlay-loader">
        <div>
            <div class="spinner"></div>
            <div style="margin-top:15px;font-size:.9rem;letter-spacing:.1em;">GENERANDO BACKUP...</div>
        </div>
    </div>
    <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">

            <!-- Basic Bootstrap Table -->
            <div class="card">

                <div class="container">
                    <div class="header">
                        <h1>Gestión de Backups</h1>
                        <p>Sistema de copias de seguridad</p>
                    </div>

                    <div class="stats">
                        <div class="stat-card">
                            <h3>Total</h3>
                            <div class="number" id="totalBackups">
                                {{ count($files) }}
                            </div>
                        </div>
                        <div class="stat-card">
                            <h3>Espacio</h3>
                            <div class="number" id="totalSize">
                                <!--sumar todos los archivos y mostrar el peso de total-->
                                {{ number_format($totalSize / 1024 / 1024, 2) }} MB
                            </div>
                        </div>
                        <div class="stat-card">
                            <h3>Último</h3>
                            <div class="number" id="lastBackup">
                                @if ($files->isEmpty())
                                    No disponible
                                @else
                                    {{ \Carbon\Carbon::createFromTimestamp(Storage::lastModified($files->last()))->diffForHumans() }}
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="controls">
                        <form id="backupForm" action="{{ route('backup.create') }}" method="POST">
                            @csrf
                            <button id="generateBackupBtn" type="submit" class="btn btn-primary">
                                <i id="btnIcon" class="fas fa-database"></i>
                                <span id="btnText">Generar Backup</span>
                                <span id="btnSpinner" class="loading-inline"></span>
                            </button>
                        </form>
                    </div>

                    <div class="backup-section">
                        <h2>Backups Disponibles</h2>
                        <div id="backupContainer">
                            <table id="backup" class="backup-table">
                                <thead>
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
                                            <td>{{ basename($file) }}</td>
                                            <td>
                                                {{ \Carbon\Carbon::createFromTimestamp(Storage::lastModified($file))->diffForHumans() }}
                                            </td>
                                            <td>
                                                {{ number_format(Storage::size($file) / 1024 / 1024, 2) }} MB
                                            </td>
                                            <td class="d-flex align-items-center">
                                                <a href="{{ route('backup.download', ['filename' => basename($file)]) }}"
                                                    class="btn btn-outline btn-ico" data-bs-toggle="tooltip"
                                                    data-bs-placement="top" title="Descargar Respaldo"
                                                    aria-label="Descargar Respaldo">
                                                    <i class='bx bxs-download'></i>
                                                </a>
                                                -
                                                <form
                                                    action="{{ route('backup.delete', ['filename' => basename($file)]) }}"
                                                    method="POST"
                                                    onsubmit="return confirm('¿Estás seguro de que deseas eliminar este respaldo: {{ basename($file) }}?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-ico" data-bs-toggle="tooltip"
                                                        data-bs-placement="top" title="Eliminar Respaldo"
                                                        aria-label="Eliminar Respaldo">
                                                        <i class='bx bx-trash'></i>
                                                    </button>
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
                    </div>
                </div>

                <br>
            </div>
            <!--/ Basic Bootstrap Table -->
        </div>
        <!-- / Content -->
    </div>
    <script>
        (function() {
            const form = document.getElementById('backupForm');
            if (!form) return;
            form.addEventListener('submit', function() {
                const btn = document.getElementById('generateBackupBtn');
                const icon = document.getElementById('btnIcon');
                const text = document.getElementById('btnText');
                const overlay = document.getElementById('backupLoader');

                btn.disabled = true;
                btn.classList.add('is-loading');
                if (icon) icon.style.display = 'none';
                if (text) text.textContent = 'Generando...';
                if (overlay) overlay.style.display = 'flex';
            });
        })();
    </script>
</x-app-layout>
