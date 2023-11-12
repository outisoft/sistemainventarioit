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
                                @if ($registro->tipo->name == 'APLICACION')
                                    <table class="table" BORDER=1 CELLPADDING=5 CELLSPACING=5>
                                        <tr>
                                            <th class="bg-secondary">Tipo de equipo</th>
                                            <td>{{ $registro->tipo->name }}</td>
                                        </tr>
                                        <tr>
                                            <th class="bg-secondary">NOMBRE DE APLICACION</th>
                                            <td>{{ $registro->nombre_app }}</td>
                                        </tr>
                                        <tr>
                                            <th class="bg-primary">Clave del producto</th>
                                            <td>{{ $registro->clave }}</td>
                                        </tr>
                                    </table>
                                @elseif ($registro->tipo->name == 'CARGADOR')
                                    <table class="table" BORDER=1 CELLPADDING=5 CELLSPACING=5>
                                        <tr>
                                            <th class="bg-secondary">Tipo de equipo</th>
                                            <td>{{ $registro->tipo->name }}</td>
                                        </tr>
                                        <tr>
                                            <th class="bg-secondary">MARCA</th>
                                            <td>{{ $registro->marca }}</td>
                                        </tr>
                                        <tr>
                                            <th class="bg-primary">MODELO</th>
                                            <td>{{ $registro->modelo }}</td>
                                        </tr>
                                        <tr>
                                            <th class="bg-primary">NUMERO DE SERIE</th>
                                            <td>{{ $registro->serie }}</td>
                                        </tr>
                                    </table>
                                @elseif ($registro->tipo->name == 'CPU')
                                    <table class="table" BORDER=1 CELLPADDING=5 CELLSPACING=5>
                                        <tr>
                                            <th class="bg-secondary">Tipo de equipo</th>
                                            <td>{{ $registro->tipo->name }}</td>
                                        </tr>
                                        <tr>
                                            <th class="bg-primary">Orden de compra</th>
                                            <td>{{ $registro->orden }}</td>
                                        </tr>
                                        <tr>
                                            <th class="bg-secondary">Marca</th>
                                            <td>{{ $registro->marca }}</td>
                                        </tr>
                                        <tr>
                                            <th class="bg-primary">Modelo</th>
                                            <td>{{ $registro->modelo }}</td>
                                        </tr>
                                        <tr>
                                            <th class="bg-secondary">Numero de serie</th>
                                            <td>{{ $registro->serie }}</td>
                                        </tr>
                                        <tr>
                                            <th class="bg-primary">Nombre de equipo</th>
                                            <td>{{ $registro->nombre_equipo }}</td>
                                        </tr>
                                        <tr>
                                            <th class="bg-secondary">IP</th>
                                            <td>{{ $registro->ip }}</td>
                                        </tr>
                                        <tr>
                                            <th class="bg-primary">NUMERO DE CONTRATO</th>
                                            <td>{{ $registro->no_contrato }}</td>
                                        </tr>
                                    </table>
                                @elseif ($registro->tipo->name == 'IMPRESORA')
                                    <table class="table" BORDER=1 CELLPADDING=5 CELLSPACING=5>
                                        <tr>
                                            <th class="bg-secondary">Tipo de equipo</th>
                                            <td>{{ $registro->tipo->name }}</td>
                                        </tr>
                                        <tr>
                                            <th class="bg-secondary">MARCA</th>
                                            <td>{{ $registro->marca }}</td>
                                        </tr>
                                        <tr>
                                            <th class="bg-primary">MODELO</th>
                                            <td>{{ $registro->modelo }}</td>
                                        </tr>
                                        <tr>
                                            <th class="bg-primary">NUMERO DE SERIE</th>
                                            <td>{{ $registro->serie }}</td>
                                        </tr>
                                    </table>
                                @elseif ($registro->tipo->name == 'LAPTOP')
                                    <table class="table" BORDER=1 CELLPADDING=5 CELLSPACING=5>
                                        <tr>
                                            <th class="bg-secondary">Tipo de equipo</th>
                                            <td>{{ $registro->tipo->name }}</td>
                                        </tr>
                                        <tr>
                                            <th class="bg-primary">Orden de compra</th>
                                            <td>{{ $registro->orden }}</td>
                                        </tr>
                                        <tr>
                                            <th class="bg-secondary">Marca</th>
                                            <td>{{ $registro->marca }}</td>
                                        </tr>
                                        <tr>
                                            <th class="bg-primary">Modelo</th>
                                            <td>{{ $registro->modelo }}</td>
                                        </tr>
                                        <tr>
                                            <th class="bg-secondary">Numero de serie</th>
                                            <td>{{ $registro->serie }}</td>
                                        </tr>
                                        <tr>
                                            <th class="bg-primary">Nombre de equipo</th>
                                            <td>{{ $registro->nombre_equipo }}</td>
                                        </tr>
                                        <tr>
                                            <th class="bg-secondary">IP</th>
                                            <td>{{ $registro->ip }}</td>
                                        </tr>
                                        <tr>
                                            <th class="bg-primary">NUMERO DE CONTRATO</th>
                                            <td>{{ $registro->no_contrato }}</td>
                                        </tr>
                                    </table>
                                @elseif ($registro->tipo->name == 'LECTOR')
                                    <table class="table" BORDER=1 CELLPADDING=5 CELLSPACING=5>
                                        <tr>
                                            <th class="bg-secondary">Tipo de equipo</th>
                                            <td>{{ $registro->tipo->name }}</td>
                                        </tr>
                                        <tr>
                                            <th class="bg-secondary">MARCA</th>
                                            <td>{{ $registro->marca }}</td>
                                        </tr>
                                        <tr>
                                            <th class="bg-primary">MODELO</th>
                                            <td>{{ $registro->modelo }}</td>
                                        </tr>
                                        <tr>
                                            <th class="bg-primary">NUMERO DE SERIE</th>
                                            <td>{{ $registro->serie }}</td>
                                        </tr>
                                    </table>
                                @elseif ($registro->tipo->name == 'MONITOR')
                                    <table class="table" BORDER=1 CELLPADDING=5 CELLSPACING=5>
                                        <tr>
                                            <th class="bg-secondary">Tipo de equipo</th>
                                            <td>{{ $registro->tipo->name }}</td>
                                        </tr>
                                        <tr>
                                            <th class="bg-secondary">MARCA</th>
                                            <td>{{ $registro->marca }}</td>
                                        </tr>
                                        <tr>
                                            <th class="bg-primary">MODELO</th>
                                            <td>{{ $registro->modelo }}</td>
                                        </tr>
                                        <tr>
                                            <th class="bg-primary">NUMERO DE SERIE</th>
                                            <td>{{ $registro->serie }}</td>
                                        </tr>
                                        <tr>
                                            <th class="bg-primary">NUMERO DE CONTRATO</th>
                                            <td>{{ $registro->no_contrato }}</td>
                                        </tr>
                                    </table>
                                @elseif ($registro->tipo->name == 'MOUSE')
                                    <table class="table" BORDER=1 CELLPADDING=5 CELLSPACING=5>
                                        <tr>
                                            <th class="bg-secondary">Tipo de equipo</th>
                                            <td>{{ $registro->tipo->name }}</td>
                                        </tr>
                                        <tr>
                                            <th class="bg-secondary">MARCA</th>
                                            <td>{{ $registro->marca }}</td>
                                        </tr>
                                        <tr>
                                            <th class="bg-primary">NUMERO DE SERIE</th>
                                            <td>{{ $registro->serie }}</td>
                                        </tr>
                                    </table>
                                @elseif ($registro->tipo->name == 'NO BREACK')
                                    <table class="table" BORDER=1 CELLPADDING=5 CELLSPACING=5>
                                        <tr>
                                            <th class="bg-secondary">Tipo de equipo</th>
                                            <td>{{ $registro->tipo->name }}</td>
                                        </tr>
                                        <tr>
                                            <th class="bg-secondary">MARCA</th>
                                            <td>{{ $registro->marca }}</td>
                                        </tr>
                                        <tr>
                                            <th class="bg-primary">MODELO</th>
                                            <td>{{ $registro->modelo }}</td>
                                        </tr>
                                        <tr>
                                            <th class="bg-primary">NUMERO DE SERIE</th>
                                            <td>{{ $registro->serie }}</td>
                                        </tr>
                                    </table>
                                @elseif ($registro->tipo->name == 'OFFICE')
                                    <table class="table" BORDER=1 CELLPADDING=5 CELLSPACING=5>
                                        <tr>
                                            <th class="bg-secondary">Tipo de equipo</th>
                                            <td>{{ $registro->tipo->name }}</td>
                                        </tr>
                                        <tr>
                                            <th class="bg-secondary">PAQUETERIA OFFICE</th>
                                            <td>{{ $registro->office }}</td>
                                        </tr>
                                        <tr>
                                            <th class="bg-primary">CLAVE DE ACTIVACION</th>
                                            <td>{{ $registro->clave }}</td>
                                        </tr>
                                    </table>
                                @elseif ($registro->tipo->name == 'SCANNER')
                                    <table class="table" BORDER=1 CELLPADDING=5 CELLSPACING=5>
                                        <tr>
                                            <th class="bg-secondary">Tipo de equipo</th>
                                            <td>{{ $registro->tipo->name }}</td>
                                        </tr>
                                        <tr>
                                            <th class="bg-secondary">MARCA</th>
                                            <td>{{ $registro->marca }}</td>
                                        </tr>
                                        <tr>
                                            <th class="bg-primary">MODELO</th>
                                            <td>{{ $registro->modelo }}</td>
                                        </tr>
                                        <tr>
                                            <th class="bg-primary">NUMERO DE SERIE</th>
                                            <td>{{ $registro->serie }}</td>
                                        </tr>
                                    </table>
                                @elseif ($registro->tipo->name == 'SO')
                                    <table class="table" BORDER=1 CELLPADDING=5 CELLSPACING=5>
                                        <tr>
                                            <th class="bg-secondary">Tipo de equipo</th>
                                            <td>{{ $registro->tipo->name }}</td>
                                        </tr>
                                        <tr>
                                            <th class="bg-secondary">SISTEMA OPERATIVO</th>
                                            <td>{{ $registro->so }}</td>
                                        </tr>
                                        <tr>
                                            <th class="bg-primary">CLAVE DE ACTIVACION</th>
                                            <td>{{ $registro->clave }}</td>
                                        </tr>
                                    </table>
                                @elseif ($registro->tipo->name == 'TECLADO')
                                    <table class="table" BORDER=1 CELLPADDING=5 CELLSPACING=5>
                                        <tr>
                                            <th class="bg-secondary">Tipo de equipo</th>
                                            <td>{{ $registro->tipo->name }}</td>
                                        </tr>
                                        <tr>
                                            <th class="bg-secondary">MARCA</th>
                                            <td>{{ $registro->marca }}</td>
                                        </tr>
                                        <tr>
                                            <th class="bg-primary">NUMERO DE SERIE</th>
                                            <td>{{ $registro->serie }}</td>
                                        </tr>
                                    </table>
                                @else
                                    <table class="table" BORDER=1 CELLPADDING=5 CELLSPACING=5>
                                        <tr>
                                            <th class="bg-secondary">Tipo de equipo</th>
                                            <td>{{ $registro->tipo->name }}</td>
                                        </tr>
                                        <tr>
                                            <th class="bg-primary">Orden de compra</th>
                                            <td>{{ $registro->orden }}</td>
                                        </tr>
                                        <tr>
                                            <th class="bg-secondary">Marca</th>
                                            <td>{{ $registro->marca }}</td>
                                        </tr>
                                        <tr>
                                            <th class="bg-primary">Modelo</th>
                                            <td>{{ $registro->modelo }}</td>
                                        </tr>
                                        <tr>
                                            <th class="bg-secondary">Numero de serie</th>
                                            <td>{{ $registro->serie }}</td>
                                        </tr>
                                        <tr>
                                            <th class="bg-primary">Nombre de equipo</th>
                                            <td>{{ $registro->nombre_equipo }}</td>
                                        </tr>
                                        <tr>
                                            <th class="bg-secondary">IP</th>
                                            <td>{{ $registro->ip }}</td>
                                        </tr>
                                        <tr>
                                            <th class="bg-primary">NUMERO DE CONTRATO</th>
                                            <td>{{ $registro->no_contrato }}</td>
                                        </tr>
                                        <tr>
                                            <th class="bg-secondary">NOMBRE DE APLICACION</th>
                                            <td>{{ $registro->nombre_app }}</td>
                                        </tr>
                                        <tr>
                                            <th class="bg-primary">Sistema Operativo</th>
                                            <td>{{ $registro->so }}</td>
                                        </tr>
                                        <tr>
                                            <th class="bg-secondary">Office</th>
                                            <td>{{ $registro->office }}</td>
                                        </tr>
                                        <tr>
                                            <th class="bg-primary">Clave del producto</th>
                                            <td>{{ $registro->clave }}</td>
                                        </tr>
                                    </table>
                                @endif
                                <br>
                                <a href="{{ route('equipo.index') }}" class="btn btn-secondary"><i
                                        class='bx bx-arrow-back'></i>Volver</a>
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
