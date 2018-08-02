<?php
session_start();
require_once 'config.php';

if(!empty($_POST['email'])) {
	$email = addslashes($_POST['email']);
	$senha = md5($_POST['senha']);

	$sql = "SELECT id FROM usuarios WHERE email = :email AND senha = :senha";
	$stmt = $pdo->prepare($sql);
	$stmt->bindValue(":email", $email);
	$stmt->bindValue(":senha", $senha);
	$stmt->execute();

	if($stmt->rowCount() > 0) {
		$row = $stmt->fetch();
		$_SESSION['logado'] = $row['id'];
		header("Location: index.php");
		exit;
	}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Sistema de Registro por Convite</title>
</head>
<body>
	<form method="POST">
		E-mail:<br/>
		<input type="email" name="email" /><br/><br/>

		Senha:<br/>
		<input type="password" name="senha" /><br/><br/>

		<input type="submit" value="Entrar" /> <!--<a href="cadastrar.php">Cadastrar</a>-->
	</form>	
</body>
</html>