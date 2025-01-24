@php
    $user = Auth::user();
    $role = $user->roles()->first();
@endphp
<!-- Navbar -->
<nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
    id="layout-navbar">
    <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
        <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
            <i class="bx bx-menu bx-sm"></i>
        </a>
    </div>


    <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
        <!-- Search -->
        <style>
            /* Estilos para el contenedor de búsqueda */
            .search-container {
                position: relative;
                min-width: 50%;
                /* Ancho mínimo del campo de búsqueda */
            }

            /* Estilos para los resultados de búsqueda */
            .search-results {
                z-index: 1000;
                max-height: 600px;
                /* Altura máxima aumentada */
                overflow-y: auto;
                width: 550px;
                /* Ancho fijo para los resultados */
                box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            }

            /* Estilos para cada elemento de resultado */
            .search-result-item {
                padding: 0.75rem 1rem;
                transition: background-color 0.2s;
            }

            .search-result-item:hover {
                background-color: #f8f9fa;
            }

            /* Estilos para el scrollbar */
            .search-results::-webkit-scrollbar {
                width: 8px;
            }

            .search-results::-webkit-scrollbar-track {
                background: #f1f1f1;
                border-radius: 4px;
            }

            .search-results::-webkit-scrollbar-thumb {
                background: #888;
                border-radius: 4px;
            }

            .search-results::-webkit-scrollbar-thumb:hover {
                background: #555;
            }

            /* Estilos para las secciones de resultados */
            .search-section {
                border-bottom: 1px solid #e9ecef;
                padding: 0.5rem 0;
            }

            .search-section:last-child {
                border-bottom: none;
            }

            /* Estilos para los títulos de sección */
            .search-section-title {
                font-size: 0.75rem;
                text-transform: uppercase;
                color: #6c757d;
                padding: 0.5rem 1rem;
                margin: 0;
                font-weight: 600;
            }

            /* Estilos para la información del resultado */
            .search-result-title {
                font-weight: 600;
                color: #2c3e50;
                margin-bottom: 0.25rem;
                font-size: 0.95rem;
            }

            .search-result-subtitle {
                color: #6c757d;
                font-size: 0.85rem;
                white-space: normal;
                /* Permite el wrap del texto */
                line-height: 1.4;
            }

            /* Estilos responsive */
            @media (max-width: 768px) {
                .search-container {
                    min-width: 300px;
                }

                .search-results {
                    width: 100vw;
                    max-width: 550px;
                    left: 50%;
                    transform: translateX(-50%);
                }
            }
        </style>
        <livewire:global-search />
        <!-- /Search -->
        <ul class="navbar-nav flex-row align-items-center ms-auto">
            <!-- User -->
            <li class="nav-item navbar-dropdown dropdown-user dropdown">
                <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                    <div class="avatar avatar-online">
                        <img src="{{ $user->image ? asset('/storage/avatars/' . $user->image) : $user->avatar }}"
                            alt="Avatar" class="rounded-circle" height="40" width="40">

                    </div>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                        <a class="dropdown-item" href="#">
                            <div class="d-flex">
                                <div class="flex-shrink-0 me-3">
                                    <div class="avatar avatar-online">
                                        <img src="{{ $user->image ? asset('/storage/avatars/' . $user->image) : $user->avatar }}"
                                            alt class="rounded-circle" height="50" width="50" />
                                    </div>
                                </div>
                                <div class="flex-grow-1">
                                    <span class="fw-semibold d-block">{{ Auth::user()->name }}</span>
                                    <small class="text-muted">{{ $role->name }}</small>
                                </div>
                            </div>
                        </a>
                    </li>
                    <li>
                        <div class="dropdown-divider"></div>
                    </li>
                    <li>
                        <a class="dropdown-item" href="{{ route('profile.edit') }}">
                            <i class="bx bx-user me-2"></i>
                            <span class="align-middle">Mi Perfil</span>
                        </a>
                    </li>
                    <!--li>
                        <a class="dropdown-item" href="#">
                            <i class="bx bx-cog me-2"></i>
                            <span class="align-middle">Settings</span>
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="#">
                            <span class="d-flex align-items-center align-middle">
                            <i class="flex-shrink-0 bx bx-credit-card me-2"></i>
                            <span class="flex-grow-1 align-middle">Billing</span>
                            <span class="flex-shrink-0 badge badge-center rounded-pill bg-danger w-px-20 h-px-20">4</span>
                            </span>
                        </a>
                    </li-->
                    <li>
                        <div class="dropdown-divider"></div>
                    </li>
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <a class="dropdown-item" href="route('logout')"
                                onclick="event.preventDefault(); this.closest('form').submit();" target="_blank">
                                <i class="bx bx-power-off me-2"></i>
                                <span class="align-middle">Log Out</span>
                            </a>
                        </form>
                    </li>
                </ul>
            </li>
            <!--/ User -->
        </ul>
    </div>
</nav>
