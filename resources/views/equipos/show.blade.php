<x-app-layout>
    <div class="content-wrapper">
        <!-- Content -->

        <div class="container-xxl flex-grow-1 container-p-y">
          <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Equipos /</span> Detalles </h4>

          <!-- Basic Bootstrap Table -->
          <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="card-header">Detalles Equipo</h5>
            </div>

            <div class="content-wrapper">
                <div class="table-responsive text-nowrap">
                  <div class="card-datatable table-responsive pt-0">
                      <div class="card-body">
                        <table class="table">
                          <tr>
                              <th>Tipo de equipo</th>
                              <td>{{ $registro->tipo->name }}</td>
                          </tr>
                          <tr>
                              <th>Orden de compra</th>
                              <td>{{ $registro->orden }}</td>
                          </tr>
                          <tr>
                              <th>Marca</th>
                              <td>{{ $registro->marca }}</td>
                          </tr>
                          <tr>
                            <th>Modelo</th>
                            <td>{{ $registro->modelo }}</td>
                          </tr>
                          <tr>
                            <th>Numero de serie</th>
                            <td>{{ $registro->serie }}</td>
                          </tr>
                          <tr>
                            <th>Nombre de equipo</th>
                            <td>{{ $registro->nombre_equipo }}</td>
                          </tr>
                          <tr>
                            <th>IP</th>
                            <td>{{ $registro->ip }}</td>
                          </tr>
                          <tr>
                            <th>Sistema Operativo</th>
                            <td>{{ $registro->so }}</td>
                          </tr>
                          <tr>
                            <th>Office</th>
                            <td>{{ $registro->office }}</td>
                          </tr>
                          <tr>
                            <th>Clave del producto</th>
                            <td>{{ $registro->clave }}</td>
                          </tr>
                        </table>
                        <br>
                        <a href="{{ route('equipo.index') }}" class="btn btn-secondary"><i class='bx bx-arrow-back'></i>Volver</a>
                        @can('equipos.edit')
                          <a href="{{ route('equipo.edit', $registro->id) }}" class="btn btn-primary">
                              <i class="bx bx-edit me-1"></i>
                              Editar
                          </a>
                        @endcan 
                      </div>
                  </div>            
                </div>
              </div>
          </div>
          <!--/ Basic Bootstrap Table -->

          <hr class="my-5" />

        </div>
        <!-- / Content -->
      </div>   
</x-app-layout>