<?php
session_start();
require_once("config.php");
require_once("funcoes.php");

if(empty($_SESSION['mmn_login'])){
    header("Location: login.php");
    exit;
}

$id = $_SESSION['mmn_login'];
$sql = "SELECT A.id, A.id_pai, A.patente, A.nome, B.nome AS p_nome
        FROM usuarios A
        LEFT JOIN patentes B ON (A.patente = B.id)
        WHERE A.id = :id";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(":id", $id);
$stmt->execute();

if($stmt->rowCount() > 0) {
    $row = $stmt->fetch();
    $nome   = $row['nome'];
    $p_nome = $row['p_nome'];
} else {
    header("Location: login.php");
    exit;
}

$lista = listar($id,4);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sistema de Marketin Multinível</title>
</head>
<body>
    <h1>Sistema de Marketing Multinível</h1>
    <h2>Usuário logado: <?php echo $nome . " (" . $p_nome . ")"; ?>
    <p><a href="cadastrar.php">Cadastrar novo usuário</a></p>
    <p><a href="sair.php">Logout</a></p>
    <hr>
    <h4>Lista de cadastros</h4>
     <?php echo exibir($lista); ?>
</body>
</html>