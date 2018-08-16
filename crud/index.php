<?php
require_once("contato.php");
$contato = new Contato();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-with,initial-scale=1, shrink-to-fit=no" />
    <title>CRUD - Módulo 12 - PHP Avançado</title>
    <link rel="stylesheet" href="css/bootstrap.min.css" >
</head>
<body>
    <div class="container">
        <div class="row">
            <h3>Relação de Usuários - Listagem</h3>
        </div>
        <div class="row">
            <a href="adicionar.php" class="btn btn-sm btn-primary mb-1">Adicionar</a>
        </div>
        <div class="row">
            <table class="table table-bordered table-sm table-condensed">
              <thead class="thead-light">
                <tr>
                  <th class="text-center">ID</th>
                  <th>Nome</th>
                  <th>Email</th>
                  <th class="text-center">Ações</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $lista = $contato->getAll();
                foreach ($lista as $item) :
                ?>

                <tr>
                    <td class="text-center"><?php echo $item['id']; ?></td>
                    <td><?php echo $item['nome']; ?></td>
                    <td><?php echo $item['email']; ?></td>
                    <td class="text-center">
                        <a href="editar.php?id=<?php echo $item['id']; ?>" class="btn btn-secondary btn-sm">Editar</a>
                        <a href="excluir.php?id=<?php echo $item['id']; ?>" class="btn btn-danger btn-sm">Excluir</a>
                    </td>
                </tr>
                    
                <?php 
                endforeach;
                ?>
              </tbody>
            </table>            
        </div>
    </div>
    <script type="text/javascript" src="js/jquery-3.3.1.min.js"></script>
    <script type="text/javascript"src="js/popper.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>   
</body>
</html>