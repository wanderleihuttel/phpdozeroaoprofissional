<?php 
session_start();

if( isset($_POST['email']) && !empty($_POST['email']) ){ 
    $email = addslashes( $_POST['email'] );
    $senha = md5( addslashes( $_POST['senha'] ) );

    $dsn = "mysql:dbname=blog;host=localhost;port=3306;chartset=utf8";
    $dbuser = "blog";
    $dbpass = "123456";

    $options = array (
        PDO::ATTR_CASE => PDO::CASE_LOWER,               // lowercase
        PDO::ATTR_ERRMODE    => PDO::ERRMODE_EXCEPTION,  // pdo show exception
        PDO::ATTR_PERSISTENT => true                     // persistent connection
    );

    try{

        $pdo = new PDO($dsn, $dbuser, $dbpass, $options);

        $stmt = $pdo->query("select * from usuarios where email = '$email' and senha = '$senha' ");
        if( $stmt->rowCount() > 0 ){
            $dado = $stmt->fetch();
            $_SESSION['id']    = $dado['id'];
            $_SESSION['nome']  = $dado['nome'];
            $_SESSION['email'] = $dado['email'];
            header("Location: index.php");
        }

    } catch(PDOException $e){
        echo "(". $e->getCode() . ") " .$e->getMessage() . " at line: " . $e->getLine();
    }
} // end if

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sistema de Autenticação</title>
    <link rel="stylesheet" href="https://unpkg.com/purecss@1.0.0/build/pure-min.css" integrity="sha384-nn4HPE8lTHyVtfCBi5yW9d20FjT8BJwUXyWZT9InLYax14RDjBj46LmSztkmNP9w" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="login.css">
</head>
<body>
<!-- link login: https://codepen.io/danzawadzki/pen/EgqKRr !-->

<div class="wrapper fadeInDown">
  <div id="formContent">
    <!-- Tabs Titles -->
    <h2 class="active"> Login </h2>
    <h2 class="inactive underlineHover">Cadastrar </h2>

    <!-- Icon -->
    <div class="fadeIn first">
      <img src="icon.svg" id="icon" alt="User Icon" />
    </div>

    <!-- Login Form -->
    <form method="POST">
      <input type="text" id="email" class="fadeIn second" name="email" placeholder="email">
      <input type="password" id="senha" class="fadeIn third" name="senha" placeholder="senha">
      <input type="submit" class="fadeIn fourth" value="Log In">
    </form>

    <!-- Remind Passowrd -->
    <div id="formFooter">
      <a class="underlineHover" href="#">Esqueceu sua senha?</a>
    </div>

  </div>
</div>

</body>
</html>