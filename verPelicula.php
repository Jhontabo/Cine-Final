<?php
include "lib/conexion.php"; // Asegúrate de incluir el archivo de conexión a la base de datos

if (isset($_GET['id'])) {
    $idPelicula = $_GET['id'];
    
    // Realiza una consulta para obtener los detalles de la película con el ID especificado
    $sql = "SELECT * FROM pelicula WHERE idPelicula = $idPelicula";
    $consulta = mysqli_query($conexion, $sql);

    if ($fila = mysqli_fetch_assoc($consulta)) {
        $detallesPelicula = $fila;
    } else {
        // Si no se encontró la película, puedes redirigir o mostrar un mensaje de error
        header("Location: index.php"); // Redirige a la página principal o muestra un mensaje de error
        exit;
    }
}
?>

<?php include "lib/header.php"; ?>

<div class="container p-12">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-body">
                <h1>Detalles de la Película</h1>
                <?php if (isset($detallesPelicula)) { ?>
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

<?php include "lib/footer.php"; ?>
