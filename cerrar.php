<?php
    session_start();

    unset($_SESSION['primerasesion']);
    echo "Se cerro sesión";
    
    /*session_destroy();
    echo "Se cerraron todas las sesiones";*/

    header("refresh:1;url=index.php");
?>