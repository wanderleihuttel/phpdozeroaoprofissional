<?php
require_once('pages/header.php');
require_once('classes/anuncios.php');
if(empty($_SESSION['cLogin'])){
?>
    <script type="text/javascript">window.location.href="login.php";</script>
<?php
    exit;
}
?>
<div class="container">
    <h1 class="mt-3">Meus anúncios</h1>
    <a href="adicionar-anuncio.php" class="btn btn-light mb-2">Adicionar Anúncio</a>
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
            $anuncio = new Anuncios();
            $anuncios = $anuncio->getMeusAnuncios();
            foreach ($anuncios as $row):
            ?>
                <tr>
                    <td><img src="assets/img/anuncio/<?php echo $row['url']; ?>"/></td>
                    <td><?php echo $row['titulo']; ?></td>
                    <td><?php echo number_format($row['valor'], 2, ",", "."); ?></td>
                    <td>Ações</td>
                </tr>

            <?php
            endforeach;
            ?>
        </tbody>
    </table>
</div>
<?php require_once('pages/footer.php'); ?>
