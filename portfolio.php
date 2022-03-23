<?php
$title = "PORTAFOLIO";
include "cabecera.php";
include "db_connection.php";

$obj_conexion = new MyDBConnection();

if ($_POST) {
    if (isset($_POST['txt_nombre']) && isset($_POST['txt_comentario']))
        if (isset($_FILES['file_image']))
            if ($_FILES['file_image']['name']){
                $nombre = $_POST['txt_nombre'];
                $timestamp = new DateTime();
                $timestamp = $timestamp->getTimestamp();
                $imagen = $_FILES['file_image']['name'];
                $imagen = pathinfo($imagen, PATHINFO_FILENAME) . "_" . $timestamp . "." . pathinfo($imagen, PATHINFO_EXTENSION);
                $comentario = $_POST['txt_comentario'];
                $sql = "INSERT INTO proyecto (nombre, imagen, descripcion) VALUES ('$nombre', '$imagen', '$comentario');";
                $obj_conexion->ejecuta( $sql );

                move_uploaded_file($_FILES['file_image']['tmp_name'], "images_clients/" . $imagen);
                #REDIRIGIR AL USUARIO A LA MISMA PAGINA, PARA QUE NO SE REINSERTE EL MISMO REGISTRO AUTOMÁTICAMENTE DANDO REFRESH
                header("location:portfolio.php");
            }
}

if ($_GET) {
    if (isset($_GET['borrar']) ){
        #PRIMERO CONSULTAR EL REGISTRO SOLICITADO PARA EXTRAER EL NOMBRE DE LA IMAGEN
        #Y DE ESE MODO BORRARLA DE LA CARPETA DEL SERVIDOR
        $sql = "SELECT imagen FROM proyecto WHERE id=". $_GET['borrar'] .";";
        $imagen = $obj_conexion->consulta($sql);

        #BORRADO DEL ARCHIVO IMAGEN EN LA CARPETA 'images_clients'
        unlink("images_clients/".$imagen[0]['imagen']);
        $sql = "DELETE FROM proyecto WHERE id=". $_GET['borrar'] .";";
        $obj_conexion->ejecuta( $sql );
        #REDIRIGIR AL USUARIO A LA MISMA PAGINA, PARA QUE NO SE INTENTE ELIMINAR EL MISMO REGISTRO AUTOMÁTICAMENTE DANDO REFRESH
        header("location:portfolio.php");
    }
}
?>

<br><br>

<!-- bsgriddefault -->
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    Agregar Proyecto Nuevo:
                </div>
                <div class="card-body">
                    <form action="portfolio.php" enctype="multipart/form-data" method="post">
                        <div>Nombre: <input type="text" required class="form-control" name="txt_nombre" id=""></div>
                        <div>Imagen: <input type="file" required class="form-control" name="file_image" id=""></div>
                        <div>Comentarios:</div><div><textarea required name="txt_comentario" id="" cols="30" rows="10"></textarea></div>
                        <input type="submit" class="btn btn-success" value="Guardar Proyecto">
                    </form>
                </div>
                <div class="card-footer text-muted"></div>
            </div>

        </div>
        <div class="col-md-6">
            <!-- bs5table -->
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre:</th>
                        <th>Imagen:</th>
                        <th>Comentarios:</th>
                        <th>Eliminar:</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $proyectos = $obj_conexion->consulta("SELECT * FROM proyecto;");
                        $numero_registros = count($proyectos);
                        for ($i=0; $i < $numero_registros; $i++) { 
                            echo "<tr>";
                            foreach ($proyectos[$i] as $key => $value){
                                if($key == "imagen")
                                    $value = "<img style='width:100px' src='images_clients/$value'>";
                                echo "<td>$value</td>";
                            }
                            echo '<td><a class="btn btn-danger" href="?borrar=' . $proyectos[$i]['id'] . '" role="button">Eliminar</a></td>';
                            echo "</tr>";
                        }
                    ?>
                </tbody> 
            </table>
        </div>
    </div>
</div>







<?php include "footer.php"; ?>