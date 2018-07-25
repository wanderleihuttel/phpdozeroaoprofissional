<?php

require_once 'config.php';

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = addslashes($_GET['id']);
    $sql = "DELETE FROM  usuarios WHERE id = '$id'";
    $stmt = $pdo->query($sql);

    header("Location: index.php");
} else {
    header("Location: index.php");
}

?>

<form action="" method="post">
    Nome:  <input type="text" name="nome"> <br/>
    Email: <input type="text" name="email"><br/>
    Senha: <input type="password" name="senha"><br/>
<input type="submit" value="Salvar">


</form>
