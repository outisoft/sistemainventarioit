<x-app-layout>
    @include('comunications.phone.create')
    @include('comunications.phone.edit')
    <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">
            <nav aria-label="b7 readcrumb">
                <ol class="breadcrumb breadcrumb-style1">
                    <li class="breadcrumb-item active fw-bold">PHONES</li>
                </ol>
            </nav>

            <!-- Basic Bootstrap Table -->
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-header">Phones List</h5>
                    <div class="navbar-nav align-items-center">
                        <div class="nav-item d-flex align-items-center">
                            <a href="#" class="btn-ico" data-bs-toggle="modal" data-bs-target="#modalCreate"
                                data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="top"
                                data-bs-html="true" title=""
                                data-bs-original-title="<span>Add new equipment</span>">
                                <i class='bx bx-add-to-queue icon-lg'></i>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="content-wrapper">
                    <div class="table-responsive text-nowrap">
                        <div class="card-datatable table-responsive pt-0">
                            <div class="table-responsive text-nowrap" id="searchResults">
                                <table id="phones" class="table">
                                    <thead class="bg-primary">
                                        <tr>
                                            <th>Extension</th>
                                            <th>Service</th>
                                            <th>Model</th>
                                            <th>Serial number</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody id="employeeList">
                                        <!-- Aquí se mostrarán los empleados -->
                                        @foreach ($phones as $phone)
                                            <tr>
                                                <td>{{ $phone->extension }}</td>
                                                <td>{{ $phone->service }}</td>
                                                <td>{{ $phone->model }}</td>
                                                <td>{{ $phone->serial }}</td>
                                                <td>
                                                    <div class="dropdown">
                                                        <button type="button"
                                                            class="btn p-0 dropdown-toggle hide-arrow"
                                                            data-bs-toggle="dropdown">
                                                            <i class="bx bx-dots-vertical-rounded"></i>
                                                        </button>
                                                        <div class="dropdown-menu">
                                                            <a class="dropdown-item"
                                                                href="{{ route('phones.show', $phone->id) }}"><i
                                                                    class="bx bx-show-alt me-1"></i>Show
                                                            </a>

                                                            <a href="#" data-bs-toggle="modal"
                                                                data-bs-target="#editModal{{ $phone->id }}"
                                                                class="dropdown-item"><i
                                                                    class="bx bx-edit me-1"></i>Editar
                                                            </a>

                                                            <form action="{{ route('phones.destroy', $phone->id) }}"
                                                                method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="dropdown-item btn-danger"
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
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--/ Basic Bootstrap Table -->
        </div>
        <!-- / Content -->
    </div>
</x-app-layout>
