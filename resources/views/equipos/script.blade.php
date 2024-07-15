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
<script>
    //new DataTable('#usuarios');
    $('#equipos').DataTable({
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
                    columns: [0, 1, 2, 3, 4] // Exporta solo las columnas 0, 1 y 2
                }
            },
            {
                extend: 'pdfHtml5',
                text: '<i class="bx bxs-file-pdf" data-placement="top" title="Descargar en PDF"></i>',
                className: 'btn btn-ico',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4] // Exporta solo las columnas 0, 1 y 2
                }
            }
            
        ]
    });
</script>
