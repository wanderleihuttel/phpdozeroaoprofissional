<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-with,initial-scale=1, shrink-to-fit=no" />
    <title>Bootstrap 4</title>
    <link rel="stylesheet" href="css/bootstrap.min.css" >
</head>
<body>
    <div class="container">
        <div class="row d-block">
            <div class="alert alert-info" role="alert">
              Redimensionando Imagens
            </div>            
            
        
            <?php 
            $arquivo = "img/img2.jpg";
            $arquivo_mini = "img/mini.png";

            list($largura_original, $altura_original) = getimagesize($arquivo);
            list($largura_mini, $altura_mini) = getimagesize($arquivo_mini);

            $imagem_final = imagecreatetruecolor($largura_original, $altura_original);
            
            $imagem_original = imagecreatefromjpeg($arquivo);
            $imagem_mini = imagecreatefrompng($arquivo_mini);

            imagecopy($imagem_final, $imagem_original, 0, 0, 0, 0, $largura_original, $altura_original);
            
            $right = $largura_original-$largura_mini-10;
            $bottom = $altura_original-$altura_mini-10;

            imagecopy($imagem_final, $imagem_mini, $right, $bottom, 0, 0, $largura_mini, $altura_mini);

            imagejpeg($imagem_final,'img/img2-thumb.jpg', 100);
            ?>
            <div>
                <img src="img/img2-thumb.jpg" class="img-thumbnail rounded">
                <div class="alert alert-success alert-sm" role="alert">
                    Redimensionando Imagens
                </div>   
            </div>
            
        </div>


    </div>

    <script type="text/javascript" src="js/jquery-3.3.1.min.js"></script>
    <script type="text/javascript"src="js/popper.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>   
</body>
</html>