<?php
include "lib/conexion.php";

if (isset($_GET['id'])) {
    $idPelicula = intval($_GET['id']); // Aseguramos que sea un entero

    // Realiza una consulta para obtener los detalles de la película con el ID especificado
    $sql = "SELECT * FROM pelicula WHERE idPelicula = ?";
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

<?php include "lib/header.php"; ?>

<div class="container p-12">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-body">
                <h1>Editar Película</h1>
                <?php if (isset($detallesPelicula)) { ?>
                    <!-- Formulario para editar los detalles de la película -->
                    <form action="guardarEdicion.php" method="post">
                        <input type="hidden" name="idPelicula" value="<?= htmlspecialchars($detallesPelicula['idPelicula']); ?>">
                        <div class="form-group">
                            <label for="titulo">Título:</label>
                            <input type="text" class="form-control" name="titulo" value="<?= htmlspecialchars($detallesPelicula['titulo']); ?>">
                        </div>
                        <div class="form-group">
                            <label for="protagonista">Protagonista:</label>
                            <input type="text" class="form-control" name="protagonista" value="<?= htmlspecialchars($detallesPelicula['protagonista']); ?>">
                        </div>
                        <div class="form-group">
                            <label for="idGenero">Género:</label>
                            <input type="text" class="form-control" name="idGenero" value="<?= htmlspecialchars($detallesPelicula['idGenero']); ?>">
                        </div>

                        <div class="form-group">
                            <label for="horario">Horario:</label>
                            <input type="text" class="form-control" name="horario" value="<?= htmlspecialchars($detallesPelicula['horario']); ?>">
                        </div>
                        
                        <!-- Agrega más campos de edición según sea necesario -->
                        <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                    </form>
                <?php } else { ?>
                    <p>La película no existe o no se encontraron detalles.</p>
                <?php } ?>
            </div>
        </div>
    </div>
</div>

<?php include "lib/footer.php"; ?>
