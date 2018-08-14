<?php 
session_start();
require_once("config.php");

if(!empty($_POST['email'])){
    $email = addslashes($_POST['email']);
    $senha = md5(addslashes($_POST['senha']));

    $sql = "select * from usuarios where email = :email and senha = :senha";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(":email", $email);
    $stmt->bindValue(":senha", $senha);
    $stmt->execute();

    if ($stmt->rowCount() > 0){
        $row = $stmt->fetch();
        $_SESSION['mmn_login'] = $row['id'];
        header("Location: index.php");
        exit;
    } else {
        echo "Usuário e/ou senhas incorretos!";
    }
} 


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sistema de Marketin Multinível</title>
</head>
<body>
    <form method="POST"> 
        Email: <br/>
        <input type="email" name="email" id=""><br/><br/>
        Senha: <br/>
        <input type="password" name="senha" id=""><br/><br/>
        <input type="submit" value="Entrar">
    </form>
</body>
</html>