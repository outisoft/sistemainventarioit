<x-app-layout>
    <div class="content-wrapper">
        <!-- Content -->

        <div class="container-xxl flex-grow-1 container-p-y">
          <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Equipos /</span> Nuevo </h4>

          <!-- Basic Bootstrap Table -->
          <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="card-header">Nuevo Equipo</h5>
            </div>

            <div class="content-wrapper">
                <div class="table-responsive text-nowrap">
                  <div class="card-datatable table-responsive pt-0">
                      <div class="card-body">
                        <form action="{{ route('equipo.store') }}" method="POST" id="miFormulario">
                            @csrf
                            <!-- Tpo de equipo -->
                            <div class="mb-3">
                                <label class="form-label" for="basic-icon-default-fullname">Tipo de equipo</label>
                                <div class="input-group input-group-merge">
                                    <span id="basic-icon-default-fullname2" class="input-group-text">
                                        <i class='bx bxl-slack-old'></i>
                                    </span>
                                    <x-text-input type="text" class="form-control" id="tipo"  name="tipo" placeholder="Desktop" aria-label="Desktop" aria-describedby="basic-icon-default-fullname2" required autofocus autocomplete="tipo" />
                                    <x-input-error :messages="$errors->get('tipo')" class="mt-2" />
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Guardar</button>
                        </form>
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