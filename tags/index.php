<?php
require_once('config.php');


$sql = "SELECT caracteristicas FROM usuarios";
$stmt = $pdo->query($sql);

if($stmt->rowCount() > 0) {
    $row = $stmt->fetchAll();
    $caracteristicas = array();
    
    // Busca as caracteristicas de todos os usuários
    // E usa o explode para separar pela vírgula
    foreach ($row as $c) {
        $palavras = explode(",", $c['caracteristicas']);
        foreach ($palavras as $p) {
            $p = trim($p);
            if(isset($caracteristicas[$p])){
                $caracteristicas[$p]++;
            } else {
                $caracteristicas[$p] = 1;
            }
        }
    }

}

// Ordena o array em ordem decrescente
arsort($caracteristicas);

// Pega apenas as chaves das palavras
$palavras  = array_keys($caracteristicas);

// Pega apenas os palavras
$contagens = array_values($caracteristicas);

// Maior
$maior = max($contagens);

// Tamanhos das fontes
$tamanhos = array(10,15,20,30);

// Cores 
$cores = array('blue', 'green', 'red', 'purple');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Projeto Tags</title>
    <style type="text/css">
        * {
            margin: 0;
            padding: 0;
            font-family: sans-serif;
        }
        p {
            padding: 5px;
            margin-left: 10px;
        }
    </style>
</head>
<body>
    <h1>Projeto Tags</h1>
    <hr>
    <?php
    // Exibe as palavras
    for($i=0;$i<count($palavras);$i++){
        $n = $contagens[$i] / $maior;
        $h = ceil($n * count($tamanhos));
        echo "<p style='font-size:" . $tamanhos[$h-1]. "px; color: " . $cores[$h-1] . "'>" . $palavras[$i] . " (" . $contagens[$i] . ")</p>";
    }
    ?>
    <hr>
</body>
</html>