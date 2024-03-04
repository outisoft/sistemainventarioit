<x-app-layout>
    <div class="container-xxl navbar-expand-xl align-items-center">
        <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
            <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                <i class="bx bx-menu bx-sm"></i>
            </a>
        </div>
    </div>                
                <!-- seo end -->
                <div class="container-xxl flex-grow-1 container-p-y">
                    <h4 class="fw-bold py-3 mb-4"> Hola, {{ Auth::user()->name }} - {{ now()->format('d/m/Y') }}
                    </h4>
                    <h6>
                        <p id="hora_actual">{{ $hora_actual }} - </p>
                    </h6>
                    <div class="row">
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
                    </div>
                    <br>
                    <!-- Horizontal -->
                    <!--h5 class="pb-1 mb-4">Horizontal</h5-->
                    <!--div class="row mb-5 flex">
                        @can('equipos.index')
                            <div class="col-md">
                                <div class="section_our_solution">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12">
                                            <div class="our_solution_category">
                                                <div class="solution_cards_box">
                                                    <div class="solution_card">
                                                        <div class="hover_color_bubble"></div>
                                                        <div class="so_top_icon">
                                                            <img src="{{ asset('icons/equipos.png') }}" alt="">
                                                        </div>
                                                        <div class="solu_title">
                                                            <div>Equipos</div>
                                                        </div>
                                                        <div class="solu_description">
                                                            <p>
                                                                Visualización, Creacion, edicion y eliminacion de registros de equipos.
                                                            </p>
                                                            <a href="{{ route('equipo.index') }}"
                                                                class="btn read_more_btn btn-sm btn-primary">Ir</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endcan

                        @can('empleados.index')
                            <div class="col-md">
                                <div class="section_our_solution">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12">
                                            <div class="our_solution_category">
                                                <div class="solution_cards_box">
                                                    <div class="solution_card">
                                                        <div class="hover_color_bubble"></div>
                                                        <div class="so_top_icon">
                                                            <img src="{{ asset('icons/empleados.png') }}" alt="">
                                                        </div>
                                                        <div class="solu_title">
                                                            <div>Empleados</div>
                                                        </div>
                                                        <div class="solu_description">
                                                            <p>
                                                                Visualización, Creacion, edicion y eliminacion de registros de
                                                                Empleados.
                                                            </p>
                                                            <a href="{{ route('empleados.index') }}"
                                                                class="btn read_more_btn btn-sm btn-primary">Ir</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endcan
                    </div>


                    <div class="row mb-5">
                        @can('roles.index')
                            <div class="col-md">
                                <div class="section_our_solution">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12">
                                            <div class="our_solution_category">
                                                <div class="solution_cards_box">
                                                    <div class="solution_card">
                                                        <div class="hover_color_bubble"></div>
                                                        <div class="so_top_icon">
                                                            <img src="{{ asset('icons/roles.png') }}" alt="">
                                                        </div>
                                                        <div class="solu_title">
                                                            <div>Roles</div>
                                                        </div>
                                                        <div class="solu_description">
                                                            <p>
                                                                Visualización, Creacion, edicion y eliminacion de registros de Roles
                                                            </p>
                                                            <a href="{{ route('roles.index') }}"
                                                                class="btn read_more_btn btn-sm btn-primary">Ir</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endcan

                        @can('users.index')
                            <div class="col-md">
                                <div class="section_our_solution">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12">
                                            <div class="our_solution_category">
                                                <div class="solution_cards_box">
                                                    <div class="solution_card">
                                                        <div class="hover_color_bubble"></div>
                                                        <div class="so_top_icon">
                                                            <img src="{{ asset('icons/users.png') }}" alt="">
                                                        </div>
                                                        <div class="solu_title">
                                                            <div>Usuarios</div>
                                                        </div>
                                                        <div class="solu_description">
                                                            <p>
                                                                Visualización, Creacion, edicion y eliminacion de registros de usuarios.
                                                            </p>
                                                            <a href="{{ route('users.index') }}"
                                                                class="btn read_more_btn btn-sm btn-primary">Ir</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endcan
                    </div-->
                    <!--/ Horizontal -->
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
