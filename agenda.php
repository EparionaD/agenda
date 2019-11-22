<?php
    date_default_timezone_set("America/Lima");
    /*setlocale(LC_TIME,"es_PE");*/
    include "conectar.php";
    $con = conectar();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Agenda</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
    <div class="container-fluid" style="background-color:#f0f3f2;">
        <div class="row">
            <div class="col-8 col-md-6 d-flex align-items-center py-3">
                <?php include "validar_sesion.php";?>
                <h5 class="lead text-muted">Bienvenido:</h5>
                <p class="h3 pl-2"><?php echo validar();?></p>
            </div>
            <div class="col-4 col-md-6 py-3">
                <form action="cerrar.php" method="POST">
                    <div class="form-group d-flex justify-content-end">
                        <button class="btn btn-outline-danger" type="submit">Cerrar sesión</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="container-fluid pt-4">
        <div class="row">
            <div class="col-auto">
                <?php
                    $x = "SELECT * FROM evento";
                    $rx = mysqli_query($con,$x);
                    $fecha_c = date("Y-m-d",mktime(0, 0, 0, date("m") , date("d"), date("Y")));
                    $hora_c = date("G",mktime(date("G"), 0, 0, date("m") , date("d"), date("Y")));
                    foreach($rx as $valor1){
                        if($valor1['fecha'] != NULL and $valor1['fecha'] == $fecha_c){
                            if($valor1['hora'] >= $hora_c){
                                $agregar_c = 'd-block';
                                ?>
                                <div class="alert alert-secondary alert-dismissible fade show <?php echo $agregar_c;?>" role="alert" style="display:none;">
                                    <p class="m-0 text-muted">Recuerda: <span class="text-danger font-weight-bold"><?php echo $valor1['titulo'];?></span> a las <span><?php echo $valor1['hora'];?></span> </p>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <?php
                            }
                        }
                    }
                ?>
            </div>
        </div>
        <div class="row my-4">
            <div class="col-8 text-center">
                <p class="my-0 h2 font-weight-bold">Agenda para esta semana</p>
            </div>
            <div class="col-4 my-0 d-flex justify-content-center">
                <button class="btn btn-primary" type="submit" data-toggle="modal" data-target="#agregarevento">Agregar evento</button>

                <!-- Modal para agregar eventos  -->
                <div class="modal fade" id="agregarevento" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Agregar eventos</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-12">
                                            <form action="guardar.php" method="POST">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" name ="etitulo" placeholder="Ingresa un titulo">
                                                </div>
                                                <div class="form-group">
                                                    <textarea class="form-control" rows="3" name ="edescrip" placeholder="Ingresa una descripción"></textarea>
                                                </div>
                                                <div class="form-group">
                                                    <input type="date" class="form-control" name ="efecha">
                                                </div>
                                                <div class="form-group">
                                                    <input type="time" class="form-control" name ="ehora">
                                                </div>
                                                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                                                <button type="submit" class="btn btn-primary">Guardar</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="table-responsive-lg">
                    <table class="table">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">Hora</th>
                                <?php
                                    for($i=0;$i<7;$i++){
                                        $b = date("d-l",mktime(0, 0, 0, date("m") , date("d")+$i, date("Y")));
                                        ?>
                                        <th scope="col"><?php echo $b; ?></th>
                                        <?php
                                    }
                                ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                for($j=7;$j<24;$j++){
                                    ?>
                                    <tr>
                                        <th scope="row"><?php echo $j;?></th>
                                        <?php
                                            $consulta = "SELECT * FROM evento";
                                            $rconsulta = mysqli_query($con, $consulta);
                                            for($k=0;$k<7;$k++){
                                                $c = date("Y-m-d",mktime(0, 0, 0, date("m") , date("d")+$k, date("Y")));
                                                ?>
                                                <td>
                                                    <?php
                                                        foreach($rconsulta as $valor){
                                                            if($valor['fecha'] == $c && $valor['hora'] == $j){
                                                                echo '<p class="my-0 text-muted"><small>'.$valor['titulo']."</small></p>";
                                                                echo '<p class="my-0 text-wrap">'.$valor['descripcion']."</p>";
                                                            }
                                                        }
                                                    ?>
                                                </td>
                                                <?php
                                            }
                                        ?>
                                    </tr>
                                    <?php
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>