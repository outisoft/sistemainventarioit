<x-app-layout>
    <style>
        .page {
            max-width: 1410px;
            margin: 24px auto;
            padding: 0 12px;
        }

        .card-elevated {
            border: 1px solid #e5e7eb;
            border-radius: 12px;
            background: #fff;
            box-shadow: 0 6px 20px rgba(16, 24, 40, .06);
        }

        .hero {
            overflow: hidden;
        }

        .hero-hd {
            display: flex;
            align-items: center;
            gap: 16px;
            padding: 16px 18px;
            background: linear-gradient(180deg, #fbfdff, #f6f8fb);
            border-bottom: 1px solid #eceff3;
        }

        .icon {
            width: 46px;
            height: 46px;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: #eef2ff;
            color: #3730a3;
            border: 1px solid #c7d2fe;
        }

        .title {
            margin: 0;
            font-size: 1.25rem;
            font-weight: 700;
            color: #0f172a;
        }

        .subtitle {
            color: #64748b;
            font-size: .92rem;
            margin-top: 2px;
        }

        .tags {
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

        .mono {
            font-family: "SFMono-Regular", ui-monospace, Menlo, Monaco, Consolas, "Liberation Mono", monospace;
        }

        .body {
            padding: 14px 16px;
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
            background: #f8fafc;
            color: #374151;
        }

        .section-title {
            font-weight: 600;
            color: #111827;
            margin: 0 0 8px;
        }

        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(360px, 1fr));
            gap: 12px;
        }

        .device-card {
            border: 1px solid #e5e7eb;
            border-radius: 10px;
            padding: 12px;
            background: #fff;
            box-shadow: 0 4px 14px rgba(16, 24, 40, .05);
        }

        .device-card .head {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 6px;
        }

        .device-card .name {
            font-weight: 600;
            color: #111827;
        }

        .actions {
            margin-top: 10px;
            display: flex;
            gap: 8px;
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
        }

        .btn-danger.btn-sm {
            padding: 4px 8px;
        }

        table.table th,
        table.table td {
            vertical-align: middle;
        }

        .assignment-note {
            color: #6b7280;
            font-size: .85rem;
            margin-bottom: 8px;
        }

        @media (max-width: 640px) {
            .hero-hd {
                align-items: flex-start;
            }
        }
    </style>

    <div class="page">
        <!-- Hero equipo -->
        <div class="card-elevated hero mb-4">
            <div class="hero-hd">
                <div class="icon" aria-hidden="true">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="3" y="4" width="18" height="12" rx="2" />
                        <line x1="2" y1="20" x2="22" y2="20" />
                    </svg>
                </div>
                <div>
                    <h4 class="title">Equipment: {{ $equipo->name }}</h4>
                    <div class="subtitle">{{ optional($equipo->tipo)->name ?? 'Device' }}</div>
                </div>
                <div class="tags">
                    <span class="tag">Brand: {{ $equipo->marca }}</span>
                    <span class="tag">Model: {{ $equipo->model }}</span>
                    <span class="tag mono">Serial: {{ $equipo->serial }}</span>
                </div>
            </div>
            <div class="body">
                <div class="chips">
                    <span class="chip mono">IP: {{ $equipo->ip ?? '—' }}</span>
                    <span class="chip">SO: {{ $equipo->so ?? '—' }}</span>
                </div>
            </div>
        </div>

        <!-- Empleado asignado (si existe) -->
        <div class="card-elevated mb-4">
            <div class="body">
                <h5 class="section-title">Assignment</h5>
                <div class="assignment-note">Este equipo se asigna a un único puesto/empleado.</div>
                @php $pos = $equipo->positions->first(); @endphp
                @if ($pos)
                    <div class="device-card">
                        <div class="head">
                            <div class="name">{{ optional($pos->employee)->name ?? '—' }}</div>
                        </div>
                        <div class="chips">
                            <span class="chip">#{{ optional($pos->employee)->no_employee ?? 'N/A' }}</span>
                            <span class="chip">AD: {{ $pos->ad ?? '—' }}</span>
                        </div>
                        <div class="chips" style="margin-top:6px;">
                            <span class="chip">{{ $pos->position ?? '—' }}</span>
                            <span class="chip">{{ optional($pos->departments)->name ?? '—' }}</span>
                            <span class="chip">{{ optional($pos->hotel)->name ?? '—' }}</span>
                        </div>
                        <div class="chips" style="margin-top:6px;">
                            <span class="chip">{{ $pos->email ?? '—' }}</span>
                        </div>
                    </div>
                @else
                    <div class="text-muted">No employee assigned.</div>
                @endif
            </div>
        </div>

        <!-- Complementos asignados -->
        <div class="card-elevated mb-4">
            <div class="body">
                <h5 class="section-title">Assigned complements</h5>
                @if ($complementosAsignados->count() > 0)
                    <div class="grid">
                        @foreach ($complementosAsignados as $complemento)
                            <div class="device-card">
                                <div class="head">
                                    <div class="name">{{ optional($complemento->type)->name }}</div>
                                </div>
                                <div class="chips">
                                    <span class="chip">Brand: {{ $complemento->brand }}</span>
                                    <span class="chip">Model: {{ $complemento->model }}</span>
                                    <span class="chip mono">Serial: {{ $complemento->serial }}</span>
                                </div>
                                <div class="actions">
                                    <form action="{{ route('equipos.complementos.destroy', [$equipo, $complemento]) }}"
                                        method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" data-bs-toggle="tooltip"
                                            data-popup="tooltip-custom" data-bs-placement="top" aria-label="Delete"
                                            data-bs-original-title="Desvincular equipo">
                                            <i class='bx bx-trash'></i> Remove
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-muted">No complement assigned.</div>
                @endif
            </div>
        </div>

        <!-- Asignar complementos disponibles -->
        <div class="card-elevated mb-5">
            <div class="body">
                <h5 class="section-title">Assign complements</h5>
                <div class="table-responsive">
                    <table id="officees" class="table footer">
                        <thead class="bg-primary">
                            <tr>
                                <th>TYPE</th>
                                <th>BRAND</th>
                                <th>MODEL</th>
                                <th>SERIAL</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($complementosDisponibles as $complemento)
                                <tr>
                                    <td>{{ optional($complemento->type)->name }}</td>
                                    <td>{{ $complemento->brand }}</td>
                                    <td>{{ $complemento->model }}</td>
                                    <td>{{ $complemento->serial }}</td>
                                    <td>
                                        <form action="{{ route('equipos.asignar-complementos', $equipo) }}"
                                            method="POST">
                                            @csrf
                                            <input type="hidden" name="complements_id[]"
                                                value="{{ $complemento->id }}">
                                            <button type="submit" class="btn btn-primary btn-sm">Assign</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
