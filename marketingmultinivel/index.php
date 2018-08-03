<?php
session_start();
require_once("config.php");

if(empty($_SESSION['mmn_login'])){
    header("Location: login.php");
    exit;
}


$id = $_SESSION['mmn_login'];
$sql = "select * from usuarios where id = :id";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(":id", $id);
$stmt->execute();

if($stmt->rowCount() > 0) {
    $row = $stmt->fetch();
    $nome = $row['nome'];
} else {
    header("Location: login.php");
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sistema de Marketin Multinível</title>
</head>
<body>
    <h1>Sistema de Marketing Multinível</h1>
    <h2>Usuário logado: <?php echo $nome; ?>
    <p><a href="cadastrar.php">Cadastrar novo usuário</a></p>
    <p><a href="sair.php">Logout</a></p>
</body>
</html>