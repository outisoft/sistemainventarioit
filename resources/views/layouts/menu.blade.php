@php
    $user = Auth::user();
    $role = $user->roles()->first();
@endphp

<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <!-- Logo -->
    <div class="app-brand demo">
        <span class="app-brand-logo demo">
            <div class="shrink-0 flex items-center">
                <a href="{{ route('home') }}">
                    @if ($user->regions && $user->regions->first()->id == 1)
                        <img id="logo" src="{{ asset('images/TCC_LOGO.png') }}" alt="Logo Tulum Country Club"
                            height="25" />
                    @else
                        <img id="logo" src="{{ asset('images/gp-lg-50.png') }}" alt="Logo Grupo Piñero"
                            height="36" />
                    @endif
                </a>
            </div>
        </span>
        <!--span class="app-brand-text demo menu-text fw-bolder ms-2">Inventario</span-->

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        <!-- home -->
        <br>
        <!-- Home -->
        <li class="menu-item {{ Request::routeIs('home') ? 'active' : '' }}">
            <a href="{{ route('home') }}" class="menu-link">
                <i class='menu-icon tf-icons bx bx-home'></i>
                <div data-i18n="Analytics">Home</div>
            </a>
        </li>

        <!-- Positions -->
        @can('positions.index')
            <li
                class="menu-item {{ Request::routeIs('positions.index') ? 'active' : '' }}">
                <a href="{{ route('positions.index') }}" class="menu-link">
                    <i class='menu-icon tf-icons bx bx-briefcase'></i>
                    <div data-i18n="Without menu">Positions</div>
                </a>
            </li>
        @endcan

        <!-- Employees -->
        @can('employees.index')
            <li
                class="menu-item {{ Request::routeIs('employees.index') ? 'active' : '' }}" >
                <a href="{{ route('employees.index') }}" class="menu-link">
                    <i class='menu-icon tf-icons bx bx-user-pin'></i>
                    <div data-i18n="Without menu">Employees</div>
                </a>
            </li>
        @endcan

        <!-- Equipos -->
        @can('equipo.index')
            <li
                class="menu-item {{ Request::routeIs('mobiles.index') ? 'active' : '' }} || {{ Request::routeIs('equipo.show') ? 'active' : '' }} || {{ Request::routeIs('other.index') ? 'active' : '' }} || {{ Request::routeIs('mobile.index') ? 'active' : '' }} || {{ Request::routeIs('tabs.index') ? 'active' : '' }} || {{ Request::routeIs('laptops.index') ? 'active' : '' }} || {{ Request::routeIs('complements.index') ? 'active' : '' }} || {{ Request::routeIs('printers.index') ? 'active' : '' }} || {{ Request::routeIs('licenses.index') ? 'active' : '' }} || {{ Request::routeIs('equipo.index') ? 'active' : '' }} || 
            {{ Request::routeIs('tablets.index') ? 'active' : '' }} || {{ Request::routeIs('tablets.create') ? 'active' : '' }} || {{ Request::routeIs('tablets.show') ? 'active' : '' }} || {{ Request::routeIs('tablets.index') ? 'active' : '' }} || {{ Request::routeIs('tablets.edit') ? 'active' : '' }}
            {{ Request::routeIs('tpvs.index') ? 'active' : '' }} || {{ Request::routeIs('tpvs.create') ? 'active' : '' }} || {{ Request::routeIs('tpvs.show') ? 'active' : '' }} || {{ Request::routeIs('tpvs.index') ? 'active' : '' }} || {{ Request::routeIs('tpvs.edit') ? 'active' : '' }}
            {{ Request::routeIs('desktops.index') ? 'active' : '' }} || {{ Request::routeIs('complements.show') ? 'active' : '' }} || {{ Request::routeIs('details') ? 'active' : '' }} || {{ Request::routeIs('laptops.show') ? 'active' : '' }} ||
            {{ Request::routeIs('desktops.show') ? 'active' : '' }}">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                    <i class='menu-icon tf-icons bx bx-desktop'></i>
                    <div data-i18n="Layouts">Equipments</div>
                </a>

                <ul class="menu-sub">
                    @can('equipo.index')
                        <li
                            class="menu-item {{ Request::routeIs('equipo.index') ? 'active' : '' }} || {{ Request::routeIs('details') ? 'active' : '' }}">
                            <a href="{{ route('equipo.index') }}" class="menu-link">
                                <i class='menu-icon tf-icons bx bx-list-ol'></i>
                                <div data-i18n="Without menu">All</div>
                            </a>
                        </li>
                    @endcan

                    @can('complements.index')
                        <li
                            class="menu-item {{ Request::routeIs('complements.index') ? 'active' : '' }} || {{ Request::routeIs('complements.show') ? 'active' : '' }}">
                            <a href="{{ route('complements.index') }}" class="menu-link">
                                <i class='menu-icon tf-icons bx bxs-keyboard'></i>
                                <div data-i18n="Without menu">Complements</div>
                            </a>
                        </li>
                    @endcan

                    @can('desktops.index')
                        <li
                            class="menu-item {{ Request::routeIs('desktops.show') ? 'active' : '' }} || {{ Request::routeIs('equipo.show') ? 'active' : '' }} || {{ Request::routeIs('desktops.index') ? 'active' : '' }}">
                            <a href="{{ route('desktops.index') }}" class="menu-link">
                                <i class='menu-icon tf-icons bx bx-hdd'></i>
                                <div data-i18n="Without menu">Desktops</div>
                            </a>
                        </li>
                    @endcan

                    @can('laptops.index')
                        <li
                            class="menu-item {{ Request::routeIs('laptops.index') ? 'active' : '' }} || {{ Request::routeIs('laptops.show') ? 'active' : '' }}">
                            <a href="{{ route('laptops.index') }}" class="menu-link">
                                <i class='menu-icon tf-icons bx bx-laptop'></i>
                                <div data-i18n="Without navbar">Laptops</div>
                            </a>
                        </li>
                    @endcan

                    @can('printers.index')
                        <li class="menu-item {{ Request::routeIs('printers.index') ? 'active' : '' }}">
                            <a href="{{ route('printers.index') }}" class="menu-link">
                                <i class='menu-icon tf-icons bx bx-printer'></i>
                                <div data-i18n="Without navbar">Printers</div>
                            </a>
                        </li>
                    @endcan

                    @can('tabs.index')
                        <li class="menu-item {{ Request::routeIs('tabs.index') ? 'active' : '' }}">
                            <a href="{{ route('tabs.index') }}" class="menu-link">
                                <i class='menu-icon tf-icons bx bx-tab'></i>
                                <div data-i18n="Analytics">Tablets</div>
                            </a>
                        </li>
                    @endcan

                    @can('mobile.index')
                        <li class="menu-item {{ Request::routeIs('mobiles.index') ? 'active' : '' }}">
                            <a href="{{ route('mobiles.index') }}" class="menu-link">
                                <i class='menu-icon bx bx-mobile-alt'></i>
                                <div data-i18n="Analytics">Mobiles</div>
                            </a>
                        </li>
                    @endcan

                    @can('tablets.index')
                        <!--li disabled class="menu-item {{ Request::routeIs('tablets.index') ? 'active' : '' }} || {{ Request::routeIs('tablets.create') ? 'active' : '' }} || {{ Request::routeIs('tablets.show') ? 'active' : '' }} || {{ Request::routeIs('tablets.index') ? 'active' : '' }} || {{ Request::routeIs('tablets.edit') ? 'active' : '' }}">
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    <a href="#" class="menu-link">
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        <i class='menu-icon tf-icons bx bx-tab'></i>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        <div data-i18n="Analytics">Tablets Co2</div>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    </a>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                </li-->
                    @endcan

                    @can('tpvs.index')
                        <li
                            class="menu-item {{ Request::routeIs('tpvs.index') ? 'active' : '' }} || {{ Request::routeIs('tpvs.create') ? 'active' : '' }} || {{ Request::routeIs('tpvs.show') ? 'active' : '' }} || {{ Request::routeIs('tpvs.index') ? 'active' : '' }} || {{ Request::routeIs('tpvs.edit') ? 'active' : '' }}">
                            <a href="{{ route('tpvs.index') }}" class="menu-link">
                                <i class='menu-icon bx bx-tv bx bx-tab'></i>
                                <div data-i18n="Analytics">Tpv's</div>
                            </a>
                        </li>
                    @endcan

                    @can('other.index')
                        <li class="menu-item {{ Request::routeIs('other.index') ? 'active' : '' }}">
                            <a href="{{ route('other.index') }}" class="menu-link">
                                <i class='menu-icon bx bx-dots-horizontal-rounded'></i>
                                <div data-i18n="Analytics">Others</div>
                            </a>
                        </li>
                    @endcan

                    <!--li class="menu-item {{ Request::routeIs('licenses.index') ? 'active' : '' }} ">
                                                                                                                                                                                                                                                                                                                                                                                                                                                                            <a href="{{ route('licenses.index') }}" class="menu-link">
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                <i class='menu-icon tf-icons bx bxl-microsoft'></i>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                <div data-i18n="Without navbar">Office 365</div>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                            </a>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                        </li-->
                </ul>
            </li>
        @endcan

        <!-- Licencias -->
        @can('licenses.index')
            <li
                class="menu-item {{ Request::routeIs('licenses.show') ? 'active' : '' }} || {{ Request::routeIs('sketchup.index') ? 'active' : '' }} || {{ Request::routeIs('sketchup.show') ? 'active' : '' }} || {{ Request::routeIs('autocad.show') ? 'active' : '' }} || {{ Request::routeIs('autocad.index') ? 'active' : '' }} || {{ Request::routeIs('adobe.show') ? 'active' : '' }} || {{ Request::routeIs('adobe.index') ? 'active' : '' }} || {{ Request::routeIs('office.index') ? 'active' : '' }} || {{ Request::routeIs('office.show') ? 'active' : '' }} ">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                    <i class='menu-icon bx bxl-adobe'></i>
                    <div data-i18n="Layouts">Licenses</div>
                </a>

                <ul class="menu-sub">
                    <!-- ADOBE -->
                    <li
                        class="menu-item {{ Request::routeIs('adobe.index') ? 'active' : '' }} || {{ Request::routeIs('adobe.show') ? 'active' : '' }}">
                        <a href="{{ route('adobe.index') }}" class="menu-link">
                            <div data-i18n="Analytics">Adobe</div>
                        </a>
                    </li>

                    <!-- AUTOCAD -->
                    <li
                        class="menu-item {{ Request::routeIs('autocad.index') ? 'active' : '' }} || {{ Request::routeIs('autocad.show') ? 'active' : '' }}">
                        <a href="{{ route('autocad.index') }}" class="menu-link">
                            <div data-i18n="Analytics">AutoCAD</div>
                        </a>
                    </li>

                    <!-- Office -->
                    <li
                        class="menu-item {{ Request::routeIs('office.index') ? 'active' : '' }} || {{ Request::routeIs('office.show') ? 'active' : '' }}">
                        <a href="{{ route('office.index') }}" class="menu-link">
                            <div data-i18n="Analytics">Office</div>
                        </a>
                    </li>

                    <!-- SketchUp -->
                    <li
                        class="menu-item {{ Request::routeIs('sketchup.index') ? 'active' : '' }} || {{ Request::routeIs('sketchup.show') ? 'active' : '' }}">
                        <a href="{{ route('sketchup.index') }}" class="menu-link">
                            <div data-i18n="Analytics">SketchUp</div>
                        </a>
                    </li>
                </ul>
            </li>
        @endcan

        <!-- Redes -->
        @can('switches.index')
            <li
                class="menu-item {{ Request::routeIs('ont.details') ? 'active' : '' }} || {{ Request::routeIs('access-points.details') ? 'active' : '' }} || {{ Request::routeIs('switch.details') ? 'active' : '' }} || {{ Request::routeIs('ont.index') ? 'active' : '' }} || {{ Request::routeIs('switches.edit') ? 'active' : '' }} || {{ Request::routeIs('switches.show') ? 'active' : '' }} || {{ Request::routeIs('switches.index') ? 'active' : '' }} || {{ Request::routeIs('access-points.show') ? 'active' : '' }} || {{ Request::routeIs('access-points.index') ? 'active' : '' }}">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                    <i class='menu-icon bx bx-server'></i>
                    <div data-i18n="Layouts">Redes</div>
                </a>

                <ul class="menu-sub">
                    <!-- ACCESS POINTS -->
                    @can('access_points.index')
                        <li
                            class="menu-item {{ Request::routeIs('access-points.details') ? 'active' : '' }} || {{ Request::routeIs('access-points.index') ? 'active' : '' }} || {{ Request::routeIs('access-points.show') ? 'active' : '' }}">
                            <a href="{{ route('access-points.index') }}" class="menu-link">
                                <div data-i18n="Analytics">AP's</div>
                            </a>
                        </li>
                    @endcan
                    <!-- ONTS -->
                    <li
                        class="menu-item {{ Request::routeIs('ont.details') ? 'active' : '' }} || {{ Request::routeIs('ont.index') ? 'active' : '' }} || {{ Request::routeIs('ont.show') ? 'active' : '' }}">
                        <a href="{{ route('ont.index') }}" class="menu-link">
                            <div data-i18n="Analytics">Ont's</div>
                        </a>
                    </li>
                    <!-- SWITCHES -->
                    @can('switches.index')
                        <li
                            class="menu-item {{ Request::routeIs('switch.details') ? 'active' : '' }} || {{ Request::routeIs('switches.edit') ? 'active' : '' }} || {{ Request::routeIs('hotels.switches') ? 'active' : '' }} || {{ Request::routeIs('switches.index') ? 'active' : '' }} || {{ Request::routeIs('switches.show') ? 'active' : '' }}">
                            <a href="{{ route('switches.index') }}" class="menu-link">
                                <div data-i18n="Analytics">Switches</div>
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan

        <!-- Radios y telefonos -->
        @can('phone.index')
            <li
                class="menu-item {{ Request::routeIs('phones.index') ? 'active' : '' }} || {{ Request::routeIs('phones.show') ? 'active' : '' }}">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                    <i class='menu-icon bx bx-phone-call'></i>
                    <div data-i18n="Layouts">Phone</div>
                </a>

                <ul class="menu-sub">
                    <li
                        class="menu-item {{ Request::routeIs('phones.index') ? 'active' : '' }} || {{ Request::routeIs('phones.show') ? 'active' : '' }} ">
                        <a href="{{ route('phones.index') }}" class="menu-link">
                            <div data-i18n="Analytics">Phones</div>
                        </a>
                    </li>

                    @can('radio.index')
                        <li class="menu-item">
                            <a href="#" class="menu-link">
                                <div data-i18n="Without navbar">Radios</div>
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan

        <!-- Empleados -->
        @can('empleados.index')
            <li
                class="menu-item {{ Request::routeIs('empleados.index') ? 'active' : '' }} || {{ Request::routeIs('empleados.create') ? 'active' : '' }} || {{ Request::routeIs('empleados.show') ? 'active' : '' }} || {{ Request::routeIs('empleados.edit') ? 'active' : '' }}">
                <a href="{{ route('empleados.index') }}" class="menu-link">
                    <i class='menu-icon tf-icons bx bx-user-pin'></i>
                    <div data-i18n="Without menu">Employees</div>
                </a>
            </li>
        @endcan

        <!-- Lease -->
        @can('lease.index')
            <li
                class="menu-item {{ Request::routeIs('lease.index') ? 'active' : '' }} || {{ Request::routeIs('lease.show') ? 'active' : '' }}">
                <a href="{{ route('lease.index') }}" class="menu-link">
                    <i class='menu-icon tf-icons bx bx-file'></i>
                    <div data-i18n="Analytics">Leases</div>
                </a>
            </li>
        @endcan

        <!-- Historial -->
        @can('historial.index')
            <li class="menu-item {{ Request::routeIs('historial.index') ? 'active' : '' }}">
                <a href="{{ route('historial.index') }}" class="menu-link">
                    <i class='menu-icon tf-icons bx bx-history'></i>
                    <div data-i18n="Analytics">History</div>
                </a>
            </li>
        @endcan

        <!-- Asignacion -->
        @can('empleados.asignacion')
            <li
                class="menu-item {{ Request::routeIs('assignment.index') ? 'active' : '' }} || {{ Request::routeIs('positions.show') ? 'active' : '' }} || {{ Request::routeIs('employees.show') ? 'active' : '' }} || {{ Request::routeIs('assignment.show') ? 'active' : '' }}">
                <a href="{{ url('assignment') }}" class="menu-link">
                    <i class='menu-icon tf-icons bx bx-link'></i>
                    <div data-i18n="Without navbar">Assignment</div>
                </a>
            </li>
        @endcan

        <!-- Users -->
        @can('users.index')
            <!-- Administrador -->
            <li class="menu-header small text-uppercase">
                <span class="menu-header-text">Administrator</span>
            </li>
            <!--Usuarios-->
            <li
                class="menu-item {{ Request::routeIs('users.index') ? 'active' : '' }} || {{ Request::routeIs('users.create') ? 'active' : '' }} || {{ Request::routeIs('users.show') ? 'active' : '' }} || {{ Request::routeIs('users.index') ? 'active' : '' }} || {{ Request::routeIs('users.edit') ? 'active' : '' }}">
                <a href="{{ route('users.index') }}" class="menu-link">
                    <i class='menu-icon tf-icons bx bx-user-circle'></i>
                    <div data-i18n="Analytics">Users</div>
                </a>
            </li>
        @endcan

        <!-- Roles y permisos -->
        @can('roles.index')
            <li
                class="menu-item {{ Request::routeIs('roles.index') ? 'active' : '' }} || {{ Request::routeIs('roles.create') ? 'active' : '' }} || {{ Request::routeIs('roles.show') ? 'active' : '' }} || {{ Request::routeIs('roles.edit') ? 'active' : '' }}">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                    <i class='menu-icon tf-icons bx bx-lock'></i>
                    <div data-i18n="Layouts">Roles & Permissions</div>
                </a>

                <ul class="menu-sub">
                    <li
                        class="menu-item {{ Request::routeIs('roles.index') ? 'active' : '' }} || {{ Request::routeIs('roles.create') ? 'active' : '' }} || {{ Request::routeIs('roles.show') ? 'active' : '' }} || {{ Request::routeIs('roles.edit') ? 'active' : '' }}">
                        <a href="{{ route('roles.index') }}" class="menu-link">
                            <div data-i18n="Analytics">Roles</div>
                        </a>
                    </li>

                    <li class="menu-item">
                        <a href="#" class="menu-link">
                            <div data-i18n="Without navbar">Permissions</div>
                        </a>
                    </li>
                </ul>
            </li>
        @endcan

        <!-- Regions -->
        @can('region.index')
            <li class="menu-item {{ Request::routeIs('regions.index') ? 'active' : '' }} ">
                <a href="{{ route('regions.index') }}" class="menu-link">
                    <i class='menu-icon bx bx-map-pin'></i>
                    <div data-i18n="Without navbar">Region</div>
                </a>
            </li>
        @endcan

        <!-- Politicas -->
        @can('policy.index')
            <li class="menu-item {{ Request::routeIs('policy.index') ? 'active' : '' }} ">
                <a href="{{ route('policy.index') }}" class="menu-link">
                    <i class='menu-icon bx bxs-book-bookmark'></i>
                    <div data-i18n="Without navbar">Policies</div>
                </a>
            </li>
        @endcan

        <!-- Companias -->
        @can('companies.index')
            <li class="menu-item {{ Request::routeIs('companies.index') ? 'active' : '' }} ">
                <a href="{{ route('companies.index') }}" class="menu-link">
                    <i class='menu-icon bx bxs-business'></i>
                    <div data-i18n="Without navbar">Companies</div>
                </a>
            </li>
        @endcan

        <!-- Hoteles y departamentos -->
        @can('hotels.index')
            <li
                class="menu-item {{ Request::routeIs('villas.show') ? 'active' : '' }} || {{ Request::routeIs('locations.index') ? 'active' : '' }} || {{ Request::routeIs('rooms.index') ? 'active' : '' }} || {{ Request::routeIs('villas.index') ? 'active' : '' }} || {{ Request::routeIs('hotels.index') ? 'active' : '' }} || {{ Request::routeIs('hotels.create') ? 'active' : '' }} || {{ Request::routeIs('hotels.show') ? 'active' : '' }} || {{ Request::routeIs('hotels.edit') ? 'active' : '' }} || {{ Request::routeIs('departments.index') ? 'active' : '' }} || {{ Request::routeIs('departments.create') ? 'active' : '' }} || {{ Request::routeIs('departments.show') ? 'active' : '' }} || {{ Request::routeIs('departments.edit') ? 'active' : '' }}">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                    <i class='menu-icon tf-icons bx bx-building-house'></i>
                    <div data-i18n="Layouts">Hotels & More</div>
                </a>

                <ul class="menu-sub">
                    <li class="menu-item {{ Request::routeIs('hotels.index') ? 'active' : '' }}">
                        <a href="{{ route('hotels.index') }}" class="menu-link">
                            <div data-i18n="Analytics">Hotels</div>
                        </a>
                    </li>

                    @can('departments.index')
                        <li class="menu-item {{ Request::routeIs('departments.index') ? 'active' : '' }}">
                            <a href="{{ route('departments.index') }}" class="menu-link">
                                <div data-i18n="Analytics">Departments</div>
                            </a>
                        </li>
                    @endcan

                    <li
                        class="menu-item {{ Request::routeIs('villas.show') ? 'active' : '' }} || {{ Request::routeIs('villas.index') ? 'active' : '' }}">
                        <a href="{{ route('villas.index') }}" class="menu-link">
                            <div data-i18n="Analytics">Villas</div>
                        </a>
                    </li>

                    <li class="menu-item {{ Request::routeIs('rooms.index') ? 'active' : '' }}">
                        <a href="{{ route('rooms.index') }}" class="menu-link">
                            <div data-i18n="Analytics">Rooms</div>
                        </a>
                    </li>

                    <li class="menu-item {{ Request::routeIs('locations.index') ? 'active' : '' }}">
                        <a href="{{ route('locations.index') }}" class="menu-link">
                            <div data-i18n="Analytics">Locations</div>
                        </a>
                    </li>
                </ul>
            </li>
        @endcan

        @can('backup.index')
            <!-- Backup -->
            <li class="menu-item {{ Request::routeIs('backup.index') ? 'active' : '' }}">
                <a href="{{ route('backup.index') }}" class="menu-link">
                    <i class='menu-icon bx bx-download'></i>
                    <div data-i18n="Without menu">Backup</div>
                </a>
            </li>
        @endcan
    </ul>
</aside>
