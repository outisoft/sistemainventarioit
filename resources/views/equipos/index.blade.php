<x-app-layout>
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
            <div class="navbar-nav align-items-center">
                <form action="{{ route('equipo.search') }}" method="post">
                    @csrf
                    <div class="search-box nav-item d-flex align-items-center">
                        <i class="bx bx-search fs-4 lh-0"></i>
                        <input id="searchInput" type="text" name="query" class="form-control border-0 shadow-none"
                            placeholder="Search..." aria-label="Search..." />
                    </div>
                </form>
            </div>
            <!-- /Search -->
        </div>
    </nav>
    <div class="content-wrapper">
        <!-- Content -->

        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Equipos /</span> Listado </h4>

            <!-- Basic Bootstrap Table -->
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-header">Listado de Equipos</h5>
                    <div class="navbar-nav align-items-center">
                        <div class="nav-item d-flex align-items-center">
                            @can('equipo.create')
                                <a href="{{ route('equipo.create') }}" class="btn-ico" data-toggle="tooltip"
                                    data-placement="top" title="Agregar Nuevo Registro">
                                    <i class='bx bx-add-to-queue icon-lg'></i>
                                </a>
                            @endcan

                            @if ($equipos->isEmpty())
                                <a href="#" class="btn-ico" data-toggle="tooltip" data-placement="top"
                                    title="Importar registros">
                                    <i class='bx bxs-cloud-upload icon-lg'></i>
                                </a>
                            @else
                                <a href="{{ url('/exportequipo') }}" class="btn-ico" data-toggle="tooltip"
                                    data-placement="top" title="Exportar registros">
                                    <i class='bx bxs-download icon-lg'></i>
                                </a>
                            @endif
                        </div>
                    </div>
                </div>


                <div class="table-responsive text-nowrap" id="searchResults">

                    @if ($equipos->isEmpty())
                        <div style="text-align: center;">
                            <form action="{{ url('importequipo') }}" method="POST" enctype="multipart/form-data"
                                onsubmit="return validateForm()">
                                @csrf
                                <input type="file" name="file" id="myFileInput" style="display: none;">
                                <label for="myFileInput"
                                    style=" color: black; padding: 12px 20px; text-align: center; display: inline-block; cursor: pointer;"><i
                                        class='bx bxs-cloud-upload icon-bg'></i>Seleccionar archivo</label>
                                <button type="submit" class="btn btn-primary">Importar</button>
                            </form>
                        </div>
                    @else
                        <table id="equipos" class="table">
                            <thead class="bg-primary">
                                <tr>
                                    <th>Tipo</th>
                                    <th>Marca</th>
                                    <th>Modelo</th>
                                    <th>Nombre de equipo</th>
                                    <th>Estado</th>
                                    <th>Acciones</th>
                                    <!-- Otros encabezados de columnas según sea necesario -->
                                </tr>
                            </thead>
                            <tbody id="employeeList">
                                @foreach ($equipos as $equipo)
                                    <tr>
                                        <td>{{ $equipo->tipo->name }}</td>
                                        <td>{{ $equipo->marca }}</td>
                                        <td>{{ $equipo->modelo }}</td>
                                        <td>{{ $equipo->nombre_equipo }}</td>
                                        <td>
                                            @if ($equipo->estado === 'Libre')
                                                <span class="badge bg-label-success">{{ $equipo->estado }}
                                        </td></span-->
                                        <!--span class="badge rounded-pill bg-success">Libre</span-->
                                    @elseif ($equipo->estado === 'En Uso')
                                        <span class="badge bg-label-danger">{{ $equipo->estado }}</span>
                                        <!--span class="badge rounded-pill bg-danger">En uso</span-->
                                @endif
                                </td>
                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                            data-bs-toggle="dropdown">
                                            <i class="bx bx-dots-vertical-rounded"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <!-- Aquí se agregarán las opciones -->
                                            @can('equipos.show')
                                                <a class="dropdown-item" href="{{ route('equipo.show', $equipo->id) }}"><i
                                                        class="bx bx-show-alt me-1"></i>Ver</a>
                                            @endcan

                                            @can('equipos.edit')
                                                <a class="dropdown-item" href="{{ route('equipo.edit', $equipo->id) }}"><i
                                                        class="bx bx-edit me-1"></i>Editar</a>
                                            @endcan

                                            @can('equipos.destroy')
                                                <form action="{{ route('equipo.destroy', $equipo->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="dropdown-item btn-danger"
                                                        onclick="return confirm('¿Estás seguro de eliminar este equipo?')"><i
                                                            class="bx bx-trash me-1"></i>Eliminar</button>
                                                </form>
                                            @endcan

                                        </div>
                                    </div>
                                </td>
                                <!-- Otros campos de la tabla -->
                                </tr>
                    @endforeach
                    </tbody>
                    </table>
                    @endif
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
            //new DataTable('#usuarios');
            $('#equipos').DataTable({
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
                        url: "{{ route('equipo.search') }}",
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
