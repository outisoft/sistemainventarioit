<x-app-layout>
    <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Equipos /</span> PC's & Laptops </h4>

            <!-- Basic Bootstrap Table -->
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-header">PC's & Laptops</h5>
                    <div class="navbar-nav align-items-center">
                        <div class="nav-item d-flex align-items-center">
                            <a href="#" class="btn-ico" data-toggle="modal" data-target="#modalCreate"
                                data-placement="top" title="Agregar Nuevo Registro">
                                <i class='bx bx-add-to-queue icon-lg'></i>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="content-wrapper">
                    <div class="table-responsive text-nowrap">
                        <div class="card-datatable table-responsive pt-0">
                            <div class="table-responsive text-nowrap" id="searchResults">
                                <!-- resources/views/hotel_departments/create.blade.php -->
                                <h1>Seleccionar Hotel para Asignar Departamentos</h1>

                                @if(session('success'))
                                    <div style="color: green;">{{ session('success') }}</div>
                                @endif

                                <form action="{{ route('hotels.edit', ['hotel' => '__HOTEL_ID__']) }}" method="GET" onsubmit="this.action = this.action.replace('__HOTEL_ID__', this.hotel_id.value);">
                                    <label for="hotel_id">Selecciona un Hotel:</label>
                                    <select name="hotel_id" id="hotel_id" required>
                                        <option value="">Selecciona un hotel</option>
                                        @foreach($hotels as $hotel)
                                            <option value="{{ $hotel->id }}">{{ $hotel->nombre }}</option>
                                        @endforeach
                                    </select>
                                    <button type="submit">Editar Asignaciones</button>
                                </form>
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