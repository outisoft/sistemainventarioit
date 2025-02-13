<x-app-layout>
    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">

            <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-style1">
                    <li class="breadcrumb-item">
                    <a href="{{ route('switches.index') }}">SWITCHES</a>
                    </li>
                    <li class="breadcrumb-item active fw-bold">{{ $hotel->name }}</li>
                </ol>
            </nav>
            <style>
                .hex-grid {
                    display: flex;
                    flex-wrap: wrap;
                    width: 300px;
                }

                .hex {
                    position: relative;
                    width: 15%;
                    height: 40px;
                    margin: 7px 0;
                    background-color: #64c7cc;
                    clip-path: polygon(50% 0%, 100% 25%, 100% 75%, 50% 100%, 0% 75%, 0% 25%);
                }

                .hex-online {
                    position: relative;
                    width: 12%;
                    height: 40px;
                    margin: 7px 0;
                    background-color: var(--bs-success);
                    clip-path: polygon(50% 0%, 100% 25%, 100% 75%, 50% 100%, 0% 75%, 0% 25%);
                }

                .hex-offline {
                    position: relative;
                    width: 12%;
                    height: 40px;
                    margin: 7px 0;
                    background-color: var(--bs-danger);
                    clip-path: polygon(50% 0%, 100% 25%, 100% 75%, 50% 100%, 0% 75%, 0% 25%);
                }

                .hex-in {
                    position: absolute;
                    width: 100%;
                    height: 100%;
                    display: flex;
                    justify-content: center;
                    align-items: center;
                }

                .hex-content {
                    text-align: center;
                    color: white;
                    font-size: 10px;
                }
            </style>
            <div class="card">
                <div class="hex-grid">
                    @foreach ($switches as $switch)
                        @if ($switch->status === 'online')
                        <div class="hex-online">
                            <div class="hex-in" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="top"
                                    data-bs-html="true" title=""
                                    data-bs-original-title="<span>{{ $switch->name }}</span>">
                                <div class="hex-content" >
                                
                                </div>
                            </div>
                        </div>
                        @else
                        <div class="hex-offline">
                            <div class="hex-in" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="top"
                                    data-bs-html="true" title=""
                                    data-bs-original-title="<span>{{ $switch->name }}</span>">
                                <div class="hex-content" >
                                
                                </div>
                            </div>
                        </div>
                        @endif
                    @endforeach
                    <!-- Repite los hexágonos según sea necesario -->
                </div>
            </div>
            <br>

            <div class="card">
                <div class="card-header">
                    <h5 class="card-header">Lista de Switches</h5>
                </div>
                <div class="table-responsive text-nowrap">
                    <table class="table">
                        <thead class="bg-primary">
                            <tr>
                                <th>Nombre</th>
                                <th>Detalles</th>
                                <th>IP</th>
                                <th>MAC</th>
                                <th>Ubicación</th>
                                <th>Observaciones</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($switches as $switch)
                                <tr>
                                    <td>{{ $switch->name }} ({{ $switch->total_ports }} puertos)</td>
                                    <td>{{ $switch->marca }} / {{ $switch->model }} / {{ $switch->serial }}</td>
                                    <td>{{ $switch->ip }}</td>
                                    <td>{{ $switch->mac }}</td>
                                    <td>{{ $switch->hotel->name }}</td>
                                    <td>{{ $switch->observacion }}</td>
                                    <td>
                                        <div class="dropdown">
                                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                data-bs-toggle="dropdown">
                                                <i class="bx bx-dots-vertical-rounded"></i>
                                            </button>
                                            <div class="dropdown-menu">
                                                @can('switches.show')
                                                    <a class="dropdown-item"
                                                        href="{{ route('switches.show', $switch->id) }}"><i
                                                            class="bx bx-show-alt me-1"></i>Show
                                                    </a>
                                                @endcan

                                                @can('switches.edit')
                                                    <a href="#" data-bs-toggle="modal"
                                                        data-bs-target="#editModal{{ $switch->id }}"
                                                        class="dropdown-item"><i class="bx bx-edit me-1"></i>Edit</a>
                                                @endcan

                                                @can('switches.destroy')
                                                    <form action="{{ route('switches.destroy', $switch->id) }}"
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
        </div>
    </div>
</x-app-layout>