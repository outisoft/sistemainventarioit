<!--Datatables-->
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.0/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.html5.min.js"></script>

<style>
    div.dataTables_wrapper div.dataTables_filter {
        text-align: left
    }
</style>

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
                exportOptions: {
                    columns: [0, 1, 2, 3, 4] // Exporta solo las columnas 0, 1 y 2
                }
            },
            {
                extend: 'pdfHtml5',
                text: '<i class="bx bxs-file-pdf" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="top" data-bs-html="true" title="" data-bs-original-title="<span>Download to PDF</span>"></i>',
                className: 'btn btn-ico',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4] // Exporta solo las columnas 0, 1 y 2
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
                exportOptions: {
                    columns: [0, 1, 2, 3, 4]
                }
            },
            {
                extend: 'pdfHtml5',
                text: '<i class="bx bxs-file-pdf" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="top" data-bs-html="true" title="" data-bs-original-title="<span>Download to PDF</span>"></i>',
                className: 'btn btn-ico',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4]
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
                exportOptions: {
                    columns: [0, 1, 2, 3, 4] // Exporta solo las columnas 0, 1 y 2
                }
            },
            {
                extend: 'pdfHtml5',
                text: '<i class="bx bxs-file-pdf" data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="assigned-item" aria-label="Download to PDF" data-bs-original-title="Download to PDF"></i>',
                className: 'btn btn-ico',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4] // Exporta solo las columnas 0, 1 y 2
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
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5] // Exporta solo las columnas 0, 1 y 2
                }
            },
            {
                extend: 'pdfHtml5',
                text: '<i class="bx bxs-file-pdf" data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="assigned-item" aria-label="Download to PDF" data-bs-original-title="Download to PDF"></i>',
                className: 'btn btn-ico',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5] // Exporta solo las columnas 0, 1 y 2
                }
            }

        ]

    });
</script>

<!--new DataTable('#office');-->
<script>
    $('#office').DataTable({
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
                    columns: [0, 1] // Exporta solo las columnas 0, 1 y 2
                }
            },
            {
                extend: 'pdfHtml5',
                text: '<i class="bx bxs-file-pdf" data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="assigned-item" aria-label="Download to PDF" data-bs-original-title="Download to PDF"></i>',
                className: 'btn btn-ico',
                exportOptions: {
                    columns: [0, 1] // Exporta solo las columnas 0, 1 y 2
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
                    columns: [0, 1, 2, 3, 4, 5, 6] // Exporta solo las columnas 0, 1 y 2
                }
            },
            {
                extend: 'pdfHtml5',
                text: '<i class="bx bxs-file-pdf" data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="assigned-item" aria-label="Download to PDF" data-bs-original-title="Download to PDF"></i>',
                className: 'btn btn-ico',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5, 6] // Exporta solo las columnas 0, 1 y 2
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
                exportOptions: {
                    columns: [0, 1, 2, 3, 4] // Exporta solo las columnas 0, 1 y 2
                }
            },
            {
                extend: 'pdfHtml5',
                text: '<i class="bx bxs-file-pdf" data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="assigned-item" aria-label="Download to PDF" data-bs-original-title="Download to PDF"></i>',
                className: 'btn btn-ico',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4] // Exporta solo las columnas 0, 1 y 2
                }
            }

        ]

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
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5, 6, 7] // Exporta solo las columnas 0, 1 y 2
                }
            },
            {
                extend: 'pdfHtml5',
                text: '<i class="bx bxs-file-pdf" data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="assigned-item" aria-label="Download to PDF" data-bs-original-title="Download to PDF"></i>',
                className: 'btn btn-ico',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5, 6, 7] // Exporta solo las columnas 0, 1 y 2
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
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5] // Exporta solo las columnas 0, 1 y 2
                }
            },
            {
                extend: 'pdfHtml5',
                text: '<i class="bx bxs-file-pdf" data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="assigned-item" aria-label="Download to PDF" data-bs-original-title="Download to PDF"></i>',
                className: 'btn btn-ico',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5] // Exporta solo las columnas 0, 1 y 2
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
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5, 6, 7] // Exporta solo las columnas 0, 1 y 2
                }
            },
            {
                extend: 'pdfHtml5',
                text: '<i class="bx bxs-file-pdf" data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="assigned-item" aria-label="Download to PDF" data-bs-original-title="Download to PDF"></i>',
                className: 'btn btn-ico',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5, 6, 7] // Exporta solo las columnas 0, 1 y 2
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
                exportOptions: {
                    columns: [0, 1, 2, 3, 4] // Exporta solo las columnas 0, 1 y 2
                }
            },
            {
                extend: 'pdfHtml5',
                text: '<i class="bx bxs-file-pdf" data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="assigned-item" aria-label="Download to PDF" data-bs-original-title="Download to PDF"></i>',
                className: 'btn btn-ico',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4] // Exporta solo las columnas 0, 1 y 2
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
                exportOptions: {
                    columns: [0, 1, 2, 3, 4] // Exporta solo las columnas 0, 1 y 2
                }
            },
            {
                extend: 'pdfHtml5',
                text: '<i class="bx bxs-file-pdf" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="top" data-bs-html="true" title="" data-bs-original-title="<span>Download to PDF</span>"></i>',
                className: 'btn btn-ico',
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
                exportOptions: {
                    columns: [0, 1, 2] // Exporta solo las columnas 0, 1 y 2
                }
            },
            {
                extend: 'pdfHtml5',
                text: '<i class="bx bxs-file-pdf" data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="assigned-item" aria-label="Download to PDF" data-bs-original-title="Download to PDF"></i>',
                className: 'btn btn-ico',
                exportOptions: {
                    columns: [0, 1, 2] // Exporta solo las columnas 0, 1 y 2
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
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15,
                        16
                    ] // Exporta solo las columnas 0, 1 y 2
                }
            },
            {
                extend: 'pdfHtml5',
                text: '<i class="bx bxs-file-pdf" data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="assigned-item" aria-label="Download to PDF" data-bs-original-title="Download to PDF"></i>',
                className: 'btn btn-ico',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15,
                        16
                    ] // Exporta solo las columnas 0, 1 y 2
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
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9] // Exporta solo las columnas 0, 1 y 2
                }
            },
            {
                extend: 'pdfHtml5',
                text: '<i class="bx bxs-file-pdf" data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="assigned-item" aria-label="Download to PDF" data-bs-original-title="Download to PDF"></i>',
                className: 'btn btn-ico',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9] // Exporta solo las columnas 0, 1 y 2
                }
            }

        ]

    });
</script>

<!-- build:js assets/vendor/js/core.js -->
<script src="{{ asset('assets/vendor/libs/jquery/jquery.js') }}"></script>
<script src="{{ asset('assets/vendor/libs/popper/popper.js') }}"></script>
<script src="{{ asset('assets/vendor/js/bootstrap.js') }}"></script>
<script src="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>

<script src="{{ asset('assets/vendor/js/menu.js') }}"></script>
<!-- endbuild -->


<script src="{{ asset('js/chart.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js" charset="utf-8"></script>

<!-- Vendors JS -->
<script src="{{ asset('assets/vendor/libs/apex-charts/apexcharts.js') }}"></script>

<!-- Main JS -->
<script src="{{ asset('assets/js/main.js') }}"></script>

<!-- Page JS -->
<script src="{{ asset('assets/js/dashboards-analytics.js') }}"></script>

<!-- Place this tag in your head or just before your close body tag. -->
<script async defer src="https://buttons.github.io/buttons.js"></script>

<!--Script Modal-->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<!--Search-->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
