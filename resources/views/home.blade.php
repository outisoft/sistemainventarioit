<x-app-layout>
    <div class="container-xxl navbar-expand-xl align-items-center">
        <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
            <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                <i class="bx bx-menu bx-sm"></i>
            </a>
        </div>
    </div>
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"> </span> Bienvenido - {{ now()->format('d/m/Y') }}  <p id="hora_actual">{{ $hora_actual }}</p>
        </h4>
        <!-- Horizontal -->
        <!--h5 class="pb-1 mb-4">Horizontal</h5-->
        <div class="row mb-5 flex">
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
        </div>

        <div class="row mb-5">
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
        </div>
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
