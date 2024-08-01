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
                    <img src="{{ asset('images/gp-Logo.png') }}" alt="Imagen de ejemplo" width="36" height="36" />
                </a>
            </div>
        </span>
        <span class="app-brand-text demo menu-text fw-bolder ms-2">Inventario</span>

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

        <!-- Equipo -->
        @can('equipo.index')
        <li class="menu-item {{ Request::routeIs('licenses.index') ? 'active' : '' }} || {{ Request::routeIs('equipo.index') ? 'active' : '' }} || {{ Request::routeIs('equipo.create') ? 'active' : '' }} || {{ Request::routeIs('equipo.show') ? 'active' : '' }} || {{ Request::routeIs('equipo.edit') ? 'active' : '' }}
        {{ Request::routeIs('tablets.index') ? 'active' : '' }} || {{ Request::routeIs('tablets.create') ? 'active' : '' }} || {{ Request::routeIs('tablets.show') ? 'active' : '' }} || {{ Request::routeIs('tablets.index') ? 'active' : '' }} || {{ Request::routeIs('tablets.edit') ? 'active' : '' }}
        {{ Request::routeIs('tpvs.index') ? 'active' : '' }} || {{ Request::routeIs('tpvs.create') ? 'active' : '' }} || {{ Request::routeIs('tpvs.show') ? 'active' : '' }} || {{ Request::routeIs('tpvs.index') ? 'active' : '' }} || {{ Request::routeIs('tpvs.edit') ? 'active' : '' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class='menu-icon tf-icons bx bx-desktop'></i>
                <div data-i18n="Layouts">Equipos</div>
            </a>

            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="{{ route('equipo.index') }}" class="menu-link">
                        <i class='menu-icon tf-icons bx bx-list-ol' ></i>
                        <div data-i18n="Without menu">Listado</div>
                    </a>
                </li>
                @can('equipo.create')
                    <li class="menu-item">
                        <a href="{{ route('equipo.create') }}" class="menu-link">
                            <i class='menu-icon tf-icons bx bx-add-to-queue'></i>
                            <div data-i18n="Without navbar">Nuevo</div>
                        </a>
                    </li>
                @endcan

                @can('tablets.index')
                    <li class="menu-item {{ Request::routeIs('tablets.index') ? 'active' : '' }} || {{ Request::routeIs('tablets.create') ? 'active' : '' }} || {{ Request::routeIs('tablets.show') ? 'active' : '' }} || {{ Request::routeIs('tablets.index') ? 'active' : '' }} || {{ Request::routeIs('tablets.edit') ? 'active' : '' }}">
                        <a href="{{ route('tablets.index') }}" class="menu-link">
                            <i class='menu-icon tf-icons bx bx-tab'></i>
                            <div data-i18n="Analytics">Tabletas</div>
                        </a>
                    </li>
                @endcan

                @can('tpvs.index')
                    <li class="menu-item {{ Request::routeIs('tpvs.index') ? 'active' : '' }} || {{ Request::routeIs('tpvs.create') ? 'active' : '' }} || {{ Request::routeIs('tpvs.show') ? 'active' : '' }} || {{ Request::routeIs('tpvs.index') ? 'active' : '' }} || {{ Request::routeIs('tpvs.edit') ? 'active' : '' }}">
                        <a href="{{ route('tpvs.index') }}" class="menu-link">
                            <i class='menu-icon bx bx-tv bx bx-tab'></i>
                            <div data-i18n="Analytics">Tpv's</div>
                        </a>
                    </li>
                @endcan

                <li class="menu-item {{ Request::routeIs('licenses.index') ? 'active' : '' }} ">
                    <a href="{{ route('licenses.index') }}" class="menu-link">
                        <i class='menu-icon tf-icons bx bxl-microsoft'></i>
                        <div data-i18n="Without navbar">Office 365</div>
                    </a>
                </li>
            </ul>
        </li>
        @endcan

        <!-- Empleados -->
        @can('empleados.index')
            <li class="menu-item {{ Request::routeIs('empleados.index') ? 'active' : '' }} || {{ Request::routeIs('empleados.create') ? 'active' : '' }} || {{ Request::routeIs('empleados.show') ? 'active' : '' }} || {{ Request::routeIs('empleados.edit') ? 'active' : '' }}">
                <a href="{{ route('empleados.index') }}" class="menu-link">
                    <i class='menu-icon tf-icons bx bx-user-pin'></i>
                    <div data-i18n="Without menu">Empleados</div>
                </a>
            </li>
        @endcan

        <!-- Historial -->
        @can('historial.index')
            <li class="menu-item {{ Request::routeIs('historial.index') ? 'active' : '' }}">
                <a href="{{ route('historial.index') }}" class="menu-link">
                    <i class='menu-icon tf-icons bx bx-history'></i>
                    <div data-i18n="Analytics">Historial</div>
                </a>
            </li>
        @endcan

        <!-- Asignacion -->
        @can('empleados.asignacion')
            <li class="menu-item {{ Request::routeIs('asignacion.index') ? 'active' : '' }} || {{ Request::routeIs('empleados.detalles') ? 'active' : '' }}">
                <a href="{{ url('asignacion') }}" class="menu-link">
                    <i class='menu-icon tf-icons bx bx-link'></i>
                    <div data-i18n="Without navbar">Asignacion</div>
                </a>
            </li>
        @endcan

        <!-- Users -->
        @can('users.index')
            <!-- Administrador -->
            <li class="menu-header small text-uppercase">
                <span class="menu-header-text">Administrador</span>
            </li>
            <!--Usuarios-->
            <li class="menu-item {{ Request::routeIs('users.index') ? 'active' : '' }} || {{ Request::routeIs('users.create') ? 'active' : '' }} || {{ Request::routeIs('users.show') ? 'active' : '' }} || {{ Request::routeIs('users.index') ? 'active' : '' }} || {{ Request::routeIs('users.edit') ? 'active' : '' }}">
                <a href="{{ route('users.index') }}" class="menu-link">
                    <i class='menu-icon tf-icons bx bxs-user-circle'></i>
                    <div data-i18n="Analytics">Usuarios</div>
                </a>
            </li>
        @endcan

        <!-- Roles y permisos -->
        @can('roles.index')
            <li
                class="menu-item {{ Request::routeIs('licenses.index') ? 'active' : '' }} || {{ Request::routeIs('equipo.index') ? 'active' : '' }} || {{ Request::routeIs('equipo.create') ? 'active' : '' }} || {{ Request::routeIs('equipo.show') ? 'active' : '' }} || {{ Request::routeIs('equipo.edit') ? 'active' : '' }}">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class='menu-icon tf-icons bx bx-lock'></i>
                    <div data-i18n="Layouts">Roles & Permissions</div>
                </a>

                <ul class="menu-sub">
                    <li class="menu-item {{ Request::routeIs('roles.index') ? 'active' : '' }} || {{ Request::routeIs('roles.create') ? 'active' : '' }} || {{ Request::routeIs('roles.show') ? 'active' : '' }} || {{ Request::routeIs('roles.edit') ? 'active' : '' }}">
                        <a href="{{ route('roles.index') }}" class="menu-link">
                            <div data-i18n="Analytics">Roles</div>
                        </a>
                    </li>
                    
                    <li class="menu-item">
                        <a href="{{ route('licenses.index') }}" class="menu-link">
                            <div data-i18n="Without navbar">Permissions</div>
                        </a>
                    </li>
                </ul>
            </li>
        @endcan

        <!-- Hoteles y departamentos -->
        @can('hotels.index')
            <li class="menu-item {{ Request::routeIs('hotels.index') ? 'active' : '' }} || {{ Request::routeIs('hotels.create') ? 'active' : '' }} || {{ Request::routeIs('hotels.show') ? 'active' : '' }} || {{ Request::routeIs('hotels.edit') ? 'active' : '' }} || {{ Request::routeIs('departments.index') ? 'active' : '' }} || {{ Request::routeIs('departments.create') ? 'active' : '' }} || {{ Request::routeIs('departments.show') ? 'active' : '' }} || {{ Request::routeIs('departments.edit') ? 'active' : '' }}">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                    <i class='menu-icon tf-icons bx bx-building-house'></i>
                    <div data-i18n="Layouts">Hoteles & Departamentos</div>
                </a>

                <ul class="menu-sub">
                    <li class="menu-item">
                        <a href="{{ route('hotels.index') }}" class="menu-link">
                            <div data-i18n="Analytics">Hoteles</div>
                        </a>
                    </li>
                    
                    @can('departments.index')
                    <li class="menu-item">
                        <a href="{{ route('departments.index') }}" class="menu-link">
                            <div data-i18n="Analytics">Departamentos</div>
                        </a>
                    </li>
                    @endcan
                </ul>
            </li>
        @endcan
    </ul>        
</aside>
