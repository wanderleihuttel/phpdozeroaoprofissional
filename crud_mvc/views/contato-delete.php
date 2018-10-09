<div class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Confirmação de exclusão</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Você tem certeza que deseja excluir o id <?php echo $id; ?>?</p>
            </div>
            <form method="POST" action="<?php echo BASE_URL;?>/contato/delete/<?php echo $id; ?>">
                <input type="hidden" name="confirm-delete" value="<?php echo $id; ?>">
            </form>
            <div class="modal-footer">
                <button type="button" class="btn btn-dark btn-cancelar" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-danger btn-confirmar" data-dismiss="modal">Confirmar</button>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function(){
        $('.modal').modal();

        $('.modal .btn-cancelar').on('click', function(){
            window.location.href = '<?php echo BASE_URL;?>/home/index';
        });


        $('.modal .btn-confirmar').on('click', function(){
            $('form').submit();
        });
    });
</script>