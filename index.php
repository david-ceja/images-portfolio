<?php 
$title="INDEX"; 
include "cabecera.php"; 
include "db_connection.php";
?>

<!-- bs5-jumbotron-default -->
<div class="p-5 bg-light">
    <div class="container">
        <h1 class="display-3">Bienvenid@s</h1>
        <p class="lead">Éste es un Portafolio Privado</p>
        <hr class="my-2">
        <p>Más Información</p>
        <p class="lead">
            <a class="btn btn-primary btn-lg" href="#" role="button">Jumbo action name</a>
        </p>
    </div>
</div>

<div class="row row-cols-1 row-cols-md-3 g-4">

<?php
    $obj_conexion = new MyDBConnection();
    $proyectos = $obj_conexion->consulta("SELECT * FROM proyecto;");
    $numero_registros = count($proyectos);
    foreach ($proyectos as $registro) { 
?>
<div class="col">
    <div class="card">
        <img src="images_clients/<?php echo $registro['imagen'];?>" class="card-img-top" alt="...">
        <div class="card-body">
            <h5 class="card-title"><?php echo $registro['nombre'];?></h5>
            <p class="card-text"><?php echo $registro['descripcion'];?></p>
        </div>
    </div>
</div>

<?php 
    }
    include "footer.php";
?>