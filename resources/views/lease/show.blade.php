<x-app-layout>
    <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-style1">
                    <li class="breadcrumb-item">
                        <a href="{{ route('lease.index') }}">LEASES</a>
                    </li>
                    <li class="breadcrumb-item active fw-bold">DETAILS</li>
                </ol>
            </nav>

            @if ($lease->equipments->isNotEmpty())
                <div class="card">
                    <div class="content-wrapper">
                        <div class="table-responsive text-nowrap">
                            <div class="card-datatable table-responsive pt-0">
                                <div class="card-body">
                                    <br>
                                    <P class="card-title"><strong>LEASE:</strong> {{ $lease->lease }}</P>
                                    <P class="card-title"><strong>END DATE:</strong> {{ $lease->end_date }}</P>
                                    <p class="card-title"><strong>TOTAL RELATIONS:</strong> {{ $totalRelations }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="content-wrapper">
                        <div class="table-responsive text-nowrap">
                            <div class="card-datatable table-responsive pt-0">
                                <div class="table-responsive text-nowrap" id="searchResults">
                                    <table id="lease_info" class="table">
                                        <thead class="bg-primary">
                                            <tr>
                                                <th>TYPE</th>
                                                <th>EMPLOYEE</th>
                                                <th>LOCATION</th>
                                                <th>BRAND</th>
                                                <th>MODEL</th>
                                                <th>SERIAL</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody id="employeeList">
                                            <!-- Listado de equipos -->
                                            @foreach ($lease->equipments->chunk(4) as $equipos)
                                                @foreach ($equipos as $equipo)
                                                    <tr>
                                                        <td> {{ $equipo->tipo->name }} </td>
                                                        <td>
                                                            @if ($equipo->positions->isNotEmpty())
                                                                @php
                                                                    $position = $equipo->positions->first();
                                                                @endphp
                                                                {{ $position ? $position->employee->name : 'SIN ASIGNAR' }}
                                                            @else
                                                                SIN ASIGNAR
                                                            @endif
                                                        </td>
                                                        <td>
                                                            @if ($equipo->positions->isNotEmpty() && $equipo->positions->first()->hotel)
                                                                {{ $equipo->positions->first()->hotel->name }} -
                                                                {{ optional($equipo->positions->first()->departments)->name }}
                                                            @else
                                                                HOTEL NO ASIGNADO
                                                            @endif
                                                        </td>
                                                        <td>{{ $equipo->marca }}</td>
                                                        <td>{{ $equipo->model }}</td>
                                                        <td>{{ $equipo->serial }}</td>
                                                        <td>
                                                            <div class="dropdown">
                                                                <button type="button"
                                                                    class="btn p-0 dropdown-toggle hide-arrow"
                                                                    data-bs-toggle="dropdown">
                                                                    <i class="bx bx-dots-vertical-rounded"></i>
                                                                </button>
                                                                <div class="dropdown-menu">
                                                                    @can('lease.show')
                                                                        <a class="dropdown-item"
                                                                            href="{{ route('details', $equipo->id) }}"><i
                                                                                class="bx bx-show-alt me-1"></i>Show
                                                                        </a>
                                                                    @endcan
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @endforeach

                                            <!-- Listado de complementos -->
                                            @foreach ($lease->complements as $complement)
                                                <tr>
                                                    <td> {{ $complement->type->name }} </td>

                                                    <td>
                                                        @if ($complement->equipments->isNotEmpty())
                                                            @php
                                                                $position = $complement->equipments
                                                                    ->first()
                                                                    ->positions->first();
                                                            @endphp
                                                            {{ $position ? $position->employee->name : 'SIN ASIGNAR' }}
                                                        @else
                                                            SIN ASIGNAR
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if ($complement->equipments->isNotEmpty())
                                                            @php
                                                                $position = $complement->equipments
                                                                    ->first()
                                                                    ->positions->first();
                                                            @endphp
                                                            @if ($position && $position->hotel)
                                                                {{ $position->hotel->name }} -
                                                                {{ $position->departments->name }}
                                                            @else
                                                                HOTEL NO ASIGNADO
                                                            @endif
                                                        @else
                                                            HOTEL NO ASIGNADO
                                                        @endif
                                                    </td>
                                                    <td>{{ $complement->brand }}</td>
                                                    <td>{{ $complement->model }}</td>
                                                    <td>{{ $complement->serial }}</td>
                                                    <td>
                                                        <div class="dropdown">
                                                            <button type="button"
                                                                class="btn p-0 dropdown-toggle hide-arrow"
                                                                data-bs-toggle="dropdown">
                                                                <i class="bx bx-dots-vertical-rounded"></i>
                                                            </button>
                                                            <div class="dropdown-menu">
                                                                @can('complements.show')
                                                                    <a class="dropdown-item"
                                                                        href="{{ route('complements.show', $complement->id) }}"><i
                                                                            class="bx bx-show-alt me-1"></i>Show
                                                                    </a>
                                                                @endcan
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach

                                            <!-- Listado de tpvs -->
                                            @foreach ($lease->tpvs as $tpv)
                                                <tr>
                                                    <td>TPV</td>
                                                    <td>
                                                        SIN ASIGNAR
                                                    </td>
                                                    <td>

                                                        {{ $tpv->hotel->name }} -
                                                        {{ $tpv->departments->name }}
                                                    </td>
                                                    <td>{{ $tpv->brand }}</td>
                                                    <td>{{ $tpv->model }}</td>
                                                    <td>{{ $tpv->no_serial }}</td>
                                                    <td>
                                                        <div class="dropdown">
                                                            <button type="button"
                                                                class="btn p-0 dropdown-toggle hide-arrow"
                                                                data-bs-toggle="dropdown">
                                                                <i class="bx bx-dots-vertical-rounded"></i>
                                                            </button>
                                                            <div class="dropdown-menu">
                                                                @can('tpvs.show')
                                                                    <a class="dropdown-item"
                                                                        href="{{ route('tpvs.show', $tpv->id) }}"><i
                                                                            class="bx bx-show-alt me-1"></i>Show
                                                                    </a>
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
                </div>
            @endif
            <br>

            <!--info de asignados -->
            <br>
            <a href="{{ route('lease.index') }}" class="btn btn-secondary"><i class='bx bx-arrow-back'></i>Volver</a>

            <hr class="my-5" />

        </div>
        <!-- / Content -->
    </div>
</x-app-layout>
<!--new DataTable('#lease_info');-->
<script>
    new DataTable('#lease_info', {
        "pageLength": 10, // Configuración de la cantidad de filas por página
        "lengthMenu": [
            [10, 25, 50, 100, -1], // Opciones de cantidad de filas
            [10, 25, 50, 100, "Todos"]
        ],
        language: {
            search: '_INPUT_',
            searchPlaceholder: 'Search...',
            info: "Mostrando del _START_ al _END_ de _TOTAL_ entradas", // Personalización del texto
            infoEmpty: "No hay entradas disponibles",
            infoFiltered: "(filtrado de _MAX_ entradas totales)"
        },
        "info": true, // Activar la información de la tabla
        dom: 'lBfrtip', // Incluye 'l' para mostrar el menú desplegable de longitud de página
        layout: {
            topStart: {
                buttons: ['colvis'] // Agregar botón de visibilidad de columnas
            }
        },
        buttons: [{
                extend: 'excelHtml5',
                text: '<i class="bx bxs-downvote" data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="assigned-item" aria-label="Download to Excel" data-bs-original-title="Download to Excel"></i>',
                className: 'btn btn-ico',
                filename: 'Lease_Info',
                exportOptions: {
                    columns: ':not(:last-child)'
                }
            },
            {
                extend: 'pdfHtml5',
                text: '<i class="bx bxs-file-pdf" data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="assigned-item" aria-label="Download to PDF" data-bs-original-title="Download to PDF"></i>',
                className: 'btn btn-ico',
                filename: 'Lease_Info',
                exportOptions: {
                    columns: ':not(:last-child)'
                }
            }
        ],
        columnDefs: [{
            searchable: false,
            targets: [-1] // Deshabilita el filtrado en la última columna
        }],
        initComplete: function() {
            const api = this.api();

            // Agregar una fila adicional para los filtros de búsqueda
            $('#lease_info thead').append('<tr></tr>');
            api.columns().every(function(index) {
                let column = this;

                // Verificar si la columna es filtrable
                if (column.settings()[0].aoColumns[index].bSearchable === false) {
                    // Si no es filtrable, agregar una celda vacía
                    $('#lease_info thead tr:eq(1)').append('<th></th>');
                    return;
                }

                // Crear el filtro de búsqueda
                let header = $('#lease_info thead tr:eq(1)');
                let container = document.createElement('div');
                container.innerHTML = `
                    <select id="smallSelect_${index}" class="form-select form-select-sm">
                        <option value="">Select</option>
                    </select>
                `;
                header.append(`<th>${container.innerHTML}</th>`);

                let select = header.find(`#smallSelect_${index}`);

                // Aplicar listener para cambios en el valor del select
                select.on('change', function() {
                    column
                        .search($(this).val(), {
                            exact: true
                        })
                        .draw();
                });

                // Agregar opciones al select
                column
                    .data()
                    .unique()
                    .sort()
                    .each(function(d, j) {
                        select.append(`<option value="${d}">${d}</option>`);
                    });
            });
        }
    });
</script>
