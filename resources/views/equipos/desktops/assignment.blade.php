<x-app-layout>
    <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Equipos /</span> Desktops</h4>

            <!-- Basic Bootstrap Table -->
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-header">Desktops</h5>
                    <div class="navbar-nav align-items-center">
                        <div class="nav-item d-flex align-items-center">
                            @can('desktops.create')
                                <a href="#" class="btn-ico" data-toggle="modal" data-target="#modalCreate"
                                    data-placement="top" title="Agregar Nuevo Registro">
                                    <i class='bx bx-add-to-queue icon-lg'></i>
                                </a>
                            @endcan
                        </div>
                    </div>
                </div>

                <div class="content-wrapper">
                    <div class="table-responsive text-nowrap">
                        <div class="card-datatable table-responsive pt-0">
                            <div class="card-datatable table-responsive pt-0">
                                <form action="{{ route('equipment-complements.store') }}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <label for="equipment_id">Equipo:</label>
                                        <select name="equipment_id" class="form-control">
                                            @foreach($equipment as $eq)
                                                <option value="{{ $eq->id }}">{{ $eq->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label>Complementos:</label>
                                        @foreach($complements as $complement)
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" name="complement_ids[]" value="{{ $complement->id }}">
                                                    {{ $complement->type->name }} - {{ $complement->brand }} - {{ $complement->model }} - {{ $complement->serial }} 
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>

                                    <button type="submit" class="btn btn-primary">Asignar Complementos</button>
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