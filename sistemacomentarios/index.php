<?php 

try {
   $dsn = "mysql:dbname=projeto_comentarios;host=localhost;port=3306;charset=utf8";
   $user = "php";
   $password = "";

   $options = array ( 
        PDO::ATTR_CASE => PDO::CASE_LOWER,
        PDO::ATTR_ERRMODE    => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_PERSISTENT => true
    );
   $pdo = new PDO($dsn, $user, $password, $options);
    
} catch (PDOException $e) {
    echo $e->getMessage();
}

if ( isset($_POST['nome']) && !empty($_POST['nome']) ){
    $nome     = addslashes($_POST['nome']);
    $mensagem = addslashes($_POST['mensagem']);
    
    $sql = "insert into mensagens (data_msg, nome, msg) values (now(), :nome, :msg)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(":nome", $nome);
    $stmt->bindValue(":msg", $mensagem);
    $stmt->execute();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sistema de Mensagens</title>
</head>
<body>
<fieldset>
    <form method="POST">
        Nome: <br/>
        <input type="text" name="nome" >
        <br/><br/>
        Mensagem<br/>
        <textarea name="mensagem"></textarea>
        <br/>
        <br/>
        <input type="submit" value="Enviar mensagem">
    </form>
</fieldset>
<br/>
<br/>
<?php 

$sql = "select  * from mensagens order by data_msg desc";
$stmt = $pdo->query($sql);

if($stmt->rowCount()>0){
   while($row = $stmt->fetch() ){
      echo "<strong>" . $row['nome'] . "</strong><br/>";
      echo $row['msg'] . "<br/>";
      echo "<hr>";
   }
} else {
    echo "Não existem mensagens!";
}

?>
</body>
</html>