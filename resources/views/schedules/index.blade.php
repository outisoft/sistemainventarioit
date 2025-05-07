<x-app-layout>
@include('schedules.create')
@include('schedules.edit')

    <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">

            <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-style1">
                    <li class="breadcrumb-item active fw-bold">SCHEDULES</li>
                </ol>
            </nav>
            
            <style>                
                .container {
                    max-width: 1200px;
                    margin: 0 auto;
                    background-color: white;
                    border-radius: 10px;
                    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
                    overflow: hidden;
                }
                
                header {
                    background-color: #2c3e50;
                    color: white;
                    padding: 25px;
                    text-align: center;
                }
                .title {
                    color = white;
                }

                h1 {
                    margin: 0;
                    font-size: 28px;
                }
                
                .subtitle {
                    font-size: 16px;
                    margin-top: 8px;
                    opacity: 0.9;
                }
                
                .schedule-container {
                    padding: 20px;
                    overflow-x: auto;
                }
                
                table {
                    width: 100%;
                    border-collapse: collapse;
                    margin-top: 10px;
                }
                
                th, td {
                    border: 1px solid #e1e5eb;
                    padding: 12px;
                    text-align: center;
                }
                
                th {
                    background-color: #34495e;
                    color: white;
                    font-weight: 600;
                    position: sticky;
                    top: 0;
                }
                
                tr:nth-child(even) {
                    background-color: #f9f9f9;
                }
                
                .employee-name {
                    font-weight: 600;
                    text-align: left;
                    background-color: #f1f5f9;
                    position: sticky;
                    left: 0;
                }
                
                .morning-shift {
                    background-color: #e6f3ff;
                    color: #0066cc;
                }
                
                .afternoon-shift {
                    background-color: #fff0e6;
                    color: #cc6600;
                }
                
                .full-day {
                    background-color: #e6ffe6;
                    color: #006600;
                }
                
                .day-off {
                    background-color: #f8f8f8;
                    color: #999;
                }
                
                .weekend-shift {
                    background-color: #f0e6ff;
                    color: #6600cc;
                }
                
                .legend {
                    display: flex;
                    flex-wrap: wrap;
                    gap: 15px;
                    margin: 20px 0;
                    justify-content: center;
                }
                
                .legend-item {
                    display: flex;
                    align-items: center;
                    font-size: 14px;
                }
                
                .legend-color {
                    width: 20px;
                    height: 20px;
                    margin-right: 8px;
                    border: 1px solid #ddd;
                    border-radius: 4px;
                }
                
                footer {
                    text-align: center;
                    padding: 15px;
                    color: #666;
                    font-size: 14px;
                    border-top: 1px solid #eee;
                }
                
                @media (max-width: 768px) {
                    th, td {
                        padding: 8px 5px;
                        font-size: 14px;
                    }
                    
                    h1 {
                        font-size: 22px;
                    }
                    
                    .legend {
                        flex-direction: column;
                        align-items: flex-start;
                        gap: 8px;
                    }
                }
                /* En tu archivo CSS */
                .morning-shift { background-color: #e6f3ff; color: #0066cc; }
                .afternoon-shift { background-color: #fff0e6; color: #cc6600; }
                .full-day { background-color: #e6ffe6; color: #006600; }
                .weekend-shift { background-color: #f0e6ff; color: #6600cc; }
                .day-off { background-color: #f8f8f8; color: #999; }
            </style>

            <!-- Mostrar la tabla de horarios -->
            <div class="card">
                <header>
                    <h1 class="title">Horario de Empleados</h1>
                    <div class="subtitle">Programación Semanal de Turnos</div>
                </header>

                <div class="card-header">
                    <form action="{{ route('schedules.index') }}" method="GET" class="form-inline">
                        <label for="week" class="mr-2">Select Week:</label>
                        <input type="week" name="week" class="form-control mr-2" 
                            value="{{ request('week') ?? date('Y-\WW') }}">
                            <br>
                        <button type="submit" class="btn btn-primary">Show</button>
                        <a href="{{ route('schedules.index', ['week' => date('Y-\WW', strtotime('-1 week'))]) }}" 
                            class="btn btn-secondary ml-2">Previous Week</a>
                        <a href="{{ route('schedules.index', ['week' => date('Y-\WW', strtotime('+1 week'))]) }}" 
                        class="btn btn-secondary ml-2">Next Week</a>
                    </form>
                </div>
                
                <div class="schedule-container">
                <h5 class="card-title">
                    Week {{ $weekStart->format('m/d/Y') }} to {{ $weekEnd->format('m/d/Y') }}
                </h5>
                    <div class="legend">
                        <div class="legend-item">
                            <div class="legend-color morning-shift"></div>
                            <span>Turno Mañana</span>
                        </div>
                        <div class="legend-item">
                            <div class="legend-color afternoon-shift"></div>
                            <span>Turno Tarde</span>
                        </div>
                        <div class="legend-item">
                            <div class="legend-color full-day"></div>
                            <span>Jornada Completa</span>
                        </div>
                        <div class="legend-item">
                            <div class="legend-color weekend-shift"></div>
                            <span>Turno Fin de Semana</span>
                        </div>
                        <div class="legend-item">
                            <div class="legend-color day-off"></div>
                            <span>Día Libre</span>
                        </div>
                        <div class="legend-item">
                            <a href="#" class="btn-ico" data-bs-toggle="modal" data-bs-target="#modalCreate"
                                data-placement="top" title="Add new schedule">
                                <i class='bx bx-calendar-plus icon-lg' ></i>
                            </a>
                        </div>
                    </div>
                    
                    <table>
                        <thead class="bg-primary">
                            <tr>
                                <th>User</th>
                                <th>Lunes</th>
                                <th>Martes</th>
                                <th>Miércoles</th>
                                <th>Jueves</th>
                                <th>Viernes</th>
                                <th>Sábado</th>
                                <th>Domingo</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($employees as $employee)
                                <tr>
                                    <td>{{ $employee->name }}</td>
                                    @foreach(['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'] as $day)
                                        @php
                                            $daySchedules = $employee->schedules()
                                                ->where('week_start_date', $weekStart->format('Y-m-d'))
                                                ->whereJsonContains('days', $day)
                                                ->get();
                                        @endphp
                                        <td>
                                            @if($daySchedules->isNotEmpty())
                                                @foreach($daySchedules as $schedule)
                                                    <div>
                                                        {{ \Carbon\Carbon::parse($schedule->start_time)->format('g:i A') }}
                                                        -
                                                        {{ \Carbon\Carbon::parse($schedule->end_time)->format('g:i A') }}
                                                        @if(auth()->user()->hasRole('Administrator') || 
                                                            (auth()->user()->hasRole('Regional Administrator') && $employee->region_id == auth()->user()->region_id) || 
                                                            (auth()->user()->id == $employee->id))
                                                            <a href="#" data-bs-toggle="modal"
                                                                data-bs-target="#editModal{{ $schedule->id }}"
                                                                class="btn btn-sm btn-warning"><i
                                                                    class="bx bx-edit"></i>
                                                            </a>
                                                        @endif
                                                    </div>
                                                @endforeach
                                            @else
                                                Off
                                            @endif
                                        </td>
                                    @endforeach
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                
                <footer>
                    <p>Horario actualizado: {{ now()->format('F Y') }} | Departamento de Recursos Humanos</p>
                </footer>
            </div>
        </div>
        <!-- / Content -->
    </div>
</x-app-layout>