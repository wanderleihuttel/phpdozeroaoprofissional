<?php

require_once 'config.php';

$id = 0;

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = addslashes($_GET['id']);
}

if (isset($_POST['nome']) && !empty($_POST['nome'])) {
    $nome = addslashes($_POST['nome']);
    $email = addslashes($_POST['email']);
    $sql = "UPDATE usuarios set nome = '$nome', email = '$email' WHERE id = '$id'";
    $stmt = $pdo->query($sql);
    header("Location: index.php");

}


    $sql = "SELECT * FROM  usuarios WHERE id = '$id'";
    $sql = $pdo->query($sql);
    if( $sql->rowCount() ){
       $row = $sql->fetch();
    } else {
        header("Location: index.php");
    }

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Módulo 9 - Aula 23 - Exemplo: Controle de Usuários</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <div class="container">
            <form action="" method="post">
               <legend><h2>Editar Usuário</h2></legend>
               <div class="row">
                    <label for="nome">Nome</label>
                    <input type="text" id="nome" name="nome" placeholder="Digite seu nome..." value="<?php echo $row['nome']; ?>">
                </div>

               <div class="row">
                   <label for="email">Email</label>
                   <input type="email" id="email" name="email" placeholder="Digite seu email..." value="<?php echo $row['email']; ?>">
                </div>

                <div class="row">       
                    <input type="submit" value="Salvar">
                    <input type="button" onclick="window.history.back();" value="Cancelar">
                </div>
            </form>
        </div>
    </body>
</html>