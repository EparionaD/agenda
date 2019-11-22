<?php
    include("conectar.php");
    $con = conectar();

    $consulta = "SELECT * FROM evento";
    $rconsulta = mysqli_query($con,$consulta);

    $fecha_a = date("Y-m-d",mktime(0, 0, 0, date("m") , date("d")-1, date("Y")));

    foreach($rconsulta as $valor){
        if($valor['fecha'] <= $fecha_a){
            echo $valor['fecha'];
        }
    }
?>