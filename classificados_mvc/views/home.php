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
            <form method="GET">
                <div class="form-group">
                    <label for="categoria">
                        Categoria
                    </label>
                    <select class="form-control" name="filtro[categoria]">
                        <option></option>
                        <?php foreach ($categorias as $cat): ?>
                            <option value="<?php echo $cat['id']; ?>" <?php echo ( $cat['id']==$filtro['categoria'] )?'selected="selected"':''; ?> ><?php echo $cat['nome']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="valor">
                        Valor Mínimo
                    </label>
                    <input type="range" name="filtro[valor_minimo]" min="0" max="<?php echo $maior_preco; ?>" value="<?php echo $filtro['valor_minimo'];?>" id="valor_minimo">
                    <p>
                        <span class="valor_minimo">R$ 0,00</span>
                    </p>
                </div>
                <div class="form-group">
                    <label for="valor">
                        Valor Máximo
                    </label>
                    <input type="range" name="filtro[valor_maximo]" min="0" max="<?php echo $maior_preco; ?>" value="<?php echo $filtro['valor_maximo'] ?>" id="valor_maximo">
                    <p>
                        <span class="valor_maximo">R$ <?php echo number_format($maior_preco, 2, ',', '.'); ?></span>
                    </p>
                </div>

                <div class="form-group">
                    <label for="estado_conservacao">
                        Estado de conservação
                    </label>
                    <select class="form-control" name="filtro[estado_conservacao]">
                        <option></option>
                        <option value="1" <?php echo ( $filtro['estado_conservacao']==1 )?'selected="selected"':''; ?> >Ruim</option>
                        <option value="2" <?php echo ( $filtro['estado_conservacao']==2 )?'selected="selected"':''; ?>>Bom</option>
                        <option value="3" <?php echo ( $filtro['estado_conservacao']==3 )?'selected="selected"':''; ?>>Ótimo</option>
                    </select>
                </div>

                <input type="submit" class="btn btn-dark mb-2 submit" value="Pesquisar" />

            </form>
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
                                <img src="<?php echo BASE_URL; ?>/assets/img/anuncio/<?php echo $row['url']; ?>" height="80"/>
                            <?php else: ?>
                                <img src="<?php echo BASE_URL; ?>/assets/img/default.png" height="80" />
                            <?php endif; ?>
                        </td>
                        <td class="align-middle">

                            <a href="<?php echo BASE_URL; ?>/produto/<?php echo $row['id'];?>"><?php echo $row['titulo']; ?></a>

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
                        <a class="page-link" href="<?php echo BASE_URL; ?>/?p=<?php $f['filtro'] = $filtro; echo $i . "&" . http_build_query($f); ?>">
                            <?php echo $i; ?>
                        </a>
                    </li>
                <?php endfor; ?>
            </ul>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function(){

        var valor_minimo = $('#valor_minimo').val();
        var valor_maximo = $('#valor_maximo').val();
        valor_minimo = parseFloat(valor_minimo).toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' });
        valor_maximo = parseFloat(valor_maximo).toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' });
        $('span.valor_minimo').html(valor_minimo);
        $('span.valor_maximo').html(valor_maximo);

        $('#valor_minimo').on('change', function(){
            var valor_minimo = $('#valor_minimo').val();
            valor_minimo = parseFloat(valor_minimo).toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' });
            $('span.valor_minimo').html(valor_minimo);
        });

        $('#valor_maximo').on('change', function(){
            var valor_maximo = $('#valor_maximo').val();//.parseFloat(valor_maximo).toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' });
            valor_maximo = parseFloat(valor_maximo).toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' });
            $('span.valor_maximo').html( valor_maximo );
        });


    });
</script>