<?php
include "lib/conexion.php";

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['idPelicula'])) {
    $idPelicula = intval($_POST['idPelicula']);
    $titulo = mysqli_real_escape_string($conexion, $_POST['titulo']);
    $protagonista = mysqli_real_escape_string($conexion, $_POST['protagonista']);
    $idGenero = mysqli_real_escape_string($conexion, $_POST['idGenero']);
    $horario = mysqli_real_escape_string($conexion, $_POST['horario']);

    // Actualizar la película en la base de datos
    $sql = "UPDATE pelicula SET titulo=?, protagonista=?, idGenero=?, horario=? WHERE idPelicula=?";
    $stmt = mysqli_prepare($conexion, $sql);
    mysqli_stmt_bind_param($stmt, "ssssi", $titulo, $protagonista, $idGenero, $horario, $idPelicula);
    
    if (mysqli_stmt_execute($stmt)) {
        // Redirigir a la página principal después de guardar los cambios
        header("Location: index.php");
        exit;
    } else {
        echo "Error al actualizar la película: " . mysqli_error($conexion);
    }

    mysqli_stmt_close($stmt);
} else {
    // Manejo de error si no se reciben datos POST
    echo "No se han recibido datos para actualizar.";
}
?>
