<?php
require_once('config.php');
require_once('carros.php');
require_once('reservas.php');

$carros = new Carros($pdo);
$reservas = new Reservas($pdo);


if( !empty($_POST['carro']) && !empty($_POST['data_inicial']) && !empty($_POST['data_final']) && !empty($_POST['pessoa'])){
    $carro        = addslashes($_POST['carro']);
    $data_inicial = addslashes($_POST['data_inicial']);
    $data_final   = addslashes($_POST['data_final']);
    $pessoa       = addslashes($_POST['pessoa']);

    if( $reservas->verificarDisponibilidade($carro, $data_inicial, $data_final) ){
        $reservas->reservar($carro, $data_inicial, $data_final,$pessoa);
        header("Location: index.php");
        exit;
    } else {
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
              <strong>Atenção: </strong>
              Este veículo já está reservado na data selecionada.
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
             </div>';
    }

} else if ( count($_POST) > 0 ){
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
              <strong>Atenção: </strong>
              É preciso preencher todos os campos!
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
             </div>';
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
            <h3>Adicionar Reserva</h3>
        </div>
        <div class="row">
            <form method="POST">
                <div class="form-group">
                    <label for="carro">Carro</label>
                    <select class="form-control form-control-sm" name="carro" required>
                        <?php
                            foreach ($carros->getCarros() as $row):
                        ?>
                            <option value="<?php  echo $row['id']; ?>"><?php echo $row['nome'] . ' - ' . $row['placa']; ?></option>
                        <?php
                            endforeach;
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="data_inicial">Data Inicial</label>
                    <input type="date" name="data_inicial" class="form-control form-control-sm" />
                </div>
                <div class="form-group">
                    <label for="data_inicial">Data Final</label>
                    <input type="date" name="data_final" class="form-control form-control-sm" />
                </div>
                <div class="form-group">
                    <label for="pessoa">Pessoa</label>
                    <input type="text" name="pessoa" class="form-control form-control-sm"/>
                </div>
                <div class="form-group">
                    <input type="submit" name="submit" class="btn btn-sm btn-primary" value="Reservar"/>
                    <a href="index.php" class="btn btn-sm btn-secondary" value="Voltar">Voltar</a>
                </div>
            </form>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.bundle.min.js"></script>
</body>
</html>