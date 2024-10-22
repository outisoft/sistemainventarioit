<x-app-layout>
    <div class="container-xxl navbar-expand-xl align-items-center">
        <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
            <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                <i class="bx bx-menu bx-sm"></i>
            </a>
        </div>
    </div>
    <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">
                    <a href="{{ route('coming2.index') }}" class="btn-ico" data-toggle="tooltip" data-placement="top"
                        title="Regresar">
                        <span>
                            <i class='bx bx-arrow-back'></i>
                        </span>
                    </a>
                    .. / Tablet /</span> Detalles </h4>

            <!-- Basic Bootstrap Table -->
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-header">Detalles de Registro</h5>
                    <div class="navbar-nav align-items-center">
                        <div class="nav-item d-flex align-items-center">
                            <a href="{{ route('coming2.save-pdf', $coming2->id) }}" target="_blank" class="btn-ico" data-placement="top" title="Hoja de resguardo">
                                <i class='bx bxs-file-pdf icon-lg'></i>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="content-wrapper">
                    <div class="table-responsive text-nowrap">
                        <div class="card-datatable table-responsive pt-0">
                            <div class="table-responsive text-nowrap">
                                <div class="card-body">
                                    <table class="table" BORDER=1 CELLPADDING=5 CELLSPACING=5>
                                        <tr>
                                            <th class="bg-secondary">RESPONSABLE</th>
                                            <td>{{ $coming2->operario }}</td>
                                        </tr>
                                        <tr>
                                            <th class="bg-secondary">PUESTO DE TRABAJO</th>
                                            <td>{{ $coming2->puesto }}</td>
                                        </tr>
                                        <tr>
                                            <th class="bg-secondary">EMAIL</th>
                                            <td>{{ $coming2->email }}</td>
                                        </tr>
                                        <tr>
                                            <th class="bg-secondary">USUARIO</th>
                                            <td>{{ $coming2->usuario }}</td>
                                        </tr>
                                        <tr>
                                            <th class="bg-secondary">PASSWORD</th>
                                            <td>{{ $coming2->password }}</td>
                                        </tr>
                                        <tr>
                                            <th class="bg-secondary">NUMERO DE TABLET</th>
                                            <td>{{ $coming2->numero_tableta }}</td>
                                        </tr>
                                        <tr>
                                            <th class="bg-secondary">NUMERO DE SERIE</th>
                                            <td>{{ $coming2->serial }}</td>
                                        </tr>
                                        <tr>
                                            <th class="bg-secondary">NUMERO DE TELEFONO</th>
                                            <td>{{ $coming2->numero_telefono }}</td>
                                        </tr>
                                        <tr>
                                            <th class="bg-secondary">IMEI</th>
                                            <td>{{ $coming2->imei }}</td>
                                        </tr>
                                        <tr>
                                            <th class="bg-secondary">SIM</th>
                                            <td>{{ $coming2->sim }}</td>
                                        </tr>
                                        <tr>
                                            <th class="bg-secondary">POLITICA APLICADA</th>
                                            <td>{{ $coming2->policies->name }}</td>
                                        </tr>
                                        <tr>
                                            <th class="bg-secondary">¿TABLET CONFIGURADA?</th>
                                            <td>
                                                <div class="col-md">
                                                    <div class="form-check form-check-inline mt-3">
                                                        <input class="form-check-input" type="radio" name="configurada" id="configurada" value="1" {{ $coming2->configurada == '1' ? 'checked' : '' }} disabled/>
                                                        <label class="form-check-label" for="configurada">Si</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="configurada" id="configurada" value="0" {{ $coming2->configurada == '0' ? 'checked' : '' }} disabled/>
                                                        <label class="form-check-label" for="configurada">No</label>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th class="bg-secondary">¿CARTA FIRMADA?</th>
                                            <td>
                                                <div class="col-md">
                                                    <div class="form-check form-check-inline mt-3">
                                                        <input class="form-check-input" type="radio" name="carta_firmada" id="carta_firmada" value="1" {{ $coming2->carta_firmada == '1' ? 'checked' : '' }} disabled/>
                                                        <label class="form-check-label" for="carta_firmada">Si</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="carta_firmada" id="carta_firmada" value="0" {{ $coming2->carta_firmada == '0' ? 'checked' : '' }} disabled/>
                                                        <label class="form-check-label" for="carta_firmada">No</label>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th class="bg-secondary">FOLIO DE BAJA</th>
                                            <td>{{ $coming2->folio_baja }}</td>
                                        </tr>
                                        <tr>
                                            <th class="bg-secondary">OBSERVACIONES</th>
                                            <td>{{ $coming2->observacion }}</td>
                                        </tr>
                                    </table>
                                    <br>
                                    <a href="{{ route('coming2.index') }}" class="btn btn-secondary">
                                        <i class='bx bx-arrow-back'></i>
                                        Volver
                                    </a>
                                    <a href="{{ route('coming2.edit', $coming2->id) }}" class="btn btn-primary">
                                        <i class="bx bx-edit me-1"></i>
                                        Editar
                                    </a>
                                </div>
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
