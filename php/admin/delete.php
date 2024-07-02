<?php
include("../../../includes/alertas.php");

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
        toastr.error("Por favor inicie session he intentelo nuevamente ", "Error de autenticación");
        setTimeout(function() {
            window.location = "../../../index.php";
        }, 1000);
    });
  </script>';
    die();
}
include("../../../conexion/conexion.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];

    $sql = "DELETE FROM tareas WHERE id = :id";
    $stmt = $conexion->prepare($sql);

    $stmt->bindParam(':id', $id);

    if ($stmt->execute()) {
        echo "Tarea eliminada exitosamente.";
    } else {
        echo "Error al eliminar la tarea.";
    }
}
?>

<form method="post" action="">
    ID: <input type="text" name="id"><br>
    <input type="submit" value="Eliminar Tarea">
</form>
