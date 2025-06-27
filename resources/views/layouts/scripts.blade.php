<script src="https://code.jquery.com/jquery-3.7.0.js" nonce="{{ csp_nonce() }}"></script>
<script>
    window.jQuery || document.write(
        '<script src="{{ asset('js/jquery-3.7.0.min.js') }}" nonce="{{ csp_nonce() }}"><\/script>')
</script>

<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js" nonce="{{ csp_nonce() }}"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js" nonce="{{ csp_nonce() }}"></script>
<script src="https://cdn.datatables.net/buttons/1.7.0/js/dataTables.buttons.min.js" nonce="{{ csp_nonce() }}">
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js" nonce="{{ csp_nonce() }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js" nonce="{{ csp_nonce() }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js" nonce="{{ csp_nonce() }}"></script>
<script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.html5.min.js" nonce="{{ csp_nonce() }}"></script>

<style>
    div.dataTables_wrapper div.dataTables_filter {
        text-align: left
    }
</style>

<!--new DataTable('#offices');-->
<script>
    $('#officees').DataTable({
        "pageLength": 10,
        language: {
            search: '_INPUT_',
            searchPlaceholder: 'Search...'
        },
        "info": false,
        dom: 'Bfrtip',
        buttons: []

    });
</script>

<!--new DataTable('#equipments');-->
<script>
    $('#tabla').DataTable({
        "lengthMenu": [
            [10, 25, 50, -1],
            [10, 25, 50, "Todos"]
        ],
        "pageLength": 50,
        language: {
            search: '_INPUT_',
            searchPlaceholder: 'Search...'
        },
        "info": false,
        dom: 'Bfrtip',
        buttons: [{
                extend: 'excelHtml5',
                text: '<i class="bx bxs-downvote" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="top" data-bs-html="true" title="" data-bs-original-title="<span>Download to Excel</span>"></i>',
                className: 'btn btn-ico',
                filename: 'Equipos',
                exportOptions: {
                    columns: ':not(:last-child)' // Exporta solo las columnas 0, 1 y 2
                }
            },
            {
                extend: 'pdfHtml5',
                text: '<i class="bx bxs-file-pdf" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="top" data-bs-html="true" title="" data-bs-original-title="<span>Download to PDF</span>"></i>',
                className: 'btn btn-ico',
                filename: 'Equipos',
                exportOptions: {
                    columns: ':not(:last-child)' // Exporta solo las columnas 0, 1 y 2
                }
            }

        ]

    });
</script>

<!--new DataTable('#BACKUP');-->
<script>
    $('#backup').DataTable({
        order: [
            [0, 'desc']
        ],
        "lengthMenu": [
            [5, 10, 25, 50, -1],
            [5, 10, 25, 50, "Todos"]
        ],
        "pageLength": 5,
        language: {
            search: '_INPUT_',
            searchPlaceholder: 'Search...'
        },
        "info": false,
        dom: 'Bfrtip',
        buttons: []

    });
</script>

<!--new DataTable('#employees');-->
<script>
    new DataTable('#positions', {
        order: [
            [1, 'asc']
        ],
        pageLength: 200,
        lengthMenu: [10, 25, 50, 75, 100],
        language: {
            search: '_INPUT_',
            searchPlaceholder: 'Search...'
        },
        info: false,
        dom: 'Bfrtip',
        buttons: [{
                extend: 'excelHtml5',
                text: '<i class="bx bxs-downvote" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="top" data-bs-html="true" title="" data-bs-original-title="<span>Download to Excel</span>"></i>',
                className: 'btn btn-ico',
                filename: 'Positions',
                exportOptions: {
                    columns: ':not(:last-child)'
                }
            },
            {
                extend: 'pdfHtml5',
                text: '<i class="bx bxs-file-pdf" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="top" data-bs-html="true" title="" data-bs-original-title="<span>Download to PDF</span>"></i>',
                className: 'btn btn-ico',
                filename: 'Positions',
                exportOptions: {
                    columns: ':not(:last-child)'
                }
            }

        ]

    });
</script>

<!--new DataTable('#employees');-->
<script>
    new DataTable('#employees', {
        order: [
            [1, 'asc']
        ],
        pageLength: 200,
        lengthMenu: [10, 25, 50, 75, 100],
        language: {
            search: '_INPUT_',
            searchPlaceholder: 'Search...'
        },
        info: false,
        dom: 'Bfrtip',
        buttons: [{
                extend: 'excelHtml5',
                text: '<i class="bx bxs-downvote" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="top" data-bs-html="true" title="" data-bs-original-title="<span>Download to Excel</span>"></i>',
                className: 'btn btn-ico',
                filename: 'Employees',
                exportOptions: {
                    columns: ':not(:last-child)'
                }
            },
            {
                extend: 'pdfHtml5',
                text: '<i class="bx bxs-file-pdf" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="top" data-bs-html="true" title="" data-bs-original-title="<span>Download to PDF</span>"></i>',
                className: 'btn btn-ico',
                filename: 'Employees',
                exportOptions: {
                    columns: ':not(:last-child)'
                }
            }

        ]

    });
</script>

<!--new DataTable('#complements');-->
<script>
    $('#complements').DataTable({
        "pageLength": 200,
        "lengthMenu": [
            [10, 25, 50, -1],
            [10, 25, 50, "Todos"]
        ],
        language: {
            search: '_INPUT_',
            searchPlaceholder: 'Search...'
        },
        "info": false,
        dom: 'Bfrtip',
        buttons: [{
                extend: 'excelHtml5',
                text: '<i class="bx bxs-downvote" data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="assigned-item" aria-label="Download to Excel" data-bs-original-title="Download to Excel"></i>',
                className: 'btn btn-ico',
                filename: 'Complementos',
                exportOptions: {
                    columns: ':not(:last-child)' // Exporta solo las columnas 0, 1 y 2
                }
            },
            {
                extend: 'pdfHtml5',
                text: '<i class="bx bxs-file-pdf" data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="assigned-item" aria-label="Download to PDF" data-bs-original-title="Download to PDF"></i>',
                className: 'btn btn-ico',
                filename: 'Complementos',
                exportOptions: {
                    columns: ':not(:last-child)' // Exporta solo las columnas 0, 1 y 2
                }
            }

        ]

    });
</script>

<!--new DataTable('#phones');-->
<script>
    $('#phones').DataTable({
        "pageLength": 100,
        "lengthMenu": [
            [10, 25, 50, -1],
            [10, 25, 50, "Todos"]
        ],
        language: {
            search: '_INPUT_',
            searchPlaceholder: 'Search...'
        },
        "info": false,
        dom: 'Bfrtip',
        buttons: [{
                extend: 'excelHtml5',
                text: '<i class="bx bxs-downvote" data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="assigned-item" aria-label="Download to Excel" data-bs-original-title="Download to Excel"></i>',
                className: 'btn btn-ico',
                filename: 'Telefonos',
                exportOptions: {
                    columns: ':not(:last-child)' // Exporta solo las columnas 0, 1 y 2
                }
            },
            {
                extend: 'pdfHtml5',
                text: '<i class="bx bxs-file-pdf" data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="assigned-item" aria-label="Download to PDF" data-bs-original-title="Download to PDF"></i>',
                className: 'btn btn-ico',
                filename: 'Telefonos',
                exportOptions: {
                    columns: ':not(:last-child)' // Exporta solo las columnas 0, 1 y 2
                }
            }

        ]

    });
</script>

<!--new DataTable('#licenses');-->
<script>
    $('#licenses').DataTable({
        "pageLength": 100,
        "lengthMenu": [
            [10, 25, 50, -1],
            [10, 25, 50, "Todos"]
        ],
        language: {
            search: '_INPUT_',
            searchPlaceholder: 'Search...'
        },
        "info": false,
        dom: 'Bfrtip',
        buttons: [{
                extend: 'excelHtml5',
                text: '<i class="bx bxs-downvote" data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="assigned-item" aria-label="Download to Excel" data-bs-original-title="Download to Excel"></i>',
                className: 'btn btn-ico',
                filename: 'Licencias',
                exportOptions: {
                    columns: ':not(:last-child)' // Exporta solo las columnas 0, 1 y 2
                }
            },
            {
                extend: 'pdfHtml5',
                text: '<i class="bx bxs-file-pdf" data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="assigned-item" aria-label="Download to PDF" data-bs-original-title="Download to PDF"></i>',
                className: 'btn btn-ico',
                filename: 'Licencias',
                exportOptions: {
                    columns: ':not(:last-child)' // Exporta solo las columnas 0, 1 y 2
                }
            }

        ]

    });
</script>

<!--new DataTable('#aps');-->
<script>
    $('#aps').DataTable({
        "pageLength": 100,
        "lengthMenu": [
            [10, 25, 50, -1],
            [10, 25, 50, "Todos"]
        ],
        language: {
            search: '_INPUT_',
            searchPlaceholder: 'Search...'
        },
        "info": false,
        dom: 'Bfrtip',
        buttons: [{
                extend: 'excelHtml5',
                text: '<i class="bx bxs-downvote" data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="assigned-item" aria-label="Download to Excel" data-bs-original-title="Download to Excel"></i>',
                className: 'btn btn-ico',
                exportOptions: {
                    columns: ':not(:last-child)' // Exporta solo las columnas 0, 1 y 2
                }
            },
            {
                extend: 'pdfHtml5',
                text: '<i class="bx bxs-file-pdf" data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="assigned-item" aria-label="Download to PDF" data-bs-original-title="Download to PDF"></i>',
                className: 'btn btn-ico',
                exportOptions: {
                    columns: ':not(:last-child)' // Exporta solo las columnas 0, 1 y 2
                }
            }

        ]

    });
</script>

<!--new DataTable('#aps');-->
<script>
    $('#onts').DataTable({
        "pageLength": 100,
        "lengthMenu": [
            [10, 25, 50, -1],
            [10, 25, 50, "Todos"]
        ],
        language: {
            search: '_INPUT_',
            searchPlaceholder: 'Search...'
        },
        "info": false,
        dom: 'Bfrtip',
        buttons: [{
                extend: 'excelHtml5',
                text: '<i class="bx bxs-downvote" data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="assigned-item" aria-label="Download to Excel" data-bs-original-title="Download to Excel"></i>',
                className: 'btn btn-ico',
                exportOptions: {
                    columns: ':not(:last-child)' // Exporta solo las columnas 0, 1 y 2
                }
            },
            {
                extend: 'pdfHtml5',
                text: '<i class="bx bxs-file-pdf" data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="assigned-item" aria-label="Download to PDF" data-bs-original-title="Download to PDF"></i>',
                className: 'btn btn-ico',
                exportOptions: {
                    columns: ':not(:last-child)' // Exporta solo las columnas 0, 1 y 2
                }
            }

        ]

    });
</script>

<!--new DataTable('#switch');-->
<script>
    $('#switchs').DataTable({
        "pageLength": 200,
        "lengthMenu": [
            [10, 25, 50, -1],
            [10, 25, 50, "Todos"]
        ],
        language: {
            search: '_INPUT_',
            searchPlaceholder: 'Search...'
        },
        "info": false,
        dom: 'Bfrtip',
        buttons: [{
                extend: 'excelHtml5',
                text: '<i class="bx bxs-downvote" data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="assigned-item" aria-label="Download to Excel" data-bs-original-title="Download to Excel"></i>',
                className: 'btn btn-ico',
                filename: 'Switchs',
                exportOptions: {
                    columns: ':not(:last-child)' // Exporta solo las columnas 0, 1 y 2
                }
            },
            {
                extend: 'pdfHtml5',
                text: '<i class="bx bxs-file-pdf" data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="assigned-item" aria-label="Download to PDF" data-bs-original-title="Download to PDF"></i>',
                className: 'btn btn-ico',
                filename: 'Switchs',
                exportOptions: {
                    columns: ':not(:last-child)' // Exporta solo las columnas 0, 1 y 2
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
            $('#switchs thead').append('<tr></tr>');
            api.columns().every(function(index) {
                let column = this;

                // Verificar si la columna es filtrable
                if (column.settings()[0].aoColumns[index].bSearchable === false) {
                    // Si no es filtrable, agregar una celda vacía
                    $('#switchs thead tr:eq(1)').append('<th></th>');
                    return;
                }

                // Crear el filtro de búsqueda
                let header = $('#switchs thead tr:eq(1)');
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

<!--new DataTable('#desktops');-->
<script>
    $('#desktops').DataTable({
        "pageLength": 200,
        "lengthMenu": [
            [10, 25, 50, -1],
            [10, 25, 50, "Todos"]
        ],
        language: {
            search: '_INPUT_',
            searchPlaceholder: 'Search...'
        },
        "info": false,
        dom: 'Bfrtip',
        buttons: [{
                extend: 'excelHtml5',
                text: '<i class="bx bxs-downvote" data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="assigned-item" aria-label="Download to Excel" data-bs-original-title="Download to Excel"></i>',
                className: 'btn btn-ico',
                filename: 'Desktops',
                exportOptions: {
                    columns: ':not(:last-child)' // Exporta solo las columnas 0, 1 y 2
                }
            },
            {
                extend: 'pdfHtml5',
                text: '<i class="bx bxs-file-pdf" data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="assigned-item" aria-label="Download to PDF" data-bs-original-title="Download to PDF"></i>',
                className: 'btn btn-ico',
                filename: 'Desktops',
                exportOptions: {
                    columns: ':not(:last-child)' // Exporta solo las columnas 0, 1 y 2
                }
            }

        ]

    });
</script>

<!--new DataTable('#printers');-->
<script>
    $('#printers').DataTable({
        "pageLength": 100,
        "lengthMenu": [
            [10, 25, 50, -1],
            [10, 25, 50, "Todos"]
        ],
        language: {
            search: '_INPUT_',
            searchPlaceholder: 'Search...'
        },
        "info": false,
        dom: 'Bfrtip',
        buttons: [{
                extend: 'excelHtml5',
                text: '<i class="bx bxs-downvote" data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="assigned-item" aria-label="Download to Excel" data-bs-original-title="Download to Excel"></i>',
                className: 'btn btn-ico',
                filename: 'Impresoras',
                exportOptions: {
                    columns: ':not(:last-child)' // Exporta solo las columnas 0, 1 y 2
                }
            },
            {
                extend: 'pdfHtml5',
                text: '<i class="bx bxs-file-pdf" data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="assigned-item" aria-label="Download to PDF" data-bs-original-title="Download to PDF"></i>',
                className: 'btn btn-ico',
                filename: 'Impresoras',
                exportOptions: {
                    columns: ':not(:last-child)' // Exporta solo las columnas 0, 1 y 2
                }
            }

        ]

    });
</script>

<!--new DataTable('#laptops');-->
<script>
    $('#laptops').DataTable({
        "pageLength": 200,
        "lengthMenu": [
            [10, 25, 50, -1],
            [10, 25, 50, "Todos"]
        ],
        language: {
            search: '_INPUT_',
            searchPlaceholder: 'Search...'
        },
        "info": false,
        dom: 'Bfrtip',
        buttons: [{
                extend: 'excelHtml5',
                text: '<i class="bx bxs-downvote" data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="assigned-item" aria-label="Download to Excel" data-bs-original-title="Download to Excel"></i>',
                className: 'btn btn-ico',
                filename: 'Laptops',
                exportOptions: {
                    columns: ':not(:last-child)' // Exporta solo las columnas 0, 1 y 2
                }
            },
            {
                extend: 'pdfHtml5',
                text: '<i class="bx bxs-file-pdf" data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="assigned-item" aria-label="Download to PDF" data-bs-original-title="Download to PDF"></i>',
                className: 'btn btn-ico',
                filename: 'Laptops',
                exportOptions: {
                    columns: ':not(:last-child)' // Exporta solo las columnas 0, 1 y 2
                }
            }

        ]

    });
</script>

<!--new DataTable('#tabs');-->
<script>
    $('#tabs').DataTable({
        "pageLength": 100,
        "lengthMenu": [
            [10, 25, 50, -1],
            [10, 25, 50, "Todos"]
        ],
        language: {
            search: '_INPUT_',
            searchPlaceholder: 'Search...'
        },
        "info": false,
        dom: 'Bfrtip',
        buttons: [{
                extend: 'excelHtml5',
                text: '<i class="bx bxs-downvote" data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="assigned-item" aria-label="Download to Excel" data-bs-original-title="Download to Excel"></i>',
                className: 'btn btn-ico',
                filename: 'Tabs',
                exportOptions: {
                    columns: ':not(:last-child)' // Exporta solo las columnas 0, 1 y 2
                }
            },
            {
                extend: 'pdfHtml5',
                text: '<i class="bx bxs-file-pdf" data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="assigned-item" aria-label="Download to PDF" data-bs-original-title="Download to PDF"></i>',
                className: 'btn btn-ico',
                filename: 'Tabs',
                exportOptions: {
                    columns: ':not(:last-child)' // Exporta solo las columnas 0, 1 y 2
                }
            }

        ]

    });
</script>

<!--new DataTable('#HISTORY');-->
<script>
    $('#historial').DataTable({
        order: [
            [0, 'desc']
        ],
        "pageLength": 100,
        "lengthMenu": [
            [10, 25, 50, -1],
            [10, 25, 50, "Todos"]
        ],
        language: {
            search: '_INPUT_',
            searchPlaceholder: 'Search...'
        },
        "info": false,
        dom: 'Bfrtip',
        buttons: [{
                extend: 'excelHtml5',
                text: '<i class="bx bxs-downvote" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="top" data-bs-html="true" title="" data-bs-original-title="<span>Download to Excel</span>"></i>',
                className: 'btn btn-ico',
                filename: 'Historial',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4] // Exporta solo las columnas 0, 1 y 2
                }
            },
            {
                extend: 'pdfHtml5',
                text: '<i class="bx bxs-file-pdf" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="top" data-bs-html="true" title="" data-bs-original-title="<span>Download to PDF</span>"></i>',
                className: 'btn btn-ico',
                filename: 'Historial',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4] // Exporta solo las columnas 0, 1 y 2
                }
            }

        ]

    });
</script>

<!--new DataTable('#assign');-->
<script>
    $('#asignacion').DataTable({
        "pageLength": 200,
        "lengthMenu": [
            [10, 25, 50, -1],
            [10, 25, 50, "Todos"]
        ],
        language: {
            search: '_INPUT_',
            searchPlaceholder: 'Search...'
        },
        "info": false,
        dom: 'Bfrtip',
        buttons: [{
                extend: 'excelHtml5',
                text: '<i class="bx bxs-downvote" data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="assigned-item" aria-label="Download to Excel" data-bs-original-title="Download to Excel"></i>',
                className: 'btn btn-ico',
                filename: 'Asignacion',
                exportOptions: {
                    columns: ':not(:last-child)' // Exporta solo las columnas 0, 1 y 2
                }
            },
            {
                extend: 'pdfHtml5',
                text: '<i class="bx bxs-file-pdf" data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="assigned-item" aria-label="Download to PDF" data-bs-original-title="Download to PDF"></i>',
                className: 'btn btn-ico',
                filename: 'Asignacion',
                exportOptions: {
                    columns: ':not(:last-child)' // Exporta solo las columnas 0, 1 y 2
                }
            }

        ]

    });
</script>

<!--new DataTable('#tabletas');-->
<script>
    $('#tabletas').DataTable({
        "pageLength": 100,
        "lengthMenu": [
            [10, 25, 50, -1],
            [10, 25, 50, "Todos"]
        ],
        language: {
            search: '_INPUT_',
            searchPlaceholder: 'Search...'
        },
        "info": false,
        dom: 'Bfrtip',
        buttons: [{
                extend: 'excelHtml5',
                text: '<i class="bx bxs-downvote" data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="assigned-item" aria-label="Download to Excel" data-bs-original-title="Download to Excel"></i>',
                className: 'btn btn-ico',
                filename: 'Tabletas',
                exportOptions: {
                    columns: ':not(:last-child)' // Exporta solo las columnas 0, 1 y 2
                }
            },
            {
                extend: 'pdfHtml5',
                text: '<i class="bx bxs-file-pdf" data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="assigned-item" aria-label="Download to PDF" data-bs-original-title="Download to PDF"></i>',
                className: 'btn btn-ico',
                filename: 'Tabletas',
                exportOptions: {
                    columns: ':not(:last-child)' // Exporta solo las columnas 0, 1 y 2
                }
            }

        ]

    });
</script>

<!--new DataTable('#leases');-->
<script>
    $('#leases').DataTable({
        "pageLength": 100,
        "lengthMenu": [
            [10, 25, 50, -1],
            [10, 25, 50, "Todos"]
        ],
        language: {
            search: '_INPUT_',
            searchPlaceholder: 'Search...'
        },
        "info": false,
        dom: 'Bfrtip',
        buttons: [{
                extend: 'excelHtml5',
                text: '<i class="bx bxs-downvote" data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="assigned-item" aria-label="Download to Excel" data-bs-original-title="Download to Excel"></i>',
                className: 'btn btn-ico',
                filename: 'Leases',
                exportOptions: {
                    columns: ':not(:last-child)' // Exporta solo las columnas 0, 1 y 2
                }
            },
            {
                extend: 'pdfHtml5',
                text: '<i class="bx bxs-file-pdf" data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="assigned-item" aria-label="Download to PDF" data-bs-original-title="Download to PDF"></i>',
                className: 'btn btn-ico',
                filename: 'Leases',
                exportOptions: {
                    columns: ':not(:last-child)' // Exporta solo las columnas 0, 1 y 2
                }
            }

        ]

    });
</script>

<!--new DataTable('#villas');-->
<script>
    $('#villas').DataTable({
        "pageLength": 100,
        "lengthMenu": [
            [10, 25, 50, -1],
            [10, 25, 50, "Todos"]
        ],
        language: {
            search: '_INPUT_',
            searchPlaceholder: 'Search...'
        },
        "info": false,
        dom: 'Bfrtip',
        buttons: [{
                extend: 'excelHtml5',
                text: '<i class="bx bxs-downvote" data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="assigned-item" aria-label="Download to Excel" data-bs-original-title="Download to Excel"></i>',
                className: 'btn btn-ico',
                filename: 'Villas',
                exportOptions: {
                    columns: ':not(:last-child)' // Exporta solo las columnas 0, 1 y 2
                }
            },
            {
                extend: 'pdfHtml5',
                text: '<i class="bx bxs-file-pdf" data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="assigned-item" aria-label="Download to PDF" data-bs-original-title="Download to PDF"></i>',
                className: 'btn btn-ico',
                filename: 'Villas',
                exportOptions: {
                    columns: ':not(:last-child)' // Exporta solo las columnas 0, 1 y 2
                }
            }

        ]

    });
</script>

<!--new DataTable('#rooms');-->
<script>
    $('#rooms').DataTable({
        "pageLength": 100,
        "lengthMenu": [
            [10, 25, 50, -1],
            [10, 25, 50, "Todos"]
        ],
        language: {
            search: '_INPUT_',
            searchPlaceholder: 'Search...'
        },
        "info": false,
        dom: 'Bfrtip',
        buttons: [{
                extend: 'excelHtml5',
                text: '<i class="bx bxs-downvote" data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="assigned-item" aria-label="Download to Excel" data-bs-original-title="Download to Excel"></i>',
                className: 'btn btn-ico',
                filename: 'Rooms',
                exportOptions: {
                    columns: ':not(:last-child)' // Exporta solo las columnas 0, 1 y 2
                }
            },
            {
                extend: 'pdfHtml5',
                text: '<i class="bx bxs-file-pdf" data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="assigned-item" aria-label="Download to PDF" data-bs-original-title="Download to PDF"></i>',
                className: 'btn btn-ico',
                filename: 'Rooms',
                exportOptions: {
                    columns: ':not(:last-child)' // Exporta solo las columnas 0, 1 y 2
                }
            }

        ]

    });
</script>

<!--new DataTable('#tpvs');-->
<script>
    $('#tpvs').DataTable({
        "pageLength": 200,
        "lengthMenu": [
            [10, 25, 50, -1],
            [10, 25, 50, "Todos"]
        ],
        language: {
            search: '_INPUT_',
            searchPlaceholder: 'Search...'
        },
        "info": false,
        dom: 'Bfrtip',
        buttons: [{
                extend: 'excelHtml5',
                text: '<i class="bx bxs-downvote" data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="assigned-item" aria-label="Download to Excel" data-bs-original-title="Download to Excel"></i>',
                className: 'btn btn-ico',
                filename: 'TPVs',
                exportOptions: {
                    columns: ':not(:last-child)' // Exporta solo las columnas 0, 1 y 2
                }
            },
            {
                extend: 'pdfHtml5',
                text: '<i class="bx bxs-file-pdf" data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="assigned-item" aria-label="Download to PDF" data-bs-original-title="Download to PDF"></i>',
                className: 'btn btn-ico',
                filename: 'TPVs',
                exportOptions: {
                    columns: ':not(:last-child)' // Exporta solo las columnas 0, 1 y 2
                }
            }

        ]

    });
</script>

<!-- build:js assets/vendor/js/core.js -->
<!-- jQuery (elige UNA versión) -->
<script src="{{ asset('assets/vendor/libs/jquery/jquery.js') }}" nonce="{{ csp_nonce() }}"></script>

<!-- Popper (usa solo la local) -->
<script src="{{ asset('assets/vendor/libs/popper/popper.js') }}" nonce="{{ csp_nonce() }}"></script>

<!-- Bootstrap (usa solo la local) -->
<script src="{{ asset('assets/vendor/js/bootstrap.js') }}" nonce="{{ csp_nonce() }}"></script>

<!-- Vendor JS -->
<script src="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}" nonce="{{ csp_nonce() }}">
</script>
<script src="{{ asset('assets/vendor/js/menu.js') }}" nonce="{{ csp_nonce() }}"></script>
<script src="{{ asset('assets/vendor/libs/apex-charts/apexcharts.js') }}" nonce="{{ csp_nonce() }}"></script>

<!-- Chart.js (elige UNA versión) -->
<script src="{{ asset('js/chart.min.js') }}" nonce="{{ csp_nonce() }}"></script>

<!-- Main JS -->
<script src="{{ asset('assets/js/main.js') }}" nonce="{{ csp_nonce() }}"></script>

<!-- Page JS -->
<script src="{{ asset('assets/js/dashboards-analytics.js') }}" nonce="{{ csp_nonce() }}"></script>

<!-- GitHub buttons (opcional) -->
<script async defer src="https://buttons.github.io/buttons.js" nonce="{{ csp_nonce() }}"></script>
