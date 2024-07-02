<?php
include("../../includes/boostratp.php");
include("../../conexion/conexion.php");
include("manu.php");

$sql = "SELECT * FROM tareas";
$stmt = $conexion->prepare($sql);
$stmt->execute();
$tareas = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Lista de Tareas</title>

    <!-- Incluye el CSS de Bootstrap -->
    <link rel="stylesheet" href="../../css/index_admin.css">

    <!-- Incluye jQuery y Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>


    <script>
        $(document).ready(function() {
            $('#task-table').DataTable();
        });
    </script>
</head>

<body>
  

    <main class="container mt-4">
        <section id="task-list">
            <h2>Tareas en Proceso</h2>
            <table id="task-table" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tarea</th>
                        <th>Ruta Documento</th>
                        <th>ID Monitor</th>
                        <th>Horas</th>
                        <th>Fecha Fin</th>
                        <th>ID Estado</th>
                        <th>Calificar</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($tareas as $tarea) { ?>
                        <tr>
                            <td><?php echo $tarea['id']; ?></td>
                            <td><?php echo $tarea['tarea']; ?></td>
                            <td><?php echo $tarea['ruta_doc']; ?></td>
                            <td><?php echo $tarea['id_monitor']; ?></td>
                            <td><?php echo $tarea['horas']; ?></td>
                            <td><?php echo $tarea['Fecha_fin']; ?></td>
                            <td><?php echo $tarea['id_estado']; ?></td>
                            <td>
                                <?php if ($tarea['id_estado'] == 7) { ?>
                                    <a class="btn btn-danger btn-block mb-2" href="#" role="button">Rechazar</a>
                                    <a class="btn btn-primary btn-block" href="#" role="button">Aceptar</a>
                                <?php } else { ?>
                                    <a name="" id="" class="btn btn-success" role="button">Sin novedad</a>
                                <?php } ?>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </section>
    </main>

    <footer class="bg-light text-center py-3 mt-4">
        <p>&copy; 2024 Mi Lista de Tareas</p>
    </footer>
</body>

</html>
