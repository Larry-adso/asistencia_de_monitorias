<?php
include("../../conexion/conexion.php");
include("../../includes/alertas.php");

session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $hashed_password = hash('sha512', $password);

    // Consulta para verificar si el correo existe
    $stmt = $conexion->prepare('SELECT id, email, id_rol, password FROM usuarios WHERE email = ?');
    $stmt->execute([$email]);
    $user = $stmt->fetch(); 

    // Verificar si el correo existe
    if ($user) {
        // Verificar si la contraseña es correcta
        if ($user['password'] === $hashed_password) {
            $_SESSION['id'] = $user['id'];
            $_SESSION['id_rol'] = $user['id_rol'];

            // Redirigir según el id_rol
            if ($user['id_rol'] == 1) {
                header('Location: ../admin/index.php');
            } elseif ($user['id_rol'] == 2) {
                header('Location: ../client/index.php');
            } elseif ($user['id_rol'] == 3) {
                header('Location: ../php/index.php');
            } elseif ($user['id_rol'] == 4) {
                header('Location: ../sub_admin/index.php');
            } else {
                header('Location: ../../doc.php'); // Página por defecto
            }
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
                    "timeOut": "2000",
                    "extendedTimeOut": "1000",
                    "showEasing": "swing",
                    "hideEasing": "linear",
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut"
                };
                toastr.error("El correo no se encuentra registrado.", "Error de autenticación");
                setTimeout(function() {
                    window.location = "../../index.php";
                }, 2000);
            });
          </script>';
    }
}
?>
