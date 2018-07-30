<?php
    if( isset($_FILES['arquivo']) ){
        if( count($_FILES['arquivo']['tmp_name']) > 0){
            for($i=0; $i < count($_FILES['arquivo']['tmp_name']); $i++){

                $extension = pathinfo($_FILES['arquivo']['name'][$i], PATHINFO_EXTENSION);
                $arquivo_uploaded = md5($_FILES['arquivo']['name'][$i] . time(). rand(0,99)) . "." . $extension;
                
                if( move_uploaded_file($_FILES['arquivo']['tmp_name'][$i], "arquivos/" . $arquivo_uploaded ) ) {
                    echo "O arquivo \"${arquivo_uploaded}\" foi enviado com sucesso!<br/>";
                } else {
                    echo "Ocorreu algum erro ao enviar o arquivo \"${arquivo_uploaded}\"!<br/>";
                }
            }
            echo "<a href='index.php'>Voltar</a>";            
        }
    }
