$(document).ready(function() {
  // Mostrar notificación Toastr si está presente en la sesión
  if ("{{ Session::has('toastr') }}") {
      var toastrMessage = "{{ Session::get('toastr.message') }}";
      var toastrType = "{{ Session::get('toastr.type') }}";

      toastr[toastrType](toastrMessage);
  }
});
