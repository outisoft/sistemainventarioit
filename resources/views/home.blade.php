<x-app-layout>              
    <!-- seo end -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"> HOLA, {{ Auth::user()->name }} - {{ now()->format('d/m/Y') }}
        </h4>
        <h6>
            <p id="hora_actual">{{ $hora_actual }}</p>
        </h6>
        <div class="row">
            @can('empleados.index')
            <div class="col-xl-4 col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-6">
                                <h3>{{ $totalEmpleados }}</h3>
                                <h6 class="text-muted m-b-0">Empleados<i class="fa fa-caret-down text-c-red m-l-10"></i></h6>
                            </div>
                            <div class="col-6">
                                <div class="so_top_icon">
                                    <i class='bx bx-user-pin bx-lg' ></i>
                                    <a href="{{ route('empleados.index') }}"><i class='bx bx-right-arrow-alt bx-lg' ></i> </a>
                                </div>                                   
                            </div>
                        </div>
                    </div>            
                </div>
            </div>
            @endcan

            @can('equipo.index')
            <div class="col-xl-4 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-6">
                                <h3>{{ $totalEquipos }}</h3>
                                <h6 class="text-muted m-b-0">Equipos<i class="fa fa-caret-up text-c-green m-l-10"></i></h6>
                            </div>
                            <div class="col-6">
                                <div class="so_top_icon">
                                    <i class='bx bx-desktop bx-lg' ></i>
                                    <a href="{{ route('equipo.index') }}"><i class='bx bx-right-arrow-alt bx-lg' ></i> </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endcan

            @can('users.index')
            <div class="col-xl-4 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-6">
                                <h3>{{ $totalUsuarios }}</h3>
                                <h6 class="text-muted m-b-0">Usuarios<i class="fa fa-caret-down text-c-red m-l-10"></i></h6>
                            </div>
                            <div class="col-6">
                                <div class="so_top_icon">
                                    <i class='bx bxs-user bx-lg'></i>
                                    <a href="{{ route('users.index') }}"><i class='bx bx-right-arrow-alt bx-lg' ></i> </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endcan

            @can('tablets.index')
            <!--div class="col-xl-4 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-6">
                                <h3>{{ $totalTablets }}</h3>
                                <h6 class="text-muted m-b-0">Tabletas<i class="fa fa-caret-down text-c-red m-l-10"></i></h6>
                            </div>
                            <div class="col-6">
                                <div class="so_top_icon">
                                    <i class='bx bx-tab bx-lg'></i>
                                    <a href="{{ route('tabs.index') }}"><i class='bx bx-right-arrow-alt bx-lg' ></i> </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div-->
            @endcan

            @can('tpvs.index')
            <div class="col-xl-4 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-6">
                                <h3>{{ $totalTpvs }}</h3>
                                <h6 class="text-muted m-b-0">Tpvs<i class="fa fa-caret-down text-c-red m-l-10"></i></h6>
                            </div>
                            <div class="col-6">
                                <div class="so_top_icon">
                                    <i class='bx bx-tv bx-lg'></i>
                                    <a href="{{ route('tpvs.index') }}"><i class='bx bx-right-arrow-alt bx-lg' ></i> </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endcan

            @can('coming2.index')
                <div class="col-xl-4 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-6">
                                    <h3>{{ $totalComing2 }}</h3>
                                    <h6 class="text-muted m-b-0">Coming2<i class="fa fa-caret-down text-c-red m-l-10"></i></h6>
                                </div>
                                <div class="col-6">
                                    <div class="so_top_icon">
                                        <i class='bx bx-tab bx-lg'></i>
                                        <a href="{{ route('coming2.index') }}"><i class='bx bx-right-arrow-alt bx-lg' ></i> </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endcan

            @can('switches.index')
                <div class="col-xl-4 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-6">
                                    <h3>{{ $totalSw }}</h3>
                                    <h6 class="text-muted m-b-0">Switches<i class="fa fa-caret-down text-c-red m-l-10"></i></h6>
                                </div>
                                <div class="col-6">
                                    <div class="so_top_icon">
                                        <i class='bx-lg bx bx-server' ></i>
                                        <a href="{{ route('switches.index') }}"><i class='bx bx-right-arrow-alt bx-lg' ></i> </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endcan

            @can('access_points.index')
                <div class="col-xl-4 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-6">
                                    <h3>{{ $totalAps }}</h3>
                                    <h6 class="text-muted m-b-0">Access Points<i class="fa fa-caret-down text-c-red m-l-10"></i></h6>
                                </div>
                                <div class="col-6">
                                    <div class="so_top_icon">
                                        <i class='bx-lg tf-icons bx bx-broadcast'></i>
                                        <a href="{{ route('access-points.index') }}"><i class='bx bx-right-arrow-alt bx-lg' ></i> </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endcan

        </div>
        <br>
    </div>

    
    <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="row">
                @can('equipo.index')
                    <!-- Grafica Total de Equipos -->
                    @include('partials-home.total_equipos')

                    <!-- Grafica Total de CPU Libres o en uso-->
                    @include('partials-home.total_cpu_libres_o_en_uso')

                    <!-- Grafica Total de Laptops Libres o en uso-->
                    @include('partials-home.total_laptops_libres_o_en_uso')
                @endcan

                @can('tpvs.index')
                    <!-- Grafica Total de TPV's-->
                    @include('partials-home.total_tpvs')
                @endcan
            </div>
        </div>
    </div>

