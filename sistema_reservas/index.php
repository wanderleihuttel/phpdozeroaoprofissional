<?php
require_once('config.php');
require_once('carros.php');
require_once('reservas.php');
require_once('cal.php');

$calendario = new Calendario( date("Y-m") );
if( !empty($_POST['ano']) && !empty($_POST['mes'])){
    $ano = $_POST['ano'];
    $mes = $_POST['mes'];
    $calendario->setDate($ano."-".$mes);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
     <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <title>Sistema de Reservas</title>
</head>
<body>
    <div class="container">
        <div class="row">
            <h1>Reservas</h1>
        </div>
        <div class="row">
            <p><a href="reservar.php" class="btn btn-sm btn-secondary">Adicionar Reservas</a></p>
        </div>

        <div class="row">
            <form method="POST">
                <div class="form-group form-group-sm form-inline">
                <select class="custom-select" name="ano">
                <?php
                    if( !empty($_POST['ano']) && !empty($_POST['mes'])){
                        $ano = $_POST['ano'];
                        $mes = $_POST['mes'];
                    } else {
                        $ano = "";
                        $mes = "";
                    }
                      for($i=date('Y'); $i>date('Y')-10; $i--){
                          if($ano==$i){
                              echo "<option selected>{$i}</option>";
                          } else {
                              echo "<option>{$i}</option>";
                          }
                      }
                ?>
                </select>
                <select class="custom-select" name="mes">
                <?php
                      for($i=1; $i <= 12; $i++){
                          if($mes==$i){
                              echo "<option selected>" . str_pad($i,2,"0",STR_PAD_LEFT) . "</option>";
                          } else {
                              echo "<option>" . str_pad($i,2,"0",STR_PAD_LEFT) . "</option>";
                          }
                      }
                ?>
                </select>
                <input type="submit" value="Filtrar" class="btn btn-secondary btn-sm">
                </div>
            </form>
        </div>

        <div class="row">
                    <?php
                    if( empty($_POST['ano']) && empty($_POST['mes'])){
                        exit;
                    }
                    $reservas = new Reservas($pdo);
                    $lista = $reservas->getReservas( $calendario->getStartDate() , $calendario->getEndDate() );

                    ?>
        </div>
    </div><!-- container !-->
    <div class="container">
        <div class="row">
            <?php
                //require_once('calendario.php');
                echo $calendario->showCalendar($lista);
            ?>
        </div>
    </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.bundle.min.js"></script>
</body>
</html>