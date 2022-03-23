<?php 
    include "head.php";
    session_start();
    if(!$_SESSION)
        header("location:login.php");
?>
<body>
    <!-- bs5-grid-container -->
    <div class="container">
        <a href="index.php">Inicio</a> | <a href="portfolio.php">Administrar Portafolio</a> | <a href=<?php echo $_SESSION?'"logout.php">logout':'"login.php">login'?></a> | <a href="yyy.php">YYY</a>

    <!-- QUITAMOS EL CIERRE DEL DIV Y LO PONEMOS AL INICIO DEL FOOTER -->
    <!-- DE MODO QUE TODO LO QUE VAYA EN EL CUERPO DE LA PÁGINA, ESTÉ ENCERRADO EN ESTE CONTENEDOR -->
