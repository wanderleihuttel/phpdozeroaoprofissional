<?php
    $arquivo = $_FILES['arquivo'];
    if( isset($arquivo['tmp_name']) && !empty($arquivo['tmp_name']) ){
        $extension = pathinfo($arquivo['name'],PATHINFO_EXTENSION);
        $arquivo_uploaded = md5(time()).rand(0,99) . "." . $extension;
        if( move_uploaded_file($arquivo['tmp_name'], "arquivos/" . $arquivo_uploaded ) ) {
            echo "O arquivo \"${arquivo_uploaded}\" foi enviado com sucesso!<br/>";
            echo "<a href='index.php'>Voltar</a>";
        } else {
            echo "Ocorreu algum erro ao enviar o arquivo!";
        }
    }
