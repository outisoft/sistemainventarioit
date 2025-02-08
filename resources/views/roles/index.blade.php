<x-app-layout>
    @section('css')
        <link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    @endsection

    <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="col-12">
                    <h4 class="fw-bold  mt-6 mb-1">Roles List</h4>
                    <p>A role provided access to predefined menus and features so that depending on assigned role an
                        administrator can have access to what user needs.</p>
                </div>
                <!-- Role cards -->
                <div class="row g-6">
                    <!-- Role cards -->
                    @foreach ($roles as $role)
                    <div class="col-xl-4-c col-lg-6 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center mb-4">
                                    <h6 class="fw-normal mb-0 text-body">Total {{ $role->users_count }} user(s)</h6>
                                    <ul class="list-unstyled d-flex align-items-center avatar-group mb-0">
                                        @foreach ($role->users as $user)
                                            <li data-bs-toggle="tooltip" data-popup="tooltip-custom"
                                                data-bs-placement="top" class="avatar pull-up"
                                                aria-label="{{ $user->name }}"
                                                data-bs-original-title="{{ $user->name }}">
                                                <img class="rounded-circle"
                                                    src="{{ $user->image ? asset('/storage/avatars/' . $user->image) : $user->avatar }}"
                                                    alt="Avatar">
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                                <div class="d-flex justify-content-between align-items-end">
                                    <div class="role-heading">
                                    <h5 class="mb-1">{{ $role->name }}</h5>
                                        @if ($role->name != 'Administrator' || auth()->user()->hasRole('Administrator'))
                                            <a href="#" data-bs-toggle="modal"
                                                data-bs-target="#editRoleModal{{ $role->id }}"
                                                class="role-edit-modal">
                                                <p class="mb-0">Edit Role</p>
                                            </a>
                                        @endif
                                    </div>
                                    @if ($role->name != 'Administrator' || auth()->user()->hasRole('Administrator'))
                                        @can('roles.destroy')
                                            <form action="{{ route('roles.destroy', $role) }}"
                                                onclick="return confirm('Are you sure to delete this role?')"
                                                method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                            </form>
                                        @endcan
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach

                    <!--ADD NEW ROLE-->
                    <div class="col-xl-4-c col-lg-6 col-md-6">
                        <div class="card h-100">
                            <div class="row h-100">
                                <div class="col-sm-5">
                                    <div class="d-flex align-items-end h-100 justify-content-center mt-sm-0 mt-4 ps-6">
                                        <img src="https://demos.themeselection.com/sneat-bootstrap-html-admin-template/assets/img/illustrations/lady-with-laptop-light.png" class="img-fluid" alt="Image" width="120" data-app-light-img="illustrations/lady-with-laptop-light.png" data-app-dark-img="illustrations/lady-with-laptop-dark.png" style="visibility: visible;">
                                    </div>
                                </div>
                                <div class="col-sm-7">
                                    <div class="card-body text-sm-end text-center ps-sm-0">
                                        <button data-bs-target="#addRoleModal" data-bs-toggle="modal" class="btn btn-sm btn-primary mb-4 text-nowrap add-new-role">Add New Role</button>
                                        <p class="mb-0">
                                            Add new role, <br>
                                            if it doesn't exist.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--/ Role cards -->
            </div>
        <!-- / Content -->
        <div class="content-backdrop fade"></div>
    </div>

    <div class="content-wrapper">

        @include('roles.create')
        @include('roles.edit')
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">
            
            <div class="col-12">
                <h4 class="fw-bold mt-6 mb-1">Total users with their roles</h4>
                <p class="mb-0">Find all of your company’s administrator accounts and their associate roles.</p>
            </div>
            <br>
            <!-- Basic Bootstrap Table -->
            <div class="card col-12">

                <div class="content-wrapper">
                    <div class="table-responsive text-nowrap">
                        <div class="card-datatable table-responsive pt-0">
                            <div class="table-responsive text-nowrap" id="searchResults">
                                <table class="table">
                                    <thead class="bg-primary">
                                        <tr>
                                            <th>Roles</th>
                                            <th>Users</th>
                                            <th>Total Users</th>
                                            <th colspan="2"></th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($roles as $role)
                                            <tr>
                                                <td>{{ $role->name }}</td>
                                                <td>
                                                    @if ($role->users->isNotEmpty())
                                                        <ul
                                                            class="list-unstyled d-flex align-items-center avatar-group mb-0">
                                                            @foreach ($role->users as $user)
                                                                <li data-bs-toggle="tooltip" data-popup="tooltip-custom"
                                                                    data-bs-placement="top" class="avatar pull-up"
                                                                    aria-label="{{ $user->name }}"
                                                                    data-bs-original-title="{{ $user->name }}">
                                                                    <img class="rounded-circle"
                                                                        src="{{ $user->image ? asset('/storage/avatars/' . $user->image) : $user->avatar }}"
                                                                        alt="Avatar">
                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                    @else
                                                        <span class="text-muted">No users</span>
                                                    @endif
                                                </td>
                                                <td>{{ $role->users_count }}</td>
                                                <td width="10px">
                                                    @if ($role->name != 'Administrator' || auth()->user()->hasRole('Administrator'))
                                                        @can('roles.edit')
                                                            <a href="#" data-bs-toggle="modal"
                                                                data-bs-target="#editRoleModal{{ $role->id }}"
                                                                class="btn btn-sm btn-primary">Edit</a>
                                                        @endcan
                                                    @endif
                                                </td>
                                                <td width="10px">
                                                    @if ($role->name != 'Administrator' || auth()->user()->hasRole('Administrator'))
                                                        @can('roles.destroy')
                                                            <form action="{{ route('roles.destroy', $role) }}"
                                                                onclick="return confirm('Are you sure to delete this role?')"
                                                                method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit"
                                                                    class="btn btn-sm btn-danger">Delete</button>
                                                            </form>
                                                        @endcan
                                                    @endif
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