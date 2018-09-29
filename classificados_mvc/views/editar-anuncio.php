<div class="container">
    <h1>Editar anúncio</h1>
    <form method="POST" action="<?php echo BASE_URL; ?>/anuncio/salvar" enctype="multipart/form-data">
        <div class="form-group">
            <label for="id_categoria">Categoria</label>
            <select name="id_categoria" class="form-control">
            <?php
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
                            <img src="<?php echo BASE_URL; ?>/assets/img/anuncio/<?php echo $foto['url']; ?>" alt="" class="mb-2"/>
                            <a href="<?php echo BASE_URL; ?>/excluir-foto/<?php echo $info['id']; ?>" class="btn btn-info btn-sm">Excluir</a>
                        </div>
                    <?php
                    endforeach;
                    ?>
                </div>
            </div>
        </div>
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <input type="submit" name="submit" value="Salvar" class="btn btn-dark">
        <a href="<?php echo BASE_URL; ?>/anuncio/index" class="btn btn-dark">Cancelar</a>

    </form>

</div>