<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee details</title>
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="https://bsuite.grupo-pinero.com/bsuite/favicon.ico">
    <link rel="stylesheet" href="{{ asset('assets/vendor/fonts/boxicons.css') }}" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/core.css') }}" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/theme-default.css') }}"
        class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset('assets/css/demo.css') }}" />
    <style>
        .page {
            max-width: 1100px;
            margin: 24px auto;
            padding: 0 12px;
        }

        .hero {
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

        .avatar {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: #eef2ff;
            border: 1px solid #c7d2fe;
        }

        .title {
            margin: 0;
            font-size: 1.25rem;
            font-weight: 700;
            color: #0f172a;
        }

        .sub {
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

        .section {
            margin-top: 16px;
        }

        .card {
            border: 1px solid #e5e7eb;
            border-radius: 12px;
            background: #fff;
            box-shadow: 0 6px 20px rgba(16, 24, 40, .06);
            margin-bottom: 16px;
        }

        .card-hd {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 14px 16px;
            border-bottom: 1px solid #f1f5f9;
        }

        .card-tt {
            margin: 0;
            font-weight: 700;
            color: #0f172a;
            font-size: 1.05rem;
        }

        .card-bd {
            padding: 14px 16px;
        }

        .kv {
            display: grid;
            grid-template-columns: 220px 1fr;
            gap: 10px 18px;
        }

        .kv dt {
            color: #6b7280;
            font-size: .78rem;
            text-transform: uppercase;
            letter-spacing: .06em;
        }

        .kv dd {
            margin: 0;
            color: #111827;
            font-size: .97rem;
        }

        .chips {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            margin-top: 6px;
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

        .chip-ok {
            background: #ecfdf5;
            color: #065f46;
            border-color: #a7f3d0;
        }

        .chip-warn {
            background: #fffbeb;
            color: #92400e;
            border-color: #fde68a;
        }

        .chip-bad {
            background: #fef2f2;
            color: #991b1b;
            border-color: #fecaca;
        }

        .item {
            border: 1px solid #f1f5f9;
            border-radius: 10px;
            padding: 12px;
            margin-top: 10px;
        }

        @media (max-width: 640px) {
            .kv {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body>
    <div class="page">
        <div class="hero">
            <div class="hero-top">
                <div class="avatar">
                    <img src="{{ asset('images/gp-Logo.png') }}" alt="logo" width="28" height="28">
                </div>
                <div>
                    <h3 class="title">{{ $position->employee->name ?? '—' }}</h3>
                    <div class="sub">#{{ $position->employee->no_employee ?? 'N/A' }} • AD:
                        {{ $position->ad ?? '—' }}
                    </div>
                </div>
                <div class="tags">
                    <span class="tag">{{ $position->position ?? '—' }}</span>
                    <span class="tag">{{ $position->departments->name ?? '—' }}</span>
                    <span class="tag">{{ $position->hotel->name ?? '—' }}</span>
                </div>
            </div>
            <div class="card-bd">
                <dl class="kv">
                    <dt>Email</dt>
                    <dd>{{ $position->email ?? '—' }}</dd>
                    <dt>Department</dt>
                    <dd>{{ $position->departments->name ?? '—' }}</dd>
                    <dt>Hotel</dt>
                    <dd>{{ $position->hotel->name ?? '—' }}</dd>
                    <dt>Position</dt>
                    <dd>{{ $position->position ?? '—' }}</dd>
                </dl>
            </div>
        </div>

        <div class="section">
            @forelse ($position->equipments as $equipo)
                <div class="card">
                    <div class="card-hd">
                        <h4 class="card-tt"><i class='bx bx-laptop'></i> {{ $equipo->tipo->name ?? 'Equipment' }}</h4>
                        <div class="chips">
                            <span class="chip">Brand: {{ $equipo->marca ?? '—' }}</span>
                            <span class="chip">Model: {{ $equipo->model ?? '—' }}</span>
                            <span class="chip mono">Serial: {{ $equipo->serial ?? '—' }}</span>
                            <span class="chip mono">IP: {{ $equipo->ip ?? '—' }}</span>
                        </div>
                    </div>
                    <div class="card-bd">
                        <dl class="kv">
                            <dt>Name</dt>
                            <dd>{{ $equipo->name ?? '—' }}</dd>
                            <dt>Lease</dt>
                            <dd>
                                @if ($equipo->leases)
                                    <span class="chip-ok">YES</span>
                                    <span class="chip mono">CODE: {{ $equipo->leases->lease ?? '—' }}</span>
                                    <span class="chip">DATE: {{ $equipo->leases->end_date ?? '—' }}</span>
                                @else
                                    <span class="chip">NO LEASE</span>
                                @endif
                            </dd>
                        </dl>

                        @if ($equipo->complements && $equipo->complements->isNotEmpty())
                            <div class="item">
                                <strong><i class='bx bxs-keyboard'></i> Complements</strong>
                                <div class="chips">
                                    @foreach ($equipo->complements as $complemento)
                                        <span class="chip">{{ $complemento->type->name ?? '—' }}</span>
                                    @endforeach
                                </div>
                                @foreach ($equipo->complements as $complemento)
                                    <dl class="kv" style="margin-top:8px;">
                                        <dt>{{ $complemento->type->name ?? 'Complement' }}</dt>
                                        <dd>
                                            <span class="chip">Brand: {{ $complemento->brand ?? '—' }}</span>
                                            <span class="chip">Model: {{ $complemento->model ?? '—' }}</span>
                                            <span class="chip mono">Serial: {{ $complemento->serial ?? '—' }}</span>
                                            @if ($complemento->lease)
                                                <span class="chip-ok">LEASE</span>
                                                <span class="chip mono">CODE:
                                                    {{ $complemento->leases->lease ?? '—' }}</span>
                                                <span class="chip">DATE:
                                                    {{ $complemento->leases->end_date ?? '—' }}</span>
                                            @else
                                                <span class="chip">NO LEASE</span>
                                            @endif
                                        </dd>
                                    </dl>
                                @endforeach
                            </div>
                        @endif

                        @if ($equipo->license && $equipo->license->isNotEmpty())
                            <div class="item">
                                <strong><i class='bx bxl-adobe'></i> Licenses</strong>
                                @foreach ($equipo->license as $licencia)
                                    @php
                                        $status = $licencia->getStatus();
                                        $cls =
                                            $status === 'Active'
                                                ? 'chip-ok'
                                                : ($status === 'Near expiration'
                                                    ? 'chip-warn'
                                                    : 'chip-bad');
                                    @endphp
                                    <dl class="kv" style="margin-top:8px;">
                                        <dt>{{ $licencia->type ?? 'License' }}</dt>
                                        <dd>
                                            <span class="chip mono">Key: {{ $licencia->key ?? '—' }}</span>
                                            <span class="chip">End: {{ $licencia->end_date ?? 'N/A' }}</span>
                                            <span class="chip {{ $cls }}">{{ $status }}</span>
                                        </dd>
                                    </dl>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            @empty
                <div class="card">
                    <div class="card-bd">No equipment assigned.</div>
                </div>
            @endforelse
        </div>
    </div>
</body>

</html>
