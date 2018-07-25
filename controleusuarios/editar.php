<script>
function excluir (id){
    var excluir = confirm("Tem certeza que deseja excluir o cadastro?");
    if (excluir == true){ 
      window.location = "excluir.php?id=" + id;
    }
}
</script>

<?php

require_once 'config.php';

$id = 0;

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = addslashes($_GET['id']);
}

if (isset($_POST['nome']) && !empty($_POST['nome'])) {
    $nome = addslashes($_POST['nome']);
    $email = addslashes($_POST['email']);
    $sql = "UPDATE usuarios set nome = '$nome', email = '$email' WHERE id = '$id'";
    $stmt = $pdo->query($sql);
    header("Location: index.php");

}


    $sql = "SELECT * FROM  usuarios WHERE id = '$id'";
    $sql = $pdo->query($sql);
    if( $sql->rowCount() ){
       $row = $sql->fetch();
    } else {
        header("Location: index.php");
    }

?>
<div class="container">
    <div class="painel">
    <form action="" method="post">
        Nome:  <input type="text" name="nome" value="<?php echo $row['nome']; ?>"> <br/>
        Email: <input type="text" name="email" value="<?php echo $row['email']; ?>"><br/>
    <input type="button" onclick="window.history.back();" value="Cancelar">
    <input type="submit" value="Salvar">
    </form>
    </div>
</div>