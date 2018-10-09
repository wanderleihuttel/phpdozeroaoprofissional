<div class="row">
    <h3>Relação de Contatos</h3>
</div>
<div class="row">
    <a href="<?php echo BASE_URL; ?>/contato/add" class="btn btn-sm btn-primary mb-1 btn-action-add">Novo contato</a>
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
                    <a href="<?php echo BASE_URL; ?>/contato/edit/<?php echo $item['id']; ?>" class="btn btn-secondary btn-sm btn-action-edit">Editar</a>
                    <a href="<?php echo BASE_URL; ?>/contato/delete/<?php echo $item['id']; ?>" class="btn btn-danger btn-sm btn-action-delete">Excluir</a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
<script type="text/javascript">
    $(document).ready(function(){
        $('.btn-action-delete, .btn-action-edit, .btn-action-add').on('click', function(e){
            e.preventDefault();
            var url = $(this).prop('href');
            $.ajax({
                url: url,
                method: 'POST',
                cache: false,
                dataType: 'html',
                //data: { 'id': 'id' },
                success: function(data){
                    $('.modal-result').html(data);
                    $('.modal').modal();
                },
                error: function(xhr, status, error) {
                    alert('Ocorreu um erro! Tente novamente!');
                    console.log(status);
                }
            });
            return false;
        });

    });
</script>