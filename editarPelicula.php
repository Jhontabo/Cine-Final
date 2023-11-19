<?php
include "lib/conexion.php";

$detallesPelicula = null;

if (isset($_GET['id'])) {
    $idPelicula = intval($_GET['id']); // Aseguramos que sea un entero

    // Realiza una consulta para obtener los detalles de la película con el ID especificado
    $sql = "SELECT pelicula.*, genero.genero, clasificacion.clasificacion
            FROM pelicula
            JOIN genero ON pelicula.idGenero = genero.idGenero
            JOIN clasificacion ON pelicula.idClasificacion = clasificacion.idClasificacion
            WHERE pelicula.idPelicula = ?";
    $stmt = mysqli_prepare($conexion, $sql);
    mysqli_stmt_bind_param($stmt, "i", $idPelicula);
    mysqli_stmt_execute($stmt);

    $resultado = mysqli_stmt_get_result($stmt);

    if ($fila = mysqli_fetch_assoc($resultado)) {
        $detallesPelicula = $fila;
    } else {
        // Si no se encontró la película, envía un encabezado HTTP 404 y muestra un mensaje de error
        header("HTTP/1.0 404 Not Found");
        include "lib/header.php";
        echo "<div class='container p-12'><p>La película no existe o no se encontraron detalles.</p></div>";
        include "lib/footer.php";
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Película</title>

    <style>
        body {
            background-color: #f2f2f2;
        }

        .container {
            margin-top: 5%;
            display: flex;
            justify-content: center;
        }

        .card {
            border: 1px solid #345565;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            width: 400px;
            height: 500px;
            background-color: #9ECEEC;
        }

        h1 {
            color: #007bff;
            text-align: center;
        }

        .form-label {
            font-weight: bold;
        }

        .form-control {
            width: 100%;
            padding: 8px;
            margin-top: 6px;
            margin-bottom: 16px;
            display: inline-block;
            border: 1px solid #ccc;
            box-sizing: border-box;
            border-radius: 4px;
        }

        .d-grid {
            text-align: center;
        }

        .btn-primary {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <h1 class="card-title text-center mb-4">Editar Película</h1>
                        <?php if (isset($detallesPelicula)) { ?>
                            <!-- Formulario para editar los detalles de la película -->
                            <form action="guardarEdicion.php" method="post">
                                <input type="hidden" name="idPelicula" value="<?= htmlspecialchars($detallesPelicula['idPelicula']); ?>">
                                <div class="mb-3">
                                    <label for="titulo" class="form-label">Título:</label>
                                    <input type="text" class="form-control" name="titulo" value="<?= htmlspecialchars($detallesPelicula['titulo']); ?>">
                                </div>
                                <div class="mb-3">
                                    <label for="protagonista" class="form-label">Protagonista:</label>
                                    <input type="text" class="form-control" name="protagonista" value="<?= htmlspecialchars($detallesPelicula['protagonista']); ?>">
                                </div>
                                <div class="mb-3">
                                    <label for="idGenero" class="form-label">Género:</label>
                                    <select class="form-control" name="idGenero">
                                        <?php
                                        $sqlGenero = "SELECT * FROM genero";
                                        $resultGenero = mysqli_query($conexion, $sqlGenero);

                                        while ($rowGenero = mysqli_fetch_assoc($resultGenero)) {
                                            $selected = ($rowGenero['idGenero'] == $detallesPelicula['idGenero']) ? "selected" : "";
                                            echo "<option value='{$rowGenero['idGenero']}' $selected>{$rowGenero['genero']}</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="idClasificacion" class="form-label">Clasificación:</label>
                                    <select class="form-control" name="idClasificacion">
                                        <?php
                                        $sqlClasificacion = "SELECT * FROM clasificacion";
                                        $resultClasificacion = mysqli_query($conexion, $sqlClasificacion);

                                        while ($rowClasificacion = mysqli_fetch_assoc($resultClasificacion)) {
                                            $selected = ($rowClasificacion['idClasificacion'] == $detallesPelicula['idClasificacion']) ? "selected" : "";
                                            echo "<option value='{$rowClasificacion['idClasificacion']}' $selected>{$rowClasificacion['clasificacion']}</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="horario" class="form-label">Horario:</label>
                                    <input type="text" class="form-control" name="horario" value="<?= htmlspecialchars($detallesPelicula['horario']); ?>">
                                </div>
                                <!-- Agrega más campos de edición según sea necesario -->
                                <div class="d-grid">
                                    <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                                </div>
                            </form>

                        <?php } else { ?>
                            <p class="card-text text-center">La película no existe o no se encontraron detalles.</p>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
