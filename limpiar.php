<?php
    date_default_timezone_set("America/Lima");
    include("conectar.php");
    $con = conectar();

    function limpiar_datos($con){

        $consulta = "SELECT * FROM evento";
        $rconsulta = mysqli_query($con,$consulta);

        $fecha_a = date("Y-m-d",mktime(0, 0, 0, date("m") , date("d")-1, date("Y")));

        foreach($rconsulta as $valor){
            if($valor['fecha'] <= $fecha_a){
                return $limpiado = mysqli_query($con, "DELETE FROM evento WHERE fecha < '$fecha_a'") or die(mysql_error());
            }
        }

    }

?>