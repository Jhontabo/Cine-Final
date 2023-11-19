<?php
    //variables de conexion
    $servername = "localhost";
    $username = "root";
    $password = "12345";
    $database = "cine";
    
    //crea la cadena de conexion
    $conexion = new mysqli($servername, $username, $password, $database)
    or die("Fallo en la conexion".$conexion->connect_error);
    
?>