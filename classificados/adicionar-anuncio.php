<?php
require_once('pages/header.php');
require_once('classes/categoria.php');
require_once('classes/anuncio.php');
?>
<div class="container">
<?php
if(empty($_SESSION['cLogin'])){
?>
    <script type="text/javascript">window.location.href="login.php";</script>
<?php
    exit;
}


if( isset($_POST['id_categoria']) && (!empty($_POST['id_categoria'])) &&
    isset($_POST['titulo']) && (!empty($_POST['titulo'])) &&
    isset($_POST['descricao']) && (!empty($_POST['descricao'])) &&
    isset($_POST['valor']) && (!empty($_POST['valor'])) &&
    isset($_POST['estado_conservacao']) ){

    $id_categoria = addslashes($_POST['id_categoria']);
    $titulo = addslashes($_POST['titulo']);
    $descricao = addslashes($_POST['descricao']);
    $valor = str_replace(",", ".", str_replace(".","",addslashes($_POST['valor'])));
    $estado_conservacao = addslashes($_POST['estado_conservacao']);



    $anuncio = new Anuncio();
    if($anuncio->adicionarAnuncio($id_categoria, $titulo, $descricao, $valor, $estado_conservacao)){
    ?>
    <div class="alert alert-success" role="alert">
        Anúncio cadastrado com sucesso!
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <?php
    }
} else if(isset($_POST['submit'])){
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
    <h1>Novo anúncio</h1>
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
                <option value="0">Ruim</option>
                <option value="1">Bom</option>
                <option value="2">Ótimo</option>
            </select>
        </div>
        <input type="submit" name="submit" value="Salvar" class="btn btn-dark">
        <a href="meus-anuncios.php" class="btn btn-dark">Cancelar</a>

    </form>

</div>
<?php require_once('pages/footer.php'); ?>