<div class="row">
    <h3>Relação de Contatos</h3>
</div>
<div class="row">
    <a href="<?php echo BASE_URL; ?>/contato/add" class="btn btn-sm btn-primary mb-1">Novo contato</a>
</div>
<div class="row">
    <table class="table table-bordered table-sm table-condensed">
        <thead class="thead-light">
            <tr>
                <th class="text-center">ID</th>
                <th>Nome</th>
                <th>Email</th>
                <th class="text-center">Ações</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($contatos as $item): ?>
            <tr>
                <td class="text-center"><?php echo $item['id']; ?></td>
                <td><?php echo $item['nome']; ?></td>
                <td><?php echo $item['email']; ?></td>
                <td class="text-center">
                    <a href="<?php echo BASE_URL; ?>/contato/edit/<?php echo $item['id']; ?>" class="btn btn-secondary btn-sm">Editar</a>
                    <a href="<?php echo BASE_URL; ?>/contato/delete/<?php echo $item['id']; ?>" class="btn btn-danger btn-sm">Excluir</a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>