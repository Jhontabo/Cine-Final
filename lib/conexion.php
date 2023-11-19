<?php
// Variables de conexión
$servername = "localhost";
$username = "root";
$password = "12345";
$database = "cine";

// Crear la cadena de conexión
$conexion = new mysqli($servername, $username, $password, $database);

// Verificar la conexión
if ($conexion->connect_error) {
    die("Fallo en la conexión: " . $conexion->connect_error);
}

// Establecer el juego de caracteres
$conexion->set_charset("utf8");

// Otras configuraciones si es necesario

?>
