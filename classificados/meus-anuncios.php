<?php
require_once('pages/header.php');
require_once('classes/anuncio.php');
if(empty($_SESSION['cLogin'])){
?>
    <script type="text/javascript">window.location.href="login.php";</script>
<?php
    exit;
}
?>
<div class="container">
    <h1>Meus anúncios</h1>
    <a href="adicionar-anuncio.php" class="btn btn-dark mb-2">Adicionar Anúncio</a>
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
            $anuncio = new Anuncio();
            $anuncios = $anuncio->getMeusAnuncios();
            foreach ($anuncios as $row):
            ?>
                <tr>
                    <td>
                        <?php if ( !empty($row['url']) ):?>
                            <img src="assets/img/anuncio/<?php echo $row['url']; ?>"/>
                        <?php else: ?>
                            <img src="assets/img/default.png" height="50" />
                        <?php endif; ?>
                    </td>
                    <td><?php echo $row['titulo']; ?></td>
                    <td><?php echo number_format($row['valor'], 2, ",", "."); ?></td>
                    <td>
                        <a href="editar-anuncio.php?id=<?php echo $row['id']; ?>" class="btn btn-dark">Editar</a>
                        <a href="excluir-anuncio.php?id=<?php echo $row['id']; ?>" class="btn btn-danger">Excluir</a>
                    </td>
                </tr>

            <?php
            endforeach;
            ?>
        </tbody>
    </table>
</div>
<?php require_once('pages/footer.php'); ?>
