<?php

require_once 'config.php';

if (isset($_POST['nome']) && !empty($_POST['nome'])) {
    $nome = addslashes($_POST['nome']);
    $email = addslashes($_POST['email']);
    $senha = addslashes($_POST['senha']);

    $sql = "INSERT INTO usuarios (nome, email, senha) values ('$nome', '$email', md5('$senha'))";
    $stmt = $pdo->query($sql);

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
               <div class="row">
                    <label for="nome">Nome</label>
                    <input type="text" id="nome" name="nome" placeholder="Digite seu nome...">
                </div>

               <div class="row">
                   <label for="email">Email</label>
                   <input type="email" id="email" name="email" placeholder="Digite seu email...">
                </div>

               <div class="row">
                   <label for="senha">Senha</label>
                   <input type="password" id="senha" name="senha" placeholder="Digite sua senha...">
                </div>
                <div class="row">       
                    <input type="button" onclick="window.history.back();" value="Cancelar">
                    <input type="submit" value="Salvar">
                </div>
            </form>
        </div>
    </body>
</html>