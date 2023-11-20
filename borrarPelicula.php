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

            echo "<script>
                function mostrarNotificacion(mensaje, tipo) {
                    const notificacion = document.createElement('div');
                    notificacion.classList.add('notificacion', tipo);
                    notificacion.textContent = mensaje;

                    // Establecer estilos CSS para la notificación
                    notificacion.style.position = 'fixed';
                    notificacion.style.bottom = '10px'; // Ajusta según tu preferencia
                    notificacion.style.right = '10px'; // Ajusta según tu preferencia

                    document.body.appendChild(notificacion);

                    setTimeout(() => {
                        notificacion.remove();
                        location.href = 'index.php'; // Redirigir a la página principal después de la alerta y eliminación
                    }, 0); // Redirigir de inmediato
                }

                // Llama a la función de notificación al cargar la página
                window.onload = function() {
                    mostrarNotificacion('Película eliminada correctamente', 'exito');
                }
                </script>";

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
