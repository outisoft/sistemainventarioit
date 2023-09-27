<x-app-layout>
    <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Empleados /</span> Detalles </h4>
    
            <!-- Basic Bootstrap Table -->
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-header">Detalles de <strong>{{ $registro->name }}</strong></h5>
                </div>
                <div class="table-responsive text-nowrap">
                    <div class="card-body">
                        <p><strong>No. Colaborador:</strong> {{ $registro->no_empleado }}</p>
                        <p><strong>Nombre:</strong> {{ $registro->name }}</p>
                        <p><strong>Correo:</strong> {{ $registro->email }}</p>
                        <p><strong>Puesto:</strong> {{ $registro->puesto }}</p>
                        <p><strong>Departamento:</strong> {{ $registro->departamento }}</p>
                        <p><strong>Hotel:</strong> {{ $hotel->nombre }}</p>
                        <p><strong>AD:</strong> {{ $registro->ad }}</p>
                        <a href="{{ route('empleados.index') }}" class="btn btn-secondary"><i class='bx bx-arrow-back'></i>Volver</a>
                        <a href="{{ route('empleados.edit', $registro->id) }}" class="btn btn-primary">
                            <i class="bx bx-edit me-1"></i>
                            Editar
                        </a>
                    </div>
                </div>
            </div>
            <!--/ Basic Bootstrap Table -->
    
            <hr class="my-5" />
    
        </div>
        <!-- / Content -->
      </div>
</x-app-layout>
