<?php
include("../../conexion/conexion.php");
include("../../includes/alertas.php");

session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $hashed_password = hash('sha512', $password);

    // Consulta para obtener el usuario por email y contraseña hasheada
    $stmt = $conexion->prepare('SELECT id, email FROM usuarios WHERE email = ? AND password = ?');
    $stmt->execute([$email, $hashed_password]);
    $user = $stmt->fetch(); 

    // Verificar si el usuario existe
    if ($user) {
        $_SESSION['id'] = $user['id'];
        header('Location: ../../doc.php');
        exit;
    } else {
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
                    toastr.error("Correo o contraseña incorrectos.", "Error de autenticación");
                    setTimeout(function() {
                        window.location = "../../index.php";
                    }, 1000);
                });
              </script>';
    }
}
?>
