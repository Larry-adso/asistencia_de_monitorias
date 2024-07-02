<?php
include("../../includes/validacion.php");
include("../../conexion/conexion.php");
include("manu.php");


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $tarea = $_POST["tarea"];
    $horas = $_POST["horas"];
    $fecha_fin = $_POST["fecha_fin"];

    $sql = "INSERT INTO tareas (tarea, horas, Fecha_fin, id_estado) VALUES (:tarea, :horas, :fecha_fin, 3)";
    $stmt = $conexion->prepare($sql);

    $stmt->bindParam(':tarea', $tarea);
    $stmt->bindParam(':horas', $horas);
    $stmt->bindParam(':fecha_fin', $fecha_fin);

    if ($stmt->execute()) {
        echo "Nueva tarea creada exitosamente.";
    } else {
        echo "Error al crear la tarea.";
    }
}
?>

<!doctype html>
<html lang="en">

<head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
</head>

<body>
    <header>
        <!-- place navbar here -->
    </header>
    <main>
        <section id="new-task" class="mt-4">
            <h2>Agregar Nueva Tarea</h2>
            <form id="task-form" action="create.php" method="post" class="form">
                <div class="form-group">
                    <label for="tarea">Descripción de la tarea</label>
                    <textarea id="tarea" name="tarea" class="form-control" required rows="5"></textarea>
                </div>
                <div class="form-group">
                    <label for="cantidad">Cantidad de monitores</label>
                    <select id="cantidad" name="cantidad" class="form-control form-control-select" required>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <!-- Agrega más opciones según sea necesario -->
                    </select>
                </div>
                <div class="form-group">
                    <label for="horas">Horas a firmar por la tarea</label>
                    <select id="horas" name="horas" class="form-control form-control-select" required>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <!-- Agrega más opciones según sea necesario -->
                    </select>
                </div>
                <div class="form-group">
                    <label for="fecha_fin">Fecha Límite</label>
                    <input type="datetime-local" id="fecha_fin" name="fecha_fin" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-success btn-block">Agregar</button>
            </form>
        </section>

    </main>
    <footer>
        <!-- place footer here -->
    </footer>
    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
</body>

</html>