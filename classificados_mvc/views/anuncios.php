<div class="container">
    <h1>Meus anúncios</h1>
    <a href="<?php echo BASE_URL; ?>/anuncio/adicionar" class="btn btn-dark mb-2">Adicionar Anúncio</a>
    <table class="table table-striped table-condensed">
        <thead>
            <tr>
                <th>Foto</th>
                <th>Título</th>
                <th>Valor</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($anuncios as $row):
            ?>
                <tr>
                    <td>
                        <?php if ( !empty($row['url']) ):?>
                            <img src="<?php echo BASE_URL; ?>/assets/img/anuncio/<?php echo $row['url']; ?>" height="80"/>
                        <?php else: ?>
                            <img src="<?php echo BASE_URL; ?>/assets/img/default.png" height="80" />
                        <?php endif; ?>
                    </td>
                    <td><?php echo $row['titulo']; ?></td>
                    <td><?php echo number_format($row['valor'], 2, ",", "."); ?></td>
                    <td>
                        <a href="<?php echo BASE_URL; ?>/anuncio/editar/<?php echo $row['id']; ?>" class="btn btn-dark">Editar</a>
                        <a href="<?php echo BASE_URL; ?>/anuncio/excluir/<?php echo $row['id']; ?>" class="btn btn-danger">Excluir</a>
                    </td>
                </tr>

            <?php
            endforeach;
            ?>
        </tbody>
    </table>
</div>