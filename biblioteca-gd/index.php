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
            $arquivo = "img/img1.jpg";
            $largura = 200;
            $altura  = 200;

            list($largura_original, $altura_original) = getimagesize($arquivo);

            $ratio = $largura_original / $altura_original;

            if($largura / $altura > $ratio){
                $largura = $altura * $ratio;
            } else {
                $altura = $largura / $ratio;
            }

            $imagem_final = imagecreatetruecolor($largura, $altura);
            $imagem_original = imagecreatefromjpeg($arquivo);

            imagecopyresampled($imagem_final, $imagem_original, 0, 0, 0, 0,
            $largura, $altura, $largura_original, $altura_original);

            imagejpeg($imagem_final,'img/img1-thumb.jpg', 100);
            ?>
            <div>
                <img src="img/img1-thumb.jpg" class="img-thumbnail rounded">
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