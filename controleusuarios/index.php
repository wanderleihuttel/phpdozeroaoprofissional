<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Módulo 9 - Aula 23 - Exemplo: Controle de Usuários</title>
    <script>
    function excluir (id){
        var excluir = confirm("Tem certeza que deseja excluir o cadastro?");
        if (excluir == true){ 
          window.location = "excluir.php?id=" + id;
        }
    }
    </script>
    <link rel="stylesheet" href="style.css">

</head>
<body>
    <div class="container">
    <a href="adicionar.php">Novo usuário</a><br/>

    <table>
        <tr>
            <th>Nome</th>
            <th>Email</th>
            <th colspan="2">Ações</th>
        </tr>
        <?php require_once('config.php'); ?>
        <?php
        $sql = "SELECT * FROM usuarios";
        $stmt = $pdo->query($sql);
        if($stmt->rowCount() > 0){
            foreach ($stmt->fetchAll() as $usuario) {
                echo "<tr>";
                echo "<td>" . $usuario['nome'] . "</td>";
                echo "<td>" . $usuario['email'] . "</td>";
                echo "<td><a href='editar.php?id=" . $usuario['id'] . "'>Editar</a></td>";
                echo "<td><a href='#' onclick='excluir(" . $usuario['id'] . ");'>Excluir</a></td>";
                echo "</tr>";
            }
        }
        ?>
    </table>
</div>
</body>
</html>