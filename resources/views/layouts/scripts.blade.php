<!-- Core JS -->
<!-- build:js assets/vendor/js/core.js -->
<script src="../assets/vendor/libs/jquery/jquery.js"></script>
<script src="../assets/vendor/libs/popper/popper.js"></script>
<script src="../assets/vendor/js/bootstrap.js"></script>
<script src="../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>

<script src="../assets/vendor/js/menu.js"></script>
<!-- endbuild -->

<!-- Vendors JS -->
<script src="../assets/vendor/libs/apex-charts/apexcharts.js"></script>

<!-- Main JS -->
<script src="../assets/js/main.js"></script>

<!-- Page JS -->
<script src="../assets/js/dashboards-analytics.js"></script>

<!-- Place this tag in your head or just before your close body tag. -->
<script async defer src="https://buttons.github.io/buttons.js"></script>
<script src="{{ asset('js/app.js') }}"></script>
<script>
    toastr.options = {
        closeButton: true,
        progressBar: true,
        positionClass: 'toast-top-right', // Posición del toast (arriba a la derecha)
        timeOut: 3000 // Duración en milisegundos
    };
</script>        
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Agrega el script de Toastr al final del cuerpo del documento -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<!-- Inicializa Toastr (opcional) -->
<script>
//Agrega este script en tu vista Blade o en un archivo JavaScript separado
    $(document).ready(function () {
        $('#miFormulario').on('submit', function (e) {
            e.preventDefault();
            $.ajax({
                type: 'POST',
                url: $(this).attr('action'),
                data: $(this).serialize(),
                success: function (response) {
                    mostrarToastr(response.message, 'success');
                },
                error: function (error) {
                    mostrarToastr(error.responseJSON.message, 'error');
                }
            });
        });
    });
</script>
<!--Script Modal-->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>    
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<!--Search-->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

