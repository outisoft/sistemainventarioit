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

</head>

<body>
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <div class="layout-page">
                <div class="content-wrapper">
                    <main>
                        <div class="content-wrapper">
                            <div class="container-xxl flex-grow-1 container-p-y">
                                <!--h4 class="fw-bold py-3 mb-4">DETAILS </h4-->

                                <!-- Basic Bootstrap Table -->
                                <div class="card">
                                    <div class="content-wrapper">
                                        <div class="table-responsive text-nowrap">
                                            <div class="card-datatable table-responsive pt-0">
                                                <div class="container">
                                                    <div class="mb-3"><br>
                                                        <p>
                                                            <a class="btn" href="#">
                                                                <img src="{{ asset('images/gp-Logo.png') }}"
                                                                    alt="Imagen de ejemplo" width="36"
                                                                    height="36" />
                                                            </a>
                                                            #{{ $position->employee->no_employee }} / {{ $position->ad }}
                                                        </p>
                                                        <h3 class="name">{{ $position->employee->name }}</h3>
                                                        <h6>{{ $position->position }} /
                                                            {{ $position->departments->name }} /
                                                            {{ $position->hotel->name }}</h6>
                                                        <h6 class="email">{{ $position->email }} <i
                                                                class="fas fa-chevron-right"></i></h6>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <br>

                                @foreach ($position->equipments as $equipo)
                                    <div class="card">
                                        <div class="content-wrapper">
                                            <div class="table-responsive text-nowrap">
                                                <div class="card-datatable table-responsive pt-0">
                                                    <div class="container">
                                                        <div class="mb-3"><br>
                                                            <p>
                                                                <i class='bx bx-laptop'></i>
                                                                {{ $equipo->tipo->name }}
                                                            </p>
                                                            <h3 class="name">{{ $equipo->name }}</h3>
                                                            <h6>{{ $equipo->marca }} / {{ $equipo->model }} /
                                                                {{ $equipo->serial }}</h6>
                                                            <h6 class="email">{{ $equipo->ip }}<i
                                                                    class="fas fa-chevron-right"></i>
                                                            </h6>
                                                            <h6>
                                                                @if ($equipo->lease)
                                                                    CODE: <span
                                                                        class="badge bg-label-dark">{{ $equipo->code }}</span><br>
                                                                    DATE: <span
                                                                        class="badge bg-label-info">{{ $equipo->date }}</span>
                                                                @else
                                                                    NO LEASE
                                                                @endif
                                                            </h6>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div><br>
                                @endforeach

                                @if ($equipo->complements->isEmpty())
                                @else
                                    @foreach ($equipo->complements as $complemento)
                                        <div class="card">
                                            <div class="content-wrapper">
                                                <div class="table-responsive text-nowrap">
                                                    <div class="card-datatable table-responsive pt-0">
                                                        <div class="container">
                                                            <div class="mb-3"><br>
                                                                <p>
                                                                    <i class='bx bxs-keyboard'></i>
                                                                    COMPLEMENT
                                                                </p>
                                                                <h3 class="name"> {{ $complemento->type->name }}
                                                                </h3>
                                                                <h6>{{ $complemento->brand }} /
                                                                    {{ $complemento->model }} /
                                                                    {{ $complemento->serial }}</h6>
                                                                <h6 class="email">
                                                                    @if ($complemento->lease)
                                                                        CODE: <span
                                                                            class="badge bg-label-dark">{{ $complemento->code }}</span><br>
                                                                        DATE: <span
                                                                            class="badge bg-label-info">{{ $complemento->date }}</span>
                                                                    @else
                                                                        NO LEASE
                                                                    @endif
                                                                    <i class="fas fa-chevron-right"></i>
                                                                </h6>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div><br>
                                    @endforeach
                                @endif

                                @if ($equipo->license->isEmpty())
                                @else
                                    @foreach ($equipo->license as $licencia)
                                        <div class="card">
                                            <div class="content-wrapper">
                                                <div class="table-responsive text-nowrap">
                                                    <div class="card-datatable table-responsive pt-0">
                                                        <div class="container">
                                                            @php
                                                                $statusClass = [
                                                                    'Active' => 'badge bg-label-success',
                                                                    'Near expiration' => 'badge bg-label-warning',
                                                                    'Expired' => 'badge bg-label-danger',
                                                                ][$licencia->getStatus()];
                                                            @endphp
                                                            <div class="mb-3"><br>
                                                                <p>
                                                                    <i class='bx bxl-adobe'></i>
                                                                    LICENCE
                                                                </p>
                                                                <h3 class="name">{{ $licencia->type }}</h3>
                                                                <h6>{{ $licencia->key }} </h6>
                                                                <h6 class="email">{{ $licencia->end_date ?? 'N/A' }}<i
                                                                        class="fas fa-chevron-right"></i>
                                                                </h6>
                                                                <h6>
                                                                    <span
                                                                        class="{{ $statusClass }}">{{ $licencia->getStatus() }}
                                                                </h6>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div><br>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </main>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
