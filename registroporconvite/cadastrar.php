<?php
session_start();
require_once 'config.php';

if(!empty($_GET['codigo'])) {
	$codigo = addslashes($_GET['codigo']);

	$sql = "SELECT * FROM usuarios WHERE codigo = :codigo";
	$stmt = $pdo->prepare($sql);
	$stmt->bindValue(":codigo", $codigo);
	$stmt->execute();

	if($stmt->rowCount() == 0) {
		header("Location: login.php");
		exit;
	}
} else {
	header("Location: login.php");
	exit;
}

if(!empty($_POST['email'])) {
	$email = addslashes($_POST['email']);
	$senha = md5($_POST['senha']);

	$sql = "SELECT * FROM usuarios WHERE email = :email";
	$stmt = $pdo->prepare($sql);
	$stmt->bindValue(":email", $email);
	$stmt->execute();

	if($stmt->rowCount() <= 0) {

		$codigo = md5(rand(0,99999).rand(0,99999));
		$sql = "INSERT INTO usuarios (email, senha, codigo) VALUES (:email, :senha, :codigo)";
		$stmt = $pdo->prepare($sql);
		$stmt->bindValue(":email", $email);
		$stmt->bindValue(":senha", $senha);
		$stmt->bindValue(":codigo", $codigo);
		$stmt->execute();

		unset($_SESSION['logado']);

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
	<h3>Cadastrar</h3>
	<form method="POST">
		E-mail:<br/>
		<input type="email" name="email" /><br/><br/>

		Senha:<br/>
		<input type="password" name="senha" /><br/><br/>

		<input type="submit" value="Cadastrar" />
	</form>
</body>
</html>

