<?php
require_once('pages/header.php');
require_once('classes/usuario.php');
?>
<div class="container">
    <h1>Cadastrar</h1>
    <?php


$usuario = new Usuarios();
if( isset($_POST['nome']) && (!empty($_POST['nome'])) &&
    isset($_POST['email']) && (!empty($_POST['email'])) &&
    isset($_POST['telefone']) && (!empty($_POST['telefone'])) &&
    isset($_POST['senha']) && (!empty($_POST['senha'])) ){
    $nome = addslashes($_POST['nome']);
    $email = addslashes($_POST['email']);
    $telefone = addslashes($_POST['telefone']);
    $senha = addslashes($_POST['senha']);

    if($usuario->cadastrar($nome, $email, $telefone, $senha)){
        // do something
    } else {

    }
} else {
    ?>
        <div class="alert alert-warning" role="alert">
            Preencha todos os campos!
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>

    <?php
}

?>
    <form method="POST">
        <div class="form-group">
            <label for="nome">Nome</label>
            <input type="text" name="nome" class="form-control">
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="text" name="email" class="form-control">
        </div>
        <div class="form-group">
            <label for="telefone">Telefone</label>
            <input type="text" name="telefone" class="form-control">
        </div>
        <div class="form-group">
            <label for="senha">Nome</label>
            <input type="password" name="senha" class="form-control">
        </div>
        <input type="submit" name="submit" value="Salvar" class="btn btn-default">

    </form>

</div>
<?php require_once('pages/footer.php'); ?>