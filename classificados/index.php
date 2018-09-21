<?php require_once('pages/header.php'); ?>
<?php
require_once('classes/anuncio.php');
require_once('classes/usuario.php');
$anuncio = new Anuncio();
$usuario = new Usuario();

$total_anuncios = $anuncio->getTotalAnuncios();
$total_usuarios = $usuario->getTotalUsuarios();

$p = 1;

if( isset($_GET['p']) && !empty($_GET['p']) ){
    $p = addslashes($_GET['p']);
}
$item_por_pagina = 2;
$total_paginas = ceil($total_anuncios/$item_por_pagina);

$anuncios = $anuncio->getUltimosAnuncios($p, $item_por_pagina);

?>
<div class="container"></div>
<div class="jumbotron jumbotron-fluid">
    <div class="container">
      <h1 class="display-4">Nós temos hoje mais de <?php echo $total_anuncios; ?> anúncios</h1>
      <h1 class="display-5">E mais de <?php echo $total_usuarios; ?> usuários cadastrados</h1>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-sm-3">
            <h4>Pesquisa avançada</h4>
        </div>
        <div class="col-sm-9">
            <h4>Últimos anúncios</h4>
            <table class="table table-striped">
            <tbody>
                <?php
                foreach ($anuncios as $row):
                ?>
                    <tr>
                        <td class="align-middle">
                            <?php if ( !empty($row['url']) ):?>
                                <img src="assets/img/anuncio/<?php echo $row['url']; ?>" height="80"/>
                            <?php else: ?>
                                <img src="assets/img/default.png" height="80" />
                            <?php endif; ?>
                        </td>
                        <td class="align-middle">

                            <a href="produto.php?id=<?php echo $row['id'];?>"><?php echo $row['titulo']; ?></a>

                            <h5><span class="badge badge-info"><?php echo $row['categoria']; ?></span></h5>

                        </td>
                        <td class="align-middle">
                            <p class="font-weight-bold">R$ <?php echo number_format($row['valor'], 2, ",", "."); ?></p>
                        </td>

                    </tr>
                <?php
                endforeach;
                ?>
            </tbody>
            </table>
            <ul class="pagination">
                <?php for( $i=1; $i <= $total_paginas; $i++): ?>
                    <li class="page-item <?php echo ($i==$p)?'active':'';?>">
                        <a class="page-link" href="index.php?p=<?php echo $i; ?>">
                            <?php echo $i; ?>
                        </a>
                    </li>
                <?php endfor; ?>
            </ul>
        </div>
    </div>
</div>
<?php require_once('pages/footer.php'); ?>