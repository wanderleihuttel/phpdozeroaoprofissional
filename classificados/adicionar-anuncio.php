<?php
require_once('pages/header.php');

?>
<div class="container">
    <h1 class="mt-3">Novo anúncio</h1>
    <form method="POST">
        <div class="form-group">
            <label for="titulo">Título</label>
            <input type="text" name="titulo" class="form-control">
        </div>
        <div class="form-group">
            <label for="descricao">Descrição</label>
            <textarea name=descricao" class="form-control"></textarea>
        </div>
        <div class="form-group">
            <label for="telefone">Categoria</label>
            <select name="categoria" class="form-control">
                <option value="1">Categoria 1</option>
                <option value="2">Categoria 2</option>
            </select>
        </div>
        <div class="form-group">
            <label for="valor">Valor</label>
            <input type="text" name="valor" class="form-control">
        </div>
        <div class="form-group">
            <label for="estado">Estado de conservação</label>
            <select name="estados" class="form-control">
                <option value="1">Novo</option>
                <option value="2">Usado</option>
            </select>
        </div>

        <input type="submit" name="submit" value="Salvar" class="btn btn-default">

    </form>

</div>
<?php require_once('pages/footer.php'); ?>