<x-app-layout>
    <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">

            <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-style1">
                    <li class="breadcrumb-item">
                        <a href="{{ route('phones.index') }}">PHONES</a>
                    </li>
                    <li class="breadcrumb-item active fw-bold">DETAILS</li>
                </ol>
            </nav>

            <!-- info de licensia -->
            <div class="card">
                <div class="content-wrapper">
                    <div class="table-responsive text-nowrap">
                        <div class="card-datatable table-responsive pt-0">
                            <div class="card-body">
                                <h4>Details</h4>
                                <h7><strong>Extension:</strong> {{ $phone->extension }}</h7> <br>
                                <h7><strong>Service:</strong> {{ $phone->service }}</h7> <br>
                                <h7><strong>Model:</strong> {{ $phone->model }}</h7> <br>
                                <h7><strong>Serial:</strong> {{ $phone->serial }}</h7> <br>
                            </div>
                            @if ($phone->employees->isNotEmpty())
                                @foreach ($phone->employees as $employee)
                                    <div class="card-body">
                                        <h4>Employee</h4>
                                        <h7><strong>Name:</strong> {{ $employee->name }} </h7> <br>
                                        <h7><strong>Position:</strong> {{ $employee->puesto }}</h7> <br>
                                        <h7><strong>Department:</strong> {{ $employee->departments->name }}</h7> <br>
                                        <h7><strong>Hotel:</strong> {{ $employee->hotel->name }}</h7> <br>
                                        <h7><strong>Email:</strong> {{ $employee->email }}</h7> <br>
                                        <p class="col-12 text-center d-flex aling-items-center">
                                            <form
                                                action="{{ route('phone.desasignar', ['phoneId' => $phone->id, 'employeeId' => $employee->id]) }}"
                                                method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger d-grid"><i class='bx bx-trash'></i>
                                                </button>
                                            </form>
                                        </p>
                                    </div>
                                @endforeach
                            @else
                            <div class="card-body">
                                <h7>No employee assigned</h7> <br>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <!--info de empleados -->
            @if ($phone->employees->count() >= 1)
                <div class="alert alert-warning">
                    Límite de asignaciones alcanzado ({{ $phone->employees->count() }}/1. No se
                    pueden asignar más telefonos a este empleado.
                </div>
            @else
                <div class="card">
                    <div class="content-wrapper">
                        <div class="table-responsive text-nowrap">
                            <div class="card-datatable table-responsive pt-0">
                                <div class="card-body">
                                    <h5>Empleados Disponibles</h5>
                                    <table id="officees" class="table footer">
                                        <thead class="bg-primary">
                                            <tr>
                                                <th>Nombre</th>
                                                <th>Puesto</th>
                                                <th>Departamento</th>
                                                <th>Hotel</th>
                                                <th>Email</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($employees as $employee)
                                                <tr>
                                                    <td>{{ $employee->name }}</td>
                                                    <td>{{ $employee->puesto }}</td>
                                                    <td>{{ $employee->departments->name }}</td>
                                                    <td>{{ $employee->hotel->name }}</td>
                                                    <td>{{ $employee->email }}</td>
                                                    <td>
                                                        <form
                                                            action="{{ route('phone.asignar', ['phoneId' => $phone->id, 'employeeId' => $employee->id]) }}"
                                                            method="POST">
                                                            @csrf
                                                            <button type="submit"
                                                                class="btn btn-primary btn-sm">Asignar</button>
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
                </div>
            @endif
            <br>
            <a href="{{ route('phones.index') }}" class="btn btn-secondary"><i class='bx bx-arrow-back'></i>Volver</a>

            <hr class="my-5" />

        </div>
        <!-- / Content -->
    </div>
</x-app-layout>
