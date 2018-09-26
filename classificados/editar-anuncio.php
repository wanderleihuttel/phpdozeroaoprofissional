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
    if( isset($_FILES['fotos']) ){
        $fotos = $_FILES['fotos'];
    } else {
        $fotos = [];
    }

    $anuncio = new Anuncio();
    if($anuncio->editarAnuncio($_GET['id'], $id_categoria, $titulo, $descricao, $valor, $estado_conservacao, $fotos)){
    ?>
    <div class="alert alert-success" role="alert">
        Anúncio alterado com sucesso!
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

if( isset($_GET['id']) && !empty($_GET['id']) ) {
    $id = addslashes($_GET['id']);
    $anuncio = new Anuncio();
    $info = $anuncio->getAnuncioById($id);
} else {
?>
    <script type="text/javascript">window.location.href="meus-anuncios.php";</script>
<?php
}

?>
    <h1>Editar anúncio</h1>
    <form method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label for="id_categoria">Categoria</label>
            <select name="id_categoria" class="form-control">
            <?php
                $categoria = new Categoria();
                $categorias = $categoria->getCategorias();
                foreach ($categorias as $row):
                ?>
                <option value="<?php echo $row['id']; ?>"  <?php echo ($info['id_categoria'] == $row['id']) ? 'selected' :''; ?> ><?php echo $row['nome'];?></option>
                <?php
                endforeach;
                ?>
            </select>
        </div>
        <div class="form-group">
            <label for="titulo">Título</label>
            <input type="text" name="titulo" value="<?php echo $info['titulo']; ?>" class="form-control">
        </div>
        <div class="form-group">
            <label for="descricao">Descrição</label>
            <textarea name="descricao" class="form-control"><?php echo $info['descricao']; ?></textarea>
        </div>
        <div class="form-group">
            <label for="valor">Valor</label>
            <input type="text" name="valor" class="form-control" value="<?php echo number_format($info['valor'], 2, ',', '.'); ?>">
        </div>
        <div class="form-group">
            <label for="estado_conservacao">Estado de conservação</label>
            <select name="estado_conservacao" class="form-control">
                <option value="1" <?php echo ($info['estado_conservacao'] == 1) ? 'selected' :''; ?> >Ruim</option>
                <option value="2" <?php echo ($info['estado_conservacao'] == 2) ? 'selected' :''; ?> >Bom</option>
                <option value="3" <?php echo ($info['estado_conservacao'] == 3) ? 'selected' :''; ?> >Ótimo</option>
            </select>
        </div>

        <div class="form-group">
            <label for="estado_conservacao">Fotos</label>
            <div class="input-group mb-3">
                <div class="custom-file">
                    <label class="custom-file-label" for="fotos">Selecione os arquivos</label>
                    <input type="file" class="custom-file-input" name="fotos[]"  multiple>
                </div>
            </div>
        </div>

        <div class="form-group">
            <div class="card bg-light mb-3">
                <div class="card-header">Fotos do anúncio</div>
                <div class="card-body bg-white">
                    <?php
                    foreach ($info['fotos'] as $foto):
                    ?>
                        <div class="foto_item img-thumbnail m-2">
                            <img src="assets/img/anuncio/<?php echo $foto['url']; ?>" alt="" class="mb-2"/>
                            <a href="excluir-foto.php?id=<?php echo $info['id']; ?>" class="btn btn-info btn-sm">Excluir</a>
                        </div>
                    <?php
                    endforeach;
                    ?>
                </div>
            </div>
        </div>

        <input type="submit" name="submit" value="Salvar" class="btn btn-dark">
        <a href="meus-anuncios.php" class="btn btn-dark">Cancelar</a>

    </form>

</div>
<?php require_once('pages/footer.php'); ?>