<?php
    include("conectar.php");
    $con = conectar();

    session_start();

    if($_POST){
        $a = $_POST['fusuario'];
        $b = $_POST['pass'];

        $consulta = "SELECT * FROM usuario";
        $rconsulta = mysqli_query($con, $consulta);

        foreach($rconsulta as $valores){
            if($a == $valores['nombre_u'] && $b == $valores['contrasenia']){
                $_SESSION['primerasesion'] = $valores['nombre_u'];
                $_SESSION['idactivo'] = $valores['id_usuario'];
                header("location:agenda.php");
                echo "Usuario Valido";
            }else{
                echo "Usuario o contraseña incorrecta";
            }
        }
    }
?>