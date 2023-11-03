<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <!-- Logo -->
    <div class="app-brand demo">
        <span class="app-brand-logo demo">
            <div class="shrink-0 flex items-center">
            <a href="{{ route('home') }}">
                <img src="{{ asset('images/gp-Logo.png') }}" alt="Imagen de ejemplo" width="36" height="36"/>
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
            <i class='menu-icon tf-icons bx bx-home' ></i>
          <div data-i18n="Analytics">Home</div>
        </a>
      </li>

      <!-- Inventario -->
      <!--li class="menu-item {{ Request::routeIs('inventario.index') ? 'active' : '' }} || {{ Request::routeIs('inventario.create') ? 'active' : '' }} || {{ Request::routeIs('inventario.show') ? 'active' : '' }} || {{ Request::routeIs('inventario.edit') ? 'active' : '' }}">
        <a href="javascript:void(0);" class="menu-link menu-toggle">
            <i class='menu-icon tf-icons bx bx-file'></i>
          <div data-i18n="Layouts">Inventario</div>
        </a>

        <ul class="menu-sub">
          <li class="menu-item">
            <a href="{{ route('inventario.index')}}" class="menu-link">
              <div data-i18n="Without menu">Listado</div>
            </a>
          </li>
          @can('inventario.create')
          <li class="menu-item">
            <a href="{{ route('inventario.create') }}" class="menu-link">
              <div data-i18n="Without navbar">Nuevo</div>
            </a>
          </li>
          @endcan
        </ul>
      </li-->

      <!-- Equipo -->
      <li class="menu-item {{ Request::routeIs('equipo.index') ? 'active' : '' }} || {{ Request::routeIs('equipo.create') ? 'active' : '' }} || {{ Request::routeIs('equipo.show') ? 'active' : '' }} || {{ Request::routeIs('equipo.edit') ? 'active' : '' }}">
        <a href="javascript:void(0);" class="menu-link menu-toggle">
            <i class='menu-icon tf-icons bx bx-desktop'></i>
          <div data-i18n="Layouts">Equipos</div>
        </a>

        <ul class="menu-sub">
          <li class="menu-item">
            <a href="{{ route('equipo.index')}}" class="menu-link">
              <div data-i18n="Without menu">Listado</div>
            </a>
          </li>
          @can('equipos.create')
          <li class="menu-item">
            <a href="{{ route('equipo.create') }}" class="menu-link">
              <div data-i18n="Without navbar">Nuevo</div>
            </a>
          </li>              
          @endcan
        </ul>
      </li>

      <!-- Empleados -->
      <li class="menu-item {{ Request::routeIs('empleados.index') ? 'active' : '' }} || {{ Request::routeIs('empleados.create') ? 'active' : '' }} || {{ Request::routeIs('empleados.show') ? 'active' : '' }} || {{ Request::routeIs('asignacion.index') ? 'active' : '' }} || {{ Request::routeIs('empleados.edit') ? 'active' : '' }}">
        <a href="javascript:void(0);" class="menu-link menu-toggle">
          <i class='menu-icon tf-icons bx bx-user-pin'></i>
          <div data-i18n="Layouts">Empleados</div>
        </a>

        <ul class="menu-sub">
          <li class="menu-item">
            <a href="{{ route('empleados.index') }}" class="menu-link">
              <div data-i18n="Without menu">Listado</div>
            </a>
          </li>
          @can('empleados.create')
          <li class="menu-item">
            <a href="{{ route('empleados.create') }}" class="menu-link">
              <div data-i18n="Without navbar">Nuevo</div>
            </a>
          </li>              
          @endcan

          @can('asignacion')
          <li class="menu-item">
            <a href="{{ url('asignacion') }}" class="menu-link">
              <div data-i18n="Without navbar">Asignar Equipo</div>
            </a>
          </li>              
          @endcan
        </ul>
      </li>

      <!-- Historial -->
      <li class="menu-item {{ Request::routeIs('historial.index') ? 'active' : '' }}">
        <a href="{{ route('historial.index') }}" class="menu-link">
            <i class='menu-icon tf-icons bx bx-history' ></i>
          <div data-i18n="Analytics">Historial</div>
        </a>
      </li>

      <!-- Graficas -->
      <li class="menu-item {{ Request::routeIs('charts.index') ? 'active' : '' }}">
        <a href="{{ route('charts.index') }}" class="menu-link">
          <i class='menu-icon tf-icons bx bxs-bar-chart-alt-2'></i>
          <div data-i18n="Analytics">Graficas</div>
        </a>
      </li>

      @can('users.index')
          <!-- Administrador -->
      <li class="menu-header small text-uppercase">
        <span class="menu-header-text">Administrador</span>
      </li>
      <!--Usuarios-->
      <li class="menu-item {{ Request::routeIs('users.index') ? 'active' : '' }} || {{ Request::routeIs('users.create') ? 'active' : '' }} || {{ Request::routeIs('users.show') ? 'active' : '' }} || {{ Request::routeIs('users.index') ? 'active' : '' }} || {{ Request::routeIs('users.edit') ? 'active' : '' }}">
        <a href="javascript:void(0);" class="menu-link menu-toggle">
          <i class='menu-icon tf-icons bx bxs-user-circle'></i>
          <div data-i18n="Account Settings">Usuarios</div>
        </a>
        <ul class="menu-sub">
          <li class="menu-item">
            <a href="{{ route('users.index') }}" class="menu-link">
              <div data-i18n="Account">Listado</div>
            </a>
          </li>
          <li class="menu-item">
            <a href="{{ route('users.create') }}" class="menu-link">
              <div data-i18n="Notifications">Nuevo</div>
            </a>
          </li>
        </ul>
      </li>
      @endcan

      <!-- Perfil -->
      <li class="menu-header small text-uppercase"><span class="menu-header-text">Perfil</span></li>
      <!--Usuarios-->    
      <li class="menu-item {{ Request::routeIs('profile.edit') ? 'active' : '' }}">
        <a href="javascript:void(0);" class="menu-link menu-toggle">
          <div class="flex-shrink-0 me-3">
              <div class="avatar avatar-online">
                  <img src="{{ asset('assets/img/avatars/3.jpg')}}" alt class="w-px-40 h-auto rounded-circle" />
              </div>
          </div>
          <div class="flex-grow-1">
              <div data-i18n="Account Settings">{{ Auth::user()->name }}</div>
              <small data-i18n="Account Settings">Admin</small>
          </div>
        </a>
        <ul class="menu-sub">
          <li class="menu-item">
            <a href="{{ route('profile.edit') }}" class="menu-link">
              <div data-i18n="Account">Mi perfil</div>
            </a>
          </li>
        </ul>
      </li>
      <li class="menu-header text-uppercase"></li>

      <li class="menu-item">
        <form method="POST" action="{{ route('logout') }}">
        @csrf
          <a href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();" target="_blank" class="menu-link">
            <i class='menu-icon tf-icons bx bx-power-off' ></i>
            <div data-i18n="Documentation">Log Out</div>
          </a>
        </form>
      </li>
    </ul>
</aside>