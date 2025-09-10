<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Camera Types') }}
        </h2>
    </x-slot>

    <div class="content-wrapper">
        <!-- Content -->

        <div class="container-xxl flex-grow-1 container-p-y">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-style1">
                    <li class="breadcrumb-item">
                        CCTV
                    </li>
                    <li class="breadcrumb-item active fw-bold">TYPES</li>
                </ol>
            </nav>

            <!-- Basic Bootstrap Table -->
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-header">Types list</h5>
                    <div class="navbar-nav align-items-center">
                        <div class="nav-item d-flex align-items-center">
                            <a href="#" class="btn-ico" data-bs-target="#modalCreate" data-bs-toggle="modal"
                                data-bs-offset="0,4" data-bs-placement="top" data-bs-html="true" title=""
                                data-bs-original-title="<span>Add new equipment</span>">
                                <i class='bx bx-add-to-queue icon-lg'></i>
                            </a>
                        </div>
                    </div>
                </div>

                @include('cctv.type.create')
                @include('cctv.type.edit')

                <div class="table-responsive text-nowrap" id="searchResults">
                    <table id="types" class="table">
                        <thead class="bg-primary">
                            <tr>
                                <th>Name</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="employeeList">
                            @foreach ($types as $type)
                                <tr>
                                    <td>{{ $type->name }} </td>
                                    <td>
                                        <div class="dropdown">
                                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                data-bs-toggle="dropdown">
                                                <i class="bx bx-dots-vertical-rounded"></i>
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="{{ route('types.show', $type->id) }}"><i
                                                        class="bx bx-show-alt me-1"></i>Show
                                                </a>

                                                <a href="#" data-bs-target="#editModal{{ $type->id }}"
                                                    data-bs-toggle="modal" data-bs-offset="0,4" data-bs-placement="top"
                                                    data-bs-html="true" title="" class="dropdown-item"><i
                                                        class="bx bx-edit me-1"></i>Edit</a>

                                                <form action="{{ route('types.destroy', $type->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="dropdown-item btn-danger"
                                                        onclick="return confirm('Are you sure to delete this equipment?')"><i
                                                            class="bx bx-trash me-1"></i>Delete</button>
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
            <!--/ Basic Bootstrap Table -->

        </div>
        <!-- / Content -->
    </div>
</x-app-layout>
