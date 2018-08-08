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
    <a href="sair.php">Sair </a><br/><br/>
    Correntista: <?php echo $row['titular']; ?><br/>
    Agência: <?php echo $row['agencia']; ?><br/>
    Conta: <?php echo $row['conta']; ?><br/>
    Saldo: <?php echo number_format($row['saldo'], 2, ',', '.'); ?><br/>
    <hr>
    <h3>Movimentação/Extrato</h3>
    <a href="movimentacao.php">Adicionar transação</a></br></br>
    <table border="1" widht="400">
        <tr>
            <th>Data</th>
            <th>Valor</th>
        </tr>
        <?php 
        $sql = "SELECT * FROM historico WHERE id_conta = :id_conta";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(":id_conta", $id);
        $stmt->execute();
        
        if($stmt->rowCount() > 0) {
            while ($row = $stmt->fetch()){
                echo "<tr>";
                echo "<td>" . date("d/m/Y H:i", strtotime($row['data_operacao'])) . "</td>";
                echo "<td>";
                if($row['tipo'] == 0) {
                    echo "<span style='color: green;  width: 100px;'>R$ " . number_format($row['valor'], 2, ',', '.') . "</span>";
                }  else {
                    echo "<span style='color: red; width: 100px;'>R$ -" . number_format($row['valor'], 2, ',', '.') . "</span>";
                }
                echo "</td>";
                echo "</tr>";
            }
        }


        ?>

    </table>
</body>
</html>