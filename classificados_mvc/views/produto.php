<div class="container"></div>
<div class="container">
    <div class="row">
        <div class="col-sm-6">
            <div class="carousel slide" data-ride="carousel" id="myCarousel">
                <div class="carousel-inner" role="listbox">
                    <?php foreach ($info['fotos'] as $chave => $foto): ?>
                        <div class="carousel-item <?php echo ($chave=='0')?'active':''; ?>">
                            <img src="<?php echo BASE_URL; ?>/assets/img/anuncio/<?php echo $foto['url'];?>" />
                        </div>
                    <?php endforeach; ?>
                </div>
                <a href="#myCarousel" class="left carousel-control-prev" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Anterior</span>
                </a>
                <a href="#myCarousel" class="right carousel-control-next" role="button" data-slide="next">
                    <span class="carousel-control-next-icon dark" aria-hidden="true"></span>
                    <span class="sr-only">Próxima</span>
                </a>
            </div>
        </div>
        <div class="col-sm-6">
        <h1><?php echo $info['titulo']; ?></h1>
        <h5><span class="badge badge-info"><?php echo $info['categoria']; ?></span></h5>
        <p><?php echo $info['descricao']; ?></p>
        <h3>R$ <?php echo number_format($info['valor'],2,',', '.'); ?></h3>
        <h4><?php echo $info['telefone']; ?></h4>
        </div>
    </div>
</div>