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
            <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Usuarios /</span> Listado </h4>

            <!-- Basic Bootstrap Table -->
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-header">Listado de Usuarios</h5>
                    <div class="navbar-nav align-items-center">
                        <div class="nav-item d-flex align-items-center">
                            <div class="nav-item w-px-40 h-auto">
                                <a href="#" class="btn-ico" data-toggle="modal" data-target="#modalCreate"
                                    data-placement="top" title="Agregar Nuevo Registro">
                                    <i class='bx bx-add-to-queue icon-lg'></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!--Modal create-->
                <div class="modal fade" id="modalCreate" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="myModalLabel">Agregar nuevo usuario</h4>
                                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"><span
                                        aria-hidden="true"></span></button>
                            </div>

                            <div class="modal-body">
                                <form method="POST" action="{{ route('users.store') }}">
                                    @csrf
                                    <!-- Name -->
                                    <div class="mb-3">
                                        <x-input-label class="form-label" for="name" :value="__('Name')" />
                                        <div class="input-group input-group-merge">
                                            <span id="basic-icon-default-fullname2" class="input-group-text">
                                                <i class='bx bx-user'></i>
                                            </span>
                                            <x-text-input id="name" class="form-control" type="text"
                                                name="name" placeholder="Juan Cerez" :value="old('name')" required
                                                autofocus autocomplete="name" />
                                        </div>
                                    </div>
                                    <x-input-error :messages="$errors->get('name')" class="mt-2" />

                                    <!-- Email Address -->
                                    <div class="mt-4">
                                        <x-input-label class="form-label" for="email" :value="__('Email')" />
                                        <div class="input-group input-group-merge">
                                            <span id="basic-icon-default-fullname2" class="input-group-text">
                                                <i class='bx bx-envelope'></i>
                                            </span>
                                            <x-text-input id="email" class="form-control" type="email"
                                                name="email" placeholder="correo@ejemplo.com" :value="old('email')"
                                                required autocomplete="username" />
                                        </div>
                                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                    </div>

                                    <!-- Rol -->
                                    <div class="mt-4">
                                        <label for="exampleFormControlSelect1" class="form-label">Rol</label>
                                        <div class="input-group input-group-merge">
                                            <span id="basic-icon-default-fullname2" class="input-group-text">
                                                <i class='bx bxs-user-detail'></i>
                                            </span>
                                            <select name="rol" class="form-control" id="rol"
                                                aria-label="Default select example">
                                                @foreach ($roles as $rol)
                                                    <option value="{{ $rol->name }}">{{ $rol->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <!-- Password -->
                                    <div class="mt-4">
                                        <x-input-label class="form-label" for="password" :value="__('Password')" />
                                        <div class="input-group input-group-merge">
                                            <span id="basic-icon-default-fullname2" class="input-group-text">
                                                <i class='bx bx-barcode'></i>
                                            </span>
                                            <x-text-input id="password" class="form-control" type="password"
                                                name="password" required autocomplete="new-password" />
                                        </div>
                                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                                    </div>

                                    <!-- Confirm Password -->
                                    <div class="mt-4">
                                        <x-input-label class="form-label" for="password_confirmation"
                                            :value="__('Confirm Password')" />
                                        <div class="input-group input-group-merge">
                                            <span id="basic-icon-default-fullname2" class="input-group-text">
                                                <i class='bx bx-barcode'></i>
                                            </span>
                                            <x-text-input id="password_confirmation" class="form-control"
                                                type="password" name="password_confirmation" required
                                                autocomplete="new-password" />
                                        </div>
                                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
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
                        <div class="card-datatable table-responsive pt-0">
                            <div class="table-responsive text-nowrap" id="searchResults">
                                @if ($users->isEmpty())
                                    <h5 class="card-header">No se encontro registro de usuarios.</h5>
                                @else
                                    <table id="usuarios" class="table">
                                        <thead class="bg-primary">
                                            <tr>
                                                <th>Usuario</th>
                                                <th>Correo Electrónico</th>
                                                <th>Rol</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody id="employeeList">
                                            <!-- Aquí se mostrarán los empleados -->
                                            @foreach ($users as $user)
                                                <tr>
                                                    <td>
                                                        <div style="display: flex; align-items: center;">
                                                            <img src="{{ $user->image }}" alt="user-avatar" class="employee-image"/>
                                                            <span class="employee-name" style="margin-left: 15px;">{{ Str::limit($user->name, 20, '...'); }}</span>
                                                        </div>
                                                    </td>
                                                    <td>{{ $user->email }}</td>
                                                    <td>
                                                        @foreach ($user->roles as $rol)
                                                            {{ $rol->name }}
                                                            @if (!$loop->last)
                                                                , <!-- Agregar coma si no es el último rol -->
                                                            @endif
                                                        @endforeach
                                                    </td>
                                                    <td>
                                                        <div class="dropdown">
                                                            <button type="button"
                                                                class="btn p-0 dropdown-toggle hide-arrow"
                                                                data-bs-toggle="dropdown">
                                                                <i class="bx bx-dots-vertical-rounded"></i>
                                                            </button>
                                                            <div class="dropdown-menu">
                                                                <a class="dropdown-item"
                                                                    href="{{ route('users.show', $user->id) }}"><i
                                                                        class="bx bx-show-alt me-1"></i>Ver</a>
                                                                <a class="dropdown-item"
                                                                    href="{{ route('users.edit', $user->id) }}"><i
                                                                        class="bx bx-edit me-1"></i>Editar</a>
                                                                <form action="{{ route('users.destroy', $user->id) }}"
                                                                    method="POST">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit"
                                                                        class="dropdown-item btn-danger"
                                                                        onclick="return confirm('¿Estás seguro de eliminar este equipo?')"><i
                                                                            class="bx bx-trash me-1"></i>Eliminar</button>
                                                                </form>
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
            //new DataTable('#usuarios');
            $('#usuarios').DataTable({
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
                        url: "{{ route('users.search') }}",
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
    @endsection
</x-app-layout>
