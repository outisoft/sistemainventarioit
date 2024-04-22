<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
<script>
    //new DataTable('#empleados');
    $('#empleados').DataTable({
        "lengthMenu": [
            [-1],
            ["Todos"]
        ],
        "searching": false,
        "lengthChange": false,
        "info": false,
        "paging": false
    });
</script>
<script>
    $(document).ready(function() {
        $('#searchInput').on('input', function() {
            var query = $(this).val();

            $.ajax({
                url: "{{ route('empleados.search') }}",
                type: "POST",
                data: {
                    query: query,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    $('#searchResults').html(response);
                }
            });
        });
    });
</script>
<script>
    function validateForm() {
        var fileInput = document.getElementById('myFileInput');
        if (fileInput.value == '') {
            alert('Por favor seleccione un archivo.');
            return false;
        }
    }
</script>