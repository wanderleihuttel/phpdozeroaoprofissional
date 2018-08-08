<?php
session_start();
require_once('config.php');

if( isset($_POST['tipo']) ){
    $id_conta = $_SESSION['banco'];
    $tipo = addslashes($_POST['tipo']);
    $valor = str_replace(',' , '.', addslashes($_POST['valor']) );
    $valor = floatval($valor);

    $sql = "INSERT INTO historico (id_conta, tipo, valor, data_operacao) VALUES (:id_conta, :tipo, :valor, now() )";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(":id_conta", $id_conta);
    $stmt->bindValue(":tipo", $tipo);
    $stmt->bindValue(":valor", $valor);
    $stmt->execute();
    $cont = $stmt->rowCount();

    if($stmt->rowCount() > 0){
        if($tipo == 0){
            // Depósito
            $sql = "UPDATE contas SET saldo = saldo + :valor WHERE id = :id_conta";
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(":valor", $valor);
            $stmt->bindValue(":id_conta", $id_conta);
            $stmt->execute();
        } else {
            // Retirada
            $sql = "UPDATE contas SET saldo = saldo - :valor WHERE id = :id_conta";
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(":valor", $valor);
            $stmt->bindValue(":id_conta", $id_conta);
            $stmt->execute();
        }
        header("Location: index.php");
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Caixa Eletrônico</title>
</head>
<body>
    <form method="POST">
        Tipo de Transação: <br/>
        <select name="tipo">
            <option value="0">Depósito</option>
            <option value="1">Retirada</option>
        </select><br/><br/>
        Valor: <br/>
        <input type="text" name="valor" pattern="[0-9.,]{1,}"/><br/><br/>
        <input type="submit" value="Adicionar">
    </form><br/>
    <a href="index.php">Voltar</a>
</body>
</html>