<!-- Modales de Edición -->
@foreach ($schedules as $schedule)
    <div class="modal fade" id="editModal{{ $schedule->id }}" tabindex="-1" aria-labelledby="editModal{{ $schedule->id }}"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModal{{ $schedule->id }}">Editar schedule: </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('schedules.update', $schedule) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label>User</label>
                            @role('Administrator')
                                <select name="employee_id" class="form-select">
                                    @foreach($employees as $employee)
                                        <option value="{{ $employee->id }}" {{ $schedule->employee_id == $employee->id ? 'selected' : '' }}>
                                            {{ $employee->name }}
                                            ({{ $employee->regions->first()->name ?? 'No Region' }})
                                        </option>
                                    @endforeach
                                </select>
                            @else
                                @role('Regional Administrator')
                                    <select name="employee_id" class="form-select">
                                        @foreach($employees as $employee)
                                            @if($employee->region_id == auth()->user()->region_id)
                                                <option value="{{ $employee->id }}" {{ $schedule->employee_id == $employee->id ? 'selected' : '' }}>{{ $employee->name }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                @else
                                    <input type="hidden" name="employee_id" value="{{ auth()->user()->id }}">
                                    <p>{{ auth()->user()->name }}</p>
                                @endrole             
                            @endrole
                        </div>

                        <div class="mb-3">
                            <label>Semana</label>
                            <input type="week" name="week" class="form-control" required 
                                value="{{ $schedule->week_start_date->format('Y-\WW') }}">
                        </div>

                        <div class="mb-3">
                            <label>Días de Trabajo</label>
                            @foreach($days as $day)
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" 
                                        name="days[]" id="day_{{ $day }}" value="{{ $day }}"
                                        {{ in_array($day, $schedule->days) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="day_{{ $day }}">
                                        {{ ucfirst($day) }}
                                    </label>
                                </div>
                            @endforeach
                        </div>

                        <div class="mb-3">
                            <label>Hora de Entrada</label>
                            <input type="time" name="start_time" class="form-control" required 
                                value="{{ $schedule->start_time }}">
                        </div>

                        <div class="mb-3">
                            <label>Hora de Salida</label>
                            <input type="time" name="end_time" class="form-control" required 
                                value="{{ $schedule->end_time }}">
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endforeach
