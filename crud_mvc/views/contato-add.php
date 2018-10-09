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
                <div class="row-fluid">

                    <div class="alert alert-warning collapse" role="alert">
                      <button type="button" class="close" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                      <div class="alert-body"></div>
                    </div>

                    <form method="POST" action="<?php echo $action; ?>">
                      <div class="form-group">
                        <label for="nome">Nome</label>
                        <input type="text" name="nome" class="form-control form-control-sm" placeholder="Digite o seu nome..." value="">
                      </div>
                      <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" class="form-control form-control-sm" placeholder="Digite o seu email..." value="">
                      </div>
                      <input type="hidden" name="confirm-edit" value="true">
                    </form>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-dark btn-sm btn-modal-cancel" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary btn-sm btn-modal-confirm" data-dismiss="modal">Salvar</button>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">

    $(document).ready(function(){

        $('.btn-modal-confirm').on('click', function(e){
            e.preventDefault();
            var nome  = $('input[name=nome').val();
            var email = $('input[name=email').val();
            if (nome == "" || email == ""){
                $('.alert-body').html('Favor preencher todos os campos!');
                $('.alert').show();
            } else {
                $('form').submit();
            }
            return false;
        });

        $('.alert button.close').on('click', function(){
            $('.alert').hide();
        });
    });
</script>