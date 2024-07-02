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

$sql = "SELECT * FROM tareas";
$stmt = $conexion->prepare($sql);
$stmt->execute();

$tareas = $stmt->fetchAll(PDO::FETCH_ASSOC);

foreach ($tareas as $tarea) {
    echo "ID: " . $tarea['id'] . "<br>";
    echo "Tarea: " . $tarea['tarea'] . "<br>";
    echo "Ruta Documento: " . $tarea['ruta_doc'] . "<br>";
    echo "ID Monitor: " . $tarea['id_monitor'] . "<br>";
    echo "Horas: " . $tarea['horas'] . "<br>";
    echo "Fecha Fin: " . $tarea['Fecha_fin'] . "<br>";
    echo "ID Estado: " . $tarea['id_estado'] . "<br><br>";
}
?>
