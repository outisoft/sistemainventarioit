<x-app-layout>
    <div class="content-wrapper">
      <!-- Content -->
      <div class="container-xxl flex-grow-1 container-p-y">
          <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Inventario /</span> Detalles </h4>
  
          <!-- Basic Bootstrap Table -->
          <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-header">Detalles de <strong> {{ $registro->nombre }} </strong></h5>
                </div>
              
                <div class="table-responsive text-nowrap">
                    <div class="card-body">
                        <p><strong>Nombre:</strong> {{ $registro->nombre }}</p>
                        <p><strong>Cantidad:</strong> {{ $registro->cantidad }}</p>
                        <p><strong>Precio:</strong> {{ $registro->precio }}</p>
                        <a href="{{ route('inventario.index') }}" class="btn btn-secondary">
                            <i class='bx bx-arrow-back'></i>
                            Volver
                        </a>
                        <a href="{{ route('inventario.edit', $registro->id) }}" class="btn btn-primary">
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