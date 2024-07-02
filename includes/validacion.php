<?php
include("alertas.php");

session_start();

if (!isset($_SESSION['id'])) {
    echo '<script>
    $(document).ready(function() {
        toastr.options = {
            "closeButton": true,
            "debug": false,
            "newestOnTop": false,
            "progressBar": true,
            "positionClass": "toast-center-center",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "1000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        };
        toastr.error("Por favor inicie sesión e inténtelo nuevamente", "Error de autenticación");
        setTimeout(function() {
            window.location = "../../index.php";
        }, 1000);
    });
  </script>';
    die();
}

?>