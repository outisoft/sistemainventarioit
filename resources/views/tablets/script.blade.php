<script>
    $(document).ready(function() {
        $('#searchInput').on('input', function() {
            var query = $(this).val();

            $.ajax({
                url: "{{ route('tablet.search') }}",
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