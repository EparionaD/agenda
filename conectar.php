<?php
    function conectar(){
        $user = "root";
        $pass = "";
        $server = "localhost";
        $db = "agenda";
        $con = mysqli_connect($server,$user,$pass,$db) or die ("Error al conectar con la base de datos");

        return $con;
    }
?>