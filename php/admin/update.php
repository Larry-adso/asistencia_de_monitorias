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
    $tarea = $_POST["tarea"];
    $ruta_doc = $_POST["ruta_doc"];
    $id_monitor = $_POST["id_monitor"];
    $horas = $_POST["horas"];
    $fecha_fin = $_POST["fecha_fin"];
    $id_estado = $_POST["id_estado"];

    $sql = "UPDATE tareas SET tarea = :tarea, ruta_doc = :ruta_doc, id_monitor = :id_monitor, horas = :horas, Fecha_fin = :fecha_fin, id_estado = :id_estado WHERE id = :id";
    $stmt = $conexion->prepare($sql);

    $stmt->bindParam(':id', $id);
    $stmt->bindParam(':tarea', $tarea);
    $stmt->bindParam(':ruta_doc', $ruta_doc);
    $stmt->bindParam(':id_monitor', $id_monitor);
    $stmt->bindParam(':horas', $horas);
    $stmt->bindParam(':fecha_fin', $fecha_fin);
    $stmt->bindParam(':id_estado', $id_estado);

    if ($stmt->execute()) {
        echo "Tarea actualizada exitosamente.";
    } else {
        echo "Error al actualizar la tarea.";
    }
}
?>

<form method="post" action="">
    ID: <input type="text" name="id"><br>
    Tarea: <input type="text" name="tarea"><br>
    Ruta Documento: <input type="text" name="ruta_doc"><br>
    ID Monitor: <input type="text" name="id_monitor"><br>
    Horas: <input type="text" name="horas"><br>
    Fecha Fin: <input type="datetime-local" name="fecha_fin"><br>
    ID Estado: <input type="text" name="id_estado"><br>
    <input type="submit" value="Actualizar Tarea">
</form>
