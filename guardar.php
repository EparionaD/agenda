<?php
    include("conectar.php");
    $con = conectar();

    session_start();

    if($_POST){
        $a = $_POST['etitulo'];
        $b = $_POST['edescrip'];
        $c = $_POST['efecha'];
        $d = $_POST['ehora'];

        $fecha_actual = date("Y-m-d",mktime(0, 0, 0, date("m") , date("d"), date("Y")));

        
        $id = $_SESSION['idactivo'];

        mysqli_query($con,"insert into evento(titulo,descripcion,fecha,hora,f_creacion,id_usuario)values('$a','$b','$c','$d','$fecha_actual','$id')") or die(mysql_error());

        header("location:agenda.php");
    }
?>
<?php
    /*header("location:agenda.php");*/
?>