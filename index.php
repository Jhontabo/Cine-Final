<?php
$titulo = "";
if (isset($_POST['buscar'])) {
    $titulo = $_POST['titulo'];
}
?>

<?php include "lib/header.php"; ?>
<?php include "lib/conexion.php"; ?>

<div class="container p-12">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-body">
                <h6><a href="" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Agregar Nueva Película</a></h6>
                <form action="index.php" method="post">
                    <input type="text" name="titulo" id="titulo" onkeypress="buscarPeliculas()">
                    <input type="submit" value="Buscar" name="buscar">
                </form>
            </div>
        </div>
        <div class="col-md-12">
            <div class="card card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">Id</th>
                            <th scope="col">Título</th>
                            <th scope="col">Protagonista</th>
                            <th scope="col">Género</th>
                            <th scope="col">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "SELECT * FROM pelicula WHERE titulo LIKE '%$titulo%'";
                        $consulta = mysqli_query($conexion, $sql);
                        while ($row = mysqli_fetch_array($consulta)) { ?>
                            <tr>
                                <th scope="row"><?= $row['idPelicula']; ?></th>
                                <td><?= $row['titulo']; ?></td>
                                <td><?= $row['protagonista']; ?></td>
                                <td><?= $row['idGenero']; ?></td>
                                <td>
                                    <a href="verPelicula.php?id=<?= $row['idPelicula']; ?>" class="btn btn-info">Ver</a>
                                    <a href="editarPelicula.php?id=<?= $row['idPelicula']; ?>" class="btn btn-primary">Editar</a>
                                    <a href="borrarPelicula.php?id=<?= $row['idPelicula']; ?>" class="btn btn-danger">Borrar</a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Nueva pelicula</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="agregarPelicula.php" method="post">
            <div>
                <label for="titulo">Titulo</label>
                <input class="form-control" type="text" name="titulo">
            </div>
            <div>
                <label for="protagonista">Protagonista</label>
                <input class="form-control" type="text" name="protagonista">
            </div>
            <div>
                <label for="horario">Horario</label>
                <input class="form-control" type="text" name="horario">
            </div>
            <div>
                <label for="genero">Genero</label>
                <select name="genero" class="form-control" >
                    <option value="1">Accion</option>
                    <option value="2">Terror</option>
                    <option value="3">Csi_Fi</option>
                    <option value="4">Drama</option>
                    <option value="5">Romance</option>
                    <option value="6">Comedia</option>
                    <option value="7">Infantil</option>
                </select>
            </div>
            <div>
                <label for="clasificacion">Clasificacion</label>
                <select name="clasificacion" class="form-control" >
                    <option value="1">Para todo publico</option>
                    <option value="2">Mayores de 13 años</option>
                    <option value="3">Mayores de 18 años</option>
                    <option value="4">Menores de 13 años</option>
                </select>           
            </div>
            <input class="form-control" type="submit" value="agregar Pelicula" name="agregar">
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<?php include "lib/footer.php"; ?>
