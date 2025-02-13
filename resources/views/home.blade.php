<x-app-layout>

    <div class="container-xxl flex-grow-1 container-p-y">
        <h5 class="mb-2">WELCOME BACK,<span class="h4"> {{ Auth::user()->name }}! 👋🏻</span></h5>

        <!--Property Section Here-->
        <section id="property-section">
            <!--Property List Slider Her-->
            <div id="property-slider">
                <!-- Slider main container -->
                <div class="swiper">
                    <!-- Additional required wrapper -->
                    <div class="swiper-wrapper">
                        <!-- Slides -->
                        <!-- SW / APS -->
                        <div class="swiper-slide">
                            <div class="row">
                                <!-- Switches -->
                                @can('switches.index')
                                    <div class="col-6 mb-4">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="card-title d-flex align-items-start justify-content-between">
                                                    <div class="avatar flex-shrink-0">
                                                        <i class='bx bx-server bx-lg rounded'
                                                            style="font-size: 2rem; color: #b5a160;"></i>
                                                    </div>
                                                </div>
                                                <span class="fw-semibold d-block mb-1">Switches</span>
                                                <h3 class="card-title text-nowrap mb-2">{{ $totalSw }}</h3>
                                                <small class="text-primary fw-semibold"> <a
                                                        href="{{ route('switches.index') }}">Show<i
                                                            class='bx bx-right-arrow-alt'></i></a></small>
                                            </div>
                                        </div>
                                    </div>
                                @endcan

                                <!-- Access Points -->
                                @can('access_points.index')
                                    <div class="col-6 mb-4">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="card-title d-flex align-items-start justify-content-between">
                                                    <div class="avatar flex-shrink-0">
                                                        <i class='bx bx-broadcast bx-lg rounded'
                                                            style="font-size: 2rem; color: #b5a160;"></i>
                                                    </div>
                                                </div>
                                                <span class="fw-semibold d-block mb-1">Access Points</span>
                                                <h3 class="card-title mb-2">{{ $totalAps }}</h3>
                                                <small class="text-primary fw-semibold"> <a
                                                        href="{{ route('access-points.index') }}">Show<i
                                                            class='bx bx-right-arrow-alt'></i></a></small>
                                            </div>
                                        </div>
                                    </div>
                                @endcan
                            </div>
                        </div>

                        <!-- coming2 / TPVS -->
                        <div class="swiper-slide">
                            <div class="row">
                                <!-- coming2 -->
                                @can('coming2.index')
                                    <div class="col-6 mb-4">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="card-title d-flex align-items-start justify-content-between">
                                                    <div class="avatar flex-shrink-0">
                                                        <i class='bx bx-tab bx-lg rounded'
                                                            style="font-size: 2rem; color: #b5a160;"></i>
                                                    </div>
                                                </div>
                                                <span class="fw-semibold d-block mb-1">Coming2</span>
                                                <h3 class="card-title text-nowrap mb-2">{{ $totalComing2 }}</h3>
                                                <small class="text-primary fw-semibold"> <a
                                                        href="{{ route('coming2.index') }}">Show<i
                                                            class='bx bx-right-arrow-alt'></i></a></small>
                                            </div>
                                        </div>
                                    </div>
                                @endcan

                                <!-- TPVS -->
                                @can('tpvs.index')
                                    <div class="col-6 mb-4">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="card-title d-flex align-items-start justify-content-between">
                                                    <div class="avatar flex-shrink-0">
                                                        <i class='bx bx-tv bx-lg rounded'
                                                            style="font-size: 2rem; color: #b5a160;"></i>
                                                    </div>
                                                </div>
                                                <span class="fw-semibold d-block mb-1">Tpv's</span>
                                                <h3 class="card-title mb-2">{{ $totalTpvs }}</h3>
                                                <small class="text-primary fw-semibold"> <a
                                                        href="{{ route('tpvs.index') }}">Show<i
                                                            class='bx bx-right-arrow-alt'></i></a></small>
                                            </div>
                                        </div>
                                    </div>
                                @endcan
                            </div>
                        </div>

                        <!-- Users / ** -->
                        <div class="swiper-slide">
                            <div class="row">
                                <!-- Users -->
                                @can('users.index')
                                    <div class="col-6 mb-4">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="card-title d-flex align-items-start justify-content-between">
                                                    <div class="avatar flex-shrink-0">
                                                        <i class='bx bx-user bx-lg rounded'
                                                            style="font-size: 2rem; color: #b5a160;"></i>
                                                    </div>
                                                </div>
                                                <span class="fw-semibold d-block mb-1">Users</span>
                                                <h3 class="card-title text-nowrap mb-2">{{ $totalUsuarios }}</h3>
                                                <small class="text-primary fw-semibold"> <a
                                                        href="{{ route('users.index') }}">Show<i
                                                            class='bx bx-right-arrow-alt'></i></a></small>
                                            </div>
                                        </div>
                                    </div>
                                @endcan
                            </div>
                        </div>


                        <!--Employees / Equipments -->
                        <div class="swiper-slide">
                            <div class="row">
                                <!--Employees-->
                                @can('empleados.index')
                                    <div class="col-6 mb-4">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="card-title d-flex align-items-start justify-content-between">
                                                    <div class="avatar flex-shrink-0">
                                                        <i class='bx bx-user-pin bx-lg rounded'
                                                            style="font-size: 2rem; color: #b5a160;"></i>
                                                    </div>
                                                </div>
                                                <span class="fw-semibold d-block mb-1">Employees</span>
                                                <h3 class="card-title mb-2">{{ $totalEmpleados }}</h3>
                                                <small class="text-primary fw-semibold"> <a
                                                        href="{{ route('empleados.index') }}">Show<i
                                                            class='bx bx-right-arrow-alt'></i></a></small>
                                            </div>
                                        </div>
                                    </div>
                                @endcan

                                <!--Equipments-->
                                @can('equipo.index')
                                    <div class="col-6 mb-4">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="card-title d-flex align-items-start justify-content-between">
                                                    <div class="avatar flex-shrink-0">
                                                        <i class='bx bx-desktop bx-lg rounded'
                                                            style="font-size: 2rem; color: #b5a160;"></i>
                                                    </div>
                                                </div>
                                                <span class="fw-semibold d-block mb-1">Equipments</span>
                                                <h3 class="card-title text-nowrap mb-1">{{ $totalEquipos }}</h3>
                                                <small class="text-primary fw-semibold"> <a
                                                        href="{{ route('equipo.index') }}">Show<i
                                                            class='bx bx-right-arrow-alt'></i></a></small>
                                            </div>
                                        </div>
                                    </div>
                                @endcan
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <!--/Property List Slider Her-->
        </section>
        <!--/Property Section Here-->



        <div class="row">
            <!-- EQUIPMENTS TOTAL -->
            <div class="col-md-6 col-lg-4 col-xl-4 order-0 mb-4">
                <div class="card h-100">
                    <div class="card-header d-flex align-items-center justify-content-between pb-0">
                        <div class="card-title mb-0">
                            <h5 class="m-0 me-2">Total Equipments</h5>
                            <small class="text-muted">{{ $totalEquipos }} Total Equipments</small>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div class="d-flex flex-column align-items-center gap-1">
                                <h2 class="mb-2">{{ $totalEquipos }}</h2>
                                <span>Total Equipments</span>
                            </div>
                            <div id="orderStatisticsChart"></div>
                        </div>
                        <ul class="p-0 m-0">
                            <li class="d-flex mb-4 pb-1">
                                <div class="avatar flex-shrink-0 me-3">
                                    <span class="avatar-initial rounded bg-label-primary">
                                        <i class='bx bx-hdd'></i>
                                    </span>
                                </div>
                                <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                    <div class="me-2">
                                        <h6 class="mb-0">Desktop(s)</h6>
                                        <small class="text-muted">Totals</small>
                                    </div>
                                    <div class="user-progress">
                                        <small class="fw-semibold">#{{ $totalDesktops }}</small>
                                    </div>
                                </div>
                            </li>

                            <li class="d-flex mb-4 pb-1">
                                <div class="avatar flex-shrink-0 me-3">
                                    <span class="avatar-initial rounded bg-label-success">
                                        <i class='bx bx-laptop'></i>
                                    </span>
                                </div>
                                <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                    <div class="me-2">
                                        <h6 class="mb-0">Laptop(s)</h6>
                                        <small class="text-muted">Totals</small>
                                    </div>
                                    <div class="user-progress">
                                        <small class="fw-semibold">#{{ $totalLaptops }}</small>
                                    </div>
                                </div>
                            </li>

                            <li class="d-flex mb-4 pb-1">
                                <div class="avatar flex-shrink-0 me-3">
                                    <span class="avatar-initial rounded bg-label-danger">
                                        <i class='bx bx-dots-horizontal-rounded'></i>
                                    </span>
                                </div>
                                <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                    <div class="me-2">
                                        <h6 class="mb-0">Other(s)</h6>
                                        <small class="text-muted">Totals</small>
                                    </div>
                                    <div class="user-progress">
                                        <small class="fw-semibold">#{{ $totalOther }}</small>
                                    </div>
                                </div>
                            </li>

                            <li class="d-flex mb-4 pb-1">
                                <div class="avatar flex-shrink-0 me-3">
                                    <span class="avatar-initial rounded bg-label-warning">
                                        <i class="bx bx-mobile-alt"></i>
                                    </span>
                                </div>
                                <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                    <div class="me-2">
                                        <h6 class="mb-0">Phone(s)</h6>
                                        <small class="text-muted">Totals</small>
                                    </div>
                                    <div class="user-progress">
                                        <small class="fw-semibold">#{{ $totalPhone }}</small>
                                    </div>
                                </div>
                            </li>

                            <li class="d-flex mb-4 pb-1">
                                <div class="avatar flex-shrink-0 me-3">
                                    <span class="avatar-initial rounded bg-label-info">
                                        <i class='bx bx-printer'></i>
                                    </span>
                                </div>
                                <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                    <div class="me-2">
                                        <h6 class="mb-0">Printer(s)</h6>
                                        <small class="text-muted">Totals</small>
                                    </div>
                                    <div class="user-progress">
                                        <small class="fw-semibold">#{{ $totalPrinter }}</small>
                                    </div>
                                </div>
                            </li>

                            <li class="d-flex">
                                <div class="avatar flex-shrink-0 me-3">
                                    <span class="avatar-initial rounded bg-label-secondary">
                                        <i class='bx bx-tab'></i>
                                    </span>
                                </div>
                                <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                    <div class="me-2">
                                        <h6 class="mb-0">Tablet(s)</h6>
                                        <small class="text-muted">Totals</small>
                                    </div>
                                    <div class="user-progress">
                                        <small class="fw-semibold">#{{ $totalTablet }}</small>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <!--/ EQUIPMENTS TOTAL -->
            </div>

            <!-- COMPLEMENTS -->
            <div class="col-md-6 col-lg-4 order-2 mb-4">
                <div class="card h-100">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h5 class="card-title m-0 me-2">Complement(s)</h5>
                    </div>
                    <div class="card-body">
                        <ul class="p-0 m-0">

                            <!--CHARGER-->
                            <li class="d-flex mb-4 pb-1">
                                <div class="avatar flex-shrink-0 me-3">
                                    <span class="avatar-initial rounded bg-label-primary">
                                        <i class='bx bx-plug'></i>
                                    </span>
                                </div>
                                <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                    <div class="me-2">
                                        <small class="text-muted d-block mb-1">Totals</small>
                                        <h6 class="mb-0">Charger(s)</h6>
                                    </div>
                                    <div class="user-progress d-flex align-items-center gap-1">
                                        <h6 class="mb-0">#</h6>
                                        <span class="text-muted">{{ $totalCharger }}</span>
                                    </div>
                                </div>
                            </li>

                            <!--MONITORS-->
                            <li class="d-flex mb-4 pb-1">
                                <div class="avatar flex-shrink-0 me-3">
                                    <span class="avatar-initial rounded bg-label-info">
                                        <i class='bx bx-desktop'></i>
                                    </span>
                                </div>
                                <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                    <div class="me-2">
                                        <small class="text-muted d-block mb-1">Totals</small>
                                        <h6 class="mb-0">Monitor(s)</h6>
                                    </div>
                                    <div class="user-progress d-flex align-items-center gap-1">
                                        <h6 class="mb-0">#</h6>
                                        <span class="text-muted">{{ $totalMonitor }}</span>
                                    </div>
                                </div>
                            </li>

                            <!--MOUSE-->
                            <li class="d-flex mb-4 pb-1">
                                <div class="avatar flex-shrink-0 me-3">
                                    <span class="avatar-initial rounded bg-label-danger">
                                        <i class='bx bx-mouse-alt'></i>
                                    </span>
                                </div>
                                <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                    <div class="me-2">
                                        <small class="text-muted d-block mb-1">Totals</small>
                                        <h6 class="mb-0">Mouse(s)</h6>
                                    </div>
                                    <div class="user-progress d-flex align-items-center gap-1">
                                        <h6 class="mb-0">#</h6>
                                        <span class="text-muted">{{ $totalMouse }}</span>
                                    </div>
                                </div>
                            </li>

                            <!--NO BREACK-->
                            <li class="d-flex mb-4 pb-1">
                                <div class="avatar flex-shrink-0 me-3">
                                    <span class="avatar-initial rounded bg-label-warning">
                                        <i class='bx bxs-car-battery'></i>
                                    </span>
                                </div>
                                <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                    <div class="me-2">
                                        <small class="text-muted d-block mb-1">Totals</small>
                                        <h6 class="mb-0">No breack</h6>
                                    </div>
                                    <div class="user-progress d-flex align-items-center gap-1">
                                        <h6 class="mb-0">#</h6>
                                        <span class="text-muted">{{ $totalBreack }}</span>
                                    </div>
                                </div>
                            </li>

                            <!--SCANNER-->
                            <li class="d-flex mb-4 pb-1">
                                <div class="avatar flex-shrink-0 me-3">
                                    <span class="avatar-initial rounded bg-label-success">
                                        <i class='bx bx-scan'></i>
                                    </span>
                                </div>
                                <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                    <div class="me-2">
                                        <small class="text-muted d-block mb-1">Totals</small>
                                        <h6 class="mb-0">Scanner</h6>
                                    </div>
                                    <div class="user-progress d-flex align-items-center gap-1">
                                        <h6 class="mb-0">#</h6>
                                        <span class="text-muted">{{ $totalScanner }}</span>
                                    </div>
                                </div>
                            </li>

                            <!--KEYBOARD-->
                            <li class="d-flex mb-4 pb-1">
                                <div class="avatar flex-shrink-0 me-3">
                                    <span class="avatar-initial rounded bg-label-secondary">
                                        <i class='bx bxs-keyboard'></i>
                                    </span>
                                </div>
                                <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                    <div class="me-2">
                                        <small class="text-muted d-block mb-1">Totals</small>
                                        <h6 class="mb-0">Keyboard</h6>
                                    </div>
                                    <div class="user-progress d-flex align-items-center gap-1">
                                        <h6 class="mb-0">#</h6>
                                        <span class="text-muted">{{ $totalKeyboard }}</span>
                                    </div>
                                </div>
                            </li>

                            <!--TICKET-->
                            <li class="d-flex mb-4 pb-1">
                                <div class="avatar flex-shrink-0 me-3">
                                    <span class="avatar-initial rounded bg-label-info">
                                        <i class='bx bxs-printer'></i>
                                    </span>
                                </div>
                                <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                    <div class="me-2">
                                        <small class="text-muted d-block mb-1">Totals</small>
                                        <h6 class="mb-0">Ticket</h6>
                                    </div>
                                    <div class="user-progress d-flex align-items-center gap-1">
                                        <h6 class="mb-0">#</h6>
                                        <span class="text-muted">{{ $totalTicket }}</span>
                                    </div>
                                </div>
                            </li>

                            <!--WACOM-->
                            <li class="d-flex">
                                <div class="avatar flex-shrink-0 me-3">
                                    <span class="avatar-initial rounded bg-label-primary">
                                        <i class='bx bx-edit'></i>
                                    </span>
                                </div>
                                <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                    <div class="me-2">
                                        <small class="text-muted d-block mb-1">Totals</small>
                                        <h6 class="mb-0">Wacom</h6>
                                    </div>
                                    <div class="user-progress d-flex align-items-center gap-1">
                                        <h6 class="mb-0">#</h6>
                                        <span class="text-muted">{{ $totalWacom }}</span>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <!--/ COMPLEMENTS -->

            <!-- LICENSES -->
            <div class="col-md-6 col-lg-4 order-1 mb-4">
                <div class="card h-100">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h5 class="card-title m-0 me-2">Licenses</h5>
                    </div>
                    <div class="card-body">
                        <div class="row justify-content-between mb-5">
                            <div class="col-6">
                                <p class="mb-0">Licenses by type and status</p>
                            </div>
                            <div class="col-6">
                                <p class="mb-0 text-end">Totals: {{ $totalLicencias }}</p>
                            </div>

                            <canvas id="licenciasRadarChart" style="min-height: 325px;"></canvas>
                        </div>
                    </div>
                </div>
                <!--/ LICENSES -->
            </div>

        </div>
    </div>

