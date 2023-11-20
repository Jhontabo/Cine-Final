<?php
$titulo = "";
if (isset($_POST['buscar'])) {
    $titulo = $_POST['titulo'];
}

if (isset($_POST['agregar'])) {
    $titulo = $_POST['titulo'];
    $protagonista = $_POST['protagonista'];
    $horario = $_POST['horario'];
    $genero = $_POST['genero'];
    $clasificacion = $_POST['clasificacion'];
    $imagen_url = $_POST['imagen_url'];

    // Realiza la inserción en la base de datos
    $sql = "INSERT INTO pelicula (titulo, protagonista, horario, idGenero, idClasificacion, imagen_url) 
            VALUES ('$titulo', '$protagonista', '$horario', $genero, $clasificacion, '$imagen_url')";
            
    $result = mysqli_query($conexion, $sql);

    if ($result) {
        // Película agregada correctamente

       
      
      } else {
        // Error al agregar la película
        echo "Error al agregar la película: " . mysqli_error($conexion);
    }
}
?>
<?php include "lib/header.php"; ?>
<?php include "lib/conexion.php"; ?>

<div class="container peliculas-container">
    <!-- Encabezado -->
    <div class="row">
        <div class="col-md-12 text-center">
            <h1 class="tituloPeliculas">Gestion salas de cine</h1>
        </div>
    </div>

    <nav class="navbar navbar-expand-lg bg-body-tertiary">
      <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          </ul>
          <form class="d-flex" action="index.php" method="post" role="search">
            <input type="text" name="titulo" id="titulo" onkeypress="buscarPeliculas()" class="form-control input-busqueda" placeholder="Buscar película ...">
            <button type="submit" name="buscar" class="btn btn-primary btn-buscar"><i class="fas fa-search"></i> Buscar
            </button>
          </form>
        </div>
      </div>
    </nav>


    <div class="btnNuevaP">
    <h6><a href="" class="btn btn-agregar" data-bs-toggle="modal" 
    data-bs-target="#exampleModal">Nueva película</a></h6>
    </div>
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-body tabla-peliculas mx-auto">
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
                            $sql = "SELECT pelicula.*, genero.genero 
                                    FROM pelicula 
                                    JOIN genero ON pelicula.idGenero = genero.idGenero 
                                    WHERE pelicula.titulo LIKE '%$titulo%'";
                            $consulta = mysqli_query($conexion, $sql);
                            while ($row = mysqli_fetch_array($consulta)) {
                            ?>
                                <tr class="infoPelicula">
                                    <th scope="row"><?= $row['idPelicula']; ?></th>
                                    <td><?= $row['titulo']; ?></td>
                                    <td><?= $row['protagonista']; ?></td>
                                    <td><?= $row['genero']; ?></td>
                                    <td class="accionesTabla">
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
<!-- Modal-->

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title w-100" id="exampleModalLabel">Nueva película</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="agregarPelicula.php" method="post">
          <div class="mb-3">
            <label for="titulo" class="form-label">Título</label>
            <input class="form-control" type="text" name="titulo" required>
          </div>
          <div class="mb-3">
            <label for="protagonista" class="form-label">Protagonista</label>
            <input class="form-control" type="text" name="protagonista" required>
          </div>
          <div class="mb-3">
            <label for="horario" class="form-label">Horario</label>
            <input class="form-control" type="text" name="horario" required>
          </div>
          <div class="mb-3">
            <label for="genero" class="form-label">Género</label>
            <select name="genero" class="form-control" required>
              <!-- opciones del genero -->
              <option value="1">Acción</option>
              <option value="2">Terror</option>
              <option value="3">Ciencia Ficción</option>
              <option value="4">Drama</option>
              <option value="5">Romance</option>
              <option value="6">Comedia</option>
              <option value="7">Infantil</option>

            </select>
          </div>
          <div class="mb-3">
            <label for="clasificacion" class="form-label">Clasificación</label>
            <select name="clasificacion" class="form-control" required>
              <!-- opciones de clasificación -->
              <option value="1">Para todo público</option>
              <option value="2">Mayores de 13 años</option>
              <option value="3">Mayores de 18 años</option>
              <option value="4">Menores de 13 años</option>
            </select>
          </div>
          <div class="mb-3">
            <label for="imagen_url" class="form-label">URL de la Imagen</label>
            <input class="form-control" type="text" name="imagen_url" required>
          </div>
          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            <button class="btn btn-primary" name="agregar" type="submit">Agregar Película</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<?php include "lib/footer.php"; ?>
