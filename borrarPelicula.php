<?php
include "lib/conexion.php";

// Verificar la conexión
if ($conexion->connect_error) {
    die("Error de conexión a la base de datos. Detalles del error: " . $conexion->connect_error);
}

if (isset($_GET['id'])) {
    $idPelicula = intval($_GET['id']);

    // Eliminar registros relacionados en la tabla cinepelicula
    $sql_delete_cinepelicula = "DELETE FROM cinepelicula WHERE idPelicula = ?";
    $stmt_cinepelicula = $conexion->prepare($sql_delete_cinepelicula);

    if (!$stmt_cinepelicula) {
        die("Error al preparar la declaración cinepelicula. Detalles del error: " . $conexion->error);
    }

    $stmt_cinepelicula->bind_param("i", $idPelicula);
    $resultado_cinepelicula = $stmt_cinepelicula->execute();

    if ($resultado_cinepelicula) {
        // Eliminar la película
        $sql_delete_pelicula = "DELETE FROM pelicula WHERE idPelicula = ?";
        $stmt_pelicula = $conexion->prepare($sql_delete_pelicula);

        if (!$stmt_pelicula) {
            die("Error al preparar la declaración pelicula. Detalles del error: " . $conexion->error);
        }

        $stmt_pelicula->bind_param("i", $idPelicula);
        $resultado_pelicula = $stmt_pelicula->execute();

        if ($resultado_pelicula) {
            // Éxito al eliminar la película y registros relacionados
            echo '<script>
                alert("¡Película eliminada correctamente! 🎉");
                window.location.href = "index.php"; // Redirigir a la página principal después de la alerta y eliminación
            </script>';
            exit();
        } else {
            echo "Error al eliminar la película. Detalles del error: " . $conexion->error;
        }

        $stmt_pelicula->close();
    } else {
        echo "Error al eliminar registros relacionados en la tabla cinepelicula. Detalles del error: " . $conexion->error;
    }

    $stmt_cinepelicula->close();
} else {
    echo "ID de película no proporcionado.";
}

$conexion->close(); 
?>
