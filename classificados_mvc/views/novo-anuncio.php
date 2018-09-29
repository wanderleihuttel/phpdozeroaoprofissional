<?php
    if(!empty($alert)){
        $collapse = "";

    } else {
        $collapse="collapse";
        $alert    = "";
    }
?>
<div class="container">
    <h1>Novo anúncio</h1>
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
    <form method="POST" ecntype="multipart/form-data">
        <div class="form-group">
            <label for="id_categoria">Categoria</label>
            <select name="id_categoria" class="form-control">
            <?php
                $categoria = new Categoria();
                $categorias = $categoria->getCategorias();
                foreach ($categorias as $row):
                ?>
                <option value="<?php echo $row['id'];?>"><?php echo $row['nome'];?></option>
                <?php
                endforeach;
                ?>
            </select>
        </div>
        <div class="form-group">
            <label for="titulo">Título</label>
            <input type="text" name="titulo" class="form-control">
        </div>
        <div class="form-group">
            <label for="descricao">Descrição</label>
            <textarea name="descricao" class="form-control"></textarea>
        </div>
        <div class="form-group">
            <label for="valor">Valor</label>
            <input type="text" name="valor" class="form-control">
        </div>
        <div class="form-group">
            <label for="estado_conservacao">Estado de conservação</label>
            <select name="estado_conservacao" class="form-control">
                <option value="1">Ruim</option>
                <option value="2">Bom</option>
                <option value="3">Ótimo</option>
            </select>
        </div>
        <input type="submit" name="submit" value="Salvar" class="btn btn-dark">
        <a href="<?php echo BASE_URL; ?>/anuncio/index" class="btn btn-dark">Cancelar</a>
    </form>
</div>