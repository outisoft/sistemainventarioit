<x-app-layout>
    <nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme" id="layout-navbar">
        <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
            <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                <i class="bx bx-menu bx-sm"></i>
            </a>
        </div>

        <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
        <!-- Search -->
        <div class="navbar-nav align-items-center">
            <form action="{{ route('inventario.search') }}" method="post">
                @csrf
                <div class="search-box nav-item d-flex align-items-center">
                    <i class="bx bx-search fs-4 lh-0"></i>
                    <input id="searchInput" type="text" name="query" class="form-control border-0 shadow-none" placeholder="Search..." aria-label="Search..."/>
                </div>
            </form>
        </div>

        <ul class="navbar-nav flex-row align-items-center ms-auto">             
        </ul>
        </div>
    </nav>
    <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Empleado /</span> Listado </h4>
    
            <!-- Basic Bootstrap Table -->
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-header">Listado de Empleados</h5>
                    <div class="navbar-nav align-items-center">
                        <div class="nav-item d-flex align-items-center">
                            <div class="nav-item w-px-40 h-auto">
                                <a href="{{ route('empleados.create') }}" class="btn-ico" data-toggle="tooltip" data-placement="top" title="Agregar Nuevo Registro">
                                    <i class='bx bx-add-to-queue icon-lg'></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="content-wrapper">
                  <div class="table-responsive text-nowrap">
                    <div class="card-datatable table-responsive pt-0">
                        <div class="table-responsive text-nowrap" id="searchResults">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>Nombre</th>
                                        <th>Puesto</th>
                                        <th>Hotel</th>
                                        <!--th>Equipo</th-->
                                        <th>AD</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody id="employeeList">
                                    <!-- Aquí se mostrarán los empleados -->
                                    @foreach($empleados as $empleado)
                                        <tr>
                                            <td></td>
                                            <td>{{ $empleado->name }}</td>
                                            <td>{{ $empleado->puesto }}</td>
                                            <td>{{ $empleado->hotel->nombre }}</td>
                                            <!--td>{{ $empleado->equipo?->tipo ?? 'Sin equipo asignado' }}</td-->
                                            <td>{{ $empleado->ad }}</td>
                                            <td>
                                                <div class="dropdown">
                                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                                        <img width="15" height="15" src="https://img.icons8.com/ios-glyphs/30/menu-2.png" alt="menu-2"/>
                                                    </button>
                                                    <div class="dropdown-menu">
                                                        <a href="{{ route('empleados.show', $empleado->id) }}" class="dropdown-item">
                                                            <i class="bx bx-show-alt me-1"></i> Show
                                                        </a>
                                                        <a href="{{ route('empleados.edit', $empleado->id) }}" class="dropdown-item" href="javascript:void(0);">
                                                            <i class="bx bx-edit me-1"></i> Edit
                                                        </a>
                                                        <form class="dropdown-item" action="{{ route('empleados.destroy', $empleado->id) }}" method="POST" class="d-inline" id="miFormulario">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit">
                                                                <i class="bx bx-trash me-1"></i> Eliminar
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>                                                                                        
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>            
                  </div>
                </div>
            </div>
            <!--/ Basic Bootstrap Table -->
    
            <hr class="my-5" />
    
        </div>
        <!-- / Content -->
    </div>
    <script>
        // Aquí se mostrarán los mensajes Toastr
        function mostrarToastr(message, type) {
            toastr[type](message, type.charAt(0).toUpperCase() + type.slice(1));
        }
    </script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#searchInput').on('input', function() {
                var query = $(this).val();

                $.ajax({
                    url: "{{ route('empleados.search') }}",
                    type: "POST",
                    data: {
                        query: query,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        $('#searchResults').html(response);
                    }
                });
            });
        });
    </script>
</x-app-layout>
