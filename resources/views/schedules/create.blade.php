<!--Modal create-->
<div class="modal fade" id="modalCreate" tabindex="-1" role="dialog" aria-labelledby="modalCreate">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="POST" action="{{ route('schedules.store') }}">
                @csrf
                <div class="modal-header">
                    <h4 class="modal-title" id="modalCreate">NEW SCHEDULES</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true"></span></button>
                </div>

                <div class="modal-body">
                    <div class="mb-3">
                        <label>User</label>
                        @role('Administrator')
                            <select name="employee_id" class="form-select">
                                @foreach($employees as $employee)
                                    <option value="{{ $employee->id }}">
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
                                            <option value="{{ $employee->id }}">{{ $employee->name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            @else
                                <input type="hidden" name="employee_id" value="{{ auth()->user()->id }}"><input type="hidden" name="employee_id" value="{{ auth()->user()->id }}">
                                <p>{{ auth()->user()->name }}</p>
                            @endrole             
                        @endrole
                    </div>

                    <div class="mb-3">
                        <label>Week</label>
                            <input type="week" name="week" class="form-control" required   <input type="week" name="week" class="form-control" required 
                                min="{{ now()->subYear()->format('Y-W') }}"
                                max="{{ now()->addYear()->format('Y-W') }}">
                    </div>
                        
                    <div class="mb-3">
                            <label>Working Days</label>
                            @foreach(['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'] as $day)
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" k-input" type="checkbox" 
                                        name="days[]" id="day_{{ $day }}" value="{{ $day }}">
                                    <label class="form-check-label" for="day_{{ $day }}">
                                        {{ ucfirst($day) }}
                                    </label>     
                                </div>                               
                            @endforeach
                    </div>

                    <div class="mb-3">
                        <label>Hora de entrada</label>
                        <input type="time" name="start_time" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label>Hora de salida</label> 
                        <input type="time" name="end_time" class="form-control" required>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> 
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>   
        </div>        
    </div>
</div>
