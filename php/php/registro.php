<?php
require '../../conexion/conexion.php'; // Incluir el archivo de conexión
include("../../includes/alertas.php");
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require '../../vendor/autoload.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener datos del formulario
    $id = $_POST['id'];
    $nombres = $_POST['nombre'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $hashed_password = hash('sha512', $password);
    $telefono = $_POST['telefono'];
    $id_rol = $_POST['id_rol'];
    $id_area = $_POST['id_area'];

    // Validar entrada
    if (!empty($id) && !empty($nombres) && !empty($email) && !empty($password) && !empty($telefono)) {
        try {
            // Verificar si el correo, ID o teléfono ya están en uso
            $sql = "SELECT COUNT(*) FROM usuarios WHERE id = :id OR email = :email OR telefono = :telefono";
            $stmt = $conexion->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':telefono', $telefono);
            $stmt->execute();
            $count = $stmt->fetchColumn();

            if ($count > 0) {
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
                    toastr.error("El ID, correo o teléfono ya están en uso.", "Error de registro");
                    setTimeout(function() {
                        window.location = "../../views/php/registro.php";
                    }, 1000);
                });
                </script>';
            } else {
                // Obtener el nombre del área
                $sql_area = "SELECT nombre FROM areas WHERE id = :id_area";
                $stmt_area = $conexion->prepare($sql_area);
                $stmt_area->bindParam(':id_area', $id_area);
                $stmt_area->execute();
                $area = $stmt_area->fetchColumn();

                // Preparar y vincular
                $sql = "INSERT INTO usuarios (id, nombres, email, password, telefono, id_rol, id_estado, id_area) VALUES (:id, :nombres, :email, :password, :telefono, :id_rol, 2, :id_area)";
                $stmt = $conexion->prepare($sql);
                $stmt->bindParam(':id', $id);
                $stmt->bindParam(':nombres', $nombres);
                $stmt->bindParam(':email', $email);
                $stmt->bindParam(':password', $hashed_password);
                $stmt->bindParam(':telefono', $telefono);
                $stmt->bindParam(':id_rol', $id_rol);
                $stmt->bindParam(':id_area', $id_area);

                // Ejecutar la declaración
                if ($stmt->execute()) {
                    // Crear una instancia de PHPMailer
                    $mail = new PHPMailer(true);

                    try {
                        $mail->isSMTP();
                        $mail->Host = 'smtp.gmail.com';  // Especifica el servidor SMTP de Gmail
                        $mail->SMTPAuth = true;
                        $mail->Username = 'senatrabajos2022@gmail.com';  // Tu dirección de correo
                        $mail->Password = 'ifan ewbg exlf hjck';  // Tu contraseña de correo
                        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                        $mail->Port = 587;

                        // Remitente y destinatario
                        $mail->setFrom('senatrabajos2022@gmail.com', 'Soporte');
                        $mail->addAddress($email, $nombres);

                        // Contenido del correo
                        $mail->isHTML(true);
                        $mail->Subject = 'Registro exitoso';
                        $mail->Body = "
                        <html>
                        <head>
                            <title>Registro exitoso</title>
                            <style>
                                .card {
                                    margin: 20px;
                                    padding: 20px;
                                    border: 1px solid #ddd;
                                    border-radius: 10px;
                                    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
                                    font-family: Arial, sans-serif;
                                }
                                .card p {
                                    margin: 0 0 10px;
                                }
                                .card img {
                                    display: block;
                                    margin: 10px 0;
                                    max-width: 100%;
                                    height: auto;
                                }
                            </style>
                        </head>
                        <body>
                            <div class='card'>
                                <p>Hola $nombres,</p>
                                <p>Has sido registrado exitosamente en nuestro sistema.</p>
                                <p>Área: $area</p>
                                <p>Usuario: $id</p>
                                <p>Contraseña: $password</p> 
                                <p>Inicia sesión aquí: <a href='http://localhost/monitorias/'>Iniciar sesión</a></p>
                                <p>Saludos,<br>Equipo de Soporte</p>
                            </div>
                        </body>
                        </html>
                        ";
                        // Enviar el correo
                        $mail->send();            
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
                            toastr.success("Registro exitoso.", "Éxito");
                            setTimeout(function() {
                                window.location = "../../index.php";
                            }, 1000);
                        });
                        </script>';
                    } catch (Exception $e) {
                        echo "Error al enviar el correo: {$mail->ErrorInfo}";
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
                            "timeOut": "1000",
                            "extendedTimeOut": "1000",
                            "showEasing": "swing",
                            "hideEasing": "linear",
                            "showMethod": "fadeIn",
                            "hideMethod": "fadeOut"
                        };
                        toastr.error("No fue posible el registro.", "Error de autenticación");
                        setTimeout(function() {
                            window.location = "../../index.php";
                        }, 1000);
                    });
                    </script>';
                }
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    } else {
        echo "Por favor, complete todos los campos requeridos.";
    }
}
?>
