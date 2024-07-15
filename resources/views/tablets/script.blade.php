<script>
    //new DataTable('#tabletas');
    $('#tabletas').DataTable({
        "pageLength": 10,
        "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "Todos"]],
        language: {
            search: '_INPUT_',
            searchPlaceholder: 'Search...'
        },
        "info": false,
        dom: 'Bfrtip',
        buttons: [
            {
                extend: 'excelHtml5',
                text: '<i class="bx bxs-downvote" data-placement="top" title="Descargar en EXCEL"></i>',
                className: 'btn btn-ico',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16] // Exporta solo las columnas 0, 1 y 2
                }
            },
            {
                extend: 'pdfHtml5',
                text: '<i class="bx bxs-file-pdf" data-placement="top" title="Descargar en PDF"></i>',
                className: 'btn btn-ico',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16] // Exporta solo las columnas 0, 1 y 2
                }
            }
            
        ]

    });
</script>
