<?php
    session_start();
    function validar(){
        if(isset($_SESSION['primerasesion'])){
            $mensaje = $_SESSION['primerasesion'];
            return $mensaje;
        }else{
            $mensaje = "<h5>Aún nadie inicio sesión</h5>";
            return $mensaje;
        }
    }
?>