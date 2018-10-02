<?php
    if(!empty($alert)){
        $collapse="";
    } else {
        $collapse="collapse";
        $alert    = "";
    }
?>
<div class="container">
    <h1 class="mt-3">Efetuar login</h1>
    <div class="alert <?php echo "$alert $collapse"; ?>" role="alert">
        <?php
            if(!empty($message)){
                echo $message;
            }
        ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <form method="POST" action="<?php echo BASE_URL; ?>/login/entrar">
        <div class="form-group">
            <label for="email">Email</label>
            <input type="text" name="email" class="form-control">
        </div>
        <div class="form-group">
            <label for="senha">Senha</label>
            <input type="password" name="senha" class="form-control">
        </div>
        <input type="submit" name="submit" value="Login" class="btn btn-default">
    </form>
</div>