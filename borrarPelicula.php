<?php
include "lib/conexion.php";

if (isset($_GET['id'])) {
    $idPelicula = intval($_GET['id']);

    // ... Tu código PHP existente para eliminar registros relacionados en la tabla cinepelicula
    $sql_delete_cinepelicula = "DELETE FROM cinepelicula WHERE idPelicula = ?";
    $stmt_cinepelicula = mysqli_prepare($conexion, $sql_delete_cinepelicula);
    mysqli_stmt_bind_param($stmt_cinepelicula, "i", $idPelicula);
    $resultado_cinepelicula = mysqli_stmt_execute($stmt_cinepelicula);

    if ($resultado_cinepelicula) {
        // ... Tu código PHP existente para eliminar la película
        $sql_delete_pelicula = "DELETE FROM pelicula WHERE idPelicula = ?";
        $stmt_pelicula = mysqli_prepare($conexion, $sql_delete_pelicula);
        mysqli_stmt_bind_param($stmt_pelicula, "i", $idPelicula);
        $resultado_pelicula = mysqli_stmt_execute($stmt_pelicula);

        if ($resultado_pelicula) {
            // Éxito al eliminar la película y registros relacionados

            echo '<script>
                alert("¡Película eliminada correctamente! 🎉");
                window.location.href = "index.php"; // Redirigir a la página principal después de la alerta y eliminación
            </script>';
            exit(); // Asegúrate de salir para evitar que se ejecute el resto del código PHP

        } else {
            echo "Error al eliminar la película. Detalles del error: " . mysqli_error($conexion);
        }

        mysqli_stmt_close($stmt_pelicula);
    } else {
        echo "Error al eliminar registros relacionados en la tabla cinepelicula. Detalles del error: " . mysqli_error($conexion);
    }

    mysqli_stmt_close($stmt_cinepelicula);
} else {
    echo "ID de película no proporcionado.";
}
?>