</x-app-layout>
<!--/ EQUIPMENTS -->
<script>
    var labels = {!! json_encode($labels) !!};
    var data = {!! json_encode($data) !!};
    let headingColor = config.colors.headingColor;
    let axisColor = config.colors.axisColor;
    let cardColor = config.colors.white;
    var customColors = ['#b5a160', '#604933', '#c5b87f', '#2f2119', '#dad3ae', '#8d7141'];

    var options = {
        series: data,
        chart: {
            height: 165,
            width: 130,
            type: "donut",
        },
        labels: labels,
        colors: customColors,
        dataLabels: {
            enabled: false,
            formatter: function(val, opt) {
                return parseInt(val) + '%';
            }
        },
        legend: {
            show: false
        },
        grid: {
            padding: {
                top: 0,
                bottom: 0,
                right: 15
            }
        },
        plotOptions: {
            pie: {
                donut: {
                    size: "75%",
                    labels: {
                        show: true,
                        value: {
                            fontSize: '1.5rem',
                            fontFamily: 'Public Sans',
                            color: headingColor,
                            offsetY: -15,
                            formatter: function(val) {
                                return parseInt(val);
                            }
                        },
                        name: {
                            offsetY: 20,
                            fontFamily: 'Public Sans'
                        },
                        total: {
                            show: true,
                            fontSize: '0.8125rem',
                            color: axisColor,
                            label: 'Equipments',
                            formatter: function(w) {
                                return {{ $totalEquipos }};
                            }
                        }
                    }
                }
            }
        }
    };

    var chart = new ApexCharts(document.querySelector("#orderStatisticsChart"), options);
    chart.render();
