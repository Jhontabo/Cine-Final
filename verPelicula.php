<?php
include "lib/conexion.php";

$detallesPelicula = null;

if (isset($_GET['id'])) {
    $idPelicula = $_GET['id'];

    $sql = "SELECT * FROM pelicula WHERE idPelicula = $idPelicula";
    $consulta = mysqli_query($conexion, $sql);

    $detallesPelicula = mysqli_fetch_assoc($consulta);

    if (!$detallesPelicula) {
        header("Location: index.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles de la Película</title>

    <style>
           body {
            background-color: #f2f2f2;
            font-family: 'Roboto', sans-serif;
        }

        .container {
            margin-top: 10%;
        }

        .card {
            background-color: #ffcccc;
            border: 1px solid #345565;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            max-width: 400px;
            margin: auto;
            margin-top: 20px;
            text-align: center;
        }

        h1 {
            color: #007bff;
            font-size: 28px;
            margin-bottom: 20px;
        }

        p {
            font-size: 18px;
            margin-bottom: 10px;
        }

        .back-button {
            display: block;
            margin-top: 20px;
            padding: 10px 20px;
            font-size: 16px;
            background-color: #007bff;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <h1>Detalles de la Película</h1>
                    <?php if ($detallesPelicula) { ?>
                        <p><strong>Título:</strong> <?= $detallesPelicula['titulo']; ?></p>
                        <p><strong>Protagonista:</strong> <?= $detallesPelicula['protagonista']; ?></p>
                        <p><strong>Género:</strong> <?= $detallesPelicula['idGenero']; ?></p>
                        <p><strong>Horario:</strong> <?= $detallesPelicula['horario']; ?></p>
                    <?php } else { ?>
                        <p>La película no existe o no se encontraron detalles.</p>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
