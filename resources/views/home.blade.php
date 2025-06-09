<x-app-layout>

    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="d-flex justify-content-between align-items-center mb-2">
            <h5 class="mb-0">WELCOME BACK,<span class="h4"> {{ Auth::user()->name }}! 👋🏻</span></h5>
            <a href="{{ route('download.excel') }}" class="btn btn-icon btn-primary">
                <span class="icon-base bx bxs-download icon-md"></span>
            </a>
        </div>

        <!--Sliders-->
        <section id="property-section">
            <!--Property List Slider Her-->
            <div id="property-slider">
                <!-- Slider main container -->
                <div class="swiper">
                    <!-- Additional required wrapper -->
                    <div class="swiper-wrapper">
                        <!-- SW / APS -->
                        @if (Gate::check('phones.index') ||
                                Gate::check('radios.index') ||
                                Gate::check('empleados.index') ||
                                Gate::check('equipo.index') ||
                                Gate::check('tpvs.index') ||
                                Gate::check('users.index') ||
                                Gate::check('switches.index') ||
                                Gate::check('access_points.index'))
                            @can('users.index')
                                <div class="swiper-slide">
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
                                            <small class="text-primary fw-semibold">
                                                <a href="{{ route('users.index') }}">Show<i
                                                        class='bx bx-right-arrow-alt'></i></a>
                                            </small>
                                        </div>
                                    </div>
                                </div>
                            @endcan

                            @can('employees.index')
                                <div class="swiper-slide">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="card-title d-flex align-items-start justify-content-between">
                                                <div class="avatar flex-shrink-0">
                                                    <i class='bx bxs-user-badge bx-lg rounded'
                                                        style="font-size: 2rem; color: #b5a160;"></i>
                                                </div>
                                            </div>
                                            <span class="fw-semibold d-block mb-1">Employes</span>
                                            <h3 class="card-title text-nowrap mb-2">{{ $totalEmpleados }}</h3>
                                            <small class="text-primary fw-semibold">
                                                <a href="{{ route('employees.index') }}">Show<i
                                                        class='bx bx-right-arrow-alt'></i></a>
                                            </small>
                                        </div>
                                    </div>
                                </div>
                            @endcan

                            @can('equipo.index')
                                <div class="swiper-slide">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="card-title d-flex align-items-start justify-content-between">
                                                <div class="avatar flex-shrink-0">
                                                    <i class='bx bx-desktop bx-lg rounded'
                                                        style="font-size: 2rem; color: #b5a160;"></i>
                                                </div>
                                            </div>
                                            <span class="fw-semibold d-block mb-1">Equipments</span>
                                            <h3 class="card-title text-nowrap mb-2">{{ $totalEquipos }}</h3>
                                            <small class="text-primary fw-semibold">
                                                <a href="{{ route('equipo.index') }}">Show<i
                                                        class='bx bx-right-arrow-alt'></i></a>
                                            </small>
                                        </div>
                                    </div>
                                </div>
                            @endcan

                            @can('phones.index')
                                <div class="swiper-slide">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="card-title d-flex align-items-start justify-content-between">
                                                <div class="avatar flex-shrink-0">
                                                    <i class='bx bx-phone bx-lg rounded'
                                                        style="font-size: 2rem; color: #b5a160;"></i>
                                                </div>
                                            </div>
                                            <span class="fw-semibold d-block mb-1">Radios</span>
                                            <h3 class="card-title text-nowrap mb-2">{{ $totalPhones }}</h3>
                                            <small class="text-primary fw-semibold">
                                                <a href="{{ route('phones.index') }}">Show<i
                                                        class='bx bx-right-arrow-alt'></i></a>
                                            </small>
                                        </div>
                                    </div>
                                </div>
                            @endcan

                            @can('phones.index')
                                <div class="swiper-slide">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="card-title d-flex align-items-start justify-content-between">
                                                <div class="avatar flex-shrink-0">
                                                    <i class='bx bx-phone bx-lg rounded'
                                                        style="font-size: 2rem; color: #b5a160;"></i>
                                                </div>
                                            </div>
                                            <span class="fw-semibold d-block mb-1">Phones</span>
                                            <h3 class="card-title text-nowrap mb-2">{{ $totalPhones }}</h3>
                                            <small class="text-primary fw-semibold">
                                                <a href="{{ route('phones.index') }}">Show<i
                                                        class='bx bx-right-arrow-alt'></i></a>
                                            </small>
                                        </div>
                                    </div>
                                </div>
                            @endcan

                            @can('switches.index')
                                <div class="swiper-slide">
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
                                            <small class="text-primary fw-semibold">
                                                <a href="{{ route('switches.index') }}">Show<i
                                                        class='bx bx-right-arrow-alt'></i></a>
                                            </small>
                                        </div>
                                    </div>
                                </div>
                            @endcan

                            @can('access_points.index')
                                <div class="swiper-slide">
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
                                            <small class="text-primary fw-semibold">
                                                <a href="{{ route('access-points.index') }}">Show<i
                                                        class='bx bx-right-arrow-alt'></i></a>
                                            </small>
                                        </div>
                                    </div>
                                </div>
                            @endcan

                            @can('tpvs.index')
                                <div class="swiper-slide">
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
                                            <small class="text-primary fw-semibold">
                                                <a href="{{ route('tpvs.index') }}">Show<i
                                                        class='bx bx-right-arrow-alt'></i></a>
                                            </small>
                                        </div>
                                    </div>
                                </div>
                            @endcan
                        @endif
                    </div>
                </div>

            </div>
            <!--/Property List Slider Her-->
        </section>
        <br>
        <!--/sliders-->

        <!--columns charts-->
        <div class="row">
            <!-- EQUIPMENTS TOTAL -->
            @can('equipo.index')
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
                                @can('desktops.index')
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
                                @endcan

                                @can('laptops.index')
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
                                @endcan

                                @can('other.index')
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
                                @endcan

                                @can('mobile.index')
                                    <li class="d-flex mb-4 pb-1">
                                        <div class="avatar flex-shrink-0 me-3">
                                            <span class="avatar-initial rounded bg-label-warning">
                                                <i class="bx bx-mobile-alt"></i>
                                            </span>
                                        </div>
                                        <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                            <div class="me-2">
                                                <h6 class="mb-0">Mobile(s)</h6>
                                                <small class="text-muted">Totals</small>
                                            </div>
                                            <div class="user-progress">
                                                <small class="fw-semibold">#{{ $totalPhone }}</small>
                                            </div>
                                        </div>
                                    </li>
                                @endcan

                                @can('printers.index')
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
                                @endcan

                                @can('tabs.index')
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
                                @endcan
                            </ul>
                        </div>
                    </div>
                    <!--/ EQUIPMENTS TOTAL -->
                </div>
            @endcan

            <!-- COMPLEMENTS -->
            @can('complements.index')
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
            @endcan
            <!--/ COMPLEMENTS -->

            <!-- LICENSES -->
            @can('licenses.index')
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
            @endcan

        </div>
        <!--/columns charts-->
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
<!-- TOTAL DE QUIPOS POR OTEL DEL TIPO LAPTOP -->

