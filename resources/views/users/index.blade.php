<x-app-layout>
    @section('css')
        <link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    @endsection

    <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-style1">
                    <li class="breadcrumb-item active fw-bold">USERS</li>
                </ol>
            </nav>

            <!-- Basic Bootstrap Table -->
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-header">Users's List</h5>
                    <div class="navbar-nav align-items-center">
                        <div class="nav-item d-flex align-items-center">
                            <div class="nav-item w-px-40 h-auto">
                                <a href="#" class="btn-ico" data-bs-toggle="modal" data-bs-target="#modalCreate"
                                    data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="top"
                                    data-bs-html="true" title=""
                                    data-bs-original-title="<span>Add new user</span>">
                                    <i class='bx bx-add-to-queue icon-lg'></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                @include('users.create')
                @include('users.edit')
                @include('users.show')

                <div class="content-wrapper">
                    <div class="table-responsive text-nowrap">
                        <div class="card-datatable table-responsive pt-0">
                            <div class="table-responsive text-nowrap" id="searchResults">
                                @if ($users->isEmpty())
                                    <h5 class="card-header">Don't found users.</h5>
                                @else
                                    <table id="usuarios" class="table">
                                        <thead class="bg-primary">
                                            <tr>
                                                <th>User</th>
                                                <th>Email</th>
                                                <th>Rol</th>
                                                <th>Region</th>
                                                <th>Acctions</th>
                                            </tr>
                                        </thead>
                                        <tbody id="employeeList">
                                            <!-- Aquí se mostrarán los empleados -->
                                            @foreach ($users as $user)
                                                <tr>
                                                    <td>
                                                        <div style="display: flex; align-items: center;">

                                                            <img src="{{ $user->image ? asset('/storage/avatars/' . $user->image) : $user->avatar }}"
                                                                alt="user-avatar" class="employee-image" />
                                                            <span class="employee-name"
                                                                style="margin-left: 15px;">{{ Str::limit($user->name, 20, '...') }}</span>
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
                                                        @foreach ($user->regions as $region)
                                                            {{ $region->name }}@if (!$loop->last)
                                                                ,
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
                                                                <a href="#" data-bs-toggle="modal"
                                                                    data-bs-target="#showModal{{ $user->id }}"
                                                                    class="dropdown-item"><i
                                                                        class="bx bx-show-alt me-1"></i>Show</a>
                                                                <a href="#" data-bs-toggle="modal"
                                                                    data-bs-target="#editModal{{ $user->id }}"
                                                                    class="dropdown-item"><i
                                                                        class="bx bx-edit me-1"></i>Edit</a>
                                                                <form action="{{ route('users.destroy', $user->id) }}"
                                                                    method="POST">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit"
                                                                        class="dropdown-item btn-danger"
                                                                        onclick="return confirm('Are you sure to delete this user?')"><i
                                                                            class="bx bx-trash me-1"></i>Delete</button>
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
    @endsection
</x-app-layout>
