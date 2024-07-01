<?php
include("../../conexion/conexion.php");

// Consulta para obtener los roles
$stmt = $conexion->prepare('SELECT * FROM rol WHERE id IN (2)');
$stmt->execute();
$roles = $stmt->fetchAll(PDO::FETCH_ASSOC);

$stmt = $conexion->prepare('SELECT * FROM areas');
$stmt->execute();
$area = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!doctype html>
<html lang="en">

<head>
    <title>Formulario</title>
    <meta charset="utf-8" />
    <link rel="icon" type="image/png" href="../../img/logo.png">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link rel="stylesheet" href="../../css/registro.css">
    <style>
        .valid {
            color: green;
        }
        .invalid {
            color: red;
        }
        .hidden {
            display: none;
        }
    </style>
</head>

<body>
    <div class="card">
        <form id="registroForm" action="../../php/php/registro.php" method="POST">
            <br>
            <br>
            <h2>Registro de personas</h2>
            <div>
                <label for="id"><i class="fa-solid fa-user"></i> Documento</label>
                <input type="text" id="id" name="id" placeholder="Ej.1109888654" required />
                <span id="idFeedback" class="hidden"></span>
            </div>
            <div>
                <label for="nombre"><i class="fa-solid fa-user"></i> Nombre y Apellidos</label>
                <input type="text" id="nombre" name="nombre" placeholder=" Ej.Juan Carlos Gutierrez Masmela" required />
                <span id="nombreFeedback" class="hidden"></span>
            </div>
            <div>
                <label for="email"><i class="fa-solid fa-envelope"></i> Correo</label>
                <input type="email" id="email" name="email" placeholder="Ej.abc@mail.com" required />
                <span id="emailFeedback" class="hidden"></span>
            </div>
            <div>
                <label for="password"><i class="fa-solid fa-lock"></i> Contraseña</label>
                <div style="position: relative;">
                    <input type="password" id="password" name="password" placeholder="Ej.User1234" required />
                    <i class="fa-solid fa-eye" id="togglePassword" style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%); cursor: pointer;"></i>
                </div>
                <span id="passwordFeedback" class="hidden"></span>
            </div>
            <div>
                <label for="telefono"><i class="fa-solid fa-phone"></i> Teléfono</label>
                <input type="text" id="telefono" name="telefono" placeholder="Ej.3187765439" required />
                <span id="telefonoFeedback" class="hidden"></span>
            </div>
            <div>
                <label for="tipoPersona"><i class="fa-solid fa-users"></i> Tipo de persona</label>
                <select id="tipoPersona" name="id_rol" required>
                    <option disabled selected>Elegir persona</option>
                    <?php foreach ($roles as $rol) { ?>
                        <option value="<?= $rol['id']; ?>"><?= $rol['rol']; ?></option>
                    <?php } ?>
                </select>
            </div>
            <div>
                <label for="tipoArea"><i class="fa-solid fa-users"></i> Tipo de area</label>
                <select id="tipoArea" name="id_area" required>
                    <option disabled selected>Elegir Area</option>
                    <?php foreach ($area as $areas) { ?>
                        <option value="<?= $areas['id']; ?>"><?= $areas['area']; ?></option>
                    <?php } ?>
                </select>
            </div>
            <div>
                <button type="submit" id="submitBtn"><i class="fa-solid fa-user-plus"></i> Registrar</button>
                <br>
                <br>
                <a class="login" href="../../index.php"> Ya tengo una cuenta.. </a>
            </div>
        </form>
    </div>

    <script src="../../js/registro_validacion.js"></script>
</body>

</html>
