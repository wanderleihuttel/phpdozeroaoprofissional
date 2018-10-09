<div class="modal" tabindex="-1" role="dialog" data-backdrop="static">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><?php echo $modal_title; ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p><?php echo $modal_body; ?></p>
            </div>
            <form method="POST" action="<?php echo $action; ?>">
                <input type="hidden" name="confirm-delete" value="true">
            </form>
            <div class="modal-footer">
                <button type="button" class="btn btn-dark btn-sm btn-modal-cancel" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-danger btn-sm btn-modal-confirm" data-dismiss="modal">Confirmar</button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function(){
        $('.btn-modal-confirm').on('click', function(e){
            $('form').submit();
        });
    });
</script>