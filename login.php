<?php
    session_start();
    #SI NO CUENTA CON SESIÓN
    if(! $_SESSION){
        #SI EL USUARIO ENVIÓ INFORMACIÓN DESDE EL FORMULARIO DE LOGUEO:
        if($_POST)
            #VALIDAR USUARIO:
            if($_POST["txt_user"] == "dael" && $_POST["txt_pass"] == "1454" ){
                #GUARDAR DATOS DE LA SESIÓN
                $_SESSION['user'] = $_POST["txt_user"];
                #REDIRIGIR A CIERTA PÁGINA DE NUESTRO SITIO
                header("location:index.php");
            }
            else
                echo "<script>alert('Usuario y/o Contraseña Incorrectos\\nVerifique la Información');</script>";
    }
    else
        header("location:index.php");

    $title = "LOGIN";include "head.php";
?>

<!-- bscontainer -->
<div class="container">
    <!-- bsrow -->
    <div class="row">
        <!-- bsgridcol -->
        <div class="col-md-4"></div>
        <div class="col-md-4">

            <br>
            <!-- bs5head -->
            <div class="card">
                <div class="card-header">
                    Inicio de Sesión:
                </div>
                <div class="card-body">

                    <form action="login.php" method="post">
                        <div>Usuario: <input type="text" class="form-control" name="txt_user" id=""></div>
                        <div>Password: <input type="password" class="form-control" name="txt_pass" id=""></div>
                        <input type="submit" class="btn btn-success" value="Entrar">
                    </form>

                </div>
                <div class="card-footer text-muted"></div>
            </div>
        </div>
        <div class="col-md-4"></div>
    </div>
</div>