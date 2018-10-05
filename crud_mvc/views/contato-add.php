<?php
    if(!empty($alert)){
        $collapse = "";
    } else {
        $collapse="collapse";
        $alert    = "";
        $message = "";
    }
?>
<div class="row-fluid">
    <h3>Novo Contato</h3>
</div>
<div class="row-fluid">
    <div class="alert alert-lg <?php echo "$alert $collapse"; ?>" role="alert">
    <?php
        if(!empty($message)){
            echo $message;
        }
    ?>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
</div>
<div class="row-fluid border rounded p-3">
    <form method="POST" action="<?php echo BASE_URL; ?>/contato/add_save" >
        <div class="form-group">
            <label for="nome">Nome</label>
            <input type="text" name="nome" class="form-control form-control-sm"  placeholder="Digite o seu nome...">
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" class="form-control form-control-sm" placeholder="Digite o seu email...">
        </div>
        <button type="submit" class="btn btn-sm btn-primary">Salvar</button>
        <a href="<?php echo BASE_URL; ?>/home/index" class="btn btn-sm btn-danger">Cancelar</a>
    </form>
</div>
