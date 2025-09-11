<x-app-layout>
    <style>
        .page-container {
            max-width: 1100px;
            margin: 24px auto;
            padding: 0 12px;
        }

        /* Hero card para el detalle del switch */
        .hero-switch {
            border: 1px solid #e5e7eb;
            border-radius: 14px;
            overflow: hidden;
            box-shadow: 0 10px 28px rgba(16, 24, 40, .06);
            background: #fff;
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
            background: #eef2ff;
            color: #3730a3;
            border: 1px solid #c7d2fe;
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

        .tag-primary {
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

        /* Cards grid para equipos conectados */
        .cards-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(260px, 1fr));
            gap: 12px;
            padding: 12px;
        }

        .device-card {
            border: 1px solid #e5e7eb;
            border-radius: 12px;
            background: #fff;
            box-shadow: 0 4px 14px rgba(16, 24, 40, .05);
            padding: 12px 14px;
            transition:
                transform .12s ease,
                box-shadow .12s ease;
        }

        .device-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 24px rgba(16, 24, 40, .08);
        }

        .device-card .head {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 8px;
        }

        .device-card .name {
            font-weight: 600;
            color: #111827;
            font-size: .98rem;
        }

        .chips {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
        }

        .chip {
            display: inline-block;
            padding: 4px 8px;
            border-radius: 999px;
            font-size: .75rem;
            border: 1px solid #e5e7eb;
            color: #374151;
            background: #f8fafc;
        }

        .chip-accent {
            background: #eef2ff;
            color: #3730a3;
            border-color: #c7d2fe;
        }

        .chip-mono {
            font-family: "SFMono-Regular", ui-monospace, Menlo, Monaco, Consolas, "Liberation Mono", monospace;
        }

        /* Tables */
        .table-modern thead th {
            background: #f8fafc;
            color: #374151;
            font-weight: 600;
            text-transform: uppercase;
            font-size: .75rem;
            letter-spacing: .06em;
            border-bottom: 1px solid #e5e7eb;
        }

        .table-modern td {
            color: #111827;
            border-bottom: 1px solid #f3f4f6;
            vertical-align: middle;
            font-size: .92rem;
        }

        .table-modern tbody tr:hover {
            background: rgba(59, 130, 246, .04);
        }

        .device-card .actions {
            margin-top: 10px;
            display: flex;
        }

        .btn-slim {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 10px;
            font-size: .8rem;
            border-radius: 8px;
            border: 1px solid #c7d2fe;
            color: #3730a3;
            background: #eef2ff;
            text-decoration: none;
            transition:
                background .12s ease,
                transform .08s ease;
        }

        .btn-slim:hover {
            background: #e0e7ff;
            transform: translateY(-1px);
        }

        .port-link {
            color: inherit;
            text-decoration: none;
            border-bottom: 1px dotted currentColor;
        }

        .port-link:hover {
            color: #1d4ed8;
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

            .kv-grid dt {
                padding-top: 12px;
            }
        }
    </style>

    <div class="page-container">
        <!-- Tarjeta hero reemplazando la tarjeta anterior de detalles -->
        <div class="hero-switch mb-4">
            <div class="hero-top">
                <div class="icon-circle" aria-hidden="true">
                    <!-- icono de servidor -->
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="2" y="2" width="20" height="8" rx="2" ry="2" />
                        <rect x="2" y="14" width="20" height="8" rx="2" ry="2" />
                        <line x1="6" y1="6" x2="6" y2="6" />
                        <line x1="6" y1="18" x2="6" y2="18" />
                    </svg>
                </div>
                <div>
                    <h3 class="hero-title">{{ $switch->name }}</h3>
                    <div class="hero-sub">Switch CCTV • Región: {{ $switch->region->name ?? '—' }}</div>
                </div>
                <div class="hero-tags">
                    <a href="{{ route('cctv-switch.qr', $switch) }}" class="btn-slim"><i class='bx bx-qr'></i></a>
                    <span class="tag tag-primary" title="Tipo">Tipo: {{ strtoupper($switch->tipo) }}</span>
                    @if ($switch->zona)
                        <span class="tag tag-info" title="Zona">Zona: {{ strtoupper($switch->zona) }}</span>
                    @endif
                    <span class="tag" title="Puertos">Puertos: {{ $switch->ports }}</span>
                </div>
            </div>
            <div class="hero-body">
                <div class="stats-row">
                    <div class="stat">
                        <div class="label">IDF</div>
                        <div class="value mono">{{ $switch->idf ?: '—' }}</div>
                    </div>
                    <div class="stat">
                        <div class="label">Ubicación</div>
                        <div class="value">{{ $switch->location->name ?? '—' }}</div>
                    </div>
                    <div class="stat">
                        <div class="label">Puerto conectado</div>
                        <div class="value mono">
                            {{ $switch->connected_port ?: '—' }}
                            @if (!empty($switch->connected_to_id))
                                ( <a class="port-link"
                                    href="{{ route('cctv-switch.show', $switch->connected_to_id) }}">{{ optional($switch->connectedTo)->name ?? 'SW #' . $switch->connected_to_id }}</a>
                                )
                            @endif
                        </div>
                    </div>

                    <div class="stat">
                        <div class="label">Marca</div>
                        <div class="value">{{ $switch->brand }}</div>
                    </div>
                    <div class="stat">
                        <div class="label">Modelo</div>
                        <div class="value">{{ $switch->model }}</div>
                    </div>
                    <div class="stat">
                        <div class="label">Serial</div>
                        <div class="value mono">{{ $switch->serial }}</div>
                    </div>

                    <div class="stat">
                        <div class="label">MAC</div>
                        <div class="value mono">{{ $switch->mac }}</div>
                    </div>
                    <div class="stat">
                        <div class="label">IP</div>
                        <div class="value mono">{{ $switch->ip }}</div>
                    </div>
                    <div class="stat">
                        <div class="label">Región</div>
                        <div class="value">{{ $switch->region->name ?? '—' }}</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Secciones existentes: Cámaras conectadas y Switches conectados -->
        <div class="card card-elevated mb-4">
            <div class="card-body p-0">
                @if ($switch->cameras && $switch->cameras->count())
                    <div class="cards-grid">
                        @foreach ($switch->cameras as $camera)
                            <div class="device-card">
                                <div class="head">
                                    <div class="name">{{ $camera->name }}</div>
                                </div>
                                <div class="chips">
                                    <span class="chip chip-mono" title="IP">IP: {{ $camera->ip }}</span>
                                    <span class="chip chip-mono" title="MAC">MAC: {{ $camera->mac }}</span>
                                    <span class="chip" title="Puerto">Puerto: {{ $camera->connected_port }}</span>
                                    <span class="chip chip-accent"
                                        title="Tipo">{{ $camera->type_camera->name ?? '—' }}</span>
                                </div>
                                <div class="actions">
                                    <a class="btn-slim" href="{{ route('cctv-camera.show', $camera) }}"
                                        aria-label="Ver detalles de la cámara {{ $camera->name }}">
                                        Ver más
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="p-3 text-muted">No hay cámaras conectadas a este switch.</div>
                @endif
            </div>
        </div>

        <div class="card card-elevated mb-4">
            <div class="card-body p-0">
                @if ($switch->connectedSwitches && $switch->connectedSwitches->count())
                    <div class="cards-grid">
                        @foreach ($switch->connectedSwitches as $child)
                            <div class="device-card">
                                <div class="head">
                                    <div class="name">{{ $child->name }}</div>
                                </div>
                                <div class="chips">
                                    <span class="chip chip-mono" title="IP">IP: {{ $child->ip }}</span>
                                    <span class="chip chip-mono" title="MAC">MAC: {{ $child->mac }}</span>
                                    <span class="chip" title="Puerto">Puerto: {{ $child->connected_port }}</span>
                                    <span class="chip chip-accent"
                                        title="Tipo">{{ strtoupper($child->tipo) }}</span>
                                </div>
                                <div class="actions">
                                    <a class="btn-slim" href="{{ route('cctv-switch.show', $child) }}"
                                        aria-label="Ver detalles del switch {{ $child->name }}">
                                        Ver más
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="p-3 text-muted">No hay switches conectados a este switch.</div>
                @endif
            </div>
        </div>

        <a href="{{ route('cctv-switch.index') }}" class="btn btn-outline-secondary">Volver al listado</a>
    </div>
</x-app-layout>