</script>
<!--/ EQUIPMENTS -->
<!--/ LICENSES -->

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('licenciasRadarChart').getContext('2d');
    const licenciasRadarChart = new Chart(ctx, {
        type: 'radar',
        data: {
            labels: ['Office', 'Adobe', 'AutoCAD', 'SketchUp', 'Total'],
            datasets: [{
                label: 'Total',
                data: [{{ $officeCount }}, {{ $adobeCount }}, {{ $autocadCount }},
                    {{ $sketchupCount }}, {{ $totalLicencias }}
                ],
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1,
                pointStyle: 'circle',
                pointRadius: 5, // Tamaño de los puntos
                pointHoverRadius: 7, // Tamaño al pasar el cursor
                pointBackgroundColor: 'rgba(54, 162, 235, 1)', // Color de fondo de los puntos
                pointBorderColor: '#fff' // Color del borde de los puntos
            }, {
                label: 'Active',
                data: [{{ $officeActivas }}, {{ $adobeActivas }}, {{ $autocadActivas }},
                    {{ $sketchupActivas }}, {{ $totalActivas }}
                ],
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1,
                pointStyle: 'circle',
                pointRadius: 5, // Tamaño de los puntos
                pointHoverRadius: 7, // Tamaño al pasar el cursor
                pointBackgroundColor: 'rgba(75, 192, 192, 1)', // Color de fondo de los puntos
                pointBorderColor: '#fff' // Color del borde de los puntos
            }, {
                label: 'Expired',
                data: [{{ $officeVencidas }}, {{ $adobeVencidas }}, {{ $autocadVencidas }},
                    {{ $sketchupVencidas }}, {{ $totalVencidas }}
                ],
                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                borderColor: 'rgba(255, 99, 132, 1)',
                borderWidth: 1,
                pointStyle: 'circle',
                pointRadius: 5, // Tamaño de los puntos
                pointHoverRadius: 7, // Tamaño al pasar el cursor
                pointBackgroundColor: 'rgba(255, 99, 132, 1)', // Color de fondo de los puntos
                pointBorderColor: '#fff' // Color del borde de los puntos
            }]
        },
        options: {
            responsive: true,
            plugins: {
                title: {
                    display: true,
                },
                legend: {
                    position: 'bottom',
                    labels: {
                        usePointStyle: true, // Usar el estilo de punto (círculo) en la leyenda
                        pointStyle: 'circle' // Cambiar el punto a un círculo
                    }
                }
            },
            scales: {
                r: {
                    angleLines: {
                        display: true
                    },
                    suggestedMin: 0,
                    suggestedMax: Math.max({{ $totalLicencias }}, {{ $totalActivas }},
                        {{ $totalVencidas }}) + 10
                }
            }
        }
    });
</script>

<!-- Initialize Swiper -->
<script>
    var swiper = new Swiper('#property-slider .swiper', {
        // Optional parameters
        loop: true,
        slidesPerView: 1,
        spaceBetween: 30,
        centeredSlides: true,
        breakpoints: {
            640: {
                slidesPerView: 1,
                spaceBetween: 10,
            },
            768: {
                slidesPerView: 2,
                spaceBetween: 20,
            },
            1024: {
                slidesPerView: 3,
                spaceBetween: 30,
            },
        }
    });
</script>