</x-app-layout>
<script>
    function actualizarHora() {
        var fecha = new Date();
        var hora = fecha.getHours();
        var minutos = fecha.getMinutes();
        var segundos = fecha.getSeconds();
        var am_pm = hora >= 12 ? 'PM' : 'AM';

        // Formatear la hora
        hora = hora % 12;
        hora = hora ? hora : 12;
        minutos = minutos < 10 ? '0' + minutos : minutos;
        segundos = segundos < 10 ? '0' + segundos : segundos;

        // Actualizar el contenido del elemento HTML
        document.getElementById('hora_actual').innerHTML = hora + ':' + minutos + ':' + segundos + ' ' + am_pm;
    }

    // Actualizar la hora cada segundo
    setInterval(actualizarHora, 1000);
</script>


<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

<script>
    var datos = @json($tpvsPorDepartamento);
    var categorias = [];
    var valores = [];
    var customColors = [ '#b5a160','#604933', '#c5b87f', '#2f2119','#dad3ae','#8d7141'];

    datos.forEach(function(item){
        categorias.push(item.hotel);
        valores.push(item.cantidad_tpvs);
    });

    var options = {
        chart: {
            type: 'bar'
        },
        colors: customColors,
        series: [{
            name: 'Total de Equipos',
            data: valores
        }],
        plotOptions: {
            bar: {
                borderRadius: 5,
                dataLabels: {
                position: 'top', // top, center, bottom
                },
            }
        },
        xaxis: {
            categories: categorias
        }
    };

    var chart = new ApexCharts(document.querySelector("#tpvChart"), options);
    chart.render();
</script>

<script>
    /*Script Total de Equipos*/
    var labels = {!! json_encode($labels) !!};
    var data = {!! json_encode($data) !!};
    let headingColor = config.colors.headingColor;
    let axisColor = config.colors.axisColor;
    let cardColor = config.colors.white;
    var customColors = [ '#b5a160','#604933', '#c5b87f', '#2f2119','#dad3ae','#8d7141'];

    var options = {
        series: data,
        chart: {
            type: 'donut',
        },
        labels: labels,
        colors: customColors,
        dataLabels: {
            enabled: false,
            formatter: function (val, opt) {
            return parseInt(val) + '%';
            }
        },
        legend: {
            show: true
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
                    size: '80%',
                    labels: {
                        show: true,
                        value:{
                            fontSize: '1.5rem',
                            fontFamily: 'Public Sans',
                            color: headingColor,
                            offsetY: -15,   
                            formatter: function (val) {
                                return parseInt(val) + ' Equipos';
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
                            label: 'Equipos',
                            formatter: function (w) {
                            return {{ $totalEquipos }};
                            }
                        }
                    }
                }
            }
        }
    };

    var chart = new ApexCharts(document.querySelector("#chart"), options);
    chart.render();

    /* Script Total de equipos libre / ocupados*/
    var datos_grafica = @json($datos_grafica);

    var options = {
        chart: {
            height: 350,
            type: 'bar'
        },
        colors: customColors,
        series: [{
            name: 'Equipos',
            data: datos_grafica.map(item => item.total)
        }],
        plotOptions: {
            bar: {
                borderRadius: 5,
                dataLabels: {
                position: 'top', // top, center, bottom
                },
            }
        },
        xaxis: {
            categories: datos_grafica.map(item => item.estado),
            position: 'top',
            axisBorder: {
                show: false
            },
        }
    };

    var chart = new ApexCharts(document.querySelector("#cpuChart"), options);
    chart.render();

    /* Script Total de equipos libre / ocupados*/
    var total_laptops = @json($total_laptops);

    var options = {
        chart: {
            type: 'bar'
        },
        colors: customColors,
        series: [{
            name: 'Equipos',
            data: total_laptops.map(item => item.total)
        }],
        plotOptions: {
            bar: {
                borderRadius: 5,
                dataLabels: {
                position: 'top', // top, center, bottom
                },
            }
        },
        xaxis: {
            categories: total_laptops.map(item => item.estado),
            position: 'top',
            axisBorder: {
                show: false
            },
        }
    };

    var chart = new ApexCharts(document.querySelector("#laptopChart"), options);
    chart.render();
    

    //total de laptops por hotel
    var datos = @json($datosCPU);
    var categorias = [];
    var valores = [];
    var customColors = [ '#b5a160','#604933', '#c5b87f', '#2f2119','#dad3ae','#8d7141'];

    datos.forEach(function(item){
        categorias.push(item.hotel);
        valores.push(item.cantidad_equipos);
    });

    var options = {
        chart: {
            type: 'bar'
        },
        colors: customColors,
        series: [{
            name: 'Total de Equipos',
            data: valores
        }],
        plotOptions: {
            bar: {
                borderRadius: 5,
                dataLabels: {
                position: 'top', // top, center, bottom
                },
            }
        },
        xaxis: {
            categories: categorias
        }
    };

    var chart = new ApexCharts(document.querySelector("#desktopsChart"), options);
    chart.render();

    // grafica de total de desktops por hotel
    var datos = @json($datosLap);
    var categorias = [];
    var valores = [];
    var customColors = [ '#b5a160','#604933', '#c5b87f', '#2f2119','#dad3ae','#8d7141'];

    datos.forEach(function(item){
        categorias.push(item.hotel);
        valores.push(item.cantidad_equipos);
    });

    var options = {
        chart: {
            type: 'bar'
        },
        colors: customColors,
        series: [{
            name: 'Total de Equipos',
            data: valores
        }],
        plotOptions: {
            bar: {
                borderRadius: 5,
                dataLabels: {
                position: 'top', // top, center, bottom
                },
            }
        },
        xaxis: {
            categories: categorias
        }
    };

    var chart = new ApexCharts(document.querySelector("#laptopsChart"), options);
    chart.render();
</script>
