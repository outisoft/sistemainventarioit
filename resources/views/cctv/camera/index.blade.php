<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Camera') }}
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
                    <li class="breadcrumb-item active fw-bold">CAMERAS</li>
                </ol>
            </nav>

            <!-- Basic Bootstrap Table -->
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-header">Cameras list</h5>
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

                @include('cctv.camera.create')
                @include('cctv.camera.edit')

                <div class="table-responsive text-nowrap" id="searchResults">
                    <table id="cameras" class="table">
                        <thead class="bg-primary">
                            <tr>
                                <th>NAME</th>
                                <th>IDF</th>
                                <th>ZONA</th>
                                <th>LOCATION</th>
                                <th>BRAND</th>
                                <th>MODEL</th>
                                <th>SERIAL</th>
                                <th>TYPE OF CAMERA</th>
                                <th>MAC</th>
                                <th>IP</th>
                                <th>SW</th>
                                <th>PORT</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="employeeList">
                            @foreach ($cameras as $camera)
                                <tr>
                                    <td>{{ $camera->name }} </td>
                                    <td>{{ $camera->idf ?? 'N/A' }}</td>
                                    <td>ZONA {{ $camera->zona ?? 'N/A' }}</td>
                                    <td>{{ $camera->location->name ?? 'N/A' }}</td>
                                    <td>{{ $camera->brand }} </td>
                                    <td>{{ $camera->model }} </td>
                                    <td>{{ $camera->serial }} </td>
                                    <td>{{ $camera->type_camera->name ?? 'N/A' }} </td>
                                    <td>{{ $camera->mac }} </td>
                                    <td>{{ $camera->ip }} </td>
                                    <td>{{ $camera->switch->name ?? 'N/A' }}</td>
                                    <td>{{ $camera->connected_port ?? 'N/A' }}</td>
                                    <td>
                                        <div class="dropdown">
                                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                data-bs-toggle="dropdown">
                                                <i class="bx bx-dots-vertical-rounded"></i>
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item"
                                                    href="{{ route('cctv-camera.show', $camera->id) }}"><i
                                                        class="bx bx-show-alt me-1"></i>Show
                                                </a>

                                                <a href="#" data-bs-target="#editModal{{ $camera->id }}"
                                                    data-bs-toggle="modal" data-bs-offset="0,4" data-bs-placement="top"
                                                    data-bs-html="true" title="" class="dropdown-item"><i
                                                        class="bx bx-edit me-1"></i>Edit</a>

                                                <form action="{{ route('cctv-camera.destroy', $camera->id) }}"
                                                    method="POST">
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
