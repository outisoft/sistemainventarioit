<x-app-layout>
    <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"> Assign /</span> Details </h4>

            <!-- Basic Bootstrap Table -->
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-header">DETAILS BY <strong>{{ $empleado->name }} </strong></h5>
                    <div class="navbar-nav align-items-center">
                        <div class="nav-item d-flex align-items-center">
                            <a href="{{ route('generateQRCode', $empleado->id) }}" target="_blank" class="btn-ico" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="top" data-bs-html="true" title="" data-bs-original-title="<span>QR Code</span>">
                                <i class='bx bx-qr-scan icon-lg'></i>
                            </a>
                            <a href="{{ route('save-pdf', $empleado->id) }}" target="_blank" class="btn-ico" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="top" data-bs-html="true" title="" data-bs-original-title="<span>Responsive sheet</span>">
                                <i class='bx bxs-file-pdf icon-lg'></i>
                            </a>
                        </div>
                    </div>
                </div>       

                <div class="content-wrapper">
                    <div class="table-responsive text-nowrap">
                        <div class="card-datatable table-responsive pt-0">
                            <div class="card-body">
                                <table class="table" BORDER=1 CELLPADDING=5 CELLSPACING=5>
                                    <tr>
                                        <th class="bg-secondary">No. EMPLOYEE</th>
                                        <td>{{ $empleado->no_empleado }}</td>
                                    </tr>
                                    <tr>
                                        <th class="bg-secondary">NAME</th>
                                        <td>{{ $empleado->name }}</td>
                                    </tr>
                                    <tr>
                                        <th class="bg-secondary">EMAIL</th>
                                        <td>{{ $empleado->email }}</td>
                                    </tr>
                                    <tr>
                                        <th class="bg-secondary">JOB</th>
                                        <td>{{ $empleado->puesto }}</td>
                                    </tr>
                                    <tr>
                                        <th class="bg-secondary">DEPARTMENT</th>
                                        <td>{{ $departamento->name }}</td>
                                    </tr>
                                    <tr>
                                        <th class="bg-secondary">HOTEL</th>
                                        <td>{{ $hotel->name }}</td>
                                    </tr>
                                    <tr>
                                        <th class="bg-secondary">AD</th>
                                        <td>{{ $empleado->ad }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>      

                @if ($equiposAsignados->count() > 0)
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h6 class="card-header">ASSIGNED EQUIPMENT</strong></h6>
                </div>

                <table id="empleados" class="table table-striped footer">
                    <thead class="bg-primary">
                        <tr>
                            <th>EQUIPMENT TYPE</th>
                            <th>BRAND</th>
                            <th>MODEL</th>
                            <th>SERIAL</th>
                            <th>EQUIPMENT NAME</th>
                            <th>IP</th>
                            <th>OPERATING SYSTEM</th>
                            <th>ACTIONS</th>
                        </tr>
                    </thead>
                    <tbody id="employeeList">
                        <!-- Aquí se mostrarán los empleados -->
                        @foreach ($equiposAsignados as $equipo)
                            <tr>
                                <td>
                                    {{ $equipo->tipo->name }}
                                </td>
                                <td>
                                    {{ $equipo->marca }}
                                </td>
                                <td>
                                    {{ $equipo->model }}
                                </td>
                                <td>
                                    {{ $equipo->serial }}
                                </td>
                                <td>
                                    {{ $equipo->name }}
                                </td>
                                <td>
                                    {{ $equipo->ip }}
                                </td>
                                <td>
                                    {{ $equipo->so }}
                                </td>
                                <td>
                                    <a href="{{ route('desvincular', ['empleado_id' => $empleado->id, 'equipo_id' => $equipo->id]) }}"
                                        data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="top" data-bs-html="true" title="" data-bs-original-title="<span>Unlink employee equipment</span>"
                                        class="btn btn-danger btn-sm"><i class='bx bx-trash'></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                @else
                <div class="card-header">
                    <p>No equipment(s) assigned.<a href="{{ route('equipo.index') }}"> Add equipment(s) -></a></p>
                </div>
                @endif
                
                @if ($complementosAsignados->count() > 0)
                    <div class="card-header">
                        <h6 class="card-header">ASSIGNED COMPLEMENT</strong></h6>
                    </div>
                    <table id="empleados" class="table table-striped footer">
                        <thead class="bg-primary">
                            <tr>
                                <th>EQUIPMENT TYPE</th>
                                <th>BRAND</th>
                                <th>MODEL</th>
                                <th>SERIAL</th>
                            </tr>
                        </thead>
                        <tbody id="employeeList">
                            <!-- Aquí se mostrarán los empleados -->
                            @foreach ($complementosAsignados as $complemento)
                                <tr>
                                    <td>
                                        {{ $complemento->type->name }}
                                    </td>
                                    <td>
                                        {{ $complemento->brand }}
                                    </td>
                                    <td>
                                        {{ $complemento->model }}
                                    </td>
                                    <td>
                                        {{ $complemento->serial }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                <div class="card-header">
                    <p>No complement(s) assigned. <a href="{{ route('complements.index') }}"> Add complement(s) -></a></p>
                </div>
                @endif
                <br>
            </div>
            <br>
            
            <a href="{{ route('assignment.index') }}" class="btn btn-secondary"><i
            class='bx bx-arrow-back'></i>RETURN</a>
            <!--/ Basic Bootstrap Table -->
            <hr class="my-5" />
        </div>
        <!-- / Content -->
    </div>
</x-app-layout>
