<?php
include "lib/conexion.php";

// Verificación de la conexión a la base de datos
if (!$conexion) {
    die("Error en la conexión: " . mysqli_connect_error());
}
include "lib/footer.php";

// Condición para validar la existencia de la variable 'agregar'
if (isset($_POST['agregar'])) {
    // Capturar las variables
    $titulo = $_POST['titulo'];
    $protagonista = $_POST['protagonista'];
    $horario = $_POST['horario'];
    $genero = $_POST['genero'];
    $clasificacion = $_POST['clasificacion'];
    $imagen_url = $_POST['imagen_url']; // Nueva variable para la URL de la imagen

    // Insertar datos en la tabla pelicula
    $sql = "INSERT INTO pelicula (titulo, protagonista, horario, idGenero, idClasificacion, imagen_url)
            VALUES ('$titulo', '$protagonista', '$horario', $genero, $clasificacion, '$imagen_url')";
    
    // Ejecutar la consulta y verificar errores
    $consulta = mysqli_query($conexion, $sql);

    if (!$consulta) {
        die("Error al ejecutar la consulta: " . mysqli_error($conexion));
    }

    // Mostrar mensaje en la consola del navegador
    echo "<script>
            mostrarNotificacion('Película eliminada correctamente', 'exito');
            setTimeout(() => {
                location.href = 'index.php'; // Redirigir a la página principal después de la alerta
            }, 3000); // Redirigir después de 3 segundos
          </script>";

    // Redirigir a la página principal después de agregar la película
    header('Location: index.php');
}
?>
