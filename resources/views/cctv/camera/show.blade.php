<x-app-layout>
    <style>
        .page-container {
            max-width: 1410px;
            margin: 24px auto;
            padding: 0 12px;
        }

        .hero-card {
            border: 1px solid #e5e7eb;
            border-radius: 14px;
            overflow: hidden;
            background: #fff;
            box-shadow: 0 10px 28px rgba(16, 24, 40, .06);
        }

        .hero-top {
            display: flex;
            align-items: center;
            gap: 16px;
            padding: 18px 20px;
            background: linear-gradient(180deg, #fbfdff, #f6f8fb);
            border-bottom: 1px solid #eceff3;
        }

        .icon-circle {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: #ecfeff;
            color: #0e7490;
            border: 1px solid #a5f3fc;
        }

        .hero-title {
            margin: 0;
            font-size: 1.25rem;
            font-weight: 700;
            color: #0f172a;
        }

        .hero-sub {
            color: #64748b;
            font-size: .9rem;
            margin-top: 2px;
        }

        .hero-tags {
            margin-left: auto;
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
        }

        .tag {
            display: inline-block;
            padding: 6px 10px;
            border-radius: 999px;
            font-size: .75rem;
            font-weight: 600;
            border: 1px solid #e5e7eb;
            color: #374151;
            background: #f8fafc;
        }

        .tag-accent {
            background: #eef2ff;
            color: #3730a3;
            border-color: #c7d2fe;
        }

        .tag-info {
            background: #ecfeff;
            color: #0e7490;
            border-color: #a5f3fc;
        }

        .hero-body {
            padding: 16px 20px;
        }

        .stats-row {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 14px;
        }

        .stat {
            border: 1px solid #f1f5f9;
            border-radius: 10px;
            padding: 12px 14px;
            background: #fff;
        }

        .stat .label {
            color: #6b7280;
            font-size: .75rem;
            text-transform: uppercase;
            letter-spacing: .06em;
            margin-bottom: 6px;
        }

        .stat .value {
            color: #0f172a;
            font-size: .98rem;
            font-weight: 600;
        }

        .mono {
            font-family: "SFMono-Regular", ui-monospace, Menlo, Monaco, Consolas, "Liberation Mono", monospace;
        }

        .port-link {
            color: inherit;
            text-decoration: none;
            border-bottom: 1px dotted currentColor;
        }

        .port-link:hover {
            color: #1d4ed8;
        }

        .actions {
            display: flex;
            gap: 10px;
            margin-top: 16px;
        }

        .btn-slim {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 8px 12px;
            font-size: .85rem;
            border-radius: 8px;
            border: 1px solid #e5e7eb;
            background: #fff;
            color: #111827;
            text-decoration: none;
            transition: background .12s ease, transform .08s ease;
        }

        .btn-slim:hover {
            background: #f3f4f6;
            transform: translateY(-1px);
        }

        .btn-primary {
            border-color: #c7d2fe;
            background: #eef2ff;
            color: #3730a3;
        }

        .btn-primary:hover {
            background: #e0e7ff;
        }

        @media (max-width: 900px) {
            .stats-row {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 640px) {
            .stats-row {
                grid-template-columns: 1fr;
            }
        }
    </style>

    <div class="page-container">
        <div class="hero-card mb-4">
            <div class="hero-top">
                <div class="icon-circle" aria-hidden="true">
                    <!-- icono de cámara -->
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M23 7l-7 5 7 5V7z"></path>
                        <rect x="1" y="5" width="15" height="14" rx="2" ry="2"></rect>
                    </svg>
                </div>
                <div>
                    <h3 class="hero-title">{{ $camera->name }}</h3>
                    <div class="hero-sub">Cámara CCTV • Región: {{ $camera->region->name ?? '—' }}</div>
                </div>
                <div class="hero-tags">
                    <!-- Boton para descargar qr-->
                    <a href="{{ route('cctv-camera.qr', $camera) }}" class="btn-slim"><i class='bx bx-qr'></i></a>

                    <span class="tag tag-accent" title="Tipo">{{ $camera->type_camera->name ?? 'Tipo —' }}</span>
                    @if ($camera->zona)
                        <span class="tag tag-info" title="Zona">Zona: {{ strtoupper($camera->zona) }}</span>
                    @endif
                </div>
            </div>
            <div class="hero-body">
                <div class="stats-row">
                    <div class="stat">
                        <div class="label">IDF</div>
                        <div class="value mono">{{ $camera->idf ?: '—' }}</div>
                    </div>
                    <div class="stat">
                        <div class="label">Ubicación</div>
                        <div class="value">{{ $camera->location->name ?? '—' }}</div>
                    </div>
                    <div class="stat">
                        <div class="label">Conectado a</div>
                        <div class="value">
                            @if ($camera->switch)
                                <a class="port-link"
                                    href="{{ route('cctv-switch.show', $camera->switch) }}">{{ $camera->switch->name }}</a>
                                <span class="mono">(Puerto {{ $camera->connected_port ?: '—' }})</span>
                            @else
                                —
                            @endif
                        </div>
                    </div>

                    <div class="stat">
                        <div class="label">Marca</div>
                        <div class="value">{{ $camera->brand }}</div>
                    </div>
                    <div class="stat">
                        <div class="label">Modelo</div>
                        <div class="value">{{ $camera->model }}</div>
                    </div>
                    <div class="stat">
                        <div class="label">Serial</div>
                        <div class="value mono">{{ $camera->serial }}</div>
                    </div>

                    <div class="stat">
                        <div class="label">MAC</div>
                        <div class="value mono">{{ $camera->mac }}</div>
                    </div>
                    <div class="stat">
                        <div class="label">IP</div>
                        <div class="value mono">{{ $camera->ip }}</div>
                    </div>
                    <div class="stat">
                        <div class="label">Región</div>
                        <div class="value">{{ $camera->region->name ?? '—' }}</div>
                    </div>
                </div>

                <div class="actions">
                    @can('cctv-camera.edit')
                        <a href="{{ route('cctv-camera.edit', $camera) }}" class="btn-slim btn-primary">Editar</a>
                    @endcan
                    <a href="{{ route('cctv-camera.index') }}" class="btn-slim">Volver al listado</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
