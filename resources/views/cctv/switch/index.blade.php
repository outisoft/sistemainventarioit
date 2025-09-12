<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('CCTV Switch') }}
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
                    <li class="breadcrumb-item active fw-bold">SWITCHES</li>
                </ol>
            </nav>

            <!-- Basic Bootstrap Table -->
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-header">Switches list</h5>
                    <div class="navbar-nav align-items-center">
                        <div class="nav-item d-flex align-items-center">
                            @can('cctv-switch.create')
                                <a href="#" class="btn-ico" data-bs-target="#modalCreate" data-bs-toggle="modal"
                                    data-bs-offset="0,4" data-bs-placement="top" data-bs-html="true" title=""
                                    data-bs-original-title="<span>Add new equipment</span>">
                                    <i class='bx bx-add-to-queue icon-lg'></i>
                                </a>
                            @endcan
                        </div>
                    </div>
                </div>

                @include('cctv.switch.create')
                @include('cctv.switch.edit')

                <div class="table-responsive text-nowrap" id="searchResults">
                    <table id="switchs" class="table">
                        <thead class="bg-primary">
                            <tr>
                                <th>Name</th>
                                <th>IDF</th>
                                <th>ZONE</th>
                                <th>LOCATIONS</th>
                                <th>BRAND</th>
                                <th>MODEL</th>
                                <th>SERIAL</th>
                                <th>MAC</th>
                                <th>IP</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="employeeList">
                            @foreach ($switches as $switch)
                                <tr>
                                    <td>{{ $switch->name }} </td>
                                    <td>{{ $switch->idf }} </td>
                                    <td>ZONA {{ $switch->zona }} </td>
                                    <td>{{ $switch->location->name ?? 'N/A' }}</td>
                                    <td>{{ $switch->brand }} </td>
                                    <td>{{ $switch->model }} </td>
                                    <td>{{ $switch->serial }} </td>
                                    <td>{{ $switch->mac }} </td>
                                    <td>{{ $switch->ip }} </td>
                                    <td>
                                        <div class="dropdown">
                                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                data-bs-toggle="dropdown">
                                                <i class="bx bx-dots-vertical-rounded"></i>
                                            </button>
                                            <div class="dropdown-menu">
                                                @can('cctv-switch.show')
                                                    <a class="dropdown-item"
                                                        href="{{ route('cctv-switch.show', $switch->id) }}"><i
                                                            class="bx bx-show-alt me-1"></i>Show
                                                    </a>
                                                @endcan

                                                @can('cctv-switch.edit')
                                                    <a href="#" data-bs-target="#editModal{{ $switch->id }}"
                                                        data-bs-toggle="modal" data-bs-offset="0,4" data-bs-placement="top"
                                                        data-bs-html="true" title="" class="dropdown-item"><i
                                                            class="bx bx-edit me-1"></i>Edit</a>
                                                @endcan

                                                @can('cctv-switch.destroy')
                                                    <form action="{{ route('cctv-switch.destroy', $switch->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="dropdown-item btn-danger"
                                                            onclick="return confirm('Are you sure to delete this equipment?')"><i
                                                                class="bx bx-trash me-1"></i>Delete</button>
                                                    </form>
                                                @endcan
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
