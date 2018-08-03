<?php
session_start();
require_once("config.php");

if ( !empty($_POST['nome']) && !empty($_POST['email'])) {
    $nome = addslashes($_POST['nome']);
    $email = addslashes($_POST['email']);
    $id_pai = $_SESSION['mmn_login'];
    $senha = md5($email);

    $sql = "select * from usuarios where email = :email";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(":email", $email);
    $stmt->execute();

    if($stmt->rowCount()==0){
        $sql = "insert into usuarios (id_pai, nome, email, senha) values (:id_pai, :nome, :email, :senha)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(":id_pai", $id_pai);
        $stmt->bindValue(":nome", $nome);
        $stmt->bindValue(":email", $email);
        $stmt->bindValue(":senha", $senha);
        $stmt->execute();
        header("Location: index.php");
        exit;
    } else {
        echo "Usuário já cadastrado!";
    }
}    

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sistema de Marketing Multinível</title>
</head>
<body>
    <h2>Cadastar Novo Usuário</h2>
    <form method="POST">
        Nome: <br/>
        <input type="text" name="nome"><br/><br/>
        Email: </br>
        <input type="email" name="email"><br/><br/>
        <input type="submit" value="Salvar">
    </form>
</body>
</html>