<?php
require_once('pages/header.php');
require_once('classes/usuario.php');
?>
<div class="container">
    <h1 class="mt-3">Efetuar login</h1>
    <?php


$usuario = new Usuario();
if( isset($_POST['email']) && (!empty($_POST['email'])) &&
    isset($_POST['senha']) && (!empty($_POST['senha'])) ){
    $email = addslashes($_POST['email']);
    $senha = addslashes($_POST['senha']);

    if($usuario->login($email, $senha)){
        header("Location: index.php");
    } else {
    ?>
        <div class="alert alert-danger" role="alert">
            Usuário e/ou senhas incorretos!
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php
    }
}

?>
    <form method="POST">
        <div class="form-group">
            <label for="email">Email</label>
            <input type="text" name="email" class="form-control">
        </div>
        <div class="form-group">
            <label for="senha">Nome</label>
            <input type="password" name="senha" class="form-control">
        </div>
        <input type="submit" name="submit" value="Login" class="btn btn-default">

    </form>

</div>
<?php require_once('pages/footer.php'); ?>