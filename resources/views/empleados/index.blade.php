<x-app-layout>
    @section('css')
        <link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    @endsection
    <nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
        id="layout-navbar">
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
                        <input id="searchInput" type="text" name="query" class="form-control border-0 shadow-none"
                            placeholder="Search..." aria-label="Search..." />
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
                            @can('empleados.create')
                                <a href="#" class="btn-ico" data-toggle="modal" data-target="#modalCreate"
                                    data-placement="top" title="Agregar Nuevo Registro">
                                    <i class='bx bx-add-to-queue icon-lg'></i>
                                </a>
                            @endcan
                            @if ($empleados->isEmpty())
                                <a href="{{ url('importempleado') }}" class="btn-ico" data-toggle="tooltip"
                                    data-placement="top" title="Importar registros">
                                    <i class='bx bxs-cloud-upload icon-lg'></i>
                                </a>
                            @else
                                <a href="{{ url('exportempleado') }}" class="btn-ico" data-toggle="tooltip"
                                    data-placement="top" title="Exportar registros">
                                    <i class='bx bxs-download icon-lg'></i>
                                </a>
                            @endif
                        </div>
                    </div>
                </div>

                <!--Modal create-->
                <div class="modal fade" id="modalCreate" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="myModalLabel">Agregar nuevo empleado</h4>
                                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"><span
                                        aria-hidden="true"></span></button>
                            </div>

                            <div class="modal-body">
                                <form method="POST" action="{{ route('empleados.store') }}">
                                    @csrf
                                    <!-- Numero de Colaborador -->
                                    <div class="mb-3">
                                        <label class="form-label" for="basic-icon-default-fullname">Numero de
                                            Colaborador</label>
                                        <div class="input-group input-group-merge">
                                            <span id="basic-icon-default-fullname2" class="input-group-text">
                                                <i class='bx bxl-slack-old'></i>
                                            </span>
                                            <x-text-input type="text" class="form-control" id="no_empleado"
                                                name="no_empleado" placeholder="0038628" aria-label="0038628"
                                                aria-describedby="basic-icon-default-fullname2" required autofocus
                                                autocomplete="no_empleado" />
                                            <x-input-error :messages="$errors->get('no_empleado')" class="mt-2" />
                                        </div>
                                    </div>

                                    <!-- Nombre -->
                                    <div class="mb-3">
                                        <x-input-label class="form-label" for="name" :value="__('Nombre completo')" />
                                        <div class="input-group input-group-merge">
                                            <span id="basic-icon-default-fullname2" class="input-group-text">
                                                <i class='bx bx-user'></i>
                                            </span>
                                            <x-text-input id="name" class="form-control" type="text"
                                                name="name" placeholder="Katrina Jones" :value="old('name')" required
                                                autocomplete="name" />
                                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                                        </div>
                                    </div>

                                    <!-- Email Address -->
                                    <div class="mb-3">
                                        <x-input-label class="form-label" for="email" :value="__('Email')" />
                                        <div class="input-group input-group-merge">
                                            <span id="basic-icon-default-fullname2" class="input-group-text">
                                                <i class='bx bx-envelope'></i>
                                            </span>
                                            <x-text-input id="email" class="form-control" type="email"
                                                name="email" placeholder="correo@ejemplo.com" :value="old('email')"
                                                required autocomplete="username" />
                                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                        </div>
                                    </div>

                                    <!-- Puesto -->
                                    <div class="mb-3">
                                        <label class="form-label" for="basic-icon-default-fullname">Puesto</label>
                                        <div class="input-group input-group-merge">
                                            <span id="basic-icon-default-fullname2" class="input-group-text">
                                                <i class='bx bxs-id-card'></i>
                                            </span>
                                            <x-text-input type="text" class="form-control" id="puesto"
                                                name="puesto" placeholder="Chef de partida"
                                                aria-label="Chef de partida"
                                                aria-describedby="basic-icon-default-fullname2" required autofocus
                                                autocomplete="puesto" />
                                            <x-input-error :messages="$errors->get('puesto')" class="mt-2" />
                                        </div>
                                    </div>

                                    <!-- departamento -->
                                    <div class="mb-3">
                                        <label for="exampleFormControlSelect1" class="form-label">Departamento</label>
                                        <div class="input-group input-group-merge">
                                            <span id="basic-icon-default-fullname2" class="input-group-text">
                                                <i class='bx bx-building'></i>
                                            </span>
                                            <select name="departamento_id" class="form-control" id="departamento_id"
                                                aria-label="Default select example">
                                                @foreach ($departamentos as $departamento)
                                                    <option value="{{ $departamento->id }}">{{ $departamento->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <!-- Hotel -->
                                    <div class="mb-3">
                                        <label for="exampleFormControlSelect1" class="form-label">Hotel</label>
                                        <div class="input-group input-group-merge">
                                            <span id="basic-icon-default-fullname2" class="input-group-text">
                                                <i class='bx bx-building-house'></i>
                                            </span>
                                            <select name="hotel_id" class="form-control" id="hotel_id"
                                                aria-label="Default select example">
                                                @foreach ($hoteles as $hotel)
                                                    <option value="{{ $hotel->id }}">{{ $hotel->nombre }}
                                                        ({{ $hotel->tipo }})
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <!-- AD -->
                                    <div class="mb-3">
                                        <label class="form-label" for="basic-icon-default-fullname">AD</label>
                                        <div class="input-group input-group-merge">
                                            <span id="basic-icon-default-fullname2" class="input-group-text">
                                                <i class='bx bx-at'></i>
                                            </span>
                                            <x-text-input name="ad" class="form-control" id="ad"
                                                type="text" placeholder="jkatrina" aria-label="jkatrina"
                                                aria-describedby="basic-icon-default-fullname2" required />
                                            <x-input-error :messages="$errors->get('ad')" class="mt-2" />
                                        </div>
                                    </div>
                                    <br>
                                    <button type="submit" class="btn btn-primary">Guardar</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="content-wrapper">
                    <div class="table-responsive text-nowrap">
                        @if ($empleados->isEmpty())
                            <div style="text-align: center;">
                                <form action="{{ url('importempleado') }}" method="POST"
                                    enctype="multipart/form-data" onsubmit="return validateForm()">
                                    @csrf
                                    <input type="file" name="file" id="myFileInput" style="display: none;">
                                    <label for="myFileInput"
                                        style=" color: black; padding: 12px 20px; text-align: center; display: inline-block; cursor: pointer;"><i
                                            class='bx bxs-cloud-upload icon-bg'></i>Seleccionar archivo</label>
                                    <button type="submit" class="btn btn-primary">Importar</button>
                                </form>
                            </div>
                        @else
                            <div class="card-datatable table-responsive pt-0">
                                <div class="table-responsive text-nowrap" id="searchResults">
                                    @if ($empleados->isEmpty())
                                        <h5 class="card-header">No se encontro registro de empleados.</h5>
                                    @else
                                        <table id="empleados" class="table footer">
                                            <thead class="bg-primary">
                                                <tr>
                                                    <th>Nombre</th>
                                                    <th>Puesto</th>
                                                    <th>Hotel</th>
                                                    <th>Departamento</th>
                                                    <th>AD</th>
                                                    <th>Acciones</th>
                                                </tr>
                                            </thead>
                                            <tbody id="employeeList">
                                                <!-- Aquí se mostrarán los empleados -->
                                                @foreach ($empleados as $empleado)
                                                    <tr>
                                                        <td>{{ $empleado->name }}</td>
                                                        <td>{{ $empleado->puesto }}</td>
                                                        <td>{{ $empleado->hotel->nombre }}</td>
                                                        <td>{{ $empleado->departamento->name }}</td>
                                                        <!--td>{{ $empleado->equipo?->tipo ?? 'Sin equipo asignado' }}</td-->
                                                        <td>{{ $empleado->ad }}</td>
                                                        <td>
                                                            <div class="dropdown">
                                                                <button type="button"
                                                                    class="btn p-0 dropdown-toggle hide-arrow"
                                                                    data-bs-toggle="dropdown">
                                                                    <i class="bx bx-dots-vertical-rounded"></i>
                                                                </button>
                                                                <div class="dropdown-menu">
                                                                    <!-- Aquí se agregarán las opciones -->
                                                                    @can('empleados.show')
                                                                        <a class="dropdown-item"
                                                                            href="{{ route('empleados.show', $empleado->id) }}"><i
                                                                                class="bx bx-show-alt me-1"></i>Ver</a>
                                                                    @endcan

                                                                    @can('empleados.edit')
                                                                        <a class="dropdown-item"
                                                                            href="{{ route('empleados.edit', $empleado->id) }}"><i
                                                                                class="bx bx-edit me-1"></i>Editar</a>
                                                                    @endcan

                                                                    @can('empleados.destroy')
                                                                        <form
                                                                            action="{{ route('empleados.destroy', $empleado->id) }}"
                                                                            method="POST">
                                                                            @csrf
                                                                            @method('DELETE')
                                                                            <button type="submit"
                                                                                class="dropdown-item btn-danger"
                                                                                onclick="return confirm('¿Estás seguro de eliminar este equipo?')"><i
                                                                                    class="bx bx-trash me-1"></i>Eliminar</button>
                                                                        </form>
                                                                    @endcan
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    @endif
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <!--/ Basic Bootstrap Table -->
        </div>
        <!-- / Content -->
    </div>
    @section('js')
        <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
        <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
        <script>
            //new DataTable('#empleados');
            $('#empleados').DataTable({
                "lengthMenu": [
                    [-1],
                    ["Todos"]
                ],
                "searching": false,
                "lengthChange": false,
                "info": false,
                "paging": false
            });
        </script>
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
        <script>
            function validateForm() {
                var fileInput = document.getElementById('myFileInput');
                if (fileInput.value == '') {
                    alert('Por favor seleccione un archivo.');
                    return false;
                }
            }
        </script>
    @endsection
</x-app-layout>
