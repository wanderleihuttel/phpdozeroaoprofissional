<div class="form-group">
    <h3>Adicionar uma foto</h3>
    <form method="POST" enctype="multipart/form-data">
        <input type="titulo" name="titulo" class="form-control m-1" placeholder="Digite o título da foto">

        <div class="input-group m-1">
          <div class="custom-file">
            <input type="file" class="custom-file-input" name="arquivo">
            <label class="custom-file-label" for="arquivo">Selecione os arquivos</label>
          </div>
        </div>

        <input type="submit" value="Enviar" class="btn btn-dark m-1">
    </form>
</div>
<div>
<?php foreach ($fotos as $foto): ?>
    <div>
    <img src="<?php echo BASE_URL; ?>/assets/img/galeria/<?php echo $foto['url']; ?>" width="200"/>
    <p><?php echo $foto['titulo']; ?></p>
    </div>
<?php endforeach; ?>
</div>