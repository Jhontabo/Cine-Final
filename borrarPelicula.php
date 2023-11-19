<?php
include "lib/conexion.php";

if (isset($_GET['id'])) {
    $idPelicula = intval($_GET['id']);

    // Eliminar registros relacionados en la tabla cinepelicula
    $sql_delete_cinepelicula = "DELETE FROM cinepelicula WHERE idPelicula = ?";
    $stmt_cinepelicula = mysqli_prepare($conexion, $sql_delete_cinepelicula);
    mysqli_stmt_bind_param($stmt_cinepelicula, "i", $idPelicula);
    $resultado_cinepelicula = mysqli_stmt_execute($stmt_cinepelicula);

    // Luego, puedes eliminar la película
    if ($resultado_cinepelicula) {
        $sql_delete_pelicula = "DELETE FROM pelicula WHERE idPelicula = ?";
        $stmt_pelicula = mysqli_prepare($conexion, $sql_delete_pelicula);
        mysqli_stmt_bind_param($stmt_pelicula, "i", $idPelicula);
        $resultado_pelicula = mysqli_stmt_execute($stmt_pelicula);

        if ($resultado_pelicula) {
            // Éxito al eliminar la película y registros relacionados
            header("Location: index.php");
            exit;
        } else {
            echo "Error al eliminar la película. Detalles del error: " . mysqli_error($conexion);
        }

        mysqli_stmt_close($stmt_pelicula);
    } else {
        echo "Error al eliminar registros relacionados en la tabla cinepelicula. Detalles del error: " . mysqli_error($conexion);
    }

    mysqli_stmt_close($stmt_cinepelicula);
}
?>



<div class="container p-12">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-body">
                <!-- Contenido de la página de borrado, si es necesario -->
            </div>
        </div>
    </div>
</div>

