<?php
session_start();
require_once 'config.php';

if(empty($_SESSION['logado'])) {
	header("Location: login.php");
	exit;
}

$email = '';
$codigo = '';

$sql = "SELECT email, codigo FROM usuarios WHERE id = '".addslashes($_SESSION['logado'])."'";
$stmt = $pdo->query($sql);
if($stmt->rowCount() > 0) {
	$row = $stmt->fetch();
	$email = $row['email'];
	$codigo = $row['codigo'];
}
?>
<?php
$link = "http://" . $_SERVER['SERVER_ADDR'] . "/phpdozeroaoprofissional/registroporconvite/cadastrar.php?codigo=" . $codigo;
?>
<h1>Área interna do sistema</h1>
<p>Usuário: <?php echo $email; ?> - <a href="sair.php">Sair</a></p>
<p>Link: <a href='<?php echo $link; ?>'><?php echo $link; ?></a></p>