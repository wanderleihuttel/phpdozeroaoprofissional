<div class="row">
    <h3>Editar Contato</h3>
</div>
<div class="row-fluid">
    <form method="POST" action="<?php echo BASE_URL; ?>/contato/edit/<?php echo $contato['id']; ?>">
      <div class="form-group">
        <label for="nome">Nome:</label>
        <input type="text" name="nome" class="form-control form-control-sm" placeholder="Digite o seu nome..." value="<?php echo $contato['nome']; ?>">
      </div>
      <div class="form-group">
        <label for="email">Email:</label>
        <input type="email" name="email" class="form-control form-control-sm" placeholder="Digite o seu email..." value="<?php echo $contato['email']; ?>">
      </div>
      <button type="submit" class="btn btn-sm btn-primary">Salvar</button>
      <a href="<?php echo BASE_URL; ?>/home/index" class="btn btn-sm btn-danger">Cancelar</a>
    </form>
</div>
