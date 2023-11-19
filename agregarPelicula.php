<?php
include "lib/conexion.php";

//condicion para validar la existencia de la variable agregar
if(isset($_POST['agregar']))
{
    //capturar las variables
    $titulo=$_POST['titulo'];
    $protagonista=$_POST['protagonista'];
    $horario=$_POST['horario'];
    $genero=$_POST['genero'];
    $clasificacion=$_POST['clasificacion'];

    $sql="insert into pelicula(titulo,protagonista,horario,idGenero,idClasificacion)
    values('$titulo','$protagonista','$horario',$genero,$clasificacion)";

    $consulta = mysqli_query($conexion, $sql);

    header('Location: index.php');
}
?>