<!--/ TOTAL DE QUIPOS POR OTEL DEL TIPO LAPTOP -->

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
        slidesPerView: 1, // Mostrar 6 tarjetas principales
        spaceBetween: 30, // Espacio entre las tarjetas
        centeredSlides: false, // No centrar las tarjetas
        breakpoints: {
            640: {
                slidesPerView: 2, // Mostrar 2 tarjetas en pantallas pequeñas
                spaceBetween: 10,
            },
            768: {
                slidesPerView: 4, // Mostrar 4 tarjetas en pantallas medianas
                spaceBetween: 20,
            },
            1024: {
                slidesPerView: 6, // Mostrar 6 tarjetas en pantallas grandes
                spaceBetween: 30,
            },
        }
    });
</script>

<!-- Chart total de laptops por hotel -->
<script>
    // Datos para la gráfica
    const laptopLabels = {!! json_encode($laptopLabels) !!}; // Hoteles + Stock
    const laptopData = {!! json_encode($laptopData) !!}; // Totales por hotel + Stock

    // Generar colores únicos para cada barra
    const colors = ['#b5a160', '#604933', '#c5b87f', '#2f2119', '#dad3ae', '#8d7141'];

    // Configuración de la gráfica
    var options = {
        series: [{
            name: 'Total Laptops',
            data: laptopData
        }],
        chart: {
            type: 'bar',
            height: 400
        },
        plotOptions: {
            bar: {
                distributed: true, // Colores diferentes para cada barra
                horizontal: false, // Barras verticales
                columnWidth: '50%' // Ancho de las barras
            }
        },
        colors: colors, // Aplicar colores generados
        dataLabels: {
            enabled: true,
            style: {
                colors: ['#000'] // Color del texto de las etiquetas
            }
        },
        xaxis: {
            categories: laptopLabels, // Etiquetas de los hoteles + Stock
            title: {
                text: 'Hoteles'
            }
        },
        yaxis: {
            title: {
                text: 'Cantidad de Laptops'
            }
        },
        title: {
            text: 'Total de Laptops por Hotel y en Stock',
            align: 'center'
        },
        legend: {
            show: false // Ocultar leyenda ya que es una sola serie
        }
    };

    // Renderizar la gráfica
    var chart = new ApexCharts(document.querySelector("#laptopsBarChart"), options);
    chart.render();
</script>

<!-- Chart total de desktops por hotel -->
<script>
    // Datos para la gráfica de desktops
    const desktopLabels = {!! json_encode($desktopLabels) !!}; // Hoteles + Stock
    const desktopData = {!! json_encode($desktopData) !!}; // Totales por hotel + Stock

    // Generar colores únicos para cada barra
    const desktopColors = ['#b5a160', '#604933', '#c5b87f', '#2f2119', '#dad3ae', '#8d7141'];

    // Configuración de la gráfica de desktops
    var desktopOptions = {
        series: [{
            name: 'Total Desktops',
            data: desktopData
        }],
        chart: {
            type: 'bar',
            height: 400
        },
        plotOptions: {
            bar: {
                distributed: true, // Colores diferentes para cada barra
                horizontal: false, // Barras verticales
                columnWidth: '50%' // Ancho de las barras
            }
        },
        colors: desktopColors, // Aplicar colores generados
        dataLabels: {
            enabled: true,
            style: {
                colors: ['#000'] // Color del texto de las etiquetas
            }
        },
        xaxis: {
            categories: desktopLabels, // Etiquetas de los hoteles + Stock
            title: {
                text: 'Hoteles'
            }
        },
        yaxis: {
            title: {
                text: 'Cantidad de Desktops'
            }
        },
        title: {
            text: 'Total de Desktops por Hotel y en Stock',
            align: 'center'
        },
        legend: {
            show: false // Ocultar leyenda ya que es una sola serie
        }
    };

    // Renderizar la gráfica de desktops
    var desktopChart = new ApexCharts(document.querySelector("#desktopsBarChart"), desktopOptions);
    desktopChart.render();
</script>
