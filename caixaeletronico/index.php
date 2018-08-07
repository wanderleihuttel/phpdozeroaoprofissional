<?php
session_start();
require_once('config.php');


if( isset($_SESSION['banco']) && !empty($_SESSION['banco']) ){
    $id = $_SESSION['banco'];

    $sql = "SELECT * FROM contas WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(":id", $id);
    $stmt->execute();

    if($stmt->rowCount() > 0){
        $row = $stmt->fetch();
    } else {
        echo "Diaxo";
    }

} else {
    header("Location: login.php");
    exit;
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Caixa Eletrônico</title>
</head>
<body>
    <h1>Banco do Brasil S/A</h1>
    Correntista: <?php echo $row['titular']; ?><br/>
    Agência: <?php echo $row['agencia']; ?><br/>
    Conta: <?php echo $row['conta']; ?><br/>
    Saldo: <?php echo number_format($row['saldo'], 2, ',', '.'); ?><br/>
    <a href="sair.php">Sair </a>
</body>
</html>